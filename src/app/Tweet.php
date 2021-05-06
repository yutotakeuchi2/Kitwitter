<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Auth;

class Tweet extends Model
{

    public static function addTweet($formData){
        Log::info($formData);
//return $formData;

        $tweet = new Tweet();
        //$tweet->text = strval($tweet_text->sentence);
        //if ($formData->sentence === null){
       //     $formData->sentence = " ";　これはやばい
        //}
        $tweet->text = e(strval($formData->sentence));
        if(null !== $formData->image){
        $path = $formData->file('image')->store('public/tweetimage');
        $content_extension = $formData->file("image")->getClientOriginalExtension();
        $tweet->content_url = basename($path);
        $tweet->content_extension = $content_extension;
        }
        if(isset(Auth::user()->id)){
            $tweet->user_id = Auth::user()->id;
        }


        if($tweet->save()){
            //$tweets = Tweet::find($tweet->id)->get();
            //return $tweets;
            $return_tweet = Tweet::with('user')->orderBy("id", "desc")->first();
            return response()->json($return_tweet);
        }

    }

    public static function destroyTweet($tweet_id){
        Tweet::destroy($tweet_id);
        return Tweet::all()->sortByDesc('id');
    }

    // モデルで空欄例外処理　コントローラーで必要な要素だけ分解する　一緒にいろいろ送るときのデータ構造が違った？stringにキャストしたら治った臭い　要確認...
    protected $guarded = ['text', 'content_url'];

    protected $table ='tweets';

    //protected $guarded = array('id');

    public $timestamps = true;

    public static function getTweet(){
        //$table ='tweets';

       // $guarded = array('id');

        //$timestamps = false;

            $data = Tweet::all();
            return $data;

}

protected $fillable = ['text'];

public function user() {
    return $this->belongsTo('App\User');
}

}