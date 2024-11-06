<?php

namespace App\Http\Controllers;

use App\Account;
use App\Billing;
use App\Boleteria;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use \App\Models\Ticket;
use App\TicketCategory;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        $results = Ticket::where("event_id", $event_id)->get();
        //$results = Ticket::where("event_id", $event_id)->paginate(config('app.page_size'));
        return JsonResource::collection($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request, TicketCategory $ticketCategory)
    {
	// Un ticket siempre debe ir
	// relacionado con un ticket category
	$request->validate([
	    'name' => 'required|string'
	]);

        $data = $request->json()->all();
	$data = array_merge($data, [
	    'event_id' => $ticketCategory->event_id,
	    'ticket_category_id' => $ticketCategory->_id,
	]);
        $ticket = Ticket::create($data);

        return response()->json(compact('ticket'), 201);
    }


    /**
     * Crear tickets cuando factura de compra
     * es aprovada
     *
     */
    public function createTicketByBilling(Request $request, Account $user, Billing $billing)
    {
	// En caso de que el ticket no pertenesca a
	// una categoria se toma la configuracion de la
	// boleteria
	$tickets = $billing->billing['details']['tickets'];
	$additionalData = [
	    'buyer_id' => $user->_id, // Usuario quien compro el ticket
	    'user_id' => $user->_id, // Persona a la cual pertenece el ticket, por defecto es el comprador
	    'billing_id' => $billing->_id, // Compra a la que pertenece el ticket
	    'redeemed' => false
	];

	$newTickets = [];
	foreach($tickets as $ticket){
	    $data = array_merge($ticket, $additionalData);
	    $newTicket = Ticket::create($data);
	    array_push($newTickets, $newTicket);
	}

	// Enviar correo con Billing y tickets
	// Generar qr a cada ticket

	return response()->json(compact('newTickets'),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $event_id, $id)
    {
        $model = Ticket::findOrFail($id);
        return $model;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $model = Ticket::findOrFail($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $model = Ticket::findOrFail($id);
        return (string) $model->delete();
    }

    public function assingTicketToUser(Request $request, Account $user, Ticket $ticket)
    {
	$ticket->owner_user = $user->_id;
	$ticket->save();

	return $ticket;
    }

    public function redeemTicket($event, Ticket $ticket)
    {
	if($ticket->redeemed) {
	    return response()->json(['message' => 'invalid ticket'], 403);
	}

	$ticket->redeemed = true;
	$ticket->checkedin_at = time();
	$ticket->save();

	return response()->json(compact('ticket'), 200);
    }
}
