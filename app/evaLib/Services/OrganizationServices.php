<?php


namespace App\evaLib\Services;
use App\Organization;
use App\Event;
use App\UserProperties;
use App\Attendee;
use App\Rol;
use App\RolesPermissions;
use Log;



class OrganizationServices 
{
    public static function createDefaultUserProperties($organization_id)
    {
        /*Crear propierdades names, email, picture*/
        $model = Organization::find($organization_id);
        $name = array("name" => "email", "label" => "Correo", "unique" => false, "mandatory" => false, "type" => "email");
        $user_properties = new UserProperties($name);
        $model->user_properties()->save($user_properties);

        $email = array("name" => "names", "label" => "Nombres Y Apellidos", "unique" => false, "mandatory" => false, "type" => "text");
        $user_properties = new UserProperties($email);
        $model->user_properties()->save($user_properties);
     

    }

    public static function createDefaultStyles($styles, $organization)
    {

        $default_event_styles = config('app.default_event_styles');
        $stlyes_validation = $default_event_styles;
        if(isset($styles))
        {   

            $stlyes_validation = array_merge($default_event_styles, $styles);
        }
        $organization->styles = $stlyes_validation;
        $organization->save();
        return $stlyes_validation;
    }

    /**
     * This endpoint create an user in all events of the organization
     */
    public static function createMembers($user)
    {   
        $events = Event::where('organizer_id', $user->organization_id)->get();
        foreach ($events as $event)
        {
            // The auto-attendee-creating needs the user has a position
            if (!$user->position) {
                // This user is ignored
                Log::debug("user " . $user->user->names . " does not have position - IGNORED");
                continue;
            }

//            Log::debug("event '" . $event->name . "' has " . count($event->position_ids) . " positions");
            if (is_countable($event->position_ids) && count($event->position_ids) > 0) {
                // This event was assigned to some positions
                if (!in_array($user->position["_id"], $event->position_ids)) {
                    // This user has position, but this is not in the event positions
                    Log::debug("user " . $user->names . " has position but is not in - IGNORED");
                    continue;
                }
                Log::debug("user " . $user->names . " has position - SIGNED IN");
            } else {
                Log::debug("user " . $user->names . " CAN be signed because the event is opened - SIGNED IN");
            }
            $attendee = Attendee::updateOrCreate(
                [
                    "account_id" => $user->account_id,
                    "event_id" => $event["_id"],  // I added this because each event has its owned attendee, right?
                ],
                [
                    "properties" => $user->properties,                    
                    "rol_id" => $user->rol_id,
                    "event_id" => $event->_id
                ]
            );

            $rol = $user->rol_id; 
            if ($user->rol_id !== Rol::ID_ROL_ADMINISTRATOR &&  $user->_id !== Rol::ID_ROL_ATTENDEE)    
            {   
                // I understand that: Create a new rol
                $newRol = Rol::updateOrCreate(
                    [
                        "name" => $user->rol->name,
                        "event_id" => $event->_id,
                    ]
                );

                $newRol->save();

                $rolesPermissions = RolesPermissions::where('rol_id', $user->rol_id)->get();
                
                // I understand that: create a relationship between the current role and a basic permission
                foreach ($rolesPermissions as $rolPermission)
                {
                    $newRolPermission = RolesPermissions::updateOrCreate(
                        [
                            "rol_id" => $newRol->_id,
                            "permission_id" => $rolPermission->permission_id,
                        ]
                    );
                    $newRolPermission->save();
                }

            }        
            
            $attendee->save();
        }
        
        return "Creating successful attendees";
    }
}