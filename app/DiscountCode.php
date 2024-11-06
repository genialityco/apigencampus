<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use Moloquent;

/**
 * Category Model
 *
 */
class DiscountCode extends Moloquent
{
    //protected $with = ['event'];
    //protected $table = 'category';
    protected $fillable = [
        'code', 
        'number_uses',
        'discount_code_template_id', 
        'event_id', 
        'organization_id',
        'space_available' // Used for Royal Prestige, number of available users       
    ];

    // protected $with = ['discount_code_template'];
   
    public function discount_code_template()
    {
        return $this->belongsTo('App\DiscountCodeTemplate', 'discount_code_template_id');
    }

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization', 'organization_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id');
    }
    
}
