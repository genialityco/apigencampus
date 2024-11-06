<?php
/**
 *
 */
namespace App\evaLib\Services;

use App\Events\OrderCompletedEvent;
use App\Event;
use App\Attendee;
use App\Account;
use App\Order;
use App\Models\EventStats;
use App\Models\Affiliate;
use App\Models\Ticket;
use Carbon\Carbon;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Services\Order as OrderService;
use Omnipay;
use Log;
use Auth;
use Mail;

/**
 * This class contains methods of the Orders model
 */
class OrdersServices
{



    /**
     * Cancel an Order specified
     *
     * @param Request       $request    Data referring to the order that you want to cancel
     * @param String        $order_id  The id of the order that you want to cancel
     * @return Status       If order was cancel or not
     */
    public static function cancelAnOrder(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);

        $refund_order = ($request->get('refund_order') === 'on') ? true : false;
        $refund_type = $request->get('refund_type');
        $refund_amount = round(floatval($request->get('refund_amount')), 2);
        $attendees = $request->get('attendees');
        $error_message = false;

        if ($refund_order && $order->payment_gateway->can_refund) {
            if (!$order->transaction_id) {
                $error_message = trans("Controllers.order_cant_be_refunded");
            }

            if ($order->is_refunded) {
                $error_message = trans("Controllers.order_already_refunded");
            } elseif ($order->organiser_amount == 0) {
                $error_message = trans("Controllers.nothing_to_refund");
            } elseif ($refund_type !== 'full' && $refund_amount > round(($order->organiser_amount - $order->amount_refunded),
                    2)
            ) {
                $error_message = trans("Controllers.maximum_refund_amount", ["money"=>(money($order->organiser_amount - $order->amount_refunded,
                        $order->event->currency))]);
            }
            if (!$error_message) {
                try {
                    $gateway = Omnipay::create($order->payment_gateway->name);

                    $gateway->initialize($order->account->getGateway($order->payment_gateway->id)->config);

                    if ($refund_type === 'full') { /* Full refund */
                        $refund_amount = $order->organiser_amount - $order->amount_refunded;
                    }

                    $request = $gateway->refund([
                        'transactionReference' => $order->transaction_id,
                        'amount'               => $refund_amount,
                        'refundApplicationFee' => floatval($order->booking_fee) > 0 ? true : false,
                    ]);

                    $response = $request->send();

                    if ($response->isSuccessful()) {
                        /* Update the event sales volume*/
                        $order->event->decrement('sales_volume', $refund_amount);
                        $order->amount_refunded = round(($order->amount_refunded + $refund_amount), 2);

                        if (($order->organiser_amount - $order->amount_refunded) == 0) {
                            $order->is_refunded = 1;
                            $order->order_status_id = config('attendize.order_refunded');
                        } else {
                            $order->is_partially_refunded = 1;
                            $order->order_status_id = config('attendize.order_partially_refunded');
                        }
                    } else {
                        $error_message = $response->getMessage();
                    }

                    $order->save();
                } catch (\Exeption $e) {
                    Log::error($e);
                    $error_message = trans("Controllers.refund_exception");
                }
            }

            if ($error_message) {
                return response()->json([
                    'status'  => 'success',
                    'message' => $error_message,
                ]);
            }
        }

        /*
         * Cancel the attendees
         */
        if ($attendees) {
            foreach ($attendees as $attendee_id) {
                $attendee = Attendee::where('id', '=', $attendee_id)->first();
                $attendee->ticket->decrement('quantity_sold');
                $attendee->ticket->decrement('sales_volume', $attendee->ticket->price);
                $order->event->decrement('sales_volume', $attendee->ticket->price);
                $order->decrement('amount', $attendee->ticket->price);
                $attendee->is_cancelled = 1;
                $attendee->save();

                $eventStats = EventStats::where('event_id', $attendee->event_id)->where('date', $attendee->created_at->format('Y-m-d'))->first();
                if($eventStats){
                    $eventStats->decrement('tickets_sold',  1);
                    $eventStats->decrement('sales_volume',  $attendee->ticket->price);
                }
            }
        }
        if(!$refund_amount && !$attendees)
            $msg = trans("Controllers.nothing_to_do");
        else {
            if($attendees && $refund_order)
                $msg = trans("Controllers.successfully_refunded_and_cancelled");
            else if($refund_order)
                $msg = trans("Controllers.successfully_refunded_order");
            else if($attendees)
                $msg = trans("Controllers.successfully_cancelled_attendees");
        }

        return (object) [
            "status" => 'succes',
            "message" => 'ok',
        ];
    }

    
    
    /**  
     * Create a new Order in storage.
     * 
     * @param $ticket_order
     * @param $request_data
     * @param $event
     * @param $fields
     * @param $attendee_increment
     * @param $order
     * @return void
     */
    public static function createAnOrder($ticket_order, $request_data, $event, $fields)
    {
       
        $attendee_increment = 1;
        
        try {
            
            // if (isset($ticket_order['transaction_id'])) {
            //     $order->transaction_id = $ticket_order['transaction_id'][0];
            // }
            // if ($ticket_order['order_requires_payment'] && !isset($request_data['pay_offline'])) {
            //     $order->payment_gateway_id = $ticket_order['payment_gateway']->id;
            // }

            $order = new Order((Array)$request_data);
            $order->first_name = strip_tags($request_data['order_first_name']);
            $order->last_name = strip_tags($request_data['order_last_name']);
            $order->email = $request_data['order_email'];
            $order->items = $ticket_order['items'];
            $order->order_status_id = config('attendize.order_awaiting_payment');
            $order->amount = $ticket_order['order_total'];
            $order->item_type = strip_tags($request_data['item_type']);
            $order->discount_codes = isset($request_data['discount_codes']) ? $request_data['discount_codes'] : [] ;
            $order->oganization_id = $request_data['oganization_id'];


            $order->properties = $request_data['properties'];
            $order->organiser_booking_fee = $ticket_order['organiser_booking_fee'];
            $order->discount = 0.00;
            $order->account_id = $ticket_order ['account_id'];
            $order->event_id = $ticket_order['event_id'];
            $order->is_payment_received = isset($request_data['pay_offline']) ? 0 : 1;
            // $order->session_id = $ticket_order['transaction_data']['session_id'];
            // Calculating grand total including taxx   
            //$orderService = new OrderService($ticket_order['order_total'], $ticket_order['total_booking_fee'], $event);
            //$orderService->calculateFinalCosts();
            //$order->taxamt = $orderService->getTaxAmount();
            
            // $order->url = $transaction_data['url_redirect'];
            $order->save();

            /*
             * Update the event sales volume
             */
            //$event->increment('sales_volume', (int)$orderService->getGrandTotal());
            //$event->increment('organiser_fees_volume', (int)$order->organiser_booking_fee);
            
            /*
            * Update affiliates stats stats
            */
            // if ($ticket_order['affiliate_referral']) {  
            //     $affiliate = Affiliate::where('name', '=', $ticket_order['affiliate_referral'])
            //     ->where('event_id', '=', $event_id)->first();
            //     $affiliate->increment('sales_volume', $order->amount + $order->organiser_booking_fee);
            //     $affiliate->increment('tickets_sold', $ticket_order['total_ticket_quantity']);
            // }
            
            /*
            * Update the event stats
            */
            // $event_stats = EventStats::updateOrCreate([
            //     'event_id' => $event->id,
            //     'date'     => DB::raw('CURRENT_DATE'),
            //     ]);

            // $event_stats->increment('tickets_sold', $ticket_order['total_ticket_quantity']);

            // if ($ticket_order['order_requires_payment']) {
            //     $event_stats->increment('sales_volume', $order->amount);
            //     $event_stats->increment('organiser_fees_volume', $order->organiser_booking_fee);
            // }


        } catch (Exception $e) {

            Log::error($e);
            // DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Whoops! There was a problem processing your order. Please try again.'
            ]);

        }
        //save the order to the database
        // DB::commit();
        //forget the order in the session

        session()->forget('ticket_order_' . isset($event->id));

        // Queue up some tasks - Emails to be sent, PDFs etc.
        Log::info('Firing the event');

        event(new OrderCompletedEvent($order));

        $order= Order::find($order->_id);
        return $order;
    }

    /**  
     * Update an Order in storage.
     * 
     * @param $ticket_order
     * @param $request_data
     * @param $event
     * @param $fields
     * @param $attendee_increment
     * @param $order
     * @return void
     */
    public static function updateAnOrder($order, $status)
    {
        switch ($status) {
            case 'APPROVED':
                //Enviamos un mensaje al usuario si este estaba en otro estado y va  a pasar a estado completado.
                //Ademas de guardar el nuevo estado
                if($order->order_status_id != config('attendize.order_complete')){
                    $order->order_status_id= config('attendize.order_complete');                
                }
                break;
            case 'REJECTED':
                $order->order_status_id= config('attendize.order_rejected');
                $user = Account::find($order->account_id);                

                if($order->item_type == 'points')
                {   
                    foreach($order->items as $item)
                    { 
                        Mail::to($order->email)
                        ->queue(
                            new \App\Mail\PointsMail($order , $user, $item , $status)
                        );  
                    }                  
                }                     
                break;
            case 'PENDING':
                $order->order_status_id= config('attendize.order_pending');
                break;
            case 'CANCELLED':
                $order->order_status_id= config('attendize.order_cancelled');
                break;
            case 'FAILED':
                $order->order_status_id= config('attendize.order_failed');
                break;
            case 'VALID':
                $user = Account::find($order->account_id);
                $order->order_status_id = config('attendize.order_valid');
                
                $emailsAdmin =  Account::where("others_properties.role" , "admin")
                ->where("organization_ids" , $order->organization_id)
                ->get();

                if($order->item_type == 'points')
                {
                    foreach($order->items as $item)
                    {  
                        Mail::to($order->email)
                        ->queue(
                            new \App\Mail\PointsMail($order , $user, $item , $status)
                        );    
                        
                        foreach($emailsAdmin as $emailAdmin)
                        {
                            Mail::to($emailAdmin->email)
                            ->queue(
                                new \App\Mail\PointsMail($order , $user, $item , $status)
                            );
                        }
                    }
                }

                break;
        }
        $order->save();

        // return $order;
        return (object) [
            "status" => 'succes',
            "message" => 'ok',
        ];

    }

    /**
     * Change Order Status
     * (Rejected, Approved, Pending, Cancelled)
     *
     * @param Request $request
     * @return void
     */
    public function changeStatusOrder($order_reference, $status)
    {
        Log::info("Change Order: " . $order_reference . ' Status: ' . $status);
        $order = Order::where('order_reference', '=', $order_reference)->first();
        switch ($status) {
            case 'APPROVED':
                //Enviamos un mensaje al usuario si este estaba en otro estado y va  a pasar a estado completado.
                //Ademas de guardar el nuevo estado
                if ($order->order_status_id != config('attendize.order_complete')) {
                    $order->order_status_id = config('attendize.order_complete');
                    Log::info("Completamos la orden");
                    $this->completeOrder($order_reference);
                    if (config('attendize.send_email')) {
                        Log::info("Enviamos el correo");
                        $this->dispatch(new SendOrderTickets($order));
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
        Log::info('Estado guardado: ' . $order_reference . " order_reference: " . $order->orderStatus['name']);
        return $order;
    }



    /**
     * 
     *  
     */ 
    public static function addAttendee($attendee_details, $order_id, $event_id, $request_data)
    {   
        $event = Event::findOrFail($event_id);
        $order = Order::findOrFail($order_id);
        $fields = $event->user_properties;
        $attendee_increment = 1;

        /*  
            * Update ticket's quantity sold
            */
        $ticket = Ticket::findOrFail($attendee_details['ticket_id']);
        // $ticket = (Array)$ticket;
        /*
            * Update some ticket info
            */
        $ticket->increment('quantity_sold', $attendee_details['qty']);
        $ticket->increment('sales_volume', ($ticket['price'] * $attendee_details['qty']));
        $ticket->increment('organiser_fees_volume', ($ticket['organiser_booking_fee'] * $attendee_details['qty']));

        /*
            * Insert order items (for use in generating invoices)
            */
        $orderItem = new OrderItem();
        $orderItem->title = $ticket['title'];
        $orderItem->quantity = $attendee_details['qty'];
        $orderItem->order_id = $order_id;
        $orderItem->unit_price = $ticket['price'];
        $orderItem->unit_booking_fee = $ticket['booking_fee'] + $ticket['organiser_booking_fee'];
        $orderItem->save();

        /*
            * Create the attendees
            */
        for ($i = 0; $i < $attendee_details['qty']; $i++) {

            $attendee = new Attendee();
            $attendee->properties = (object) [];

            foreach ($fields as $field) {
                if (!$field['name']) {
                    continue;
                }

                $attendee->properties->{$field['name']} = $request_data["tiket_holder_" . str_replace(" ", "_", $field['name'])][$i][$ticket['id']];
            }
            $attendee->event_id = $event_id;
            $attendee->order_id = $order_id;
            $attendee->ticket_id = $ticket['id'];
            $attendee->account_id = $event->account->id;
            $attendee->reference_index = $attendee_increment;
            $attendee->save();

            /*
                * Save the attendee's questions
                */
            // foreach ($attendee_details['ticket']->questions as $question) {

            //     $ticket_answer = isset($ticket_questions[$attendee_details['ticket']->id][$i][$question->id]) ? $ticket_questions[$attendee_details['ticket']->id][$i][$question->id] : null;

            //     if (is_null($ticket_answer)) {
            //         continue;
            //     }

            //     /*
            //      * If there are multiple answers to a question then join them with a comma
            //      * and treat them as a single answer.
            //      */
            //     $ticket_answer = is_array($ticket_answer) ? implode(', ', $ticket_answer) : $ticket_answer;

            //     if (!empty($ticket_answer)) {
            //         QuestionAnswer::create([
            //             'answer_text' => $ticket_answer,
            //             'attendee_id' => $attendee->id,
            //             'event_id' => $event->id,
            //             'account_id' => $event->account->id,
            //             'question_id' => $question->id,
            //         ]);

            //     }
            // }

            /* Keep track of total number of attendees */
            $attendee_increment++;
        }
        $order->save();

        return (object) [
            "status" => 'succes',
            "message" => 'ok',
        ];

    }

    /**
     * Decrease a ticket created
     *
     * @param [type] $ticket_id
     * @return void
     */
    public static function deleteAttendee($order_id, $attendee_id)
    {
        $order = Order::findOrFail($order_id);
        $attendee = Attendee::findOrFail($attendee_id);
        $ticket_id = $attendee->ticket_id;
        $ticket = Ticket::find($ticket_id);
        /*
         * Decreases the amount of tickets
         */
        
        $ticket->increment('quantity_sold', -1);
        $ticket->increment('sales_volume', -$ticket->price);
        /**
         * Find Attendee
         */
        /**
         * Decreases value in stats
         */
        $event_stats = EventStats::updateOrCreate([
            'event_id' => $ticket->event_id,
            'date' => (Carbon::now())->toDateString(),
        ]);
        $event_stats->increment('tickets_cancel', 1);

        /**
         * Delete attendize ticket
         */
        $attendee->delete();
        $order->save();
        return (object) [
            "status" => 'succes',
            "message" => 'ok',
        ];
    }
}
