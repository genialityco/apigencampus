<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Speaker extends Moloquent
{
    protected static $unguarded = true;

    protected $table = ('speaker');

    protected $fillable = ['id', 'name', 'lastname', 'email',
        'rol', 'category', 'photo', 'position', 'company', 'social_media',
        'video', 'country', 'description', 'order', 'event_id', 'description_activity'];

    public function events()
    {
        return $this->belongsTo('App\Event');
    }

}