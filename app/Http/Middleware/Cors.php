<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    protected $id;

    public function __construct()
    {
        $this->id = microtime();
    }
    public function handle($request, Closure $next)
    {
        $originURL = config('app.front_url').""; //$originURL = "http://localhost";

        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $originURL = $_SERVER['HTTP_ORIGIN'];

        } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $originURL = $_SERVER['HTTP_REFERER'];

        } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            $originURL = $_SERVER['REMOTE_ADDR'];
        }
        $response = $next($request);
        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';
        $headers = [
            'Access-Control-Allow-Origin' => $originURL,
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, PATCH, DELETE',
            'Access-Control-Allow-Headers' => 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Authorization , Access-Control-Request-Headers, X-XSRF-TOKEN, new_token',
            'Access-Control-Allow-Credentials' => 'true',
            'Vary'=> 'origin'
        ];
        
        
        if($response instanceof $IlluminateResponse) {
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }
            return $response;
        }
        
        if($response instanceof $SymfonyResopnse) {
            foreach ($headers as $key => $value) {
                $response->headers->set($key, $value);
            }
            return $response;
        }
        
        return $response;
    }

}