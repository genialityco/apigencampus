<?php

namespace App\Http\Controllers;

use App\AttendeTicket;
use Illuminate\Http\Request;

class AttendeTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return AttendeTicket::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $result = new AttendeTicket($request->json()->all());
        $result->save();
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttendeTicket  $attendeTicket
     * @return \Illuminate\Http\Response
     */
    public function show(AttendeTicket $id)
    {
        //
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttendeTicket  $attendeTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendeTicket $attendeTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttendeTicket  $attendeTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendeTicket $id)
    {
        //
        $data = $request->json()->all();
        $id->fill($data);
        $id->save();
        return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttendeTicket  $attendeTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendeTicket $attendeTicket)
    {
        //
    }
}
