<?php

namespace App;
use Moloquent;

use Illuminate\Database\Eloquent\Model;


class UserProperties extends Moloquent
{
    /*
    public function userProperties()
    {
        
        return $this->belongsTo('App\Event');
    }*/
    protected $table = 'user_properties';
    //protected $with = [];
    protected $guarded = [];
}
