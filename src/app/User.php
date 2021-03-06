<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = ['tweets'];


    protected $table = 'users';
    protected $dates = ['deleted_at', 'birthday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isKey', 'biography', 'url', 'birthday'
    ];

    public function tweets() {
        return $this->hasMany('App\Tweet');
    }

    //user_tableとfavorite_tableの一対多のリレーション
    public function favorites(){
        return $this->hasMany('App\Favorite');
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
        $user_data = User::with(['tweets' => function($query){
            $query->withCount('favorites');
        }])->find($user_id);

        return $user_data;
    }



    //フォロー関連のリレーション定義部分

    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'following', 'follow_by');//関係性を定義してる？だからfollowなら自分から見た誰をフォローするかを変数にして...みたいな
    }

    public function keyFollowers()
    {
        return $this->belongsToMany(self::class, 'follow_requests', 'following', 'follow_by');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow_by', 'following'); //やっぱ子のリレーションの関係性と仕組みぱっと出てこんわ　要復習です
    }

    public function keyFollows()
    {
        return $this->belongsToMany(self::class, 'follow_requests', 'follow_by', 'following');
    }

    //フォロー関連の実行/判定メソッド

    public function follow($user_id){
        return $this->follows()->attach($user_id);
    }

    public function keyFollow($user_id){
        return $this->keyFollows()->attach($user_id);
    }

    public function unFollow($user_id){
        return $this->follows()->detach($user_id);
    }

    public function cancelRequest($user_id){
        return $this->keyFollows()->detach($user_id);
    }

    public function isFollow($user_id){
        return (boolean)$this->follows()->where("following", $user_id)->first();
    }

    public function isApplication($user_id){
        return (boolean)$this->keyFollows()->where("following", $user_id)->first();
    }

}
