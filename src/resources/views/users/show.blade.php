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
                                @foreach ($tweets->tweets()->orderBy('created_at','desc')->withCount('favorites')->get() as $tweet)
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