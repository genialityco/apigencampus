<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoMocion extends Mailable
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
    public function __construct($email, $html, $subject)
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
      $subject = $this->subject;

      return $this
          ->from("alerts@evius.co", "Quest")
          ->subject($subject)
          ->markdown('Mailers.CorreoMocion');
    }
}
