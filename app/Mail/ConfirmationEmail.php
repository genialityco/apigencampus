<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Event;
use App\Attendee;
use App\Account;
use App\User;

class ConfirmationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user_name;
    public $user_email;
    public $user_id;
    public $logo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct(
        Account $user)
    {
        $this->user_name = $user->displayName;
        $this->user_id = $user->id;
        $this->user_email = $user->email;
        
        $this->subject   = "[Confirmación de Cuenta - ".$user->displayName."]";
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

        return $this
        ->from("apps@mocionsoft.com")
        ->subject($this->subject)
        ->markdown('confirmationEmail');
    }
}
