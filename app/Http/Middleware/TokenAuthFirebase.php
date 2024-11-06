<?php

namespace App\Http\Middleware;

use App;
use App\Account;
use Closure;
use Firebase\Auth\Token\Verifier;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class TokenAuthFirebase
{

    protected $auth;

    public function __construct(\Kreait\Firebase\Auth $auth)
    {
        $this->auth = $auth;
    }    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        //Se carga el sdk de firebase para PHP
        try {
            $firebaseToken = null;

            //Se carga el projectID solo necesario para la libreria Auth
            $projectId = 'eviusauth';
            $verifier = new Verifier($projectId);

            //miramos si el token viene en la Petición
            if (isset($_REQUEST['evius_token'])) {
                $firebaseToken = $_REQUEST['evius_token'];
            } elseif (isset($_REQUEST['token'])) {
                $firebaseToken = $_REQUEST['token'];
            }

            //miramos si el token viene en una cookie
            /*if (isset($_COOKIE['evius_token'])) {
            $firebaseToken = $_COOKIE['evius_token'];
            } elseif (isset($_COOKIE['token'])) {
            $firebaseToken = $_COOKIE['token'];
            }*/

            if (!$firebaseToken) {
                return $next($request);
            }

            //Se verifica la valides del token
            $verifiedIdToken = $verifier->verifyIdToken($firebaseToken);
            //Se obtiene la informacion del usuario
            //Claim sub user_id
            $user_auth = $this->auth->getUser($verifiedIdToken->getClaim('sub'));
            $user = Account::where('uid', '=', $user_auth->uid)->first();

            if (!$user) {
                var_dump("vamos a crearlo");
                $user = Account::create(get_object_vars($user_auth));
                $user->save();
            }
         
            $request->attributes->add(['user' => $user]);
            var_dump("usurioauth");

            return $next($request);
        } catch (\Firebase\Auth\Token\Exception\ExpiredToken $e) {
            return $next($request);
        }
    }
}
//TEner en cuenta para Enviar mensajes de error
/* } catch (\Firebase\Auth\Token\Exception\ExpiredToken $e) {
echo $e->getMessage();
} catch (\Firebase\Auth\Token\Exception\IssuedInTheFuture $e) {
echo $e->getMessage();
} catch (\Firebase\Auth\Token\Exception\InvalidToken $e) {
echo $e->getMessage(); */
