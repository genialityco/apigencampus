<?php
namespace App\Http\Middleware\Permissions;

use Closure;
use Auth;
use App\Attendee;
use App\Event;
use App\OrganizationUser;
use App\Rol;
use App\RolesPermissions;
use DB;
use Illuminate\Auth\AuthenticationException;

/**
 * Este moddleware realiza la administracion que tiene que ver con los usuario en eventUser, 
 * aqui se validan mayormente las consultas get que los eventUser hacen dentro de un evento
 *  
 */
class PermissionAttendeeMidleware
{
    public function handle($request, Closure $next, $permission)
    {   

        $route = $request->route();

        //Validate event type anonymus
        $event_id = $route->parameter('event');
        $event = Event::findOrFail($event_id);
        
        if($event->visibility === 'PUBLIC' && $event->allow_register === false )
        {
            return $next($request);
        }

        //User authenticated
        $user = Auth::user();
        
        if ($user  === null) {
            // throw new AuthenticationException("No token provided. Unauthenticated");
            //Por ahora no se valida autenticación mientras se definnen que módulos pueden ser publicos
            return $next($request);
        } 

        
        $systemModule = DB::table('system_modules')->where('url' , $route->uri())->first();
        
        //Endpoint Ej: api/events/{event}/activities
        $section = $systemModule['section'];
        
        //Item en la landing del evento EJ: agenda
        $itemMenu = $event->itemsMenu[$section];
        

        if(isset($itemMenu['rol_ids']) && count($itemMenu['rol_ids']) > 0 )
        {   
           
            //Separar los permisos para el endpoint
            $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

            $attendee = Attendee::where('account_id' , $user->_id)->where('event_id' ,$route->parameter('event'))->first(['rol_id']);

            $permissionsRolAttendee = RolesPermissions::whereHas('permission', function($query) use ($permissions)
            {
                $query->whereIn('name', $permissions);
            
            })->where('rol_id' , $attendee->rol_id)->first();

            //Verifica 
            if(in_array($attendee->rol_id , $itemMenu['rol_ids']) || $permissionsRolAttendee ==! null)
            {   
                
                return $next($request);    
            }

            throw abort(401 , "You don't have permission for do this action.");
            
        }  

        return $next($request);       

        
        
    }
}