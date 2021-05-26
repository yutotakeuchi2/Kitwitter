<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

public function redirectPath()
    {
        return '/tweet/index';
    }

    //AuthenticatesUsers.phpの記述をオーバーライド
    protected function sendFailedLoginResponse(Request $request){

        $user = User::onlyTrashed()->where('email', $request->email)->first();
            if($user){
                if( Hash::check($request->password,$user->password)){
                    // return view('/test');
                    return view('/users/restore',compact('user'));
                }
            }

        // return view('/test',compact('user_pass'));

        // // ログイン時に入力されたメールアドレスからユーザーを探す
        // $user = User::onlyTrashed()->where('email', $request->email)->get();
        // //     $user = User::where('email', $request->email)->first();
        // //return view('/test',compact('user'));
        // //$user_pass = User::onlyTrashed()->where('password',)
        // if(!$user->isEmpty()){
        //     return view('/users/restore',compact('user'));
        // }

    }
}

