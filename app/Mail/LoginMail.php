<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Event;
use App\Account;
use App\Organization;



class LoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $event;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($linkLogin, $event_id=null, $email)
    {   
        $event= '';
        
        $user = Account::where('email', $email)->first();

        if(isset($event_id))
        {
            $event = Event::find($event_id);
        }

        $this->link = $linkLogin;
        $this->event = $event;
        $this->user = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $from = !empty($this->event->organizer_id) ? Organization::find($this->event->organizer_id)->name : "Evius Event ";
        $from = isset($from) ? $from : 'Evius';


        return $this
            ->from(array_merge(config('mail.from'),['name'=>$from]))
            ->subject('Login Link')
            ->markdown('rsvp.onetimelogin');
    }
}
