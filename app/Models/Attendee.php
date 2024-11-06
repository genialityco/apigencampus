<?php

namespace App\Models;

/*
Attendize.com   - Event Management & Ticketing
 */

/**
 * Description of Attendees.
 *
 * @author Dave
 */
class Attendee extends MyBaseModel
{
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $table = "event_users";
    protected static $unguarded = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'event_id',
        'order_id',
        'ticket_id',
        'account_id',
        'reference',
        'has_arrived',
        'arrival_time',
        'checkedin_at',
        'test',
    ];

    protected $dates = ['checkedin_at', 'created_at', 'updated_at', 'test', 'printouts_at'];

    /*

    Mutator creado para darle soporte a laravel de fecha ISO8601 antes de laravel 5.8
    @link https://github.com/laravel/framework/issues/24112
     */
    // public function setCheckedinAtAttribute($date)
    // {
    //     echo $date;
    //     $date = "2020-06-30T03:53Z";
    //     $format = "Y-m-d\TH:i\Z";
    //     $this->attributes['checkedin_at'] = \Carbon::createFromFormat($format, $date);
    //     //var_dump($this->attributes['checkedin_at']);die;
    //     //$this->attributes['checkedin_at'] = \Carbon::parse($value)->toDateTimeString();
    // }

    /**
     * Generate a private reference number for the attendee. Use for checking in the attendee.
     *
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->private_reference_number = str_pad(random_int(0, pow(10, 9) - 1), 9, '0', STR_PAD_LEFT);
        });
    }

    /**
     * The order associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    /**
     * The ticket associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(\App\Models\Ticket::class);
    }

    /**
     * The event associated with the attendee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Models\QuestionAnswer');
    }

    /**
     * Scope a query to return attendees that have not cancelled.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeWithoutCancelled($query)
    {
        return $query->where('attendees.is_cancelled', '=', 0);
    }

    /**
     * Get the attendee reference
     *
     * @return string
     */
    public function getReferenceAttribute()
    {
        return ($this->order) ? $this->order->order_reference . '-' . $this->reference_index : "ticket-" . $this->id;
    }

    /**
     * Get the full name of the attendee.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    /**
     * set attendee email in lowercase
     */
    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

}