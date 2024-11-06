<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Account;
use App\Payment;

class PlanPurchase extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $identification;
    public $phone;
    public $email;
    public $address;
    public $date;
    public $end_date;
    public $base_value;
    public $tax;
    public $discount;
    public $method_name;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($billing, string $subject)
    {
        $user = Account::findOrFail($billing['user_id']);
        $save = isset($billing->billing) ? $billing->billing['save'] : $billing["billing"]["save"];
        //dd("save", $save);
        if ($save) {
            $payment = Payment::findOrFail($billing['payment_id']);
            //$this->name = $payment->address['name'] . $payment->address['last_name'];
            $this->name = $user->names;
            $this->identification = $payment->address['identification']['value'];
            $this->phone = $payment->address['phone_number'];
            $this->address = $payment->address['address_line_1'];
            $this->method_name = $payment['method_name'];
        }else{
            //$this->name = $billing['billing']['payment_method']['address']['name'] . $billing['billing']['payment_method']['address']['last_name'];
            $this->name = $user->names;
            $this->identification =  $billing['billing']['payment_method']['address']['identification']['value'];
            $this->phone = $billing['billing']['payment_method']['address']['phone_number'];
            $this->address = $billing['billing']['payment_method']['address']['address_line_1'];
            $this->method_name = $billing['billing']['payment_method']['method_name'];
        }

        $this->email = $user->email;
        $this->date = $billing['billing']['start_date'];
        $this->end_date = $billing['billing']['end_date'];
        $this->base_value = $billing['billing']['base_value'] . '$';
        $this->tax = $billing['billing']['tax'];
        $this->discount = isset($billing['billing']['total_discount'])? $billing['billing']['total_discount'].'$' : 'No aplica';
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('no_reply@evius.co');
        $mail->subject($this->subject);
        return $mail->markdown('rsvp.plan_purchase');
    }
}
