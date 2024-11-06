<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */
class RoleAttendee extends Moloquent
{
    //
    const ID_ROL_ADMINISTRATOR = '5c1a59b2f33bd40bb67f2322';
    const ID_ROL_ATTENDEE = '60e8a7e74f9fb74ccd00dc22';

    protected $fillable = [ 
        'name', 
        'type'
    ];
    
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public static function boot()
    {

        parent::boot();
        self::saving(function ($model) {
                
            if(($model->_id === self::ID_ROL_ADMINISTRATOR) ||  ($model->_id === self::ID_ROL_ATTENDEE))
            {
                abort(401 , "You don't have permission for do this action.");
            }

        });

        self::deleting(function ($model) {
                
            if(($model->_id === self::ID_ROL_ADMINISTRATOR) ||  ($model->_id === self::ID_ROL_ATTENDEE))
            {
                abort(401 , "You don't have permission for do this action.");
            }

        });
    }
}