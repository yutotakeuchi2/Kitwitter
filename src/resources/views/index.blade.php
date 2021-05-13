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
                        @foreach($data as $d)

                                                            {{--<div  class="tweetLink">
                                                                  <a class="range" href="/tweet/show/{{$d->id}}"></a>--}}
                        <div class="tweetLink" >
                        <div id="{{$d->id}}">
                                                            {{--<button class="range-btn" onfocus="this.blur();" onclick="location.href='/tweet/show/{{$d->id}}'">--}}
                              <div class="tweet-line">
                              <p class="username-font">User : <a href="/users/show/{{$d->user_id}}>">{{$d->user->name}}</a></p>
                              <p>{{$d->text}}</p>
                              @if(isset($d->content_url))
                              @if ($d->content_extension == "image")
                                    <img src="{{ asset('storage/tweetimage/' . $d->content_url) }}" class="image-size">
                              @elseif ($d->content_extension == "video")
                                    <video src="{{ asset('storage/tweetimage/' . $d->content_url)}}" controls playsinline controlsList="nodownload"  class="image-size"></video>
                              @endif
                              @endif
                              <p class="delete"><a href="/destroy/{{$d->id}}">削除</a>
                              <!--<a href="/tweet/show/{{$d->id}}">詳細</a>--></p>
                              </div>
                              <script>
                                    jQuery(function($){
                                          $('.tweetLink').css('cursor','pointer');
                                          $('.tweetLink').on('click',function(){
                                                window.location.href= "tweet/show/"+$(this).find('div').attr('id');
                                          });
                                    });
                              </script>
                                                            {{--</button>--}}
                                                            {{--</div>--}}
                                                            {{--<script type="text/javascript">
                                                            function DivFrameClick() {
                                                                  document.location.href = "/tweet/show/{{$d->id}}";
                                                            };
                                                            </script>--}}
                                                            </div>
                        </div>
                        @endforeach
                        </div>
                  </div>
            </div>
      </div>

</div>
@endsection