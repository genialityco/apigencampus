<?php

namespace App;
use Moloquent;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\Model;


class Quantity extends Moloquent
{
    
    /*public function quantity()
    {   
        return $this->belongsTo('App\Activities');
    }*/

   
    protected $table = 'quantity'; 

    protected $guarded = [];
}   
