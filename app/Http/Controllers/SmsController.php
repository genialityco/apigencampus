<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\evaLib\Services\SmsService;
use App\evaLib\Services\WhatsappService;
use App\Event;
use App\Attendee;
use App\evaLib\Services\MMasivoService;

class SmsController extends Controller
{
    // Envia sms general para los asistentes
    public function generalSendSms(Request $request, Event $event)
    {
	$request->validate([
	    'text_message' => 'required|string'
	]);
    	$data = $request->json()->all();
	//IMPORTANTE: la propertie numeroCelular puedo tener otro nombre en user_properties, deben ser iguales
    	$phones  = Attendee::where('event_id', $event->_id)->pluck('properties.numeroCelular')->toArray();

	$numbersToSend = [];
	foreach($phones as $phone){
		array_push($numbersToSend, "57".$phone); //adicionar codigo de pais

	}

	// Enviar comunicado sms
	$body = MMasivoService::sendGeneralSms($numbersToSend, $data['textMessage']);
	MMasivoService::sendSms($body);

    	return ['total_sended' => count($numbersToSend), 'numbersToSend' => $numbersToSend];
    }

    // Envia sms filtrados, el filtro es relativo y depende lo que quiera cliente
    public function filterSendindSms(Request $request, Event $event)
    {
	$request->validate([
	    'text_message' => 'required|string',
	    'url' => 'required|string'
	]);

    	$data = $request->json()->all();
    	$attendees  = Attendee::where('event_id', $event->_id)->get();
    	# Filtrar
	$numbersToSend = [];
    	foreach($attendees as $attendee) {
	    $cursos = isset($attendee->properties['seleccionaEnQueTalleresDeseasParticiparPuedesElegirMasDeUnaOpcion']) ?
		$attendee->properties['seleccionaEnQueTalleresDeseasParticiparPuedesElegirMasDeUnaOpcion'] : null;
	    if(is_array($cursos)) {
		foreach($cursos as $curso){
		    $numberSms = isset( $attendee->properties['numeroCelular'] ) ?
			"57".$attendee->properties['numeroCelular'] : '573213905320'; //adicionar codigo de pais
		    $curso === "Estrategias exitosas de marketing digital para este 2023"
			&& array_push($numbersToSend, $numberSms);
		}
	    }
    	}

	$url = $data['url'];
	$shortUrl = WhatsappService::shortUrl($url);
	$body = MMasivoService::filterSms($numbersToSend, $data['text_message'], $shortUrl);
	MMasivoService::sendSms($body);

    	return ['numbersToSend' => $numbersToSend];
    }
            /*
            $event = Event::find('631b53e3b0c12034d2664b72');
            $has_extension = false;
            foreach ($event->user_properties as $propertie) {
                $has_extension = $propertie->name == 'extension' ? true : false;
            }
            if ($has_extension) {
                //$eventUser = Attendee::find('631b8ff2740d784e53256272');
                $eventUser = Attendee::find('631f3ef64e43b153c404d773');
                $code = $eventUser["properties"]["code"];
                $codeWhatsapp = substr($code, 1);//sin el +
                $number = $eventUser["properties"]["extension"];
                $numberWhatsapp = $codeWhatsapp . $number;
    
                $auth = resolve('Kreait\Firebase\Auth');
                $email = $eventUser->properties["email"];
                //$email = 'andres.cadena@evius.co';
                $link = '';
                $firebasaUser = $auth->getUserByEmail($email);
                //dd($firebasaUser);
                if ($firebasaUser->emailVerified) {
                    //dd(config('app.front_url'));
                    $link = $auth->getSignInWithEmailLink(
                        $email,
                        [
                            "url" => config('app.front_url') . "/loginWithCode?email=". urlencode($email) . "&event_id=" . $event->id,
                        ]    
                    );
                    //dd($link);
                }else {
                    $link = $auth->getEmailVerificationLink(
                        $email,
                        [
                            "url" => config('app.front_url') . "/loginWithCode?email=". urlencode($email) . "&event_id=" . $event->_id,
                        ]    
                    );
                }
                $shortUrl = WhatsappService::getCode($link);
                $bodyWhatsapp = WhatsappService::templateButton(
                    $numberWhatsapp, 
                    $event->styles["banner_image"], 
                    $eventUser->properties["names"],
                    $event->name,
                    $shortUrl
                );
                WhatsappService::sendWhatsapp($bodyWhatsapp);
                dd("enviado");
                $numberSms = $code . $number;//con el +
                SmsService::sendSms($eventUser->properties["names"], $event->name, $numberSms, $shortUrl);
                //dd($eventUser);
            }
            //dd($has_extension);
            dd("send");
    
    
    
    
    
            $auth = resolve('Kreait\Firebase\Auth');
            $email = 'sebastian.rincon@mocionsoft.com';
            //$email = 'andres.cadena@evius.co';
            $link = '';
            $firebasaUser = $auth->getUserByEmail($email);
            //dd($firebasaUser);
            if ($firebasaUser->emailVerified) {
                //dd(config('app.front_url'));
                $link = $auth->getSignInWithEmailLink(
                    $email,
                    [
                        "url" => config('app.front_url') . "/loginWithCode?email=". urlencode($email) . "&event_id=" . '62ac94fae0349839442c1d76',
                    ]    
                );
                //dd($link);
            }
            //dd($firebasaUser);
    
    
            //dd($link);
    
            WhatsappService::sendWhatsapp(
                '525522993342', 
                'https://storage.googleapis.com/eviusauthdev.appspot.com/evius/events/9MPlNgPQXEFZmydJFIDEmGyHhZPQVn9QTJsjW2R8.png',
                'Mauro',
                'Capacitaciones Evius',
                $link
            );
            //dd('ok');
            //SmsService::sendSms('Andres', 'Capacitaciones Evius', '+525624590075', $link);
            dd("enviado");
            $nexmo = app('Nexmo\Client');
            $nexmo->message()->send([
                'to' => '+573143232830',
                'from' => 'Nexmo-Evius',
                'text' => 'Sms de prueba'
            ]);
            */
}
