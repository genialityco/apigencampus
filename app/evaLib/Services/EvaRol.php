<?php
/**
 *
 */
namespace App\evaLib\Services;

use App\Attendee;
use App\ModelHasRole;
use App\OrganizationUser;
use App\Account;
use App\Rol;
use App\State;
use Storage;
use Auth;

class EvaRol
{
    public function doSomethingUseful()
    {
        return 'Output from DemoOne';
    }

/**
 * Stores a file in remote storage service returning url
 *
 * @param int $authorId
 * @param int $eventId
 * @return void
 */
    public function createAuthorAsEventAdmin($authorId, $eventId)
    {
        if (!$authorId) {
            return '';
        }
        $rol = Rol::where('level', -1)->first();
        $state = State::first();
        $userEvt = [
            'account_id' => $authorId,
            'event_id' => $eventId,
            'rol_id' => $rol->_id,
            'state_id' => $state->_id,
        ];
        
        //cargando los attributos del usuario dentro del Attendee
        $user = Account::find($authorId);
        $userEvt['properties'] = $user->getAttributes();

        $userToEvt = new Attendee($userEvt);
        $userToEvt->save();
        return true;
    }

    public function createAuthorAsOrganizationAdmin($authorId, $organizationId)
    {
        if (!$authorId) {
            return '';
        }
        
        $user = Account::find($authorId);
        $userOrg = [
            'account_id' => $authorId,
            'organization_id' => $organizationId,
            'rol_id' => Rol::ID_ROL_ADMINISTRATOR,
            'properties' => [
                'names' => $user->names,
                'email' => $user->email
            ]
        ];
        $userToOrg = new OrganizationUser($userOrg);
        $userToOrg->save();
        return true;
    }


    public static function createOrUpdateDefaultRolEventUser($event_id, $rol_id)
    {
        $user = Auth::user();
        //Esta validación verifica que un admin pueda cambiar el rol        
        if($user)
        {
            $eventUserAdmin = Attendee::where('account_id', $user->_id)
                                ->where('event_id' , $event_id)
                                ->whereHas('rol', function($query)
                                {
                                    $query->where('type', 'admin');
                                
                                })
                                ->first();
            if($eventUserAdmin)
            {
                return $rol_id;
            }
        }
        //Si no es un administrador le deja el rol por defecto,
        // así se evita que cualquier persona se peuda colocar el rol de admin cuando se regista en un evento.
        return Rol::ID_ROL_ATTENDEE;
    }
}
