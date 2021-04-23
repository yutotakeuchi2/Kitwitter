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
                        <form method="post" action="/tweet/store" class="tweet-form" enctype="multipart/form-data" id="tweet-form">
                              {{ csrf_field() }}
                              <textarea name="sentence" type="text" class="tweet-textarea" cols="20"></textarea>
                              <input type="file" class="tweet-image" name="image">
                              <input type="submit" class="tweet-button" value="ツイートする">
                        </form>
                  </div>

                  <div class="card">
                  <div class="card-header">タイムライン</div>
                  <div class="card-body">
                        @foreach($data as $d)
                        <p>{{$d->text}}</p>
                        @if(isset($d->content_url))
                        <img src="{{ asset('storage/tweetimage/' . $d->content_url) }}">
                        @endif
                        <a href="/destroy/{{$d->id}}">削除</a>
                        @endforeach
                  </div>
                  </div>
            </div>
      </div>
      {{--
      <form class="form-inline">
      <div class="form-group">
      <input type="search" class="form-control mr-sm-2" name="search"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
      </div>
      <input type="submit" value="検索" class="btn btn-info">
      </form>
      --}}
</div>
@endsection