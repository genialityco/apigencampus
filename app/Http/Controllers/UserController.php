<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use App\Addon;
use App\Attendee;
use App\Event;
use App\Billing;
use App\Position;
use App\Http\Controllers\web\UserController as UserControllerWeb;
use App\Http\Resources\UsersResource;
use App\Mail\ConfirmationEmail;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Storage;
use App\evaLib\Services\FilterQuery;
use App\Http\Resources\EventUserResource;
use App\Jobs\GuessPassword;
use Auth;
use App\OrganizationUser;
use Log;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;
use Illuminate\Support\Facades\DB;
//magicLink
use App\Url;
use PUGX\Shortid\Shortid;



/**
 * @group User
 * 
 * Manage users, the users info are stored in the backend and the user auth info (password, email).
 * There are two data base for the users: **firebase** and **mongodb**, the users are related by the field **uid** this id is genereated from  firebase.
 * 
 * Firebase manage the sessions user using tokens JTW.
 * 
 * The tokens are send in the url this way **?token=xxxxxxxxxxxxxxxxx**  for validate the athuentication of user.
 * 
 * If you want to work in development environment or production enviroment is necesary connect to proyect correspondent.
 * 
 * |                    | Prodcution    | Dev
 * |--------------      |-------------  | -------------
 * |**ID project**      |eviusauth      | eviusauthdev
 * |**Name project**    |eviusAuth      | eviusAuthDev
 * 
 */
class UserController extends UserControllerWeb
{

    protected $auth;

    public function __construct(\Kreait\Firebase\Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * _index_: It's not posible to query all users in the platform.
     *
     * Doesn't make sense to query all users. Users main function is to assits to an event
     * thus make sense to query users going to an event.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode(["data" => "Can't query all users of the platform maximun scope is by event, please query particular user by _id or findByEmail"]);
        /*return UsersResource::collection(
    Account::paginate(config('app.page_size'))
    );*/
    }

    public function indexByEvent(Request $request, Event $event) {
        $attendees = $event->attendees;
        return response()->json(['attendeess' => $attendees]);
    }

    /**
     * _show_: view a specific registered user
     *
     * @urlParam user required  id of user. Example: 603d6af041e6f468091c95d5
     */
    public function show(String $id)
    {
        $Account = Account::findOrFail($id);
        $response = new UsersResource($Account);
        return $response;
    }

    /**
     * _store_: create new user and send confirmation email
     * 
     * 
     * @bodyParam email email required Example: example@evius.co
     * @bodyParam names  string required  person name  Example: Evius   
     * @bodyParam picture  string  Example: http://www.gravatar.com/avatar
     * @bodyParam password  string  required  Example: *******
     * @bodyParam plan_id  string Default Free Plan  Example: 62864ad118aa6b4b0f5820a2 (Basic Plan)
     * 
     */
    public function store(Request $request)
    {   
          
        $data = $request->json()->all();
        $email = strtolower($data['email']);        
        $request->merge(['email' => $email]);
        
        $request->validate([
            'email' => 'required|unique:users,email|email:rfc,dns',
            'names' => 'required|string',
            'picture' => 'string',
            'password' => 'string|min:6',
            'plan_id' => 'exists:plans,_id|string'
        ]);

        $result = new Account($data);
	    $result->open_password = $data['password'];
        $result->save();
        $result = Account::find($result->_id);

        // Mail::to($result)
        //     ->queue(
        //         new  \App\Mail\UserRegistrationMail($result)
        //     );
        // //generate notification
        // app('App\Http\Controllers\NotificationController')
        // ->addNotification('Tienes un plan free activo', $result->_id);
        return $result;
    }



    /**
     * _update_: update registered user
     * @authenticated
     * @urlParam user required id user. Example: 603d6af041e6f468091c95d5
     *
     * @bodyParam names  string optional. Example: Evius Demo
     * @bodyParam password string. Example: ******
     * @bodyParam picture  string optional. Example: http://www.gravatar.com/avatar
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'names' => 'string',
            'picture' => 'string',
            'password' => 'string'
        ]);
        $data = $request->json()->all();
        
        $auth = resolve('Kreait\Firebase\Auth');
        $this->auth = $auth;
        $account = Account::find($id);
        
        //If the user wants to change the password this will also be modified in firebase
        if(isset($data['password']))
        {               
            $this->auth->changeUserPassword($account['uid'], $data['password']);
        }
        // var_dump($auth);die;
        $account->fill($data);
        $account->save();

        $attendees = Attendee::where('account_id', $id)->get();
        foreach ($attendees as $attendee) {
            $properties = $attendee->properties;
            $properties['names'] = $account->names;
            $attendee->properties = $properties;
            $attendee->save();
        }
        $organization_users = OrganizationUser::where('account_id', $id)->get();
        foreach ($organization_users as $organization_user) {
            if (isset($organization_user->properties)) {
                $properties = $organization_user->properties;
                $properties['names'] = $account->names;
                $organization_user->properties = $properties;
            }
            $organization_user->save();
        }

        return $account;
    }

    /**
     * updateOneUserPassword: update password registered user
     * @authenticated
     * @urlParam user required id user. Example: 603d6af041e6f468091c95d5
     *
     * @bodyParam password string. Example: ******
     */
    public function updateOneUserPassword(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'password' => 'string'
        ]);
        $data = $request->json()->all();
        $auth = resolve('Kreait\Firebase\Auth');
        $this->auth = $auth;
        $account = User::find($id);
        $change = $this->auth->changeUserPassword($account['uid'], $data['password']);

        return response()->json(['message' => 'Password updated successfully']);
    }

    /**
     * updatePasswordsByEvent: update passwords of registered users
     * @authenticated
     * @urlParam event required id event. Example: 603d6af041e6f468091c95d5
     *
     * @bodyParam password string. Example: ******
     */
    public function updatePasswordsByEvent(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'password' => 'string'
        ]);
        $data = $request->json()->all();
        $auth = resolve('Kreait\Firebase\Auth');
        $this->auth = $auth;
        $attendees = $event->attendees;
        foreach ($attendees as $attendee) {
            if ($event->author_id != $attendee->account_id) {
                //dd("not author", $attendee);
                $account = Account::findOrFail($attendee->account_id);
                $this->auth->changeUserPassword($account->uid, $data['password']);
            }
        }
        return response()->json(['message' => 'Passwords updated successfully']);
    }

    public function updatePasswordsByEventToDefault(Request $request, Event $event)
    {
        $__propertyName = "ID";
        $data = $request->json()->all();
        try {
            $auth = resolve('Kreait\Firebase\Auth');
            $this->auth = $auth;
            $attendees = $event->attendees;
            foreach ($attendees as $attendee) {
                if ($event->author_id != $attendee->account_id) {
                    // //dd("not author", $attendee);
                    try {
                        $account = Account::findOrFail($attendee->account_id);
                        if (!$attendee->properties || !$attendee->properties['ID']) {
                            Log::debug("user has no properties: ".$attendee->account_id);
                            continue;
                        }
                        // Log::debug(json_encode($attendee));
                        // break;
                        // Log::debug("wanna update user " . $attendee['names'] . " (" . $account['_id'] . ") to passowrd: " . $attendee->properties['ID']);
                        $this->auth->changeUserPassword(strval($account->uid), strval($attendee->properties['ID']));
                    } catch (\Exception $e) {
                        Log::debug("user has no ID property: ".$attendee->account_id." - email: ".$attendee->properties['email']);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::debug("error weird");
        }
        return response()->json(['message' => 'Passwords updated successfully']);
    }

    public function updatePasswordTo(Request $request, User $user)
    {
        $password = $request->query('password');
        $account = Account::findOrFail($user->_id);
        Log::debug(json_encode($account));
        // return response()->json(['message' => 'Passwords updated successfully']);
        $auth = resolve('Kreait\Firebase\Auth');
        $this->auth->changeUserPassword(strval($account->uid), strval($password));
        return response()->json(['message' => 'Passwords updated successfully']);
    }

    /**
     * _update_: update plan of registered user
     * @authenticated
     */
    public function updatePlan($plan_id, string $user_id)
    {
        if ($plan_id) {
            $Account = User::findOrFail($user_id);
            $Account['plan_id'] = $plan_id;
            $Account->save();
            return $Account;
        }
        return response()->json(['message'=> 'Plan not found'], 404);
    }


    /**
     * _update_: update addons of registered user
     * @authenticated
     */
    public function updateAddons($billing)
    {
        if ($billing) {
            if (isset($billing->billing['details']['users'])) {
                $addons = Addon::where('billing_id', $billing->_id)->where('is_active', false)->get();
                foreach ($addons as $addon) {
                    $addon['is_active'] = true;
                    $addon->save();
                }
                return response()->json(['message'=> 'Addons update successfully'], 204);
            }
            return response()->json(['message'=> 'Addons not found'], 404);
        }
        return response()->json(['message'=> 'Billing not found'], 404);
    }


    /**
     * currentPlanInfo: Shows the information about consuming of current plan 
     * @authenticated
     * @urlParam user id required  user_id
     */
    public function currentPlanInfo(string $user_id)
    {
        $account = Account::find($user_id);
        $events = Event::where('author_id', $user_id)->latest()->get();
        $hours = $account->plan_id == "6285536ce040156b63d517e5" ? "2h" : "72h"; //Por el momento se toma 2h = free si no 72h
        $user_billing = Billing::where('status','APPROVED')
            ->where('user_id', $account->_id)
            ->where('action', '!=', 'ADDITIONAL')
            ->latest()
            ->first();
        if (isset($user_billing)) {
            $table['start_date'] = $user_billing->billing['start_date'];
            $table['end_date'] = $user_billing->billing['end_date'];
        }else{
            $table['plan'] = "El usuario no tiene un plan";
        }

        if (count($events) >= 1) {
            for ($i=0; $i < count($events); $i++) { 
                $table['events'][$i]['ID'] = $events[$i]['_id'];
                $table['events'][$i]['name'] = $events[$i]['name'];
                $usersAtTheEvent = DB::table('event_users')->where('event_id', $events[$i]['_id'])
                    ->where('properties.email', '!=', $account->email)->get();
                $table['events'][$i]['users'] = count($usersAtTheEvent);
                $table['events'][$i]['hours'] = $hours;
                $table['events'][$i]['status'] = $events[$i]['isActive'] ? "ACTIVE" : "DISABLED";
                $table['events'][$i]['startDate'] = $events[$i]['datetime_from']->format('d-m-Y'); //Fecha inicio
                $table['events'][$i]['endDate'] = $events[$i]['datetime_to']->format('d-m-Y'); //Fecha fin
            }
            return $table;
        }
        $table['events'][0] = "No hay eventos creados";
        return $table;
    }

    /**
     * _delete_: delete a registered user
     * @authenticated
     * @urlParam user required id user Example: 603d6af041e6f555591c95d5
     */
    public function destroy($id)
    {   
        $Account = Account::find($id);
        $res = $Account->delete();
        if ($res == true) {
            return 'True';
        } else {
            return 'Error';
        }
    }

    /**
     * _signInWithEmailAndPassword_: login a user, you can see this [diagram](https://app.diagrams.net/#G1qSNi58JI6usiyqU7n7SsmyTrJW5oITAZ)
     * 
     * @bodyParam email email required Example: correo@evius.co
     * @bodyParam password string required Example: *********
     * It returns the userdata and inside that data
     * the initial_token to be stored in front and be used in following api request
     */
    public function signInWithEmailAndPassword(Request $request)
    {

        $data = $request->json()->all();

        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $data['email'];
        $pass = $data['password'];

        $signInResult = $this->auth->signInWithEmailAndPassword($email, $pass);
        $uid = $signInResult->firebaseUserId();

        $user = Account::where('uid', $uid)->first();
        $user->refresh_token = $signInResult->refreshToken();
        $user->save();
        $user->initial_token = $signInResult->idToken();

        return $user;
    }

    /**
     * _findByEmail_: search for specific user by mail
     *
     * @urlParam email required email del usuario buscado. Example: correo@evius.co
     */
    public function findByEmail($email)
    {
        try {
            $Account = Account::where('email', '=', $email)
                ->get(['id', 'email', 'names', 'name', 'Nombres', 'displayName']);
            $response = new UsersResource($Account);

        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
        return $Account;
    }

    /**
     * _validateEmail_: Validate Email for create a new user
     * @bodyParam email string required Example: test@test.com
     */
    public function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email|email:rfc,dns'
        ]);
        
        return response()->json(['message' => 'Email valid'], 200);
    }

    /**
     * loginorcreatefromtoken: create a user from auth data.
     * 
     * If a userauth is created  in frontend using firebaseatuh javascript JDK
     * this method can be called to create respective user in the backend
     * data is extracted from the token.
     * 
     * authuser in firebaseauth and user are related by the field uid created by firebase
     *
     * @urlParam token required auth token used to extract the user info
     * @urlParam destination optional url to redirect after user is created
     * @param  \Illuminate\Http\Request  $request
     * @return  redirect to evius front
     */
    //http://localhost:8000/api/user/loginorcreatefromtoken?evius_token=eyJhbGciOiJSUzI1NiIsImtpZCI6IjVlOWVlOTdjODQwZjk3ZTAyNTM2ODhhM2I3ZTk0NDczZTUyOGE3YjUiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiZXZpdXMgY28iLCJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoIiwiYXVkIjoiZXZpdXNhdXRoIiwiYXV0aF90aW1lIjoxNTg3OTE0MjAxLCJ1c2VyX2lkIjoiNU14bXdEUlZ5MWRVTEczb1NraWdFMXNoaTd6MSIsInN1YiI6IjVNeG13RFJWeTFkVUxHM29Ta2lnRTFzaGk3ejEiLCJpYXQiOjE1ODc5MTQyMDEsImV4cCI6MTU4NzkxNzgwMSwiZW1haWwiOiJldml1c0Bldml1cy5jbyIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJlbWFpbCI6WyJldml1c0Bldml1cy5jbyJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.SpgxWQeZkzXCtI3JoHuVpSU_FxhC7bhLkMpe9foQAY10KkRGEvgLp0A2Wiah7B0QKPsgMv02apTsPgl6I9Y7drV4YTq_6JaCTTjJNAJII3ani1E9lgXyXbYww60SFzuO1HDFh3BL8qLtIm07KK8tncGloHfYBoI5PxFo9OIwS5672GWaAZHwQ_5MA4gBkRxl4I4IF-T5yOr8qqEOM4T7u1kdBlWtI1xx-YOgzDu-4usAd9b8tyk0yKYNfPqP3cCClXV9WoG51hWLzdjgjUPkdhoLXXa0-U2HqmjG_WtQTQkjtrQyFHV5q7piOemqNRGJbPNMUp3P1QYL-YQax7TYWg&evius_token=eyJhbGciOiJSUzI1NiIsImtpZCI6IjVlOWVlOTdjODQwZjk3ZTAyNTM2ODhhM2I3ZTk0NDczZTUyOGE3YjUiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiZXZpdXMgY28iLCJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vZXZpdXNhdXRoIiwiYXVkIjoiZXZpdXNhdXRoIiwiYXV0aF90aW1lIjoxNTg3OTE0MjAxLCJ1c2VyX2lkIjoiNU14bXdEUlZ5MWRVTEczb1NraWdFMXNoaTd6MSIsInN1YiI6IjVNeG13RFJWeTFkVUxHM29Ta2lnRTFzaGk3ejEiLCJpYXQiOjE1ODc5MTQyMDEsImV4cCI6MTU4NzkxNzgwMSwiZW1haWwiOiJldml1c0Bldml1cy5jbyIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJlbWFpbCI6WyJldml1c0Bldml1cy5jbyJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.SpgxWQeZkzXCtI3JoHuVpSU_FxhC7bhLkMpe9foQAY10KkRGEvgLp0A2Wiah7B0QKPsgMv02apTsPgl6I9Y7drV4YTq_6JaCTTjJNAJII3ani1E9lgXyXbYww60SFzuO1HDFh3BL8qLtIm07KK8tncGloHfYBoI5PxFo9OIwS5672GWaAZHwQ_5MA4gBkRxl4I4IF-T5yOr8qqEOM4T7u1kdBlWtI1xx-YOgzDu-4usAd9b8tyk0yKYNfPqP3cCClXV9WoG51hWLzdjgjUPkdhoLXXa0-U2HqmjG_WtQTQkjtrQyFHV5q7piOemqNRGJbPNMUp3P1QYL-YQax7TYWg
    public function loginorcreatefromtoken(Request $request)
    {
        $firebaseToken = null;
        $refresh_token = null;
        $url_final_params = [];

        try {
            /**
             * Miramos si el token viene en la Petición
             * El token viene en la petición el cual si llega con el nombre evius_token o token
             * REQUEST,
             *
             * En la Petición viene el refresh_token
             */
            //

            if ($request->has('evius_token')) {$firebaseToken = $request->input('evius_token');}
            if ($request->has('refresh_token')) {$refresh_token = $request->input('refresh_token');}

            /**
             * Si el token no viene en la petición
             * Bota el error de que el token no fue enviado en la petición, recordar que esta ruta es
             * una petición GET.
             */
            if (!$firebaseToken) {
                throw new Exception('Error: No token provided');
            }

            /*
             * Se verifica la valides del token
             * Si este se encuentra activamos la función validator, el cual nos devuelve el
             * usuario y finalmente enviamos el request indicando que se puede continuar, con la página acutal.
             */

            $verifiedIdToken = $this->auth->verifyIdToken($firebaseToken);
            $user_auth = $this->auth->getUser($verifiedIdToken->getClaim('sub'));

            $user = Account::where('uid', '=', $user_auth->uid)->first();

            if (!$user) {
                $user = Account::create(get_object_vars($user_auth));
                //We created a organization default, thus the name organitatios is the displayName user
                $organization = new Organization();
                $organization->author = $user->id;
                $organization->name = $user->displayName;
                $organization->save();

                //self::_sendConfirmationEmail(
                //    $user
                //);
            }

            //El token para refrescar tokens vencidos de expiración rápida
            if ($refresh_token) {
                $user->refresh_token = $refresh_token;
                $user->save();
            }

            $url_final_params["token"] = $firebaseToken;

        } catch (\Exception $e) {
            $url_final_params["error"] = $e->getMessage();

        } finally {
            $destination = $request->has('destination') ? $request->input('destination') : config('app.front_url');
            return redirect()->away($destination . "?" . http_build_query($url_final_params));
        }

    }


    /**
     * _sendConfirmationEmail_: sending of mail confirmation.
     *
     * @urlParam id required id user
     *
     * @return void
     */
    private static function _sendConfirmationEmail($user)
    {
        $email = $user->email;

        // $messageUser = new MessageUser(
        //     [
        //         'email' => $eventUser->user->email,
        //         'user_id' => $eventUser->user->id,
        //         'event_user_id' => $eventUser->id,
        //     ]
        // );
        // $message->messageUsers()->save($messageUser);

        //Mail::to($email)
        //    ->queue(
        //        new ConfirmationEmail($user)
        //    );
    }

    /**
     * _confirmEmail_: get email confirmation
     *
     * @urlParam id required id user
     *
     * @return void
     */
    public function confirmEmail(String $id)
    {
        $user = Account::findOrFail($id);

        $user->emailVerified = true;
        $user->save();

        return redirect()->away(config('app.front_url') . "/profile/" . $user->id);
        // return ['id'=>$eventUser->id,'message'=>'Confirmed'];
    }

    /**
     * _userOrganization_: user lists all the users that belong to an organization, besides this you can filter all the users by **any of the properties** that have
 
     * @authenticated
     * 
     * @urlParam organization required organization to which the users belong. Example: 61ccd2cc81e73549a63dd5ce
     * @queryParam filtered optional filter parameters Example: [{"field":names","Evius"}]
     * @queryParam  orderBy filter parameters Example: [{"field":"_id","order":"desc"}]    
     * 
     */
    public function userOrganization(Request $request, String $organization_id, FilterQuery $filterQuery){

        $input = $request->all();

        $query = Account::where("organization_ids", $organization_id);
        
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return UsersResource::collection($results);          

    }

    /**
     * _changeStatusUser_: approve or reject the rol the users teacher ,and send mail of the change of status of the user to the user who created it
     * 
     * @authenticated
     * @urlParam user_id required id of the user to be rejected or approved 
     * @bodyParam status string required the status update allows for two possible statuses **approved** or **rejected** Example: approved
     * 
     */
    public function changeStatusUser(Request $request , $user_id)
    {   
        $validatedData = $request->validate([
            'status' => 'required',
        ]);

        $data = $request->json()->all();
        
        $user = Auth::user();

        $userRol =  isset($user) ? $user->others_properties['role'] :  null;
            
        
        if(isset($userRol) && $userRol == 'admin')
        {
            $user = Account::find($user_id);
            $user->status = $data['status'];
            $user->save();
            
            foreach($user->organization_ids  as $organization)
            {
                $organizer = Organization::find($organization);
            }
                              

            Mail::to($user->email)
            ->queue(                
                    new \App\Mail\ConfirmationStatusUserEmail($user , $organizer)
                );

            return $user;
        }
        
        return response()->json([
            'Error' => 'The user does not have the permissions to execute this action'
        ], 403);
        
    }

    /**
     * _getAccessLink_: get and sent link acces to email to user.
     * 
     * @bodyParam refreshlink This parameter return the login link but not send email.
     * @bodyParam event string event id to redirect user, if this parameter not send, the link redirect to principal page. Example: 61ccd3551c821b765a312864
     * @bodyParam email email required  user email Example: correo@evius.co
     * 
     */
    public function getAccessLink(Request $request) 
    {
        $auth = resolve('Kreait\Firebase\Auth');

        $urlOrigin = $request->header('origin');
        $request->validate([
            "email" => "required|email:rfc,dns",            
        ]);
        $data = $request->all();
        
        $email = $data["email"];
        

	    $urlOrigin = $request->header('origin');
        if (!isset($urlOrigin)) {
            return response()->json([
                "message" => "Missing the \"origin\" header in the request"
            ] , 403);
        }

        $link = '';
        $event_id = null;
        if(isset($data['event_id']))
        {   
            $event_id = $data['event_id'];

            $link = $auth->getSignInWithEmailLink(
                $email,
                [
                    "url" => $urlOrigin . "/loginWithCode?email=". urlencode($email) . "&event_id=" . $event_id,
                ]    
            );

        }else{  
            
            $link = $auth->getSignInWithEmailLink(
                $email,
                [
                    "url" => $urlOrigin . "/loginWithCode?email=". urlencode($email),
                ]    
            );

        } 
        if(!isset($data['refreshlink']))    
        {
            Mail::to($email)
            ->queue(
                new \App\Mail\LoginMail($link , $event_id, $email)
            );
        }
        
        
        return $link;
    }

    /**
     * _signInWithEmailLink_: this end point start the login when the user does click in the link
     *  
     * @bodyParam event_id string event id to redirect user, if this parameter not send, the link redirect to principal page. Example: 61ccd3551c821b765a312864
     * @bodyParam email email required  user email Example: correo@evius.co
     */
    public function signInWithEmailLink(Request $request)
    {
        $auth = resolve('Kreait\Firebase\Auth');
        $data = $request->all();
        
        $singin = '';
        $redirect='';

        try {
        $singin = $auth->signInWithEmailAndOobCode($data["email"],$data["oobCode"]);
        if(isset($data['event_id']))
        {   
            $redirect =  config('app.front_url') . "/loginWithCode?email=". urlencode($data['event_id']) . "&event_id=" . $data['event_id'];

            }else{

                $redirect =  config('app.front_url');
            } 

            return Redirect::to($redirect)->with($auth->signInWithEmailAndOobCode($data["email"],$data["oobCode"]));
            

        }catch(\Exception $e){
            $link = $auth->getSignInWithEmailLink(
                $data["email"],
                [
                    "url" => config('app.front_url') . "/loginWithCode?email=". urlencode($data['event_id']) . "&event_id=" . $data['event_id'],
                ]    
            );

            return Redirect::to($link);

            // Alert::html('El link ha caducado', 'Por favor ingrese al evento haciendo <a href="'.$redirect.'">clic aquí</a> para iniciar sesión o solicitar un nuevo link<br>', 'error');
            // return view('Public.Errors.loginLink');         
        }
        
    }


    /**
     * _changeUserPassword_: send to email to user whit  link to change user password.
     * 
     * @bodyParam event_id string event id to redirect user, if this parameter not send, the link redirect to principal page. Example: 61ccd3551c821b765a312864
     * @bodyParam email email required  user email Example: correo@evius.co
     * 
     */
    public function changeUserPassword(Request $request)
    {   
        $auth = resolve('Kreait\Firebase\Auth');

        $request->validate([
            "email" => "required|email:rfc,dns",                     
        ]);

        $data = $request->json()->all();
        $email = $data['email'];
        $user = Account::where('email' , $email)->first();

        if(!isset($user))
        {
            return response()->json([
                "message" => "El usuario no está registrado en el sistema"
            ] , 404);
        }
        //Algunos clientes prefieren que su marca este en todos los correos por eso se coloca la opción de evento     
        $event = null;
        $url = isset($data['hostName']) ? $data['hostName'] : $request->headers->get('referer'); // url front dinamica
        if(isset($data['event_id']))
        {
            $event = Event::find($data['event_id']);
            $url = $url . "/landing/". $event->_id ."/event";
        }
        
        $link = $auth->getPasswordResetLink($email, 
            [
                "url" => $url,
            ]
        );

        Log::debug('link to change password: '.$link);
        
        Mail::to($email)
        ->queue(            
            new \App\Mail\ChangeUserPasswordEmail($user , $link, $event)
        );
        
        // I removed "'data' => compact("link")," because security
        return response()->json(['message' => 'Mail sent successfully']);

    }

    public function usersOfMyPlan(Request $request)
    {
        $user = Auth::user();

	// fetch user events and get total number of registered users
        $totalRegisteredUsers = $user->registered_users;

	// get all addon users
	$addonUsers = Addon::where('user_id', $user->_id)->where('is_active', true)->get();
	$allowedUsers = $user->plan['availables']['users'];
	foreach($addonUsers as $addonUser) {
	  $allowedUsers+=$addonUser->amount;
	}

        return response()->json([
            'totalRegisteredUsers' => $totalRegisteredUsers,
            'totalAllowedUsers' => $allowedUsers
        ]);
    }

    public function getMagicLink(Request $request, Event $event)
    {
        $request->validate([
            "email" => "required|email:rfc,dns",            
        ]);
        $email = $request->email;
        $host = $request->host;
        $auth = resolve('Kreait\Firebase\Auth');
        //obtener el link de inicio de sesión con correo electrónico
        $link = $auth->getSignInWithEmailLink(
            $email,
            [
                "url" => $host . "/loginWithCode?email=". urlencode($email) . "&event_id=" . $event->_id,
            ]    
        );
        $code = Shortid::generate();
        $code = strval($code);
        $newUrl["long_url"] = $link; 
        $newUrl["code"] =  $code; 
        $newUrl["short_url"] = config('app.evius_api') . '/invitation/' .$code;
        $saveUrl = Url::create($newUrl);

        return $saveUrl->short_url;
    }

    private function sendGenericMail($config) {
        $email = $config["email"];
        $link = $config["link"];
        $action_text = $config["action_text"];
        $content = $config["content"];
        $subject = $config["subject"];

        if (isset($link)) {
            if ($action_text) {
                $action_link = "<a href= '{$link}'><button>{$action_text}</button></a>";
            } else {
                $action_link = "<a href= '{$link}'>{$link}</a>";
            }
        } else {
            $action_link = null;
        }

        $body = [
            "message" => $content,
            "link" => $link,
            "action_link" => $action_link,
            "subject" => $subject,
        ];

        Mail::to($email)
            ->queue(
                new \App\Mail\CustomizableMail($body)
            );
    }

    public function getOnlyMagicLink(Request $request)
    {
        $request->validate([
            "email" => "required|email:rfc,dns",
            "url" => "required",
        ]);
        $email = $request->input('email');
        $url = $request->input('url');

        // obtener el link de inicio de sesión con correo electrónico
        $auth = resolve('Kreait\Firebase\Auth');
        $link = $auth->getSignInWithEmailLink($email, [ "url" => $url ] );

        Log::debug("general magic link: ".$link);

        return $link;
    }

    public function getGeneralMagicLink(Request $request)
    {
        Log::debug(json_encode($request->all()));
        $request->validate([
            "email" => "required|email:rfc,dns",
            "url" => "required",
            "content" => "required"
        ]);
        $data = $request->all();
        $email = $data['email'];
        $url = $data['url'];
        $content = $data['content'];

        // obtener el link de inicio de sesión con correo electrónico
        $auth = resolve('Kreait\Firebase\Auth');
        $link = $auth->getSignInWithEmailLink(
            $email,
            [
                "url" => $url,
            ]    
        );
        $code = Shortid::generate();
        $code = strval($code);

        $newUrl["long_url"] = $link;
        $newUrl["code"] =  $code; 
        $newUrl["short_url"] = config('app.evius_api') . '/invitation/' .$code;
        // $saveUrl = Url::create($newUrl);

        $this->sendGenericMail([
            "email" => $email,
            "link" => $link,
            "content" => $content,
        ]);

        Log::debug("general magic link: ".$link);

        return $link;
    }

    public function getGenericMail(Request $request) {
        Log::debug(json_encode($request->all()));
        $request->validate([
            "email" => "required|email:rfc,dns",
            "url" => "required",
            "content" => "required",
        ]);
        $data = $request->all();

        $email = $data['email'];
        $url = isset($data['url']) ? $data['url'] : null;
        $action_text = isset($data['action_text']) ? $data['action_text'] : null;
        $content = $data['content'];
        $subject = isset($data["subject"]) ? $data["subject"] : "Correo GEN.iality";

        $this->sendGenericMail([
            "email" => $email,
            "link" => $url,
            "content" => $content,
            "action_text" => $action_text,
            "subject" => $subject,
        ]);
    }
}
