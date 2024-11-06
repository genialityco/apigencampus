<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Coupon extends MyBaseModel
{
    protected $table = "coupon";
    protected static $unguarded = true;
    protected $dates = ['created_at', 'updated_at'];

}
