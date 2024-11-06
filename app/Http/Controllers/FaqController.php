<?php

namespace App\Http\Controllers;

use App\Event;
use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @resource Event
 *
 *
 */
class FaqController extends Controller
{

    /* por defecto el modelo es en singular y el nombre de la tabla en prural
    //protected $table = 'categories';
    $a = new Faq();
    var_dump($a->getTable());
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        $data = $request->json()->all();
        //esta condicion expresa si existe la variable 'locale' en una peticion por json o por url, y valida que valor existe en estas varibles
        $res = (!empty($data['locale']) && $data['locale'] == "en" || !empty($request->input('locale')) && $request->input('locale') == "en") ? "en" : "es";

        if($res=="en"){
            return JsonResource::collection(
                Faq::where("event_id", $event_id)->where('locale', "en")->paginate(config('app.page_size')));
        }else{
            return JsonResource::collection(
                Faq::where("event_id", $event_id)->where('locale', '!=', "en")->paginate(config('app.page_size')));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
        $data = $request->json()->all();
        $data["event_id"] = $event_id;
        $result = new Faq($data);
        $result->save();
        return $result;
    }
    
    public function duplicate($event_id, $id)
    {
        $faq = Faq::findOrFail($id);
        $faqs_in_es = $faq;
        $data['duplicate'] = true;
        $faq->fill($data);
        $faq->save();
        //echo "original Faq :".var_dump($faq);
        if(!empty($faqs_in_es->duplicate)){
            return "actividad ya duplicada";
        }
        $faqs_in_es->get();
        $faqs_in_en = json_decode(json_encode($faqs_in_es),true);
        $faqs_in_en["locale"] = "en";
        $faqs_in_en["locale_original"] = $faqs_in_en['_id'];
        $new_faq = new Faq($faqs_in_en);
        $new_faq->save();
        return $new_faq;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $Faq
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,$id)
    {
        $faq = Faq::findOrFail($id);
        $response = new JsonResource($faq);
        //if ($Faq["event_id"] = $event_id) {
        return $response;

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $Faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id, $id)
    {
        $data = $request->json()->all();
        $faq = Faq::findOrFail($id);
        //if($Faq["event_id"]= $event_id){
        $faq->fill($data);
        $faq->save();
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
        $faq = Faq::findOrFail($id);
        return (string) $faq->delete();
    }
}
