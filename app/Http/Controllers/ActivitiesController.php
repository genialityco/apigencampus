<?php

namespace App\Http\Controllers;

use App\Activities;
use App\ActivityAssistant;
use App\Event;
use App\ZoomHost;
use Aws\Credentials\Credentials;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Aws\S3\Transfer;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\evaLib\Services\FilterQuery;
use Log;

/**
 * @group Activity
 *
 * The activities within an event are **sessions, talks, lessons or conferences** in which specific topics are discussed.
 *
 * Each activity has its **date , time and duration**.
 *
 * These activities, according to the organizer, can be carried out either in person or virtually.
 */
class ActivitiesController extends Controller
{
    /**
     *
     * _index:_ Listing of all activities
     * @urlParam event_id require Example: 605241e68b276356801236e4
     *
     * 
    */
    public function index(Request $request, $event_id , FilterQuery $filterQuery)
    {
        $input = $request->all();
        $query  = Activities::with('module')->where("event_id", $event_id);

        //por defecto lo ordenamos por fecha de inicio descentente
        if (!isset($input['orderBy'])){
            $input['orderBy'] = '[{"field":"datetime_start","order":"asc"}]';
        }
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return JsonResource::collection($results);
    }   

    /**
     * _indexByHost_: list activities by host
     *
     * @urlParam event_id required id of the event to which the activities belong.
     * @urlParam host_id required id of the host for which you want to filter the activities.
     *
     * @param string $event_id
     * @param string $host_id
     * @return void
     */
    public function indexByHost($event_id, $host_id)
    {
        return JsonResource::collection(
            Activities::where("event_id", $event_id)->where('host_ids', $host_id)->paginate(config('app.page_size'))
        );
    }

    /**
     * _store_: create a new activity
     *
     * @urlParam event id of the event in which a new activity is to be created Example: 5fa423eee086ea2d1163343e
     *
     * @bodyParam name string required name Example: PRIMERA ACTIVIDAD
     * @bodyParam subtitle string optional Example: Subtitulo primera actividad
     * @bodyParam image string Example: https://storage.googleapis.com/herba-images/evius/events/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg
     * @bodyParam description string  Example: Primera actividad del evento
     * @bodyParam capacity integer  number of people who can enter the activity. Example: 50
     * @bodyParam event_id string required event with which the activity is associated Example: 5fa423eee086ea2d1163343e
     * @bodyParam datetime_end datetime required Example: 2020-10-14 14:11
     * @bodyParam datetime_start datetime required  Example: 2020-10-14 14:50
     * 
     * @response {
     *    "_id": "60804c6e6b7150714f20d122",
     *    "name": "PRIMERA ACTIVIDAD",
     *    "subtitle": "Subtitulo primera actividad",
     *    "image": "https://storage.googleapis.com/herba-images/evius/events/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg",
     *    "description": "Primera actividad del evento",
     *    "capacity": 50,
     *    "event_id": "5fa423eee086ea2d1163343e",
     *    "datetime_end": "2020-10-14 14:11",
     *    "datetime_start": "2020-10-14 14:50",
     *    "date_start_zoom": "2020-10-14T13:50:00",
     *    "date_end_zoom": "2020-10-14T15:11:00",
     *    "updated_at": "2021-04-21 16:01:50",
     *    "created_at": "2021-04-21 16:01:50",
     *    "access_restriction_types_available": null,
     *    "activity_categories": [],
     *    "space": null,
     *    "hosts": [],
     *    "type": null,
     *    "access_restriction_roles": []
     * }
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;


        $data["date_start_zoom"] =  Carbon::parse($data["datetime_start"])->subHours(1);            
        $data["date_start_zoom"] = $data["date_start_zoom"]->format('Y-m-d\TH:i:s');
        
        $data['date_end_zoom'] = Carbon::parse($data["datetime_end"])->addMinutes(60);        
        $data['date_end_zoom'] = $data['date_end_zoom']->format('Y-m-d\TH:i:s');
        

        $activity = new Activities($data);     
        $activity->save();

        // var_dump($data);die;
        if(isset($data["activity_categories_ids"])){
            $activity_categories_ids = $data["activity_categories_ids"];
            $activity->activity_categories()->attach($activity_categories_ids);
        }
        if (isset($data["host_ids"])) {
            $host_ids = $data["host_ids"];
            $activity->hosts()->attach($host_ids);
        }
        if (isset($data["type_id"])) {
            $type_id = isset($data["type_id"]);
            $activity->type()->push($type_id);
        }
        if (isset($data["space_id"])) {
            $space_id = $data["space_id"];
            $activity->space()->push($space_id);
        }
        if (isset($data["access_restriction_rol_ids"])) {
            $ids = $data["access_restriction_rol_ids"];
            $activity->access_restriction_roles()->attach($ids);
        }
        //Cargamos de nuevo para traer la info de las categorias
        $activity = Activities::find($activity->id);
        

        return $activity;
    }

    /**
     * _createMeeting_: assing meeting to activitie.
     * 
     * @urlParam event_id required Example: 5fa423eee086ea2d1163343e
     * @urlParam activity_id required Example: 5fb6dd20d5c3232d90042f64
     * 
     * @bodyParam activity_datetime_start date required Example: 2020-10-14 14:11
     * @bodyParam activity_name string required Example : First activity
     * @bodyParam activity_description string required Example : First activity
     * 
     */
    public function createMeeting(Request $request, $event_id, $activity_id)
    {

        $data = $request->json()->all();

        $datetime_start_activity = date_format(Carbon::parse($data["activity_datetime_start"]), 'Y-m-d');

        $where_date_exist = Activities::where('datetime_start', 'like', '%' . $datetime_start_activity . '%')->where("zoom_host_id", "!=", null)->pluck("zoom_host_id");

        $available_host = ZoomHost::whereNotIn("id", $where_date_exist)->first();
        if ($available_host == null) {
            return "No available host for this day :(";
        }

        $client = new Client();
        $url = config('app.zoom_server') . "/crearroom";
        $headers = ['Content-Type' => 'application/json'];

        $request = $client->post($url,
            ['json' => [
                "activity_name" => $data["activity_name"],
                "agenda" => $data["activity_description"],
                "activity_id" => $activity_id,
                "event_id" => $event_id,
                "host_id" => $available_host->id,
            ],
            ],
            ['headers' => $headers,
            ]);

        $activity = Activities::find($activity_id);

        return $request;
    }

    /**
     * _storeMeetingRecording_: endpoint receiving the zoom webhook saves the info on mongo and transfers it to aws s3
     *
     * @param Request $request
     * @return void
     */
    public function storeMeetingRecording(Request $request)
    {
        $data = $request->json()->all();
        $meeting_id = $data["payload"]["object"]["id"];
        $token = $data["download_token"];
        echo "id reunion" . $meeting_id . "<br>";
        $zoom_array = $data["payload"]["object"]["recording_files"];
        foreach ($zoom_array as $key => $value) {
            echo "tipo archivo" . $value["file_type"] . "<br>";
            if ($value["file_type"] == "MP4") {
                $zoom_url = $value["download_url"];
                echo $zoom_url;

                break;
            }
        }
        $values["meeting_video"] = $zoom_url;
        $activity = Activities::where("meeting_id", $meeting_id)->first();

        echo "actividad" . $activity->_id . "<br>";
        $activity->fill($values);
        $activity->save();

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];
        $request = $client->get($zoom_url . "?access_token=" . $token, ['allow_redirects' => false], [
            'headers' => $headers,
        ]);

        $cookies = $request->getHeaderLine('Set-Cookie');
        $source = $request->getHeaderLine('Location');

        $key = $meeting_id . Carbon::now() . ".mp4";

        $credentials = new Credentials(config('app.aws_key'), config('app.aws_secret'));

        $s3 = new S3Client([
            'version' => 'latest',
            'region' => 'sa-east-1',
            'credentials' => $credentials,
        ]);

        $uploader = new MultipartUploader($s3, $source, [
            'cookies' => $cookies,
            'bucket' => 'meetingsrecorded',
            'key' => $key,
            'ACL' => 'public-read',
        ]);

        $result = $uploader->upload();
        $values["zoom_meeting_video"] = $result["Location"];
        str_replace('//', '/', $values["meeting_video"]);
        $activity->fill($values);
        $activity->save();
        return $activity;

    }
    /**
     * _indexConferences_ :endpoint for indexing aws s3 conferences
     *
     * @param Request $request
     * @return void
     */
    public function indexConferences(Request $request)
    {
        $credentials = new Credentials(config('app.aws_key'), config('app.aws_secret'));
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => 'sa-east-1',
            'credentials' => $credentials,
        ]);

        return $s3->getPaginator('ListObjects', [
            'Bucket' => 'meetingsrecorded',
        ]);
    }

    /**
     * _show_: View information on a specific activity
     * 
     * @urlParam event_id required id of the event the activity. Example: 5fa423eee086ea2d1163343e
     * @urlParam activity required id of the activity you want to see. Example: 60804c6e6b7150714f20d122
     *
     * @param  \App\Activities  $Activities
     */
    public function show($event_id, $id)
    {
        $activity = Activities::with('module')->with('content')->findOrFail($id);
        return $activity;
    }

    /**
     * _duplicate_: endpoint destined to the duplication of an activity to english language
     *
     * @urlParam event_id required id of the event to which the activities belong.
     * @urlParam id required id of the activity you want to see.
     *
     * @param string $event_id
     * @param [string $id
     * @return void
     */
    public function duplicate($event_id, $id)
    {
        $activities_in_es = Activities::findOrFail($id);
        $Activities = Activities::findOrFail($id);
        $data['duplicate'] = true;
        $Activities->fill($data);
        $Activities->save();

        if (!empty($activities_in_es->duplicate)) {
            return "actividad ya duplicada";
        }
        $activities_in_es->get();
        $activities_in_en = json_decode(json_encode($activities_in_es), true);
        $activities_in_en["locale"] = "en";
        $activities_in_en["locale_original"] = $activities_in_en['_id'];
        $activity = new Activities($activities_in_en);
        $activity->save();
        return $activity;
    }
    /**
     * _update_:update an activity specific.
     *
     * @urlParam event_id required id of the event to which the activities belong. Example: 5fa423eee086ea2d1163343e
     * @urlParam id required id of the activity you want to update. Example: 5fa43c9538450d1f114c3952
     * 
     * @bodyParam name string name Example: PRIMERA ACTIVIDAD
     * @bodyParam subtitle string optional Example: Subtitulo primera actividad
     * @bodyParam image string Example: https://storage.googleapis.com/herba-images/evius/events/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg
     * @bodyParam description string  Example: Primera actividad del evento
     * @bodyParam capacity integer  number of people who can enter the activity. Example: 50
     * @bodyParam event_id string event with which the activity is associated Example: 5fa423eee086ea2d1163343e
     * @bodyParam datetime_end datetime Example: 2020-10-14 14:11
     * @bodyParam datetime_start datetime  Example: 2020-10-14 14:50
     * 
     * @response {
     *     "_id": "60804c6e6b7150714f20d122",
     *     "name": "PRIMERA ACTIVIDAD",
     *     "subtitle": "Subtitulo primera actividad",
     *     "image": "https://storage.googleapis.com/herba-images/evius/events/6pJmozfel7e1gr4ra4vnsvrY03VHHEBpRAhhqKWB.jpeg",
     *     "description": "Primera actividad del evento",
     *     "capacity": 50,
     *     "event_id": "5fa423eee086ea2d1163343e",
     *     "datetime_end": "2020-10-14 14:11",
     *     "datetime_start": "2020-10-14 14:50",
     *     "date_start_zoom": "2020-10-14T13:50:00",
     *     "date_end_zoom": "2020-10-14T15:11:00",
     *     "updated_at": "2021-04-21 16:01:50",
     *     "created_at": "2021-04-21 16:01:50",
     *     "access_restriction_types_available": null,
     *     "activity_categories": [],
     *     "space": null,
     *     "hosts": [],
     *     "type": null,
     *     "access_restriction_roles": []
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activities  $Activities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();

        $Activities = Activities::findOrFail($id);

        if(isset($data["datetime_start"]))
        {
            $data["date_start_zoom"] =  Carbon::parse($data["datetime_start"])->subHours(1);            
            $data["date_start_zoom"] = $data["date_start_zoom"]->format('Y-m-d\TH:i:s');                
        }

        if(isset($data["datetime_end"]))
        {
            $data['date_end_zoom'] = Carbon::parse($data["datetime_end"])->addMinutes(60);        
            $data['date_end_zoom'] = $data['date_end_zoom']->format('Y-m-d\TH:i:s');
        }
        $Activities->fill($data);
        $Activities->save();
        if (isset($data["activity_categories_ids"])) {
            $activity_categories_ids = $data["activity_categories_ids"];
            $Activities->activity_categories()->detach();
            $Activities->activity_categories()->attach($activity_categories_ids);
        }
        if (isset($data["host_ids"])) {
            $host_ids = $data["host_ids"];
            $Activities->hosts()->detach();
            $Activities->hosts()->attach($host_ids);
        }
        if (isset($data["type_id"])) {
            $type_id = isset($data["type_id"]);
            $Activities->type()->pull($data["type_id"]);
            $Activities->type()->push($type_id);
        }
        if (isset($data["space_id"])) {
            $space_id = $data["space_id"];
            $Activities->space()->pull($data["space_id"]);
            $Activities->space()->push($space_id);
        }
        if (isset($data["module_id"])) {
            $module_id = $data["module_id"];
            $Activities->module()->pull($module_id);
            $Activities->module()->push($module_id);
            Log::debug("change the module ID for: " . $module_id);
        }
        if (isset($data["access_restriction_rol_ids"])) {
            $ids = $data["access_restriction_rol_ids"];
            $Activities->access_restriction_roles()->detach();
            $Activities->access_restriction_roles()->attach($ids);
        }
        $activity = Activities::find($Activities->id);
        
        Log::debug("Update the activity");
        return $activity;
    }

    /**
     * _destroy_: Remove the specified activity
     *
     * @urlParam event_id required id of the event to which the activities belong Example: 5dbc9c65d74d5c5853222222
     * @urlParam id required id of the activity you want to destroy Example: 5dbc99bad74d5c5822691111
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id, $id)
    {
        $Activities = Activities::findOrFail($id);
        

        return (string) $Activities->delete();
    }

    /**
     * _hostAvailability_: end point que controla las disponibilidad de los host al crear una reunión
     * 
     * @urlParam event_id required event to which the activity belongs
     * @urlParam id required activity to which the meeting is to be created
     * 
     * @bodyParam host_ids array optional id array of selectable hosts Example: ["KthHMroFQK24I97YoqxBZw" , "FIRVnSoZR7WMDajgtzf5Uw" , "15DKHS_6TqWIFpwShasM4w" , "2m-YaXq_TW2f791cVpP8og", "mSkbi8PmSSqQEWsm6FQiAA"]
     * @bodyParam host_id  string host selected to create the meeting Example: KthHMroFQK24I97YoqxBZw
     * @bodyParam date_start_zoom date Example: 2021-02-08T07:30:00
     * @bodyParam date_end_zoom date Example: 2021-02-08T09:30:00
     * 
     */
    public function hostAvailability(Request $request , $event_id , $activity_id)
    {   
        $data = $request->json()->all();

        $activity = Activities::find($activity_id);
        
        if(isset($activity->zoom_host_id))
        {
            if($activity->meeting_id === 0  && $activity->zoom_host_id !== '')
            {
                return response()->json([
                    "message" => "La actividad ya tiene una sala asignada"
                ] , 409);
            }
        }
        

        $validatedData = $request->validate([
            'host_ids' => 'required_without:host_id',
            'host_id' => 'required_without:host_ids',
        ]);
        
        //Filtrar reuniones por fecha para ver que hosts se estan usando
        $hostsUsed  = Activities::where('date_end_zoom' , '>', $data['date_start_zoom'])
                                ->where('date_start_zoom' , '<' ,  $data['date_end_zoom']);      

        if(isset($data['host_ids']))
        {                               

            //Array de los host que están siendo usados
            $occupiedHosts  = [];             

            //Foreach que arma el array con los host que estan siendo utilizados
            foreach($hostsUsed->pluck('zoom_host_id') as $host)
            {
                array_push($occupiedHosts , $host);
            }
                        
            //Array de los host disponibles para la organización
            $hostAvailabilityArray = $data['host_ids'];

            //Comparación para ver los array disponibles
            $hostUpdate =  array_diff($hostAvailabilityArray, $occupiedHosts);
            
            $index =  key($hostUpdate);
            if(isset($index))
            {              
                //Obtener el primer host disponible a la actividad a la que se le está creando la sala, para que lo pueda utilizar             
                $host =  ZoomHost::where('id' , $hostUpdate[$index])->first();
                $activity->zoom_host_id = $host->id;
                $activity->zoom_host_name = $host->first_name; 
                $activity->save();

                return $activity;
            }
            
            return response()->json([
                "message" => "No hay host disponible para las horas ingresadas"
            ] , 409);
        }                                      

        $hostsUsed  = $hostsUsed->where('zoom_host_id' , $data['host_id'])->first();  
        // Log::info('message');
        // Log::info($hostsUsed);                                

        if(!isset($hostsUsed))
        {   

            //Obtener el primer host disponible a la actividad a la que se le está creando la sala, para que lo pueda utilizar             
            $host =  ZoomHost::where('id' , $data['host_id'])->first();
            $activity = Activities::find($activity_id);
            $activity->zoom_host_id = $host->id;
            $activity->zoom_host_name = $host->first_name; 
            $activity->save();

            return $activity;
        }
               

        return response()->json([
            "message" => "El host no está disponible para las horas ingresadas"
        ] , 409);   
        
    }

    /**
     * _deleteVirtualSpaceZoom_:
     */
    public function deleteVirtualSpaceZoom($event_id , $room_id)
    {   
        $activity = Activities::where('meeting_id', intval($room_id))->first();

        $activity->zoom_host_id = '';
        $activity->zoom_host_name = '';
        $activity->duration = 0;
        $activity->join_url = '';
        $activity->meeting_id = 0;
        $activity->start_url = '';
        $activity->save();  

        return $activity;

    }

    /**
     * _registerAndCheckInActivity_: status indicating that the user entered the activity
     * 
     * @authenticated
     * @urlParam event_id required event to which the activity belongs
     * @urlParam id id of activity
     * 
     * @response{
     *     "user_id": "5e9caaa1d74d5c2f6a02a3c2",
     *     "activity_id": "60181474e36ef049a92768ba",
     *     "event_id": "5fa423eee086ea2d1163343e",
     *     "checkedin_at": "2021-02-01 22:48:19",
     *     "updated_at": "2021-02-01 22:48:19",
     *     "created_at": "2021-02-01 22:48:19",
     *     "_id": "601885335603e6467b65b605"
     * }
     * 
     * @param Request $request
     * @param string $event_id
     * @param string $id
     * @return void
     */
    public function registerAndCheckInActivity(Request $request , $event_id, $id)
    {

        $data['user_id'] = auth()->user()->_id;  

        $data['activity_id'] = $id;
        $data['event_id'] = $event_id;
        $date = new \DateTime();

        $ActivityAssistant = ActivityAssistant::updateOrCreate(
            [   
                'activity_id' => $data['activity_id'] ,
                'user_id'=> $data['user_id'],
                'checked_in' => true
            ]
        );      

        
        /*Se realiza validación para que la fecha y hora del checkIn sea siempre el primero 
        y no se actualice en caso de que el usuario vuelva a ingresar a la actividad*/
        if (!isset($ActivityAssistant->checkedin_at)) {
            $ActivityAssistant->fill(['checkedin_at' => $date]);
        }
        $ActivityAssistant->printouts  = $ActivityAssistant->printouts + 1;
        $ActivityAssistant->save();

        return $ActivityAssistant;

    }

    /**
     * _checkInByAdmin_: admin can check-in a specific user on a specific activity
     * @authenticated 
     * 
     * @urlParam event required event to which the activity belongs
     * @urlParam activity required activity id
     * 
     * @bodyParam user_id string required user id
     */
    public function checkInByAdmin(Request $request, $event_id, $activity_id)
    {
        $data = $request->json()->all();
        $date = new \DateTime();

        $ActivityAssistant = ActivityAssistant::updateOrCreate(
            [   
                'activity_id' => $activity_id ,
                'user_id'=> $data['user_id'],
                'checked_in' => true,
                'event_id' =>  $event_id,

            ],
            [
                'checkedin_at' => $date,
            ]
        );      

        
        return $ActivityAssistant;
    }


    

}

