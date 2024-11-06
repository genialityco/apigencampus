<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class BurnedTicket extends MyBaseModel
{
    protected $table = "burned_tickets";
    protected $fillable = [
	'state', // String: ACTIVE | CANCEL | USED
	'code', // String: Identificador de 6 caracteres
	'billing_id', // String: Identificador de factura relacionada
	'ticket_category_id', // String: Identificador de categoria
    ];

    protected static $unguarded = true;

    protected $dates = ['created_at', 'updated_at'];

    protected $with = ["user","ticketCategory", "billing"];

    public function user()
    {
        return $this->belongsTo('App\Account');
    }

    public function ticketCategory()
    {
        return $this->belongsTo('App\TicketCategory');
    }

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }
}
