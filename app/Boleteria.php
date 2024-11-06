<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Boleteria extends MyBaseModel
{
    protected $fillable = [
	'name',
	'event_id',
	//'datetime_from',
	//'datetime_to',
	//'event_id',
	//'iva_in', //Especifica en donde va el IVA, includo en el precio o añadido
	//'iva_percentage',
	'states_sales', // String: Venta | Abierta | Cerrrada
	//'min_tickets_per_user', // Number
	'ticket_sale_limit', // Number: 0 puede comprar los que quiera
	//'valid_age', // Number
	'list_landing', // Boolean
	//'range_prices_landing', // Boolean
	//'ticket_capacity', // Number: Aforo de personas/tickets
	//'capacity_is_active' // Boolean
    ];

    protected $table = 'boleterias';

    protected $dates = ['created_at', 'updated_at'];
    //protected static $unguarded = true;
}
