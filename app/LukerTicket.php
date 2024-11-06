<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class LukerTicket extends MyBaseModel
{
    protected $table = "luker_tickets";
    protected $fillable = [
	'assigned_to',
	'event_id',
	'state',
	'code',
	'ticket_number',
	'is_winner'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->ticket_number = static::getNextIdValue();
        });
    }

    private static function getNextIdValue()
    {
        $lastDocument = static::orderBy('ticket_number', 'desc')->first();
        return $lastDocument ? $lastDocument->ticket_number + 1 : 1;
    }

    public static function rules()
    {
        return [
            'ticket_number' => Rule::unique('luker_tickets')->ignore(static::id()),
        ];
    }
}
