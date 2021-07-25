@extends('layouts.app')

@section('content')

<div class="search-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">ユーザー詳細</div>
                        <div class="card-body" id="user-profile">
                            @if (isset($tweets['data']->profile_image))
                                <img class="profile-icon" src="{{ asset('storage/iconimage/' . $tweets['data']->profile_image)}}" alt="">
                            @else
                                <img class="profile-icon" src="{{ asset('storage/iconimage/' . "defaulticon.png")}}" alt="">
                            @endif
                            <div class="profile-wrapper">
                                <h3 class="profile-name">{{$tweets['data']->name}}</h3>
                                @if($tweets['data']->isKey == 1)
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                @endif
                                <p class="profile-biography">{{$tweets['data']->biography}}</p>
                            </div>
                            <div class="profile-information">
                                @if($tweets['data']->url)
                                    <span class="profile-info"><i class="fa fa-link" aria-hidden="true"></i><a href="{{$tweets['data']->url}}">{{$tweets['data']->url}}</a></span>
                                @endif
                                @if($tweets['data']->birthday)
                                    <span class="profile-info"><i class="fa fa-gift" aria-hidden="true"></i>誕生日:{{{$tweets['data']->birthday->format("Y/m/d")}}}</span>
                                @endif
                            </div>
                            <?php $user_id = $tweets['data']->id; ?>
                            {{-- よー分らんけどifの中にこれ直接入れるとエラー出るから代入 --}}
                            @if (Auth::user())
                                    @if(Auth::user()->isFollow($user_id))
                                        <button class="follow-list-button" id="unfollow_button" name="{{$user_id}}">フォロー解除する</button>
                                    @elseif(Auth::user()->id == $user_id)
                                    {{-- 空白を意味 --}}
                                    @elseif(Auth::user()->isApplication($user_id))
                                        <button class="follow-list-button" id="cancel_request_button" name="{{$user_id}}">申請キャンセル</button>
                                    @else
                                        @if($tweets['data']->isKey == 1)
                                            <button class="follow-list-button" id="follow_button" name="{{$user_id}}">フォロー申請する</button>
                                        @else
                                            <button class="follow-list-button" id="follow_button" name="{{$user_id}}">フォローする</button>
                                        @endif
                                    @endif
                            @else
                                <button id="follow_button" name="{{$user_id}}">フォローする</button>
                            @endif

                            <a class="profile-info" href="/users/follows/{{$user_id}}">フォロー一覧</a>
                            <a class="profile-info" href="/users/follower/{{$user_id}}">フォロワー一覧</a>
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