@extends('layouts.app')

@section('content')


<div class="search-wrapper">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                        <div class="card-header">Tweet</div>
                        <div class="card-body" id="time-line">
                        {{-- <div class="tweet-line">
                            <p class="username-font">User :<a href="/users/show/{{$tweets->user_id}}>"> {{$tweets->user->name}}</a></p>
                            <p>{{$tweets->text}}</p>
                            @if(isset($tweets->content_url))
                                @if ($tweets->content_extension == "image")
                                <img src="{{ asset('storage/tweetimage/' . $tweets->content_url) }}" class="image-size">
                                @elseif ($tweets->content_extension == "video")
                                <video src="{{ asset('storage/tweetimage/' . $tweets->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                            @endif
                            @endif
                            <p class="delete"><a href="/destroy/{{$tweets->id}}">削除</a></p>
                        </div> --}}
                        @include('tweet.tweetTemplate', ['tweet'=> $tweet])
                        <p class="mt-5">{{$tweet->created_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection