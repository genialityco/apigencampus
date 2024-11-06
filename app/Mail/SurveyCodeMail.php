<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//SMS
use App\evaLib\Services\WhatsappService;
use App\evaLib\Services\MMasivoService;

class SurveyCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $eventUser_name;
    public $event_name;
    public $survey_name;
    public $code;
    public $image_header;
    public $image_footer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event, $survey, $attendee, $code)
    {
        $this->eventUser_name = $attendee->properties['names'];
        $this->event_name = $event->name;
        $this->survey_name = $survey->survey;
        $this->code = $code;
        $this->image_header = isset($event->styles['banner_image_email']) ? $event->styles['banner_image_email'] : "https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FHeader_Evius_1920x540px%20(1).png?alt=media&token=521a9303-f274-437e-90d6-bb887761e13f";
        $this->image_footer = isset($event->styles['banner_footer_email']) ? $event->styles['banner_footer_email'] : "https://firebasestorage.googleapis.com/v0/b/eviusauth.appspot.com/o/evius%2FViews%2FFooter_Evius_1920x200px%20(1).png?alt=media&token=5216761a-b9b2-41e5-8552-5dcbc2a61c7a";
        
        //WHATSAPP AND SMS SERVICE
        if(isset($attendee->properties['celular'])){
            // $numberWhatsapp = substr($attendee->properties['celular'], 1);//sin el +
            // $bodyWhatsapp = WhatsappService::templateCodePMI(
            //     $numberWhatsapp, 
            //     $event->styles["banner_image"], 
            //     $this->eventUser_name,
            //     $this->survey_name,
            //     $this->code
            // );
            // WhatsappService::sendWhatsapp($bodyWhatsapp);
            $numberSms = $attendee->properties['celular'];//con el +
            //$body = SmsService::bodyCodeEventPMI($this->eventUser_name, $this->survey_name, $this->code);
            $body = MMasivoService::bodyCodeEventPMI($this->code,$this->survey_name, $numberSms);
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
        return $this->from('alerts@evius.co', "Codigo de sala")
            ->subject('Codigo de sala')
            ->markdown('rsvp.surveyCode');
    }
}
