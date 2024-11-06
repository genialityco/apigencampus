<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Account;
use App\Attendee;
use App\DiscountCode;
use App\Event;
use App\DiscountCodeTemplate;
use App\Http\Resources\OrderResource;
use App\evaLib\Services\OrdersServices;
use App\evaLib\Services\UserEventService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ticket;
use Auth;
use Validator;
use App\evaLib\Services\FilterQuery;
use Mail;

/**
 * @group Orders
 * 
 * The purpose of this end point is to store all the information of a user's payment orders 
 */
class ApiOrdersController extends Controller
{
    /**
     * _index_: list of all orders  
     * 
     * @response{
     *  "data": [
     *      {
     *          "_id": "5c5209c9f33bd41d17312774",
     *          "_token": "Iac0K5a4SOBSZGSZfQUFH3kAJhZGMpC8eeT7mAok",
     *          "payment_gateway_id": "3",
     *          "first_name": "Larissa",
     *          "last_name": "Wiley",
     *          "email": "felipe.martinez+100@mocionsoft.com",
     *          "order_status_id": "5c4a291e5c93dc0eb1992149",
     *          "amount": 100000,
     *          "booking_fee": 0,
     *          "organiser_booking_fee": 0,
     *          "discount": 0,
     *          "account_id": "5c51df3f342254001128a122",
     *          "event_id": "5c51e165342254001a3b1982",
     *          "is_payment_received": 1,
     *          "session_id": 171953,
     *          "order_reference": "ticket_order_1548880329",
     *          "taxamt": "0.00",
     *          "url": "https:\/\/test.placetopay.com\/redirection\/session\/171953\/918bed652065302921a260c87320b2b3",
     *          "updated_at": "2019-02-21 00:33:59",
     *          "created_at": "2019-01-30 20:32:09",
     *          "tickets": [],
     *          "order_status": {
     *              "_id": "5c4a291e5c93dc0eb1992149",
     *              "id": "6",
     *              "name": "Rechazado"
     *          }
     *      },
     *      {
     *          "_id": "5c52104df33bd41d187dc7a3",
     *          "_token": "Iac0K5a4SOBSZGSZfQUFH3kAJhZGMpC8eeT7mAok",
     *          "payment_gateway_id": "3",
     *          "first_name": "Larissa",
     *          "last_name": "Wiley",
     *          "email": "felipe.martinez+100@mocionsoft.com",
     *          "order_status_id": "5c4a291e5c93dc0eb1992149",
     *          "amount": 100000,
     *          "booking_fee": 0,
     *          "organiser_booking_fee": 0,
     *          "discount": 0,
     *          "account_id": "5c51df3f342254001128a122",
     *          "event_id": "5c51e165342254001a3b1982",
     *          "is_payment_received": 1,
     *          "session_id": 171957,
     *          "order_reference": "ticket_order_1548881997",
     *          "taxamt": "0.00",
     *          "url": "https:\/\/test.placetopay.com\/redirection\/session\/171957\/8081ccf8aa0bb8d0eadb223854bdae8e",
     *          "updated_at": "2019-02-21 00:34:02",
     *          "created_at": "2019-01-30 20:59:57",
     *          "tickets": [],
     *          "order_status": {
     *              "_id": "5c4a291e5c93dc0eb1992149",
     *              "id": "6",
     *              "name": "Rechazado"
     *          }
     *    
     *      }
     * ]}
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return json_encode(["Error" => "Can't query all order of the platform maximun scope is by event"]);
        // return OrderResource::collection(
        //     Order::paginate(config('app.page_size'))
        // );
    }

    /**
     * _store_: create new order
     *
     * @bodyParam items array required the items are the id of the event in case of buying a course or the id of the discount code template in case of buying a code Example:  ["5ea23acbd74d5c4b360ddde2"]
     * @bodyParam account_id string required id of the user making the purchase Example: 5f450fb3d4267837bb128102
     * @bodyParam amount integer required total order value Example: 10000
     * @bodyParam item_type string required item type discountCode or event Example: discountCode
     * @bodyParam discount_codes array disount code 
     * @bodyParam properties object the properties are the additional data required for billing such as: **person_type, document_type, email, document_number, telephone, date_birth, adress** Example: {"person_type" : "Natural","document_type" : "CC", "email" : "correo@correo.com" , document_number" : "1014305626","telephone" : "30058744512","date_birth" : "2021-01-13","adress" : "Calle falsa 123", "user_first_name" : "Pepe" ,"user_last_name" : "Lepu"} 
     * 
     * @param request $request
     * @param string $event_id
     * @param bool|true $return_json
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $return_json = true)
    {
        $request_data = $request->json()->all();
        
        $ids  =  $request_data['items'];

        $event = '';

        switch ($request_data['item_type']) 
        {
            case 'discountCode':
                $codeTemplate = DiscountCodeTemplate::findOrFail($ids[0]);

                //Since the purchase of the codes will be taken into account in the orders. 
                //These will not always be for an event but also for an organization so the event_id may or may not come
                if(isset($codeTemplate->event_id)){
                    $event = Event::findOrFail($codeTemplate->event_id);            
                }
            break;
            case 'event':
                $event = Event::findOrFail($ids[0]);
            break;
        }
        
        $account = Account::findOrFail($request_data['account_id']);
        $fields = isset($event->user_properties) ? $event->user_properties : '';
        $booking_fee = 0;
        $organiser_booking_fee = 0;
        $activeAccountPaymentGateway = 3;
        $paymentGateway = 3;
        $order_expires_time = Carbon::now()->addMinutes(1000000);
        $order_total =  $request_data['amount'];
        $tickets = [];
        $total_ticket_quantity = 0;

        $ticket_order = [
            // 'validation_rules' => $validation_rules,
            // 'validation_messages' => $validation_messages,
            'event_id' => isset($event->id) ? $event->id : '' ,
            'tickets' => $tickets,
            'items' => $ids,
            'total_ticket_quantity' => $total_ticket_quantity,
            'order_started' => time(),
            'expires' => $order_expires_time,
            // 'reserved_tickets_id' => $reservedTickets->id,
            'order_total' => $order_total,
            'booking_fee' => $booking_fee,
            'organiser_booking_fee' => $organiser_booking_fee,
            'total_booking_fee' => $booking_fee + $organiser_booking_fee,
            'order_requires_payment' => (ceil($order_total) == 0) ? false : true,
            'account_id' => $account->_id,
            // 'affiliate_referral' => Cookie::get('affiliate_' . $event_id),
            'account_payment_gateway' => $activeAccountPaymentGateway,
            'payment_gateway' => $paymentGateway,
        ];
        // var_dump($account->others_properties);die;
        $request_data['order_first_name'] = $account->names;
        $request_data['order_last_name'] =  "";
        $request_data['order_email'] =  $account->email;


        $request_data['properties'] =  isset($request_data['properties']) ? $request_data['properties'] : [];
        // $request_data['properties'] = isset($account->others_properties) ? $account->others_properties : [];
        $request_data['oganization_id'] = isset($request_data['oganization_id']) ? $request_data['oganization_id'] : "";
        
        $result = OrdersServices::createAnOrder($ticket_order, $request_data, $event, $fields);

        return $result;

    }

    /**
     * _destroy_: remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * _show_: view order-specific information
     * 
     * @urlParam order required order id Example: 5fbd84e345611e292f04ab92
     * 
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(String $orders_id)
    {    
        $order = Order::findOrFail($orders_id);
        return new OrderResource($order);
    }
    
    /**
     * _index_: display all the Orders of an user 
     * 
     * @urlParam user_id required Example: 5f450fb3d4267837bb128102
     * 
     * @return \Illuminate\Http\Response
     */
    public function ordersByUsers(Request $request, String $user_id)
    {
        $user = User::findOrFail($user_id);
        $email = $user->email;

        return OrderResource::collection(
            Order::where("email", $email)
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _index:_ display all the Orders of an user logueado
     * 
     * @authenticated
     * 
     * @return \Illuminate\Http\Response
     */
    public function meOrders(Request $request)
    {
        $user = Auth::user();

        return OrderResource::collection(
            Order::where("account_id", $user->id)
                ->paginate(config('app.page_size'))
        );
    }

    /**
     * _cancelOrder_: cancels an order
     * 
     * @urlParam order_id required 5fbd84e345611e292f04ab92
     * 
     * @param Request $request
     * @param $order_id
     * @return mixed
     */
    public function cancelOrder(Request $request, String $order_id)
    {
        $rules = [
            'refund_amount' => ['numeric'],
        ];
        $messages = [
            'refund_amount.integer' => trans("Controllers.refund_only_numbers_error"),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json( 
                [
                'status'   => 'error',
                'messages' => $validator->messages()->toArray(),
                ]
            );
        }

        try {

            $result = OrdersServices::cancelAnOrder($request, $order_id);
            $response->additional(['status' => $result->status, 'message' => $result->message]);

        } catch (\Exception $e) {

            $response = response()->json((object) ["message" => $e->getMessage()], 500);
        }

        return $response;
    }

    /**
     * _update_: update the specified resource in storage.
     *
     * @bodyParam items array  id of the event from which the purchase is made Example:  ["5ea23acbd74d5c4b360ddde2"]
     * @bodyParam account_id string  id of the user making the purchase Example: 5f450fb3d4267837bb128102
     * @bodyParam amount integer  total order value Example: 10000
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $order_reference)
    {
        $status = $request['status'];
        $order = Order::where('_id', '=', $order_reference)->first();

        $result = OrdersServices::updateAnOrder($order, $status);

        $response = (['status' => $result->status, 'message' => $result->message]);
        
        return $response;

    }


    /**
     * Show the order details page
     *
     * @param Request $request
     * @param $order_reference
     * @return \Illuminate\View\View
     */
    public function showDetailsOrder(Request $request, $order_reference)
    {
        $order = Order::where('order_reference', '=', $order_reference)->first();

        $orderService = new OrderService($order->amount, $order->organiser_booking_fee, $order->event);
        $orderService->calculateFinalCosts();
        
        return OrderResource::collection($order);
    }
    /**
     * Delete Attendee
     *
     * @param [type] $ticket_id
     * @param [type] $order_id
     * @return void
     */
    public function deleteAttendee($order_id, $attendee_id){
        $result = OrdersServices::deleteAttendee($order_id, $attendee_id);
        $response = (['status' => $result->status, 'message' => $result->message]);
        return $response;
    }

    /**
     * 
     *  
     */
    public function storeAttendee(Request $request, String $event_id, String $order_id)
    { 
        $data = $request->json()->all();
        $attendee_details = $data['attendee_details'];
        $request_data = $data['request_data'];
        $result = OrdersServices::addAttendee($attendee_details, $order_id, $event_id, $request_data);
        $response = (['status' => $result->status, 'message' => $result->message]);
        return $response;
    }

    /**
     * 
     *  
     */
    public function createUserAndAddtoEvent(Request $request, string $event_id, String $order_id)
    {
        // return $request;

        
        try {

            //las propiedades dinamicas del usuario se estan migrando de una propiedad directa
            //a estar dentro de un hijo llamado properties
            $eventUserData = $request->json()->all();

            $event = Event::find($event_id);
            $user_properties = $event->user_properties;
            $userData = $request->json()->all();

            if (isset($eventUserData['properties'])) {
                $userData = $eventUserData['properties'];
            }

            /* Se le agrega el id de la orden en la variable eventUserData
            si esta viene si no, no se agrega nada. */

            if (isset($order_id)) {
                $eventUserData['order_id'] = $order_id;
            }

            $result = UserEventService::importUserEvent($event, $eventUserData, $userData);
            $response = new OrderResource($result->data);
            $response->additional(['status' => $result->status, 'message' => $result->message]);
        } catch (\Exception $e) {

            $response = response()->json((object) ["message" => $e->getMessage()], 500);
        }
        return $response;
    }

    /**
     * _indexByOrganization_: display all the Orders of an organization
     *
     * @urlParam organization_id required 
     */
    public function indexByOrganization(String $organization_id)
    {
        $query = Order::where("organization_id", $organization_id)->get();

        return OrderResource::collection($query);

    }

    /**
     * _indexByEvent_: display all the orders of an event
     * 
     * @urlParam event event_id required Example: 5ea23acbd74d5c4b360ddde2
     * @queryParam filtered optional filter parameters Example: [{"field":"items","value":"6116b372396b8f5e864f033a"}]
     * 
     */
    public function indexByEvent(Request $request,$event_id, FilterQuery $filterQuery)
    {
        $query = Order::where("event_id", $event_id);
        $input = $request->all();
        $results = $filterQuery::addDynamicQueryFiltersFromUrl($query, $input);
        return OrderResource::collection($results);

    }

    /**
     * _createPreOrder_: Create an Pre-order for an event
     * 
     * @urlParam order required Example: 62ab83018579d9446f0e84f5
     * @authenticated
     * @bodyParam space_available integer required Available number of tickets
     */
    public function createPreOrder(Request $request, $event)
    {
        $request->validate([
            'space_available' => 'required|numeric'
        ]);
        $data = $request->json()->all();
        $user = Auth::user();

	// validate that it does not exceed the amount of 100 tickets
	$tickets = Attendee::where('event_id', $event)->where('properties.names', 'like', '%TICKET%' )->where('properties.codeRedeem', null)->get();
	if(count($tickets) + $data['space_available'] > 100) {
	  $ticketsAvailable = 100 - count($tickets);
	  return response()->json(['message' => "ticket limit exceeded, $ticketsAvailable  tickets available"], 403);
	}

	// Assign pre-order to user
        $eventUser = Attendee::where('event_id', $event)->where('account_id', $user->_id)->first();
        $newOrder = [
            'event_user_id' => $eventUser->_id,
            'event_id' => $event,
            'space_available' => $data['space_available'],
            'status' => 'INCOMPLETE'
        ];
        $order = Order::create($newOrder);

        // User can have multiple orders
        $oldOrder = $eventUser->orders;
        $ordersByUser = [];
        if (isset($oldOrder)) {
            foreach ($oldOrder as $ord) {
                array_push($ordersByUser, ['order_id' => $ord['order_id'], 'status' => $ord['status']]);
            }
        }
        array_push($ordersByUser, ['order_id' => $order->_id, 'status' => $order->status]);
        $eventUser->orders = $ordersByUser;
        $eventUser->save();

        return compact("order");
    }
    
    /**
     * _updateOrderAndAddTickets_: Update an order for an event and generate tickets
     * 
     * @urlParam order required Example: 62ab83018579d9446f0e84f5
     * @authenticated
     * @bodyParam status string required Order status when payment is made Example: COMPLETE
     */
    public function updateOrderAndAddTickets(Request $request, $order)
    {
        $request->validate([
            'status' => 'required|string'
        ]);
        
        $data = $request->json()->all();
        $user = Auth::user();

        if ($data['status'] !== 'COMPLETE') {
            return response()->json(['message' => 'Invalid Order'], 401);
        }
        
        $order = Order::findOrFail($order);
        
        $order->status = 'COMPLETE';
        $order->save();

        // // actualizar estado de la orden en el event user
        $eventUser = Attendee::findOrFail($order->event_user_id);
        $ordersByUser = [];
        foreach ($eventUser->orders as $ord) {
            if($ord['order_id'] === $order->_id) {
                $ord['status'] = $order->status;
            }
            array_push($ordersByUser, $ord);
        }
        $eventUser->orders = $ordersByUser;
        $eventUser->save();
        
        // generate tickets
        // tickets are attendees
        for ($i=1; $i <= $order->space_available; $i++) {
            try {
            $newTicket = Attendee::create([
                'properties' => [
                    "names" => "TICKET $i",
                ],
                'event_id' => $order->event_id,
                'order_id' => $order->_id
            ]);

            } catch (\Exception $e) {
                return response()->json((object) ["message" => $e->getMessage()], 400);
                
            }
        }

        $event = Event::findOrFail($order->event_id);
        $attendees = Attendee::where('event_id', $event->_id)->where('order_id', $order->_id)->get();

        Mail::to($user->email)
        ->send(
            new \App\Mail\SendQRs($eventUser, $event, $attendees, $order)
        );
        
        return compact("order");
    }

    public function createOrderToPartner(Request $request, $event_id)
    {
        $request->validate([
            'code' => 'required|exists:discount_codes,code|string'
        ]);

        $user = Auth::user();
        $data = $request->json()->all();

        $code = DiscountCode::where("code" , $data['code'])->first();
        $discountCodeTemplate = DiscountCodeTemplate::where('_id', $code->discount_code_template_id)->first();

        if($code->number_uses >= $discountCodeTemplate->use_limit){
            return abort(403 , 'El código ya se uso');
        }

        //Creation of order in which the redemption of the code is registered
        $event = Event::findOrFail($event_id);
        $eventUser = Attendee::where('event_id', $event_id)->where('account_id', $user->_id)->first();
        $newOrder = [
            'event_user_id' => $eventUser->_id,
            'event_id' => $event_id,
            'code_id' => $code->_id,
            'discount_code_template_id' => $discountCodeTemplate->_id,
            'space_available' => $code->space_available,
            'status' => 'COMPLETE'
        ];
        $order = Order::create($newOrder);

        // Assign order to event user
        // User can have multiple orders
        $oldOrder = $eventUser->orders;
        $ordersByUser = [];
        if (isset($oldOrder)) {
            foreach ($oldOrder as $ord) {
                array_push($ordersByUser, ['order_id' => $ord['order_id'], 'status' => $ord['status']]);
            }
        }
        array_push($ordersByUser, ['order_id' => $order->_id, 'status' => $order->status]);
        $eventUser->orders = $ordersByUser;
        $eventUser->save();

        // create ticket
        $newTicket = Attendee::create([
            'properties' => [
                "names" => "TICKET 1",
		"codeRedeem" => $code->code
            ],
            'event_id' => $order->event_id,
            'order_id' => $order->_id
        ]);


        Mail::to($user->email)
        ->send(
            new \App\Mail\SendQRs($eventUser, $event, $attendees=[$newTicket], $order)
        );

        $code->number_uses +=1;
        $code->save();

        return compact("order");
    }

    public function getTicketsAvailable($event)
    {
	$tickets = Attendee::where('event_id', $event)->where('properties.names', 'like', '%TICKET%' )->where('properties.codeRedeem', null)->get();
	$ticketsAvailable = 100 - count($tickets);

	return response()->json(['tickets_available' => $ticketsAvailable, 'total_tickets' => count($tickets)]);
    }


    public function alternativeTicket(Request $request, $order)
    {
        $request->validate([
            'status' => 'required|string'
        ]);
        
        $data = $request->json()->all();

        if ($data['status'] !== 'COMPLETE') {
            return response()->json(['message' => 'Invalid Order'], 401);
        }
        
        $order = Order::findOrFail($order);
        
        $order->status = 'COMPLETE';
        $order->save();

        // actualizar estado de la orden en el event user
        $eventUser = Attendee::findOrFail($order->event_user_id);
        $ordersByUser = [];
        foreach ($eventUser->orders as $ord) {
            if($ord['order_id'] === $order->_id) {
                $ord['status'] = $order->status;
            }
            array_push($ordersByUser, $ord);
        }
        $eventUser->orders = $ordersByUser;
        $eventUser->save();
        
        // generate tickets
        // tickets are attendees
        for ($i=1; $i <= $order->space_available; $i++) {
            try {
            $newTicket = Attendee::create([
                'properties' => [
                    "names" => "TICKET $i",
                ],
                'event_id' => $order->event_id,
                'order_id' => $order->_id
            ]);

            } catch (\Exception $e) {
                return response()->json((object) ["message" => $e->getMessage()], 400);
                
            }
        }

        $event = Event::findOrFail($order->event_id);
        $attendees = Attendee::where('event_id', $event->_id)->where('order_id', $order->_id)->get();

        Mail::to($eventUser->properties['email'])
        ->send(
            new \App\Mail\SendQRs($eventUser, $event, $attendees, $order)
        );
        
        return compact("order");
    }
}
