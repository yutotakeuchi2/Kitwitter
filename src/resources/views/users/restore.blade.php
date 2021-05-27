@extends('layouts.app')

@section('content')


<div class="search-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                    <div class="card-header">アカウント復帰</div>
                        <div class="card-body" id="user-profile">
                            <h3>このアカウントを復帰しますか？</h3>
                            <h4>{{$user->name}}</h4>
                            <p>アカウントの削除は取り消されます。</p>
                        </div>
                        <div>
                            <a href="/users/restore/{{$user->id}}" class="account-restore-select">はい</a>
                            <a href="/" class="account-restore-select">いいえ(TOPへ戻る)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection