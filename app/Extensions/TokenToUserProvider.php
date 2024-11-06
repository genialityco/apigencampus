<?php

namespace App\Extensions;

use App\Account;
use App\Token;
use Firebase\Auth\Token\Exception\ExpiredToken;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Log;
use \Exception;

class TokenToUserProvider implements UserProvider
{
    protected $auth;
    protected $token;
    protected $user;
    protected $id;

    public function __construct(Account $user)
    {
        $this->user = $user;
        $this->auth = resolve('Kreait\Firebase\Auth');
        $this->id = microtime();

    }
    public function retrieveById($identifier)
    {
        return $this->user->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        /*
         * Se verifica la valides del token
         * Si este se encuentra activamos la función validator, el cual nos devuelve el
         * usuario
         */
        try {

            try {
                $verifiedIdToken = $this->auth->verifyIdToken($token);

                $user = $this->findUserByUID($verifiedIdToken);
                if (!$user)
                throw new AuthenticationException("Issues with this user please contact admin");

                Log::debug("finish auth: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . " ");

            } catch (ExpiredToken | InvalidToken $e) {
                //Intentamos refrescar el token antes de fallar
                $outter_message = $e->getMessage();

                //Primero miramos si el error trae el token consigo
                if (!method_exists($e, 'getToken')) {
                    throw new Exception($e->getMessage());
                }

                $claims = $e->getToken()->claims()->get('sub');
                $claims = ((array) $claims);
                $user_id = $claims['user_id'];

                $user = $this->signInWithRefreshToken($user_id, $outter_message);
                header('new_token:' . $user->token);

            }
            //| \InvalidArgumentException
        } catch (\Exception $e) {
            Log::debug("bug: " . $e->getMessage());
            throw new AuthenticationException($e->getMessage());
        }
        return $user;

    }
    private function signInWithRefreshToken($user_id, $outter_message = "")
    {
        /*
         * Capturamos el usuario a partir del uid el cual se encuentra en el token codificado
         * y recuperamos el refresh_token
         */

        $user = Account::where('uid', (string) $user_id)->first();
        $refresh_token = $user->refresh_token;

        if (!$refresh_token) {
            throw new Exception($outter_message . ' and  no refresh token found');
        }

        $signInResult = $this->auth->signInWithRefreshToken($refresh_token);

        if (!$signInResult->accessToken()) {
            throw new Exception($outter_message . ' and new token could not be generated');
        }

        $token = $signInResult->accessToken();
        $user->token = $token;
        return $user;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // update via remember token not necessary
    }
    public function retrieveByCredentials(array $credentials)
    {

        //array(2) { ["email"]=> string(19) "apps@mocionsoft.com" ["password"]=> string(11) "mocion.2040" }

        // implementation upto user.
        // how he wants to implement -
        // let's try to assume that the credentials ['username', 'password'] given
        $user = $this->user;
        $query = get_class($user)::query();
        foreach ($credentials as $credentialKey => $credentialValue) {
            if (strpos($credentialKey, 'password') === false) {
                $query = $query->where($credentialKey, $credentialValue);

            }
        }

        return $query->first();

    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $email = $credentials["email"];
        $password = $credentials["password"];
        $userfb = null;
        try {
            $userfb = $this->auth->verifyPassword($email, $password);
            //Kreait\Firebase\Exception\Auth\InvalidPassword
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
            //if ($request->expectsJson()) {
            //throw new AuthenticationException($e->getMessage());
            //} else {
            return false;
            //}
        }

        //Cookie::queue("Authorization", 'Bearer ' + $token);
        //Cookie::queue("token", $token);
        return true;
    }

    /**
     * Validator
     *
     * Esta función sigue el siguiente proceso
     *
     * 1. Capturamos el usuario autenticado a partir del id token verificado
     * 2. Capturamos los datos del usuario dentro de nuestra base de datos
     * 3. Si no existe el usuario lo crea.
     * 4. Guardamos un nuevo camo llamado refresh_token
     * 5. Guardamos el usaurio y lo retornamos.
     *
     * @param array $verifiedIdToken
     * @param string $refresh_token
     * @return $user
     */
    public function findUserByUID($verifiedIdToken)
    {

        Log::debug("buscando un usuario:" . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
	$user_auth = $this->auth->getUser($verifiedIdToken->claims()->get('sub'));
        $user = Account::where('uid', '=', $user_auth->uid)->first();

        return $user;
    }
}
