<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class BingoCard extends MyBaseModel
{
  protected $table = "bingo_cards";
  protected $fillable = [
    'event_user_id',
    'event_id',
    'bingo_id',
    'values_bingo_card',
    'code'
  ];

  public function attendee()
  {
    return $this->belongsTo('App\Attendee');
  }
}
