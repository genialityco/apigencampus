<?php

namespace App\Http\Controllers\API;

use App\Attendee;
use App\Event;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventTicketsAPIController extends Controller
{
    /**
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function index(Request $request, String $event_id)
    {

        $query = Ticket::where('event_id', $event_id);
        return JsonResource::collection($query->get());
    }

    public function ajustarticketid(Request $request)
    {
        $event_id = "5ed3ff9f6ba39d1c634fe3f2";
        $ticket_id = "5ed4fa6adee5ee8998595b0c";

        $query = Attendee::where('event_id', $event_id)
            ->where('ticket_id', $ticket_id)
        //->where('_id', "5ed5165812ad48472f079a22")
            ->get();

        foreach ($query as $att) {

            $propiedades = $att->properties;
            $propiedades["ticket_id"] = $att->ticket_id;
            $att->properties = $propiedades;
            $att->save();
            //var_dump($att->properties);
            echo "<p>" . $att->properties["ticket_id"] . "</p>";

        }

        return "true";
    }

    public function show(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $response = new JsonResource($ticket);
        //if ($survey["event_id"] = $event_id) {
        return $response;
    }

}