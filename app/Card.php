<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'participant_id','content','workshop_id',
    ];

    public static function getCardById($id){
        return self::where('id',$id)->first();
    }

    public static function getCard($workshop_id,$participant_id){
        return self::where(['workshop_id'=> $workshop_id,'participant_id'=>$participant_id])->first();
    }

    public static function countCards($workshop_id){
        return self::where('workshop_id', '=', $workshop_id)->count();
    }

    public static function getCardsByWorkdshopInRandom($workshop_id){
        return self::where('workshop_id', '=', $workshop_id)->inRandomOrder()->get();
    }

    public static function createCard($workshop_id,$participant_id,$content){
        $card= self::Create([
            'participant_id'=>$participant_id,
            'workshop_id'=>$workshop_id,
            'content'=>$content,
        ]);
        $card->save();
    }
}
