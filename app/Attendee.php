<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Database\Eloquent\Model;

// It serves to maintain the restriction of registered users even if they are deleted
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Attendee extends Models\Attendee
{

    use Notifiable;
    //use SoftDeletes;

    const STATE_DRAFT = "5b0efc411d18160bce9bc706"; //"DRAFT";
    const STATE_INVITED = "5ba8d213aac5b12a5a8ce749"; //"INVITED";
    const STATE_RESERVED = "5ba8d200aac5b12a5a8ce748"; //"RESERVED";
    const ROL_ATTENDEE = "60e8a7e74f9fb74ccd00dc22"; //"rol id";
    const STATE_BOOKED = "5b859ed02039276ce2b996f0"; //"BOOKED";

    protected $table = "event_users";
    protected $observables = ['saved', 'created', 'updated' , 'deleted'];
    protected static $unguarded = true;
    protected $fillable = [
        "account_id",
        "event_id",
        "state_id",
        "checkedin_at",
        "checked_in",
        "checked_in_date",
        "checkedin_type",
        "properties",
        "activities",
        "rol_id",
        "enrollment_activity",
        "ticket_title",
        "ticket_id",
        "registered_devices",
        "printouts",
        "activityProperties", // Estructura de checkin por activades
        "attended_activities", // Listado de activades asistidas
        "approved", // Estado del curso completado
        // For the external certificate
        "approved_from_date",
        "approved_until_date",
        "last_hours",
        // For the progress
        "activity_progresses",
    ];
    protected $with = ["user","rol"];
    //protected $with = ["user:uid,email,displayName,names","rol", 'state', "ticket"];
   //protected $visible = ['_id','names','email','properties','user','account_id','score'];
    //protected $with = ["user","rol", 'state', "ticket"];

    //Default values
    protected $attributes = [
        'state_id' => self::STATE_DRAFT,
        'checked_in' => false,
        'rol_id' => self::ROL_ATTENDEE,
    ];

    /* protected $dispatchesEvents = [
    'saved' => \App\Observers\EventUserObserver::class,
    ];*/

    public function toJson($options = 0)
    {
        $options = $options | JSON_INVALID_UTF8_SUBSTITUTE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
        return parent::toJson($options);
    }

    public function activities()
    {
        return $this->belongsToMany('App\Activities');
    }
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function user()
    {
        return $this->belongsTo('App\Account', 'account_id');
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol', 'rol_id');
    }

    public function confirm()
    {
        $this->state_id = self::STATE_BOOKED;
        return $this;
    }

    public function book()
    {
        $this->state_id = self::STATE_BOOKED;
        return $this;
    }

    public function draft()
    {
        $this->state_id = self::STATE_DRAFT;
        return $this;
    }

    public function checkIn()
    {
        try {
            $this->checked_in = true;
            // $this->checked_in_date = time();
            $this->checkedin_at = time();
            return ($this->save()) ? "true" : "false";
        } catch (\Exception $e) {
            // do task when error
            return $e->getMessage();
        }

        return true;
    }

    public function changeToInvite()
    {

        if ($this->state_id == self::STATE_DRAFT || !$this->state_id) {
            $this->state_id = self::STATE_INVITED;
            $this->save();
        }
        return $this;
    }

    /**
     *La siguiente funcion se comento porque no se pudo
     *hacer que el request obtuviera el usuario logueado
     *y asi poder ejecutar sus consultas sql
     */

    // protected static function boot()
    // {
    //     parent::boot();

    //     $request = request();
    //     var_dump("usuario");
    //     var_dump($request->get("user"));

    //     if(isset($request->user)){
    //         static::addGlobalScope('visibility', function (Builder $builder) {
    //             $builder->where('visibility', 'IS NULL', null, 'and');
    //         });
    //     }else{
    //         static::addGlobalScope('visibility', function (Builder $builder) {
    //             $builder->where('visibility', '<>', Event::VISIBILITY_ORGANIZATION );
    //         });
    //     }
    // }
}
