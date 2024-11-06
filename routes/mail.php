<?php
/*
|--------------------------------------------------------------------------
| MAIL Routes
|--------------------------------------------------------------------------
| This is where you can register API routes to manage the email into 
| the diferents modules.
| 
*/
use Illuminate\Support\Facades\Route;

/****************
* RSVP
****************/
Route::get('rsvp/test', 'RSVPController@test');
Route::get('rsvp/{id}', 'MessageController@show');
Route::post('rsvp/sendeventrsvp/{event}', 'RSVPController@createAndSendRSVP');
Route::post('rsvp/events/{event}/messages/{message}/send-missing-mails', 'RSVPController@sendMissingMails');
Route::get('rsvp/confirmrsvp/{eventUser}', 'RSVPController@confirmRSVP');
Route::get('rsvp/confirmrsvptest/{eventUser}', 'RSVPController@confirmRSVPTest');
Route::get('events/{event}/messages', 'MessageController@indexEvent');
Route::put('events/{event}/updateStatusMessageUser/{message_id}', 'RSVPController@updateStatusMessageUser');


/***************
 * INVITATION
 ****************/
//Route::post("events/{event}/sendinvitation" , "InvitationController@SendInvitation");
Route::get('singinwithemail', 'InvitationController@singIn');
Route::get("events/{event}/indexinvitations/{user_id}", "InvitationController@invitationsSent");
Route::get("events/{event}/indexinvitationsrecieved/{user_id}", "InvitationController@invitationsReceived");
Route::put("events/{event}/acceptordecline/{id}", "InvitationController@acceptOrDeclineFriendRequest");
Route::get("events/{event}/contactlist/{user_id}", "InvitationController@indexcontacts");
Route::group(
    ['middleware' => 'auth:token'],
    function () {
        Route::post("events/{event}/meetingrequest/notify", "MeetingsController@meetingrequestnotify");
    }
);

Route::post("events/{event}/contactlist/{user_id}", "InvitationController@indexcontacts");
Route::apiResource("events/{event}/invitation", "InvitationController");
