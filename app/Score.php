<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable=[
        'participant_id','workshop_id','card_id','score',
    ];
}
