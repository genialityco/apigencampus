<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class TicketCategory extends MyBaseModel
{
    protected $table = "ticket_categories";
    protected $fillable = [
	'name',
	'color',
	'price',
	'event_id',
	'boleteria_id',
	'ticket_capacity', // Number: Aforo de personas/tickets
	'remaining_tickets' // Cantidad de tickets disponibles
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected $with = ['event'];

    /***
     *
     *  _____  ______ _            _______ _____ ____  _   _  _____
     *  |  __ \|  ____| |        /\|__   __|_   _/ __ \| \ | |/ ____|
     *  | |__) | |__  | |       /  \  | |    | || |  | |  \| | (___
     *  |  _  /|  __| | |      / /\ \ | |    | || |  | | . ` |\___ \
     *  | | \ \| |____| |____ / ____ \| |   _| || |__| | |\  |____) |
     *  |_|  \_\______|______/_/    \_\_|  |_____\____/|_| \_|_____/
     *
     *
     */

    public function event()
    {
        return $this->belongsTo('App\User', 'event_id');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activities', 'activity_id');
    }

    public function burnedTickets()
    {
	return $this->hasMany('App\BurnedTicket');
    }
}
