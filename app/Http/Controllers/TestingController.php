<?php

namespace App\Http\Controllers;

use App;
use App\Account;
use App\Event;
use App\Extensions\payment_placetopay\src\Gateway;
use App\Jobs\ProcessTest;
use App\Jobs\SendOrderTickets;
use App\MessageUser;
use App\Order;
use Barryvdh\DomPDF\Facade as PDF;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Omnipay;
use QRCode;
use Spatie\Permission\Models\Permission;
use \App\Attendee;
use \App\Message;
use Illuminate\Support\Facades\Mail;
use Log;
//add to AwsNotification

// require '../vendor/autoload.php';

use Notification;

use Aws\Sns\MessageValidator;
use Aws\Sns\Exception\InvalidSnsMessageException;
//end of add to AwsNotification


class TestingController extends Controller
{
    public function getMessage(){

        $data = [
            'template'  => $template,
            'email'     => $email,
            'name'      => $name,
            'subject'   => $subject
        ];
        
        try {
          $this->dispatch(new SendNotificationEmail($this, $emailInfo, $data));
        } catch (Exception $e) {
          Log::error('Notification error' . $e->getMessage());
        }
        

    }


        
    

    public function awsnotification() {

        $data = [
            'response' => '0',
            'email_destinations' => '0',
            'status_message' => '0',
            'message_id' => '0',
            'timestamp_event' => '0'
        ];

        $messageUserModel = new MessageUser($data);
        
        // Log::info('$messageUserModel: '.$messageUserModel);

        $messageUserModel->save();            
        // return $messageUserModel->save();            
        return MessageUser::count();

        return $messageUserModel;                
    }
    public function serialization()
    {
        $eventuser = Attendee::find("5ee44aae1801874b5d124a15");

        return $eventuser->toJson();

    }

    public function testQueue()
    {
        ProcessTest::dispatch();
    }

    public function pendingOrders()
    {

    }

    public function resendOrder($order_id)
    {
        $order = Order::findOrFail($order_id);

        return $this->dispatch(new SendOrderTickets($order));

        return response()->json([
            'status' => 'success',
            'redirectUrl' => '',
        ]);
    }

    public function error()
    {
        return response(
            [
                'status' => 500,
                'message' => 'Error: Tremendo',
            ],
            500);
    }
    public function request($refresh_token)
    {
        $client = new Client();
        $url = "http://httpbin.org/post";
        $r = $client->request('POST', $url, ['form_params' => ['test' => 'test']]);
        var_dump(json_decode($r->getBody()));
        $url = "https://securetoken.googleapis.com/v1/token?key=" . "AIzaSyATmdx489awEXPhT8dhTv4eQzX3JW308vc";
        /**
         * Generamos el cuerpo indicando
         * el valor del refresh_token, e indicacndo que  el token se va a refrescar
         */
        $body = ['grant_type' => 'refresh_token', 'refresh_token' => $refresh_token];
        /**
         * Enviamos los datos a la url
         * Enviamos por metodo post el cuerpo por medio de la url asignada
         */

        $response = $client->request('POST', $url, ['form_params' => $body]);
        var_dump(json_decode($response->getBody()));
        //var_dump((string) $response->getContents());

        return [true];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function auth(\Kreait\Firebase\Auth $fireauth)
    {
        /*$o = new Account(
        [
        "name" => 'test' . time(),
        "email" => 'apps' . time() . "@mocionsoft.com",
        ]
        );
        $o->save();
        return $o;
         */
        $u = Account::find("5bc51599cb22e0643e006173");
        $u->save();
        $r = $u;
        return $r;
    }

    public function sendemail(Request $request)
    {

        // $data = $request->json()->all();
        // $event_id = $id;
        // $event = Event::find($event_id);
        // $eventuser = $event->eventUsers()->first();
        // $eventuser->email = "felipe.martinez@mocionsoft.com";
        $email = "juan.lopez@evius.co";
        $image = "https://storage.googleapis.com/herba-images/evius/events/8KOZm7ZxYVst444wIK7V9tuELDRTRwqDUUDAnWzK.png";
        $message = "mensaje";
        $subject = "[Invitación Máxim] kraken en Colombia";

        $messageContent = [
            "message"=>"contenido de prueba",
            "subject"=>"pruebas evius",
            "email_user"=>"juan.lopez@evius.co",
            "name"=>"carlos",
            ];

        Mail::to($email)
           ->send(
               new \App\Mail\genericMail($messageContent)
           );
        return "ok";
        /*

    // var_dump($mail->build());
    Mail::to('juan.lopez@mocionsoft.com')
    ->send(new RSVP( $message, $event,$eventuser,$image,$subject ));
    var_dump(Mail::failures());
    return "ok";*/

    }
    public function sendemail2()
    {
        return "ahi";
    }

    public function pdf()
    {
        $event = 'evento de prueba generar pdf';
        $eventuser = 'cesar barriosnuevos';
        $ticket_id = 12345;
        $attachPath = url()->previous() . '/api/generatorQr/5bd9959672b12737b359c722';
        $date = '31/10/2018';

        $pdf = PDF::loadview('pdf_bookingConfirmed', compact('event', 'eventuser', 'ticket_id', 'attachPath', 'date'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->download('example.pdf');
    }

    public function qrTesting()
    {
        $file = 'qr/prueba2_qr.png';
        $image = QRCode::text("prueba2")
            ->setSize(8)
            ->setMargin(4)
            ->setOutfile($file)
            ->png();
        return $file;
    }

    public function permissions()
    {
        return Permission::all();
    }

    public function Gateway0()
    {

        $placetopay = new \Dnetix\Redirection\PlacetoPay([
            'login' => 'f7186b9a9bd5f04ab68233cd33c31044',
            'tranKey' => '3ZNdDTNP0Uk1A28G',
            'url' => 'https://test.placetopay.com/redirection/',
            'type' => \Dnetix\Redirection\PlacetoPay::TP_REST,
        ]);

        $reference = '123456789';
        $request = [

            "payer" => [
                "name" => "DIANA FULTON",
                "surname" => "Yost",
                "email" => "flowe@anderson.com",
                "documentType" => "CC",
                "document" => "1848839248",
                "mobile" => "3006108300",
                "address" => [
                    "street" => "703 Dicki Island Apt. 609",
                    "city" => "North Randallstad",
                    "state" => "Antioquia",
                    "postalCode" => "46292",
                    "country" => "US",
                    "phone" => "363-547-1441 x383",
                ],
            ],
            "buyer" => [
                "name" => "DIANA FULTON",
                "surname" => "Yost",
                "email" => "flowe@anderson.com",
                "documentType" => "CC",
                "document" => "1848839248",
                "mobile" => "3006108300",
                "address" => [
                    "street" => "703 Dicki Island Apt. 609",
                    "city" => "North Randallstad",
                    "state" => "Antioquia",
                    "postalCode" => "46292",
                    "country" => "US",
                    "phone" => "363-547-1441 x383",
                ],
            ],
            'payment' => [
                'reference' => $reference,
                'description' => 'Testing payment',
                'amount' => [
                    'currency' => 'COP',
                    'total' => 120000,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://evius.co/response?reference=' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $response = $placetopay->request($request);
        if ($response->isSuccessful()) {
            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            return $response->processUrl();
            // header('Location: ' . $response->processUrl());
        } else {
            // There was some error so check the message and log it
            var_dump($response->status());die;
        }
    }

    public function Gateway()
    {

        $gateway = Omnipay::create('placetopay');
        return $gateway->initialize();
        return $gateway->getName();

    }

    public function orderSave($order_id)
    {
        $order = Order::find($order_id);
/*         $event = Event::find($order->event_id);
$event_properties = $event->user_properties;
$attendees_order = $order->attendees;
$amount = 0;

//Vamos a recorrer los asistentes que contiene una orden
foreach($attendees_order as $attendee){
//Capturarmos los campos con su valor de los asistentes que contienen una orden
$properties = $attendee->properties;
//Recorremos las propiedades del asistente
//Recorremos las propiedades del asistente
//Recorremos las propiedades del asistente
//Recorremos las propiedades del asistente
//Recorremos las propiedades del asistente
//Recorremos las propiedades del asistente
//Recorremos las propiedades del asistente
foreach($properties as $key_attendize=>$attendize){
//Recorremos los campos definidos en el evento para encontrar cual tiene monto
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
$order->amount = $amount+$order->amount;
return $order->amount; */
        $order->save();
    }

}