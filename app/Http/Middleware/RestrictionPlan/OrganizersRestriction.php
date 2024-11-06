<?php

namespace App\Http\Middleware\RestrictionPlan;

use Closure;
use Illuminate\Support\Facades\DB;
// models
use App\Event;
use App\Account;
use App\Rol;

class OrganizersRestriction
{
    /**
     * Handle an incoming request.
     * 
     * Restriction of organizers allowed
     * according to the plan that the client has associated
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $request->json()->all();
        $route = $request->route();

        // get event owner user
        $eventToRegisterUser = Event::findOrFail($route->parameter("event"));
        $user = Account::findOrFail($eventToRegisterUser->author_id);

        //Rol incoming user
        $rol_name = '';

        switch ($route->methods[0]) {
            case 'POST':
                $email = isset($data['properties']['email']) ? $data['properties']['email'] : $data['email'];
                // if the person to register is the owner of the event,
	            // the restriction does not apply.
                if ($email === $user->email) {
                    return $next($request);
                }
                if (!isset($data['rol_id']) && !isset($rol_name)) {
                    return $next($request);
                }elseif (isset($data['rol_id'])) {
                    $rolToAddUser = Rol::findOrFail($data['rol_id']);
                    $rol_name = $rolToAddUser->name;
                }else{
                    return $next($request);
                    
                }
                if ($rol_name == 'Administrator') {
                    return $this::validateOrganizers($user, $next, $request);
                }
                break;
            
            case 'PUT':
                $rolToAddUser = Rol::findOrFail($data['properties']['rol_id']);
                $rol_name = $rolToAddUser->name;
                if ($rol_name == 'Administrator') {
                    return $this::validateOrganizers($user, $next, $request);
                }
                break;
            default:
                break;
        }
        return $next($request);
    }

    public function validateOrganizers($user, Closure $next, $request)
    {
        // fetch user events and validate total number of organizers
        $userEvents = Event::where('author_id', $user->_id)->get();
        $totalRegisteredOrganizers = 0;
        foreach ($userEvents as $event) {
            $organizersAtTheEvent = DB::table('event_users')->where('event_id', $event['_id'])->where('rol_id', '=', '5c1a59b2f33bd40bb67f2322')->get();
            $totalRegisteredOrganizers += count($organizersAtTheEvent);
        }
        if ($user->plan['availables']['organizers'] <= $totalRegisteredOrganizers ) {
            return response()->json(['message' => 'Organizers limit exceeded'], 401);
        }
        return $next($request);
    }
}
