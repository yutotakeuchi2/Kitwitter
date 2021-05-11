@extends('layouts.app')

@section('content')


<div class="search-wrapper">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">ユーザー詳細</div>
                        <div class="card-body" id="user-profile">
                          <h3>{{$user_data->name}}</h3>
                        </div>
                        <div class="card-header">Tweets</div>
                        <div class="card-body" id="time-line">
                          @foreach ($user_data->tweets()->orderBy('created_at','desc')->get() as $tweet)
                          <div class="tweet-line">
                            <p class="username-font">User : {{$user_data->name}}</p>
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
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection