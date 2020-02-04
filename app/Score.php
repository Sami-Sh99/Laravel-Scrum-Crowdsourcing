<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable=[
        'participant_id','workshop_id','card_id','score',
    ];

    public static function getNonScoredCardById($workshop_id, $participant_id){
        return self::where('workshop_id', '=', $workshop_id)->where('participant_id','=',$participant_id)->where('score','=','-1')->first();
    }

    public static function countHowManyScored($workshop_id, $participant_id){
        return self::where('workshop_id', '=', $workshop_id)->where('participant_id','=',$participant_id)->where('score','!=','-1')->orWhereNull('score')->count();
    }

    public static function setScore($id, $score){
        return self::where('id',$id)
                ->update([
                    'score' => $score
                    ]);
    }

    public static function getAvgScore($workshop_id,$card_id){
        return self::where(['workshop_id'=>$workshop_id, 'card_id'=>$card_id])->pluck('score')->avg();
    }
}
