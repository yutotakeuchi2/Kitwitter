<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function tweets() {
        return $this->hasMany('App\Tweet');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getUserIds($user_name) {
        $user_ids = User::where('name', 'like', "%$user_name%")->get()->pluck("id");

        return $user_ids;
    }

    public static function getUserData($user_id){
        $user_data = User::with('tweets')->find($user_id);
        return $user_data;
    }


}
