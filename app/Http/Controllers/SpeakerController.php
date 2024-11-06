<?php

namespace App\Http\Controllers;

use App\Speaker;
use App\Http\Resources\SpeakerResource;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, String $event_id)
    {
        $data = $request->json()->all();
        //esta condicion expresa si existe la variable 'locale' en una peticion por json o por url, y valida que valor existe en estas varibles
        $res = (!empty($data['locale']) && $data['locale'] == "en" || !empty($request->input('locale')) && $request->input('locale') == "en") ? "en" : "es";

        if($res=="en"){
            return SpeakerResource::collection(
                Speaker::where("event_id", $event_id)->where('locale', "en")->paginate(config('app.page_size')));
        }else{
            return SpeakerResource::collection(
                Speaker::where("event_id", $event_id)->where('locale', '!=', "en")->paginate(config('app.page_size')));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, String $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $result = new Speaker($data);
        $result->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function show(String $event_id, String $speaker_id)
    {
        $speaker = Speaker::find($speaker_id);
        $response = new SpeakerResource($speaker);
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function edit(Speaker $speaker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $event_id, String $speaker_id)
    {
        $data = $request->json()->all();
        $speaker = Speaker::find($speaker_id);
        $speaker->fill($data);
        $speaker->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $speaker_id)
    {
        $speaker = Speaker::findorfail($speaker_id);
        return (string) $speaker->delete();
    }
}
