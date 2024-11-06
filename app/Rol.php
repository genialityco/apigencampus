<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class Rol extends Moloquent
{   
    
    const ID_ROL_ADMINISTRATOR = '5c1a59b2f33bd40bb67f2322';
    const ID_ROL_ATTENDEE = '60e8a7e74f9fb74ccd00dc22';
    const MODULE_SYSTEM = 'system';

    protected $fillable = [ 
        'modeltable_id', //60e8asdsaa7asd74ccdasd00dc22
        'modeltable_type', // App/Event
        'name', 
        'type',
        'event_id'
    ];
    //
    protected $table = ('roles');   

    public function modeltable(){

        return $this->morphTo();
    }

    public function permissions()
    {
        return $this->hasMany(\App\Models\RolesPermissions::class);
    }
    

    public static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            $nonChangeableRoles = [
                self::ID_ROL_ADMINISTRATOR ,
                self::ID_ROL_ATTENDEE
            ];

            if(in_array($model->_id, $nonChangeableRoles))
            {
                abort(401 , "You don't have permission for do this action.");
            }

        });

        self::deleting(function ($model) {
            $nonChangeableRoles = [
                self::ID_ROL_ADMINISTRATOR ,
                self::ID_ROL_ATTENDEE
            ];

            if(in_array($model->_id, $nonChangeableRoles))
            {
                abort(401 , "You don't have permission for do this action.");
            }

        });
    }
}
