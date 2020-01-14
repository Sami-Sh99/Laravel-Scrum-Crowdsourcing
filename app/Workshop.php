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
