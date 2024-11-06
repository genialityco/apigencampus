<?php

namespace App;
use Moloquent;
use Illuminate\Database\Eloquent\Model;

class Comment extends Moloquent
{
    //
    protected $fillable = [
        'comment', 
        'image',
        'event_id',
        'organization_id',
        'account_id'
    ];  

    public function event()
    {
        return $this->belongsToMany('App\Event');
    }

    public function organization()
    {
        return $this->belongsToMany('App\Organization');
    }

    public function user()
    {
        return $this->belongsToMany('App\Account');
    }
}
