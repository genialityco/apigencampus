<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Log;

class UserCreatedAndAddedToEventMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $event;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $user, $event)
    {
      $this->email = $email;
      $this->user = $user;
      $this->event = $event;
      $this->subject = "Participante de: " . $event->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      Log::debug("email: $this->email of: $this->html");
      return $this
          ->from(config('mail.from.address'), "Email")
          ->subject($this->subject)
          ->markdown('Mailers.UserCreatedAndAddedToEventMail');
    }
}
