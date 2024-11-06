<?php

namespace App\Mail;

use App\Event;
use App\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\evaLib\Services\UserEventService;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;
use Spatie\IcalendarGenerator\PropertyTypes\TextPropertyType as TextPropertyType;
use App\evaLib\Services\GoogleFiles;use QRCode;
use App;
use Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\evaLib\Services\WhatsappService;
use App\evaLib\Services\SmsService;


class InvitationMailAnonymous extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $eventUser_name;
    public $email;
    public $event;
    public $eventUser;
    public $image;
    public $link;
    public $organization_picture;
    public $subject;
    public $image_header;
    public $image_footer;
    public $image_footer_default;
    public $logo;
    public $ical = "";
    public $qr;
    public $urlconfirmacion;
    public $urlOrigin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, $eventUser, $urlOrigin)
    {

        $locale = isset($event->language) ? $event->language : 'es';
        App::setLocale($locale);

        $auth = resolve('Kreait\Firebase\Auth');
        //dd("auth", $auth);
        $this->auth = $auth;        

        $email = isset($eventUser["properties"]["email"]) ? $eventUser["properties"]["email"] : $eventUser["email"];

        if (is_null($email)) {
            $email = $eventUser->properties["email"];
        }
        Log::debug("Invitation mail target: " . $email);
        
        $organization_picture = !empty($event->styles["event_image"]) && strpos($event->styles["event_image"], 'htt') === 0 ? $event->styles["event_image"] : null;
        
        $link = '';
        $this->urlOrigin = isset($urlOrigin) ? $urlOrigin : config('app.front_url');
        $link = $this->urlOrigin . "/landing/" . $event->_id . "/evento?email=" . $email . "&names=" . $eventUser->properties["names"];
        
        $this->organization_picture = $organization_picture;
        $this->image_header = isset($event->styles['banner_image_email']) ? $event->styles['banner_image_email'] : $event->styles['banner_image'];
        $this->link = $link;
        $this->event = $event;
        $this->eventUser = $eventUser;
        $this->image_footer = $event->styles['banner_footer_email'];
        $this->image_footer_default = (isset($event->styles) && isset($event->styles['banner_footer']) && $event->styles['banner_footer']) ? $event->styles['banner_footer'] : null;
        $this->eventUser_name = $eventUser->properties["names"];
        $this->email = $email;
        $this->urlconfirmacion = config('app.front_url').'/landing/'.$event->_id;
        
        

        $this->subject = "Invitación a " . $event->name;
        
        //Definición de horario de inicio y fin del evento.Se le agrega -05:00 para que quede hora Colombia
            $date_time_from = (isset($eventUser->ticket) && isset($eventUser->ticket->activities) && isset($eventUser->ticket->activities->datetime_start)) ? \Carbon\Carbon::parse($eventUser->ticket->activities->datetime_start."-05:00") : \Carbon\Carbon::parse($event->datetime_from ."-05:00");
            $date_time_to = (isset($eventUser->ticket) && isset($eventUser->ticket->activities) && isset($eventUser->ticket->activities->datetime_end)) ? \Carbon\Carbon::parse($eventUser->ticket->activities->datetime_end."-05:00") : \Carbon\Carbon::parse($event->datetime_to."-05:00");        
            $date_time_from = $date_time_from->setTimezone("UTC");
            $date_time_to = $date_time_to->setTimezone("UTC");

        $descripcion = $event->name." Ver el evento en: ".$this->link;
        
     
        //Crear un ICAL que es un formato para agregar a calendarios y eso se adjunta al correo
            $this->ical = iCalCalendar::create($event->name)
                ->appendProperty(
                    TextPropertyType::create('URL', $this->urlconfirmacion) 
                )
                ->appendProperty(
                    TextPropertyType::create('METHOD', "REQUEST") 
                )
                ->event(iCalEvent::create($event->name)
                        ->startsAt($date_time_from)
                        ->endsAt($date_time_to)
                        ->description($descripcion)
                        ->uniqueIdentifier($event->_id)
                        ->createdAt(new \DateTime())
                        ->address(($event->address) ? $event->address :  $this->urlconfirmacion)
                        ->organizer('soporte@evius.co', $event->organizer->name)
                        ->alertMinutesBefore(60, $event->name . " empezará dentro de poco.")
                )->get();

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
        $emailOrganization = !empty($organization->email) ? $organization->email : "alerts@evius.co";
        $gfService = new GoogleFiles();
        $event = $this->event;
        try {

            ob_start(); 
            $qr = QRCode::text($this->eventUser->_id)->setSize(8)->setMargin(4)->png();
            $page = ob_get_contents();
            ob_end_clean();
            $type = "png";
            $image = $page;
            $url = $gfService->storeFile($image, "".$this->eventUser->_id.".".$type);

            $this->qr = (string) $url;
            $this->logo = url($logo_evius);


        } catch (\Exception $e) {
            Log::debug("error: " . $e->getMessage());
            var_dump($e->getMessage());
        }
        
        $locale = isset($this->event->language) ? $this->event->language : 'es';
        App::setLocale($locale);
        
        
        $icalCalendar = isset($event->extra_config['include_ical_calendar']) ? $event->extra_config['include_ical_calendar'] : true;

        if(!$icalCalendar)
        {
            return $this ->from($emailOrganization, $from)
            ->subject($this->subject)
            ->markdown('rsvp.invitation');
        }
        return $this ->from($emailOrganization, $from)
            ->subject($this->subject)
            ->attachData($this->ical, 'ical.ics', [
                'mime' => 'text/calendar;charset="UTF-8";method=REQUEST',
            ])
            ->markdown('rsvp.invitation');
        
    }
}
