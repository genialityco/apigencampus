<?php

namespace App\Http\Controllers;

use App\Account;
use App\Rol;
use App\Certificate;
use App\Activities;
use Google\Cloud\Firestore\FirestoreClient;
use App\Organization;
use App\Attendee;
use App\Event;
use App\Http\Resources\OrganizationUserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\OrganizationUser;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Log;
use Mail;
use App\evaLib\Services\OrganizationServices;

/** 
 * @group Organization User
 * This model is the 
*/
class OrganizationUserController extends Controller
{
    /**
     * _index_: List all user of a organization  
     */
    public function index(Request $request, String $organization_id)
    {   
        Log::debug("indexing organization user for [organization] ".$organization_id);
        $OrganizationUsers = OrganizationUserResource::collection(
            OrganizationUser::with('position')
                ->where('organization_id', $organization_id)
                ->paginate(config('app.page_size'))
        );
        return $OrganizationUsers;
    }

    /**
     * Display only organization of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function currentUserindex(Request $request, String $organization_id)
    {
        $user = Auth::user();

        return OrganizationUserResource::collection(
            OrganizationUser::where('userid', $user->id)
                ->where('organization_id',$organization_id)
                ->paginate(config('app.page_size'))
        );
    }

    /** 
     * _store_: create a new user in a organization
     * 
     * @urlParam organization required organization_id
     * 
     * @bodyParam email email required user email Example: test+11@mocionsoft.com
     * @bodyParam names string required user names Example: test
     * 
     */
    public function store(Request $request,String $organization_id)
    {
        $data = $request->json()->all();
        // Log::debug("frontend wants add this data as member: " . json_encode($data, JSON_PRETTY_PRINT));
        Log::debug("Add a new organizationmember");

        $validations = [
            'properties.email' => 'required|email:rfc,dns',
            'properties.names' => 'required',
            'properties.password' => 'min:6',

        ];

        $validator = Validator::make(
            $data,
            $validations
        );

        // This MUST not be here
        if (isset($data['properties']['position_id'])) {
            unset($data['properties']['position_id']);
        }

        $organization = Organization::findOrFail($organization_id);
        $user_properties = $organization->user_properties;
        
        //Se validan los campos que no aceptan datos, si no informativos
        foreach ($user_properties as $user_property) 
        {
            if ($user_property['mandatory'] !== true || $user_property['type'] == "tituloseccion") {
                continue;
            }
            // $organization = $user_property['name'];
        }

        if ($validator->fails()) {
            return response(
                $validator->errors(),
                422
            );
        }
        $email = $data['properties']['email'];
        //Se valida si ya existe el usurio
        $user = Account::where("email" , $email)->first();  
        $eventUserData = $data;
        $password = isset($eventUserData["properties"]["password"]) ? $eventUserData["properties"]["password"] : $email;  
        if(empty($user))
        {   
            $user = Account::create([
                "email" => $email,
                "names" => $eventUserData["properties"]["names"],
                "password" => $password
            ]); 
        }  

         /* ya con el usuario actualizamos o creamos el organizationUser */         
        $matchAttributes = ["organization_id" => $organization_id, "account_id" => $user->_id];
        $data += $matchAttributes;                          
        $model = OrganizationUser::where($matchAttributes)->first();

        //Account rol assigned by default
        if (!isset($data["rol_id"])) {
            $data["rol_id"] = Rol::ID_ROL_ATTENDEE;
        }

        if ($model) {
            //Si algun campo no se envia para importar, debe mantener los datos ya guardados en la base de datos
            $data["properties"] = array_merge($model->properties, $data["properties"]);
            $model->update($data);        
        } else {
            $model = OrganizationUser::create($data);
        }

        //Add the member in all Events of the orgnization
        OrganizationServices::createMembers($model);

        // Send the invitation email
        if ($email) {
            Log::debug("Send email to ".$email);
            $subject = "Invitación a " . $organization->name . " - GEN.iality";
            $link = "" . config('app.front_url') . "/" . "organization/" . $organization['_id'] . "/events";
            $clientName = isset($model["properties"]["names"]) ? $model["properties"]["names"] : "Sumercé";
            Log::debug("The invitation link is " . $link . "is going to be sent to " . $clientName);

            $emailObject = new \App\Mail\OrganizationUserMail(
                $email,
                $subject,
                $organization,
                $clientName,
                $link,
            );
            try {
                Mail::to($email)->queue($emailObject);
            } catch (\Throwable $th) {
                Log::error("Cannot send email to ".$email." because: ".$th->getMessage());
            }
        }

        // $response = new OrganizationUserResource($organizationUser);
        return $model;
    }
  
    /**
     * _update_: update a register user in organization.
     * 
     * @autenticathed
     * 
     * @urlParam organization required organization id
     * @urlParam user  required organization id
     * 
     */
    public function update(Request $request, $organization_id, $organization_user_id)
    {        
        $data = $request->json()->all();
        $userOrganization = OrganizationUser::findOrFail($organization_user_id);
        if (!isset($data["rol_id"])) {
            $userOrganization["rol_id"] = Rol::ID_ROL_ATTENDEE;
        } else {
            $userOrganization["rol_id"] = $data["rol_id"];
        }
        $userOrganization->properties = $data;

        // Log::debug("new payment_plan: ".json_encode($data['payment_plan']));

        // if (isset($data['payment_plan'])) {
        //     $userOrganization['payment_plan'] = null;
        //     Log::debug("user id: " . $userOrganization["account_id"] . " and org user id: " . $userOrganization["_id"] . " changed payment plan to " . json_encode($data['payment_plan']));
        //     $userOrganization['payment_plan'] = $data['payment_plan'];
        // } else if ($data['payment_plan'] == null) {
        //     // Remove the payment
        //     $userOrganization['payment_plan'] = null;
        // }
        $userOrganization->save();
        return $userOrganization;
    }

    /**
     * _destroy_: delete a sapcific user in the organization
     * @autenticathed
     * 
     * @urlParam organization required organization id
     * @urlParam organizationuser  required organization user id
     */
    public function destroy(Request $request, $organization_id, $organization_user_id)
    {
        $userOrganization = OrganizationUser::findorfail($organization_user_id);
        $events = Event::where("organizer_id", $userOrganization->organization_id)->get();
        foreach ($events as $event) {
            $attendee = Attendee::where('account_id', $userOrganization->account_id)
                ->where('event_id', $event["_id"])
                ->first();
            if ($attendee) {
                Log::debug("attendee get be deleted");
                $attendee->delete();
            }
        }
        return (string) $userOrganization->delete();
    }

    /**
     * Get user organizations
     * This controller get the organizations of user.
     *
     */
    public function userOrganizations($user_id)
    {
        $OrganizationsUser = OrganizationUserResource::collection(
            OrganizationUser::where('userid', $user_id)
                ->paginate(config('app.page_size'))
        );
        return $OrganizationsUser;
    }

    /**
     * _meOrganizations_: list user's organizations.
     * These organizations
     * @authenticated
     * 
     */
    public function meOrganizations(Request $request)
    {   
        $user = Auth::user();
        $query =  OrganizationUser::where('account_id' , $user->_id)->paginate(config('app.page_size'));

        return OrganizationUserResource::collection($query);
    }

    /**
     * _show_: view a specific organization user
     * @authenticated
     * 
     * @urlParam organization The id of the organization
     * @urlParam organizationuser The id of the organization
     */
    public function show($organizaton_id, $orgUser)
    {   
        $query = OrganizationUser::findOrFail($orgUser);
        return $query;
    }

    /**
     * _meInOrganization_: view the information an user specific into an organization
     * @authenticated
     * 
     * @urlParam organization The id of the organization
     */
    public function meInOrganization($organizaton_id)
    {
        $user = Auth::user();
        $query =  OrganizationUser::where('account_id' , $user->_id)
                    ->where('organization_id' , $organizaton_id)
                    ->paginate(config('app.page_size'));

        return $query;
    }

    public function searchCertificatesByUser(Request $request, $organization_id, $user_id) {
        // IDK, I saw that in another file
        $firestore = new FirestoreClient([
            'keyFilePath' => base_path('firebase-credentials.json')
        ]);

        $user = Account::findOrFail($user_id);
        $organization = Organization::with('events')->findOrFail($organization_id);
        Log::debug("user: " . $user->names . " id: " . $user->_id);
        Log::debug("organization: " . $organization->name . " id: " . $organization->_id);

        $organization_user = OrganizationUser::where('account_id', $user->_id)
            ->where('organization_id' , $organization->_id)
            ->first();

        $events = Event::where('organizer_id', $organization_id)->get();

        $allCerts = [];

        foreach ($events as $event) {
            // Get all the certificates
            $eventUser = Attendee::where('event_id', $event->_id)
                ->where('account_id', $user->_id)
                ->first();
            if (!$eventUser) {
                Log::error("User id:$user->_id  has no attendee for event: $event->_id ($event->name)");
                continue;
            }
            $certs = Certificate::where('event_id' , $event->_id)->get();

            if (count($certs) == 0) {
                continue;
            }

            $raw_activities = Activities::where("event_id", $event->_id)->get();
            Log::debug("event $event->_id has " . count($raw_activities) . " activities");

            // Get the event rols
            $rols = Rol::where('event_id' , $event->_id)->get();
            $defaultRol = Rol::where('module' , Rol::MODULE_SYSTEM)->get();
            $rols = $rols->concat($defaultRol);

            // Filter the certs by rols
            $filteredCertsByRols = [];

            foreach ($certs as $cert) {
                // Take the default cert that is which does not have rol
                if (isset($cert['rol_id'])) {
                    // Add certs that rol is the user rol
                    $isValidatedByRol = false;
                    if (isset($eventUser->rol_id)) {
                        foreach ($rols as $rol) {
                            if ($rol->_id == $eventUser->rol_id) {
                                Log::debug("user has required rol");
                                $isValidatedByRol = true;
                                break;
                            }
                        }
                    }
                    if ($isValidatedByRol) {
                        foreach ($certs as $cert) {
                            if ($cert->rol_id == $eventUser->rol_id) {
                                Log::debug("cert '$cert->name' is available for user $user->_id");
                                $filteredCertsByRols[] = $cert;
                            }
                        }
                    }
                } else {
                    Log::debug('Add as DEFAULT cert: ' . $cert->name);
                    $filteredCertsByRols[] = $cert;
                }
            }

            Log::debug("user has " . count($filteredCertsByRols) . " certs available (maybe)");

            // Some certs need a progress
            $passedCerts = [];
            foreach ($filteredCertsByRols as $cert) {
                if (isset($cert['required_attendee_type']) && is_array($cert['required_attendee_type'])) {
                    $required_attendee_type = $cert['required_attendee_type'];
                    if (count($required_attendee_type) == 0) {
                        // No requirements
                        $passedCerts[] = $cert;
                        continue;
                    }

                    if (!isset($eventUser['properties']) || !isset($eventUser['properties']['tipoDeAsistente'])) {
                        // Sure the admin set some require attendee type, BUT the user has no one
                        continue;
                    }

                    $doesUserHavePermission = false;
                    foreach ($required_attendee_type as $requirement) {
                        if ($requirement == $eventUser['properties']['tipoDeAsistente']) {
                            Log::debug("user meets the requirement of $requirement");
                            $doesUserHavePermission = true;
                            break;
                        } else {
                            Log::debug("user DOES NOT meet the requirement of $requirement");
                        }
                    }
                    if ($doesUserHavePermission) {
                        $passedCerts[] = $cert;
                    }
                }

                if (!isset($cert['requirement_config']) || !$cert['requirement_config']['enable']) {
                    Log::debug("cert '$cert->name' has no requirement config");
                    $passedCerts[] = $cert;
                    continue;
                }

                // Filter by ignored activities
                $activityTypesToIgnore = [];
                if (is_array($cert['requirement_config']['ignore_activity_type'])) {
                    $activityTypesToIgnore = $cert['requirement_config']['ignore_activity_type'];
                }

                // Some certs could want to ignore some activity types
                $activitiesCertWants = [];
                foreach ($raw_activities as $activity) {
                    if (isset($activity['type'])) {
                        $isIn = false;
                        foreach ($activityTypesToIgnore as $ignorable) {
                            if (isset($activity['type']['name']) && $ignorable == $activity['type']['name']) {
                                $isIn = true;
                                break;
                            }
                        }
                        if (!$isIn) {
                            $activitiesCertWants[] = $activity;
                        }
                    }
                }
                Log::debug("activitiesCertWants: ".count($activitiesCertWants));

                // Get the non-published activities
                $non_published_activity_ids = [];
                foreach ($activitiesCertWants as $activity) {
                    $ref = $firestore->collection('events')
                        ->document($event->_id)
                        ->collection('activities')
                        ->document($activity->_id);
                    $snapshot = $ref->snapshot();
                    if ($snapshot->exists()) {
                        $data = $snapshot->data();
                        if (!$data['isPublished']) {
                            $non_published_activity_ids[] = $activity->_id;
                        }
                    }
                }

                // Get attendees to calc the progress...
                $attendeesWithCheckedIn = [];
                foreach ($activitiesCertWants as $activity) {
                    if (in_array($activity->_id, $non_published_activity_ids)) {
                        Log::debug("ignore non-published: $activity->name");
                        continue;
                    }
                    $ref = $firestore->collection($activity->_id."_event_attendees")->document($eventUser->_id);
                    $snapshot = $ref->snapshot();
                    if ($snapshot->exists()) {
                        $data = $snapshot->data();
                        if ($data['checked_in']) {
                            $attendeesWithCheckedIn[] = $data;
                        }
                    }
                }

                $percent = 0;
                if (count($attendeesWithCheckedIn) == 0) {
                    $percent = 0;
                } else {
                    $percent = round((
                        max(
                            count($attendeesWithCheckedIn),
                            count($activitiesCertWants),
                        )
                        /
                        min(
                            count($attendeesWithCheckedIn),
                            count($activitiesCertWants),
                        )
                    ) * 100);
                    Log::debug("percent = $percent");
                }

                $requiredPercent = isset($cert['requirement_config']['completion']) ? $cert['requirement_config']['completion'] : 0;
                Log::debug("$percent > $requiredPercent:");
                if ($percent >= $requiredPercent) {
                    Log::debug("OK");
                    $passedCerts[] = $cert;
                } else {
                    Log::debug("BAD");
                }
            }

            // For each event we take the available and passed certs
            // $allCerts[] = $passedCerts;
            $allCerts = array_merge($allCerts, $passedCerts);
        }

        Log::debug("total certs: " . count($allCerts));

        return response()->json(["certificates" => $allCerts]);
    }

    public function searchCandidatesForCertificates(Request $request, $organization_id) {
        $pattern = $request->query('pattern');
        if (!$pattern) {
            return response()->json(["error" => "Missing the pattern of searching"], 400);
        }

        Log::debug("searching organization member for: '".$pattern."' (orgId: ".$organization_id.")");

        $results = [];

        $events = Event::where("organizer_id", $organization_id)->get();
        foreach ($events as $event) {
            $eventUsers = $event->eventUsers;
            foreach ($eventUsers as $eventUser) {
                $valoration = $this->calculateMatching($eventUser, $pattern);
                if ($valoration > 0) {
                    $results[] = [
                        "eventUser" => [
                            "account_id" => $eventUser["account_id"],
                            "user" => [
                                "_id" => $eventUser['user']['_id'],
                                "names" => $eventUser['user']['names'],
                                "email" => $eventUser['user']['email'],
                            ],
                        ],
                        "valoration" => $valoration,
                    ];
                }
            }
        }

        Log::debug("found ".count($results)." results");

        return response()->json(["searching" => $results]);
    }

    private function calculateMatching($organizationUser, $pattern) {
        $value = 0.0;

        /**
         * For each name in names
         */
        $total = 0.0;
        $similation = 0.0;

        // For the names, we split by spaces and eval each word
        if (!isset($organizationUser->user)) {
            Log::debug("organization user without user: ".json_encode($organizationUser));
            return 0;
        }

        if (strtolower($organizationUser->user->names) == strtolower($pattern)) {
            return 99999;
        }
        if (strtolower($organizationUser->user->email) == strtolower($pattern)) {
            return 99999;
        }


        $names = explode(' ', $organizationUser->user->names);
        for ($i = 0; $i < count($names); $i++) {
            $parts = explode(' ', $pattern);

            $localSimilation = 0.0;
            $localTotal = 0.0;

            for ($j = 0; $j < count($parts); $j++) {
                $result = similar_text(strtolower($names[$i]), strtolower($parts[$j]));
                $localSimilation += $result;
                $localTotal += strlen($names[$i]);
            }

            $similation += $localSimilation;
            $total += $localTotal;
        }

        if ($total > 0) {
            $value += ($similation / $total) * 10;
        }

        /**
         * Calc the similation for the whole names
         */
        $wholeNamesSimilation = similar_text(strtolower($organizationUser->user->names), strtolower($pattern));
        $similation = $wholeNamesSimilation;
        $total = strlen($organizationUser->user->names);

        if ($total > 0) {
            $value += ($similation / $total)*40;
        }

        /**
         * Calc the similation for the email
         */
        $emailSimilation = similar_text(strtolower($organizationUser->user->email), strtolower($pattern));
        $similation = $emailSimilation;
        $total = strlen($organizationUser->user->email);

        if ($total > 0) {
            $value += ($similation / $total) * 100;
        }

        /**
         * Returns the result
         */
        if ($total == 0) return 0;
        
        return $value;
    }
}
