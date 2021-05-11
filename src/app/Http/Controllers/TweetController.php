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
        //$data2 = $data.sentence;
        return response()->json($data);
        //return view("/index",compact("data"));

        //$tweet_text = Tweet::addTweet($request);
        //return view("/test",compact("tweet_text"));
    }

    public function destroy($tweet_id){
        $data = Tweet::destroyTweet($tweet_id);
        return view("/index", compact("data"));
    }

    public function index()
    {
        $tweets = new Tweet();

        $data = $tweets->getTweet();

        return view('/index',['data' => $data ]);
    }

    public function searchTweet(Request $request){

        $validateData = $request->validate([
            'keyword' => 'required',
        ]);

        $keyword = $request->input('keyword');
        //$query = Tweet::query();
        //search_tweetのなかに入力された値を検索する
        //$query->when($search_tweet, function($query, $search_tweet){
            //return $query ->where('search_tweet','like','% $search_tweet %');
        //})
        //return $query->get();
        $searchUserId = User::getUserIds($keyword);

        //return view('/test', compact('searchUserId'));

        $searchResults = Tweet::searchTweets($searchUserId,$keyword);

        return view('tweet/search',compact('searchResults'));

    }

}