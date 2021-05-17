<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\TweetGet;
use App\User;

class TweetController extends Controller
{
    public function store(Request $formData){
        $data = Tweet::addTweet($formData);//本来はコントローラーで保存する要素の制限をする→データの抽出
        return response()->json($data);
        //$tweet_text = Tweet::addTweet($request);
        //return view("/test",compact("tweet_text"));
    }

    public function destroy($tweet_id){
        $tweets = Tweet::destroyTweet($tweet_id);
        return view("/tweet/index", compact("tweets"));
    }

    public function index()
    {
        $tweets = new Tweet();

        $tweets = $tweets->getTweet();

        return view('/tweet/index',compact('tweets'));
    }



    public function show($id)
    {
        $tweet = Tweet::getOneTweet($id);
        return view('/tweet/show', compact('tweet'));
    }

}