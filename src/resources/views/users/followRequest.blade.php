@extends('layouts.app')

@section('content')


<div class="search-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">フォロワー一覧</div>
                            <div class="card-body" id="time-line">
                                @foreach ($follow_request_data as $data)
                                <div class="tweetLink2">
                                    <div class="tweet-line">
                                        <a href="/users/show/{{$data->id}}">{{$data->name}}</a>
                                        @if($data->isKey == 1)
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        @endif
                                            <button class="follow-list-button" id="accept_follow_button" name="{{$data->id}}">フォローを許可する</button>
                                        @if(Auth::user()->isFollow($data->id))
                                            <button class="follow-list-button" id="unfollow_button" name="{{$data->id}}">フォロー解除する</button>
                                        @elseif(Auth::user()->id == $data->id)

                                        @else
                                            <button class="follow-list-button" id="follow_button" name="{{$data->id}}">フォローする</button>
                                        @endif
                                    </div>
                                </div>
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