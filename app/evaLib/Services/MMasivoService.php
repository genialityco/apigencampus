<?php

namespace App\evaLib\Services;

use GuzzleHttp\Client;
use App\Url;
use PUGX\Shortid\Shortid;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
/**
 * Undocumented class
 */
class MMasivoService
{
    public static function sendSms($body)
    {
        $client = new Client([
            'base_uri' => 'http://api.messaging-service.com/sms/1/text/',
           ]);
        
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . config('app.authorization_mmasivo'),
        ];

        $options['headers'] = $headers;
        $options['body'] = json_encode($body);

        $promise = $client->postAsync('single', $options)->then(
            function (ResponseInterface $res) {
                $response = $res->getBody()->getContents();
                echo("Mensaje enviado" . $response . "\n");
                return $response;
            },
            function (RequestException $e) {
		dd($e);
                return $e->getMessage();
            }
           );
    
           $response = $promise->wait();
    }

    public static function bodyInvitationEvent($name, $event_name, $link, $phone)
    {
        $link = config('app.evius_api') . '/invitation/' . $link;
        $body['to'] = $phone;
        $body['text'] = "¡Hola " . $name . "! Tu inscripción al evento " . $event_name . " ha sido exitosa. Puedes ingresar al evento mediante el siguiente enlace. ".$link. " ¡Te esperamos!";
        return $body;
    }

    public static function bodyCodeEventPMI($code, $survey_name, $phone)
    {
        $body['to'] = $phone;
        $body['text'] = "¡Muchas gracias por tomarse el tiempo de diligenciar la encuesta! El código PDU de la Conferencia ". $survey_name ." es " . $code;
        return $body;
    }

    public static function bodySurveyEventPMI($name, $survey_name, $link, $phone)
    {
        $link = config('app.evius_api') . '/invitation/' . $link;
        $body['to'] = $phone;
        $body['text'] = "¡Hola " . $name . "! La encuesta " . $survey_name . " ya está disponible. Inicia sesion y respondela mediante el siguiente enlace. Recuerda que el usuario y contraseña es el correo con el que te registraste " . $link ." ¡Te esperamos!";
        return $body;
    }

    // Body para enviar
    public static function sendGeneralSms(array $phones, string $textMessage)
    {
	$body['to'] = $phones;
	$body['text'] = $textMessage;
	return $body;
    }

    public static function filterSms(array $phones, string $textMessage, string $shortUrl)
    {
	$body['to'] = $phones;
	$body['text'] = "$textMessage $shortUrl";
	return $body;
    }

    // DEPRECATED
    public static function firstComunicationLG($phone)
    {
        //$link = config('app.evius_api') . '/invitation/' . $link;
        $body['to'] = $phone;
        $body['text'] =
            "¿Preparado para experimentar el sonido de una nueva manera? Te esperamos mañana en el Gran lanzamiento de la nueva línea de Audio de LG Electronics. \n\n  • Lugar: Sánchez Cervecería Artesanal - Cll 85 #12-25, Bogotá \n   • Fecha: 6 de octubre de 2022 \n   • Hora: 7:00 p.m. \n   • Dress code: Casual Bussines \n\n ¡Nos vemos pronto!";
        return $body;
    }

    public static function secondComunicationLG($phone)
    {
        $body['to'] = $phone;
        $body['text'] =
            "¡Llegó el gran día! Nos vemos hoy en el Gran lanzamiento de la nueva línea de Audio de LG Electronics. Te recordamos los datos del evento: \n\n• Lugar: Sánchez Cervecería Artesanal - Cll 85 #12-25, Bogotá \n• Fecha: 6 de octubre de 2022 \n• Hora: 7:00 p.m. \n• Dress code: Casual Bussines \n\n¡Nos vemos pronto!";
        return $body;
    }

    public static function eventoPrueba($phone, $shortUrl)
    {
        $body['to'] = $phone;
        $body['text'] = "Pronto iniciará nuestra maratón de formación para el trabajo. Recuerda que son 6 talleres acerca de las tendencias actuales, aprovecha esta oportunidad. Ingresa a $shortUrl";
        return $body;
    }

    public static function cursoMetaverso($phone, $shortUrl)
    {
        $body['to'] = $phone;
        $body['text'] = "Te invitamos hoy al taller \"Explorando el Metaverso. Conociendo nuevas oportunidades\" a partir de las 4:00 p.m. Ingresa a $shortUrl";
        return $body;
    }

    public static function cursoEmpreder($phone, $shortUrl)
    {
        $body['to'] = $phone;
        $body['text'] = "En una hora inicia el taller Cómo emprender en 3 sencillos pasos. Despierta el emprendedor que llevas dentro. Ingresa al siguiente link  $shortUrl";
        return $body;
    }
    public static function cursoProposito($phone, $shortUrl)
    {
        $body['to'] = $phone;
        $body['text'] = "Llega Gabriel Vallejo con su taller \"La magia de servir con Propósito\", Ingresa desde las 3:55pm al siguiente enlace: $shortUrl";
        return $body;
    }

    public static function tuMarcasLaDiferencia($phone, $shortUrl)
    {
        $body['to'] = $phone;
        $body['text'] = "Tu imágen tiene marca, y Edwin Zambrano nos enseñará a marcar la diferencia. Te esperamos para que renueves tu brand: $shortUrl";
        return $body;
    }

    public static function linkedin($phone, $shortUrl)
    {
        $body['to'] = $phone;
        $body['text'] = "Te esperamos a las 3:55pm con nuestro siguiente taller: \"8 pasos para encontrar empleo usando LinkedIn\" con Guillermo Gonzalez. Te invitamos a ingresar al siguiente enlace  $shortUrl";
        return $body;
    }

    public static function marketingDigital($phone, $shortUrl)
    {
        $body['to'] = $phone;
        $body['text'] = "Llega nuestro último taller. Te esperamos desde las 10:55am y disfruta de la compañía de Tati Uribe con \"Estrategias exitosas de marketing digital para este 2023.\" Conectate al enlace  $shortUrl";
        return $body;
    }
}
