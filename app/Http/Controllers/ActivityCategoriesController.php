<?php

namespace App\Http\Controllers;

use App\Event;
use App\ActivityCategories;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @resource Event
 *
 *
 */
class ActivityCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        return JsonResource::collection(
            ActivityCategories::where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $result = new ActivityCategories($data);
        $result->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActivityCategories  $ActivityCategories
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id )
    {
        $ActivityCategories = ActivityCategories::findOrFail($id);
        $response = new JsonResource($ActivityCategories);
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivityCategories  $ActivityCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $ActivityCategories = ActivityCategories::findOrFail($id);
        $ActivityCategories->fill($data);
        $ActivityCategories->save();
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
        $ActivityCategories = ActivityCategories::findOrFail($id);
        return (string) $ActivityCategories->delete();
    }
}