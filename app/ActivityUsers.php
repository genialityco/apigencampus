<?php

namespace App;
use Moloquent;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\Model;


class ActivityUsers extends Moloquent
{
    
    /*public function activities()
    {   
        return $this->belongsTo('App\Activities');
    }*/

   
    protected $table = 'acitivity_users'; 

    protected $guarded = [];
}   
