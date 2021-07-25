@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">ユーザー登録内容の変更</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ '/users/edit' }}">
                <div class="form-group">
                <label for="name">
                    名前
                </label>
                <div>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>
                </div>
                <div class="form-group">
                <label for="email">
                    Eメール
                </label>
                <div>
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                </div>
                </div>
                <div class="form-group">
                    <label for="biography">
                        プロフィール
                    </label>
                    <div>
                        <input type="text" name="biography" class="form-control" value="{{$user->biography}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url">
                        URL
                    </label>
                    <div>
                        <input type="text" name="url" class="form-control" value="{{$user->url}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday">
                        誕生日
                    </label>
                    <div>
                        @if ($user->birthday)
                            <input type="date" name="birthday" class="form-control" value="{{$user->birthday->format("Y-m-d")}}">
                        @else
                            <input type="date" name="birthday" class="form-control">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="profile_image">
                        プロフィール画像
                    </label>
                    <div>
                        <input type="file" name="profile_image" value="{{ asset('storage/iconimage/' . $user->profile_image)}}">
                    </div>
                </div>
                <div class="form-group">
                <label for="key">
                    アカウント公開設定
                </label>
                <div>

                    @if($user->isKey === 1)
                    <input name="isKey" type="hidden" value="0"><input type="checkbox" checked="checked" name="isKey" value="1"><span>非公開</span>
                    @else
                    <input name="isKey" type="hidden" value="0"><input type="checkbox" name="isKey" value="1"><span>非公開</span>
                    @endif
                </div>
                </div>
                <button type="submit" class="user-btn">変更</button>
                {{ csrf_field() }}
            </form>
        </div>
        </div>
        <div class="card">
        <div class="card-header">アカウントの削除</div>
        <div class="card-body">
            <a href="{{url('users/destroy/confirm')}}">アカウントの削除ページ</a>
        </div>
    </div>
    </div>
</div>
</div>
@endsection