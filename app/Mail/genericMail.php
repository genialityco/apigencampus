<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class genericMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message = '';
    public $subject = '';
    public $emailUser = '';
    public $userName = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageContent)
    {
         $this->message   = $messageContent['message'] ;
         $this->subject   = $messageContent['subject'];
         $this->emailUser = $messageContent['email_user'];
         $this->userName  = $messageContent['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this
       // ->from('Formulariox')
        ->subject($this->subject)
        ->markdown('genericMail');
        //return $this->view('genericMail');
    }
}
