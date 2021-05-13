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
        $data = Tweet::destroyTweet($tweet_id);
        return view("/tweet/index", compact("data"));
    }

    public function index()
    {
        $tweets = new Tweet();

        $data = $tweets->getTweet();

        return view('/tweet/index',['data' => $data ]);
    }



    public function show($id)
    {
        $tweet_data = Tweet::getOneTweet($id);
        return view('/tweet/show', compact('tweet_data'));
    }

}