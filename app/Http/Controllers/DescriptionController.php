<?php

namespace App\Http\Controllers;

use App\Description;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Resources\DescriptionResource;
use Log;
/**
 * @group Description
 *
 */
class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descriptions = Description::all();
        return response()->json($descriptions);
    }

    /**
     * _store_: Create new Description.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @bodyParam name string required name to description Example: Category one
     * @bodyParam color string required color of description Example: #FFFFFF
     * @bodyParam cost double required cost related to description Example: 25.000
     * @bodyParam amount numeric required amount related to description Example: 20
     * @bodyParam event_id string required event id related to description Example: 628fdc698b89a10b9d464793
     */
    public function store(Request $request)
    {
        $request->validate([
            'index' => 'required',
            'type' => 'required',
            'value' => 'required'
        ]);

        $data = $request->json()->all();
        $description = new Description($data);
        $description->save();

        return response()->json($description, 201);
    }

    public function storeMany(Request $request, $event_id)
    {
        foreach ($request->descriptions as $description) {
            $description = new Description($description);
            $description['event_id'] = $event_id;
            $description->save();
        }
        return response()->json(["message"=>"Ok"]);
    }

    /**
     * DescriptionbyUser_: search of descriptions by event.
     * 
     * @urlParam event required  event_id
     *
     */
    public function DescriptionbyEvent(string $event_id)
    {
        return DescriptionResource::collection(
            Description::where('event_id', $event_id)
                ->latest()
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _show_: display information about a specific description.
     * 
     * @authenticated
     * @urlParam description required id of the description you want to consult. Example: 6298cb08f8d427d2570e8382
     * @response{
     *   "_id": "6298cb08f8d427d2570e8382",
	 *   "index": "Test",
	 *   "type": "$FFFFFF",
	 *   "value": 25.000,
     * }
     */
    public function show($description)
    {
        $description = Description::findOrFail($description);

        return $description;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Description  $description
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $description)
    {
        $data = $request->json()->all();
        $description  = Description::findOrFail($description);
        $description->fill($data);
        $description->save();

        return response()->json($description);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Description  $description
     * @return \Illuminate\Http\Response
     */
    public function updateMany(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);
        if ($event) {
            foreach ($request->descriptions as $description) {
                $updateDescription  = Description::findOrFail($description['_id']);
                $updateDescription->fill($description);
                $updateDescription->save();
            }
            return response()->json(["message"=>"Ok"]);
        }else{
            return response()->json(["message"=>"Event doesnt exist"], 404);
        }
        
    }

    /**
     * _destroy_: delete description and related data.
     * @authenticated
     * @urlParam description required id of the description to be eliminated
     * 
     */
    public function destroy($description)
    {
        $description = Description::findOrFail($description);
        $description->delete();

        return response()->json([], 204);
    }
}
