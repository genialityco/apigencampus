<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MembershipExpirationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plan;
    public $notificationType;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $plan, $notificationType)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->notificationType = $notificationType;
    }

    /**
     * Build the message.
     */
    public function build()
    {
         $expirationDate = Carbon::parse($this->plan->date_until)->format('d-m-Y hh:mm:ss');
        $subject = $this->notificationType === 'Proximidad de expiración' 
            ? 'Tu membresía está próxima a vencer' . $expirationDate
            : 'Tu membresía ha vencido' . $expirationDate;
    
        Log::info('Enviando correo de notificación de membresía', [
            'user_email' => $this->user->properties['email'],
            'expiration_date' => $this->plan->date_until,
            'price' => $this->plan->price,
            'notificationType' => $this->notificationType,
            'subject' => $subject ,
        ]);
    
        return $this->subject($subject)
                    ->view('emails.membership_expiration_notification');
    }    
}
