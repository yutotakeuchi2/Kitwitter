<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    public function store(Request $request){
        if(Tweet::addTweet($request)){ //本来はコントローラーで保存する要素の制限をする→データの抽出
         return view("/test",compact("request"));
        };
        //$tweet_text = Tweet::addTweet($request);
        //return view("/test",compact("tweet_text"));
    }

    public function add(){
        return view("tweet/add");
    }
}
