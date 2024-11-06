<?php

namespace App\Http\Controllers;

use App\Event;
use App\Space;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\ClearsResponseCache;
use Spatie\ResponseCache\Facades\ResponseCache;
/**
 * @resource Event
 *
 *
 */
class SpaceController extends Controller
{
    
    /* por defecto el modelo es en singular y el nombre de la tabla en prural
    //protected $table = 'categories';
    $a = new Space();
    var_dump($a->getTable());
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        return JsonResource::collection(
            Space::where("event_id", $event_id)->paginate(config('app.page_size'))
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
        $result = new Space($data);
        $result->save();    
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Space  $Space
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id)
    {
        $Space = Space::findOrFail($id);
        $response = new JsonResource($Space);
        //if ($Space["event_id"] = $event_id) {
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Space  $Space
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $space = Space::findOrFail($id);
        //if($Space["event_id"]= $event_id){
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
        $Space = Space::findOrFail($id);
        return (string) $Space->delete();
    }
    
}

