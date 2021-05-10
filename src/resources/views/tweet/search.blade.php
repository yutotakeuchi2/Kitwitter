@extends('layouts.app')

@section('content')


<div class="search-wrapper">

    <h1>検索結果</h1>

    <div class="card">
        <div class="card-header">タイムライン</div>
            <div class="card-body" id="time-line">
                @foreach($data as $d)
                    <div class="tweet-line">
                        <p class="username-font">User : {{$d->user->name}}</p>
                        <p>{{$d->text}}</p>
                            @if(isset($d->content_url))
                                @if ($d->content_extension == "image")
                                    <img src="{{ asset('storage/tweetimage/' . $d->content_url) }}" class="image-size">
                                @elseif ($d->content_extension == "video")
                                    <video src="{{ asset('storage/tweetimage/' . $d->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                                @endif
                            @endif
                        <p class="delete"><a href="/destroy/{{$d->id}}">削除</a></p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection