<?php

namespace App\Mail;

use App\evaLib\Services\GoogleFiles;
use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;
use QRCode;
use Storage;

class BookingConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;//, Dispatchable, InteractsWithQueue;
    public $event;
    public $event_address;
    public $event_city;
    public $event_state;
    public $eventuser_name;
    public $eventuser_id;
    public $eventuser_lan;
    public $password;
    public $email;
    public $qr;
    public $logo;
    public $attach;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eventUser)
    {
        
        Log::debug("recibiendo event_user");

        $event = Event::find($eventUser->event_id);
        $event_address = isset($event["location"]["FormattedAddress"])?($event["location"]["FormattedAddress"]):" ";
        $event_city = isset($event["location"]["City"])?($event["location"]["City"]):" ";
        $event_state = isset($event["location"]["state"])?($event["location"]["state"]):" ";

        $email = isset($eventUser["properties"]["email"]) ? $eventUser["properties"]["email"] : $eventUser["email"];
        $password = isset($eventUser["properties"]["password"]) ? $eventUser["properties"]["password"] : "mocion.2040";
        
        $eventUser_name = isset($eventUser["properties"]["nombres"]) ? $eventUser["properties"]["nombres"] : $eventUser["properties"]["names"];
        $eventUser_lan = isset($eventUser["properties"]["language"]) ? $eventUser["properties"]["language"] : "ES";
        $eventUser_id = $eventUser->id;

        Log::debug("cargando datos event_user al correo");

        $this->event_address = $event_address ;
        $this->event_city = $event_city;
        $this->event_state = $event_state;
        $this->event = $event;
        $this->email = $email;
        $this->password = $password;
        $this->eventuser_name = $eventUser_name;
        $this->eventuser_lan = $eventUser_lan;
        $this->eventuser_id = $eventUser_id;
        $this->subject = "[Tu Ticket - " . $event->name . "]";  
        $gfService = new GoogleFiles();
   
        Log::debug("pasando a crear correo");

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $attachPath = url()->previous().'/api/generatorQr/'.$this->eventuser_id;
        $this->attach = $attachPath;
        Log::debug("Construyendo el correo de ticket");
        $gfService = new GoogleFiles();
        echo $this->eventuser_lan;
        $from = $this->event->organizer->name;
        $logo_evius = 'images/logo.png';
        $file = $this->eventuser_id . '_qr.png';
        $fullpath = storage_path('app/public/' . $file);
        $event = $this->event;
        $eventuser = $this->eventuser_name;
        $ticket_id = $this->eventuser_id;
        $email = $this->email;
        $password = $this->password;
        $event_address = $this->event_address;
        $event_city = $this->event_city;
        $event_state = $this->event_state;
        //$pdf = PDF::loadview('pdf_bookingConfirmed', compact('event','eventuser','ticket_id','event_state','event_city','event_address'));
        
        //$pdf->setPaper('legal','portrait');
        try {
            /*$image = QRCode::text($this->eventuser_id)
                ->setSize(8)
                ->setMargin(4)
                ->setOutfile($fullpath)
                ->png();
            */

                ob_start(); 
                $qr = QRCode::text($this->eventuser_id)->setSize(8)->setMargin(4)->png();
                //$qr = base64_encode($qr);
                $page = ob_get_contents();
                ob_end_clean();
                $type = "png";
                $image = $page;//'data:image/' . $type . ';base64,' . base64_encode($page);     
                
            //$img = Storage::get("public/" . $file);

            $url = $gfService->storeFile($image, "".$this->eventuser_id.".".$type);

            $this->qr = (string) $url;
            Log::debug("QR link: ".$url);
            //$img = Storage::delete("public/".$file);
            $this->logo = url($logo_evius);


        } catch (\Exception $e) {
            Log::debug("error: " . $e->getMessage());
            var_dump($e->getMessage());
        }
        
        return $this
            // ->attach($attachPath,[
            //     'as' => 'checkin',
            //     'mime' => 'image/png',
            // ])
            // ->attachData($pdf->download(),'boleta.pdf')
            ->from("apps@mocionsoft.com", "Recordatorio")
            ->subject($this->subject)
            ->markdown('bookingConfirmed');
        }
    }
    

