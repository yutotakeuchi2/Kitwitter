@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">退会手続き</div>
        <div class="card-body">
            <div>
                <p>User：{{ $user->name }}</p>
            </div>
            <div>
                <h2>アカウントが削除されます</h2>
                <p>※kitwitterアカウントの削除プロセスを開始します。今後は、本アカウントの利用ができなくなります。</p>
                <p>※アカウントの復活はいつでも可能です。</p>
            </div>
            <div>
                <input type="submit" value="アカウント削除">
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection