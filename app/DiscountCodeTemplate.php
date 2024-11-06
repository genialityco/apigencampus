<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */
class DiscountCodeTemplate extends Moloquent
{
    //protected $with = ['event'];
    //protected $table = 'category';
    protected $fillable = [
        // 'group_code', 
        'discount',
        'name',
        'use_limit',    
        'event_id',
        'organization_id',
        'discount_type'               
    ];

    protected $with = ['event',  'organization' ];
   
    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }  
    
    public function organization()
    {
        return $this->belongsTo('App\Organization', 'organization_id');
    } 
}
