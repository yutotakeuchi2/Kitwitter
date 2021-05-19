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
        $tweet->text = e(strval($formData->sentence));
        if(null !== $formData->image){
        $path = $formData->file('image')->store('public/tweetimage');
        $tweet->content_url = basename($path);
        $content_types = explode("/", mime_content_type("$formData->image"));
        $tweet->content_extension = $content_types[0];
        }
        if(isset(Auth::user()->id)){
            $tweet->user_id = Auth::user()->id;
        }


        if($tweet->save()){//saveの戻り値に保存した情報が入ってるのでは？？？？？？？？？？保存→戻り値のidで再検索　関数化してしまえばツイート表示にも適用できる
            return response()->json(self::getOneTweet($tweet->id));

        }

    }

    public static function destroyTweet($tweet_id){
        Tweet::destroy($tweet_id);
        return Tweet::all()->sortByDesc('id');
    }

    // モデルで空欄例外処理　コントローラーで必要な要素だけ分解する　一緒にいろいろ送るときのデータ構造が違った？stringにキャストしたら治った臭い　要確認...
    protected $guarded = ['text', 'content_url'];

    protected $table ='tweets';

    public $timestamps = true;

    public static function getTweet(){
            $data = Tweet::withCount('favorites')->orderBy('created_at','desc')->get();
            return $data;

}

    public static function getOneTweet($id){
        // $return_tweet = Tweet::with('user')->find($id);//findだとコレクションの構造が違い共通テンプレートで表示するのに不便なため、wheregetを使用
        $return_tweet = Tweet::withCount('favorites')->with('user')->find($id);
        return $return_tweet;
    }

    public static function searchTweets($userIds, $keyword){
        $tweets = Tweet::withCount('favorites')->whereIn('user_id', $userIds)->orWhere('text', 'like', "%$keyword%")->get()->sortByDesc('created_at');
        return $tweets;
    }

protected $fillable = ['text'];

public function user() {

    return $this->belongsTo('App\User');
}

//tweet_tableとfavorite_tableの一対多のリレーション
public function favorites(){
    return $this->hasMany('App\Favorite');
}



}