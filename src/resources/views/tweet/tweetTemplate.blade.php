<div class="tweetLink" >
    <div id="{{$tweet->id}}">
        <div class="tweet-line">
                <img class="tl-icon" src="{{ asset('storage/iconimage/' . $tweet->user->profile_image)}}" alt="">
            <p class="username-font"><a href="/users/show/{{$tweet->user_id}}>">{{$tweet->user->name}}</a></p>
            <p class="tweet-text">{{$tweet->text}}</p>
            @if(isset($tweet->bsimage) && $tweet->content_extension == "image")
                <img src="data:image/png;base64, {{$tweet->bsimage}}" alt="" class="image-size">
            @else
                <img src="data:video/mp4;base64, {{$tweet->bsimage}}" alt="" class="image-size">
            @endif
            @if(isset($tweet->content_url))
                @if ($tweet->content_extension == "image")
                    <img src="{{ asset('storage/tweetimage/' . $tweet->content_url) }}" class="image-size">
                @elseif ($tweet->content_extension == "video")
                    <video src="{{ asset('storage/tweetimage/' . $tweet->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                @endif
            @endif
            @if ($date_flag === 1)
            <p class="mt-5">{{$tweet->created_at}}</p>
            @endif
            @if(Auth::check())
                @if ($tweet->user->id == Auth::user()->id)
                    <p class="delete"><a href="/destroy/{{$tweet->id}}">削除</a></p>
                @endif
            @endif
        </div>
    </div>
</div>
<div class="bottom-line">
    @if(Auth::check())
        @if($tweets['favorite_model']->favoriteExist(Auth::user()->id,$tweet->id))
            <p class="favorite-mark"></p>
                <span  data-postid="{{$tweet->id}}" class="favorite-button doneFav"><i class="fas fa-heart fa-2x my-pink"></i></span>
                <span id="favoriteCount">{{$tweet->favorites_count}}</span>
            </p>
        @else
        <p class="favorite-mark"></p>
                <span data-postid="{{$tweet->id}}" class="favorite-button "><i class="fas fa-heart fa-2x my-pink"></i></span>
                <span id="favoriteCount">{{$tweet->favorites_count}}</span>
            </p>
        @endif
    @else
        <p class="favorite-mark"></p>
            <span data-postid="{{$tweet->id}}" class="favorite-button "><i class="fas fa-heart fa-2x my-pink"></i></span>
            <span id="favoriteCount">{{$tweet->favorites_count}}</span>
        </p>
    @endif
</div>

