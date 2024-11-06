<?php

namespace App;
use Moloquent;

class Pending extends Moloquent
{
    protected $fillable = ['event_id','validation_messages'];

}
