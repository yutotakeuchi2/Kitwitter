<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Auth;

class Tweet extends Model
{

    public static function addTweet($tweet_text){
        Log::info($tweet_text);
//return $tweet_text;

        $tweet = new Tweet();
        //$tweet->text = strval($tweet_text->sentence);
        $tweet->text = strval($tweet_text->tweet);
        if(isset($tweet_text->image)){
        $path = $tweet_text->file('image')->store('public/tweetimage');
        $content_extension = $tweet_text->file("image")->getClientOriginalExtension();
        $tweet->content_url = basename($path);
        $tweet->content_extension = $content_extension;
        }
        if(isset(Auth::user()->id)){
            $tweet->user_id = Auth::user()->id;
        }


        if($tweet->save()){
            $tweets = Tweet::where("text", $tweet_text->tweet)->get();
            //return $tweets;
            return response()->json($tweets);
        }

    }

    public static function destroyTweet($tweet_id){
        Tweet::destroy($tweet_id);
        return Tweet::all()->sortByDesc('id');
    }
<<<<<<< HEAD
<<<<<<< HEAD
    // モデルで空欄例外処理　コントローラーで必要な要素だけ分解する　一緒にいろいろ送るときのデータ構造が違った？stringにキャストしたら治った臭い　要確認...
    protected $guarded = ['text', 'content_url'];
<<<<<<< HEAD
=======
=======
>>>>>>> e85be90f75444a34db191953594e1c09ae2be779
=======
>>>>>>> 0e67431 (tweetとtweetconの修正・tweetGet+tweetGet.conは不使用)

    public static function getTweet(){
        $table ='tweets';

        $guarded = array('id');

        $timestamps = false;

            $data = Tweet::all();
            return $data;

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ebadce3 (tweetとtweetconの修正・tweetGet+tweetGet.conは不使用)
=======
>>>>>>> e85be90f75444a34db191953594e1c09ae2be779
=======
>>>>>>> 0e67431 (tweetとtweetconの修正・tweetGet+tweetGet.conは不使用)
}

}