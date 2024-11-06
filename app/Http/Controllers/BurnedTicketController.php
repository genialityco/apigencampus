<?php

namespace App\Http\Controllers;

use App\BurnedTicket;
use App\Event;
use App\Exports\BurnedTicketsExport;
use App\TicketCategory;
use Illuminate\Http\Request;
// Excel
use Maatwebsite\Excel\Facades\Excel;

class BurnedTicketController extends Controller
{
    /**
     * @urlParam  \Illuminate\Http\Request  $request
     * @urlParam  \App\Event  $event
     * @queyParam  numberItems Number of item to get
     * @queyParam  query Type of query regex | equal
     * @queyParam  user_id Get user's tickets
     *  Filtros de CMS
     * @queyParam  code
     * @queyParam  state
     * @queyParam  assigned_to.name
     * @queyParam  assigned_to.email
     * @queyParam  assigned_to.document.type_doc
     * @queyParam  assigned_to.document.value
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Event $event)
    {
	// Cantidad de elementos que se quieren paginar
	$numberItems =  $request->query('numberItems') ? $request->query('numberItems') : 10;

	// Listar por usuario, vista para usuario para ver sus tickets
	$user_id =  $request->query('user_id') ? $request->query('user_id') : false;
	if($user_id){
	    return BurnedTicket::where("event_id", $event->_id)
		->where('user_id', $user_id)
		->latest()
		->paginate($numberItems);
	}

	// Filtros desde el CMS: por email, codigo, nombre, etc
	$typeQuery = $request->query('query') ? $request->query('query') : 'regex';
	$searchBy =  $request->query('search_by') ? $request->query('search_by') : false;
	$searchValue =  $request->query('search_value') ? $request->query('search_value') : false;

	// Especificar tipo de busqueda regex o igual
	if($typeQuery === 'equal') {
	    $typeQuery = '=';
	} else { // En caso de que sea por regex
	    $searchValue = "/{$searchValue}/i";
	}

	if($searchBy && $searchValue){
	    return BurnedTicket::where("event_id", $event->_id)
		->where($searchBy, $typeQuery, $searchValue) // insesible a lower y upper
		->latest()
		->paginate($numberItems);
	}

	// Listar todos por defecto
	return BurnedTicket::where("event_id", $event->_id)->latest()->paginate($numberItems);
    }

    /**
     * Email debe ser unico para la persona que
     * se le asignara el ticket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function validateUserDataToTicket(Request $request, TicketCategory $ticketCategory)
    {
	// Validar que el email sea unico en esa categoria
	$data = $request->json()->all();

	// Array de email existentes
	$emailTicketsByCategory = BurnedTicket::where('ticket_category_id', $ticketCategory->_id)->pluck('assigned_to.email')->toArray();

	if(in_array($data['email'], $emailTicketsByCategory)) {
	    return response()->json(['message' => 'Email already exists'], 400);
	}

	return response()->json(['message' => 'Email valid'], 200);
    }

    /**
     * Validar que este codigo exista
     *
     * @param  \App\Event  $event
     * @param  $code
     * @return \Illuminate\Http\Response
     */
    public function validateTicketCode(Event $event, $code)
    {
	$burnedTicket = BurnedTicket::where('event_id', $event->_id)
	    ->where('code', $code)->first();

	if($burnedTicket) {
	    return $burnedTicket;
	}

	return response()->json(['message' => 'Ticket not found'], 404);
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
     * @param  \App\BurnedTicket  $burnedTicket
     * @return \Illuminate\Http\Response
     */
    public function show($event, BurnedTicket $burnedTicket)
    {
	return $burnedTicket;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BurnedTicket  $burnedTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, BurnedTicket $burnedTicket)
    {
	$data = $request->json()->all();
	$burnedTicket->update($data);

	return $burnedTicket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BurnedTicket  $burnedTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(BurnedTicket $burnedTicket)
    {
        //
    }

    /**
     * Descargar excel con tickets
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function exportExcelWithBurnedTickets(Event $event)
    {
	return Excel::download(new BurnedTicketsExport($event) , 'tickets.xlsx');
    }

}
