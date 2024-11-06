<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class AttendeTicket extends Moloquent
{
    //
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }
    protected $fillable = [ 'account_id', 'event_id', 'rol_id', 'status'];
}
