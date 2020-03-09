<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [
        'id','created_at','updated_at',
    ];

    public static function createGroup($data){
        $group =  self::Create($data);
        $group->save();
        return $group;
    }

    public static function findGroupById($id){
        return self::where('id',$id)->first();
    }
    
    public static function findAllGroupsByWorkshopId($id){
        return self::where('workshop_id',$id)->get();
    }

    public function updateGroup($data){
        return $this->update($data);
    }
    public function card()
    {
        return $this->belongsTo('App\Card', 'card_id');
    }

    // public function GroupDataFilter(){
    //     $x=$this;
    //     return [
    //         "id" => $x->id,
    //         "facilitator_id" => $x->facilitator_id,
    //         "title" => $x->title,
    //         "required_participants" => $x->required_participants,
    //         "description" => $x->description,
    //         "is_closed" => $x->is_closed,
    //         "has_ended" => $x->has_ended,
    //         "created_at" => $x->created_at->diffForHumans(),
    //     ];
    // }
}
