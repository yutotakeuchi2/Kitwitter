@extends('layouts.app')

@section('content')

<div class="search-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">ユーザー詳細</div>
                        <div class="card-body" id="user-profile">
                            <h3>{{$tweets['data']->name}}</h3>
                            <?php $user_id = $tweets['data']->id; ?>
                            {{-- よー分らんけどifの中にこれ直接入れるとエラー出るから代入 --}}
                            @if(Auth::user()->isFollow($user_id))
                                <a href="/users/unfollow/{{$user_id}}">フォロー解除する</a>
                            @else
                                <a href="/users/follow/{{$user_id}}">ふぉろーする</a>
                                <button id="follow_button" name="{{$user_id}}">フォローする</button>
                            @endif
                            <a href="/users/follows/{{$user_id}}">フォロー一覧</a>
                            <a href="/users/follower/{{$user_id}}">フォロワー一覧</a>
                        </div>
                        <div class="card-header">Tweets</div>
                            <div class="card-body" id="time-line">
                                @foreach ($tweets['data']->tweets()->orderBy('created_at','desc')->withCount('favorites')->get() as $tweet)
                                    @include('tweet.tweetTemplate', ['tweet' => $tweet, 'date_flag' => 0])
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