<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TweetGet;

class TweetGetController extends Controller
{
    public function tweetGet()
    {
        $tweets = new tweetGet();

        $data = $tweets->getData();

        return view('/index',['data' => $data ]);
    }
}
