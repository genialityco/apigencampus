<?php

namespace App\Http\Controllers;

use App\Account;
use App\evaLib\Services\EvaRol;
use App\evaLib\Services\FilterQuery;
use App\evaLib\Services\GoogleFiles;
use App\Event;
use App\Attendee;
use App\EventType;
use App\Http\Resources\EventResource;
use App\ModelHasRole;
use App\Organization;
use App\Properties;
use App\UserProperties;
use App\Survey;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Validator;
use Mail;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group Event
 *
 */

class EventStatisticsController extends Controller
{


    public function courseFinished(Request $request, string $event_id, string $id)
    {
        //5b7c4159c06586333f616385

        $user = Auth::user();
        $survey = Survey::findOrFail($id);


        $data = $request->json()->all();

        $attendee = Attendee::where(['event_id' => $event_id, 'account_id' => $user->_id])->firstOrFail();

        $attendee->course_finished = true;
        $attendee->save();

        //$surveys = Survey::where(['event_id'=>$event_id])->count();
        //$surveys_approved = Survey::where(['event_id'=>$event_id,'class_approved'=>true])->count();

        //echo " $surveys  $surveys_approved   ";


        echo $attendee->_id;

        //pasar la actividad  a aprobada

        //Revisar si todas las actividades se aprobaron

        //si es asi pasar el curso a aprobado

        //retornar el curso

    }

    /**
     * _eventsstadistics_:
     * 
     * @urlParam organization organization id 
     * 
     */
    public function eventsstadistics(string $id)
    {

        $events = Event::where('organizer_id', $id)->get();
        $eventd_ids = $events->pluck('_id')->toArray();

        $events = $events->keyBy('_id');

        $totals = Attendee::raw()->aggregate(array(
            ['$match' => ['event_id' => ['$in' => $eventd_ids]]],
            array('$group' => array(
                '_id' =>'$event_id',
                'count' => array('$sum' => 1),
                'checked_in_not' => [
                    '$sum' => [
                        '$cond' => [
                            ['$eq' => ['$checked_in', false]], 1, 0
                        ]
                    ]
                ],
                'checked_in' => [
                    '$sum' => [
                        '$cond' => [
                            ['$eq' => ['$checked_in', true]], 1, 0
                        ]
                    ]
                ],
                'course_status_approved' => [
                    '$sum' => [
                        '$cond' => [
                            ['$eq' => ['$course_finished', true]], 1, 0
                        ]
                    ]
                ],
                'course_status_pending' => [
                    '$sum' => [
                        '$cond' => [
                            //['$ne' => ['$course_status',false]], 1, 0
                            ['$and' => [
                                ['$ne' => ['$course_finished', false]],
                                ['$ne' => ['$course_finished', true]]
                            ]], 1, 0
                        ]
                    ]
                ],

            ))
        ));

        $output = [];

        foreach ($events as $event){
            $output[$event->_id] = $event->toArray();
        }
        //Agregamos el nombre a cada evento
        foreach($totals as $total) {
            $event_totals = (iterator_to_array($total));
            $output[$event_totals['_id']] = array_merge($output[$event_totals['_id']],$event_totals );
        }    
        $output = array_values($output);
        //$array = json_decode(json_encode($totals->toArray()), true);

        return JsonResource::collection(['data'=>$output]);

        // foreach ($output as $result) {
        //     echo "<p>{$result['name']} {$result['_id']} {$result['count']} pending: {$result['course_status_pending']}  approved: {$result['course_status_approved']} failed: {$result['course_status_reproved']}</p>";
        // }
    }
}
