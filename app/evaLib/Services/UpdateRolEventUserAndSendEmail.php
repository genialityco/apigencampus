<?php

namespace App\evaLib\Services;
use App\Attendee;
use App\Rol;
use App\Mail\UserRolChangeMail;
use Mail;



class UpdateRolEventUserAndSendEmail 
{
    /**
     * 
     */
    public static function UpdateRolEventUserAndSendEmail($request, $event_id, $eventUser_id)
    {       
        $data = $request->json()->all();        
        if(isset($data['rol_id']))
        {
            $eventUser = Attendee::find($eventUser_id);
            $message = isset($data['message']) ? $data['message'] :'';

            $eventUser->fill($data);
            $eventUser->save();
            
            Mail::to($eventUser['properties']['email'])
                ->queue(
                    new UserRolChangeMail($event_id, $eventUser , $data['rol_id'], $message )
                );
            
            return $eventUser;
        }

        abort(400, 'rol_id is required');
        
    }
}