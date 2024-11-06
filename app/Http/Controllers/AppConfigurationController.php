<?php

namespace App\Http\Controllers;

use App\Event;
use App\AppConfiguration;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class AppConfigurationController extends Controller
{
    public function index($event_id)
    {
        $appconfiguration = AppConfiguration::where("event_id",$event_id)->get();
        $toarray = json_decode(json_encode($appconfiguration),true);
        if(!empty($toarray)){
            $appconfiguration = AppConfiguration::where("event_id",$event_id)->get();
            $idevent = $appconfiguration[0]->id;
            $appconfiguration = AppConfiguration::find($idevent);
            return $appconfiguration;
        }else{
            return JsonResource::collection(
                AppConfiguration::where("event_id", $event_id)->paginate(config('app.page_size'))
            );
        }
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
        $result = new AppConfiguration($data);
        $result->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppConfiguration  $AppConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id)
    {
        $space = AppConfiguration::findOrFail($id);
        $response = new JsonResource($space);
        //if ($AppConfiguration["event_id"] = $event_id) {
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppConfiguration  $AppConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $appconfiguration = AppConfiguration::findOrFail($id);
        //if($AppConfiguration["event_id"]= $event_id){
        $appconfiguration->fill($data);
        $appconfiguration->save();
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
        $space = AppConfiguration::findOrFail($id);
        return (string) $space->delete();
    }
}
