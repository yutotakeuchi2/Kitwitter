<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class Tweet extends Model
{

    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

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
        return Tweet::withCount('favorites')->orderBy('id', 'desc')->get();
    }

    // モデルで空欄例外処理　コントローラーで必要な要素だけ分解する　一緒にいろいろ送るときのデータ構造が違った？stringにキャストしたら治った臭い　要確認...
    protected $guarded = ['text', 'content_url'];

    protected $table ='tweets';

    public $timestamps = true;

    public static function getTweet(){


        $data = Tweet::with('user')->withCount('favorites')->whereHas('user', function($query){
            $query->where('isKey', 0);
        })->orWhere('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        //$tweets = Tweet::exclusionKeyAccount(Auth::user(), $data);
        return $data;

}

    public static function getOneTweet($id){
        // $return_tweet = Tweet::with('user')->find($id);//findだとコレクションの構造が違い共通テンプレートで表示するのに不便なため、wheregetを使用

        $return_tweet = Tweet::withCount('favorites')->with('user')->find($id);

        return $return_tweet;
    }

    public static function searchTweets($userIds, $keyword){
        $tweets = Tweet::withCount('favorites')->whereIn('user_id', $userIds)->orWhere('text', 'like', "%$keyword%")->get()->sortByDesc('created_at');
        $data = Tweet::exclusionKeyAccount(Auth::user(), $tweets);
        return $data;
    }

protected $fillable = ['text'];

public function user() {

    return $this->belongsTo('App\User');
}

//tweet_tableとfavorite_tableの一対多のリレーション
public function favorites(){
    return $this->hasMany('App\Favorite');
}

public static function exclusionKeyAccount ($user, $tweets){
    $open_tweets = $tweets->where('user_id', $user->id);
    $key_tweets = $tweets->where('user.isKey', 0);
    if(!$key_tweets->isEmpty()){
        $open_tweets->combine($key_tweets);
    }
    return $open_tweets;
}


}