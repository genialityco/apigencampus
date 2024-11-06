<?php

namespace App\Extensions;

use Cookie;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Auth\SessionGuard;
use \Illuminate\Contracts\Session\Session;

class TokenOrSessionGuard extends SessionGuard
{
    use GuardHelpers;
    private $inputKey = '';
    private $storageKey = '';
    protected $request;

    public function __construct($name, UserProvider $provider, Session $session, Request $request, $configuration)
    {   //die("TokenOrSessionGuard");
        $name = 'session';
        parent::__construct($name, $provider, $request->session(), $request, $configuration);
        $this->provider = $provider;
        $this->request = $request;
        // key to check in request
        $this->inputKey = isset($configuration['input_key']) ? $configuration['input_key'] : 'token';
        // key to check in database
        $this->storageKey = isset($configuration['storage_key']) ? $configuration['storage_key'] : 'token';
        
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if ($this->loggedOut) {
            return;
        }
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (! is_null($this->user)) {
            return $this->user;
        }
        $id = $this->session->get($this->getName());
        // First we will try to load the user using the identifier in the session if
        // one exists. Otherwise we will check for a "remember me" cookie in this
        // request, and if one exists, attempt to retrieve the user using that.
        $user = null;
        if (! is_null($id)) {
            if ($user = $this->provider->retrieveById($id)) {
                $this->fireAuthenticatedEvent($user);
            }
        }

        //try to load user from token
        if (is_null($user)){
            $token = $this->_getTokenForRequest();
            if (!empty($token)) {
                // the token was found, how you want to pass?
                $user = $this->provider->retrieveByToken($this->storageKey, $token);
                $this->updateSession($user->getAuthIdentifier());
                $this->fireAuthenticatedEvent($user);            
            }
        }


        // If the user is null, but we decrypt a "recaller" cookie we can attempt to
        // pull the user data on that cookie which serves as a remember cookie on
        // the application. Once we have a user we can return it to the caller.
        $recaller = $this->recaller();
        if (is_null($user) && ! is_null($recaller)) {
            $user = $this->userFromRecaller($recaller);
            if ($user) {
                $this->updateSession($user->getAuthIdentifier());
                $this->fireLoginEvent($user, true);
            }
        }
        return $this->user = $user;
    }

    /**
     * Get the token for the current request.
     * @return string
     */
    protected function _getTokenForRequest()
    {
        $token = Cookie::get($this->inputKey);

        if (empty($token)) {
            $token = $this->request->query($this->inputKey);
        }

        if (empty($token)) {
            $token = $this->request->query('evius_token');
        }

        if (empty($token)) {
            $token = $this->request->input($this->inputKey);
        }

        if (empty($token)) {
            $token = $this->request->bearerToken();
        }

        return $token;
    }
}