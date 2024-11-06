<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class OrganizationUserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $html;
    public $subject;
    public $organization;
    public $link;
    public $client_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $organization, $client_name, $link)
    {
      $this->email = $email;
      $this->subject = $subject;
      $this->organization = $organization;
      $this->client_name = $client_name;
      $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      Log::debug("It will build the email");
      $subject = $this->subject;

      $organizationEmail = !empty($this->organization->email) ? $this->organization->email : config('mail.from.address');
      $organizationName = $this->organization->name . " | GEN.iality ";

      Log::debug("send email from " . $organizationEmail . " as " . $organizationName . " because: " . $subject . " ... " . $this->client_name);

      return $this
          ->from($organizationEmail, $organizationName)
          ->subject($subject)
          ->with(['client_name' => $this->client_name])
          ->markdown('rsvp.organizationInvitation');
    }
}
