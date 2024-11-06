<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Event Model
 *
 */

class EventType extends Moloquent
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
   // protected $table = ('event_types');
    protected $fillable = ['id','name'];

    /**
     * Get the events .
     * this must be the eventUser or event, where the relation is eventypes has many Events
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
