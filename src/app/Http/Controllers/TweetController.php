<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function add(Request $request){
        if(Tweet::addTweet($request)){
            return view("/index");
        };
    }
}
