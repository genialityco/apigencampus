<?php

namespace App;

//use Moloquent\Eloquent\Model;

class DocumentUser extends MyBaseModel
{
    protected $fillable = [
        'name',
        'url',
        'event_id',
        'eventuser_id',
        'assign'
    ];

    public function event()
    {
        return $this->belongsToMany('App\Event');
    }

    public function eventUser()
    {
        return $this->belongsToMany('App\Attendee');
    }
}
