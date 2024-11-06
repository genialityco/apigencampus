<?php

namespace App;
use Moloquent;
use Illuminate\Database\Eloquent\Model;

class Properties extends Moloquent
{
    public $fillable = ['name','required','type'];
}
