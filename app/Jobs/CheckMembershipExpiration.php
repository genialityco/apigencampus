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
        collect([PaymentPlan::find($this->paymentPlanId)]) : collect([PaymentPlan::find('672d302c0f5dd30d9f075eb2')]);

        foreach ($plans as $plan) {
            if ($plan) {
                $user = OrganizationUser::find($plan->organization_user_id);
                if ($user) {
                    $expirationDate = Carbon::parse($plan->date_until);
                    $now = Carbon::now();
                    $oneWeekLater = $now->copy()->addDays(7);

                    Log::info('Fechas para verificación de expiración', [
                        'now' => $now->toDateTimeString(),
                        'oneWeekLater' => $oneWeekLater->toDateTimeString(),
                        'expirationDate' => $expirationDate->toDateTimeString(),
                        'isBetween' => $expirationDate->isBetween($now, $oneWeekLater),
                    ]);

                    if ($expirationDate->isBetween($now, $oneWeekLater)) {
                        $notificationType = 'Proximidad de expiración';

                        Log::info('Enviando correo de proximidad de expiración', [
                            'user_email' => $user->properties['email'],
                            'expiration_date' => $plan->date_until,
                            'price' => $plan->price,
                        ]);

                        $mailable = new MembershipExpirationNotification($user, $plan, $notificationType);
                        Mail::to($user->properties['email'])->send($mailable);

                        dump('Correo enviado');

                    } elseif ($expirationDate->isPast()) {
                        $notificationType = 'Expiración';

                        Log::info('Enviando correo de expiración', [
                            'user_email' => $user->properties['email'],
                            'expiration_date' => $plan->date_until,
                            'price' => $plan->price,
                        ]);

                        $mailable = new MembershipExpirationNotification($user, $plan, $notificationType);
                        Mail::to($user->properties['email'])->send($mailable);
                    }
                } else {
                    Log::warning("No se encontró el usuario para organization_user_id: {$plan->organization_user_id}");
                }
            } else {
                Log::warning("No se encontró el plan con id: {$this->paymentPlanId}");
            }
        }
    }
}