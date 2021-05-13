<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tweet;

class SearchController extends Controller
{
        public function read(Request $request){

        $validateData = $request->validate([
            'keyword' => 'required',
        ]);

        $keyword = $request->input('keyword');
        $searchUserId = User::getUserIds($keyword);
        $searchResults = Tweet::searchTweets($searchUserId,$keyword);
        return view('tweet/search',compact('searchResults'));
    }
}
