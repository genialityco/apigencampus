<?php

namespace App;

class WhereIs extends MyBaseModel
{

    protected $table = ('where_is');
    protected $dates = ['created_at', 'updated_at'];


    protected $fillable = [
        'title',
        'event_id',
        'max_time_response',
        'responses',
    ];

}