<?php
/**
 *
 */
namespace App\evaLib\Services;

use App\Event;
use App\Attendee;
use App\Account;



/**
 * Undocumented class
 */
class UserImportService
{



    /**
     * Add Users to an event in draft status
     *
     * @param Event       $event    Where users are going to be added
     * @param Array[Account] $usersIds Users to be added
     * 
     * @return Attendee             eventUsers(attendees) added to the event
     */
    public static function addUsersToAnEvent(Event $event, $usersIds)
    {
        //cargamos varios Attendee por UserId.
        $eventUsers = Attendee::where('event_id', '=', $event->id)
            ->whereIn('account_id', $usersIds)
            ->get();

        $usersIdNotInEvent = self::getusersIdNotInEvent($eventUsers, $usersIds);

        foreach ($usersIdNotInEvent as $userId) {
            //Crear Attendee
            $eventUser = new Attendee;
            $eventUser->event_id = $event->id;
            $eventUser->account_id = $userId;
            $eventUser->save();
            $eventUsers[] = $eventUser;
        }
        return $eventUsers;
    }

    private static function getusersIdNotInEvent($eventUsers, $usersIds)
    {
        $usersIdNotInEvent = array_filter($usersIds, function ($userId) use ($eventUsers) {
            $userIsInEvent = false;

            if (!$eventUsers || !count($eventUsers)) {
                return !$userIsInEvent;
            }

            foreach ($eventUsers as $eventUser) {
                if (isset($eventUser->account_id) && $eventUser->account_id == $userId) {
                    $userIsInEvent = true;
                }
            };
            return !$userIsInEvent;
        });

        return $usersIdNotInEvent;
    }
}
