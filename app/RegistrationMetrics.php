<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * RegistrationMetrics Model
 * 
 */
class RegistrationMetrics extends Moloquent
{

    protected $fillable = [
        'event_id',
        'quantity',
        'date'
    ];

    /**     
     * @return void
     */
    public function event()
    {
        return $this->belongsToMany('App\Event');
    }


    
}
