<?php

namespace App\Http\Controllers;

use App\Mailing;
use Mail;
use App\Event;
use App\Attendee;
use App\Mail\reminder;
use App\Mail\friendRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
/**
 * @resource Event
 */
class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        return JsonResource::collection(
            Mailing::where("event_id", $event_id)->paginate(config('app.page_size'))
        );
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
        $mails = $data["mails"];
        $data["img"] = false;
        if($event_id == "5e1ceb50d74d5c1064437aa2"){
            $data["img"] = true;
        }
        echo $data["img"];
        $result = new Mailing($data);
        $title = $data["title"];    
        $desc = $data["desc"];
        $img = $data["img"];
        $sender = $data["sender"];
        $subject = $data["subject"];
        $result->save();
        $email = Attendee::where("event_id",$event_id)->where("email",$mails)->get();
        $list = json_decode(json_encode($email),true);
        
        echo var_dump($list);
        foreach ($mails as $key => $value) {
            
            Mail::to($value)->send(
            new reminder($event_id,$title,$desc,$subject,$img,$sender)
        );
        }
        //return $result;
    }
    /* FRIEND REQUEST */
    public function storeFriendRequest(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $mails = $data["mails"];
        $data["type"] = "friend request";
        $data["img"] = false;
        if($event_id == "5e1ceb50d74d5c1064437aa2"){
            $data["img"] = true;
        }
        echo $data["img"];
        $result = new Mailing($data);
        $title = $data["title"];    
        $desc = $data["desc"];
        $img = $data["img"];
        $sender = $data["sender"];
        $subject = $data["subject"];
        $result->save();
        $email = Attendee::where("event_id",$event_id)->where("email",$mails)->get();
        $list = json_decode(json_encode($email),true);
        
        echo var_dump($list);
        foreach ($mails as $key => $value) {
            
            Mail::to($value)->send(
            new friendRequest($event_id,$title,$desc,$subject,$img,$sender)
        );
        }
        //return $result;
    }




    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $mail = Mailing::findOrFail($id);
        //if($Space["event_id"]= $event_id){
        $mail->fill($data);
        $mail->save();
        return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Mail  $Mail
     * @return \Illuminate\Http\Response
     */

     
    public function show($event_id,$id)
    {
        $Mail = Mailing::findOrFail($id);
        $response = new JsonResource($Mail);
        //if ($Mail["event_id"] = $event_id) {
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
        $Mail = Mailing::findOrFail($id);
        return (string) $Mail->delete();
    }

    /**
     * 
     */
    public function updateSengrid(Request $request){

        $data = $request->json()->all();

        $client = new Client();

        #$headers =  [ 'Authorization' => ''];
        #$url = 'https://api.sendgrid.com/v3/marketing/contacts';

       
        $request = $client->put($url,         
            ['json' => [
                    // "list_ids" => $data["list_ids"],
                    "contacts" => $data["contacts"],                    
     
               
                ],
                'headers' => $headers,
                'debbug' => false
            ],
            
        ); 
        return  $request;

    }
}
