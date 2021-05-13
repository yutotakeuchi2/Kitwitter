<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tweet;

class SearchController extends Controller
{
        public function index(Request $request){//ajaxなど処理だけを行う場合（viewがない場合）はAPIにしたほうがいい　今回はおｋ

        $validateData = $request->validate([
            'keyword' => 'required',
        ]);

        $keyword = $request->input('keyword');
        $searchUserId = User::getUserIds($keyword);
        $searchResults = Tweet::searchTweets($searchUserId,$keyword);
        return view('search/index',compact('searchResults'));
    }
}
