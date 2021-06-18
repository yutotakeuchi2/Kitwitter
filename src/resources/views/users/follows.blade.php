@extends('layouts.app')

@section('content')


<div class="search-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">フォロー一覧</div>
                            <div class="card-body" id="time-line">
                                @foreach ($follows_data as $data)
                                  <div class="tweetLink">
                                    <div class="tweet-line">
                                      <a href="/users/show/{{$data->id}}">{{$data->name}}</a>
                                      @if(Auth::user()->isFollow($data->id))
                                          <a href="/users/unfollow/{{$data->id}}">フォロー解除する</a>
                                      @else
                                          <a href="/users/follow/{{$data->id}}">ふぉろーする</a>
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