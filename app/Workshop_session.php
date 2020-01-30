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
            'workshop_id'=>$id
        ]);
        // $session->workshop_id=$id;
        $session->save();
        return $session;
    }
    public static function incrementSession($id){
        $session=self::where('workshop_id',$id)->first();
        $session->done=$session->done + 1;
        $session->save();
        return 1;
    }
}
