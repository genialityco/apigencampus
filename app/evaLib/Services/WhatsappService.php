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
class WhatsappService
{
    public static function sendWhatSapp($body)
    {
       $client = new Client([
        'base_uri' => config('app.base_uri'),
       ]);

       $headers = [
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . config('app.authorization'),
       ];

       $options['headers'] = $headers;

       $options['body'] = $body; //self::templateButton($number, $url_image, $user_name, $event_name, $signIn_url);


       $promise = $client->postAsync('messages', $options)->then(
        function (ResponseInterface $res) {
            $response = $res->getBody()->getContents();
            return $response;
        },
        function (RequestException $e) {
            return $e->getMessage();
        }
       );

       $response = $promise->wait();

    }

    public static function shortUrl($url)
    {
        $code = Shortid::generate();
        $code = strval($code);
        $newUrl["long_url"] = $url;
        $newUrl["code"] =  $code;
	$newUrl["short_url"] = config('app.evius_api') . '/invitation/' .$code;

        $saveUrl = Url::create($newUrl);

        return $saveUrl->short_url;

    }

    public static function getCode($url)
    {
        $code = Shortid::generate();
        $code = strval($code);
        $newUrl["long_url"] = $url; 
        $newUrl["code"] =  $code; 
        $newUrl["short_url"] = config('app.evius_api') . '/invitation/'. $code;

        $saveUrl = Url::create($newUrl);

        return $saveUrl->code;

    }

    public static function getCodeSurveyResponse($url)
    {
        $code = Shortid::generate();
        $code = strval($code);
        $newUrl["long_url"] = $url; 
        $newUrl["code"] =  $code; 
        $newUrl["short_url"] = config('app.evius_api') . '/invitation/'. $code;

        $saveUrl = Url::create($newUrl);

        return $saveUrl->code;

    }

    public static function templateLink($number, $url_image, $user_name, $event_name, $signIn_url)
    {
        $body['messaging_product'] = 'whatsapp';
        $body['to'] = $number;//number 573114461222
        $body['type'] = 'template';
        $body['template']['name'] = 'invitacion_link_copy';
        $body['template']['language']['code'] = 'es';
        $body['template']['components'][0]['type'] = 'header';
        $body['template']['components'][0]['parameters'][0]['type'] = 'image';
        $body['template']['components'][0]['parameters'][0]['image']['link'] = $url_image;//url image
        $body['template']['components'][1]['type'] = 'body';
        $body['template']['components'][1]['parameters'][0]['type'] = 'text';
        $body['template']['components'][1]['parameters'][0]['text'] = $user_name;//name
        //segundo parametro
        $body['template']['components'][1]['parameters'][1]['type'] = 'text';
        $body['template']['components'][1]['parameters'][1]['text'] = $event_name;//event name
        //tercer parametro
        $body['template']['components'][1]['parameters'][2]['type'] = 'text';
        $shortUrl = self::shortUrl($signIn_url);
        $body['template']['components'][1]['parameters'][2]['text'] = $shortUrl;//sign in link
        $body = json_encode($body);
        return $body;
    }

    public static function templateButton($number, $url_image, $user_name, $event_name, $signIn_url)
    {
        $body['messaging_product'] = 'whatsapp';
        $body['to'] = $number;//number 573114461222
        $body['type'] = 'template';
        $body['template']['name'] = 'dev_invitation';
        $body['template']['language']['code'] = 'es_MX';
        //header
        $body['template']['components'][0]['type'] = 'header';
        $body['template']['components'][0]['parameters'][0]['type'] = 'image';
        $body['template']['components'][0]['parameters'][0]['image']['link'] = $url_image;//url 
        //body
        $body['template']['components'][1]['type'] = 'body';
        //primer parametro
        $body['template']['components'][1]['parameters'][0]['type'] = 'text';
        $body['template']['components'][1]['parameters'][0]['text'] = $user_name;//name
        //segundo parametro
        $body['template']['components'][1]['parameters'][1]['type'] = 'text';
        $body['template']['components'][1]['parameters'][1]['text'] = $event_name;//event name
        //button
        $body['template']['components'][2]['type'] = 'button';
        $body['template']['components'][2]['sub_type'] = 'url';
        $body['template']['components'][2]['index'] = '0';
        $body['template']['components'][2]['parameters'][0]['type'] = 'text';
        $body['template']['components'][2]['parameters'][0]['text'] = $signIn_url;//sign in link
        //dd($body);

        $body = json_encode($body);
        return $body;
    }

    public static function templateButtonSurvey($number, $url_image, $user_name, $survey_name, $signIn_url)
    {
        $body['messaging_product'] = 'whatsapp';
        $body['to'] = $number;//number 573114461222
        $body['type'] = 'template';
        $body['template']['name'] = 'open_survey_noreply_1';
        $body['template']['language']['code'] = 'es';
        //header
        $body['template']['components'][0]['type'] = 'header';
        $body['template']['components'][0]['parameters'][0]['type'] = 'image';
        $body['template']['components'][0]['parameters'][0]['image']['link'] = $url_image;//url 
        //body
        $body['template']['components'][1]['type'] = 'body';
        //primer parametro
        $body['template']['components'][1]['parameters'][0]['type'] = 'text';
        $body['template']['components'][1]['parameters'][0]['text'] = $user_name;//name
        //segundo parametro
        $body['template']['components'][1]['parameters'][1]['type'] = 'text';
        $body['template']['components'][1]['parameters'][1]['text'] = $survey_name;//survey name
        //button
        $body['template']['components'][2]['type'] = 'button';
        $body['template']['components'][2]['sub_type'] = 'url';
        $body['template']['components'][2]['index'] = '0';
        $body['template']['components'][2]['parameters'][0]['type'] = 'text';
        $body['template']['components'][2]['parameters'][0]['text'] = $signIn_url;//sign in link
        //dd($body);

        $body = json_encode($body);
        return $body;
    }

    public static function templateCodePMI($number, $url_image, $user_name, $survey_name, $code)
    {
        $body['messaging_product'] = 'whatsapp';
        $body['to'] = $number;//number 573114461222
        $body['type'] = 'template';
        $body['template']['name'] = 'code_survey_noreply';
        $body['template']['language']['code'] = 'es_MX';
        $body['template']['components'][0]['type'] = 'header';
        $body['template']['components'][0]['parameters'][0]['type'] = 'image';
        $body['template']['components'][0]['parameters'][0]['image']['link'] = $url_image;//url image
        $body['template']['components'][1]['type'] = 'body';
        /*
        $body['template']['components'][1]['parameters'][0]['type'] = 'text';
        $body['template']['components'][1]['parameters'][0]['text'] = $user_name;//name
        */
        /*segundo parametro
        $body['template']['components'][1]['parameters'][1]['type'] = 'text';
        $body['template']['components'][1]['parameters'][1]['text'] = $survey_name;//survey name
        */
        $body['template']['components'][1]['parameters'][2]['type'] = 'text';
        $body['template']['components'][1]['parameters'][2]['text'] = $code;//code
        $body = json_encode($body);
        return $body;
    }
}
