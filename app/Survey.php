<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

class Survey extends Moloquent
{

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
  
    public function activities()
    {
        return $this->belongsToMany('App\Activities');
    }

    protected $guarded = [];
}