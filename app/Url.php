<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Url extends MyBaseModel
{

    protected $table = ('urls');
    protected $dates = ['created_at', 'updated_at'];


    protected $fillable = [
        'long_url',
        'short_url',
        'code'
    ];

}