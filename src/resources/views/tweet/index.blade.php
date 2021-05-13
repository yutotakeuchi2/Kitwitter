@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row justify-content-center">
            <div class="col-md-8">
                  <div class="card">
                  <div class="card-header">ホーム</div>

                  <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                        </div>
                        @endif

                  ようこそ、kitwitterへ！今、何してる？
                  </div>
                  </div>

                  <div class="tweet-wrapper card">
                        <h1>Tweet</h1>
                        <form method="post" action="/tweet/store" class="tweet-form" enctype="multipart/form-data" id="tweetForm">
                              {{ csrf_field() }}
                              <textarea name="sentence" type="text" class="tweet-textarea" id="tweet-textarea" cols="20"></textarea>
                              <input type="file" accept="image/*,video/*" class="tweet-image" id="tweet-image" name="image">
                              <input type="button" class="tweet-button" id="tweetButton" value="ツイートする">
                        </form>
                  </div>

      <div class="card">
            <div class="card-header">タイムライン</div>
                  <div class="card-body" id="time-line">
                        @foreach($tweets as $tweet)

                        <div class="tweetLink" >
                        <div id="{{$tweet->id}}">
                              <div class="tweet-line">
                              <p class="username-font">User : <a href="/users/show/{{$tweet->user_id}}>">{{$tweet->user->name}}</a></p>
                              <p>{{$tweet->text}}</p>
                              @if(isset($tweet->content_url))
                              @if ($tweet->content_extension == "image")
                                    <img src="{{ asset('storage/tweetimage/' . $tweet->content_url) }}" class="image-size">
                              @elseif ($tweet->content_extension == "video")
                                    <video src="{{ asset('storage/tweetimage/' . $tweet->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                              @endif
                              @endif
                              <p class="delete"><a href="/destroy/{{$tweet->id}}">削除</a></p>
                              </div>
                              <script>
                                    jQuery(function($){
                                          $('.tweetLink').css('cursor','pointer');
                                          $('.tweetLink').on('click',function(){
                                                window.location.href= "tweet/show/"+$(this).find('div').attr('id');
                                          });
                                    });
                              </script>
                        </div>
                        </div>
                        @endforeach
                        </div>
                  </div>
            </div>
      </div>

</div>
@endsection