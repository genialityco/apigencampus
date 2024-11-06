<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificationExpiration extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $organization;
    public $tomorrow_expiration;
    public $week_expiration;
    public $month_expiration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $user, $organization, $tomorrow_expiration, $week_expiration, $month_expiration)
    {
        $this->subject = $subject . " | GEN.iality ";
        $this->user = $user;
        $this->organization = $organization;
        $this->tomorrow_expiration = $tomorrow_expiration;
        $this->week_expiration = $week_expiration;
        $this->month_expiration = $month_expiration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $organizationEmail = !empty($this->organization->email) ? $this->organization->email : config('mail.from.address');
        return $this
            ->from($organizationEmail, "Servicio de notificación de certificación de GEN.iality")
            ->subject($this->subject)
            ->markdown('Mailers.CertificationExpiration');
    }
}
