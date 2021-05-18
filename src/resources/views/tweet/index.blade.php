@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">ホーム</div>

            <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

            ようこそ、kitwitterへ！今、何してる？
            </div>
            </div>

            <div class="tweet-wrapper card">
                    <h1>Tweet</h1>
                    <form method="post" action="/tweet/store" class="tweet-form" enctype="multipart/form-data" id="tweetForm">
                        {{ csrf_field() }}
                        <textarea name="sentence" type="text" class="tweet-textarea" id="tweet-textarea" cols="20"></textarea>
                        <input type="file" accept="image/*,video/*" class="tweet-image" id="tweet-image" name="image">
                        <input type="button" class="tweet-button" id="tweetButton" value="ツイートする">
                    </form>
            </div>

<div class="card">
        <div class="card-header">タイムライン</div>
            <div class="card-body" id="time-line">
                    @foreach($tweets as $tweet)



                        @include('tweet.tweetTemplate', ['tweet' => $tweet])
                        <a href="#" data-postid="{{$tweet->id}}" class="favoriteButton"><i class="fas fa-heart fa-2x my-pink"></i></a>
            <span id="favoriteCount"></span>
                        @endforeach
                </div>
            </div>
        </div>
</div>
</div>

</div>
@endsection