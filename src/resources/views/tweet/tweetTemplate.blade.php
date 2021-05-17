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
                              window.location.href= "/tweet/show/"+$(this).find('div').attr('id');
                        });
                  });
            </script>
      </div>
</div>