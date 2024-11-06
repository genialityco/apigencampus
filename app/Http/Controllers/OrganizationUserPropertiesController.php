<?php

namespace App\Http\Controllers;

use App\Organization;
use App\UserProperties;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use DB;
/**
 * @group Organization User Properties
 *
 */
class OrganizationUserPropertiesController extends Controller
{

    /**
     * _index_: list of user properties of a specific event.
     * 
     * | Url Params   |
     * | -------------|
     * @urlParam  organization_id required. Example: 5fadbc9c8bc34c4c890c5ee4
     */
    public function index($organization_id)
    {    
        return JsonResource::collection(
           Organization::find($organization_id)->user_properties());
    }

    /**
     * _store_: a newly created resource in UserProperties.
     * 
     * | Url Params   |
     * | -------------|
     * @urlParam  organization_id required.
     * 
     * | Body Params   |
     * | --------------|
     * @bodyParam name                  strign required name of user's property. Example: celular 
     * @bodyParam mandatory             boolean required This field indicates that the field in the form cannot be null if it is set to true or false if it can be null. Example: true
     * @bodyParam visibleByContacts     boolean required visible by contacts if its value is true. Example: true
     * @bodyParam visibleByAdmin        boolean required visible by admin if its value is true. Example: true 
     * @bodyParam label                 string required label that will be visible in the registration form. Example: Celular
     * @bodyParam description           string required description. Example: Número de contacto
     * @bodyParam type                  string required type of character the field accepts in the form, Example: number
     * @bodyParam justonebyattendee     boolean required Example: true
     * @bodyParam order_weight          number required order of fields in the form. Example: 1
     * 
     */
    public function store(Request $request, $organization_id)
    {        
        $data = $request->json()->all();
        $organization = Organization::find($organization_id)->user_properties();
        $model = new UserProperties($data);
        $organization->save($model);
        return $model; 
    }

    /**
     * _show_: view the specific user propertie.
     * 
     * 
     * | Url Params   |
     * | -------------|
     * @urlParam  organization_id required 
     * @urlParam  id required id UserProperties
     * 
     */
    public function show($organization_id,$id)
    {
        
        $UserProperties = Organization::find($organization_id)->user_properties()->find($id);
        
        $response = new JsonResource($UserProperties);
        //if ($UserProperties["organization_id"] = $organization_id) {
        return $response;

    }

    /**
     * _RegisterListFieldOptionTaken_: bloquea un elemento que un asistente ya escogio de un campo tipo lista de elementos con inventario cuando se registra a un evento.
     * Toca hacerlo asi porque con la concurrencia se nos estaban cruzando dos peticiones simultaneas y solo quedaba con los valores de la última
     * 
     */
    public function RegisterListFieldOptionTaken(Request $request, $organization_id, $id){

        $data = $request->json()->all();
        return (string) Organization::find($organization_id)->push('takenoptions_'.$id,$data,true);
    }
    /**
     * _update_: update the specified resource in UserProperties.
     * 
     * | Url Params   |
     * | -------------|
     * @urlParam  organization_id required 
     * @urlParam  id required id UserProperties
     * 
     * | Body Params   |
     * | ------------- |
     * 
     * @bodyParam name                  strign name of user's property. Example: celular 
     * @bodyParam mandatory             boolean This field indicates that the field in the form cannot be null if it is set to true or false if it can be null. Example: true
     * @bodyParam visibleByContacts     boolean visible by contacts if its value is true. Example: true
     * @bodyParam visibleByAdmin        boolean visible by admin if its value is true. Example: true 
     * @bodyParam label                 string label that will be visible in the registration form. Example: Celular
     * @bodyParam description           string description. Example: Número de contacto
     * @bodyParam type                  string type of character the field accepts in the form, Example: number
     * @bodyParam justonebyattendee     boolean Example: true
     * @bodyParam order_weight          number order of fields in the form. Example: 1
     * 
     */
    public function update(Request $request, $organization_id, $id)
    {
        
        $data = $request->json()->all();
        
        $userProperty = Organization::find($organization_id)->user_properties()->find($id);
        if (!$userProperty){
            return abort(404);
        }
        $userProperty->fill($data);
     
        $userProperty->save();
        
        return  $userProperty;
    }

    /**
     * _destroy_: remove the specified resource from UserProperties.
     * 
     * | Url Params   |
     * | -------------|
     * @urlParam  organization_id required 
     * @urlParam  id required id UserProperties
     *
     */
    public function destroy($organization_id, $id)
    {   
        $event = Organization::find($organization_id)->user_properties()->find($id);
        if (!$event){
            return abort(404);
        }
        return (string) $event->delete();
    }
}
