<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class PreviewLanding extends MyBaseModel
{
    protected $table = "preview_landing";
    protected static $unguarded = true;
    protected $dates = ['created_at', 'updated_at'];

}