<?php

namespace App;

use File;
use PDF;
//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;
use App\Models\Order as Orders;
use App\Event;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Orders
{
    //use SoftDeletes;

    /**
     * The validation rules of the model.
     *
     * @var array $rules
     */
    public $rules = [
        'order_first_name' => ['required'],
        'order_last_name' => ['required'],
        'order_email' => ['required', 'email']
    ];

    /**
     * The validation error messages.
     *
     * @var array $messages
     */
    public $messages = [
        'order_first_name.required' => 'Please enter a valid first name',
        'order_last_name.required' => 'Please enter a valid last name',
        'order_email.email' => 'Please enter a valid email',
    ];


    protected $with = ['tickets', 'orderStatus', 'attendees'];

    /**
     * The items associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    /**
     * The attendees associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendees()
    {
        return $this->hasMany('App\Models\Attendee');
    }

    /**
     * The account associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    /**
     * The account associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    /**
     * The event associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    /**
     * The tickets associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }


    public function payment_gateway()
    {
        return $this->belongsTo('App\PaymentGateway');
    }

    /**
     * The status associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus');
    }


    /**
     * Get the organizer fee of the order.
     *
     * @return \Illuminate\Support\Collection|mixed|static
     */
    public function getOrganiserAmountAttribute()
    {
        return $this->amount + $this->organiser_booking_fee + $this->taxamt;
    }

    /**
     * Get the total amount of the order.
     *
     * @return \Illuminate\Support\Collection|mixed|static
     */
    public function getTotalAmountAttribute()
    {
        return $this->amount + $this->organiser_booking_fee + $this->booking_fee;
    }

    /**
     * Get the full name of the order.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Generate and save the PDF tickets.
     *
     * @todo Move this from the order model
     *
     * @return bool
     */
    public function generatePdfTickets()
    {
        $data = [
            'order' => $this,
            'event' => $this->event,
            'tickets' => $this->event->tickets,
            'attendees' => $this->attendees,
            'css' => file_get_contents(public_path('assets/stylesheet/ticket.css')),
            'image' => base64_encode(file_get_contents(public_path($this->event->organiser->full_logo_path))),
        ];

        $pdf_file_path = public_path(config('attendize.event_pdf_tickets_path')) . '/' . $this->order_reference;
        $pdf_file = $pdf_file_path . '.pdf';

        if (file_exists($pdf_file)) {
            return true;
        }

        if (!is_dir($pdf_file_path)) {
            File::makeDirectory(dirname($pdf_file_path), 0777, true, true);
        }

        PDF::setOutputMode('F'); // force to file
        PDF::html('Public.ViewEvent.Partials.PDFTicket', $data, $pdf_file_path);

        $this->ticket_pdf_path = config('attendize.event_pdf_tickets_path') . '/' . $this->order_reference . '.pdf';
        $this->save();

        return file_exists($pdf_file);
    }

    /**
     * Boot all of the bootable traits on the model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(
            function ($order) {
                // $order->order_reference = strtoupper(str_random(5)) . date('jn');
            }
        );

        static::saving(
            function ($order) {
                $order->calculateTotalAttendeePrice();

            }
        );
    }

    /**
     * Calculate total price of each attendee.
     *
     * @return int
     */
    public function calculateTotalAttendeePrice()
    {

        $event = Event::find($this->event_id);
        $event_properties = isset($event->user_properties) ? $event->user_properties : null ;
        $attendees_order = $this->attendees;
        $amount = 0;
        $total = 0;

        if (!$attendees_order) return;

        foreach ($attendees_order as $attendee) {
            if ($attendee->ticket && $attendee->ticket->price) $total += $attendee->ticket->price;
        }

        //Vamos a recorrer los asistentes que contiene una orden
        foreach($attendees_order as $attendee){
            //Capturarmos los campos con su valor de los asistentes que contienen una orden
            $properties = $attendee->properties;
            //Recorremos las propiedades del asistente 
            foreach($properties as $key_attendize=>$attendize){
                //Recorremos los campos definidos en el evento para encontrar cual tiene monto
                if(isset($event_properties))
                {
                    foreach($event_properties as $key_event_property => $event_property){
                        //Si el valor del campo es igual al que se configuro en el evento entramos
                        if($event_property['name'] == $key_attendize){
                            //Si dentro de campo existe las opciones significa que es un dropdown y entramos
                            if(isset($event_property['options'])){
                                //Recorremos las opciones del dropdown
                                foreach($event_property['options'] as $key_property=>$property){
                                    //Si el input tiene definido un monto entramos
                                    if(isset($property['amount'])){
                                        //Si el valor del attendize es igual al campo de la propiedad entra
                                        if($key_property == $attendize){
                                            $amount += $property['amount'];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }                
            }
            
        }
        $this->amount;
    }
}
