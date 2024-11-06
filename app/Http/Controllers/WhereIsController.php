<?php

namespace App\Http\Controllers;

use App\Attendee;
use App\Event;
use App\WhereIs;
use Illuminate\Http\Request;

/**
 * @group WhereIs
 *
 */

class WhereIsController extends Controller
{

    /**
     * _index_: It returns all the where_is in the database
     * It returns all the rows in the `where_is` table as a JSON object
     * 
     * @return All the data from the WhereIs table.
     */
    public function index()
    {
        $where_is = WhereIs::all();
        return response()->json($where_is);
    }

    /**
     * _store_: It takes a request, validates it, and then saves it to the database
     * It takes the event_id from the request, finds the event in the database, and then adds a new key
     * to the event's dynamics array
     * 
     * @bodyParam title string required The title of the where_is.
     * @bodyParam event_id int required The id of the event to add the where_is to.
     * 
     * @return A JSON object with the data of the new WhereIs object.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'event_id' => 'required|string',
        ]);

        $event = Event::where('_id', $request->event_id)->first();

        if(isset($event->dynamics)){
            $dynamics = $event->dynamics;
            $dynamics["where_is"] = true;
        }else{
            $dynamics["where_is"] = true;
        }
        $event->dynamics = $dynamics;
        $event->save();

        $data = $request->json()->all();
        $where_is = new WhereIs($data);
        $where_is->save();

        return response()->json($where_is, 201);
    }

    /**
     * 
     * _whereisByEvent_: It takes an event_id and returns all the where_is objects associated with that event
     * It returns the where_is object for the event_id passed in.
     * 
     * @urlParam event_id string required The id of the event to get the where_is for.
     * 
     * @return A WhereIs object
     */
    public function WhereIsbyEvent(string $event_id)
    {
        $where_is = WhereIs::where('event_id', $event_id)->first();
        return $where_is;
    }

    /**
     * _show_: It returns the where_is object for the id passed in.
     * It shows the where_is
     * 
     * @urlParam where_is_id string required The id of the where_is to show.
     * 
     * @return The WhereIs object
     */
    public function show($where_is)
    {
        $where_is = WhereIs::findOrFail($where_is);

        return $where_is;
    }

    /**
     * _update_: It takes a request, validates it, and then updates the where_is object in the database
     * It updates the where_is table with the data from the request.
     * 
     * @urlParam where_is_id string required The id of the where_is to update.
     * 
     * @bodyParam title string required The title of the where_is.
     * @bodyParam event_id int required The id of the event to add the where_is to.
     * @bodyParam max_time_response int required The max time the user has to respond.
     * @bodyParam responses array required The responses from the attendees.
     * 
     * @return The updated where_is object.
     */
    public function update(Request $request, $where_is)
    {
        $data = $request->json()->all();
        $where_is = WhereIs::findOrFail($where_is);
        $where_is->update($data);

        return response()->json($where_is, 200);
    }

    /**
     * _addOneResponse_: Add one response to the where_is object
     * It adds a response to a WhereIs
     * 
     * @urlParam where_is_id string required The id of the where_is to add the response to.
     * 
     * @bodyParam event_user_id string required The id of the event user.
     * @bodyParam time int required The time the user responded.
     * @bodyParam position string required The position of the user.
     * 
     * @return The response is the updated where_is object.
     */
    public function addOneResponse(Request $request, WhereIs $where_is)
    {
        $request->validate([
            'event_user_id' => 'required|string',
            'time' => 'required|numeric',
            'position' => 'required|numeric',
        ]);

        $data = $request->json()->all();
        $user_exist = Attendee::where('event_id', $where_is->event_id)
            ->where('_id', $data['event_user_id'])
            ->first();

        if (!isset($user_exist)) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $data['id'] = uniqid('');
        $data['name'] = $user_exist->properties['names'];
        //dd($data);

        $responses = isset($where_is->responses) ? $where_is->responses : [];
        array_push($responses, $data);
        $where_is->responses = $responses;
        $where_is->save();

        return response()->json($where_is, 200);
    }

    /**
     * _removeOneResponse_: Remove one response from the where_is object
     * > Remove a response from a where is
     * 
     * @urlParam where_is_id string required The id of the where_is to remove the response from.
     * 
     * @return A JSON object of the updated WhereIs object.
     */
    public function removeResponse(WhereIs $where_is, $response_id)
    {
        $responses = isset($where_is->responses) ? $where_is->responses : [];
        $new_responses = [];
        foreach ($responses as $response) {
            if ($response['id'] != $response_id) {
                array_push($new_responses, $response);
            }
        }
        $where_is->responses = $new_responses;
        $where_is->save();

        return response()->json($where_is, 200);
    }

    /**
     * _destroy_: It deletes the where_is object from the database
     * > This function deletes a where_is object and sets the where_is boolean in the event object to
     * false
     * 
     * @urlParam where_is_id string required The id of the where_is to delete.
     * 
     * @return 204
     */
    public function destroy($where_is)
    {

        $where_is = WhereIs::findOrFail($where_is);
        $event = Event::where('_id', $where_is->event_id)->first();
        if(isset($event->dynamics)){
            $dynamics = $event->dynamics;
            $dynamics["where_is"] = false;
        }else{
            $dynamics["where_is"] = false;
        }
        $event->dynamics = $dynamics;
        $event->save();
        $where_is->delete();

        return response()->json([], 204);
    }
}
