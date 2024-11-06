<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomizableMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message = '';
    public $subject = '';
    public $link = '';
    public $action_link = '';


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body)
    {
         $this->message = $body['message'] ;
         $this->subject = $body['subject'];
         $this->link  = $body['link'];
         $this->action_link  = $body['action_link'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
// ->from(array_merge(config('mail.from'),['name'=>'Endocampus | Geniality']))
            ->subject($this->subject)
            ->markdown('customizableMail');
    }
}
