<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Account;

class AdditionalExpired extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $start_date;
    public $end_date;
    public $amount;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($additional, string $subject)
    {
        $user = Account::findOrFail($additional->user_id);
        $this->name = $user->names;
        $this->start_date = $additional->start_date;
        $this->end_date = $additional->end_date;
        $this->amount = $additional->amount;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('no_reply@evius.co');
        $mail->subject($this->subject);
        return $this->markdown('rsvp.additional_expired');
    }
}
