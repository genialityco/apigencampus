<?php

namespace App\Http\Middleware\RestrictionPlan;

use Closure;
use Mail;
// models
use App\Event;
use App\Account;
use App\Addon;

class UserRegistrationRestriction
{
    /**
     * Handle an incoming request.
     *
     * Restriction of users allowed
     * according to the plan that the client has associated
     * If users are removed, they will still count towards the restriction. softdelete is used
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $request->json()->all();
        $route = $request->route();
        $email = isset($data['properties']['email']) ? $data['properties']['email'] : $data['email'];

	// get event owner user
        $eventToRegisterUser = Event::findOrFail($route->parameter("event"));
        $user = Account::findOrFail($eventToRegisterUser->author_id);

	// if the person to register is the owner of the event,
	// the restriction does not apply.
        if ($email === $user->email) {
            return $next($request);
        }

        // there are users without a plan, they are old clients without restriction
        if(empty($user->plan_id) || $user->plan['name'] === "Business") {
            return $next($request);
        }

	// get all addon users
	$addonUsers = Addon::where('user_id', $user->_id)->where('is_active', true)->get();
	$allowedUsers = $user->plan['availables']['users'];
	foreach($addonUsers as $addonUser) {
	  $allowedUsers+=$addonUser->amount;
	}

	if ($user->registered_users >= $allowedUsers) {
	    Mail::to($user->email)->send(
	      new \App\Mail\ExceededUsers($user, $allowedUsers)
	    );
	    return response()->json(['message' => 'users limit exceeded'], 403);
	}

	$user->registered_users +=1;
	$user->save();

        return $next($request);
    }
}
