@extends('layouts.app')

@section('content')


<div class="search-wrapper">

    <h1>検索結果</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">ユーザー詳細</div>
                        <div class="card-body" id="user-profile">
                          <h3>なまえ</h3>
                          {{$bool}}
                        {{-- {{$searchUserId}} --}}

                        </div>
                        <div class="card-body" id="time-line">

                          <div class="tweet-line">
                            <h4>Tweet一覧</h4>
                            <p class="username-font">User : なまえ</p>
                              <p>本文</p>

                            <p class="delete"><a href="#">削除</a></p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
