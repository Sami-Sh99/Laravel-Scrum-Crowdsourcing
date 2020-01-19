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

    public static function isParticipantEnrolled($wid, $pid){
        $res = self::where(['workshop_id' => $wid, 'participant_id' => $pid])->first();
        return $res ? true : false;
    }

    public static function addWorkshopEnrollment($data){
return self::create($data);
    }


    public function findEnrolledParticipant($id){
        return $this->where('participant_id',$id)->first();
    }

}

