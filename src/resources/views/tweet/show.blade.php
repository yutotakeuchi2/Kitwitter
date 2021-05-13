@extends('layouts.app')

@section('content')


<div class="search-wrapper">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                        <div class="card-header">Tweet</div>
                        <div class="card-body" id="time-line">
                          <div class="tweet-line">
                            <p class="username-font">User :<a href="/users/show/{{$tweet_data->user_id}}>"> {{$tweet_data->user->name}}</a></p>
                              <p>{{$tweet_data->text}}</p>
                              <p class="mt-5">{{$tweet_data->created_at}}</p>
                              @if(isset($tweet_data->content_url))
                                @if ($tweet_data->content_extension == "image")
                                  <img src="{{ asset('storage/tweetimage/' . $tweet_data->content_url) }}" class="image-size">
                                @elseif ($tweet_data->content_extension == "video")
                                  <video src="{{ asset('storage/tweetimage/' . $tweet_data->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                              @endif
                              @endif
                            <p class="delete"><a href="/destroy/{{$tweet_data->id}}">削除</a></p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection