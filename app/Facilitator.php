<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facilitator extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['user_id'];
}
