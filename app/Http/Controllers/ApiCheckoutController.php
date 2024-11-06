<?php

namespace App\Http\Controllers;

use App\Event;
use App\Models\OrderItem;
use App\Order;
use App\Account;
use App\Organization;
use App\Pending;
use App\DiscountCode;
use App\DiscountCodeTemplate;
use App\Services\Order as OrderService;
use Auth;
use Illuminate\Http\Request;
use Log;
use App\Attendee;
use App\Events\OrderCompletedEvent;
use App\evaLib\Services\CodeServices;
use \Mail;
class ApiCheckoutController extends Controller
{
	/** 
	 * para revisar más documentación de los datos de la compra
	 * http://developers.payulatam.com/en/web_checkout/sandbox.html
	 * para exponer temporalmente mi localhost usar la app ngrok para que servicios
	 * o personas externas puedan acceder a los servidores en mi computador
	* Process purshase status from PayU via POST
	* (Rejected, accepted purshase)
	* Este endpoint es para llamarlo con un cron cada cierto tiempo
	*
	* @param Request $request
	* @return void
	*/
	public function paymentWebhookesponse(Request $request){
        Log::info('Pagando orden desde Payu');
		//reference_sale response_message_pol
        $data = $request->input();            
        Log::info(json_encode($data));

		$order_id = isset($data['reference_sale'])?$data['reference_sale']:"5fd90cacae5762445257dsaads";
		$order_status = isset($data ['response_message_pol'])?$data ['response_message_pol']:"APPROVED";
        $order = Order::find($order_id);
        // var_dump(json_encode($data));die;

		$order->data = json_encode($data);
        $order->save();
        
		$this->changeStatusOrder($order_id, $order_status,$data);

		return "listo";
	}

    /**
     * Change Order Status
     * (Rejected, Approved, Pending, Cancelled)
     *
     * @param Request $request
     * @return void
     */
    public function changeStatusOrder($order_id, $status, $data)
    {
        Log::info("Change Order: " . $order_id . ' Status: ' . $status);
		$order = Order::find($order_id);
		
        switch ($status) {
            case 'APPROVED':

                //Enviamos un mensaje al usuario si este estaba en otro estado y va  a pasar a estado completado.
                //Ademas de guardar el nuevo estado
                
                if ($order->order_status_id != config('attendize.order_complete')) {
                   
                    $order->order_status_id = config('attendize.order_complete');
                    $order->save();                                                         
                    Log::info("Completamos la orden");
                    $this->completeOrder($order_id , $data);
                    
                    if (config('attendize.send_email')) {
                        Log::info("Enviamos el correo");
                        //$this->dispatch(new SendOrderTickets($order));

                    }
                }
                break;
            case 'REJECTED':
                $order->order_status_id = config('attendize.order_rejected');
                break;
            case 'PENDING':
                $order->order_status_id = config('attendize.order_pending');
                break;
            case 'CANCELLED':
                $order->order_status_id = config('attendize.order_cancelled');
                break;
            case 'FAILED':
                $order->order_status_id = config('attendize.order_failed');
                break;
            case 'DECLINED':
                $order->order_status_id = config('attendize.order_rejected');
                break;
            case 'EXPIRED':
                $order->order_status_id = config('attendize.order_rejected');
                break;
            
        }
        Log::info('Borramos el cache de la orden: ' . $status);
        if ($status != 'PENDING') {
            //    Log::info('Borramos el cache de la orden: '.$order_reference);
        }
        $order->save();
        Log::info('Estado guardado: ' . $order_id . " order_reference: " . $order->orderStatus['name']);
        return $order;
    }

    /**
     * Complete an order
     *
     * @param $event_id
     * @param bool|true $return_json
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function completeOrder($order_reference, $dataPayu = null, $return_json = true)
    {
        //Si la orden ya fue creada entonces redirigimos al recibo con los ticketes, si no
        //vamos a crear la orden a partir del cache.
        //EL CACHE ES INDISPENSABLE EN ESTE CONTROLADOR
        
        try {

            $order = Order::find($order_reference);
                Log::info('completamos la orden: ' . $order_reference);   
                    //In case discount codes are entered for the purchase of courses, they will be browsed and the number of uses will be increased
                        foreach($order->discount_codes as $discount_code)
                        {   
                            foreach($order->items as $item) {                    
                                $event = Event::find($item);
                                $code =DiscountCode::where('code' , $discount_code)->first(); 
                                if(isset($code)){
                                    if($code->event_id == $event->_id){
                                        $code->number_uses =$code->number_uses + 1; 
                                        // $account = auth()->user();
                                        // $code->account_id = isset($account) ? auth()->user()->_id : "";                                         
                                        $code->save();     
                                                                           
                                    } 
                                }                            
                            }
                        }

                    switch($order->item_type){
                        case 'discountCode' : 
                            //Logica para agregar codigos
                            $this->generateCodes($order , $dataPayu);
                            
                        break;
                        // case 'points' : 
                        //     //Logica para completar una orden de tipo points
                        //     $this->validatePointOrder($order);                            
                        // break;
                        case 'event' :
                        default:

                            //In case discount codes are entered for the purchase of courses, they will be browsed and the number of uses will be increased
                            foreach($order->discount_codes as $discount_code)
                            {   
                                foreach($order->items as $item) {                   
                                    $event = Event::find($item);
                                    $code =DiscountCode::where('code' , $discount_code)->first(); 
                                    if(isset($code)){
                                        if(isset($code->organization_id))
                                        {                                               
                                            $code->number_uses =$code->number_uses + 1; 
                                            $code->save(); 

                                        }else if($code->event_id == $event->_id){
                                            $code->number_uses =$code->number_uses + 1; 
                                            $code->save();                                                                                   
                                        }
                                        
                                    }                            
                                }
                            }

                            /*
                            * Insert order items (for use in generating invoices)
                            */
                            foreach($order->items as $item) {                    
                                $event = Event::find($item);
                                $orderItem = new OrderItem();                                
                                $orderItem->quantity = 1;
                                $orderItem->order_id = $order->id;
                                $orderItem->unit_price = (isset($event->extra_config) && isset($event->extra_config["price"]))?$event->extra_config['price']:0;
                                $orderItem->unit_booking_fee = 0;
                                $orderItem->save();
                                $organization  = Organization::find($event->organizer_id);
                                
                                Mail::to($order->email)
                                ->queue(                                   
                                    new \App\Mail\BuyCourseMail($event , $organization->name)
                                ); 
                            }
                            //Lógica para agregar event_user

                            

                            $this->createAteendes($order);
                        break;
                    }

        } catch (Exception $e) {

            Log::error($e);
            // DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Whoops! There was a problem processing your order. Please try again.',
            ]);

        }
        // Queue up some tasks - Emails to be sent, PDFs etc.
        Log::info('Firing the event');
        event(new OrderCompletedEvent($order));
        /* Envío de correo */
        // $this->dispatch(new SendOrderTickets($order));

		return $order;

    }

    public function createAteendes($order){
        /*
        * Create the attendees
        */
        foreach($order->items as $item) {
                         

            $attendee = Attendee::updateOrCreate(
                ["account_id" => $order->account_id , "event_id" => $item],  
                [
                    "properties.names" => $order->account->names ,
                    "properties.email" => $order->account->email, 
                    "order_id" => $order->_id,
                    "rol_id" => config('attendize.payment_assistant')

                ]              
            );
            
            // $attendee->properties->names = $order->account->names;
            // $attendee->properties->email = $order->account->email;	

            // $attendee->event_id = $item;
            
            // $attendee->order_id = $order->id;
            // //$attendee->ticket_id = $attendee_details['ticket']['_id'];
            // $attendee->account_id = $order->account->_id;
            // $attendee->save();

            $user = Account::find($order->account->_id);
            $user->total_number_events = $user->total_number_events + 1;
            $user->save(); 
        }
    }

    /**
     * _generateCodes_: generates the discount codes when making the purchase
     */
    public function generateCodes($order, $dataPayu){

        $organization = '';

        $x=0;
        // Cycle while for each item of discount code template purchased
        while($x < count($order->items)) {           
            //  Generate random code for the discount code
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $input_length = strlen($permitted_chars);
                $random_string = '';
                for ($j = 0; $j < 8; $j++) {
                    $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
                    $random_string .= $random_character;
                } 
            
            $codeTemplate = DiscountCodeTemplate::find($order->items[$x]);
            
            $data['code'] = $random_string;
            $data['discount_code_template_id'] = $codeTemplate->_id;
            
            if(isset($codeTemplate->event_id))
            {   
                $data['event_id'] =  $codeTemplate->event_id;

            }else{
                $data['organization_id'] =  $codeTemplate->organization_id;
            }
            
            $resultCode = new DiscountCode($data);
            $repeated =  DiscountCode::where('code' , $random_string)->first();
            if(!isset($repeated))
            {                                             
                $resultCode->save();   
                $x++;                                    
            }   
            $codes = DiscountCode::where('discount_code_template_id' , $codeTemplate->_id)->first();
            $organization = $data;
            Mail::to($order->email)
            ->queue(
                new \App\Mail\DiscountCodeMail($resultCode , $order , $codeTemplate)
            );          
                    
        }
        
        if(isset($organization['organization_id']))
        {
            $organization = $organization['organization_id'];
        }else{
            $organization = Event::find($data['event_id']);
            $organization = $organization->organizer_id;
        }
        $organization = Organization::find($organization);
        //Este Correo muestra el detalle de payu y la orden
        Mail::to($order->email)
        ->queue(                                
            new \App\Mail\ConfirmationPayU($order, $dataPayu , $organization->name)
        );
    }



   public function paymentCompletedPayU(Request $request)
   {
	   //Petition to PayU
	   //Estado pendiente o en proceso de pago
	   $orders = Order::where('order_status_id', '5c4232c1477041612349941e')
		   ->orWhere('order_status_id', '5c4a299c5c93dc0eb199214a')
		   ->where('payment_gateway_id', '4')->get(); 

	   if (count($orders)) {
		   $apiLogin = config('attendize.payment_test') ? 'pRRXKOl8ikMmt9u' : 'mqDxv0NbTNaAUmb';
		   $apiKey = config('attendize.payment_test') ? '4Vj8eK4rloUd272L48hsrarnUA' : 'omF0uvbN3365dC2X4dtcjywbS7';
		   $url = config('attendize.payment_test') ? 'https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi' : 'https://api.payulatam.com/reports-api/4.0/service.cgi';
		   $data = [
			   'test' => config('attendize.payment_test'),
			   "language" => "en",
			   "command" => "ORDER_DETAIL_BY_REFERENCE_CODE",
			   "merchant" => [
				   "apiLogin" => $apiLogin,
				   "apiKey" => $apiKey,
			   ],
		   ];
		   $changes = [];
		   foreach ($orders as $order) {
			   $order_reference = $order->order_reference;
			   if ($order_reference) {
				   $data["details"] = ["referenceCode" => $order_reference];
				   $client = new Client();
				   $response = $client->request('POST', $url, [
					   'body' => json_encode($data),
					   'headers' => ['Content-Type' => 'application/json'],
				   ]);
				   $response = $response->getBody()->getContents();
				   $xml = simplexml_load_string($response);
				   $json = json_encode($xml);
				   $array = json_decode($json, true);
				   // var_dump($order->order_reference);die;
				   if (isset($array['result']['payload']['order'])) {
					   $status = isset($array['result']['payload']['order']['transactions'])
					   ? $array['result']['payload']['order']['transactions']['transaction']['transactionResponse']['state']
					   : end($array['result']['payload']['order'])['transactions']['transaction']['transactionResponse']['state'];
				   } else {
					   $status = null;
				   }

				   if (!is_null($status)) {
					   Log::info('order: ' . $order_reference . ' STATUSCURRENT: ' . $order->orderStatus['name'] . ' STATUSPAYU: ' . $status);
					   $response = $this->changeStatusOrder($order_reference, $status);
					   array_push($changes, ['order' => $order_reference,
						   'estatus_before' => $order->orderStatus['name'],
						   'status_PayU' => $status,
						   'new_status' => $response->orderStatus['name'],
					   ]);
				   }
			   }
		   }
	   }
	   return $changes;
   }

    /**
     * _validateFreeorder_: validates the order in case the purchase value is 0
     * 
     * @urlParam order_id required 
     * 
     */
    public function validateFreeorder($order_id){
        $order = Order::find($order_id);

        if($order->amount == 0 && $order->order_status_id != config('attendize.order_complete')){
            $order->order_status_id = config('attendize.order_complete');
            $order->save();
            $this->completeOrder($order->_id);
            return $order;
        }

        return response()->json([
            'error' => 'El valor es superior a $0',
        ]);        
    }

    /**
     * _validatePointOrder_ :validate orders of type points
     * @autenticathed
     * 
     * @urlParam order_id
     */
    public function validatePointOrder(Request $request, $order_id)
    {   
        $order = Order::find($order_id);

        $data = $request->input();
        //Obtenemos el usuario el cual está canjando sus puntos
        $user = Auth::user();
                  
        //Verificar que el usuario tenga puntos suficientes para más seguridad
        if($order->amount <= $user->points)
        {   
            //Actualizamos el estado de la orden a completado
            $order->order_status_id = config('attendize.order_pending');
            //Puntaje que tiene el usuario al momento de realizar la orden
            $order->account_points = isset($user->points) ? $user->points : "";
            $order->save();

            //Se descuentan los puntos a el usuario que ha utilizado
            $user->points = $user->points - $order->amount;
            $user->save();
            $status = 'pending_confirm'; 
            foreach($order->items as $item)
            {
                Mail::to($order->email)
                ->queue(
                    new \App\Mail\PointsMail($order , $user, $item , $status)
                ); 
            }           
            
            return $order;
        }
        //Actualizamos el estado de la orden a rechazado
        $order->order_status_id = config('attendize.order_failed');
        $order->save();

         return response()->json([
            'error' => 'El usuario no tiene puntos suficientes',
         ],403);
    }


     /**
     */
    public function validatePointOrderTest($order_id)
    {   
        $order = Order::find($order_id);

        //Obtenemos el usuario el cual está canjando sus puntos
        $user = Account::where('email' , $order->email)->first();
        
        //Verificar que el usuario tenga puntos suficientes para más seguridad
        // if($order->amount <= $user->points)
        // {   
            //Actualizamos el estado de la orden a completado 
            $order->order_status_id = config('attendize.order_pending');
            $order->save();

            //Se descuentan los puntos a el usuario que ha utilizado
            // $user->points = $user->points - $order->amount;
            // $user->save();
            
            $emailsAdmin =  Account::where("others_properties.role" , "admin")
            ->where("organization_ids" , $order->organization_id)
            ->get();
            
            //Se envia la información completa de la orden.           
            foreach($order->items as $item)
            {  
                Mail::to($order->email)
                ->queue(
                    new \App\Mail\PointsMail($order , $user, $item)
                ); 


                foreach($emailsAdmin as $emailAdmin)
                {
                    Mail::to($emailAdmin->email)
                    ->queue(
                        new \App\Mail\PointsMail($order , $user, $item)
                    );
                }
                     
            }
            return $order;
        // }

         return response()->json([
            'error' => 'El usuario no tiene puntos suficientes',
         ],403);
    }
}
