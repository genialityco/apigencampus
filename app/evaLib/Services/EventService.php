<?php
/**
 *
 */
namespace App\evaLib\Services;

use App\Attendee;
use App\OrganizationUser;
use App\Account;
use App\Event;
use App\Organization;
use App\ModelHasRole;
use App\State;
use Storage;
use App\UserProperties;
class EventService
{   
    /**
     * _addOrganizationMenu_: add to Event the items menu of the organization. 
     */
    public static function addEventMenu($event)
    {   

        $organization = Organization::findOrFail($event->organizer_id);
         
        if(isset($organization->itemsMenu))
        {
            $event->itemsMenu = $organization->itemsMenu; 
            $event->save();
            return $event;
        }

        
        return 'No hay items en la organización';
    }

    /**
     * 
     */
    public static function AddDefaultStyles($styles, $event)
    {
        $default_event_styles = config('app.default_event_styles');

        $organization = Organization::findOrFail($event->organizer_id);
        
        if(isset($styles))
        {                       
            $stlyes_validation = array_merge($default_event_styles,$styles);            
        }else{         
            $stlyes_validation = array_merge($default_event_styles, $organization->styles);
        }

        $event->styles =  $stlyes_validation;
        $event->save();

        return $stlyes_validation;
    }


    public static function AddAppConfiguration($styles)
    {
        $default_event_styles = config('app.default_event_styles');
        $stlyes_validation = array_merge($default_event_styles, $styles);
        return $stlyes_validation;
    }

   /**
    * This end point is call when add document user in the event.
    */
    public static function addDocumentUserToEvent(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $event = Event::findOrFail($event_id);
        $event->extra_config->document_user = $data;
        $event->save();

        return $event;
    }

    /**
     * Add rol administrator in the event 
     */
    public static function addOwnerAsAdminColaborator($user, $event)
    {
        // Esta validación a futuro se va a quitar y solo el rol va a quedar en event user
        $DataUserRolAdminister = [
            "rol_id" => Event::ID_ROL_ADMINISTRATOR,
            "model_id" => $user->_id,
            "event_id" => $event->_id,
            "model_type" => "App\Account",
        ];
        $DataUserRolAdminister = ModelHasRole::create($DataUserRolAdminister);

        //Esta validación es la que va a quedar en eventUser
        $dataEventUserRolAdminister = [
            "rol_id" => Event::ID_ROL_ADMINISTRATOR,
            "account_id" => $user->_id,
            "event_id" => $event->_id,
            "model_type" => "App\Account",
            "properties" => [
                "names" => $user->names,
                "email" => $user->email,
            ]
        ];
        Attendee::create($dataEventUserRolAdminister);

        
        OrganizationUser::updateOrCreate(
            [
                "rol_id" => Organization::ID_ROL_ADMINISTRATOR,
                "account_id" => $user->_id,
                "organization_id" => $event->organizer_id,
            ],
            [
                "model_type" => "App\Account",
                "properities" => [
                "name" => $user->names,
                "email" => $user->email,
                ]
            ]
        );

        return $DataUserRolAdminister;
    }


    /**
     * _createDefaultUserProperties_: create default properties (name and email) for the user
     * 
     * @urlParam event_id required
     *
     * @param string $event_id
     * @return void
     */
    public static function createDefaultUserProperties($event_id)
    {
        /*Crear propierdades names, email, picture*/
        $model = Event::find($event_id);
        $organization = Organization::find($model->organizer_id);
        if(empty($organization->template_properties[0]))
        {   
            
            $name = array("name" => "email", "label" => "Correo", "unique" => false, "mandatory" => false, "type" => "email");
            $user_properties = new UserProperties($name);
            $model->user_properties()->save($user_properties);

            $email = array("name" => "names", "label" => "Nombres Y Apellidos", "unique" => false, "mandatory" => false, "type" => "text");
            $user_properties = new UserProperties($email);
            $model->user_properties()->save($user_properties);
        } else {   
            
            $properties =  $organization->template_properties[0]->user_properties;         
            foreach($properties as $propertie)
            {   
                $user_properties = new UserProperties($propertie);
                $model->user_properties()->save($user_properties);                
            }
            
        }         
    }

    /**
     * _assingOrganizer_: associate organizer to an event.
     * It could be "me"(current user) or a organization Id the relationship is polymorpic.
     * 
     * @bodyParam data array required organizer_id Exmaple : ['organizer_id']
     **/
    public static function assingOrganizer($data, $event)
    {
        if (!isset($data['organizer_id']) || $data['organizer_id'] == "me" || (isset($data['organizer_type']) && $data['organizer_type'] == "App\\Account")) {
            if ($data['organizer_id'] == "me") {
                $organizer = $user;
            } else {
                $organizer = Account::findOrFail($data['organizer_id']);
            }
        } else {
            //organizer is an organization entity
            $organizer = Organization::findOrFail($data['organizer_id']);
        }
        return $event->organizer()->associate($organizer);
    }

    
    

}
