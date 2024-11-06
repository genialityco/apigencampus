<?php

namespace App;
use Moloquent;
use App\Event;
use App\SectionTypes;


class ContentTypes extends Moloquent
{

    protected $with = ['section'];
    protected $hidden = ['section_id','event_id','_id'];
    protected $fillable = ['section_id','event_id','_id','value'];


    /**
     * The event associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    
        /**
     * The event associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function section()
    {
        return $this->belongsTo('App\SectionTypes');
    }
}
