<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Category Model
 *
 */ 
class Space extends Moloquent
{
    //use SoftDeletes;

    //protected $with = ['staff'];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function staff()
    {
        return $this->hasMany('App\ModelHasRole');
    }    

    protected $fillable = [
        'name' , 'event_id'  
    ];
}
