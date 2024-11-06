<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class CertificationLog extends Moloquent
{
    protected $table = "certification_logs";
    protected $fillable = [
        // "user_id",
        // "event_id",
        "certification_id",
        "approved_from_date",
        "approved_until_date",
        "success",
        "file_url",
        "firestorage_path",
    ];
    public $dates = ["approved_from_date", "approved_until_date"];

    public function user() {
        return $this->belongsTo('App\Account');
    }

    public function certification() {
        return $this->belongsTo('App\Certification');
    }
}