<?php

namespace App\Mail;

use App\Event;
use App\Account;
use App\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;
use Spatie\IcalendarGenerator\PropertyTypes\TextPropertyType as TextPropertyType;

class ChangeUserPasswordEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $event;
    public $user;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user , $link, $event=null)
    {   
       $this->user = $user;
       $this->link = $link;
       $this->event = $event;
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {   
        
        $from = null; 
        if(isset($this->event))
        {

            $from = Organization::find($this->event->organizer_id);
            $from = $from->name;

        }else{

            $from = 'Evius';
        }
        return $this
            ->from(array_merge(config('mail.from'),['name'=>$from]))
            ->subject('Cambio de contraseña')
            ->markdown('rsvp.changepasswordOrganization');
        //return $this->view('vendor.mail.html.message');
    }
}