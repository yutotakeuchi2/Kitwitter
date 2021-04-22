<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
        $tweet->user_id = 1;

        if($tweet->save()){
            $tweets = Tweet::all();
            return $tweets;
        }

    }
    // モデルで空欄例外処理　コントローラーで必要な要素だけ分解する　一緒にいろいろ送るときのデータ構造が違った？stringにキャストしたら治った臭い　要確認...
    protected $guarded = ['text', 'content_url'];
}
