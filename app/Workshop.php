<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id','created_at','updated_at',
    ];

    public static function createWorkshop($data){
        $workshop =  self::Create($data);
        $workshop->save();
        return $workshop;
    }

    public static function findWorkshopByKey($key){
        return self::where('key',$key)->first();
    }
    
    public static function findAllWorkshopsByFacilitatorId($id){
        return self::where('facilitator_id',$id)->get();
    }

    public function updateWorkshop($data){
        return $this->update($data);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'facilitator_id');
    }


    public function WorkshopDataFilter(){
        $x=$this;
        return [
            "id" => $x->id,
            "facilitator_id" => $x->facilitator_id,
            "title" => $x->title,
            "required_participants" => $x->required_participants,
            "description" => $x->description,
            "is_closed" => $x->is_closed,
            "has_ended" => $x->has_ended,
            "created_at" => $x->created_at->diffForHumans(),
        ];
    }
    
}
