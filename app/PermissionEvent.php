<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
class PermissionEvent extends Moloquent
{
    //
    protected $fillable = [
        'name', 
        'guard_name', 
        'module'        
    ];
    protected $table = "permissions_events";
    /**
     * The roles associated with the permission.    
     */
    public function roles()
    {
        return $this->hasMany(\App\Models\RolesPermissionsEvent::class);
    }
}
