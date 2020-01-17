<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facilitator extends Model
{
    public $timestamps = false;
    public $incrementing = false;    
    protected $fillable = ['id'];


    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }

    public static function findById($id){
        return self::findOrFail($id);
    }

}

