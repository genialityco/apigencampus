<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//SMS
use App\evaLib\Services\WhatsappService;
use App\evaLib\Services\MMasivoService;

class SurveyResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $eventUser_name;
    public $email;
    public $survey_name;
    public $activity_id;
    public $activity_name;
    public $image_header;
    public $image_footer;
    public $auth;
    public $link;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $survey_name, $activity, $attendee)
    {
        $this->eventUser_name = $attendee->properties['names'];
        $this->survey_name = $survey_name;
        $this->activity_id = isset($activity->_id) ? $activity->_id : null;
        $this->activity_name = $activity->name;
        $this->image_header = isset($event->styles['banner_image_email']) ? $event->styles['banner_image_email'] : "https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FHeader_Evius_1920x540px%20(1).png?alt=media&token=521a9303-f274-437e-90d6-bb887761e13f";
        $this->image_footer = isset($event->styles['banner_footer_email']) ? $event->styles['banner_footer_email'] : "https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FFooter_Evius_1920x200px%20(1).png?alt=media&token=5216761a-b9b2-41e5-8552-5dcbc2a61c7a";
        //dd($attendee->properties['email']);
        $email = $attendee->properties['email'];

        $auth = resolve('Kreait\Firebase\Auth');
        $this->auth = $auth;

        $link = config('app.front_url') . '/landing/' . $event->_id . '/activity/' . $activity->_id;
        $this->link = $link;

        //WHATSAPP AND SMS SERVICE
        if(isset($attendee->properties['celular'])){
            // $numberWhatsapp = substr($attendee->properties['celular'], 1);//sin el +
            $codeUrl = WhatsappService::getCodeSurveyResponse($link);
            // $bodyWhatsapp = WhatsappService::templateButtonSurvey($numberWhatsapp, $event->styles["banner_image"], $this->eventUser_name, $this->survey_name, $codeUrl);
            // WhatsappService::sendWhatsapp($bodyWhatsapp);
            $numberSms = $attendee->properties['celular'];//con el +
            //$body = SmsService::bodySurveyEventPMI($this->eventUser_name, $survey_name, $codeUrl);
            $body = MMasivoService::bodySurveyEventPMI($this->eventUser_name, $this->survey_name, $codeUrl, $numberSms);
            MMasivoService::sendSms($body);
        }
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alerts@evius.co', "Encuesta abierta")
            ->subject('Encuesta abierta')
            ->markdown('rsvp.surveyResponse');
    }
}
