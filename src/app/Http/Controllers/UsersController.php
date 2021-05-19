<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    //下記を追加

    //userデータの取得
    public function index() {

        return view('users.index', ['user' => Auth::user() ]);
    }
    //userデータの編集
    public function edit() {
        return view('users.edit', ['user' => Auth::user() ]);

        //return view('users.index', ['user' => User::user() ]);
    }

    //userデータの保存
    public function update(Request $request) {

        $user_form = $request->all();

        $user = Auth::user();
        //不要な「_token」の削除
        unset($user_form['_token']);
        //保存
        $user->fill($user_form)->save();
        //リダイレクト
        return redirect('/index');
    }

    public function show($id){
        $tweets = User::getUserData($id);
        //return view("/test", compact('tweets'));
        return view('users/show',compact('tweets'));
    }
}
