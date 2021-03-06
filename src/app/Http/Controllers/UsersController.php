<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Favorite;
use App\FollowRequest;

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
        //return view("/test", compact("request"));
        $user = Auth::user();
        if($request->file('profile_image')){
            $path = $request->file('profile_image')->store('public/iconimage');
            $user->profile_image = basename($path);
        }else{
            $user->profile_image = basename("defaulticon.png");
        }
        $user_form = $request->all();



        //return view('/test',compact('user'));
        //不要な「_token」の削除
        unset($user_form['_token']);

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

//ユーザーの論理削除を実行
    public function destroy($id){

        $user_id = Auth::user()->id;

        if($id != $user_id){
            return back();
        }

        $user = User::find($id);
        $user -> delete();
        return redirect('/');
    }

//論理削除後のアカウントの復活
    public function restore($id,Request $request){
        //$request = $request->request;
        //return view('/test',compact('id','request'));
        User::onlyTrashed()->find($id)->restore();
        //Auth::loginUsingId($id);
        Auth::attempt(['email' => $request->email,'password'=>$request->password]);

        return redirect('/tweet/index');

    }

    public function follow($follow_id){
        $user = Auth::user();
        $follow_user = User::getUserData($follow_id);
        if($follow_user->isKey == 1){
            $user->keyFollow($follow_id);
            return "key";
        }else{
        $user->follow($follow_id);
        return "open";
        }
    }

    public function unFollow($user_id){
        $user = Auth::user();
        $user->unFollow($user_id);
        return back();
    }

    public function follows($id){
        $user = User::getUserData($id);
        $follows_data = $user->follows()->get();
        return view("users/follows", compact("follows_data"));
    }

    public function follower($id){
        $user = User::getUserData($id);
        $follower_data = $user->followers()->get();
        return view("users/follower", compact("follower_data"));
    }

    public function followRequests(){
        if(Auth::user()->isKey == 0){
            return back();
        }
        $follow_request_data = Auth::user()->keyFollowers()->get();
        return view("users/followRequest", compact("follow_request_data"));
    }

    // public function isFollow($user_id){
    //     $bool = Auth::user()->isFollow($user_id);
    //     //return view("test", compact("bool"));
    // }

    public function isApplication($user_id){
        $bool = Auth::user()->isApplication($user_id);
    }

    public function acceptFollow($id){
        $user = User::getUserData($id);
        $user->follow(Auth::user()->id);
        FollowRequest::where("follow_by", $id)->where("following", Auth::user()->id)->delete();
    }

    public function cancelRequest($user_id){
        Auth::user()->cancelRequest($user_id);
    }

}
