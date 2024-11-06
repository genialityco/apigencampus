<?php

namespace App\Http\Controllers;

use App\DiscountCode;
use App\DiscountCodeTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Log;
use Validator;

/**
 * @group DiscountCodeTemplate
 *
 * The discount template is used to generate the discount codes, along with their percentage and the limit of uses for each code.
 *
 */
class DiscountCodeTemplateController extends Controller
{

    /* por defecto el modelo es en singular y el nombre de la tabla en prural
    //protected $table = 'categories';
    $a = new Category();
    var_dump($a->getTable());
     */

    /**
     * _index_: list all Discount Code Templates
     *
     * @response
     * [
     *     {
     *         "_id": "5fcee46a27b131731965ba7f",
     *         "name": "90%",
     *         "discount": "90",
     *         "use_limit": "1",
     *         "event_id": "5fc9bd9a6f78fc22da463509",
     *         "updated_at": "2021-01-11 23:01:07",
     *         "created_at": "2020-12-08 02:26:50",
     *         "discount_type": "percentage",
     *         "event": {
     *             "_id": "5fc9bd9a6f78fc22da463509",
     *             "datetime_from": "2021-02-22 00:00:00",
     *             "datetime_to": "2021-02-25 00:00:00",
     *             "description": "La música y la imagen como conceptos que van de la mano.  La escritura de ideas e historia , a través de la música y la imagen. Storytelling, Transmedia y captación de audiencias para proyectos musicales y artísticos.",
     *             "name": "Expresión Gráfica para proyectos musicales",
     *             "picture": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/ucronio-dev%2F05_ExpresionGrafica.jpg?alt=media&token=c4bfa160-01b6-442c-8c88-2cfd57ec5942",
     *             "visibility": "PUBLIC"
     *         }
     *     },
     *     {
     *         "_id": "5fd4f51720b4fa0f2b4437d5",
     *         "name": "Curso de regalo",
     *         "use_limit": 1,
     *         "discount": 100,
     *         "event_id": "5ea6df83cf57da4a52065562",
     *         "discount_type": "price",
     *         "updated_at": "2020-12-12 16:51:35",
     *         "created_at": "2020-12-12 16:51:35",
     *         "event": {
     *             "_id": "5ea6df83cf57da4a52065562",
     *             "name": "Test Event",
     *             "datetime_from": "2020-06-01 08:00:00",
     *             "datetime_to": "2020-06-06 22:00:00",
     *             "picture": "https:\/\/storage.googleapis.com\/herba-images\/evius\/events\/ysn7fDSU0avqNqcn2f53uoPtShKiix1tG7XkJDFw.png",
     *             "venue": "Mocion"
     *         }
     *     }
     * ]
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return JsonResource::collection(
            DiscountCodeTemplate::get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * _store_:create new discount code template
     *
     * @bodyParam name string required Example: Curso de regalo
     * @bodyParam use_limit number required the number of uses for each code Example: 1
     * @bodyParam discount number required price to be discounted or percentage discount Example: 100
     * @bodyParam event_id string  event with which the template will be associated Example: 5ea23acbd74d5c4b360ddde2
     * @bodyParam organization_id string  organization_id if you want the discount template to be applicable to any course Example: 5e9caaa1d74d5c2f6a02a3c3
     * @bodyParam discount_type string required  percentage or price
     * 
     * @response [
     * {
     *       "_id": "5fc80b2a31be4a3ca2419dc4",
     *       "name": "Código de regalo",
     *       "discount": 100,
     *       "event_id": "5ea23acbd74d5c4b360ddde2",
     *       "use_limit": 1,
     *       "updated_at": "2020-12-02 21:46:18",
     *       "created_at": "2020-12-02 21:46:18"
     *   },
     *   {
     *       "_id": "5fc93d5eccba7b16a74bd538",
     *       "name": "Acceso",
     *       "discount": 100,
     *       "event_id": "5ea23acbd74d5c4b360ddde2",
     *       "use_limit": 1,
     *       "updated_at": "2020-12-03 19:32:46",
     *       "created_at": "2020-12-03 19:32:46"
     *   },
     *   {
     *       "_id": "5fc97a186b7e7f2ff822bc92",
     *       "name": "Acceso1",
     *       "discount": "20",
     *       "use_limit": "10",
     *       "event_id": "5fba0649f2d08642eb750ba0",
     *       "updated_at": "2020-12-03 23:51:52",
     *       "created_at": "2020-12-03 23:51:52"
     *   }
     * ]
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $result = new DiscountCodeTemplate($data);

        $rules = [
            'name' => "required",
            'use_limit' => "required",
            // 'discount' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }   
        
        if(!isset($data['event_id']) && !isset($data['organization_id']))
        {
            return response()->json(['errors' => "Debe ingresar organization_id o event_id "], 400);
        }
        else if(isset($data['event_id']) && isset($data['organization_id']))
        {
            return response()->json(['errors' => "Solo debe ingresar uno de los campos, organization_id o event_id "], 400);
        }

        $result->save();

        // $group_id = $result->_id;   
        
        // self::createCodes($group_id , $event_id, $quantity);        

        return $result;

    }

    /**
     * _show_ : information from a specific template
     *
     * @urlParam discountcodetemplate id Example: 5fcee46a27b131731965ba7f
     * 
     * @response
     * {
     *     "_id": "5fcee46a27b131731965ba7f",
     *     "name": "90%",
     *     "discount": "90",
     *     "use_limit": "1",
     *     "event_id": "5fc9bd9a6f78fc22da463509",
     *     "updated_at": "2021-01-11 23:01:07",
     *     "created_at": "2020-12-08 02:26:50",
     *     "discount_type": "percentage",
     *     "event": {
     *         "_id": "5fc9bd9a6f78fc22da463509",
     *         "datetime_from": "2021-02-22 00:00:00",
     *         "datetime_to": "2021-02-25 00:00:00",
     *         "description": "La música y la imagen como conceptos que van de la mano.  La escritura de ideas e historia , a través de la música y la imagen. Storytelling, Transmedia y captación de audiencias para proyectos musicales y artísticos.",
     *         "name": "Expresión Gráfica para proyectos musicales",
     *         "picture": "https:\/\/firebasestorage.googleapis.com\/v0\/b\/eviusauth.appspot.com\/o\/ucronio-dev%2F05_ExpresionGrafica.jpg?alt=media&token=c4bfa160-01b6-442c-8c88-2cfd57ec5942",
     *         "visibility": "PUBLIC"
     *     }
     * }
     *
     * @param  \App\DiscountCodeTemplate  $codegroup
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $codegroup = DiscountCodeTemplate::findOrFail($id);
        $response = new JsonResource($codegroup);
        //if ($Inscription["event_id"] = $event_id) {
        return $response;
    }

    /**
     * _update_: update information from a specific template
     *
     * @bodyParam name string  Example: Curso de regalo
     * @bodyParam use_limit number  the number of uses for each code Example: 1
     * @bodyParam discount number discount percentage Example: 100
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $data = $request->json()->all();
        $category = DiscountCodeTemplate::find($id);
        $category->fill($data);
        $category->save();
        return $data;
    }

    /**
     * _destroy_: delete the specified docunt code template
     *
     * @urlParam id discount template id
     * 
     * @response 400{
     *  "message" : "El grupo no se puede eliminar si está asociado a un código de descuento"
     * }
     * 
     * @response 1
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $codegroup = DiscountCodeTemplate::findOrFail($id);
        $codes = DiscountCode::where('discount_code_template_id', $codegroup->_id)->first();

        if ($codes) {
            abort(400, 'El grupo no se puede eliminar si está asociado a un código de descuento');
        }

        return (string) $codegroup->delete();

    }

//String de prueba


    /**
     * _importCodes_ : Imports DiscountCodes in JSON format, in case this codes are generated in external platform
     * and needed to be used inside EVIUS
     *
     * @param Request $request
     * @param String  $template_id id of the codeTemplate of codes to be imported
     * @bodyParam [json object] Example: {"codes":[{"code":"160792352"},{"code":"204692331"}]}
     * @return Array ['newCodes','oldCodes'] amount of codes created
     */
    public function importCodes(Request $request, $template_id)
    {

        $data = $request->json()->all();

        $codeTemplate = DiscountCodeTemplate::findOrFail($template_id);

        if (!isset($data['codes'])) {
            abort("codes parameter is required", 405);
        }

        $newCodes = 0;
        $oldCodes = 0;
        $codes = $data['codes'];
        foreach ($codes as $codedata) {
            if(isset($codeTemplate->event_id))
            {
                $code = array_merge($codedata, [
                    'number_uses' => 0,
                    'discount_code_template_id' => $template_id,
                    'event_id' => $codeTemplate->event_id,
                ]);
            }else{
                $code = array_merge($codedata, [
                    'number_uses' => 0,
                    'discount_code_template_id' => $template_id,
                    'organization_id' => $codeTemplate->organization_id,
                ]);
            }
            

            $storedCode = DiscountCode::where('code', '=', $codedata['code'])->first();

            if (!$storedCode) {
                $code = new DiscountCode($code);
                $code->save();
                $newCodes++;
            } else {
                $oldCodes++;
            }

        }

        Log::info('data from etiqueta blanca json    ' . json_encode($data));

        return ["newCodes" => $newCodes, "oldCodes" => $oldCodes];
    }

    /**
     *
     */
    // public function createCodes($group_id , $event_id, $quantity){

    //     $resultCode = '';
    //     for ($i = 1; $i <= $quantity; $i++) {
    //         $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    //         $input_length = strlen($permitted_chars);
    //         $random_string = '';
    //         for ($i = 0; $i < 8; $i++) {
    //             $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
    //             $random_string .= $random_character;
    //         }

    //         $dataCode['code'] = $random_string;
    //         $dataCode['discount_code_template_id'] = $group_id;
    //         $dataCode['event_id'] = $event_id;

    //         $resultCode = new DiscountCode($dataCode);
    //         // var_dump($resultCode);die;
    //         $resultCode->save();

    //     }
    //     return  $resultCode;

    // }

    /**
     * _findByOrganization_: find disount code template by organization
     * 
     * @urlParam organization required organization id Example: 5e9caaa1d74d5c2f6a02a3c3
     */
    public function findByOrganization($organization_id){
        $template = DiscountCodeTemplate::where('organization_id', $organization_id)->get();
        return $template;
    }
}   
