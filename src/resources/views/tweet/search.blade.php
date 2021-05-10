@extends('layouts.app')

@section('content')


<div class="search-wrapper">

    <h1>検索結果</h1>

    <div class="card">
        <div class="card-header">タイムライン</div>
            <div class="card-body" id="time-line">
                @foreach($searchResults as $searchResult)
                    <div class="tweet-line">
                        <p class="username-font">User : {{$searchResult->user->name}}</p>
                        <p>{{$searchResult->text}}</p>
                            @if(isset($searchResult->content_url))
                                @if ($searchResult->content_extension == "image")
                                    <img src="{{ asset('storage/tweetimage/' . $searchResult->content_url) }}" class="image-size">
                                @elseif ($d->content_extension == "video")
                                    <video src="{{ asset('storage/tweetimage/' . $searchResult->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                                @endif
                            @endif
                        <p class="delete"><a href="/destroy/{{$searchResult->id}}">削除</a></p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection