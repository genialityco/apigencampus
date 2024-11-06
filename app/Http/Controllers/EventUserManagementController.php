<?php

namespace App\Http\Controllers;

use App\Account;
use App\Attendee;
use App\Event;
use App\Http\Requests\EventUserRequest;
use App\Http\Resources\EventUserResource;
use App\State;
use Illuminate\Http\Request;

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
class EventUserManagementController extends Controller
{

    //Tickets id de bancolombia
    //5ecee1cb4e08757151b063fb Planeación estratégica
    //5e835fbad74d5c6d246f7895 Innovación
    //5e835f95d74d5c6d246f7894 Marketing Digital
    //5e835f66d74d5c6cfd379995 Planeación Financiera

    public function makeTicketIdaProperty(Request $request, String $event_id, String $ticket_id)
    {
        $query = Attendee::where("event_id", $event_id)
            ->where("ticket_id", $ticket_id);
        //->where("account_id", "5b89bf37c065864f7b5bf80e");
        //return $eventUsers = $query->get()->count();
        $eventUsers = $query->get()->all();
        $i = 0;
        foreach ($eventUsers as $eventuser) {
            $i++;
            $propiedades = $eventuser["properties"];
            $propiedades["ticketid"] = $eventuser->ticket_id;
            $eventuser["properties"] = $propiedades;
            $eventuser->save();
        }

        return $i; //$eventUsers;
    }

    public function asignTicketsToUser(Request $request, String $event_id, String $user_id, $tickets = [])
    {

        $tickets = ["5ecee1cb4e08757151b063fb", "5e835fbad74d5c6d246f7895", "5e835f95d74d5c6d246f7894", "5e835f66d74d5c6cfd379995"];

        $query = Attendee::where("event_id", $event_id)
            ->where("account_id", $user_id);
        $eventUsers = $query->get()->all();

        $eventUser = current($eventUsers);
        $eventUserTemplate = $eventUser;

        foreach ($tickets as $ticket_id) {

            if (!$eventUser) {
                $clonedEventuser = $eventUserTemplate->replicate();
                $clonedEventuser->ticket_id = $ticket_id;
                $clonedEventuser->save();
                $eventUser = $clonedEventuser;
                echo "<p>{$clonedEventuser->_id}</p>";
            }
            $eventUser->ticket_id = $ticket_id;

            $eventUser = next($eventUsers);

        }

        die;

        return;
        $clonedEventuser->save();
        var_dump($clonedEventuser);die;
        return EventUserResource::collection($results);

    }
}