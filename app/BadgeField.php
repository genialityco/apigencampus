<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Moloquent;

class BadgeField extends Moloquent
{
    // 
    protected $fillable = ['id_properties', 'line','font_size', 'qr', 'line_qr'];
}
