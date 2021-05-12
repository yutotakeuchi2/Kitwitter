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
                            @if($searchResults->isEmpty())
                            <p>検索結果がありません</p>
                            @else
                                @foreach($searchResults as $searchResult)
                                    <div class="tweet-line">
                                        <p class="username-font">User : <a href="/users/show/{{$searchResult->user_id}}">{{$searchResult->user->name}}</a></p>
                                        <p>{{$searchResult->text}}</p>
                                        <p>{{$searchResult->created_at}}</p>
                                            @if(isset($searchResult->content_url))
                                                @if ($searchResult->content_extension == "image")
                                                    <img src="{{ asset('storage/tweetimage/' . $searchResult->content_url) }}" class="image-size">
                                                @elseif ($searchResult->content_extension == "video")
                                                    <video src="{{ asset('storage/tweetimage/' . $searchResult->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                                                @endif
                                            @endif
                                        <p class="delete"><a href="/destroy/{{$searchResult->id}}">削除</a></p>
                                    </div>
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