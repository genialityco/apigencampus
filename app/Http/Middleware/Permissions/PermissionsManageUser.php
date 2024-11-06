<?php
namespace App\Http\Middleware\Permissions;

use Closure;
use Auth;
use App\Attendee;
use App\Event;
use App\OrganizationUser;
use App\Rol;
use App\RolesPermissions;
use Illuminate\Auth\AuthenticationException;

//use App\Order;
/**
 * Este moddleware realiza la administracion que tiene que ver con los usuario en eventUser,
 * estos son diferentes que los administradores pueden cambiar la información de algunos usuarios y
 * a su vez los usuarios pueden cambiar su propia información, pero no la de otros usuarios.
 *
 */
class PermissionsManageUser
{
    public function handle($request, Closure $next, $permission)
    {
        //Usuario autenticado
        $user = Auth::user();

        if ($user  === null) {
            throw new AuthenticationException("No token provided. Unauthenticated");
        }


        $rolAdministrator = Rol::ID_ROL_ADMINISTRATOR;

        //Separar los permisos para el endpoint
        $permissions = is_array($permission)
        ? $permission
        : explode('|', $permission);

        $route = $request->route();

        $data = $request->json()->all();

        /**
         * Esto es temporal para Royal Prestige.
         *
         * Un usuario que no es admin debe poder actualizar
         * usuarios(EventUser) solamente cuando estos usuarios
         * han sido afiliados por este, el usuario dueño de la orden no podra actualizar
         * usuarios que no tenga afiliados, unicamente los propios.
        */

        //if(isset($data['order_id'])) {
            //$order = Order::findOrFail($data['order_id']);
            //$orderOwner = Attendee::where('account_id' , $user->_id)
                                //->where('event_id' ,$route->parameter('event'))
                                //->first();
            //$userToEdit = Attendee::findOrFail($route->parameter("eventuser"));

            //if($order->event_user_id === $orderOwner->_id){ // valida que el order_id pertenesca al usuario que hace la peticion
                //// valida que el usuario a editar sea un afiliado suyo.
                //if ($userToEdit->order_id === $order->_id) {
                    //return $next($request);
                //}
                //throw abort(401 , "You don't have permission for do this action.");
            //} else {
                //throw abort(401 , "You don't have permission for do this action.");
            //}
        //}

        /******** */

        //Validate EventUser

        //User que se va a editar
        $userToEdit = '';

        //Rol del usuario que edita
        $editingUser = '';

        $adminsavailable = null;
        switch ($route->parameterNames()[0]) {
            case 'event':

                $userToEdit = Attendee::findOrFail($route->parameter("eventuser"));

                $editingUser = Attendee::where('account_id' , $user->_id)
                                ->where('event_id' ,$route->parameter('event'))
                                ->first(['rol_id', 'properties']);

                $adminsavailable = Attendee::where('event_id', $route->parameter('event'))
                                    ->where('rol_id' , $rolAdministrator)
                                    ->get();
                break;

            case 'organization':
                $userToEdit = OrganizationUser::findOrFail($route->parameter("organizationuser"));

                $editingUser = OrganizationUser::where('account_id' , $user->_id)
                                ->where('organization_id' ,$route->parameter('organization'))->first(['rol_id', 'properties']);

                $adminsavailable = OrganizationUser::where('organization_id', $route->parameter('organization'))
                                    ->where('rol_id' , $rolAdministrator)
                                    ->get();
                break;
        }

        $rol = ($editingUser !== null) ? Rol::find($editingUser->rol_id) : null;

        //Un usuario puede editar su propia información
        if($userToEdit->_id === $editingUser->_id)
        {
            // $dataRol = isset($data["rol_id"]) ? $data["rol_id"] : isset($data["properties"]["rol_id"]) ? $data["properties"]["rol_id"] : null;
            $dataRol = null;
            if (isset($data["rol_id"])) {
                $dataRol = $data["rol_id"];
            } else if (isset($data["properties"])) {
                if (isset($data["properties"]["rol_id"])) {
                    $dataRol = $data["properties"]["rol_id"];
                }
            }

            //Un usuario no puede editar su propio rol, debe de ser un administrador para hacerlo
            if(isset($dataRol) && ($rolAdministrator === $editingUser->rol_id) && ($dataRol !== $rolAdministrator))
            {

                //Esto valida que un evento u organizacioón SIEMPRE tenga un administrador
                if(count($adminsavailable) >= 2 )
                {
                    return $next($request);
                }else{
                    throw abort(409 , "There must be at least one administrator in the event.");
                }

            }
            $request->merge(['rol_id' => $userToEdit->rol_id]);

	    // El autor del evento no puede ser eliminado
	    if($route->methods[0] === "DELETE") {
	      $event = Event::findOrFail($route->parameter('event'));
	      if($event->author_id === $userToEdit->account_id) {
		throw abort(403 , "Author of the event/organization cannot be deleted");
	      }
	    }

            return $next($request);

        }else if(($rol) && $rol->type === 'admin'){
            $permissionsRolUser = RolesPermissions::whereHas('permission', function($query) use ($permissions)
            {
                $query->whereIn('name', $permissions);

            })->where('rol_id' , $editingUser->rol_id)->first();

            if($permissionsRolUser ==! null)
            {

                return $next($request);
            }
        }

        throw abort(401 , "You don't have permission for do this action.");

    }

}
