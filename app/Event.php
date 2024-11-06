<?php

namespace App;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//Importante usar moloquent!!!!!!
use App\Models\Event as ModelsEvent;
use Carbon\Carbon;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Jenssegers\Mongodb\Eloquent\SoftDeletes;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Event Model
 *
 */
class Event extends ModelsEvent
{
    //use SoftDeletes;

    const VISIBILITY_PUBLIC = 'PUBLIC';
    const VISIBILITY_ORGANIZATION = "ORGANIZATION";
    const ID_ROL_ADMINISTRATOR = '5c1a59b2f33bd40bb67f2322';

    protected $hidden = array('activity_categories');

    protected $with = ['author', 'categories', 'eventType', 'organiser', 'organizer', 'currency', 'tickets', 'modules'];

    protected $fillable = [
        'has_payment', 'author', 'name', 'description', 'location', 'venue', 'address', 'pulep', 'registration_message',
        'datetime_from', 'datetime_to', 'date_start', 'date_end', 'time_start', 'time_end',
        'visibility', 'picture', 'organization_id', 'category', 'extra_config',
        'user_properties', 'properties_group', 'styles', 'has_date', 'app_configuration',
        'banner_image', 'banner_image_email', 'homeSelectedScreen', 'allow_register', 'allow_detail_calendar', 'analytics',
        'banner_image_link', 'enable_language', "map_image", 'type_event', 'itemsMenu', 'video', 'meetinghostid', 'meetinghostname', 'meetinghostemail', 'dates',
        'include_date', 'event_platform', 'fields_conditions', 'validateEmail', 'loader_page', 'data_loader_page', 'show_banner', 'initial_page', 'show_banner_footer',
        'send_custom_email', 'language', 'googleanlyticsid', 'status', 'googletagmanagerid', 'facebookpixelid', 'sendregistrationnotification',
        'video_position',
        'sms_notification', //boolean para activar o desactivar el envio de sms
	    'bingo', // boolean para saber si un evento tiene bingo
	    'later_days', // restriction plan: Days after the live landing event 
        'count_activities', // Get number event's activities
        'has_prelanding', // prelanding: boolean para saber si un evento tiene prelanding,
        'where_it_run', // prelanding: boolean para saber si un evento tiene prelanding,
        'url_external', // prelanding: url externa para redireccionar,
        'success_message', // prelanding: mensaje de exito para mostrar en el prelanding,
        'useCountdown', 'dateLimit', 'countdownMessage', 'countdownFinalMessage', // count royal prestige
        'dynamics', // object para guardar los datos de los campos dinamicos de un evento. Ej = {'bingo': true, 'share_photo': true}
        'later_days', // restriction plan: Days after the live landing event
        'where_it_run', // prelanding: boolean para saber si un evento tiene prelanding,
        'url_external', // prelanding: url externa para redireccionar,
        'success_message', // prelanding: mensaje de exito para mostrar en el prelanding,
        'useCountdown', 'dateLimit', 'countdownMessage', 'countdownFinalMessage', // count royal prestige
        'sale_start_date', // fecha de inicio de venta de boletos
        'sale_end_date', // fecha de fin de venta de boletos
        'vat_added_price', // boolean para saber si al precio se le incluye iva
        'vat_included_price', // boolean para saber si el precio viene con iva
        'vat_value', // valor del iva %
        'limit_tickets_per_user', // limite de boletos por usuario
        'minimum_tickets_to_buy', // minimo de boletos a comprar
        'maximum_tickets_to_buy', // maximo de boletos a comprar
        'minimum_age', // edad minima para comprar boletos int
        'view_price_list', // boolean para saber si se muestra la lista de precios
        'view_range_price', // boolean para saber si se muestra el rango de precios
        'redirect_activity', // string para redireccionar a una actividad
	    'boleteria_id', // boolean para saber si un evento tiene boleteria
        'redirect_landing', // Boolean: Saltar la prelanding
        'is_custom_password_label', // Boolean: Determina si evento tiene password name personalizado
        'custom_password_label', // String: Nombre del campo password
        // For external certification
        "is_certification",
        "validity_days",
        "default_certification_description",
        "default_certification_hours",
        "default_certification_entity",
        "default_certification_last_hours",
        "duration",
        "is_socialzone_opened",
        "is_examen_required",
        "hide_certificate_link",
        "certificate_email_settings",
        "event_tip",
        "published_at_home",
        "progress_settings",
        "permanent_video_banner",
    ];

    protected $times = ['datetime_from', 'datetime_to', 'created_at', 'updated_at'];

    public function __construct($data = array())
    {
        $this->dates = array_merge($this->dates, $this->times);
        parent::__construct($data);
    }
    /**
     * The  currency associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class, 'currency_id')->withDefault([
            "_id" => "5c23936fe37db02c715b2a02", "id" => 1, "title" => "U.S. Dollar", "symbol_left" => "$", "symbol_right" => "",
            "code" => "USD", "decimal_place" => 2, "value" => 1, "decimal_point" => ".", "thousand_point" => ",", "status" => 1,
            "created_at" => "2013-11-29 19=>51=>38", "updated_at" => "2013-11-29 19=>51=>38",
        ]);
    }

    /**
     * Simulating date fiels to match attendeze platform
     *
     * @param string $date DateTime
     */
    public function getStartDateAttribute()
    {
        $format = config('attendize.default_datetime_format');
        $this->attributes['start_date'] = Carbon::now();
        return Carbon::now();
    }

    public function getEndDateAttribute()
    {
        $format = config('attendize.default_datetime_format');
        $this->attributes['end_date'] = Carbon::now();
        return Carbon::now();
    }

    protected $casts = [
        'category' => 'array',
    ];

    /***
     *
     *  _____  ______ _            _______ _____ ____  _   _  _____
     *  |  __ \|  ____| |        /\|__   __|_   _/ __ \| \ | |/ ____|
     *  | |__) | |__  | |       /  \  | |    | || |  | |  \| | (___
     *  |  _  /|  __| | |      / /\ \ | |    | || |  | | . ` |\___ \
     *  | | \ \| |____| |____ / ____ \| |   _| || |__| | |\  |____) |
     *  |_|  \_\______|______/_/    \_\_|  |_____\____/|_| \_|_____/
     *
     *
     */

    /**
     * The organizer associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizer()
    {
        return $this->belongsTo(\App\Organization::class, 'organizer_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Account', 'author_id');
    }

    /**
     * Override parent method
     *
     */
    public function account()
    {
        return $this->belongsTo('App\Account', 'author_id');
    }

/**
 * get the possible organizers
 *
 * @return void
 */
    /*   public function organiser()
    {
    // return $this->morphTo();
    return $this->hasMany('App\Organization');
    } */

    public function eventUsers()
    {
        return $this->hasMany('App\Attendee');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Dynamic user properties
     *
     * @return void
     */
    // public function userProperties()
    // {
    //     return $this->hasMany('App\Properties');
    // }

    /**
     * Get the comments for the blog post.
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
     * The tickets associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    /**
     * Get the event type.
     */
    public function eventType()
    {
        return $this->belongsTo('App\EventType', 'event_type_id');
    }

    /**
     * Get the speaker associated with de event.
     */
    public function speaker()
    {
        return $this->hasMany('App\Speaker', 'event_id');
    }

    /**
     * Get the session associated with de event.
     */
    public function sessions()
    {

        return $this->hasMany('App\EventSession', 'event_id');
    }

    /**
     * The tickets associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('\App\Models\Ticket', 'event_id');
    }
    /**
     * The orders associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function userPermissions()
    {
        return $this->hasMany('App\ModelHasRole');
    }

    public function rols()
    {
        return $this->morphMany('App\Rol', 'modeltable');
    }

    public function user_properties()
    {
        return $this->embedsMany('App\UserProperties');
    }

    public function positions()
    {
        // A event has many events,
        // and a position has many position ones too
        return $this->belongsToMany('App\Position');
    }

    public function modules()
    {
        return $this->hasMany('App\Module');
    }
}
