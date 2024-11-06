<?php

namespace App\Http\Controllers;

use App\Event;
use App\Models\Ticket;
use App\Models\Currency;
use App\Models\TicketStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

/*
  Attendize.com   - Event Management & Ticketing
 */

class EventTicketsController extends MyBaseController
{
    /**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function showTickets(Request $request, $event_id)
    {
        $allowed_sorts = [
            'created_at'    => trans("Controllers.sort.created_at"),
            'title'         => trans("Controllers.sort.title"),
            'quantity_sold' => trans("Controllers.sort.quantity_sold"),
            'sales_volume'  => trans("Controllers.sort.sales_volume"),
            'sort_order'  => trans("Controllers.sort.sort_order"),
        ];
        
        // Getting get parameters.
        $q = $request->get('q', '');
        $sort_by = $request->get('sort_by');
        if (isset($allowed_sorts[$sort_by]) === false) {
            $sort_by = 'sort_order';
        }
        
        // Find event or return 404 error.
        $event = Event::findOrFail($event_id);
        if ($event === null) {
            abort(404);
        }


        $is_embedded = $request->is_embedded;
        // Find event stages
        $stages = $event->event_stages;
        
        // Get tickets for event.
        $tickets = empty($q) === false
        ? $event->tickets()->where('title', 'like', '%' . $q . '%')->orderBy($sort_by, 'asc')->get()
        : $event->tickets()->orderBy($sort_by, 'asc')->get();
        // Return view.

        return view('ManageEvent.Tickets', compact('event', 'stages', 'tickets', 'sort_by', 'q', 'allowed_sorts', 'is_embedded'));
    }

    /**
     * Show the edit ticket modal
     *
     * @param $event_id
     * @param $ticket_id
     * @return mixed
     */
    public function showEditTicket($event_id, $ticket_id)
    {
        $event = Event::findOrFail($event_id);
        $ticket = Ticket::findOrFail($ticket_id);
        $stages = $event->event_stages;
        $currencies = Currency::all();
        $data = [
            'event'  => $event,
            'ticket' => $ticket,
            'stages' => $stages,
            'currencies' => $currencies,
        ];
        return view('ManageEvent.Modals.EditTicket', $data);
    }

    /**
     * Show the create ticket modal
     *
     * @param $event_id
     * @return \Illuminate\Contracts\View\View
     */
    public function showCreateTicket(String $event_id)
    {
        $event = Event::findOrFail($event_id);
        $stages = $event->event_stages;
        $currencies = Currency::all();
        return view('ManageEvent.Modals.CreateTicket', [
            'event' => $event,
            'stages' => $stages,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Creates a ticket
     *
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateTicket(Request $request, $event_id)
    {
        $stage = $request->get('stage_id');
        $ticket = Ticket::createNew();
        $event = Event::findOrFail($event_id);

        // Find event stages
        $event_stages =  $event->event_stages;
        
        if (!$ticket->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $ticket->errors(),
                ]);
        }
        
        // From the stage, the start and end dates are searched
            
        foreach($event_stages as $event_stage){ 
            if($event_stage["stage_id"] == $stage){ 
                $start_sale_date = $event_stage["start_sale_date"];
                $end_sale_date = $event_stage["end_sale_date"];
            }
        }

        $ticket->event_id = $event_id;
        $ticket->title = strip_tags($request->get('title'));
        $ticket->quantity_available = !$request->get('quantity_available') ? null : $request->get('quantity_available');
        $ticket->start_sale_date = $start_sale_date;
        $ticket->end_sale_date = $end_sale_date;
        $ticket->currency = $request->get('currency');
        $ticket->dates = $request->get('dates');
        $ticket->stage_id = strip_tags($request->get('stage_id'));
        $ticket->price = $request->get('price');
        $ticket->number_person_per_ticket = $request->get('number_person_per_ticket');
        $ticket->min_per_person = $request->get('min_per_person');
        $ticket->max_per_person = $request->get('max_per_person');
        $ticket->description = strip_tags($request->get('description'));
        $ticket->is_hidden = $request->get('is_hidden') ? 1 : 0;
        $ticket->seats = $request->get('seats') ? 1 : 0;

        $ticket->save();

        session()->flash('message', 'Successfully Created Ticket');

        return response()->json([
            'status'      => 'success',
            'id'          => $ticket->id,
            'message'     => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventTickets', [
                'event_id' => $event_id,
            ]),
        ]);
    }

    /**
     * Pause ticket / take it off sale
     *
     * @param Request $request
     * @return mixed
     */
    public function postPauseTicket(Request $request)
    {
        $ticket_id = $request->get('ticket_id');

        $ticket = Ticket::findOrFail($ticket_id);

        $ticket->is_paused = ($ticket->is_paused == 1) ? 0 : 1;

        if ($ticket->save()) {
            return response()->json([
                'status'  => 'success',
                'message' => trans("Controllers.ticket_successfully_updated"),
                'id'      => $ticket->id,
            ]);
        }

        Log::error('Ticket Failed to pause/resume', [
            'ticket' => $ticket,
        ]);

        return response()->json([
            'status'  => 'error',
            'id'      => $ticket->id,
            'message' => trans("Controllers.whoops"),
        ]);
    }

    /**
     * Deleted a ticket
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteTicket(Request $request)
    {
        $ticket_id = $request->get('ticket_id');

        $ticket = Ticket::findOrFail($ticket_id);

        /*
         * Don't allow deletion of tickets which have been sold already.
         */
        if ($ticket->quantity_sold > 0) {
            return response()->json([
                'status'  => 'error',
                'message' => trans("Controllers.cant_delete_ticket_when_sold"),
                'id'      => $ticket->id,
            ]);
        }

        if ($ticket->delete()) {
            return response()->json([
                'status'  => 'success',
                'message' => trans("Controllers.ticket_successfully_deleted"),
                'id'      => $ticket->id,
            ]);
        }

        Log::error('Ticket Failed to delete', [
            'ticket' => $ticket,
        ]);

        return response()->json([
            'status'  => 'error',
            'id'      => $ticket->id,
            'message' => trans("Controllers.whoops"),
        ]);
    }

    /**
     * Edit a ticket
     *
     * @param Request $request
     * @param $event_id
     * @param $ticket_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditTicket(Request $request, $event_id, $ticket_id)
    {

        $ticket = Ticket::findOrFail($ticket_id);
        /*
         * Add validation message
         */
        $validation_messages['quantity_available.min'] = trans("Controllers.quantity_min_error");
        $ticket->messages = $validation_messages;

        if (!$ticket->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $ticket->errors(),
            ]);
        } 

        $ticket->title = $request->get('title');
        $ticket->quantity_available = !$request->get('quantity_available') ? null : $request->get('quantity_available');
        $ticket->price = $request->get('price'); 
        $ticket->stage_id = strip_tags($request->get('stage_id'));
        $ticket->dates = $request->get('dates');
        $ticket->currency = $request->get('currency');
        $ticket->description = $request->get('description');
        $ticket->number_person_per_ticket = $request->get('number_person_per_ticket');
        $ticket->min_per_person = $request->get('min_per_person');
        $ticket->max_per_person = $request->get('max_per_person');
        $ticket->is_hidden = $request->get('is_hidden') ? 1 : 0;
        $ticket->seats = $request->get('seats') ? 1 : 0;
        
        $ticket->save();

        return response()->json([
            'status'      => 'success',
            'id'          => $ticket->id,
            'message'     => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventTickets', [
                'event_id' => $event_id,
            ]),
        ]);
    }

    /**
     * Updates the sort order of tickets
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateTicketsOrder(Request $request)
    {
        $ticket_ids = $request->get('ticket_ids');
        $sort = 1;

        foreach ($ticket_ids as $ticket_id) {
            $ticket = Ticket::findOrFail($ticket_id);
            $ticket->sort_order = $sort;
            $ticket->save();
            $sort++;
        }

        return response()->json([
            'status'  => 'success',
            'message' => trans("Controllers.ticket_order_successfully_updated"),
        ]);
    }
}
