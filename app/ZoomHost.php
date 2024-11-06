<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class ZoomHost extends Moloquent
{

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    protected $guarded = [];
}
