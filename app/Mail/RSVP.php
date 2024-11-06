<?php

namespace App\Mail;

use App\Event;
use App\Account;
use App\Models\Ticket;
use App\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;
use App\evaLib\Services\GoogleFiles;
use QRCode;
use Log;
use App\MessageUser;
use App;
use GuzzleHttp\Client;
use Spatie\IcalendarGenerator\PropertyTypes\TextPropertyType as TextPropertyType;

class RSVP extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $eventUser_name;
    public $eventuser_id;
    public $eventuser_lan;
    public $password;
    public $email;
    public $event;
    public $eventUser;
    public $image;
    public $link;
    public $linkUnsubscribe;
    public $image_footer;
    public $message;
    public $footer;
    public $ticket_title;
    public $organization_picture;
    public $subject;
    public $urlconfirmacion;
    public $image_header;
    public $type;
    public $include_date;
    public $include_ical_calendar;
    public $content_header;
    public $event_location;
    public $logo;
    public $ical = "";
    public $date_time_from;
    public $date_time_to;
    public $messageLog;
    public $qr;
    public $include_login_button;
    public $urlOrigin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $message, Event $event, $eventUser, string $image = null, $footer = null, string $subject = null, string $urlOrigin, $image_header = null, $content_header = null, $image_footer = null, $include_date = null, $data, $messageLog)
    {

        $locale = isset($event->language) ? $event->language : 'es';
        App::setLocale($locale);


        $auth = resolve('Kreait\Firebase\Auth');
        $this->auth = $auth;
        $event_location = null;
        if (!empty($event["location"]["FormattedAddress"])) {
            $event_location = $event["location"]["FormattedAddress"];
        }
        if (!empty($event->alt_image)) {
            $image = $event->alt_image;
        }
        $type = null;
        $email = isset($eventUser["properties"]["email"]) ? $eventUser["properties"]["email"] : $eventUser["email"];

        if (is_null($email)) {
            $email = $eventUser->properties["email"];
        }

        $organization_picture = !empty($event->styles["event_image"]) && strpos($event->styles["event_image"], 'htt') === 0 ? $event->styles["event_image"] : null;

        if (!$eventUser->anonymus) {
            $accountPassword = Account::find($eventUser->account_id);
            $password = isset($accountPassword->password) ?  $accountPassword->password : $email;
            // lets encrypt !
            $pass = self::encryptdata($password);
            $this->password = $password;
        }

        $eventUser_name = isset($eventUser["properties"]["names"]) ? $eventUser["properties"]["names"] : $eventUser["properties"]["displayName"];

        $ticket_title = null;

        if ($eventUser->ticket) {
            $ticket_title = $eventUser->ticket->title;
        }

        $link = '';
        $this->urlOrigin = isset($urlOrigin) ? $urlOrigin : config('app.front_url');
        if (!$eventUser->anonymous) {

            try {
                // Admin SDK API to generate the sign in with email link.
                $firebasaUser = $auth->getUserByEmail($email);
                if ($firebasaUser->emailVerified) {

                    $link = $auth->getSignInWithEmailLink(
                        $email,
                        [
                            "url" => $this->urlOrigin . "/loginWithCode?email=" . urlencode($email) . "&event_id=" . $event->_id,
                        ]
                    );
                } else {
                    $link = $auth->getEmailVerificationLink(
                        $email,
                        [
                            "url" => $this->urlOrigin . "/loginWithCode?email=" . urlencode($email) . "&event_id=" . $event->_id,
                        ]
                    );
                }
            } catch (\Exception $e) {
                Log::error('Error this: ' . $e->getMessage());
            }
        } else {
            $link = $this->urlOrigin . "/landing/" . $event->_id . "/evento&email=" . $email . "&names=" . $eventUser_name;
        }


        // $link = config('app.api_evius') . "/singinwithemail?email=" . urlencode($email) . '&innerpath=' . $event->_id . "&pass=" . urlencode($pass);

        $content_header = "<div style='text-align: center;font-size: 115%'>" . $content_header . "</div>";
        //$message = "<div style='margin-bottom:-100px;text-align: center;font-size: 115%'>" . $message   . "</div>";
        $linkUnsubscribe = config('app.api_evius') . '/events/' . $event->_id . '/eventusers/' . $eventUser["_id"] . '/unsubscribe';

        $destination  = config('app.front_url');

        $this->organization_picture = $organization_picture;
        $this->type = $type;

        $this->image_header = $image_header;
        $this->content_header = $content_header;
        $this->image_footer = isset($event->styles['banner_footer_email']) ? $event->styles['banner_footer_email'] : $image_footer;
        $this->include_date = $include_date;
        $this->include_date = $include_date;
        $this->link = $link;
        $this->linkUnsubscribe = $linkUnsubscribe;
        $this->event = $event;
        $this->event_location = $event_location;
        $this->eventUser = $eventUser;
        $this->image = ($image) ? $image : null;
        $this->message = $message;
        $this->footer = $footer;
        $this->ticket_title = $ticket_title;
        $this->eventUser_name = $eventUser_name;
        $this->email = $email;
        $this->include_ical_calendar = $data['include_ical_calendar'];
        $this->include_login_button = $data['include_login_button'];
        $this->messageLog = $messageLog;
        $this->urlconfirmacion = $destination . '/landing/' . $event->_id;


        //Definición de horario de inicio y fin del evento.Se le agrega -05:00 para que quede hora Colombia
        $date_time_from = (isset($eventUser->ticket) && isset($eventUser->ticket->activities) && isset($eventUser->ticket->activities->datetime_start)) ? \Carbon\Carbon::parse($eventUser->ticket->activities->datetime_start . "-05:00") : \Carbon\Carbon::parse($event->datetime_from . "-05:00");
        $date_time_to = (isset($eventUser->ticket) && isset($eventUser->ticket->activities) && isset($eventUser->ticket->activities->datetime_end)) ? \Carbon\Carbon::parse($eventUser->ticket->activities->datetime_end . "-05:00") : \Carbon\Carbon::parse($event->datetime_to . "-05:00");
        $date_time_from = $date_time_from->setTimezone("UTC");
        $date_time_to = $date_time_to->setTimezone("UTC");

        $this->date_time_from = \Carbon\Carbon::parse($event->datetime_from . "-05:00");
        $this->date_time_to = \Carbon\Carbon::parse($event->datetime_to . "-05:00");

        if (!$subject) {
            "Invitación a " . $event->name . "";
        }

        $this->subject = $subject;
        $descripcion = "<div><a href='{$link}'>Evento Virtual,  ir a la plataforma virtual del evento  </a></div>";
        $descripcion .= ($event->registration_message) ? $event->registration_message : $event->description;

        //Crear un ICAL que es un formato para agregar a calendarios y eso se adjunta al correo
        $this->ical = iCalCalendar::create($event->name)
            ->appendProperty(
                TextPropertyType::create('METHOD', "REQUEST")
            )
            ->appendProperty(
                TextPropertyType::create('URL', $this->urlconfirmacion)
            )
            ->event(
                iCalEvent::create($event->name)
                    ->startsAt($date_time_from)
                    ->endsAt($date_time_to)
                    ->description($descripcion)
                    ->uniqueIdentifier($event->_id)
                    ->createdAt(new \DateTime())
                    ->address(($event->address) ? $event->address : $this->urlconfirmacion)
                    // ->addressName(($event->address) ? $event->address : "Virtual en web evius.co")
                    //->coordinates(51.2343, 4.4287)
                    ->organizer(config('mail.from.address'), $event->organizer->name)
                    ->alertMinutesBefore(60, $event->name . " empezará dentro de poco.")
            )->get();
    }

    private function encryptdata($string)
    {

        // Store the cipher method
        $ciphering = "AES-128-CTR"; //config(app.chiper);

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = config('app.encryption_iv');

        // Store the encryption key
        $encryption_key = config('app.encryption_key');

        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt(
            $string,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );

        // Display the encrypted string
        return $encryption;
    }

    private function createPass()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $input_length = strlen($permitted_chars);
        $random_string = '';
        for ($i = 0; $i < 10; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $logo_evius = 'images/logo.png';
        $this->logo = url($logo_evius);
        $organization = !empty($this->event->organizer_id) ? Organization::find($this->event->organizer_id) : null;
        $from = !empty($organization) ? $organization->name : "Evius Event ";
        $emailOrganization = !empty($organization->email) ? $organization->email : config('mail.from.address');
        Log::debug('send rsvp mail from: ' . $emailOrganization);


        $gfService = new GoogleFiles();
        $event = $this->event;

        try {
            if ($event->type_event == "physicalEvent" || $event->type_event == "hybridEvent") {
                $gfService = new GoogleFiles();
                ob_start();
                $qr = QRCode::text($this->eventUser->_id)->setSize(8)->setMargin(4)->png();
                $page = ob_get_contents();
                ob_end_clean();
                $type = "png";
                $image = $page;
                $url = $gfService->storeFile($image, "" . $this->eventUser->_id . "." . $type);
                $this->qr = (string) $url;
            }
        } catch (\Exception $e) {
            Log::debug("error: " . $e->getMessage());
            var_dump($e->getMessage());
        }

        $this->logo = url($logo_evius);
        $logo_evius = 'images/logo.png';
        $this->logo = url($logo_evius);
        $from = !empty($this->event->organizer_id) ? Organization::find($this->event->organizer_id)->name : "Evius Event ";
        $foo = $this->withSwiftMessage(function ($message) {
            $headers = $message->getHeaders();
            // $headers->addTextHeader('X-SES-CONFIGURATION-SET', 'ConfigurationSetSendEmail');                    
        });

        $locale = isset($this->event->language) ? $this->event->language : 'es';
        App::setLocale($locale);

        //if ($this->include_ical_calendar)
        if ($this->include_date) {
            return $this
                ->from($emailOrganization, $from)
                ->subject($this->subject)
                ->attachData($this->ical, 'ical.ics', [
                    'mime' => 'text/calendar;charset="UTF-8";method=REQUEST',
                ])
                ->markdown('rsvp.rsvpinvitation');
            //return $this->view('vendor.mail.html.message');
        }

        return $this
            ->from($emailOrganization, $from)
            ->subject($this->subject)
            ->markdown('rsvp.rsvpinvitation');
    }
}
