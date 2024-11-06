<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Log;

class SimpleEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $html;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $html)
    {
      $this->email = $email;
      $this->html = $html;
      $this->subject = $subject;
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
          ->markdown('Mailers.SimpleEmail');
    }
}
