<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop_session extends Model
{
    protected $fillable = [
        'workshop_id','done','round',
    ];

    public static function createSession($id){
        $session =  self::Create($id);
        $session->save();
        return $session;
    }
    public static function incrementSession($id){
        $session=self::where('workshop_id',$id);
        $session->done=$session->done + 1;
        $session->save();
        return 1;
    }
}
