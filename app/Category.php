<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */
class Category extends Moloquent
{
    //protected $with = ['event'];
    //protected $table = 'category';
    protected $hidden = ['event_ids','activities_ids'];
    /**
     * Category is owned by an event
     * @return void
     */
    public function event()
    {
        return $this->belongsToMany('App\Event');
    }

    public function organization()
    {
        return $this->belongsToMany('App\Organization');
    }

    protected $fillable = [
        'name', 'image','event_ids', 'organization_ids', 'created_at'
    ];
}
