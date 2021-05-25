<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Favorite;

class UsersController extends Controller
{

    //userデータの取得と編集
    public function edit() {
        return view('users.edit', ['user' => Auth::user() ]);
    }

    //userデータの保存
    public function update(Request $request) {

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'isKey' => 'required|numeric|between:0,1'
        ]);


        $user_form = $request->all();

        $user = Auth::user();
        //return view('/test',compact('user'));
        //不要な「_token」の削除
        unset($user_form['_token']);
        //保存
        $user->fill($user_form)->save();
        //リダイレクト
        return redirect('/tweet/index');
    }

    public function show($id){
        $tweets = [];
        $data = User::getUserData($id);
        $favorite_model = new Favorite;
        $tweets = [
                        'data' => $data,
                        'favorite_model' => $favorite_model,
        ];

        //return view("/test", compact('tweets'));
        return view('users/show',compact('tweets'));
    }

    public function destroy(){
        return view('users.destroy', ['user' => Auth::user() ]);
    }
}
