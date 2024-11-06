<?php

namespace App\Http\Controllers;

use App\Event;
use App\ZoomHost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @resource Event
 *
 *
 */
class ZoomHostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return JsonResource::collection(
            ZoomHost::all()
        );    
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $result = new ZoomHost($data);
        $result->save();
        return $result;
    }



    public function updateStatus(Request $request)
    {
        $data = $request->json()->all();
        $host_id = $data["payload"]["object"]["host_id"];
        $result = ZoomHost::where("id",$host_id)->first();
        if($result){
            $state["state"] = "available";
            $result->fill($state);
            $result->save();
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Host  $Host
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id )
    {
        $Host = ZoomHost::where("id",$id)->first();
        $response = new JsonResource($Host);
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Host  $Host
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $Host = ZoomHost::where("id",$id)->first();
        $Host->fill($data);// = $data["state"];
        $Host->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
}
