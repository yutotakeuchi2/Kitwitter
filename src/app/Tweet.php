<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Aws\S3\S3Client;
class Tweet extends Model
{

    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    public static function addTweet($formData){
        Log::info($formData);
//return $formData;
        if($formData->sentence == "" && $formData->image == null){
            return "ツイート内容が空です";
        }
        $tweet = new Tweet();
        $tweet->text = e(strval($formData->sentence));
        if(null !== $formData->image){
            $s3client = S3Client::factory([
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
                'region' => 'ap-northeast-1',
                'version' => 'latest',
            ]);
            $bucket = getenv('S3_BUCKET_NAME') ?: die('No "S3_BUCKET_NAME" config var in found in env!');
            $result = $s3client->putObject([
                'ACL' => 'public-read',
                'Bucket' => $bucket,
                'Key' => basename($formData->file('image')),
                'Body' => fopen($formData->image, "r"),
                'ContentType' => mime_content_type("$formData->image"),
            ]);
            $tweet->bsimage = $result['ObjectURL'];
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
        $delete_tweet = Tweet::with('user')->find($tweet_id);
        if($delete_tweet->user->id == Auth::user()->id){
            Tweet::destroy($tweet_id);
        }else{
            return redirect('/tweet/index');
        }
        return;
    }

    // モデルで空欄例外処理　コントローラーで必要な要素だけ分解する　一緒にいろいろ送るときのデータ構造が違った？stringにキャストしたら治った臭い　要確認...
    protected $guarded = ['text', 'content_url'];

    protected $table ='tweets';

    public $timestamps = true;

    public static function getTweet(){
        $follows = Auth::user()->follows()->get()->pluck('id');
        if(Auth::check()){
        $data = Tweet::with('user')->withCount('favorites')->whereIn('user_id', $follows)->orWhere('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        // $data = Tweet::with('user')->withCount('favorites')->whereHas('user', function($query){
        //     $query->where('isKey', 0);
        // })->orWhere('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        //$tweets = Tweet::exclusionKeyAccount(Auth::user(), $data);
        return $data;
        } else {
            $data = Tweet::with('user')->withCount('favorites')->whereHas('user', function($query){
                $query->where('isKey', 0);
            })->orderBy('created_at','desc')->get();
            return $data;
        }

}

    public static function getOneTweet($id){
        // $return_tweet = Tweet::with('user')->find($id);//findだとコレクションの構造が違い共通テンプレートで表示するのに不便なため、wheregetを使用

        $return_tweet = Tweet::withCount('favorites')->with('user')->find($id);

        return $return_tweet;
    }

    public static function searchTweets($userIds, $keyword){
        $tweets = Tweet::withCount('favorites')->whereIn('user_id', $userIds)->orWhere('text', 'like', "%$keyword%")->get()->sortByDesc('created_at');
        if(Auth::check()){
        $data = Tweet::exclusionKeyAccount(Auth::user(), $tweets);
        return $data;
        } else {
        return $tweets;
        }
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
    //return $tweets;
    $open_tweets = $tweets->where('user_id', $user->id);
    $key_tweets = $tweets->where('user.isKey', 0);
    if(!$key_tweets->isEmpty()){
        foreach ($key_tweets as $tweet) {
            $open_tweets->push($tweet);
        }
        //$open_tweets->concat($key_tweets)->sortByDesc('created_at');
    }
    return $open_tweets->unique()->sortByDesc('created_at');
}


}