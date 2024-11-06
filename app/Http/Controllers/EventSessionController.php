<?php

namespace App\Http\Controllers;

use App\EventSession;
use Illuminate\Http\Request;
use App\Http\Resources\EventSessionResource;

class EventSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(String $event_id)
    {
        return EventSessionResource::collection(
            EventSession::where('event_id', $event_id)
                ->paginate(config('app.page_size'))
        );
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
        $result = new EventSession($data);
        $result->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventSession  $eventSession
     * @return \Illuminate\Http\Response
     */
    public function show(String $event_id, String $session_id)
    {
        $EventSession = EventSession::findOrFail($session_id);
        $response = new EventSessionResource($EventSession);
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventSession  $eventSession
     * @return \Illuminate\Http\Response
     */
    public function edit(EventSession $eventSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventSession  $eventSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $event_id, String $session_id)
    {
        $data = $request->json()->all();
        $EventSession = EventSession::findOrFail($session_id);
        $EventSession->fill($data);
        $EventSession->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventSession  $eventSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $session_id)
    {
        $EventSession = EventSession::findOrFail($session_id);
        return (string)$EventSession->delete();
    }
}
