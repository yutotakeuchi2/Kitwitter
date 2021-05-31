<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tweet;
use App\Favorite;

class SearchController extends Controller
{
        public function index(Request $request){//ajaxなど処理だけを行う場合（viewがない場合）はAPIにしたほうがいい　今回はおｋ

        $validateData = $request->validate([
            'keyword' => 'required',
        ]);
        $tweets = [];

        $keyword = $request->input('keyword');
        $searchUserId = User::getUserIds($keyword);
        $data = Tweet::searchTweets($searchUserId,$keyword);
        $favorite_model = new Favorite;

        $tweets = [
                        'data' => $data,
                        'favorite_model' => $favorite_model,
        ];
        return view('test',compact('tweets'));
        return view('search/index',compact('tweets'));

    }
}
