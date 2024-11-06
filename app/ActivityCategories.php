<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class ActivityCategories extends Moloquent
{
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    protected $fillable = ['name', 'event_id' , 'color'];
}
