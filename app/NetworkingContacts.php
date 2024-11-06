<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class NetworkingContacts extends Moloquent
{
    /**
     * Category is owned by an event
     * @return void
    **/

    protected $table = "networking_contacts";
    
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    public function attendee()
    {
        return $this->belongsTo('App\Attendee');
    }
    protected $guarded = [];
}
