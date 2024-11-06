<?php
/*
|--------------------------------------------------------------------------
| USER Routes
|--------------------------------------------------------------------------
| This is where you can register API routes to manage users in the different modules.
| 
*/
use Illuminate\Support\Facades\Route;

/****************
 * Users
 ****************/
Route::apiResource('users', 'UserController', ['only' => ['index', 'show', 'store']]);

Route::get('users/loginorcreatefromtoken', 'UserController@loginorcreatefromtoken');
//Se deja la ruta duplicada mientras en el front el cache se actualiza, con ruta 'users'
Route::get('user/loginorcreatefromtoken', 'UserController@loginorcreatefromtoken');
// Route::apiResource('users', 'UserController', ['only' => ['index', 'show']]);

Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::apiResource('users', 'UserController', ['except' => ['index', 'show', 'store']]);
        Route::get('users/currentUser', 'FireBaseAuthController@getCurrentUser');
        // Route::apiResource('users', 'UserController', ['except' => ['index', 'show']]);
        // Route::get('users/findByEmail/{email}', 'UserController@findrequireByEmail');
        // Route::get('users/findByEmail/{email}', 'UserController@findByEmail');
        
        Route::get('organization/{organization}/users', 'UserController@userOrganization');
        Route::get('users/me/totaluser', "UserController@usersOfMyPlan");
        Route::put('users/{user_id}/changeStatusUser', 'UserController@changeStatusUser');
    }
);
Route::post('validateEmail', 'UserController@validateEmail');
Route::post("users/signInWithEmailAndPassword", "UserController@signInWithEmailAndPassword");
Route::get('users/loginorcreatefromtoken', 'UserController@loginorcreatefromtoken');
Route::get('users/findByEmail/{email}', 'UserController@findByEmail');
Route::post('getloginlink', 'UserController@getAccessLink');
Route::get('singinwithemaillink', 'UserController@signInWithEmailLink');
Route::put("changeuserpassword", "UserController@changeUserPassword");
//Change one user password
Route::put("changeOneuserpassword/{user_id}", "UserController@updateOneUserPassword");
//Change many user passwords
Route::put("updatepasswordsbyevent/{event}", "UserController@updatePasswordsByEvent");
Route::put("updatePasswordsByEventToDefault/{event}", "UserController@updatePasswordsByEventToDefault");
Route::put("updatePasswordTo/{user}", "UserController@updatePasswordTo");
Route::get("attendees/{event}", "UserController@indexByEvent");

//Get magic link to signIn
Route::post('events/{event}/magicLink', 'UserController@getMagicLink');

// This route allows to send any kind of magic link with a customize content
Route::post("general-magic-link", "UserController@getGeneralMagicLink");
Route::get("get-magic-link", "UserController@getOnlyMagicLink");
Route::post("generic-mail", "UserController@getGenericMail");
