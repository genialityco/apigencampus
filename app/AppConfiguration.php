<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class AppConfiguration extends Moloquent
{

    //protected $with = ['staff'];
   

  
    protected $guarded = [];
}
