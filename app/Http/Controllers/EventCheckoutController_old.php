<?php

namespace App\Http\Controllers;

use Auth;
use Cookie;
use Log;
use Omnipay;
use PDF;
use Validator;
use QRCode;
use App\Account;
use App\Attendee;
use App\Event;
use App\Order;
use App\AttendeTicket;
use App\ModelHasRole;
use App\Pending;
use App\Events\OrderCompletedEvent;
use App\Jobs\SendOrderTickets;
use App\Models\AccountPaymentGateway;
use App\Models\Affiliate;
use App\Models\EventStats;
use App\Models\OrderItem;
use App\Models\QuestionAnswer;
use App\Models\ReservedTickets;
use App\Models\Ticket;
use App\Services\Order as OrderService;
use App\Services\StringHelpers;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UsersResource;
use PhpSpec\Exception\Exception;

class EventCheckoutController extends Controller
{
    /**
     * Is the checkout in an embedded Iframe?
     *
     * @var bool
     */
    protected $is_embedded;

    /**
     * EventCheckoutController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        /*
         * See if the checkout is being called from an embedded iframe.
         */
        $this->is_embedded = $request->get('is_embedded') == '1';
    }

    /**
     * Validate a ticket request. If successful reserve the tickets and redirect to checkout
     *
     * @param Request $request
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function postValidateTickets(Request $request, $event_id)
    { 
        $email_user = Auth::user()->email;
        /*
         * Order expires after X min
         */
        $order_expires_time = Carbon::now()->addMinutes(config('attendize.checkout_timeout_after'));

        $event = Event::findOrFail($event_id);
        if (!$request->has('tickets')) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tickets selected',
            ]);
        }

        $ticket_ids = $request->get('tickets');
        $number_ticket = 0;
        foreach ($ticket_ids as $ticket_id) {
            $number_ticket = $number_ticket + 1;
            $ticket = Ticket::find($ticket_id);
            $quantity_remaining = (int)$ticket->quantity_remaining;
            $quantity_tickets_user = (int)$request->get('ticket_' . $ticket_id);

            // if user buyer more tickets that there are, show a message of disponibility
            if (isset($event->allow_company) && $event->allow_company) { 
                if($ticket->quantity_remaining < $quantity_tickets_user){
                    $tot_tickets = $ticket->quantity_available - $ticket->total_people_quantity;
                    $message = $tot_tickets == 0 ? $ticket->title.": Tiquetes agotados" :
                            $ticket->title.' tiene una disponibilidad de '.$ticket->quantity_remaining.' tiquetes';
                    return response()->json([
                        'status' => 'error',
                        'message' => $message,
                    ]);
                }
            }
            else {     
                if($ticket->quantity_remaining < $quantity_tickets_user){
                    $message = $ticket->quantity_remaining == 0 ? $ticket->title.": Tiquetes agotados" :
                            $ticket->title.' tiene una disponibilidad de '.$ticket->quantity_remaining.' tiquetes';
                    return response()->json([
                        'status' => 'error',
                        'message' => $message,
                    ]);
                }
            }
        }

        /* Validar cantidad de ticketspor codigo promocional para el evento PMI */
        if ($event_id == '5d2de182d74d5c28047d1f85' && $number_ticket > 1) {
            return response()->json(
                [
                    'Debe seleccionar solo 1 tiquete por compra'    
                ]
            );      
        }
        $code_discount = $request->get('code_discount');
        if ($code_discount && is_array($event->codes_discount)) {
            foreach ($event->codes_discount as $code) {
                if ($code['id'] == $code_discount && $code['available'] == true) {
                    if ($event_id == '5d2de182d74d5c28047d1f85' && $number_ticket > 1) {
                        return response()->json(
                            [
                                'To many tickets for this code'    
                            ]
                        );      
                    }
                }
            }
        }
        /*
         * Remove any tickets the user has reserved
         */
        ReservedTickets::where('session_id', '=', session()->getId())->delete();

        /*
         * Go though the selected tickets and check if they're available
         * , tot up the price and reserve them to prevent over selling.
         */

        $validation_rules = [];
        $validation_messages = [];
        $tickets = [];
        $order_total = 0;
        $total_ticket_quantity = 0;
        $booking_fee = 0;
        $organiser_booking_fee = 0;
        $quantity_available_validation_rules = [];
        $fees_total = 0;
        $tax_total = 0;
        $tax = 0;
        $price_last = 0;

        foreach ($ticket_ids as $ticket_id) {
            $current_ticket_quantity = (int) $request->get('ticket_' . $ticket_id);

            if ($current_ticket_quantity < 1) {
                continue;
            }

            $total_ticket_quantity = $total_ticket_quantity + $current_ticket_quantity;
            $ticket = Ticket::find($ticket_id);
            $ticket_quantity_remaining = $ticket->max_per_person;
            $max_per_person = min($ticket_quantity_remaining, $ticket->max_per_person);

            $quantity_available_validation_rules['ticket_' . $ticket_id] = [
                'numeric',
                'min:' . $ticket->min_per_person,
                'max:' . $ticket->$max_per_person,
            ];

            $quantity_available_validation_messages = [
                'ticket_' . $ticket_id . '.max' => 'The maximum number of tickets you can register is ' . $ticket_quantity_remaining,
                'ticket_' . $ticket_id . '.min' => 'You must select at least ' . $ticket->min_per_person . ' tickets.',
            ];

            $validator = Validator::make(['ticket_' . $ticket_id => (int) $request->get('ticket_' . $ticket_id)],
                $quantity_available_validation_rules, $quantity_available_validation_messages);

            /* Si el evento es pago con cobro de comisión y de IVA */
            if (isset($event->fees) && $event->comission_on_base_price == true) {
                $cant_ticket =  $current_ticket_quantity;
                $ticket_total_price = $cant_ticket * $ticket->price;
                $fees = $event->fees;
                $fees_total = $ticket_total_price * $fees;
                $tax = $event->tax;
                $tax_total = $fees_total * $tax;
                $price_last = $fees_total + $tax_total + $ticket_total_price; /* Se suma para el precio del ticket total */
                $order_total = $order_total +  $price_last;
            } elseif (isset($event->fees) && !isset($event->comission_on_base_price)) { /* Si no tiene ningun cobro de comision ni de IVA */
                $cant_ticket =  $current_ticket_quantity;
                $ticket_total_price = $cant_ticket * $ticket->price;
                $fees = $event->fees;
                $fees_total = $ticket_total_price * $fees;
                $price_last = $fees_total + $ticket_total_price; /* Se suma para el precio del ticket total */
                $order_total = $order_total +  $price_last;

            } else { 

                $order_total = $order_total + ($current_ticket_quantity * $ticket->price);
            }

            $booking_fee = $booking_fee + ($current_ticket_quantity * $ticket->booking_fee);
            $organiser_booking_fee = $organiser_booking_fee + ($current_ticket_quantity * $ticket->organiser_booking_fee);

            $tickets[] = [
                'ticket' => $ticket,
                'qty' => $current_ticket_quantity,
                'price' => ($current_ticket_quantity * $ticket->price),
                'booking_fee' => ($current_ticket_quantity * $ticket->booking_fee),
                'organiser_booking_fee' => ($current_ticket_quantity * $ticket->organiser_booking_fee),
                'full_price' => $ticket->price + $ticket->total_booking_fee,
            ];

            /*
             * Reserve the tickets for X amount of minutes
             */
            $reservedTickets = new ReservedTickets();
            $reservedTickets->ticket_id = $ticket_id;
            $reservedTickets->event_id = $event_id;
            $reservedTickets->quantity_reserved = $current_ticket_quantity;
            $reservedTickets->expires = $order_expires_time;
            $reservedTickets->session_id = session()->getId();
            $reservedTickets->save();

        }
        if (empty($tickets)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tickets selected.',
            ]);
        }

        if (config('attendize.enable_dummy_payment_gateway') == true) {
            $activeAccountPaymentGateway = new AccountPaymentGateway();
            $activeAccountPaymentGateway->fill(['payment_gateway_id' => config('attendize.payment_gateway_dummy')]);
            $paymentGateway = $activeAccountPaymentGateway;
        } else {
            $eventAccount = $event->account;
            $activeAccountPaymentGateway = $eventAccount->active_payment_gateway;
            //$activeAccountPaymentGateway = ($eventPaymentGateway->count()) ? $eventPaymentGateway->firstOrFail() : false;
            $paymentGateway = $activeAccountPaymentGateway && $activeAccountPaymentGateway->count() ? $activeAccountPaymentGateway->payment_gateway : false;
        }

        /* Método para tomar las iniciales de los eventos y agregarlos al ticket_order_  */
        $acronym = StringHelpers::acronym($event->name);
        
        /*
         * The 'ticket_order_{event_id}' session stores everything we need to complete the transaction.
         */
        $order_reference = "ticket_order_" .$acronym. "_". time();
        //Generamos un cahce donde contiene la información primordial del pago, antes de introducir datos del usuario
        //Que va a cancelar

        //Descuento de los tikets del porcentaje a agregar a una cantidad de ticketes.


            $tickets_discount = isset($event->tickets_discount) ? $event->tickets_discount: 0;
            $percentage_discount = is_empty($event->percentage_discount) ? $event->percentage_discount: 0;
            
            //Si la cantidad de tiquetes es mayor o igual al que esta permitido en la base de datos y este sea diferente de 0 
            //Se realiza el descuento
            
        if ($total_ticket_quantity >= $tickets_discount && $tickets_discount != 0) {
            $discount = $percentage_discount*$order_total/100;
            $order_total = $order_total - $discount;
        }

        $code_discount = $request->get('code_discount');

        if($code_discount){
            foreach($event->codes_discount as $code){
                if($code['id'] == $code_discount && $code['available'] == true){
                    $percentage_discount = $code['percentage'];
                    $discount = $percentage_discount*$order_total/100;
                    $order_total = $order_total - $discount;
                    break;
                }
            }

        }
            
            $data_pending = [
                'validation_rules' => $validation_rules,
                'validation_messages' => $validation_messages,
                'event_id' => $event->id,
                'email_user' => $email_user,
                'tickets' => $tickets,
                'total_ticket_quantity' => $total_ticket_quantity,
                'order_started' => time(),
                'expires' => $order_expires_time,
                'reserved_tickets_id' => $reservedTickets->id,
            'fees_total' => $fees_total,
            'tax_total' => $tax_total,
            'order_total' => $order_total,
            'booking_fee' => $booking_fee,
            'organiser_booking_fee' => $organiser_booking_fee,
            'total_booking_fee' => $booking_fee + $organiser_booking_fee,
            'order_requires_payment' => (ceil($order_total) == 0) ? false : true,
            'account_id' => $event->account->id,
            'affiliate_referral' => Cookie::get('affiliate_' . $event_id),
            'account_payment_gateway' => $activeAccountPaymentGateway,
            'payment_gateway' => $paymentGateway,
            'currency' => $ticket->currency,
            'code_discount' => $code_discount,
            'percentage_discount' => $percentage_discount,
            'discount' => isset($discount) ? $discount : null,
            'seats_data' => $request->seats
            
        ];
        //save information in pending with json_encode, value how string
        $pending = new Pending();
        $pending->reference = $order_reference;
        $pending->value = json_encode($data_pending);
        $pending->save();
        /*
        * If we're this far assume everything is OK and redirect them
        * to the the checkout page.
        */
        return response()->json([
            'status' => 'success',
            'redirectUrl' => route('showEventCheckout', [
                'event_id' => $order_reference,
                'is_embedded' => $this->is_embedded,
                ]) . '#order_form',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'redirectUrl' => route('showEventCheckout', [
                    'event_id' => $order_reference,
                    'is_embedded' => $this->is_embedded,
                ]) . '#order_form',
            ]);
        }
        /*
         * Maybe display something prettier than this?
         */
        exit('Please enable Javascript in your browser.');
    }

    /**
     * Show the checkout page
     *
     * This controller show the user information, when you put the user information
     * @param Request $request
     * @param $event_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showEventCheckout(Request $request, $order_reference)
    {
        
        //This code was must TEMPORALThis reload even when there is a user authenticaded
        $pending = Pending::where('reference',$order_reference)->first();
        
        if (!isset($pending) || !Auth::user()) {
            header('Location: '.config('app.front_url').''); die;
        }
        
        $order_session = json_decode($pending->value, true);
        $event = Event::findorFail($order_session['event_id']);
        
        //Find user fields in event.
        $fields = $event->user_properties;

        $orderService = new OrderService($order_session['order_total'], $order_session['total_booking_fee'], $event);
        $orderService->calculateFinalCosts();  
    

        if($order_session['seats_data']){

            if(!isset($order_session['seats_data']['cache'])){
                //Booked seats seats.io
                $seats = [];
                //get seats and booke
                $seats_data = $order_session['seats_data'];
                $flag = true;
                foreach($seats_data as $seat)
                {
                    //if this dont have chart break the save in seats.io
                    if($seat['id'] == $seat['labels']['own']){
                        $flag = false;
                        break;
                    };
                    array_push($seats,$seat['id']);
                }
                
                if($flag){
                    $event_chart = $seats_data[0]['chart']['config']['event'];
                    $key_secret = ($event->seats_configuration)['keys']['secret'];
                    $seatsio = new \Seatsio\SeatsioClient($key_secret);      // key secret 
                    $seatsio->events->book($event_chart, $seats); // key event
                    
                    $order_session['seats_data']['cache'] = true;
                    $order_session['seats_data']['seats'] = $seats;
                    $order_session['seats_data']['key_secret'] = $key_secret;
                    $order_session['seats_data']['event_chart'] = $event_chart;
                }

            }
        }

        $pending->value = json_encode($order_session);
        $pending->save();

        $permissions = ModelHasRole::where('model_id',Auth::user()->id)->where('event_id',$order_session["event_id"])->first();

        $data = $order_session + [
            'event' => $event,
            'is_embedded' => $this->is_embedded,
            'orderService' => $orderService,
            'fields' => $fields,
            'temporal_id' => $order_reference,
            'cant'   => 1,
            'role' => isset($permissions->role_id) ? $permissions->role_id : null
        ];
        return view('Public.ViewEvent.EventPageCheckout', $data);
    }

    /**
     * postCreateOrder
     * Create the order, handle payment, update stats, fire off email jobs then redirect user
     *
     * @param Request $request
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateOrder(Request $request, $order_reference)
    {
        $user_id = Auth::user()->id;
        //Capturamos el ticket del cache en ticket_order, recuerda que eesto es solo cache
        $pending = Pending::where('reference',$order_reference)->first();
        $ticket_order = json_decode($pending->value, true);
        //Extraemos el event_id del cache
        $event_id = $ticket_order["event_id"];
        $event = Event::findOrFail($event_id);
        if ($event->author_id == $user_id){
            return response()->json([
                'status' => 'error',
                'message' => '¡Usted no puede realizar compras ya que es el administrador del evento por favor ingrese con otra cuenta para completar la compra!',
            ]);
        }

        //If there's no session kill the request and redirect back to the event homepage.
        //If don't have the terms and conditions, not continue
        if (!$request->has('terms')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Por favor aceptar los términos y condiciones',
            ]);
        }

        //Buscamos el evento por medio del event_id
        $event = Event::findOrFail($event_id);

        //Capturamos los datos ingresados por el usuario y la guardamos en el cache como request_data
        $ticket_order['request_data'] = $request->except(['card-number', 'card-cvc']);

        /* Function to validate the ticket availability */
        if (isset($event->allow_company) && $event->allow_company) { 
            foreach ($ticket_order['tickets'] as $ticket_count) {

                /* Obtain companies quantity */
                if (isset($request['person_per_ticket']) && isset($request['holder_info'])) {
                    $cont = $request['person_per_ticket'];
                } else {
                    $cont = $ticket_count['qty'];
                }
                for ($i = 0; $i < $cont; $i++) {

                /* Find the ticket */
                $ticket_id = $ticket_count['ticket']['_id'];
                $ticket = Ticket::find($ticket_id);

                /* Quantity ticket selected */
                $quantity_companies_user = (int)$request["tiket_holder_acompanates"][$i][$ticket_id];

                /* Validate the ticket availability */
                    if($ticket->quantity_remaining < $quantity_companies_user){
                        $tot_tickets = $ticket->quantity_available - $ticket->total_people_quantity;
                        $message = $tot_tickets == 0 ? $ticket->title.": Tiquetes agotados" :
                                $ticket->title.' tiene una disponibilidad de '.$ticket->quantity_remaining.' tiquetes';
                        return response()->json([
                            'status' => 'error',
                            'message' => $message,
                        ]);
                    }
                }
            }
        }

        /* Si no desea asignar aún los tickets */
        if ($request->holder_info == 1) {
            self::assignTicketsToPurchaser($request, $event, $ticket_order['request_data']);
        }

        $orderRequiresPayment = $ticket_order['order_requires_payment'];

        $pending->value = json_encode($ticket_order);
        $pending->save();

        //this if dont work in this moment 
        if ($orderRequiresPayment && $request->get('pay_offline') && $event->enable_offline_payments) {
            return $this->completeOrder($event_id);
        }
        //When the purshase is free 
        if (!$orderRequiresPayment) {

            /**
            * Seats Confirmation 
            */
            if(($event->seats_configuration)['status']){
                $date = new \DateTime();
                $now =  $date->format('Y-m-d H:i:s');
                $seats = [];
                if(isset($ticket_order['seats_data'])) { 
                    foreach($ticket_order['seats_data'] as $key => $seat){ 
                        array_push($seats, $key); 
                    }
                }
            }

            $this->storeOrder($order_reference, true);
            $this->completeOrder($order_reference);
            
            /* Fiond order */
            $order = Order::where('order_reference', '=', $order_reference)->first();
            $return = [
                'status' => 'success',
                'redirectUrl' => url('/').'/order/'.$order_reference,
                'message' => 'Redirigido a la orden',
            ];
            /* Envío de correo */
            if(config('attendize.send_email')){
                $this->dispatch(new SendOrderTickets($order));
            }
            return response()->json($return);
            
        }

        try {
            //more transation data being put in here.
            $transaction_data = [];
            if (config('attendize.enable_dummy_payment_gateway') == true) {
                $formData = config('attendize.fake_card_data');
                $transaction_data = [
                    'card' => $formData,
                ];
                $gateway = Omnipay::create('Dummy');
                $gateway->initialize();

            } else {

                $gateway = Omnipay::create($ticket_order['payment_gateway']['name']);
                $config = $ticket_order['account_payment_gateway']['config'];
                if (!$config) {
                    $config = [];
                }

                $config += [
                    'testMode' => config('attendize.enable_test_payments'),
                    'login' => 'ff684c45a63f769d824994dcc1369fb9',
                    'tranKey' => 'X1GIXSF2Dxtq0bfg',
                    'url' => 'https://secure.placetopay.com/redirection/',
                ];

                $gateway->initialize($config);
            }

            $orderService = new OrderService($ticket_order['order_total'], $ticket_order['total_booking_fee'], $event);
            $orderService->calculateFinalCosts();

            $transaction_data += [
                'amount' => $orderService->getGrandTotal(),
                'currency' => $ticket_order["currency"],
                'description' => 'Evento: ' . $event->name,
            ];

            //TODO: class with an interface that builds the transaction data.
            // if the server is localhost the base is https://dev.evius.co. this add in the urlResponse on the pasarela.
            // when return depend in the server is currently, except localhost

            $baseUrl = ($_SERVER["SERVER_NAME"] == 'localhost') ? "https://dev.evius.co" : url('/');

            switch ($ticket_order['payment_gateway']['id']) {
                case config('attendize.payment_gateway_dummy'):
                    $token = uniqid();
                    $transaction_data += [
                        'token' => $token,
                        'receipt_email' => $request->get('order_email'),
                        'card' => $formData,
                    ];
                    break;
                case config('attendize.payment_gateway_paypal'):

                    $transaction_data += [
                        'cancelUrl' => route('showEventCheckoutPaymentReturn', [
                            'event_id' => $event_id,
                            'is_payment_cancelled' => 1,
                        ]),
                        'returnUrl' => route('showEventCheckoutPaymentReturn', [
                            'event_id' => $event_id,
                            'is_payment_successful' => 1,
                        ]),
                        'brandName' => isset($ticket_order['account_payment_gateway']->config['brandingName'])
                        ? $ticket_order['account_payment_gateway']->config['brandingName']
                        : $event->organiser->name,
                    ];
                    break;
                case config('attendize.payment_gateway_stripe'):
                    $token = $request->get('stripeToken');
                    $transaction_data += [
                        'token' => $token,
                        'receipt_email' => $request->get('order_email'),
                    ];
                    break;
                //CONFIGURATION PLACETOPAY
                case config('attendize.payment_gateway_placetopay'):
                    $transaction_data += [
                        'returnUrl' => $baseUrl.'/order/' . $order_reference . '/payment',
                        'orderid' => $order_reference,
                        'login' => 'ff684c45a63f769d824994dcc1369fb9',
                        'tranKey' => 'X1GIXSF2Dxtq0bfg',
                        'url' => 'https://secure.placetopay.com/redirection/',
                        'typeDocument' => $request->get('typeDocument'),
                        'document' => $request->get('document'),
                        'username' => $request->get('order_first_name'),
                        'lastname' => $request->get('order_last_name'),
                        'payerIsBuyer' => $request->get('payerIsBuyer'),
                        'mobile' => $request->get('mobile'),
                        'email' => $request->get('order_email'),
                        'cancelUrl' => $baseUrl.'/order/' . $order_reference . '/payment',
                    ];

                    break;
                /* CONFIGURATION PAYU */
                case config('attendize.payment_gateway_payu'):
                    
                    $transaction_data += [
                        'responseUrl' => $baseUrl.'/order/' . $order_reference . '/payment/PayU',
                        'transactionId' => $order_reference,
                        'orderDate' => date('Y-m-d H:i:s'),
                        'merchantId' => '508029',
                        'email' => $request->get('order_email'),
                        'items' => [
                            new \Omnipay\PayU\Item([
                                'name' => 'Item',
                                'code' => 'ItemCode',
                                'description' => 'Evento: ' . $event->name,
                                'price' =>  $orderService->getGrandTotal(),
                                'priceType' => 'NET',
                                'quantity' => 1,
                                'vat' => 0,
                                'url' => $baseUrl.'/order/' . $order_reference . '/payment/PayU',
                                'confirmationUrl' => $baseUrl.'/order/paymentCompleted/PayU'

                                ] 
                            ),
                        ],
                    ];
                    break;

                default:
                    Log::error('No payment gateway configured.');
                    return repsonse()->json([
                        'status' => 'error',
                        'message' => 'No payment gateway configured.',
                    ]);
                    break;
            }

            $transaction = $gateway->purchase($transaction_data);
            $response = $transaction->send(); 
            /**
            * Seats Confirmation 
            */
            if(($event->seats_configuration)['status']){
                $date = new \DateTime();
                $now =  $date->format('Y-m-d H:i:s');
                $seats = [];
                if(isset($ticket_order['seats_data'])){
                    foreach($ticket_order['seats_data'] as $key => $seat){  
                        array_push($seats, $key); 
                    }
                }
                //event: was replace by event_idv
                $event_id = ($event->seats_configuration)['keys']['event'];
            }
            /**
             * Redirection to payment Gatway, it'free redirect to completeOrder Controller
             */
            if ($response->isSuccessful()) {
                
                session()->push('ticket_order_' . $event_id . '.transaction_id', $response->getTransactionReference());
                return $this->completeOrder($event_id);
            } elseif ($response->isRedirect() && $response->getRedirectUrl()) {
                
                /*
                * As we're going off-site for payment we need to store some data in a session so it's available
                * when we return
                */
                
                // $response->requestId() and $response->processUrl()
                $session_id = $response->getTransactionReference();

                $ticket_order['transaction_data'] = [];

                $url_redirect = $response->getRedirectUrl();
                   
                $ticket_order['transaction_data'] += ['url_redirect' => $url_redirect];
                
                $ticket_order['transaction_data'] += $transaction_data;
                $ticket_order['transaction_data'] += ['session_id' => $session_id];
                //Guardamos la informacion del tickete en el cache y vamos a complete order para generar la orden.

                $pending->value = json_encode($ticket_order);
                $pending->save();

                $this->storeOrder($order_reference);
                // var_dump($request->get('box_payment'));die;
                if($request->get('box_payment')){
                    $url_redirect = "paymentEvius";
                }
                Log::info("Redirect url: " . $url_redirect);
                $return = [
                    'status' => 'success',
                    'redirectUrl' => $url_redirect,
                    'message' => 'Redirecting to ' . $ticket_order['payment_gateway']['provider_name'],
                ];

                // GET method requests should not have redirectData on the JSON return string
                if ($response->getRedirectMethod() == 'POST') {
                    $return['redirectData'] = $response->getRedirectData();
                }

                return response()->json($return);

            } else {
                // display error to customer
                return response()->json([
                    'status' => 'error',
                    'message' => 'Verifíca los datos para poder continuar',
                ]);
            }
        } catch (\Exeption $e) {
            Log::error($e);
            $error = 'Sorry, there was an error processing your payment. Please try again.';
        }
        if ($error) {
            return response()->json([
                'status' => 'error',
                'message' => $error,
            ]);
        }

    }
    /**
     * Attempt to complete a user's payment when they return from
     * an off-site gateway
     *
     * @param Request $request
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function showEventCheckoutPaymentReturn(Request $request, $event_id)
    {
        if ($request->get('is_payment_cancelled') == '1') {
            session()->flash('message', 'You cancelled your payment. You may try again.');
            return response()->redirectToRoute('showEventCheckout', [
                'event_id' => $event_id,
                'is_payment_cancelled' => 1,
            ]);
        }

        $ticket_order = session()->get('ticket_order_' . $event_id);
        $gateway = Omnipay::create($ticket_order['payment_gateway']->name);

        $gateway->initialize($ticket_order['account_payment_gateway']->config + [
            'testMode' => config('attendize.enable_test_payments'),
        ]);

        $transaction = $gateway->completePurchase($ticket_order['transaction_data'][0]);

        $response = $transaction->send();

        if ($response->isSuccessful()) {
            session()->push('ticket_order_' . $event_id . '.transaction_id', $response->getTransactionReference());
            return $this->completeOrder($event_id, false);
        } else {
            session()->flash('message', $response->getMessage());
            return response()->redirectToRoute('showEventCheckout', [
                'event_id' => $event_id,
                'is_payment_failed' => 1,
            ]);
        }

    }


    
    public function generateTickets($order_reference, $return_json = true){
        $order = Order::where('_id', '=', $order_reference)->first();
       // echo "<pre>";
      
        foreach ($order->orderItems as $oi) {

            var_dump($oi->_idu);
        }
    }
    /**
     * Complete an order
     *
     * @param $event_id
     * @param bool|true $return_json
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
     public function completeOrder($order_reference, $return_json = true)
    {
        //Si la orden ya fue creada entonces redirigimos al recibo con los ticketes, si no
        //vamos a crear la orden a partir del cache.
        //EL CACHE ES INDISPENSABLE EN ESTE CONTROLADOR

            try {

                $order = Order::where('order_reference', '=', $order_reference)->first();
                $pending = Pending::where('reference',$order_reference)->first();
                if (!$pending )
                return \Response::json([
                    'not pending order' => "this"
                ], 201); 

                $ticket_order = json_decode($pending->value, true);


                if(isset($ticket_order)){
                    Log::info('completamos la orden: '.$order_reference);
                    $transaction_data = isset($ticket_order['transaction_data']) ? $ticket_order['transaction_data'] : time();

                    $event_id = isset($ticket_order['event_id']) ? $ticket_order['event_id'] : $order->event_id;
                    $request_data = isset($ticket_order['request_data']) ? $ticket_order['request_data'] : [];
    
                    //Buscamos el evento el cual le pertence el ticket
                    // return $ticket_order;die;
                    $event = Event::findOrFail($event_id);
                    $orderService = new OrderService($ticket_order['order_total'], $ticket_order['total_booking_fee'], $event);
                    $orderService->calculateFinalCosts();
                    $fields = $event->user_properties;
                    $attendee_increment = 1;
                    $ticket_questions = isset($request_data['ticket_holder_questions']) ? $request_data['ticket_holder_questions'] : [];
                    //Creamos la nueva orden
    
                    /*
                     * Update the event sales volume
                     */
                    $event->increment('sales_volume', (int) $orderService->getGrandTotal());
                    $event->increment('organiser_fees_volume', (int) $order->organiser_booking_fee);
    
                    /*
                     * Update affiliates stats stats
                     */
    
                    if (isset($ticket_order['affiliate_referral'])) {
                        $affiliate = Affiliate::where('name', '=', $ticket_order['affiliate_referral'])
                            ->where('event_id', '=', $event_id)->first();
                        $affiliate->increment('sales_volume', $order->amount + $order->organiser_booking_fee);
                        $affiliate->increment('tickets_sold', $ticket_order['total_ticket_quantity']);
                    }
    
                    /*
                     * Update the event stats
                     */
                    $event_stats = EventStats::updateOrCreate([
                        'event_id' => $event_id,
                        'date' => (Carbon::now())->toDateString(),
                    ]);
    
                    $event_stats->increment('tickets_sold', $ticket_order['total_ticket_quantity']);
                    if (isset($ticket_order['order_requires_payment'])) {
                        $event_stats->increment('sales_volume', $order->amount);
                        $event_stats->increment('organiser_fees_volume', $order->organiser_booking_fee);
                    }
                    /*
                     * Add the attendees
                     */

                    foreach ($ticket_order['tickets'] as $attendee_details) {
    
                        /*
                         * Update ticket's quantity sold
                         */
                        $ticket = Ticket::findOrFail($attendee_details['ticket']['_id']);
    
                        /*
                         * Update some ticket info
                         */

                        /* Si el evento no permite compañia aumentar los tickets normalmente */
                        if (!isset($event->allow_company)) { 
                            $ticket->increment('quantity_sold', $attendee_details['qty']);
                        }
                        $ticket->increment('sales_volume', ($attendee_details['ticket']['price'] * $attendee_details['qty']));
                        $ticket->increment('organiser_fees_volume',
                            ($attendee_details['organiser_booking_fee'] * $attendee_details['qty']));

                        /*
                         * Insert order items (for use in generating invoices)
                         */
                        $orderItem = new OrderItem();
                        $orderItem->title = $attendee_details['ticket']['title'];
                        $orderItem->quantity = $attendee_details['qty'];
                        $orderItem->order_id = $order->id;
                        $orderItem->unit_price = $attendee_details['ticket']['price'];
                        $orderItem->unit_booking_fee = $attendee_details['booking_fee'] + $attendee_details['organiser_booking_fee'];
                        $orderItem->save();
    
                        /*
                         * Create the attendees
                         */
                        if (isset($request_data['person_per_ticket']) && isset($request_data['holder_info'])) {
                            $cont = $request_data['person_per_ticket'];
                        } else {
                            $cont = $attendee_details['qty'];
                        }
                        for ($i = 0; $i < $cont; $i++) {
    
                            $attendee = new Attendee();
                            $attendee->properties = (object) [];
    
                            foreach ($fields as $field) {
                                if (!$field['name']) {
                                    continue;
                                }
                                
                                $attendee->properties->{$field['name']} = $request_data["tiket_holder_" . str_replace(" ", "_", $field['name'])][$i][$attendee_details['ticket']['_id']];
                            }
    
                            /* Si el evento permite acompañante aumentar el total_quantity y los tickets vendidos */
                            if (isset($event->allow_company) && $event->allow_company) {
                                $val = (int)$request_data["tiket_holder_acompanates"][$i][$attendee_details['ticket']['_id']];
                                $people_total= $val + $attendee_details['qty'];
                                $ticket->increment('total_people_quantity', $people_total);
                                $ticket->increment('quantity_sold', $people_total);
                            } 

                            $attendee->event_id = $event_id;
                            $attendee->order_id = $order->id;
                            $attendee->ticket_id = $attendee_details['ticket']['_id'];
                            $attendee->account_id = $event->account->id;
                            $attendee->reference_index = $attendee_increment;

                            /**
                             * Attendeize seats, assignment
                             */

                            if($ticket_order['seats_data']){
                                //Get the seats
                                $seats = $ticket_order['seats_data'];
                                foreach($seats as $key => $seat){
                                    if (isset($seat['category'])) {
                                    $seat_category = $seat['category']['label'];
                                    $ticket_name = Ticket::find($attendee->ticket_id)->title;
                                    // we compare the seat_category and ticket_name if this is true save the seat and delete of array of ticket_order, and break the foreach
                                        if($seat_category == $ticket_name){
                                            $attendee->seat = $seat['labels'];
                                            unset($ticket_order['seats_data'][$key]);
                                            break;
                                        }
                                    }
                                }
                            }
                            
                            
                            $attendee->save();
    
                            /* Keep track of total number of attendees */
                            $attendee_increment++;
                        }
    
                    }
                    Log::info('Borramos el cache de la orden: '.$order_reference);
                    $pending->forceDelete();
                }

            } catch (Exception $e) {

                Log::error($e);
                // DB::rollBack();

                return response()->json([
                    'status' => 'error',
                    'message' => 'Whoops! There was a problem processing your order. Please try again.',
                ]);

            }
            // Queue up some tasks - Emails to be sent, PDFs etc.
            Log::info('Firing the event');
            event(new OrderCompletedEvent($order));
            /* Envío de correo */
            // $this->dispatch(new SendOrderTickets($order));


        return response()->redirectToRoute('showOrderDetails', [
            'is_embedded' => $this->is_embedded,
            'order_reference' => $order->order_reference,
        ]);

    }

    /**
     * Show the order details page
     *
     * @param Request $request
     * @param $order_reference
     * @return \Illuminate\View\View
     */
    public function showOrderDetails(Request $request, $order_reference)
    {
        $order = Order::where('order_reference', '=', $order_reference)->first();

        if (!$order) {
            abort(404);
        }

        $orderService = new OrderService($order->amount, $order->organiser_booking_fee, $order->event);
        $orderService->calculateFinalCosts();

        $data = [
            'order' => $order,
            'orderService' => $orderService,
            'event' => $order->event,
            'tickets' => $order->event->tickets,
            'is_embedded' => $this->is_embedded,
        ];

        if ($this->is_embedded) {
            return view('Public.ViewEvent.Embedded.EventPageViewOrder', $data);
        }

        return view('Public.ViewEvent.EventPageViewOrder', $data);
    }

    /**
     * storeOrder
     * Save the order that is in cache, 
     * If the order don't exist load the cache data with the order_reference,
     * But, if the order exist return this order
     * This action is executed when the form is filled and we are going to pay
     * If the purshase is free is in the moment when youacquire my tickets
     * 
     * @param string $order_reference, $payment_free
     * @return array $order
     */
    public function storeOrder($order_reference, $payment_free = false){
      
        //Datos necesarios para la generación de la orden
        
        Log::info('Generación de la orden');
        $order = Order::where('order_reference', $order_reference)->first();
        if(!isset($order)){

            $pending = Pending::where('reference',$order_reference)->first();
            $ticket_order = json_decode($pending->value, true);
    
            $transaction_data = isset($ticket_order['transaction_data']) ? $ticket_order['transaction_data'] : time();
            $request_data = $ticket_order['request_data'];
            $event_id = $ticket_order['event_id'];
            $event = Event::findOrFail($ticket_order['event_id']);
            Log::info("creamo la orden: " . json_encode($ticket_order));
            //Datos necesarios para la generación de la orde
            //Si existe la orden generamos el proceso frente a la orden existente, si no existe la creamos
            $order =  new Order($request_data);
            /*
            * Create the order
            */
            if (isset($ticket_order['transaction_id'])) {
                $order->transaction_id = $ticket_order['transaction_id'][0];
            }
            if ($ticket_order['order_requires_payment'] && !isset($request_data['pay_offline'])) {
                $order->payment_gateway_id = $ticket_order['payment_gateway']['id'];
            }
            //Guardamos cada uno de los datos de la orden
           //var_dump(Auth::id());die;
	    $order->first_name = $payment_free ? Auth::user()->displayName : strip_tags($request_data['order_first_name']);
            $order->last_name =  $payment_free ? null : strip_tags($request_data['order_last_name']);
            $order->email = isset($ticket_order['transaction_data']["email"]) ? $ticket_order['transaction_data']["email"] : Auth::user()->email;
            $order->order_status_id = $payment_free ?  config('attendize.order_complete') : config('attendize.order_awaiting_payment');
            $order->amount = $ticket_order['order_total'];
            $order->booking_fee = $ticket_order['booking_fee'];
            $order->organiser_booking_fee = $ticket_order['organiser_booking_fee'];
            $order->account_id = $event->account->id;
            $order->event_id = $ticket_order['event_id'];
            $order->is_payment_received = isset($request_data['pay_offline']) ? 0 : 1;
            $order->session_id = isset($ticket_order['transaction_data']) ? $ticket_order['transaction_data']['session_id'] : time();
            $order->order_reference = $order_reference;
            $order->discount = isset($ticket_order['discount'])? $ticket_order['discount'] : 0.00;
            if(isset($ticket_order['code_discount']) || isset($ticket_order['total_ticket_quantity'])){
                $order->discount_description =  isset($ticket_order['code_discount'])? 
                    'Descuento  del '.$ticket_order['percentage_discount'].'% por el código '.$ticket_order['code_discount'] :
                    'Descuento  del '.$ticket_order['percentage_discount'].'% por '.$ticket_order['total_ticket_quantity'].' tickets comprados';
            }
            // Calculating grand total including tax
            $orderService = new OrderService($ticket_order['order_total'], $ticket_order['total_booking_fee'], $event);
            $orderService->calculateFinalCosts();
            $order->taxamt = $orderService->getTaxAmount();
            $order->url = isset($transaction_data['url_redirect']) ? $transaction_data['url_redirect'] : '';
            $order->save();

            //Cancelación de código promocional
            if(isset($ticket_order['code_discount']) ){
                $codes = $event->codes_discount;
                foreach($codes as $key => $code){
                    if($code['id'] == $ticket_order['code_discount']){
                        if (isset($codes[$key]['quantity']) ) {
                            $codes[$key]['quantity'] = $codes[$key]['quantity'] - 1;
                            if (($codes[$key]['quantity']) == 0 ) {
                                $codes[$key]['available'] = false;
                            }
                        } else {
                            $codes[$key]['available'] = false;
                        }
                        $event->codes_discount = $codes;
                        $event->save();
                        break;
                    }
                }
            }
        }
        return $order;
    }
    /**
     * Shows the tickets for an order - either HTML or PDF
     *
     * @param Request $request
     * @param $order_reference
     * @return \Illuminate\View\View
     */
    public function showOrderTickets(Request $request, $order_reference)
    {
        $order = Order::where('order_reference', '=', $order_reference)->first();
        
        if (!$order) {
            abort(404);
        }
        /* Se cargan los datos que se van a utilizar en el PDF */
        $date = new \DateTime();
        $today =  $date->format('d-m-Y');
        $logo_evius = 'images/logo.png';
        $event = Event::findOrFail($order->event_id);
        $stages = $event->event_stages;
        $eventusers = Attendee::where('order_id', $order->id)->get();
        //$location = $event["location"]["FormattedAddress"];
        
        foreach ($eventusers as $eventuser) { 
            
            /* Se genera el QR Code */
            ob_start(); 
            $qr = QrCode::text($eventuser->id)->setSize(8)->png();
            $qr = base64_encode($qr);
            $page = ob_get_contents();
            ob_end_clean();
            $type = "png";
            $qr = 'data:image/' . $type . ';base64,' . base64_encode($page); 
            $eventuser->qr = $qr;

            /* Si es un evento con etapas continuas */
            if (isset($event->stage_continue)) { 
                $stage_id = isset($eventuser->ticket->stage_id) ? $eventuser->ticket->stage_id : null;
            }
        }
        /* Si es un evento con etapas continuas */
        if (isset($event->stage_continue)) { 
            foreach ($stages as $stage) { 
                if ($stage["stage_id"] == $stage_id) {
                    $stage_name = $stage["title"];
                    break;
                }
            }
        }

        $data = [
            'order' => $order,
            'event' => $order->event,
            'eventusers' => $eventusers,
            'today' => $date->format('d-m-Y'),
            'logo_evius' => 'images/logo.png',
            /* Si es un evento con etapas continuas */
            'stage' => isset($stage_name) ? $stage_name : "",
        ];
        
        //if ($request->get('download') == '1') {
        //    $pdf = PDF::loadview(
        //        'pdf_bookingConfirmed', $data
        //    );
        //    $pdf->setPaper(
        //        'legal',  'portrait'
        //    );
        //    return $pdf->download('Tickets.pdf');
        //}
        //return view(
        //    'pdf_bookingConfirmed', $data
        //);
    }

    /**
     * Process purshase status from placetopay via POST
     * (Rejected, accepted purshase)
     *
     * @param Request $request
     * @return void
     */
    public function paymentCompleted(Request $request)
    {
        Log::info("Petición retornado por PlaceToPay: ");
        $request = $request->json()->all();
        $status = $request['status']['status'];
        $order_reference = $request['reference'];
        return $this->changeStatusOrder($order_reference, $status);
    }

    /**
     * Process purshase status from PayU via POST
     * (Rejected, accepted purshase)
     *
     * @param Request $request
     * @return void
     */
    public function paymentCompletedPayU(Request $request)
    { 
        //Petition to PayU
        $orders = Order::where ('order_status_id', '5c4232c1477041612349941e')
        ->orWhere ('order_status_id', '5c4a299c5c93dc0eb199214a')
        ->where ('payment_gateway_id', '4')
        ->where('event_id', '5c3fb4ddfb8a3371ef79bd62')->get(); //Estado pendiente o en proceso de pago
        
        if (count($orders)) {
            $apiLogin = config('attendize.payment_test') ? 'pRRXKOl8ikMmt9u' : 'mqDxv0NbTNaAUmb';
            $apiKey = config('attendize.payment_test') ? '4Vj8eK4rloUd272L48hsrarnUA' : 'omF0uvbN3365dC2X4dtcjywbS7';
            $url = config('attendize.payment_test') ? 'https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi' : 'https://api.payulatam.com/reports-api/4.0/service.cgi';
            $data =  [
                        'test' => config('attendize.payment_test'),
                        "language"=> "en",
                        "command"=> "ORDER_DETAIL_BY_REFERENCE_CODE",
                        "merchant"=> [
                            "apiLogin"=> $apiLogin,
                            "apiKey"=> $apiKey,
                        ]
                    ];
            $changes = [];
            foreach($orders as $order){
                $order_reference =  $order->order_reference;
                if($order_reference){
                    $data["details"] = ["referenceCode" => $order_reference];
                    $client = new Client();
                    $response = $client->request('POST', $url, [
                        'body' => json_encode($data),
                        'headers' => [ 'Content-Type' => 'application/json' ]
                        ]);
                    $response = $response->getBody()->getContents();
                    $xml = simplexml_load_string($response);
                    $json = json_encode($xml);
                    $array = json_decode($json,TRUE);
                    // var_dump($order->order_reference);die;
                    if(isset($array['result']['payload']['order'])){
                        $status = isset($array['result']['payload']['order']['transactions']) 
                                ?  $array['result']['payload']['order']['transactions']['transaction']['transactionResponse']['state']
                                :  end($array['result']['payload']['order'])['transactions']['transaction']['transactionResponse']['state'];
                    } else{
                        $status = null;
                    }

                    if(!is_null($status)){
                            Log::info('order: '.$order_reference.' STATUSCURRENT: '.$order->orderStatus['name'].' STATUSPAYU: '.$status);
                            $response = $this->changeStatusOrder($order_reference, $status);
                            array_push($changes, [  'order' => $order_reference,
                                                    'estatus_before' => $order->orderStatus['name'],
                                                    'status_PayU' => $status,
                                                    'new_status' => $response->orderStatus['name']
                                                ]);
                    }
                }
            }
        }
        return $changes;
    }
    
    /**
     * Change Order Status
     * (Rejected, Approved, Pending, Cancelled)
     *
     * @param Request $request
     * @return void
     */
    public function changeStatusOrder($order_reference, $status){
        Log::info("Change Order: ".$order_reference.' Status: '.$status);
        $order = Order::where('order_reference', '=', $order_reference)->first();
        switch ($status) {
            case 'APPROVED':
            //Enviamos un mensaje al usuario si este estaba en otro estado y va  a pasar a estado completado.
            //Ademas de guardar el nuevo estado
                if($order->order_status_id != config('attendize.order_complete')){
                    $order->order_status_id= config('attendize.order_complete');
                    Log::info("Completamos la orden");
                    $this->completeOrder($order_reference); 
                    if(config('attendize.send_email')){
                        Log::info("Enviamos el correo");
                        $this->dispatch(new SendOrderTickets($order));
                    }
                }
                break;
            case 'REJECTED':
                $order->order_status_id= config('attendize.order_rejected');
                break;
            case 'PENDING':
                $order->order_status_id= config('attendize.order_pending');
                break;
            case 'CANCELLED':
                $order->order_status_id= config('attendize.order_cancelled');
                break;
            case 'FAILED':
                $order->order_status_id= config('attendize.order_failed');
                break;
            case 'DECLINED':
                $order->order_status_id= config('attendize.order_rejected');
                break;
            case 'EXPIRED':
                $order->order_status_id= config('attendize.order_rejected');
                break;
                
        }
        Log::info('Borramos el cache de la orden: '.$status);
        if($status != 'PENDING'){
         //    Log::info('Borramos el cache de la orden: '.$order_reference);
        }
        $order->save();
        Log::info('Estado guardado: '.$order_reference." order_reference: ".$order->orderStatus['name']);
        return $order;
    }

    /**
     * Process purshase status via GET
     * (Rejected, accepted purshase or pending)
     *
     * @param Request $request
     * @return void
     */
    public function completePayment(String $id)
    {
        $order_reference = $id;
        $order = Order::where('order_reference', $order_reference)->first();

        return response()->redirectToRoute('showOrderDetails', [
            'is_embedded' => $this->is_embedded,
            'order_reference' => $order->order_reference,
        ]);
    }

    /**
     * Show information about the order
     * (Rejected, accepted purshase or pending)
     *
     * @param Request $request
     * @return void
     */
    public function showOrderPaymentStatusDetails($order_reference, $cron = false)
    {
        $placetopay = new \Dnetix\Redirection\PlacetoPay([
            'login' => 'ff684c45a63f769d824994dcc1369fb9',
            'tranKey' => 'X1GIXSF2Dxtq0bfg',
            'url' => 'https://secure.placetopay.com/redirection/',
            'type' => \Dnetix\Redirection\PlacetoPay::TP_REST,
        ]);
        $order = Order::where('order_reference', '=', $order_reference)->first();
        $reference = $order_reference;
        $date = new \DateTime();
        $today = $date->format('d-m-Y');
        $order_total = $order->amount;
        $order_name = $order->first_name;
        $order_lastname = $order->last_name;
        $order_email = $order->email;

        //Respuesta de Placetopay del proceso de pago
        $response = $placetopay->query($order->session_id);
        $status =  $response->payment() ? $response->payment()[0]->status()->status() : $response->status()->status();
	    $request = $response->request();
        $payment = $response->payment() ? $request->payment() : '';
        $amount = $payment ? $payment->amount(): '0';
        $autorization = $response;
        $this->changeStatusOrder($order_reference, $status);
        if(!$cron){
            return view('Public.ViewEvent.EventPageDetailOrder', compact('request', 'status', 'amount', 'order_total', 'order_name', 'order_lastname', 'order_email', 'today', 'reference', 'payment'));
        }else{
            return $status;
        }   
    }

        /**
     * Show information about the order
     * (Rejected, accepted purshase or pending)
     *
     * @param Request $request
     * @return void
     */
    public function showOrderPaymentStatusDetailsPayU(Request $request, String $order_reference)
    {
        $order = Order::where('order_reference', '=', $order_reference)->first();
        $reference = $order_reference;
        $date = new \DateTime();
        $today = $date->format('d-m-Y');
        $order_total = $order->amount;
        $order_name = $order->first_name;
        $order_lastname = $order->last_name;
        $order_email = $order->email;

        if ($_REQUEST['transactionState'] == 4 ) {
            $status = "APPROVED";
        }
        
        elseif ($_REQUEST['transactionState'] == 6 ) {
            $status = "REJECTED";
        }
        
        elseif ($_REQUEST['transactionState'] == 104 ) {
            $status = "Error";
        }
        
        elseif ($_REQUEST['transactionState'] == 7 ) {
            $status = "PENDING";
        }
        
        else {
            $status=$_REQUEST['mensaje'];
        }
        $order_total = $_REQUEST['TX_VALUE'];
        $currency = $_REQUEST['currency'];
        $description = $_REQUEST['description'];

        $this->changeStatusOrder($order_reference, $status);
        return view('Public.ViewEvent.EventPageDetailOrder', compact('currency', 'description', 'status', 'amount', 'order_total', 'order_name', 'order_lastname', 'order_email', 'today', 'reference', 'payment'));
      
    }

    /**
     * showOrderPaymentStatusPaymentGateway
     *
     *  This controller get information of order by means of the order_reference, directly from payment gateway
     * 
     * @param string $order_reference
     * @param string $payment_gateway
     * @return void $status
     */
    public function showOrderPaymentStatusPaymentGateway(string $order_reference, string $payment_gateway)
    {
        switch ($payment_gateway) {
            case 'placetopay':
                $placetopay = new \Dnetix\Redirection\PlacetoPay([
                    'login' => 'ff684c45a63f769d824994dcc1369fb9',
                    'tranKey' => 'X1GIXSF2Dxtq0bfg',
                    'url' => 'https://secure.placetopay.com/redirection/',
                    'type' => \Dnetix\Redirection\PlacetoPay::TP_REST,
                ]);
                $order = Order::where('order_reference', '=', $order_reference)->first();
        
                //Rquest from placetopay of the payment process
                $response = $placetopay->query($order->session_id);
                $status =  $response->payment() ? $response->payment()[0]->status()->status() : $response->status()->status();
                break;
            case 'payu':
                $apiLogin = config('attendize.payment_test') ? 'pRRXKOl8ikMmt9u' : 'mqDxv0NbTNaAUmb';
                $apiKey = config('attendize.payment_test') ? '4Vj8eK4rloUd272L48hsrarnUA' : 'omF0uvbN3365dC2X4dtcjywbS7';
                $url = config('attendize.payment_test') ? 'https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi' : 'https://api.payulatam.com/reports-api/4.0/service.cgi';
                
                $data =  [
                        'test' => config('attendize.payment_test'),
                        "language"=> "en",
                        "command"=> "ORDER_DETAIL_BY_REFERENCE_CODE",
                        "merchant"=> [
                            "apiLogin"=> $apiLogin,
                            "apiKey"=> $apiKey,
                        ]
                    ];
                $data["details"] = ["referenceCode" => $order_reference];

                $client = new Client();
                $response = $client->request('POST', $url, [
                    'body' => json_encode($data),
                    'headers' => [ 'Content-Type' => 'application/json' ]
                ]);
                $response = $response->getBody()->getContents();
                $xml = simplexml_load_string($response);
                $json = json_encode($xml);
                $array = json_decode($json,TRUE);

                if(isset($array['result']['payload']['order'])){
                    $status = isset($array['result']['payload']['order']['transactions']) 
                            ?  $array['result']['payload']['order']['transactions']['transaction']['transactionResponse']['state']
                            :  end($array['result']['payload']['order'])['transactions']['transaction']['transactionResponse']['state'];
                } else{
                    $status = "NOT FOUND";
                }
                break;
            default:
               $status = "payment gateway NOT FOUND";
        }
        
        return $status;

    }

    /**
     * deleteOrdersPending
     *
     * @return void
     */

    public function deleteOrdersPending(){


        $yesterdayTime = Carbon::now()->subHours(25);
        // $orders = Order::where("order_status_id", config('attendize.order_awaiting_payment'))->where("created_at","<",$yesterdayTime)->first();
        $pendings = Pending::take(20)->get();


        // FIRST DELETED THE PENDINGS THAT NOT HAVE ORDERS, THIS WAS ORDERS THAT NEVER PASSED TO THE GATEWAY ARE PENDING
        foreach($pendings as $pending){
            $pending_session = json_decode($pending->value);
            if(isset($pending->reference)){
                $orderFinded =  Order::where("order_reference", $pending->reference)->first();
                // si se encontro una orden "esperando pago", significa que fue a la pasarela de pago y esperamos 24 horas
                // Si no fue encontrada liberamos la silla y borramos el pendiente de una vez
                if($orderFinded){
                    // Si la orden lleva mas de 24 horas
                    if(($orderFinded->created_at) <= $yesterdayTime){
                        //si tiene sillas
                        if($pending_session->seats_data ){
                            foreach($pending_session->seats_data as $seats_data){
                                //We changed the state orders
                                //GET KEY SECRET OF EVENT FOR DELETED SEATS IN API SEATS.IO
                                $seats_configuration = Event::select('seats_configuration')->where('_id',$pending_session->event_id)->first();
                                $event_key_secret = ($seats_configuration->seats_configuration)["keys"]['secret'];
                                if(isset($seats_data->chart->selectedSeats)){
                                    $seats = $seats_data->chart->selectedSeats;
                                    $event_chart = $seats_data->chart->config->event;
                                    $freeseats = $this->freeseats($event_key_secret, $event_chart, $seats);
                                    if($freeseats["status"]){
                                        $orderFinded->order_status_id =  config('attendize.order_cancelled');
                                        $orderFinded->order_status_message = config('attendize.message_cancelled_order_time');
                                        $orderFinded->save();
                                        $pending->forceDelete();
                                    }
                                }
                            }
                        }else{
                            $orderFinded->order_status_id =  config('attendize.order_cancelled');
                            $orderFinded->order_status_message = config('attendize.message_cancelled_order_time');
                            $orderFinded->save();
                            $pending->forceDelete();
                        }
                    }
      
                }else{
                    //si tiene sillas
                    if($pending_session->seats_data ){
                        foreach($pending_session->seats_data as $seats_data){
                            //GET KEY SECRET OF EVENT FOR forceDeleteD SEATS IN API SEATS.IO
                            $seats_configuration = Event::select('seats_configuration')->where('_id',$pending_session->event_id)->first();
                            $event_key_secret = ($seats_configuration->seats_configuration)["keys"]['secret'];
                            if(isset($seats_data->chart->selectedSeats)){
                                $seats = $seats_data->chart->selectedSeats;
                                $event_chart = $seats_data->chart->config->event;
                                $freeseats = $this->freeseats($event_key_secret, $event_chart, $seats);
                                if($freeseats["status"]){
                                    $pending->forceDelete();
                                }
                                
                            }else{
                                //enviamos mensaje de error
                            }
                        }
                        // $pending->forceDelete();
                    }else{
                        $pending->forceDelete();
                    }
                }
                
            }
            else{
                // aca me envia un mensaje de error;
                $pending->forceDelete();
            }
        }

        return ['status' => true,
                'quantity' => Pending::count()
        ];
    }

    public function freeseats($event_key_secret, $event_chart, $seats){
        //we free seats 
        try {
            $seatsio = new \Seatsio\SeatsioClient($event_key_secret);      // key secret 
            $seatsio = $seatsio->events->release($event_chart, $seats);

            return ["status" => ($seatsio->objects) ? true : false ];

        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->messages(), "\n";
        }
    }
    /*
     * assignTicketsToPurchaser
     *
     * Assign all tickets to purchase.
     * @param string $order_reference
     * @param string $payment_gateway
     * @return void $status
     */
    public function assignTicketsToPurchaser(Request $request, Event $event, &$data)
    {
        $inputs = $request->all();
        $fields = $event->user_properties;
        $ticket_id = $request['ticket_id'];
        $ticket = Ticket::findOrFail($ticket_id);
        $cant = $ticket['number_person_per_ticket'];
        foreach ($fields as $field) { 
            $field_name = 'tiket_holder_'.$field['name'];
                $seed_value = $inputs[$field_name][0][$ticket_id];
                for ($i=1; $i<=$cant; $i++) {
                    /* cambiamos el valor nulo al nuevo valor*/
                    $data[$field_name][$i][$ticket_id] = $seed_value;
                }
        }

        return $data;

    }


        /**
     * postCreateOrder
     * Create the order, handle payment, update stats, fire off email jobs then redirect user
     *
     * @param Request $request
     * @param $event_id Request $request, $order_reference
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentEvius(Request $request, $order_reference)
    {

        $pending = Pending::where('reference',$order_reference)->first();
        if(isset($pending)){
            $ticket_order = json_decode($pending->value, true);
            $event = Event::findOrFail($ticket_order["event_id"]);
        }else{
            return "Orden No encontrada";
        }
        

        $ticket_order = $ticket_order["transaction_data"];
        return view('Public.ViewEvent.EventPagePaymentEvius', ['ticket_order' => $ticket_order, 'event' => $event ] );
    
    
    }
}

