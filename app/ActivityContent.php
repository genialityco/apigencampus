<?php

namespace App;

use Moloquent;

class ActivityContent extends Moloquent
{
    protected $table = 'activity_contents';

    protected $fillable = [
        'type', // To fitler the content
        'reference', // According the type, this value can be link, ID, url, etc.
    ];
}
