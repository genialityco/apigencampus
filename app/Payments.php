<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = ['method','amount', 'currency', 'paymentType', 'gateway', 'date', 'resultCode', 'resultDescription', 'gatewayCustomFields', 'status', 'details'];
}
