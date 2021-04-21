@extends('layouts.app')

@section('contents')
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