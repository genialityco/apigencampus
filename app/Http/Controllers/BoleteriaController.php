<?php

namespace App\Http\Controllers;

use App\Boleteria;
use App\Event;
use App\TicketCategory;
use Illuminate\Http\Request;

class BoleteriaController extends Controller
{
    /**
     * Validate tickets capacity on boleteria.
     *
     * El numero de aforo total debe ser igual o mayor
     * a la cantidad total de aforo por categoria.
     * No debe ser menor porque no serian coherentes los datos
     */
    public static function _validateTicketCapacityBoleteria($boleteria, $ticketCapacity)
    {
	// Siempre debe existir ticket_capacity en las categorias
	$ticketCategories = TicketCategory::where('boleteria_id', $boleteria->_id)->pluck('ticket_capacity')->toArray();
	$totalTickets = array_reduce($ticketCategories, function($carry, $item){
	    return $carry += $item;
	});

	return $ticketCapacity < $totalTickets ? false : true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index(Event $event)
    {
	$boleteria = Boleteria::where('event_id', $event->_id)->first();
	if(!isset($boleteria)) {
	    return response()->json(['message' => 'Boleteria not found'],404);
	}

	// Tickets disponibles
	$ticketCategories = TicketCategory::where('boleteria_id', $boleteria->_id)->pluck('ticket_capacity')->toArray();
	$totalTickets = array_reduce($ticketCategories, function($carry, $item){
	    return $carry += $item;
	});
	$boleteria['used_tickets'] = $totalTickets;
	$boleteria['available_tickets'] = $boleteria->ticket_capacity - $totalTickets;

	return $boleteria;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
	$request->validate([
	    'title' => 'string|required'
	]);
	// traer evento y validar su tipo de acceso
	if($event->allow_register == true && $event->visibility == 'PUBLIC') {
	    // crear boleteria y asociarla el evento
	    $data = $request->json()->all();
	    $data['event_id'] = $event->_id;
	    $boleteria = Boleteria::create($data);
	    $event->boleteria_id = $boleteria->_id;
	    $event->save();

	    return response()->json(compact('boleteria'), 201);
	}

	return response()->json(['message' => "Type of event acceso must be 'Mandatory registration with authentication'"], 403) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Boleteria  $boleteria
     * @return \Illuminate\Http\Response
     */
    public function show($event, Boleteria $boleteria)
    {
	return compact('boleteria');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Boleteria  $boleteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, Boleteria $boleteria)
    {
	$data = $request->json()->all();

	// Validar cantidad de aforo
	if(isset($data[ 'ticket_capacity' ])) {
	    $isValid = self::_validateTicketCapacityBoleteria($boleteria, $data['ticket_capacity']);
	    if(!$isValid) {
		return response()->json([
		    'message' =>
		    'Invalid ticket_capacity: Must be greater than or equal to the number of total tickets already assigned in the categories.'
		], 400);
	    }
	}

	$boleteria->fill($data);
	$boleteria->save();

	return response()->json(compact('boleteria'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Boleteria  $boleteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($event, Boleteria $boleteria)
    {
	// decidir lo que se borrara asociado
	// a la boleteria
	$boleteria->delete();

	return response()->json([], 204);
    }
}
