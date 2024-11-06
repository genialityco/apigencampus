<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class TemplateBingo extends MyBaseModel
{
    protected $table = 'templates_bingo';
    protected $dates = ['created_at', 'updated_at'];
    
    protected $fillable = [
        'title',
        'format',
        'image',
        'index_to_validate',
        'category'
    ];

}
