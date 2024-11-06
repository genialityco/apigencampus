<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class EventSession extends Moloquent
{
    protected $table = ('event_sessions');

    protected static $unguarded = true;

    public function event() {
        
		return $this->belongsTo('App\Event');
	}
}
