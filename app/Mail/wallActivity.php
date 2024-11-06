<?php

namespace App\Mail;

use App\evaLib\Services\GoogleFiles;
use App\Event;
use Illuminate\Bus\Queueable;
use Carbon\Carbon;
use App\Organization;
use Google\Cloud\Storage\StorageClient;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;
use QRCode;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;
use Storage;

class wallActivity extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;//, Dispatchable, InteractsWithQueue;
    public $event;
    public $event_address;
    public $event_city;
    public $event_state;
    public $logo;
    public $subject;
    public $type;
    public $img;
    public $post_image;
    public $link;
    public $post;
    public $comment;
    public $title;
    public $datePost;
    public $sender;
    public $user_sender;
    public $user_receiver;
    public $email;
    public $date_time_from;
    public $date_time_to;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $event_id, $user_sender = null, $user_receiver = null)
    {   
        //$event_id,$title,$$user_sender,$subject,$img,$sender,$response,$email,$receiver,$sender_user)
        $comment = !empty($data["comment"]) ? $data["comment"] : null ;

        $type = $data["type"];
        $event = Event::find($event_id);
        $event_address = isset($event["location"]["FormattedAddress"])?($event["location"]["FormattedAddress"]):" ";
        $event_city = isset($event["location"]["City"])?($event["location"]["City"]):" ";
        $event_state = isset($event["location"]["state"])?($event["location"]["state"]):" ";
        
        $password = isset($user_receiver["properties"]["password"]) ? $user_receiver["properties"]["password"] : "Evius.2040";
        $pass = self::encryptdata($password);

        Log::debug("cargando datos event_user al correo");
        
        $link = config('app.api_evius') . "/singinwithemail?email=" . $user_receiver->properties["email"] . '&innerpath=' . $event_id  . "&pass=" . $pass;
       
        
        $subject = $type == "comment" ? "🔔 ".$user_sender->properties["displayName"]." ha comentado tu post" : "🔔 ".$user_sender->properties["displayName"]. "ha subido contenido al muro" ;
        $date_time_from = $event->datetime_from;
        $date_time_to = $event->datetime_to;

        $firestore = new FirestoreClient([
            'keyFilePath' => base_path('firebase_credentials.json')
        ]); 
        $post_image = null;
        $collection = $firestore->collection("adminPost");
        $doc = $collection->document($event_id)->collection("posts")->document($data["post_id"]);   
        $snapshot = $doc->snapshot();
        $datePost = $snapshot["datePost"];
        $datePost = Carbon::parse($datePost);   
        if(!empty($snapshot["urlImage"])){
            $post_image = $snapshot["urlImage"];
        }
        $post = $snapshot["post"];
        
        
        $this->user_receiver = $user_receiver;
        $this->link = $link;
        $this->type = $type;
        $this->datePost = $datePost;
        $this->post_image = $post_image;
        $this->event_address =$event_address;
        $this->event_city = $event_city;
        $this->event_state = $event_state;
        $this->event = $event;
        $this->user_sender = $user_sender;
        $this->date_time_from =$date_time_from;
        $this->date_time_to =$date_time_to;
        $this->subject = $subject;
        $this->post = $post;
        $this->comment = $comment;
        $gfService = new GoogleFiles();

        $this->ical = iCalCalendar::create($event->name)
        ->event(iCalEvent::create($event->name)
                ->startsAt($date_time_from)
                ->endsAt($date_time_to)
                ->uniqueIdentifier($event->_id)
                ->createdAt(new \DateTime())
                ->address(($event->address) ? $event->address : "Virtual en web evius.co")
                ->addressName(($event->address) ? $event->address : "Virtual en web evius.co")
            //->coordinates(51.2343, 4.4287)
                ->organizer('soporte@evius.co', $event->organizer->name)
                ->alertMinutesBefore(60, $event->name . " empezará dentro de poco.")
        )->get();

   
        Log::debug("pasando a crear correo");
    }

    private function encryptdata($string){
        
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
        $encryption = openssl_encrypt($string, $ciphering, 
                    $encryption_key, $options, $encryption_iv); 

        // Display the encrypted string 
        return $encryption; 
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::debug("Construyendo el correo de ticket");
        $from = !empty($this->event->organizer_id) ? Organization::find($this->event->organizer_id)->name : "Evius Event ";
        

        return $this
        // ->attach($attachPath,[
        //     'as' => 'checkin',
        //     'mime' => 'image/png',
        // ])
        // ->attachData($pdf->download(),'boleta.pdf')
        ->from(array_merge(config('mail.from'),['name'=>$from]))
        ->subject($this->subject)
        ->markdown('WallActivity');
        
}
    
}
