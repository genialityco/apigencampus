<?php

namespace App\Http\Controllers;

use App\Event;
use App\Attendee;
use App\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @resource Event
 *
 *
 */
class PushNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        return JsonResource::collection(
            PushNotification::where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    public function indexByUser(Request $request, $event_id, $id)
    {
        $save = PushNotification::find($notification['_id']);
        $userdelete = array_splice($save->User_ids,$id);
        $save->fill($userdelete);
        $save->save();
        return 1 ;
        //use this
        return JsonResource::collection(
            PushNotification::where("event_id", $event_id)->where("User_ids",$id)->paginate(config('app.page_size'))
        );
    }

     
    public function deleteNotification(Request $request, $event_id, $id)
    {
            

    }   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $user_id = [];
        
        if(!empty($data["userEmail"])){
            $email = Attendee::where("event_id",$event_id)->where("email",$data["userEmail"])->get();
            $list = json_decode(json_encode($email),true); 
            foreach ($list as $value) {
                array_push($user_id,$value["_id"]);
            }
          
        }elseif (!empty($data["User_ids"])) {
            $user_id = $data["User_ids"];
        }else{
            $user_id = "";
        }

        $data['User_ids'] = $user_id;

        if(!empty($data["route"])){
            $route = $data["route"];
        }else{
            $route = "HomeScreen";
        }

        $eventId = $data["event_id"];
        $title = $data["title"];
        $body = $data["body"];

        $saveData = new PushNotification($data);
        $saveData->save();
        $fields = array('event_id' => $eventId, 'petitionId' => $saveData->_id ,'title' => $title, 'body' => $body , 'route' => $route , 'user_id' => $user_id);
        $headers = array('Content-Type: application/json');
        $url = config('app.pushdirection')."/pushNotification";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);
        curl_close($ch);

        return "enviado".json_decode($result,true);
    }
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $push = PushNotification::findOrFail($id);
        //if($Space["event_id"]= $event_id){
        $push->fill($data);
        $push->save();
        return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\PushNotification  $PushNotification
     * @return \Illuminate\Http\Response
     */

     
    public function show($event_id,$id)
    {
        $pushnotification = PushNotification::findOrFail($id);
        $response = new JsonResource($pushnotification);
        //if ($PushNotification["event_id"] = $event_id) {
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $pushnotification = PushNotification::findOrFail($id);
        return (string) $pushnotification->delete();
    }
}
