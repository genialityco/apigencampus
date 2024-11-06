<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
/**
 * @group User
 * This class is in charge of managing auth stuff which is implemented using firebase
 */
class FireBaseAuthController extends Controller
{
    /**
     * 
     * getCurrentUser: returns current user information using valid token send with the request.
     * 
     * returns current user information using valid token send with the request.
     * Token is processed  by middleware
     * @authenticated
     *
     * @param Request $request
     * @return Account user information using valid token send with the request.
     */
    public function getCurrentUser(Request $request)
    { 
              return (Auth::user()?Auth::user():null);
    }
}
