<?php

namespace App;

use Moloquent;
use Spatie\Permission\Traits\HasRoles;
use App\Rol;

class RolesPermissions extends Moloquent
{
    use HasRoles;

    //
    protected $with = ['rol' , 'permission'];
    protected $table = "roles_permissions";
    protected $fillable = [
        'rol_id' , 
        'permission_id'
    ];   
    
    
    public function permission()
    {
        return $this->belongsTo('App\Permission', 'permission_id');
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol', 'rol_id');
    }


    public static function boot()
    {

        

        parent::boot();
        
        self::saving(function ($model) {

            $nonChangeableRoles = [
                Rol::ID_ROL_ADMINISTRATOR ,
                Rol::ID_ROL_ATTENDEE
            ];
    
                
            if(in_array($model->rol_id, $nonChangeableRoles))
            {
                abort(401 , "You don't have permission for do this action.");
            }

        });

        self::deleting(function ($model) {

            $nonChangeableRoles = [
                Rol::ID_ROL_ADMINISTRATOR ,
                Rol::ID_ROL_ATTENDEE
            ];
    
                
            if(in_array($model->rol_id, $nonChangeableRoles))
            {
                abort(401 , "You don't have permission for do this action.");
            }

        });
    }
}
