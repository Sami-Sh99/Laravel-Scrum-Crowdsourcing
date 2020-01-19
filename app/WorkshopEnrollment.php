<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopEnrollment extends Model
{
    public $incrementing = false;    
    protected $fillable = ['participant_id','workshop_id'];


    public static function findEnrollmentsByWorkshopId($id){
        return self::where('workshop_id',$id)->get();
    }

}

