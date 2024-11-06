<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ModelHasRole extends Moloquent
{
    //use SoftDeletes;
    //
    // use HasRoles;
    protected $table = ('model_has_roles');
    protected $fillable = ['rol_id','event_id','model_id', 'model_type', 'space_id'];
    protected $with = ['role','space','user']; 
    protected $times = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Account', 'model_id');
    }

    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role', 'rol_id');
    }

    public function event()
    {
        return $this->belongsTo('App\Event','event_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Event','organization_id');
    }

    public function space()
    {
        return $this->belongsTo('App\Space','space_id');
    }
}
