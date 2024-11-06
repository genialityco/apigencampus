<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class SendContent extends Moloquent
{

    //protected $with = ['event'];

    //protected $table = 'category';
    /**
     * Category is owned by an event
     * @return void
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    protected $fillable = [
        'name' , 'content' , 'background' , 'event_id' , 'to' , 
    ];
}
