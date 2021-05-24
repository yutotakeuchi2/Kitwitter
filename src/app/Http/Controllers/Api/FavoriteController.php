<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Favorite;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $tweet_id = $request->tweet_id;//ajaxで入れたデータ
        if(Favorite::favoriteExist($user_id, $tweet_id)){
            Favorite::destroyFavorite($user_id, $tweet_id);
        }else{
            Favorite::insertFavorite($user_id, $tweet_id);
        }

        $fav_count = Favorite::favoriteCount($tweet_id);
        return response()->json($fav_count);
    }

}
