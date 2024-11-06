<?php

namespace App\Http\Controllers;

use App\Event;
use App\Newsfeed;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group News Feed 
 *
 */
class NewsfeedController extends Controller
{

    /**
     * _index_: list of news of the event.
     * 
     * @urlParam event required id event Example: 605241e68b276356801236e4 
     */
    public function index($event_id)
    {
        return JsonResource::collection(
            Newsfeed::where("event_id", $event_id)->paginate(config('app.page_size'))
        );
    }

    /**
     * _store_: create news in an event
     * @authenticated
     * 
     * @urlParam event required id event. Example: 605241e68b276356801236e4
     * 
     * @bodyParam title string required news title. Example: Los mejores eventos están en Evius
     * @bodyParam description_complete news complete   string. Example: Los eventos en evius son interactivos porque tiene multiples opciones...         
     * @bodyParam description_short string news description short Example: Los eventos en Evius son los más interactivos y los mejores.
     * @bodyParam linkYoutube string news video Example: https://www.youtube.com/watch?v=m1YUmZRfgqU&ab_channel=MG1010
     * @bodyParam image string news image. Example: https://storage.googleapis.com/eviusauth.appspot.com/evius/events/IdKxqboMxU0pvgY3AbRkig4ZptQcUNE4CUvysJIn.png
     * @bodyParam time  string news date. Example: 2021-08-02
     */
    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $result = new Newsfeed($data);
        $result->save();
        return $result;
    }

    /**
     * _show_:  view information for a specific news
     *
     * @urlParam event required id event. Example: 605241e68b276356801236e4
     * @urlParam newsfeed required id news. Example: 6107fe65ff324f482d1c7569
     * 
     */
    public function show($event_id,$id)
    {
        $Newsfeed = Newsfeed::findOrFail($id);
        $response = new JsonResource($Newsfeed);
        return $response;

    }
    /**
     * _update_: create news in an event
     * @authenticated
     * 
     * @urlParam event required id event. Example: 605241e68b276356801236e4
     * 
     * @bodyParam title string news title. Example: Los mejores eventos están en Evius
     * @bodyParam description_complete news complete   string. Example: Los eventos en evius son interactivos porque tiene multiples opciones...         
     * @bodyParam description_short string news description short Example: Los eventos en Evius son los más interactivos y los mejores.
     * @bodyParam linkYoutube string news video Example: https://www.youtube.com/watch?v=m1YUmZRfgqU&ab_channel=MG1010
     * @bodyParam image string news image. Example: https://storage.googleapis.com/eviusauth.appspot.com/evius/events/IdKxqboMxU0pvgY3AbRkig4ZptQcUNE4CUvysJIn.png
     * @bodyParam time  string news date. Example: 2021-08-02
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $newsfeed = Newsfeed::findOrFail($id);
        //if($Newsfeed["event_id"]= $event_id){
        $newsfeed->fill($data);
        $newsfeed->save();
        return $data;

    }

    /** 
     * _destroy_:  delete a specific news
     *
     * @urlParam event required id event. Example: 605241e68b276356801236e4
     * @urlParam newsfeed required id news. Example: 6107fe65ff324f482d1c7569
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $Newsfeed = Newsfeed::findOrFail($id);
        return (string) $Newsfeed->delete();
    }
}
