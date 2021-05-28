@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
    <div class="card">
        <div class="card-header">退会手続き</div>
        <div class="card-body">
            <div>
                <h2>アカウントが削除されます</h2>
                <p>※kitwitterアカウントの削除プロセスを開始します。今後は、本アカウントの利用ができなくなります。</p>
                <p>※アカウントの復活はいつでも可能です。</p>
            </div>
            <div class="col-5 ">
                <button type="button" class="btn btn-info mb-12" data-toggle="modal" data-target="#destroyModal">アカウント削除</button>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

<div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">削除確認画面</h4>
                </div>
                <div class="modal-body">
                    <label>アカウントを本当に削除しますか？</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">閉じる</button>
                    <form  method="post" action="/users/destroy/{{Auth::user()->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection