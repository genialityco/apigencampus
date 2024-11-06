<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Event;
use App\Organization;


class SilentAuctionMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $event;
    public $user;
    public $dataAuction;
    public $product;
    public $userAdmin;
    public $organization;
    public $prodcutImages;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataAuction, $event_id, $user, $product, $userAdmin)
    {   

        $event =  Event::find($event_id);

        $organization = Organization::find($event->organizer_id);

        
        $pass = isset($user->password) ? $user->password : $user->email;

        $link = config('app.api_evius') . "/singinwithemail?email=" . urlencode($user->email) . '&innerpath=' . $event_id . "&pass=" . urlencode($pass);

        if(is_array($product->image))
        {
            $this->prodcutImages = $product->image[0];
        }else{
            $this->prodcutImages = $product->image;
        }
        
           
        $this->dataAuction = $dataAuction;
        $this->event = $event;
        $this->user = $user;
        $this->product = $product;
        $this->userAdmin = $userAdmin;               
        $this->organization = $organization;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   

        

        $from = !empty($this->event->organizer_id) ? Organization::find($this->event->organizer_id)->name : "Evius Event ";
        if($this->userAdmin)
        {   
            $this
            ->from(array_merge(config('mail.from'),['name'=>$from]))
            
            ->subject($this->event->name)
            ->markdown('Mailers.silentAuction');
        }else{
            $this
            ->from(array_merge(config('mail.from'),['name'=>$from]))
            ->subject($this->event->name)
            ->markdown('Mailers.silentAuctionUserA');
        }
        
    }
}
