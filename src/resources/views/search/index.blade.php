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
                            @if($tweets['data']->isEmpty())
                            <p>検索結果がありません</p>
                            @else
                                @foreach($tweets['data'] as $tweet)

                                    @include('tweet.tweetTemplate', ['tweet' => $tweet])
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