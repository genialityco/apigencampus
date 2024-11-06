<?php

namespace App\Http\Controllers;

use Validator;
use App\Event;
use App\State;
use App\Account;
use App\Attendee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\evaLib\Services\FilterQuery;
use App\Http\Requests\EventUserRequest;
use App\Http\Resources\EventUserResource;
use App\evaLib\Services\UserEventService;



/**
 * @resource Attendee (Attendee)
 *
 * Handles the relation bewteeen user and event.  It handles user booking into an event
 * Account relation to an event is one of the fundamental aspects of this platform
 * most of the user functionality is executed under "Attendee" model and not directly
 * under Account, because is an events platform.
 * @see App\Http\Requests\EventUserRequest for parameters validation
 *
 * @see App\Http\Requests\EventUserRequest for parameters validation
 *
 * <p style="border: 1px solid #DDD">
 * Attendee has one user though user_id
 * <br> and one event though event_id
 * <br> This relation has states that represent the booking status of the user into the event
 * </p>
 */
class MecController extends Controller
{
    public function assingroles($event_id){
        $Attendees = Attendee::where("event_id",$event_id)->get();
        $attendees_size = $Attendees->count();
      
        for ($i=0;$i<$attendees_size;$i++){
            echo gettype($Attendees[$i]->rol_assistant);die;
        }
    }
}
