<?php

namespace App\Http\Controllers;

use App\Activities;
use App\Quantity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @resource Event
 *
 *
 */
class QuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        return JsonResource::collection(
           Activities::where("event_id",$event_id)->get());
    }

    /**
     * Store a newly created resource in storage
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {   

        
        $data = $request->json()->all();
        $activity = Activities::find($event_id);
        $activity->quantity;
        $model = new Quantity($data);  
        
        $activity->quantity()->save($model);        
        return $model; 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quantity  $Quantity
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id)
    {

        $Quantity = Activities::find($event_id)->quantity()->find($id);
        
        $response = new JsonResource($Quantity);
        //if ($Quantity["event_id"] = $event_id) {
        return $response;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quantity  $Quantity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        
        $data = $request->json()->all();
        
        $quantity = Activities::findOrFail($event_id)->quantity()->find($id);
        if (!$quantity){
            return abort(404);
        }
        $quantity->fill($data);
        $quantity->save();
        return new JsonResource($quantity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $id)
    {   
        $event = Activities::findOrFail($event_id);
       
        $quantity = $event->quantity()->find($id);
        if (!$quantity){
            return abort(404);
        }
        return (string) $quantity->delete();
    }
}
