<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
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

    public static function fillMissing($id){
        try {    
            $c=self::select(DB::raw('count(card_id) as count, card_id'))->where('workshop_id','=',$id)->groupBy('card_id')->get();
            $c=$c->where('count','<',5)->first()->card_id;
            $p=self::select(DB::raw('count(participant_id) as count, participant_id'))->where('workshop_id','=',$id)->groupBy('participant_id')->get();
            $p=$p->where('count','<',5)->first()->participant_id;
        } catch (\Throwable $th) {
            return 0;
        }
        if($c and $p){
            $Score=[
                'participant_id'=>$p,
                'workshop_id'=>$id,
                'card_id'=>$c,
                'score'=>'-1',
            ];
            Score::insert($Score);
            return 1;
        }   
        return 0;
    }
}
