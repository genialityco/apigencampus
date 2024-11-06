<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */ 
class ActivityAssistant extends Moloquent
{
    protected $dates = ['checkedin_at'];
    protected $with = ['user'];


    public function user()
    {
        return $this->belongsTo('App\Account','user_id','_id');
    }
    public function Acitivity()
    {
        return $this->hasOne('App\Activities');
    }
    protected $guarded = [];
}
