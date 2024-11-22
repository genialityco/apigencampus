<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\OrganizationUser;
use App\PaymentPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembershipExpirationNotification;
use Carbon\Carbon;

class CheckMembershipExpiration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $paymentPlanId;

    public function __construct($paymentPlanId = null)
    {
        $this->paymentPlanId = $paymentPlanId;
    }

    public function handle()
    {
        $plans = $this->paymentPlanId ? 
        collect([PaymentPlan::find($this->paymentPlanId)]) : PaymentPlan::skip(651)->take(300)->get();
        $emailsSent = 0;
    
        foreach ($plans as $plan) {
            if ($emailsSent >= 300) {
                break; 
            }
            if ($plan) {
                $user = OrganizationUser::find($plan->organization_user_id);
                if ($user && !empty($user->properties['email'])) {
                    $expirationDate = Carbon::parse($plan->date_until);
                    $now = Carbon::now();
                    $oneWeekLater = $now->copy()->addDays(7);
    
                    if ($expirationDate->isBetween($now, $oneWeekLater)) {
                        $notificationType = 'Proximidad de expiración';
                        $authLink = $this->generateAuthLink($user->properties['email'], $plan->id);
    
                        $mailable = new MembershipExpirationNotification($user, $plan, $notificationType, $authLink);
                        Mail::to($user->properties['email'])->send($mailable);
                        $emailsSent++; 
                        
                        Log::info("Correo enviado: Proximidad de expiración", [
                            'email' => $user->properties['email'],
                            'plan_id' => $plan->id,
                            'tipo_notificacion' => $notificationType
                        ]);
                    } elseif ($expirationDate->isPast()) {
                        $notificationType = 'Expiración';
                        $authLink = $this->generateAuthLink($user->properties['email'], $plan->id);
    
                        $mailable = new MembershipExpirationNotification($user, $plan, $notificationType, $authLink);
                        Mail::to($user->properties['email'])->send($mailable);
                        $emailsSent++; 

                        Log::info("Correo enviado: Expiración", [
                            'email' => $user->properties['email'],
                            'plan_id' => $plan->id,
                            'tipo_notificacion' => $notificationType
                        ]);
                    }
                }
            }
        }
    }
    
    private function generateAuthLink($email, $event_id = null)
    {
        $auth = resolve('Kreait\Firebase\Auth');
        $urlOrigin = 'https://app.geniality.com.co'; 
    
        $continueUrl = $urlOrigin . "/loginWithCode?email=" . urlencode($email);
    
        if ($event_id) {
            $continueUrl .= "&organization=63f552d916065937427b3b02";
        }
    
        return $auth->getSignInWithEmailLink(
            $email,
            [
                "url" => $continueUrl,
            ]
        );
    }
    
    
}