<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class Inscription extends Moloquent
{
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    public function eventusers()
    {
        return $this->hasMany('App\Attendee');
    }
    protected $guarded = [];
}
