<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\TweetGet;
use App\User;
use App\Favorite;

class TweetController extends Controller
{
    public function store(Request $formData){
        $data = Tweet::addTweet($formData);//本来はコントローラーで保存する要素の制限をする→データの抽出
        return response()->json($data);
    }

    public function destroy($tweet_id){
        Tweet::destroyTweet($tweet_id);
        return back();
        // return view("/tweet/index", compact("tweets"));
    }

    public function index()
    {
        $tweet = [];
        $tweets = new Tweet();
        $data = $tweets->getTweet();
        $favorite_model = new Favorite;
        $tweets = [
                    'data' => $data,
                    'favorite_model' => $favorite_model,
        ];

        //return view('/test',compact('tweets'));
        return view('/tweet/index',compact('tweets'));
    }



    public function show($id)
    {
        $tweets = [];
        $data = Tweet::getOneTweet($id);
        $favorite_model = new Favorite;
        $tweets = [
                        'data' => $data,
                        'favorite_model' => $favorite_model,
        ];
        if(!isset($tweets['data'])){
            return redirect('/tweet/index');
        }
        return view('/tweet/show', compact('tweets'));
    }

}