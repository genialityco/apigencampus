<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
// models
use App\DocumentUser;
use App\Models\Event;
use App\Attendee;

use Auth; 
/**
 * @group Document User
 * 
 * This model works to manage the documents to assign to the attendees.
 */
class DocumentUserController extends Controller
{
    /**
     * _index_: list all documents to user by event.
     * 
     * @urlParam event required event_id
     *
     * @response "data": [
     *  {
     *      "_id": "6192aeb6c179667f40763g29",
     *      "name": "document name",
     *      "url": "https://document/img.png",
     *      "assign": false,
     *      "updated_at": "2021-11-17 02:57:54",
     *      "created_at": "2021-11-15 19:02:14",
     *      "event_id": "602ecc7d52fc536415397962"
     *  }
     * ]
     */
    public function index($event)
    {
        $documents_user = DocumentUser::where('event_id', $event)->latest()->paginate(config('app.page_size'));

        return response()->json([$documents_user]);
    }

    /**
     * _store_: create a new document user in event
     * 
     * @authenticated
     * 
     * @urlParam event required event id
     * @bodyParam name string required Document name.
     * @bodyParam url string required Document url.
     * @bodyParam assign boolean required This indicate if the document is assigned to a user.
     * 
     * @response 201 {
     *   "name": "document name",
     *   "url": "https://document/img.png",
     *   "assign": false,
     *   "event_id": "602ecc7d52fc536415397962",
     *   "updated_at": "2021-11-16 18:29:47",
     *   "created_at": "2021-11-16 18:29:47",
     *   "_id": "6193f89bb558ed609e6f85c0"
     * }
     */
    public function store($event, Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'assign' => 'required|boolean',
        ]);

        $data = $request->json()->all();
        $data['event_id'] = $event; // asignacion de evento
        $created_document_user = new DocumentUser($data);
        $created_document_user->save();

        return response()->json($created_document_user, 201);
    }

    /**
     *
     * _show_: Get a document user by id
     * Display the specified resource.
     *
     * @urlParam event required event id
     * @urlParam documentuser required document user id
     * @return \Illuminate\Http\Response
     *
     * @response {
     *   "name": "document name",
     *   "url": "https://document/img.png",
     *   "assign": false,
     *   "event_id": "602ecc7d52fc536415397962",
     *   "updated_at": "2021-11-16 18:29:47",
     *   "created_at": "2021-11-16 18:29:47",
     *   "_id": "6193f89bb558ed609e6f85c0"
     * }
     */
    public function show($event, $document_user)
    {
        $document_user  = DocumentUser::findOrFail($document_user);
        if ($document_user->event_id !== $event) {
            return response()->json(['msg' => 'Documento no pertenece al evento'], 400);
        }

        return response()->json($document_user);
    }

    /**
     * _update_: Update a document user by id
     * Update the specified resource in storage.
     * 
     * @authenticated
     * @urlParam event required event id
     * @urlParam documentuser required document user id
     *
     * @response {
     *   "name": "updated document name",
     *   "url": "https://document/img.png",
     *   "assign": false,
     *   "event_id": "602ecc7d52fc536415397962",
     *   "updated_at": "2021-11-16 18:29:47",
     *   "created_at": "2021-11-16 18:29:47",
     *   "_id": "6193f89bb558ed609e6f85c0"
     * }
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event, $document_user)
    {
        $data = $request->json()->all();
        $document_user  = DocumentUser::findOrFail($document_user);
        if ($document_user->event_id !== $event) {
            return response()->json(['msg' => 'Documento no pertenece al evento'], 400);
        }
        $document_user->fill($data);
        $document_user->save();

        return response()->json($document_user);
    }

    /**
     * _destroy_: Delete a document user by id
     * Remove the specified resource from storage.
     * 
     * @authenticated
     * @urlParam event required event id
     * @urlParam documentuser required document user id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @response 204
     */
    public function destroy($event, $document_user)
    {
        $document_user = DocumentUser::findOrFail($document_user);
        if ($document_user->event_id !== $event) {
            return response()->json(['msg' => 'Documento no pertenece al evento'], 400);
        }
        $document_user->delete();

        return response()->json([], 204);
    }

    /**
     * _documentsUserByEvent_: list the documents of a logged in user.
     * 
     * @authenticated
     * @urlParam event required event id
     *
     * @response "data": [
     *  {
     *      "_id": "6192aeb6c179667f40763g29",
     *      "name": "document name",
     *      "url": "https://document/img.png",
     *      "assign": false,
     *      "updated_at": "2021-11-17 02:57:54",
     *      "created_at": "2021-11-15 19:02:14",
     *      "event_id": "602ecc7d52fc536415397962"
     *      "eventuser_id": "618a87be02824e0b750869a2"
     *  }
     * ]
     */
    public function documentsUserByUser($event)
    {    
        $user = Auth::user()->_id;
        $event_user = Attendee::where('event_id', $event)->where('account_id' , $user)->first();
        $documents_user = DocumentUser::where('event_id', $event)->where('eventuser_id', $event_user->_id)->latest()->paginate(config('app.page_size'));        

        return response()->json([$documents_user]);
    }
}
