@extends('layouts.app')

@section('content')


<div class="search-wrapper">

    <h1>検索結果</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">タイムライン</div>
                        <div class="card-body" id="time-line">
                            @if($tweets->isEmpty())
                            <p>検索結果がありません</p>
                            @else
                                @foreach($tweets as $tweet)
                                    {{-- <div class="tweet-line">
                                        <p class="username-font">User : <a href="/users/show/{{$tweet->user_id}}">{{$tweet->user->name}}</a></p>
                                        <p>{{$tweet->text}}</p>
                                            @if(isset($tweet->content_url))
                                                @if ($tweet->content_extension == "image")
                                                    <img src="{{ asset('storage/tweetimage/' . $tweet->content_url) }}" class="image-size">
                                                @elseif ($tweet->content_extension == "video")
                                                    <video src="{{ asset('storage/tweetimage/' . $tweet->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                                                @endif
                                            @endif
                                        <p class="delete"><a href="/destroy/{{$tweet->id}}">削除</a>
                                        <a href="/tweet/show/{{$tweet->id}}">詳細</a></p>
                                    </div> --}}
                                    @include('tweet.tweetTemplate')
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection