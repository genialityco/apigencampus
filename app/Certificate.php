<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Certificate Model
 *
 */
class Certificate extends Moloquent
{

    //protected $with = ['event'];

    //protected $table = 'Certificate';
    /**
     * Certificate is owned by an event
     * @return void
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    protected $fillable = [
        'name' , 
        'content', 
        'background', 
        'event_id',
        'rol_id',
        'cert_width',
        'cert_height',
        'requirement_config',
        'required_attendee_type',
    ];
}
