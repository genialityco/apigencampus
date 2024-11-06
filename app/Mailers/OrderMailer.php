<?php

namespace App\Mailers;

use App\Models\Order;
use App\Event;
use App\Attendee;
use App\Services\Order as OrderService;
use PDF;
use Log;
use Mail;
use QRCode;

class OrderMailer
{
    public function sendOrderNotification(Order $order)
    {
        $orderService = new OrderService($order->amount, $order->organiser_booking_fee, $order->event);
        $orderService->calculateFinalCosts();

        $data = [
            'order' => $order,
            'orderService' => $orderService
        ];

        Mail::send('Emails.OrderNotification', $data, function ($message) use ($order) {
            $message->to($order->account->email);
            $message->subject('New order received on the event ' . $order->event->title . ' [' . $order->order_reference . ']');
        });

    }

    public function sendOrderTickets(Order $order)
    {
        // Se cargan los datos que se van a utilizar en el PDF
        $date = new \DateTime();
        $today =  $date->format('d-m-Y');
        $logo_evius = 'images/logo.png';
        $event = Event::findOrFail($order->event_id);
        $stages = $event->event_stages;
        $eventusers = Attendee::where('order_id', $order->id)->get();
        
        //$location = $event["location"]["FormattedAddress"];
        $location = "";
        $orderService = new OrderService($order->amount, $order->organiser_booking_fee, $order->event);
        
        $orderService->calculateFinalCosts();

        Log::info("Sending ticket to: " . $order->email);
        $data = [
            'order' => $order,
            'orderService' => $orderService,
            'logo' => $logo_evius,
        ];

        foreach ($eventusers as $eventuser) { 

            /* Se genera el QR Code */
            ob_start(); 
            $qr = QrCode::text($eventuser->id)->setSize(8)->png();
            $qr = base64_encode($qr);
            $page = ob_get_contents();
            ob_end_clean();
            $type = "png";
            $qr = 'data:image/' . $type . ';base64,' . base64_encode($page);
            $eventuser->qr = $qr;
            // $eventuser->qr = 'qr';


            /* Si es un evento con etapas continuas */
            if (isset($event->stage_continue)) { 
                $stage_id = isset($eventuser->ticket->stage_id) ? $eventuser->ticket->stage_id : null;
            }
        }
        /* Si es un evento con etapas continuas */
        if (isset($event->stage_continue)) { 
            foreach ($stages as $stage) { 
                if ($stage["stage_id"] == $stage_id) {
                    $stage_name = $stage["title"];
                    break;
                }
            }
        }    
        /* Si es un evento con etapas continuas */
        $stage = isset($stage_name) ? $stage_name : "";

        /* Creación del PDF */
        //	if(isset($eventuser->properties["names"])){
         $pdf = PDF::loadview('pdf_bookingConfirmed', compact('event','eventusers','order','location','today','stage'));
         $pdf->setPaper('legal','portrait');

        // Envío del email
        Mail::send('Mailers.TicketMailer.SendOrderTickets', $data, function ($message) use ($order, $pdf) {
            $message->to($order->email);
            $message->subject('Tus tickets para el evento '.$order->event->name);
            $message->attachData(
                $pdf->download(), 'Tickets Evento '. $order->event->name.'.pdf'
            );
        });

	    // Envío del email 
            Mail::send('Mailers.TicketMailer.SendOrderTickets', $data, function ($message) use ($order, $pdf) {
                $message->to('juan.lopez@mocionsoft.com');
		//$message->to('felipe.martinez@mocionsoft.com');
                if($order->amount == 0){
                    $message->subject('Tiquete Gratuito '.$order->event->name);
                }else{
                    $message->subject('Tiquete Comprado '.$order->event->name);
                }
                $message->attachData(
                    $pdf->download(), 'Tickets Evento '. $order->event->name.'.pdf'
                );
            });
	}
//    }

}
