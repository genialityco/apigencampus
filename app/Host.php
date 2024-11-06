<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Category Model
 *
 */
class Host extends Moloquent
{
    //use SoftDeletes;

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    protected $fillable = [
        'name', 
        'profession', 
        'description', 
        'image', 
        'event_id', 
        'en_description', 
        'profession', 
        'description_activity', 
        'order',
        'category_id',
        'published',
        'index',
        'phone'
    ];
}
