<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Millionaire extends MyBaseModel
{
  protected $fillable = [
    'name',
    'number_of_questions',
    'number_of_stages', // number of stages
    'time_per_question',
    'rules',
    'event_id',
    'appearance',
    'stages',
    'questions',
  ];

  public function event()
  {
    return $this->belongsTo('App\Event');
  }
}
