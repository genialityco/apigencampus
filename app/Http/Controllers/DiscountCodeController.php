<?php

namespace App\Http\Controllers;


use App\DiscountCode;
use App\DiscountCodeMarinela;
use App\DiscountCodeTemplate;
use App\Mail\DiscountCodeMail;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Storage;
use Validator;
use Auth;
use App\evaLib\Services\CodeServices;
use Log;
use App\Account;
use App\Attendee;
use App\Order;


/**
 * @group DiscountCode
 *
 *
 */
class DiscountCodeController extends Controller
{

    /* por defecto el modelo es en singular y el nombre de la tabla en prural
    //protected $table = 'categories';
    $a = new Category();
    var_dump($a->getTable());
     */

    /**
     * _index_: list of discount codes by template
     * @urlParam template_id required Example: 5fc80b2a31be4a3ca2419dc4
     * 
     * @response [
     *  {
     *       "_id": "5fc81e8631be4a3ca2419dcc",
     *       "code": "puBdF3zCs",
     *       "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
     *       "event_id": "5ea23acbd74d5c4b360ddde2",
     *       "updated_at": "2020-12-04 17:17:07",
     *       "created_at": "2020-12-02 23:08:54",
     *       "number_uses": 1
     *   },
     *   {
     *       "_id": "5fc825e431be4a3ca2419ddf",
     *       "code": "9L54R947",
     *       "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
     *       "event_id": "5ea23acbd74d5c4b360ddde2",
     *       "updated_at": "2020-12-03 21:01:20",
     *       "created_at": "2020-12-02 23:40:20",
     *       "number_uses": 1
     *   },
     *   {
     *       "_id": "5fcbf67721bfcb1393450fc3",
     *       "code": "Nyd0jOpQ",
     *       "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
     *       "event_id": "5ea23acbd74d5c4b360ddde2",
     *       "updated_at": "2020-12-05 21:07:03",
     *       "created_at": "2020-12-05 21:07:03"
     *   }
     * ]
     */
    public function index($template_id)
    {   
        $query = DiscountCode::where('discount_code_template_id', $template_id);
        return JsonResource::collection($query->get());
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
     * _store_: ceate new discount code
     * 
     * @urlParam template_id required Example: 5fc80b2a31be4a3ca2419dc4
     * @bodyParam quantity number required number of codes to be generated Example: 2
     * 
     * @response {
     *     "current_page": 1,
     *     "data": [
     *         {
     *             "_id": "5fcbf67721bfcb1393450fc3",
     *             "code": "Nyd0jOpQ",
     *             "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
     *             "event_id": "5ea23acbd74d5c4b360ddde2",
     *             "updated_at": "2020-12-05 21:07:03",
     *             "created_at": "2020-12-05 21:07:03",
     *             "discount_code_template": {
     *                 "_id": "5fc80b2a31be4a3ca2419dc4",
     *                 "name": "Código de regalo",
     *                 "discount": 100,
     *                 "event_id": "5ea23acbd74d5c4b360ddde2",
     *                 "use_limit": 1,
     *                 "updated_at": "2020-12-02 21:46:18",
     *                 "created_at": "2020-12-02 21:46:18",
     *                 "event": {
     *                     "_id": "5ea23acbd74d5c4b360ddde2",
     *                     "name": "Evento virtual Idartes",
     *                     "datetime_from": "2020-10-14 12:00:00",
     *                     "datetime_to": "2020-10-14 12:00:00",
     *                     "venue": "Teatro Municipal Jorge Eliécer Gaitán"
     *                 }
     *             }
     *         },
     *         {
     *             "_id": "5fcbf67721bfcb1393450fc4",
     *             "code": "Nyd0jOpR",
     *             "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
     *             "event_id": "5ea23acbd74d5c4b360ddde2",
     *             "updated_at": "2020-12-05 21:07:03",
     *             "created_at": "2020-12-05 21:07:03",
     *             "discount_code_template": {
     *                 "_id": "5fc80b2a31be4a3ca2419dc4",
     *                 "name": "Código de regalo",
     *                 "discount": 100,
     *                 "event_id": "5ea23acbd74d5c4b360ddde2",
     *                 "use_limit": 1,
     *                 "updated_at": "2020-12-02 21:46:18",
     *                 "created_at": "2020-12-02 21:46:18",
     *                 "event": {
     *                     "_id": "5ea23acbd74d5c4b360ddde2",
     *                     "name": "Evento virtual Idartes",
     *                     "datetime_from": "2020-10-14 12:00:00",
     *                     "datetime_to": "2020-10-14 12:00:00",
     *                     "venue": "Teatro Municipal Jorge Eliécer Gaitán"
     *                 }
     *             }
     *         }
     *     ]
     * }    
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $group_id)
    {
        $request->validate([
            'space_available' => 'numeric' // Used for Royal Prestige, number of available users
        ]);

        $data = $request->json()->all();

        $rules = [
            'quantity' => 'required'
        ];

        $validator = Validator::make($data, $rules);
        if (!$validator->passes()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }
        
        
        $resultCode = '';

        //Generate codes automatically according to the quantity entered 
            $x = 1;
            while($x <= $data['quantity']) {            
                //Generate code randomly
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                    $input_length = strlen($permitted_chars);
                    $random_string = '';
                    for ($j = 0; $j < 8; $j++) {
                        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
                        $random_string .= $random_character;
                    } 
                    
                    $data['code'] = $random_string;
                    $data['discount_code_template_id'] = $group_id;
                    
                //Find the templater to which the code is associated and enter the organizer_id or event_id as appropriate
                    $group  = DiscountCodeTemplate::find($group_id);

                    if(!isset($group->event_id))
                    {
                        $data['organization_id'] =  $group->organization_id;
                    }else{                
                        $data['event_id'] = $group->event_id;
                    }
                    $resultCode = new DiscountCode($data);

                //It checks if the code is repeated so as not to save it and generate another
                    $repeated =  DiscountCode::where('code' , $random_string)->first();

                    if(!isset($repeated))
                    {                                             
                        $resultCode->save();   
                        $x++;
                    }             
                        
            }
            return DiscountCode::where('discount_code_template_id', $group_id)->paginate(config('app.page_size'));

    }


    /**
     * _show_: view information for a specific code
     * 
     * @urlParam template_id required discount code template with which the code is associated Example: 5fc80b2a31be4a3ca2419dc4
     * @urlParam code required code to be consulted Example: 5fcbf67721bfcb1393450fc3
     * 
     * @response {
     *               "_id": "5fcbf67721bfcb1393450fc3",
     *               "code": "Nyd0jOpQ",
     *               "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
     *               "event_id": "5ea23acbd74d5c4b360ddde2",
     *               "updated_at": "2020-12-05 21:07:03",
     *               "created_at": "2020-12-05 21:07:03",
     *               "discount_code_template": {
     *                   "_id": "5fc80b2a31be4a3ca2419dc4",
     *                   "name": "Código de regalo",
     *                   "discount": 100,
     *                   "event_id": "5ea23acbd74d5c4b360ddde2",
     *                   "use_limit": 1,
     *                   "updated_at": "2020-12-02 21:46:18",
     *                   "created_at": "2020-12-02 21:46:18",
     *                   "event": {
     *                       "_id": "5ea23acbd74d5c4b360ddde2",
     *                       "name": "Evento virtual Idartes",
     *                       "datetime_from": "2020-10-14 12:00:00",
     *                       "datetime_to": "2020-10-14 12:00:00",
     *                       "venue": "Teatro Municipal Jorge Eliécer Gaitán"
     *                      }
     *               }
     *           }
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($template_id, $id)
    {
        $code = DiscountCode::find($id);
        return $code;
    }

    /**
     * _update_: update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $data = $request->json()->all();
        $category = DiscountCode::find($id);

        
        $category->fill($data);
        $category->save();
        return $data;
    }

    /**
     * _destroy_: Remove the specified resource from storage.
     * 
     * @urlParam template_id required
     * @urlParam code required id code delete
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($template_id ,$id)
    {   
        $discountCode = DiscountCode::findOrFail($id);
        return (string) $discountCode->delete();

    }


    // /**
    //  *  _changeCode_ :  redeem the discount code
    //  */
    // public function exchangeCode(Request $request)
    // {   
    //     $data = $request->json()->all();
    //     $result = CodeServices::exchangeCode($data);
    // }


    /**
     * 
     * _validateCode_ : valid if the code is redeemed, exists or is valid.
     * 
     * To verify the code you must send code and event_id or organization_id as the case may be
     * 
     * @bodyParam code string required code to redeem Example: Nyd0jOpQ
     * @bodyParam event_id string event for which the code was purchased Example: 5ea23acbd74d5c4b360ddde2
     * @bodyParam organization_id string organization so that the code applies to any event Example: 
     * 
     * @response 403 {
     *      "message" : "El código ya se uso"
     * }
     * 
     * @response 404 {
     *      "message": "El código no existe"
     * }
     * 
     * @response {
     *   "_id": "5fcbf67721bfcb1393450fc3",
     *   "code": "Nyd0jOpQ",
     *   "discount_code_template_id": "5fc80b2a31be4a3ca2419dc4",
     *   "event_id": "5ea23acbd74d5c4b360ddde2",
     *   "updated_at": "2020-12-05 21:07:03",
     *   "created_at": "2020-12-05 21:07:03",
     *   "discount_code_template": {
     *       "_id": "5fc80b2a31be4a3ca2419dc4",
     *       "name": "Código de regalo",
     *       "discount": 100,
     *       "event_id": "5ea23acbd74d5c4b360ddde2",
     *       "use_limit": 1,
     *       "updated_at": "2020-12-02 21:46:18",
     *       "created_at": "2020-12-02 21:46:18",
     *       "event": {
     *           "_id": "5ea23acbd74d5c4b360ddde2",
     *           "name": "Evento virtual Idartes",
     *           "datetime_from": "2020-10-14 12:00:00",
     *           "datetime_to": "2020-10-14 12:00:00",
     *           "venue": "Teatro Municipal Jorge Eliécer Gaitán"
     *          }
     *    }
     * }
     *
     */
    public function validateCode(Request $request)
    {   
        $request->validate([
            'code' => 'required|string',
            'event_id' => 'required|string',
            'organization_id' => 'string'
        ]);

        $data = $request->json()->all();
        
        // $code = "";
        // The entered code is searched for to validate if it exists 
            
        
        // if(isset($data['organization_id']) && $data['organization_id'] = '60467fbd9caef512a5626fc9')
        // {
        //     $code = DiscountCodeMarinela::where('organization_id', $data['organization_id'])->where("code" , $data['code'])->first();
        //     // Log::info("Ingreso correcto de Marinela");

        // }else{
        //     $code = isset($data['event_id']) ? 
        //     DiscountCode::where('event_id', $data['event_id'])->where("code" , $data['code'])->first() :
        //     DiscountCode::where('organization_id', $data['organization_id'])->where("code" , $data['code'])->first();
        // }

        $code = isset($data['event_id']) ? 
            DiscountCode::where('event_id', $data['event_id'])->where("code" , $data['code'])->first() :
            DiscountCode::where('organization_id', $data['organization_id'])->where("code" , $data['code'])->first();

        if($code){
            $discountCodeTemplate = DiscountCodeTemplate::where('_id',$code->discount_code_template_id)->first();
            
            
            if($code->number_uses < $discountCodeTemplate->use_limit){
                return $code;
            }
            
            return abort(403 , 'El código ya se uso');
        }
        
        return abort(404 , 'El código no existe');
    }

    /**
     * _redeemPointCode_: end point that redeems the points code and adds them to the user who redeemed it.
     * 
     * @autenticathed
     * @bodyParam code string required code that the user is redeeming
     * 
     */
    public function redeemPointCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'event_user_id' => 'required|string'
        ]);
        
        $data = $request->json()->all();
        // $organization = $request->input('organization_id');
        
        // $code = "";
        // if(isset($organization) &&  $organization = '60467fbd9caef512a5626fc9')
        // {
        //     $code = DiscountCodeMarinela::where('code', $data['code'])->first();
        //     // Log::info("Ingreso correcto de Marinela");
        // }else{
        //     $code = DiscountCode::where('code', $data['code'])->first();
        // }

        $code = DiscountCode::where("code" , $data['code'])->first();
        
        //authenticated user
        // $user = Auth::user();
        $discountCodeTemplate = DiscountCodeTemplate::where('_id',$code->discount_code_template_id)->first();
        // if(!isset($group))   
        // {
            //     $discount= "discount_code_template_id ";
            //     $group = DiscountCodeTemplate::where('_id',$code->$discount)->first();            
            // }
            
            
            //Se valida si el código ya se uso     
            if($code->number_uses < $discountCodeTemplate->use_limit){
                //Si el código es valido se suma un uso
                // $code->account_id = $user->_id; 
                $code->number_uses +=1;
                $code->save();

                //Creation of order in which the redemption of the code is registered
                $eventUser = Attendee::findOrFail($data['event_user_id']);
                $newOrder = [
                    'event_user_id' => $data['event_user_id'],
                    'event_id' => $code->event_id,
                    'code_id' => $code->_id,
                    'discount_code_template_id' => $code->discount_code_template_id,
                    'space_available' => $code->space_available,
                    // user addiction to available affiliates
                    // 'affiliates' => [$eventUser->_id]
                ];
                $order = Order::create($newOrder);
                // $order->save();

                // Assign order to event user
                $eventUser->order_id = $order->_id;
                $eventUser->save();

                //Se suman los puntos canjeados al usuario
                // $user->points = $user->points+$group->discount;
                // $user->save();

                return compact("order");
        }
        
        return abort(403 , 'El código ya se uso');    
    }   
    
    /**
     * 
     */
    public function deleteCodesByTemplate(Request $request)
    {
        $discountTemplate = '604683bb8992c135e86dca04';
        $code = DiscountCode::where('discount_code_template_id' ,$discountTemplate)->paginate(100000);
        return $code;
    }

    /**
     * _codesByUser_: list all codes by user
     *
     * @queryParam organization required organization_id 
     * @queryParam email required user email
     */
    public function codesByUser(Request $request)
    {   
        $data = $request->input();

        $templates = DiscountCodeTemplate::where('organization_id', $data['organization'])->get()->keyBy('_id')->toArray();

        $user = Account::where('email',$data['email'])->first();
        
        $codes = DiscountCodeMarinela::where('number_uses' , 1)
                ->where('account_id' , $user->_id)
                ->get();
                

        echo 'Usuario, Documento,Código redimido, Fecha de ingreso del código ,Puntos </br>';
            
        foreach($codes as $code)
        {   
            
            $template_id = $code->discount_code_template_id;

            if(!$template_id)   
            {
                $discount= "discount_code_template_id ";
                $template_id = $code->$discount;
            }
            $template = $templates[$template_id];
            
            echo  $user->email .','.  $user->document_number .','.$code->code .','. $code->updated_at .','. $template['discount'].'</br>';                            
        }

    }    



    /**
     * 
     */
    public function orderByUser(Request $request)
    {   
        $data = $request->json()->all();

        $filters = $request->input();
        $templates = DiscountCodeTemplate::where('organization_id', '60467fbd9caef512a5626fc9')->get()->keyBy('_id')->toArray();
                

        $status = isset($filters["status"]) ? $filters["status"] : "pendiente";

        $status_id = "";
        switch ($status)
        {
            case 'pendiente':
                $status = "5c4a299c5c93dc0eb199214a";
            break;
            case 'despachado':
                $status = "5c423232c9a4c86123236dcd";
            break;
        }

        $ordersEmail = Order::where('order_status_id' , $status)->where('organization_id' , '60467fbd9caef512a5626fc9')->pluck('email');
    
        //Usuarios por cada orden
        $users = Account::whereIn('email' , $ordersEmail)->get(['_id' , 'email' , 'points', 'document_number','names']);     

        
        $orders = Order::where('order_status_id' , $status)->where('organization_id' , '60467fbd9caef512a5626fc9');
        $orderActual = isset($filters["date_from"]) ? 
                        $orders->whereBetween(
                            'created_at',
                            array(
                                \Carbon\Carbon::parse($filters['date_from']),
                                \Carbon\Carbon::parse($filters['date_to']),
                            )
                        )->get() :
                        $orders->get();
        
                        
        foreach ($orderActual as $order) {
            $codes = DiscountCodeMarinela::where('number_uses' , 1)->where('account_id' , $order->account_id)->get(['discount_code_template_id', 'discount_code_template_id ']);
            $totalOrders = 0;
            $fechaOrders = '';
            $productos = '';
            $totalProductos = null;

            $totalCodigosRedimidos = 0;
            $fechaOrders = $fechaOrders.' | '.$order->created_at;
            $totalOrders = $totalOrders + $order->amount;
            $productos = $productos.','.$order->items[0];
            $totalProductos =  $totalProductos +1;
            
            
           
            if(isset($orderActual))
            {
                foreach($codes as $code)
                {   

                    $template_id = $code->discount_code_template_id;

                    if(!$template_id)   
                    {
                        $discount= "discount_code_template_id ";
                        $template_id = $code->$discount;
                    }
                    $template = $templates[$template_id];
                    $totalCodigosRedimidos = $totalCodigosRedimidos +  $template['discount'];
                }

                foreach($users as $user)
                {  
                    $ordersUser= Order::where('email' , $user)
                                ->where('organization_id' , '60467fbd9caef512a5626fc9')
                                ->first(['amount']);
                    $totalOrdersUser =  $totalOrdersUser + $ordersUser->amount;

                    if($order->email === $user->email)
                    {
                        
                        $estado = ($totalOrders <= $totalCodigosRedimidos) ? "CORRECTO" : "Problema";
                        //Columnas
                        // echo 'N° de documento, Nombres, Correo, Total de puntos redimidos, Puntos al momento de la redención ,Puntos de la prenda, Cantidad de canjeos, Total de tolas las prendas canjeadas'; 

                        echo $user->document_number .','. $user->names .','. $user->email .','. $totalOrdersUser .','. $totalCodigosRedimidos. ',' . $order->account_points . ','. $totalOrders . ',' .$estado. ',' .$fechaOrders.','. $totalProductos.','. $productos. '</br>';
                    }
                }
            
                
            }else{
                echo $user->email . ', NO TIENE ORDER</br>';
            }
            
        }

    }
}
