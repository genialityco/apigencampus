<?php
/**
 *
 */
namespace App\evaLib\Services;

use App\Activities;
use App\ActivityAssistant;

class ActivityAssistantService
{   

    public static function addActivityUser($event, $user)
    {
        $activities = Activities::where('event_id', $event->_id)->get(['_id']);
        
        foreach($activities as $activity)
        {                       
            ActivityAssistant::updateOrCreate(
                [   
                    'activity_id' => $activity->_id ,
                    'user_id'=> $user->_id
                ]
            );
        }

        return "Usuario registrado en todas las actividades";
    }
}
