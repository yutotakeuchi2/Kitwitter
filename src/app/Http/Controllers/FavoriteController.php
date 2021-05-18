<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        //return $request;
        $user_id = Auth::user()->id;
        $tweet_id = $request->tweet_id;//ajaxで入れたデータ
        //return $post_id;
        if(Favorite::favoriteExist($user_id, $tweet_id)){
            Favorite::destroyFavorite($user_id, $tweet_id);
        }else{
            Favorite::insertFavorite($user_id, $tweet_id);
        }

        $fav_count = Favorite::favoriteCount($tweet_id);
        return response()->json($fav_count);
    }

    public function index(Request $request){

    }
}
