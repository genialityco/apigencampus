<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Certification extends Moloquent
{
    protected $table = "certifications";
    protected $fillable = [
        "user_id",
        "event_id",
        "description",
        "success",
        "hours",
        "entity",
        "approved_from_date",
        "approved_until_date",
        "file_url",
        "firestorage_path",
    ];
    public $dates = ["approved_from_date", "approved_until_date"];
    public $with = ["certificationLogs"];

    public function user() {
        return $this->belongsTo('App\Account');
    }

    public function certificationLogs() {
        return $this->hasMany('App\CertificationLog');
    }
}