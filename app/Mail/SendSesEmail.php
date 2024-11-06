<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSesEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logo_evius = 'images/logo.png';
        $this->logo = url($logo_evius);

        $foo = $this->withSwiftMessage(function ($message) {            
            $headers = $message->getHeaders();       
            // Log::info('$headers: '.$headers);         
            $headers->addTextHeader('X-SES-CONFIGURATION-SET', 'ConfigurationSetSendEmail');
        });

        Log::info('$foo '.$foo);
       

        return $this
            ->subject($this->subject)
            ->markdown('rsvp.rsvpinvitation');
            
        //return $this->view('vendor.mail.html.message');
    }
}
