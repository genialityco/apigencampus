<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdministratorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $event;
    public $names;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $event, $names, $urlOrigin)
    {
        $link = '';
        $link = $urlOrigin . "/eventadmin" . "/" . $event->_id . "/assistants";
        $this->link = $link;
        $this->event = $event;
        $this->names = $names;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alerts@evius.co', "Invitacion administrador")
            ->subject('Invitacion administrador')
            ->markdown('rsvp.administratorInvitation');
    }
}
