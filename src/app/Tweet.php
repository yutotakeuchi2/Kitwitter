<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    public static function addTweet($tweet_text){
        $tweet = new Tweet;
        $tweet->text = $tweet_text;
        $tweet->save();
    }
}
