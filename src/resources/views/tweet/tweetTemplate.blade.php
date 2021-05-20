<div class="tweetLink" >
    <div id="{{$tweet->id}}">
        <div class="tweet-line">
            <p class="username-font">User : <a href="/users/show/{{$tweet->user_id}}>">{{$tweet->user->name}}</a></p>
            <p>{{$tweet->text}}</p>
            @if(isset($tweet->content_url))
                @if ($tweet->content_extension == "image")
                    <img src="{{ asset('storage/tweetimage/' . $tweet->content_url) }}" class="image-size">
                @elseif ($tweet->content_extension == "video")
                    <video src="{{ asset('storage/tweetimage/' . $tweet->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                @endif
            @endif
            <p class="delete"><a href="/destroy/{{$tweet->id}}">削除</a></p>
        </div>
    </div>
</div>
<div>
    @if(Auth::check())
    @if($tweets['favorite_model']->favoriteExist(Auth::user()->id,$tweet->id))
    <p class="favorite-mark"></p>
            <a href="#" data-postid="{{$tweet->id}}" class="favorite-button doneFav"><i class="fas fa-heart fa-2x my-pink"></i></a>
                        <span id="favoriteCount">{{$tweet->favorites_count}}</span>
    </p>
    @else
    <p class="favorite-mark"></p>
            <a href="#" data-postid="{{$tweet->id}}" class="favorite-button "><i class="fas fa-heart fa-2x my-pink"></i></a>
                        <span id="favoriteCount">{{$tweet->favorites_count}}</span>
    </p>
    @endif
    @else
    <p class="favorite-mark"></p>
            <a href="#" data-postid="{{$tweet->id}}" class="favorite-button "><i class="fas fa-heart fa-2x my-pink"></i></a>
                        <span id="favoriteCount">{{$tweet->favorites_count}}</span>
    </p>
    @endif
</div>

