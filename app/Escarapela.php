<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Escarapela extends Moloquent
{
    // 'id_properties', 'line','font_size', 'qr', 'line_qr', 
    protected $fillable = ['fields_id','BadgeFields'];
    protected $with = ['BadgeFields'];

    public function badgeFields()
    {
        return $this->embedsMany('App\BadgeField');
    }
}
    