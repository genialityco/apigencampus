<?php

namespace App\Http\Controllers;

use App\Event;
use App\Styles;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @resource Event
 *
 *
 */
class StylesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        return Styles::where("event_id", $event_id)->first();
    }


    public function indexTemp(Request $request, $event_id)
    {
        $Styles = Event::find($event_id);
        $url = !empty($Styles->styles["BackgroundImage"]) ? $Styles->styles["BackgroundImage"] : false;
        $color = !empty($Styles->styles["containerBgColor"]) ? $Styles->styles["containerBgColor"] : "#FFFFFF";
        
        list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
        $colorOrUrl = ($url) ? 'background-image: url("'.$url.'"' : "background-color:rgb(".$r . ", ". $g.", ". $b. ",0.5" ;
        $colorOrUrl = ($url) ? stripslashes($colorOrUrl):$colorOrUrl;
        
        return '.main section.landing{'.$colorOrUrl.') !important;}';
  }
    /**
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $result = new Styles($data);
        $result->save();
        return $result;
    }

    /**
     * Display the specified resource.
     * @param  \App\Styles  $Styles
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id)
    {
        $response = new JsonResource($Styles);
        return $response;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Styles  $Styles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $Styles = Styles::findOrFail($id);
        //if($Styles["event_id"]= $event_id){
        $Styles->fill($data);
        $Styles->save();
        return $data;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $event_id, $id)
    {
        $Styles = Styles::findOrFail($id);
        return (string) $Styles->delete();
    }
}
