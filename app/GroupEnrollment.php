<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupEnrollment extends Model
{
    public $incrementing = false;    
    protected $fillable = ['participant_id','group_id'];


    public static function findEnrollmentsByGroupId($id){
        return self::where('group_id',$id)->get();
    }

    public static function findEnrollmentsByParticipantId($id){
        return self::where('participant_id',$id)->get();
    }

    public static function isParticipantEnrolled($gid, $pid){
        $res = self::where(['group_id' => $gid, 'participant_id' => $pid])->first();
        return $res ? true : false;
    }

    public static function countParticipantsEnrolled($group_id){
        return self::where('group_id', '=', $group_id)->count();
    }

    public static function addGroupEnrollment($data){
        return self::create($data);
    }


    public function findEnrolledParticipant($id){
        return $this->where('participant_id',$id)->first();
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }
}
