<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
use App\Models\Organiser;

class Organization extends Organiser
{
    const ID_ROL_ADMINISTRATOR = '5c1a59b2f33bd40bb67f2322';
    protected $fillable = [ 
        'name', 
        'country', 
        'city', 
        'picture',
        'location', 
        'banner_image_email', 
        'footer_image_email',
        'nit', 
        'phone', 
        'doc', 
        'description', 
        'author',
        'email',
        'network',
        'user_properties',
        'properties',
        'styles',
        'itemsMenu',
        'type_event',
        'visibility',
        'allow_register',
        'default_position_id',
        'enable_notification_providers',
        'access_settings',
        'registration_message',  //Customized message to be send after registering to organization
        'public_help_message',
        'extra_landing_resources',
        'publicKeyTest', //Public key for payment gateway test
        'privateKeyTest', //Private key for payment gateway test
        'publicKeyProd', //Public key for payment gateway prod
        'privateKeyProd', //Private key for payment gateway prod
        'show_link_to_certificate_search_page',
    ];

    protected $hidden = ['account_ids'];

   /*  public function events()
    {
        // return $this->morphMany('App\Event', 'organizer');
        return $this->belongsTo('App\Event', 'organiser_id');
    } */
    
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }  

    public function users()
    {
        return $this->belongsToMany('App\Account');
    } 

    public function user_properties()
    {
        return $this->embedsMany('App\UserProperties');
    }

    public function template_properties()
    {
        return $this->embedsMany('App\TemplateProperties');
    }

    public function rols()
    {
        return $this->morphMany('App\Rol' , 'modeltable');
    }

    public function positions()
    {
        // A organization has many position,
        // but, a position belongs to one organization only
        return $this->hasMany('App\Position');
    }

    public function default_position()
    {
        return $this->belongsTo('App\Position');
    }
}
