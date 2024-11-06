<?php

namespace App\Http\Controllers;

use App\Event;
use App\Activities;
use App\Inscription;
use App\Attendee;
use App\ActivityAssistant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @resource Event
 *
 *
 */
class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        return JsonResource::collection(
            Inscription::where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    /**<
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
       
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $result = new Inscription($data);
        $result->save();
        return $result;
    }
    public function activitieAssistant(Request $request, $event_id, $activity_id)
    {
        $save = Attendee::find("5bbf74693dafc21c04524d46");
        
     
        echo var_dump($save->properties["email"]);die;
        $data = $request->json()->all();
        $data["activity_id"] = $activity_id;
        $result = new ActivityAssistant($data);
        $search = ActivityAssistant::where("activity_id",$activity_id)->get();
        $arr = json_decode(json_encode($search), TRUE);
        if(empty($arr)){
            $result->save();
            return $result;
        }else{
            $search = ActivityAssistant::where("activity_id",$activity_id)->get();
            $search = ActivityAssistant::find($search[0]["_id"]);
            $search->push("user",$data["user"]);

            /*
            * calcular cupos restantes
            */
            $actualUsers = $search["user"]; //extrae los usuarios
            $actualUsers = sizeof($actualUsers); //mide el array de usuarios 
            $totalCapacity = Activities::find($activity_id)->capacity; // capacidad actual de la actividad 
            $remaining = $totalCapacity - $actualUsers;  //calculos
            $remainingCapacity = Activities::find($activity_id); 
            $remainingCapacity->remaining_capacity = $remaining;
            $remainingCapacity->save(); //guarda el resultado
            echo "- usuarios actuales = ".$actualUsers ."- capacidad total = ". $totalCapacity . "- cupos restantes = " . $remaining;

            return $data;
        }
    }
    public function updateUserActivities(Request $request, $event_id, $activity_id)
    {
        //ACTUALIZAR ACTIVIDADES DE LOS USUARIOS
       $activityUsers = ActivityAssistant::paginate();
       
         for($i=0;$i < sizeof($activityUsers);$i++){
            for($s=0;$s < sizeof($activityUsers[$i]["user"]);$s++){
                $activity_id = $activityUsers[$i]["activity_id"];
                $activity = Activities::find($activity_id);
                
                if(!is_null($activity)){
                    $noid = $activity->makeHidden(["space_id","remaining_capacity","capacity","activity_categories_ids","activity_categories_ids","activity_categories_ids","host_ids","quantity","image","activity_categories","space","users","hosts","type"]);
                    $noid = json_decode(json_encode($noid),TRUE);
                    $user_id = ($activityUsers[$i]["user"][$s]);
                    $save = Attendee::find($user_id);
                    if (!is_null($save)){
                        $save->push("activities",$noid );
                        return "users activities saved";
                    }
                }
            }
        }
    }

     public function deleteAssistant(Request $request, $event_id, $activity_id)
     {
        $data = $request->json()->all();
       // $data["activity_id"] = $activity_id;
        $user = $data["user"][0];
        $search = ActivityAssistant::where("activity_id",$activity_id)->get();
        $search2 = ActivityAssistant::find($search[0]["_id"]);
        $search = ActivityAssistant::find($search[0]["_id"])->user;
        $x = 0;
        $arrayUsers = $search;
        //mapea el array para
        foreach($arrayUsers as $arrayUser){
            if($arrayUser == $user){
                unset($arrayUsers[$x]);
            }
            $x++;
        }
        $search2->user = $arrayUsers;
        $search2->push();
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inscription  $Inscription
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id)
    {
        $Inscription = Inscription::findOrFail($id);
        $response = new JsonResource($Inscription);
        //if ($Inscription["event_id"] = $event_id) {
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inscription  $Inscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $space = Inscription::findOrFail($id);
        //if($Inscription["event_id"]= $event_id){
        $space->fill($data);
        $space->save();
        return $data;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $Inscription = Inscription::findOrFail($id);
        return (string) $Inscription->delete();
    }
}
