<?php

namespace App\Http\Controllers;

use App\Event;
use App\Activities;
use App\Attendee;
use Mail;
use Auth;
use App\ActivityAssistant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Validator;
use App\State;
use App\Account;
use Illuminate\Http\Response;
use App\evaLib\Services\FilterQuery;
use App\Http\Requests\EventUserRequest;
use App\Http\Resources\EventUserResource;
use App\evaLib\Services\UserEventService;


/**
 * @group  ActivityAssistant
 *
 *
 */
class ActivityAssistantController extends Controller
{

    /**
     * _borradorepetidos_: Eliminate duplicate user records in activities
     *
     * @urlParam activity_id
     * 
     * @param Request $request
     * @param [type] $activity_id
     * @return void
     */
    public function borradorepetidos(Request $request, $activity_id)
    {

        $ActivityUsers = ActivityAssistant::where('activity_id', "=", $activity_id)->get();
        // var_dump($ActivityUsers);die;

        $ids = [];
        var_dump(count($ActivityUsers));
        foreach ($ActivityUsers as $key => $activitiUser) {
            $ids[$activitiUser->user_id] = $activitiUser->_id;
        }
        $ActivityUsers = ActivityAssistant::where('activity_id', "=", $activity_id)->whereNotIn('_id', $ids)->get();
        var_dump(count($ActivityUsers));

        $ActivityUsers = ActivityAssistant::where('activity_id', "=", $activity_id)->whereNotIn('_id', $ids)->delete();

        // var_dump(count($ActivityUsers));die;

    }


    /**
     * _fillassitantsbug_:sisplay the specified resource.
     *
     * @param  \App\Inscription  $Inscription
     * @return \Illuminate\Http\Response
     */
    public function fillassitantsbug($id)
    {
        // $ActivityAssistant = ActivityAssistant::all();
        //Esta activityassistant se perdio 5dbc99bad74d5c5822693842
        $ActivityAssistant = ActivityAssistant::find($id);
        if ($ActivityAssistant)
            $ActivityAssistant->save();

        var_dump($ActivityAssistant->user_ids);
        $response = new JsonResource($ActivityAssistant);
        var_dump($response);
        die;
    }



    /**
     * _index_: List of the activity_assitans 
     * 
     * @urlParam event_id required Example: 5ed3ff9f6ba39d1c634fe3f2
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        $activity_id = $request->input("activity_id");
        $user_id = $request->input("user_id");

        $query = ActivityAssistant::where("event_id", $event_id);

        //Filtro por actividad
        if ($activity_id) {
            $query->where("activity_id", $activity_id);
        }

        //Filtro por usuario
        if ($user_id) {
            $query->where("user_id", $user_id);
        }

        return JsonResource::collection($query->paginate(config('app.page_size')));
    }


    /**
     * _indexForAdmin_: list the activities and users that will attend from the administrator
     * 
     * @urlParam event_id required Example: 5f0622f01ce76d5550058c32
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForAdmin(Request $request, $event_id)
    {
        $activity_id = $request->input("activity_id");
        $user_id = $request->input("user_id");

        $query = ActivityAssistant::where("event_id", $event_id);

        //Filtro por actividad
        if ($activity_id) {
            $query->where("activity_id", $activity_id);
        }

        //Filtro por usuario
        if ($user_id) {
            $query->where("user_id", $user_id);
        }


        //$usuarios_ids = $query->pluck('user_id')->toArray();
        $activity_attendees = $query->get();
        $usuarios_ids = $activity_attendees->pluck('user_id')->toArray();

        //extraemos los attendees relacionados
        //->whereIn('account_id',$usuarios_ids)-
        $event_attendees = Attendee::where("event_id", $event_id)->get()->keyBy("account_id");
        $total = 0;
        foreach ($activity_attendees as $key => $attendee) {
            if (isset($event_attendees[$attendee['user_id']])) {
                $activity_attendees[$key]["attendee"] = $event_attendees[$attendee['user_id']];
            }
        }
        return JsonResource::collection($activity_attendees);
    }

    /**
     * _meIndex_: list of registered activities of the logged-in user
     * 
     * @authenticated
     * @urlParam event_id required event to which the activity belongs
     * 
     * 
     * @param string $event_id
     * @return void
     */
    public function meIndex($event_id)
    {
        $user = auth()->user();
        return JsonResource::collection(ActivityAssistant::where("user_id", $user->_id)->paginate(config('app.page_size')));
    }
    /**
     * _store_: create new record activity_assitant
     *
     * @urlParam event_id required event to which the activity belongs
     * 
     * @bodyParam user_id required id of the user who signs up for the activity Example: 5e9caaa1d74d5c2f6a02a3c2
     * @bodyParam activity_id id of the activity to which the user subscribes Example: 5fa44f6ba8bf7449e65dae32
     * 
     * @response {
     *    "user_id": "6026b57a11dbd7582d770e5a",
     *    "activity_id": "60804c6e6b7150714f20d122",
     *    "event_id": "5fa423eee086ea2d1163343e",
     *    "updated_at": "2021-04-21 16:48:14",
     *    "created_at": "2021-04-21 16:48:14",
     *    "_id": "6080574edccc122ed71f7b24"
     * }
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        //$data["user_id"] $data["activity_id"]  $data["event_id"]
        $data["event_id"] = $event_id;
        $rules = [
            'user_id' => 'required',
            'activity_id' => 'required'
        ];
        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }

        $query = [
            'user_id' => $data["user_id"],
            'activity_id' => $data["activity_id"]
        ];

        //reduceAvailability   
        $activityAssistant = ActivityAssistant::updateOrCreate($query,$data);
        $activityAssistant->save();


        // $user     = Account::find($data["user_id"]);
        // $activity = Activities::find($data["activity_id"]);


        // $subject = "Confirmación de registro a ".$activity->name;
        // Mail::to($user->email)
        // ->queue(
        //     //string $message, Event $event, $eventUser, string $image = null, $footer = null, string $subject = null)
        //     new \App\Mail\ActivityRegistration($subject,$activityAssistant,$activity)
        // );



        return $activityAssistant;
    }

    /**
     * _reduceAvailability_:this endpoint allows you to discount the availability of each activity for each user who signs up.
     *
     * @return void
     */
    private function  reduceAvailability()
    {
        $activity_id      = $data["activity_id"];
        $model = ActivityAssistant::where("activity_id", $activity_id)->first();

        if (!is_null($model)) {

            $user_ids = $model->user_ids;
            $activity = Activities::find($activity_id);
            $capacity = $activity->capacity;

            if (sizeof($user_ids) < $capacity) {

                if (ActivityAssistant::where("user_ids", $data["user_id"])->first()) {
                    return "Usuario ya se encuentra inscrito a la actividad";
                }

                $new_user = [$data["user_id"]];
                $users_merge["user_ids"] = array_merge($new_user, $user_ids);
                $model->fill($users_merge);
                $model->save();

                $activity->remaining_capacity = $capacity - sizeof($users_merge["user_ids"]);
                $activity->save(); //guarda el resultado            
                return $model;
            } else {
                return "Capacidad completada, le invitamos a visitar otras actividades";
            }
        }
    }


    public function deleteAssistant(Request $request, $event_id, $activity_id)
    {
        $data = $request->json()->all();
        //$activitysize = $data["acitivity_id"];

        $activityname = Activities::find($data["activity_id"])->name;
        $data["name"] = $activityname;

        $useremail = $data["user_email"];

        $activityname = str_replace(" ", "%20", $activityname);
        $data["url"] = "https://docs.google.com/forms/d/e/1FAIpQLSeKIA54wmkCOL38EZ8rUpEJWN86xqqQuHDDsYfW1_WoHwWtLg/viewform?usp=pp_url&entry.230442346=" . $activityname;
        echo $data["url"];
        $data["activity_name"] = $activityname;
        Mail::send("Public.ViewEvent.Partials.SuggestedSchedule", $data, function ($message) use ($useremail, $activityname) {
            $message->to($useremail, "Asistente")
                ->subject("Encuesta de satisfacción MEC 2019", "");
        });

        // 
        /* 
        //$users = Attendee::find();
        $data = $request->json()->all();
        
        $models = ActivityAssistant::find("5dc60295d74d5c74ff2d4af2")->user_ids;
        $modelreplace = ActivityAssistant::find("5dc60295d74d5c74ff2d4af2");
        $activitysize = Activities::find($modelreplace->activity_id)->capacity;
        
        $arrayusers = $models;
        $x = 0;
        $activitysize = $activitysize-1 ;
        foreach($arrayusers as $arrayuser){
                    
                    $useremail = Attendee::find($arrayuser)->email;
                    $firebase = $this->auth->getUserByEmail($useremail);
                    echo $firebase;
                    
                    echo "correo enviado".$useremail.$x;
                    $data["activity_name"] = Activities::find($modelreplace->activity_id)->name;
                    $firebase = ($useremail);
                    
                    /* Mail::send("Public.ViewEvent.Partials.SuggestedSchedule",$data , function ($message) use ($useremail){
                        $message->to($useremail,"Asistente")
                        ->subject("Aforo completado, te invitamos a estas actividades","");
                    }); */

        //unset($arrayusers[$x]);
        //$x++;


        /*
        $modelreplace->user_ids = $arrayusers;
        $modelreplace->push();

        $actualUsers = $modelreplace["user_ids"]; //extrae los usuarios
        $actualUsers = sizeof($actualUsers); //mide el array de usuarios 
        $totalCapacity = Activities::find($modelreplace->activity_id)->capacity; // capacidad actual de la actividad 
        $remaining = $totalCapacity - $actualUsers;  //calculos                
        $remainingCapacity = Activities::find($modelreplace->activity_id); 
        $remainingCapacity->remaining_capacity = $remaining;
        $remainingCapacity->save(); //guarda el resultado   
        */
        /* LO INICIAL NO ELIMINAR PERO USAR 
        $data = $request->json()->all();
        $activity_id =$data["activity_id"];
        $user = $data["user_id"];
        $model = ActivityAssistant::where("activity_id",$activity_id)->get();
        $modelreplace = ActivityAssistant::find($model[0]["_id"]);
        $model = ActivityAssistant::find($model[0]["_id"])->user_ids;
       
        $arrayUsers = $model;
        //mapea el array para detectar el usuario que se le parezca
        foreach($arrayUsers as $arrayUser){
            if($arrayUser == $user){
                unset($arrayUsers[$x]);
            }
            $x++;
        }
        $modelreplace->user_ids = $arrayUsers;
        $modelreplace->push();*/
        /*
            * calcular cupos restantes
            */
        /*
            $actualUsers = $modelreplace["user_ids"]; //extrae los usuarios
            $actualUsers = sizeof($actualUsers); //mide el array de usuarios 
            $totalCapacity = Activities::find($activity_id)->capacity; // capacidad actual de la actividad 
            $remaining = $totalCapacity - $actualUsers;  //calculos                
            $remainingCapacity = Activities::find($activity_id); 
            $remainingCapacity->remaining_capacity = $remaining;
            $remainingCapacity->save(); //guarda el resultado   

        return $modelreplace;*/
    }

    /**
     * _show_: view the specific information of an activity_assitant record
     * 
     * @urlParam event_id required event to which the activity belongs Example: 5ed3ff9f6ba39d1c634fe3f2
     * @urlParam activities_attendee id de activity_assitant Example: 5ed66ce2a6929562725bd7c2
     * 
     * @param  \App\Inscription  $Inscription
     * @return \Illuminate\Http\Response
     */
    public function show($event_id, $id)
    {
        $ActivityAssistant = ActivityAssistant::findOrFail($id);
        $response = new JsonResource($ActivityAssistant);
        //if ($Inscription["event_id"] = $event_id) {
        return $response;
    }
    /**
     * _update_:Update the specific information of an activity_assitant record
     * 
     * @urlParam event_id required event to which the activity belongs
     * @urlParam id id de activity_assitant
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscription  $Inscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {

        $data = $request->json()->all();
        //Esto esta aca por un error en las rutas, la ruta del checkin del front dirige es aqui toca cambiarlo emergencia
        if (isset($data["user_id"])  && isset($data["activity_id"])  && isset($data["checkedin_at"])) {
            $activityAssistant = null;
            $activityAssistant = ActivityAssistant::where("activity_id", $data["activity_id"])
                ->where("user_id", $data["user_id"])->first();
            if (!$activityAssistant) {
                $activityAssistant = new ActivityAssistant($data);
            } else {
                $activityAssistant->fill($data);
                $activityAssistant->save();
            }
            return $activityAssistant;
        } else {
            $ActivityAssistant = ActivityAssistant::findOrFail($id);

            $ActivityAssistant->fill($data);
            $ActivityAssistant->save();
            return $data;
        }
    }

    /**
     * _destroy_:Remove the specific register of an activity_assitant record
     * 
     * @urlParam event_id required event to which the activity belongs
     * @urlParam id id of activity_assitant to remove
     * 
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $ActivityAssistant = ActivityAssistant::findOrFail($id);
        return (string) $ActivityAssistant->delete();
    }

    /**
     * _checkIn_: status indicating that the user entered the activity
     * 
     * @urlParam event_id required event to which the activity belongs
     * @urlParam id id of activity_assitant
     * 
     * @param Request $request
     * @param string $event_id
     * @param string $id
     * @return void
     */
    public function checkIn(Request $request, $event_id, $id)
    {

        $ActivityAssistant = ActivityAssistant::findOrFail($id);
        $date = new \DateTime();

        /*Se realiza validación para que la fecha y hora del checkIn sea siempre el primero 
        y no se actualice en caso de que el usuario vuelva a ingresar a la actividad*/
        if (!isset($ActivityAssistant->checkedin_at)) {
            $ActivityAssistant->fill(['checkedin_at' => $date]);
        }
        $ActivityAssistant->printouts  = $ActivityAssistant->printouts + 1;
        $ActivityAssistant->save();
        return $ActivityAssistant;
    }



    public function checkInWithSearch(Request $request, $event_id)
    {
        $data = $request->json()->all();
        var_dump($data);
        die;
        $ActivityAssistant = ActivityAssistant::findOrFail($id);
        $date = new \DateTime();
        $ActivityAssistant->fill(['checkedin_at' => $date]);
        $ActivityAssistant->save();

        return $ActivityAssistant;
    }

    /**
     * _totalMetricsByActivity_
     * @autenticathed
     * 
     * @urlParam event_id
     * 
     */
    public function totalMetricsByActivity($event_id)
    {

        $activities = Activities::where('event_id', $event_id)->get();

        $activityMetrics = [];

        foreach ($activities as $activity) {

            $checkIn = ActivityAssistant::where('activity_id', $activity->_id)->where('checked_in', '!=', false)->count();

            $printouts = ActivityAssistant::where('activity_id', $activity->_id)->where('printouts', '>', 0)->pluck('printouts');
            $totalPrintouts = 0;
            foreach ($printouts as $printout) {
                $totalPrintouts = $totalPrintouts +  $printout;
            }

            $activityAssistant = response()->json([
                '_id' => $activity->_id,
                'name' => $activity->name,
                'total_checkIn' => $checkIn,
                'total_printouts' => $totalPrintouts
            ]);

            array_push($activityMetrics, $activityAssistant->original);
        }

        return $activityMetrics;
    }

    
}
