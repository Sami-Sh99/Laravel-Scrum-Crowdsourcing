<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop_session extends Model
{
    protected $fillable = [
        'workshop_id','done','round',
    ];

    protected $table='workshop_session';

    public static function createSession($id){
        $session =  self::Create([
            'workshop_id'=>$id,
            'round'=>1,
        ]);
        // $session->workshop_id=$id;
        $session->save();
        return $session;
    }
    public static function incrementSession($id){
        $session=self::where('workshop_id',$id)->first();
        $session->done=$session->done + 1;
        $session->save();
        return $session->done;
    }

    public static function ShuffleReady($id){
        $session=self::where('workshop_id',$id)->first();
        $session->shuffled= true;
        $session->save();
    }

    public static function getSession($id){
        return self::where('workshop_id',$id)->first();
    }

    public static function getRound($id){
        return self::where('workshop_id',$id)->first()->round;
    }

    public static function resetDone($id){
        $session=self::where('workshop_id',$id)->first();
        $session->round=$session->round + 1;
        $session->done= 0;
        $session->save();
        return $session->round;
    }

    public static function initDone($id){
        $session=self::where('workshop_id',$id)->first();
        $session->done= 0;
        $session->save();
        return 0;
    }

    public static function incRound($id){
        $session=self::where('workshop_id',$id)->first();
        $session->round=$session->round + 1;
        $session->save();
        return $session->round;
    }
}
