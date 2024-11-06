<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;

use App\Account;
use App\Organization;
use App\OrganizationUser;
use App\Event;
use App\Certification;
use App\evaLib\Services\MMasivoService;
use Exception;
use Mail;
use Log;

class SendEmailForCertificationExpirationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $enable_daily;
    private $enable_weekly;

    /**
     * Create a new job instance.
     * 
     * @param $is_for_week - if true, then we expend that it is called each week
     *
     * @return void
     */
    public function __construct(bool $enable_daily = false, bool $enable_weekly = false)
    {
        // This will control the emailing, well, the task running
        $this->enable_daily = $enable_daily;
        $this->enable_weekly = $enable_weekly;
    }

    /**
     * Send an a email to address, subject and html passed.
     */
    public function sendMail($address, $subject, $html) {
        // Prepate stuffs to send an email
        $mail = new \App\Mail\SimpleEmail($address, $subject, $html);
        Log::debug("will send email to $address with: $html");
        Mail::to($address)->queue($mail);
    }

    public function sendNofiticationToUser(Organization $organization, Account $user, OrganizationUser $organizationUser, $reports) {
        $certifiecationsForTomorrow = $reports["tomorrow"];
        $certifiecationsForThisWeek = $reports["week"];
        $certifiecationsForThisMonth = $reports["month"];

        Log::debug("call sendNofiticationToUser");

        // Send emails if the admin wanna send emails
        if (is_array($organization["enable_notification_providers"]) && in_array("email", $organization["enable_notification_providers"])) {
            $address = !empty($organization["email"]) ? $organization["email"] : config('mail.from.address');
            $mail = new \App\Mail\CertificationExpiration(
                "Notificación de ".$organization["name"],
                $user,
                $organization,
                $certifiecationsForTomorrow,
                $certifiecationsForThisWeek,
                $certifiecationsForThisMonth,
            );
            Log::debug("will send email to $address");
            Mail::to($address)->queue($mail);
        }

        // Send SMSs if the admin wanna send SMSs
        if (is_array($organization["enable_notification_providers"]) && in_array("sms", $organization["enable_notification_providers"])) {
            // If this organization memeber has no phone, any SMS will be sent
            if (isset($organizationUser["properties"]) && isset($organizationUser["properties"]["phone"])) {
                $phone = $organizationUser["properties"]["phone"];
                $phone = str_replace("+", "", $phone);
                Log::debug("will SMS to ".$phone." with certification info");

                $sms = "Hola, ".$report["user_name"].".";
                $sms .= " Tu certificado de ".$report["certification_name"];
                $sms .= " vence en ".$report["diff_days"]." días. Att: GEN.iality";

                // For tomorrow
                foreach($certifiecationsForTomorrow as $report) {
                    try {
                        MMasivoService::SendSms(["to" => [$phone], "text" => $sms]);
                    } catch (Exception $e) {
                        Log::error("Cannot SMS to ".$phone." because: " . $e->getMessage());
                    }
                }

                // For this week
                foreach($certifiecationsForThisWeek as $report) {
                    try {
                        MMasivoService::SendSms(["to" => [$phone], "text" => $sms]);
                    } catch (Exception $e) {
                        Log::error("Cannot SMS to ".$phone." because: " . $e->getMessage());
                    }
                }

                // For this month
                foreach($certifiecationsForThisMonth as $report) {
                    try {
                        MMasivoService::SendSms(["to" => [$phone], "text" => $sms]);
                    } catch (Exception $e) {
                        Log::error("Cannot SMS to ".$phone." because: " . $e->getMessage());
                    }
                }
            }
        }
    }

    public function sendNofiticationToAdmin(Organization $organization, $reports) {
        $certifiecationsForTomorrow = $reports["tomorrow"];
        $certifiecationsForThisWeek = $reports["week"];
        $certifiecationsForThisMonth = $reports["month"];

        Log::debug("call sendNofiticationToAdmin");

        if (is_array($organization["enable_notification_providers"]) && in_array("email", $organization["enable_notification_providers"])) {}

        $address = !empty($organization["email"]) ? $organization["email"] : config('mail.from.address');
        $mail = new \App\Mail\GeneralCertificationExpiration(
            "Notificación de ".$organization["name"],
            $organization,
            $certifiecationsForTomorrow,
            $certifiecationsForThisWeek,
            $certifiecationsForThisMonth,
        );
        Log::debug("will send email to $address");
        Mail::to($address)->queue($mail);
    }

    public function processOrganization(Organization $organization) {
        // We have to iterate for each organization user, because we need this
        // for send less messages whether we group those.
        $organizationUsers = OrganizationUser::where("organization_id", $organization["_id"])->get();

        // Get all the organization events. We are going to iterate under events.
        $events = Event::where("organizer_id", $organization["_id"])->get();

        $now = Carbon::now();

        $userCertificationsExpireTomorrow = [];
        $userCertificationsExpireInThisWeek = [];
        $userCertificationsExpireInThisMonth = [];

        foreach ($events as $event) {
            foreach ($organizationUsers as $organizationUser) {
                $user = $organizationUser->user;
                // Get its certifications
                $certifications = Certification::where("event_id", $event["_id"])
                    ->where("user_id", $user["_id"])
                    ->get();
                
                // Analyze its certifications
                $certifiecationsForTomorrow = [];
                $certifiecationsForThisWeek = [];
                $certifiecationsForThisMonth = [];

                foreach ($certifications as $certification) {
                    // Certification that is not success is ignored
                    if (!$certification["success"]) {
                        Log::debug("ignore ".$event["name"]." because success");
                        continue;
                    }

                    // Take the date
                    $approved_until_date = Carbon::parse($certification["approved_until_date"]);
                    Log::debug("until date: " . $approved_until_date->toDateTimeString());

                    // calc the diff in days
                    $diff_days = $approved_until_date->diffInDays($now);

                    $payload = [
                        "certification_name" => $event["name"],
                        "approved_until_date" => $approved_until_date,
                        "user_name" => $user["names"],
                        "diff_days" => $diff_days,
                    ];
                    $generalPayload = array_merge([], $payload);
                    // $generalPayload["user_name"] = $user["names"];

                    // $generalPayload["diff_days"] = $diff_days;

                    if ($approved_until_date->isSameDay($now) && $this->enable_daily) {
                        Log::debug("same day");
                        array_push($certifiecationsForTomorrow, $payload);
                        array_push($userCertificationsExpireTomorrow, $generalPayload);
                    } else if ($approved_until_date->isAfter($now) && $this->enable_weekly) {
                        // The date is being until
                        Log::debug("tomorrow in " . $diff_days . " days");
                        if ($diff_days < 7) {
                            // This week
                            array_push($certifiecationsForThisWeek, $payload);
                            array_push($userCertificationsExpireInThisWeek, $generalPayload);
                        } else if ($diff_days < 30) {
                            // This month
                            array_push($certifiecationsForThisMonth, $payload);
                            array_push($userCertificationsExpireInThisMonth, $generalPayload);
                        }
                    } else {
                        // The date is expired
                        Log::debug("yesterday in " . $diff_days . " days, certification ID:".$certification["_id"]);
                    }
                }

                $isThereToNotify = count($certifiecationsForTomorrow) > 0 || count($certifiecationsForThisWeek) > 0 || count($certifiecationsForThisMonth) > 0;

                // TODO: Implement the next comment
                // Check if the organization has settings for the email sending
                if ($isThereToNotify) {
                    $this->sendNofiticationToUser(
                        $organization,
                        $user,
                        $organizationUser,
                        [
                            "tomorrow" => $certifiecationsForTomorrow,
                            "week" => $certifiecationsForThisWeek,
                            "month" => $certifiecationsForThisMonth,
                        ],
                    );
                }
            }
        }

        // Let me to notify the admin that this report
        // Notify to the admin
        $admin = Account::find($organization["author"]);
        if ($admin) {
            $admin_email = $admin["email"];
            Log::debug("admin_email = ".$admin_email);
        } else {
            Log::error("I cannot believe that this organization has no author :c");
        }


        // Notify to the admin?
        $isThereToNotify = count($userCertificationsExpireTomorrow) > 0 || count($userCertificationsExpireInThisWeek) > 0 || count($userCertificationsExpireInThisMonth) > 0;
        if ($isThereToNotify) {
            $this->sendNofiticationToAdmin(
                $organization,
                [
                    "tomorrow" => $userCertificationsExpireTomorrow,
                    "week" => $userCertificationsExpireInThisWeek,
                    "month" => $userCertificationsExpireInThisMonth,
                ]
            );
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Will run a job: SendEmailForCertificationExpirationJob");
        $human_phone = config('app.human.sms_checker');
        if (isset($human_phone)) {
            MMasivoService::SendSms([
                "to" => [$human_phone],
                "text" => "Se va a enviar notificaciones masivas de estados de certificados",
            ]);
        } else {
            Log::debug("There is no phone to notify that the notification process has started. Don't worry");
        }
        // Get all the organizations
        $organizations = Organization::all();

        // For each organization, we take the event
        Log::debug("-----------------------------------------------------------");
        foreach ($organizations as $organization) {
            $this->processOrganization($organization);
        }
        Log::debug("-----------------------------------------------------------");
    }
}
