<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //user_tableとfavorite_tableの一対多のリレーション
    //いいねしているユーザー
    public function user(){
        return $this->belongsTo('App\User');
    }

    //tweet_tableとfavorite_tableの一対多のリレーション
    public function tweet(){
        return $this->belongsTo('App\Tweet');
    }

    protected $fillable = ['user_id','tweet_id'];

    public static function insertFavorite($user_id,$tweet_id){
        $favorite = new Favorite();

        $favorite->fill([
                    'user_id'  => $user_id,
                    'tweet_id' => $tweet_id,
                    ]);

        $favorite->save();

        return $favorite;

    }

}
