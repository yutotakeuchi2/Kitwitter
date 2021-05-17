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

}
