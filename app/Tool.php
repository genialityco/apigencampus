<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Category Model
 *
 */
class Tool  extends Moloquent
{
    //protected $table = "tools";
    protected $fillable = ['name', 'event_id', 'link'];
    protected $dates = ['created_at', 'updated_at'];
}
