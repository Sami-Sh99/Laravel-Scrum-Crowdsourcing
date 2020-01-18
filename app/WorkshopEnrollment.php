<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopEnrollment extends Model
{
    public $incrementing = false;    
    protected $fillable = ['participant_id','workshop_id'];
}