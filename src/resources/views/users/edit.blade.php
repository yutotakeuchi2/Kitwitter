@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">ユーザー登録内容の変更</div>
        <div class="card-body">
            <form method="POST" action="{{ '/users/edit' }}">
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
            <a href="{{url('users/destroy')}}">アカウントの削除ページ</a>
        </div>
    </div>
    </div>
</div>
</div>
@endsection