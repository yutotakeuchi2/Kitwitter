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
                            <div class="account-restore-select">
                            <form action="/users/restore/{{$user->id}}" method="post">
                            @csrf
                            <input type="hidden" name="email" value="{{$request->email}}" >
                            <input type="hidden" name="password" value="{{$request->password}}" >
                            <input type="submit" class="restore-btn-margin" value="復帰">
                            </form>
                            </div>

                            <p class="account-restore-position"><a href="/" >TOPへ戻る</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection