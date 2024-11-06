<?php

namespace App\Http\Middleware\Permissions;

use Closure;
use Auth;
use App\OrganizationUser;
use App\ModelHasRole;
use App\RolesPermissions;
use App\Permission;
use App\Attendee;
use App\Rol;
use App\Event;
use App\Organization;
use Spatie\Permissionn\Exceptions\UnauthorizedException;
use Illuminate\Auth\AuthenticationException;
use Log;

class PermissionMiddleware

{
    public function handle($request, Closure $next, $permission)
    {   
        //Usuario autenticado
        $user = Auth::user();
        
        if ($user  === null) {
            //throw new AuthenticationException("No token provided. Unauthenticated");
        } 
        
        //Se valida el rol del usuario           
        $userRol = '';

            
        //Validar parámetros de url
        $urlParameter = $request->route();
        Log::debug("urlParameter: " . json_encode($urlParameter));
        if ($user === null) throw new AuthenticationException("No token provided. Unauthenticated");
        
        //Separar los permisos para el endpoint
        $permissions = is_array($permission)
        ? $permission
        : explode('|', $permission);

        // //Aquí se valida si se accede a una config de un evento o una irganización
        // switch ($urlParameter->parameterNames()[0]) {
        //     case 'event':
        //         $userRol = Attendee::where('account_id' , $user->_id)->where('event_id' ,$urlParameter->parameter('event'))->first(['rol_id', 'properties']);
        //         break;
        //     case 'organization':
        //         $userRol = OrganizationUser::where('account_id' , $user->_id)->where('organization_id' ,$urlParameter->parameter('organization'))->first(['rol_id', 'role_id']);            
        //         break;
        // }    

        // Check if the user is an organization admin user
        $itIsOrganizationAdmin = false;

        // Aquí se valida si se accede a una config de un evento o una organización
        $dynamicParameter = $urlParameter->parameterNames()[0];
        if ($dynamicParameter === 'event') {
            $userRol = Attendee::where('account_id' , $user->_id)
                ->where('event_id' ,$urlParameter->parameter('event'))
                ->first(['rol_id', 'properties']);
            $currentEvent = Event::findOrFail($urlParameter->parameter('event'));

            $organizationUser = OrganizationUser::where('account_id', $user->_id)
                ->where('organization_id', $currentEvent->organizer_id)
                ->first();

            // We need the organization user if exists
            if (isset($organizationUser)) {
                $organizationUserRol = Rol::findOrFail($organizationUser->rol_id);
                Log::debug("this organization user is: " . $organizationUserRol->type);
                $itIsOrganizationAdmin = $organizationUserRol->type === 'admin';
            } else {
                Log::debug('Auth permission says: this user '  . $user->_id . ' has no organization');
            }
        } else if ($dynamicParameter === 'organization') {
            $userRol = OrganizationUser::where('account_id' , $user->_id)
                ->where('organization_id' ,$urlParameter->parameter('organization'))
                ->first(['rol_id', 'role_id']);
        }
        
        $rol = isset($userRol) ? Rol::find($userRol->rol_id) : null;

        if(($rol) && $rol->type === 'admin')
        {   
            //Busca el permiso por el nombre desde rolespermissions
            $permissionsRolUser = RolesPermissions::whereHas('permission', function($query) use ($permissions)
            {
                $query->whereIn('name', $permissions);
            
            })->where('rol_id' , $userRol->rol_id)->first();

            if($permissionsRolUser ==! null)
            {
                return $next($request);
            }
        }
    
        Log::debug('itIsOrganizationAdmin? ' . json_encode($itIsOrganizationAdmin));
        if ($itIsOrganizationAdmin) return $next($request);

        throw abort(401 , "You don't have permission for do this action.");    

         
    }
}