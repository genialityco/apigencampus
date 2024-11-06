<?php

namespace App\evaLib\Services;

use Twilio\Rest\Client;
/**
 * Undocumented class
 */
class SmsService
{
    public static function sendSms($number, $body)
    {
        $account_sid = '';
        $auth_token = '';
        $twilio = new Client($account_sid, $auth_token);
        
        $message = $twilio->messages
            ->create($number, // to
                [
                    "from" => "+19032251131",
                    "messagingServiceSid" => "MG1d774f772551ca47d19be4736bae073c",
                    "body" => $body,
                ]
            );
            //dd($message);
    }

    public static function bodyInvitationEvent($name, $event_name, $link)
    {
        $link = config('app.evius_api') . '/invitation/' . $link;
        $body = "¡Hola " . $name . "! Tu inscripción al evento " . $event_name . " ha sido exitosa. Puedes ingresar al evento mediante el siguiente enlace. ".$link. " ¡Te esperamos!";
        return $body;
    }

    public static function bodyCodeEventPMI($name, $survey_name, $code)
    {
        $body = "¡Hola " . $name . "! El código asociado a la encuesta " . $survey_name . " es el siguiente: " . $code . ". ¡Gracias por participar!";
        return $body;
    }

    public static function bodySurveyEventPMI($name, $survey_name, $link)
    {
        $link = config('app.evius_api') . '/invitation/' . $link;
        $body = "¡Hola " . $name . "! La encuesta " . $survey_name . " ya está disponible. Inicia sesion y respondela mediante el siguiente enlace. " . $link . " ¡Te esperamos!";
        return $body;
    }
}
