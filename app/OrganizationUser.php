<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class OrganizationUser extends Moloquent
{
    protected $fillable = [
        'organization_id', 
        'user_properties', 
        'properties', 
        'account_id', 
        'position_id',
        'rol_id'
    ];
    protected $with = ['user', 'organization', 'rol', 'position', 'payment_plan'];

    public function user()
    {
        return $this->belongsTo('App\Account', 'account_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization', 'organization_id');
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol', 'rol_id');
    }

    public function position()
    {
        // A position has many organization user,
        // but an organization user belongs to one position only
        return $this->belongsTo('App\Position', 'position_id');
    }

    public function payment_plan()
    {
        return $this->hasOne('App\PaymentPlan', 'organization_user_id');
    }
}
