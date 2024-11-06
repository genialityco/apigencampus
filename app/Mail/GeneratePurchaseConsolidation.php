<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneratePurchaseConsolidation extends Mailable
{
    use Queueable, SerializesModels;

    public $billing;
    public $clientData;
    public $dollarToday;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($billing, $clientData)
    {
        $this->billing = $billing;
        $this->clientData = $clientData;
	$this->dollarToday = $billing['billing']['dollarToday'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from("alerts@evius.co", "Evius")
            ->subject('Nueva compra en Evius')
            ->view('Mailers.PurchaseConsolidation');
    }
}
