<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//models
use App\Event;
use Illuminate\Support\Facades\DB;

class ExceededUsers extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $events;
    public $allowedUsers;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $allowedUsers)
    {
        $this->user = $user;
        $this->allowedUsers = $allowedUsers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->events = [];

	// fetch user events and validate total number of registered users
	$userEvents = Event::where('author_id', $this->user->_id)->get();
	foreach ($userEvents as $event) {
	    $usersAtTheEvent = DB::table('event_users')->where('event_id', $event['_id'])->where('properties.email', '!=', $this->user->email)->get();
	    array_push($this->events, ['name' => $event->name, 'users' => count($usersAtTheEvent)]);
	}

        //return $this->view('view.name');
        return $this
            ->from("alerts@evius.co", "Evius")
            ->subject('Usuarios excedidos')
            ->markdown('Mailers.ExceededUsers');
    }
}
