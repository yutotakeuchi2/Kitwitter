<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $post_id = $request->post_id;//ajaxで入れたデータ
        Favorite::insertFavorite($user_id, $post_id);
        $fav_count = Favorite::favoriteCount($post_id);
        return response()->json($fav_count);
    }

    public function index(Request $request){

    }
}
