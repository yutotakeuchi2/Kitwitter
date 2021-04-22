<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tweet extends Model
{
    public static function addTweet($tweet_text){
        $tweet = new Tweet;
        $tweet->text = $tweet_text;
        $tweet->save();
    }

    public static function getTweet(){
        $table ='tweets';

        $guarded = array('id');

        $timestamps = false;

            $data = Tweet::all();
            return $data;

}

}