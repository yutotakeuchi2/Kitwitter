@extends('layouts.app')

@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー登録内容</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <div>
                            <p class="form-control">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <div>
                            <p class="form-control">{{ $user->email }}</p>
                        </div>
                    </div>
                        <a href="{{ action('UsersController@edit') }}"><button class="user-btn">ユーザー登録内容の編集</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection