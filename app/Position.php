<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

/**
 * Position Model
 *
 */
class Position extends Moloquent
{
    protected $table = "positions";

    public function organization_users()
    {
        return $this->hasMany('App\OrganizationUser'); // organization_user_ids
    }

    public function organization()
    {
        // A organization has many position,
        // but, a position belongs to one organization only
        return $this->belongsTo('App\Organization');
    }

    public function events()
    {
        // A event has many events,
        // and a position has many position ones too
        return $this->belongsToMany('App\Event');
    }   

    protected $fillable = [
        'position_name',
    ];
}