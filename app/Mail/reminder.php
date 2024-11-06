<?php

namespace App\Mail;

use App\evaLib\Services\GoogleFiles;
use App\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;
use QRCode;
use Storage;

class reminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;//, Dispatchable, InteractsWithQueue;
    public $event;
    public $event_address;
    public $event_city;
    public $event_state;
    public $logo;
    public $attach;
    public $description;
    public $principal_title;
    public $img;
    public $title;
    public $sender;
    public $desc;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event_id,$title,$desc,$subject,$img,$sender)
    {
        
        Log::debug("recibiendo event_user");
      
        $event = Event::find($event_id);
        $event_address = isset($event["location"]["FormattedAddress"])?($event["location"]["FormattedAddress"]):" ";
        $event_city = isset($event["location"]["City"])?($event["location"]["City"]):" ";
        $event_state = isset($event["location"]["state"])?($event["location"]["state"]):" ";

        Log::debug("cargando datos event_user al correo");

        $principal_title = $title;
        $description = $desc;
        $this->$principal_title = $principal_title;
        $this->$img = $img;
        $this->$description = $description;
        $this->event_address =$event_address ;
        $this->event_city = $event_city;
        $this->event_state = $event_state;
        $this->event = $event;
        $this->title = $title;
        $this->desc = $desc;
        $this->sender = $sender;

        $this->subject = $subject;
        $gfService = new GoogleFiles();
   
        Log::debug("pasando a crear correo");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::debug("Construyendo el correo de ticket");
        $gfService = new GoogleFiles();
        $from = $this->event->organizer->name;
        $logo_evius = 'images/logo.png';
        $event = $this->event;
        $sender = $this->sender;
        $event_address = $this->event_address;
        $event_city = $this->event_city;
        $event_state = $this->event_state;
        $principal_title = $this->principal_title;
        $description = $this->description;
        $title = $this->title;
        $desc = $this->desc;
        $subject = $this->subject;
        $img = $this->img;

        return $this
        // ->attach($attachPath,[
        //     'as' => 'checkin',
        //     'mime' => 'image/png',
        // ])
        // ->attachData($pdf->download(),'boleta.pdf')
        ->from(array_merge(config('mail.from'), ['name' => $sender]))
        ->subject($subject)
        ->markdown('reminder');
        
    }
    
}
