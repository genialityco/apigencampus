<?php

namespace App\Http\Controllers;

use App\LukerTicket;
use App\Event;
use Illuminate\Http\Request;

class LukerTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    //public function store(Request $request)
    //{
        ////
    //}

    /**
     * Display the specified resource.
     *
     * @param  \App\LukerTicket  $lukerTicket
     * @return \Illuminate\Http\Response
     */
    public function show(LukerTicket $lukerTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LukerTicket  $lukerTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(LukerTicket $lukerTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LukerTicket  $lukerTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LukerTicket $lukerTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LukerTicket  $lukerTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(LukerTicket $lukerTicket)
    {
        //
    }

    // LUKER TICKETS
    private function validateWinner($burnedTicket)
    {
	// poner numero de ticket correspondiente
	$codeQty = LukerTicket::where('event_id', $burnedTicket['event_id'])->count();
	$burnedTicket['ticket_number'] = $codeQty + 1;
	// validar si es ganador
	$burnedTicket['is_winner'] = $burnedTicket['ticket_number'] % 10 == 0;

	return $burnedTicket;
    }

    private function generateCode()
    {
        $randomCode = substr(str_shuffle(str_repeat($x='0123456789', ceil(6/strlen($x)) )),1,6);
        //verificar que el codigo no se repita
        $burnedTicket = LukerTicket::where('code', $randomCode)->first();
        if(!empty( $burnedTicket )) {
	    $this->generateCode();
        }

	return $randomCode;
    }

    public function store(Request $request, Event $event)
    {
	$data = $request->json()->all();
	$lukerTickets = [];

	// recibir el numero de tickets que seran creados
	for($i = 0; $i < $data['code_qty']; $i++) {
	    $dataLukerTicket = $data;
	    unset($dataLukerTicket['code_qty']); //remover campo para que se guarde
	    $dataLukerTicket['event_id'] = $event->_id;
	    $dataLukerTicket['code'] = $this->generateCode();

	    // setear si este tickets es ganador o no
	    //$dataLukerTicket = $this->validateWinner($dataLukerTicket);
	    $newBurnedTicker = LukerTicket::create($dataLukerTicket);
	    array_push($lukerTickets, $newBurnedTicker);
	}

	return response()->json(compact('lukerTickets'), 201);
    }
}
