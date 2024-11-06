<?php

namespace App\Mail;


use App\Account;
use App\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {                          
        $this->user = $user;    
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        
        return $this
            ->subject('Registro exitoso')
            ->markdown('Mailers.UserRegistration');
        //return $this->view('vendor.mail.html.message');
    }
}