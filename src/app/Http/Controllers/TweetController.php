<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    public function store(Request $request){
        $data = Tweet::addTweet($request);//本来はコントローラーで保存する要素の制限をする→データの抽出
        return view("/index",compact("data"));

        //$tweet_text = Tweet::addTweet($request);
        //return view("/test",compact("tweet_text"));
    }

    public function add(){
        return view("tweet/add");
    }

    public function destroy($tweet_id){
        $data = Tweet::destroyTweet($tweet_id);
        return view("/index", compact("data"));
    }
}
