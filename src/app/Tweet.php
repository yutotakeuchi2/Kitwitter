<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Auth;
=======
>>>>>>> 922e604 (ツイート機能の実装)

class Tweet extends Model
{

    public static function addTweet($tweet_text){
        Log::info($tweet_text);
        //return $tweet_text;

        $tweet = new Tweet();
        $tweet->text = strval($tweet_text->sentence);
        if(isset($tweet_text->image)){
        $path = $tweet_text->file('image')->store('public/tweetimage');
        $tweet->content_url = basename($path);
        }
<<<<<<< HEAD
        $tweet->user_id = Auth::user()->id;

        if($tweet->save()){
            $tweets = Tweet::all()->sortByDesc('id');
            return response()->json($tweets);
        }

=======
        $tweet->user_id = 1;

        $tweet->save();
>>>>>>> 922e604 (ツイート機能の実装)
    }

    public static function destroyTweet($tweet_id){
        Tweet::destroy($tweet_id);
        return Tweet::all()->sortByDesc('id');
    }
<<<<<<< HEAD
<<<<<<< HEAD
    // モデルで空欄例外処理　コントローラーで必要な要素だけ分解する　一緒にいろいろ送るときのデータ構造が違った？stringにキャストしたら治った臭い　要確認...
    protected $guarded = ['text', 'content_url'];
=======
=======
>>>>>>> e85be90f75444a34db191953594e1c09ae2be779

    public static function getTweet(){
        $table ='tweets';

        $guarded = array('id');

        $timestamps = false;

            $data = Tweet::all();
            return $data;

<<<<<<< HEAD
>>>>>>> ebadce3 (tweetとtweetconの修正・tweetGet+tweetGet.conは不使用)
=======
>>>>>>> e85be90f75444a34db191953594e1c09ae2be779
}

}