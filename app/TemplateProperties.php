<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Moloquent;

class TemplateProperties extends Moloquent
{
    protected $fillable = [
        'name',
        'user_properties'
    ];
    
   
}