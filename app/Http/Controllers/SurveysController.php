<?php

namespace App\Http\Controllers;

use App\Event;
use App\Attendee;
use App\Survey;
use App\Activities;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Mail;
use App\evaLib\Services\MMasivoService;
use PUGX\Shortid\Shortid;

/**
 * @resource Event
 * @group Surveys
 *
 */
class surveysController extends Controller
{
    /**
     * _index_: list of surveys of an event
     * 
     * @urlParam id string  required event id Example: 605241e68b276356801236e4
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {   
        if($request->input("indexby") && $request->input("value")){
            $index = $request->input("indexby");
            $value = $request->input("value");
            return JsonResource::collection(
                Survey::where("event_id", $event_id)->where($index,$value)->paginate(config('app.page_size'))
            );
        }

        return JsonResource::collection(
            Survey::where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    /**
     * _store_: create a new survey
     * 
     * @urlParam    id                          string  required event id           Example: 605241e68b276356801236e4
     * 
     * @bodyParam   survey                      string  required name of survey     Example: Nombre de encuesta
     * @bodyParam   show_horizontal_bar         boolean                             Example: false
     * @bodyParam   allow_vote_value_per_user   boolean                             Example: false
     * @bodyParam   activity_id                 string                      
     * @bodyParam   points                      number                              Example: 1
     * @bodyParam   initialMessage              string                        
     * @bodyParam   time_limit                  number                              Example: 0
     * @bodyParam   allow_anonymous_answers     boolean                             Example: false
     * @bodyParam   allow_gradable_survey       boolean                             Example: false
     * @bodyParam   hasMinimumScore             boolean                             Example: false
     * @bodyParam   isGlobal                    boolean                             Example: false
     * @bodyParam   freezeGame                  boolean                             Example: false
     * @bodyParam   open                        boolean                             Example: false
     * @bodyParam   publish                     boolean                             Example: false
     * @bodyParam   minimumScore                number                              Exmaple: 0                       
     * 
     * @response{
     *     "survey": "Encuesta 1",
     *     "show_horizontal_bar": false,
     *     "allow_vote_value_per_user": "false",
     *     "event_id": "605241e68b276356801236e4",
     *     "activity_id": "",
     *     "points": 1,
     *     "initialMessage": null,
     *     "time_limit": 0,
     *     "win_Message": null,
     *     "neutral_Message": null,
     *     "lose_Message": null,
     *     "allow_anonymous_answers": "false",
     *     "allow_gradable_survey": "false",
     *     "hasMinimumScore": false,
     *     "isGlobal": false,
     *     "freezeGame": false,
     *     "open": "false",
     *     "publish": "false",
     *     "minimumScore": 0
     * }
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {   
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $result = new Survey($data);
        if(!empty($data["activity_id"]) ){
            $activity = Activities::find($data["activity_id"]);
            if(empty($activity->survey_ids)){
                $activities_array = [];
            }else{
                $activities_array = $activity->survey_ids;
            }   
            array_push($activities_array,$data["activity_id"]);
            $new_activities["survey_ids"] = $activities_array;
            $activity->fill($new_activities);
            $activity->save();

            $result->activities($data["activity_id"]);
            
        }
        $result->save();
        return $result; 
    }

    /**
     * _show_ : view the information of a specific survey
     * 
     * @urlParam id string      required event id  Example: 605241e68b276356801236e4
     * @urlParam survey string  required survey id  Example: 608c5f5f63201e0f5147a086
     *
     * @param  \App\survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id)
    {
        $survey = Survey::findOrFail($id);
        $response = new JsonResource($survey);
        //if ($survey["event_id"] = $event_id) {
        return $response;
    }
    /**
     * _update_: update a specific survey
     * @urlParam id string      required event id  Example: 605241e68b276356801236e4
     * @urlParam survey string  required survey id  Example: 608c5f5f63201e0f5147a086
     * 
     * @bodyParam   survey                      string  name of survey     
     * @bodyParam   show_horizontal_bar         boolean                   
     * @bodyParam   allow_vote_value_per_user   boolean                    
     * @bodyParam   activity_id                 string                      
     * @bodyParam   points                      number                     
     * @bodyParam   initialMessage              string                        
     * @bodyParam   time_limit                  number                    
     * @bodyParam   allow_anonymous_answers     boolean                    
     * @bodyParam   allow_gradable_survey       boolean                    
     * @bodyParam   hasMinimumScore             boolean                    
     * @bodyParam   isGlobal                    boolean                    
     * @bodyParam   freezeGame                  boolean                   
     * @bodyParam   open                        boolean              
     * @bodyParam   publish                     boolean                   
     * @bodyParam   minimumScore                number                     
     * 
     * @param  \Illuminate\Http\Request $request
     * @param  \App\survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $survey = Survey::findOrFail($id);
        //if($survey["event_id"]= $event_id){
        if($request->input("newquestion")){
            if(is_null($survey->questions)){
                $questions["questions"][0] = $data;
            }else{
                $questions["questions"] = $survey->questions;                
                array_push($questions["questions"],$data);
            }
        $survey->fill($questions);
        $survey->save();
        return $data;
        }
    
            
        //if(!empty($question)){
        //    $survey->questions = [];
        //}
        $survey->fill($data);
        $survey->save();
        return $data;
    }

    public function updatequestions(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $survey = Survey::findOrFail($id);
        if(is_integer($int = (int)$request->input("questionNo"))){

                //aqui se guarda la peticion
                $questions["questions"][$request->input("questionNo")] = $data;// = $survey->questions[$request->input("questionNo")];                
                //aqui se guardan los valores existentes de las preguntas de la bdd
                $final_merge["questions"] = $survey->questions;
                //aqui se combinan los valores de la pregunta a editar de la peticion y la base de datos
                $new_questions = array_merge($survey->questions[$request->input("questionNo")],$questions["questions"][$request->input("questionNo")]);
                //aqui la pregunta se actualiza 
                $final_merge["questions"][$request->input("questionNo")] = $new_questions;
                $survey->fill($final_merge);
                $survey->save();
                return $data;
            }
    return "no question id sent or invalid format";
    }
    /** 
     * _destroy_: delete a specific survey
     *
     * @urlParam id string      required event id  Example: 605241e68b276356801236e4
     * @urlParam survey string  required survey id  Example: 608c5f5f63201e0f5147a086
     * 
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $survey = Survey::findOrFail($id);
        if(!is_null($request->input("delete"))){
            $questionnumber = $request->input("delete");
            if(is_null($survey->questions)){
                return "todavia no se han creado preguntas.";
            }else{
                $questions["questions"] = $survey->questions;                
                unset($questions["questions"][$questionnumber]);
                $questions["questions"] = array_values($questions["questions"]);
            }
        $survey->fill($questions);
        $survey->save();
        return "pregunta eliminada";
        }
        return (string) $survey->delete();
    }

    public function redirectToLanding(Survey $survey)
    {
        /*
        $event_id = $survey->event_id;
        $event = Event::findOrFail($event_id);

        if(is_null($event->sms_notification) || $event->sms_notification == false){
            return response()->json([
                'message' => 'sms notification is disabled',
            ], 401);
        }
        $activity = Activities::findOrFail($survey->activity_id);
        $attendees = Attendee::where('event_id', $event_id)->get();

        foreach($attendees as $attendee){
            if(isset($attendee->activityProperties)){
                for ($i=0; $i < count($attendee->activityProperties); $i++) {
                    if($attendee->activityProperties[$i]['activity_id'] == $activity->id && $attendee->activityProperties[$i]['checked_in'] == true){
                        Mail::to($attendee->properties['email'])
                        ->send(
                        new \App\Mail\SurveyResponseMail($event, $survey->survey, $activity, $attendee)
                    );
                    }
                }
            }
        }
        */

        $event_id = $survey->event_id;
        $event = Event::findOrFail($event_id);

        if(is_null($event->sms_notification) || $event->sms_notification == false){
            return response()->json([
                'message' => 'sms notification is disabled',
            ], 401);
        }

        $activity = Activities::findOrFail($survey->activity_id);
        $attendees = Attendee::where('event_id', $event_id)->get();

        foreach($attendees as $attendee){
            Mail::to($attendee->properties['email'])
            ->send(
                new \App\Mail\SurveyResponseMail($event, $survey->survey, $activity, $attendee)
            );
        }
        
        return response()->json([
            'message' => 'survey sent',
        ], 200);
    }

    public function sendCode(Survey $survey, Attendee $eventuser)
    {
        $event = Event::findOrFail($survey->event_id);
        if(is_null($event->sms_notification) || $event->sms_notification == false){
            return response()->json([
                'message' => 'sms notification is disabled',
            ], 401);
        }
        $codeShort = Shortid::generate();
        $codeShort = strval($codeShort);
        $activity = Activities::findOrFail($survey->activity_id);
        $code_pdu = isset($activity->code_pdu) ? $activity->code_pdu : $codeShort;

        if(isset($eventuser->properties['email'])){
            Mail::to($eventuser->properties['email'])
                ->send(
                new \App\Mail\SurveyCodeMail($event, $survey, $eventuser, $code_pdu)
                );
            return response()->json([
                'message' => 'survey code sent',
            ], 200);
        }
    }

    public function redirectManualAll(Survey $survey)
    {
        $event_id = $survey->event_id;
        $event = Event::findOrFail($event_id);

        $activity = Activities::findOrFail($survey->activity_id);
        $attendees = Attendee::where('event_id', $event_id)->get();

        foreach($attendees as $attendee){
            Mail::to($attendee->properties['email'])
            ->send(
            new \App\Mail\SurveyResponseMail($event, $survey->survey, $activity, $attendee)
        );
                    
                
            
        }
    }

    public function sendCodeAll(Survey $survey)
    {
        $event_id = $survey->event_id;
        $event = Event::findOrFail($event_id);

        // if(is_null($event->sms_notification) || $event->sms_notification == false){
        //     return response()->json([
        //         'message' => 'sms notification is disabled',
        //     ], 401);
        // }
        // $codeShort = Shortid::generate();
        // $codeShort = strval($codeShort);
        $activity = Activities::findOrFail($survey->activity_id);
        $code_pdu = $activity->code_pdu;
        $attendees = Attendee::where('event_id', $event_id)->get();
        //dd($attendees);
        
        foreach($attendees as $attendee){
            Mail::to($attendee->properties['email'])
                ->send(
                new \App\Mail\SurveyCodeMail($event, $survey, $attendee, $code_pdu)
            );
        }
        
        /*
        foreach($attendees as $attendee){
            if(isset($attendee->activityProperties)){
                for ($i=0; $i < count($attendee->activityProperties); $i++) {
                    if($attendee->activityProperties[$i]['activity_id'] == $activity->id && $attendee->activityProperties[$i]['checked_in'] == true){
                        Mail::to($attendee->properties['email'])
                            ->send(
                            new \App\Mail\SurveyCodeMail($event, $survey, $attendee, $code_pdu)
                        );
                    }
                }
            }
        }
        */
        return response()->json([
            'message' => 'survey sent',
        ], 200);
    }

}