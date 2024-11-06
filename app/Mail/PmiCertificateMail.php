<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PmiCertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $link;
    public $image_header;
    public $image_footer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
        $this->link = "https://drive.google.com/drive/folders/1UZUTmQwdVsqFh_NgwB-jWfAaA4dvTzdy?usp=sharing";
        $this->image_header = "https://storage.googleapis.com/eviusauthdev.appspot.com/evius/events/epdDwS77Dyc3Xic2Aiq6G1ysoLoxFzRhgY7m1LuX.jpg";
        $this->image_footer = "https://storage.googleapis.com/eviusauthdev.appspot.com/evius/events/VqSGAHJJuqhBoFopX4O60c2iUY1ByZe9Ynv8MTpH.jpg";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('rsvp.pmiCertificate')
            ->subject('PMI Bogotá - Descarga tu certificado')
            ->from('alert@evius.co', 'PMI Bogotá')
            ->attachData($this->pdf->output(), 'certificado.pdf');
    }
}
