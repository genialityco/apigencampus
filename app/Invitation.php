<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class Invitation extends Moloquent
{
    /**
     * Category is owned by an event
     * @return void
    **/

    protected $table = "networking_request";
    
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    protected $guarded = [];
}
