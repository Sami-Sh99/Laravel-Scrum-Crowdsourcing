<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id'];


    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
    

}
