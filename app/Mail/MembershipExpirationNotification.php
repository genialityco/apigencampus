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
    public $authLink;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $plan, $notificationType, $authLink)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->notificationType = $notificationType;
        $this->authLink = $authLink;
    }

    /**
     * Build the message.
     */
    public function build()
    {
         $expirationDate = Carbon::parse($this->plan->date_until)->format('d-m-Y hh:mm:ss');
        $subject = $this->notificationType === 'Proximidad de expiración' 
            ? 'Tu membresía está próxima a vencer'
            : 'Tu membresía ha vencido';
    
        // Log::info('Enviando correo de notificación de membresía', [
        //     'user_email' => $this->user->properties['email'],
        //     'expiration_date' => $this->plan->date_until,
        //     'price' => $this->plan->price,
        //     'notificationType' => $this->notificationType,
        //     'subject' => $subject ,
        //     'authLink' => $this->authLink,
        // ]);
    
        return $this->from('alert@geniality.com.co', 'Endocampus ACE')
                    ->subject($subject)
                    ->view('emails.membership_expiration_notification')
                    ->with([
                        'authLink' => $this->authLink,
                    ]);
    }    
}
