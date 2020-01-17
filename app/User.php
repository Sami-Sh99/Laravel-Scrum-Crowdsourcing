<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Fname', 'Lname', 'email', 'password', 'role', 'photo_link', 'is_verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','is_deactivated',
    ];

    public function hasRole(string $role): bool
    {
        return $this->role == $role ? true : false;
    }


    public function UserDataFilter(){
        $x=$this;
        return [
            "id" => $x->id,
            "email" => $x->email,
            "Fname" => $x->Fname,
            "Lname" => $x->Lname,
            "role" => $x->role,
            "photo_link" => $x->photo_link,
            "is_verified" => $x->is_verified,
            "created_at" => $x->created_at->diffForHumans(),
        ];
    }



    public static function findByEmail($email){
        return self::where('email', $email)->first();
    }

    public function saveUser(){
        $this->save();
    }


}
