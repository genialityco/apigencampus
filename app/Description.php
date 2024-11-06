<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Description extends MyBaseModel
{
    protected $table = "description";
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

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }

}