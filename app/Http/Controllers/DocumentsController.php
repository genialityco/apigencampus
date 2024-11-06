<?php

namespace App\Http\Controllers;

use App\Event;
use App\Documents;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group Documents
 * The documents are file that you can downloads from event.
 *
 */
class DocumentsController extends Controller
{
    /**
     * _index_ : list documents by event
     * 
     * @urlParam event required event_id
     */
    public function index(Request $request, $event_id)
    {
        $father_id = $request->input("father_id");
        
        if(!empty($father_id)){
            return JsonResource::collection(
                Documents::where("event_id", $event_id)->where("father_id", $father_id)->paginate(config('app.page_size'))
            );
        }
        return JsonResource::collection(
            Documents::where("event_id", $event_id)->where("state", "father")->paginate(config('app.page_size'))
        );
    }

    public function indexFiles(Request $request, $event_id)
    {
        return JsonResource::collection(
            Documents::where("event_id", $event_id)->where("type", "file")->paginate(config('app.page_size'))
        );
    }
    /**
     * _store_: create documents in the event
     * @urlParam event required event id
     * 
     * @bodyParam name required name Example: gato.jpg
     * @bodyParam title required title Example: gato.jpg 
     * @bodyParam format required name Example: jpg 
     * @bodyParam type required type Example: file
     * @bodyParam file required url document Example: https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/documents%2F61a65a6c47430f7aae79cca4%2F1639168484513-gato4.jpg?alt=media&token=1455a85f-6381-4a92-a00e-47c916ed236c
     */
    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        if(!empty($data["father_id"])){
            
            $data = $request->json()->all();
            $data["event_id"] = $event_id;
            $data["state"] = "child";     
            $result = new Documents($data);

            $result->save();

            return $result;
        }

            $data["event_id"] = $event_id;     
            $data["state"] = "father"; 

            $result = new Documents($data);
            $result->save();
            return $result;
    }
    /**
    * _store_: create documents in the event
    * @urlParam event required event id
    * 
    * @bodyParam name required name Example: gato.jpg
    * @bodyParam title required title Example: gato.jpg 
    * @bodyParam format required name Example: jpg 
    * @bodyParam type required type Example: file
    * @bodyParam file required url document Example: https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/documents%2F61a65a6c47430f7aae79cca4%2F1639168484513-gato4.jpg?alt=media&token=1455a85f-6381-4a92-a00e-47c916ed236c
    */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $push = Documents::findOrFail($id);
        //if($Space["event_id"]= $event_id){
        $push->fill($data);
        $push->save();
        return $data;
    }

    /**
     * _show_: information from a specific document
     * @urlParam event required event id
     * @urlParam document required evdocdocumentumentent id
     */ 
    public function show($event_id,$id)
    {
        $documents = Documents::findOrFail($id);
        $response = new JsonResource($documents);
        return $response;
    }

    /**
     * _destroy_: delete a specific document
     * 
     * @urlParam event required event id
     * @urlParam document required evdocdocumentumentent id
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $documents = Documents::findOrFail($id);
        return (string) $documents->delete();
    }
}
