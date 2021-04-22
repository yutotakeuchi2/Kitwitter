<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\TweetGet;

class TweetController extends Controller
{
    public function add(Request $request){
        if(Tweet::addTweet($request)){
            return view("/index");
        };
    }

    public function tweetGet()
    {
        $tweets = new Tweet();

        $data = $tweets->getTweet();

        return view('/index',['data' => $data ]);
    }

}
