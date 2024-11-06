<?php

namespace App;

use Moloquent;

class Module extends Moloquent
{
    protected $table = "modules";

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function activities()
    {
        return $this->belongsToMany('App\Activities');
    }

    protected $fillable = [
        "module_name",
        "order",
    ];
}
