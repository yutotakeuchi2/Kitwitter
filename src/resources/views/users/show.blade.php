@extends('layouts.app')

@section('content')


<div class="search-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">ユーザー詳細</div>
                        <div class="card-body" id="user-profile">
                            <h3>{{$tweets->name}}</h3>
                        </div>
                        <div class="card-header">Tweets</div>
                            <div class="card-body" id="time-line">
                                @foreach ($tweets->tweets()->orderBy('created_at','desc')->get() as $tweet)
                            {{-- <div class="tweet-line">
                            <p class="username-font">User : {{$tweets->name}}</p>
                                <p>{{$tweets->text}}</p>
                                @if(isset($tweets->content_url))
                                @if ($tweets->content_extension == "image")
                                    <img src="{{ asset('storage/tweetimage/' . $tweets->content_url) }}" class="image-size">
                                @elseif ($tweets->content_extension == "video")
                                    <video src="{{ asset('storage/tweetimage/' . $tweets->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                                @endif
                                @endif
                            <p class="delete"><a href="/destroy/{{$tweets->id}}">削除</a>
                            <a href="/tweet/show/{{$tweets->id}}">詳細</a></p>
                            </div> --}}
                                    @include('tweet.tweetTemplate', ['tweet' => $tweet])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection