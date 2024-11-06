<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NogalMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
	$this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('alerts@evius.co', 'Fundación Científica LHA');
	$mail->subject('Segundo Congreso Internacional de Medicina Integrativa 2023');

	$pdf = $this->pdf;
        $mail->attachData($pdf->download(), "certificado.pdf");

        return $mail->view('rsvp.clubNogal');
    }
}
