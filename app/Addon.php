<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Addon extends MyBaseModel
{
    protected $table = "addons";
    protected static $unguarded = true;
    protected $dates = ['created_at', 'updated_at'];

    //protected $with = ['user'];

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

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function billing()
    {
        return $this->belongsTo('App\Billing', 'billing_id');
    }
}