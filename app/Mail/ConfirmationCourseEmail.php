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

class ConfirmationCourseEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $event;
    public $organization;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($event , $user, $organization)
    {   
    
        $this->event = $event;
        $this->user = $user;
        $this->organization = $organization;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            
        return $this
        ->from($this->organization->email , $this->organization->displayName)
        ->subject('Confirmación de curso')
        ->markdown('rsvp.confirmationCourseEmail');
    }
}
