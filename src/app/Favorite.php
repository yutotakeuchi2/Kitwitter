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

    public static function destroyFavorite($user_id,$tweet_id){
        //すでにfavoriteにuser_id&tweet_idが一致するレコ＾ドがあれば削除
        $favorite = Favorite::where('tweet_id',$tweet_id)
                                ->where('user_id',$user_id)
                                ->delete();
    }

    //すでにいいねされているかの確認
    public static function favoriteExist($id,$tweet_id){

        //Favoriteテーブルのレコードにuser_idとtweet_idが一致するものを取得
        $exist = Favorite::where('user_id','=',$id)
                            ->where('tweet_id','=',$tweet_id)
                            ->get();

        // レコードが存在しないなら
        if($exist->isEmpty()){
            // favoriteテーブルのレコードを削除
            // $exist->delete();
            // $exist = Favorite::where('tweet_id','$tweet_id')
            //                 ->where('user_id','$id')
            //                 ->delete();
            return false;


        // レコードが存在するなら
        } else {
            return true;
            // $this->insertFavorite();
        }

    }

        //いいねされた数の取得
    public static function favoriteCount($tweet_id){
        $favoriteCount = Favorite::where('tweet_id',$tweet_id)->get()->count();
        return $favoriteCount;
    }


}
