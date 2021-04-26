//$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') } });

$("input").on('click', function () {
  console.log("クリックされました");
})

console.log("読み込みました");

$(document).on('click', '.tweet-button',function () { //そもそもボタンを押してもここから先が読み込めません
  console.log("クリックしました");


  $('.tweet-textarea').empty(); //もともとある要素を空にする
  console.log("空にしました");
  console.log($('.tweet-textarea').val());
  //let userName = $('#search_name').val(); //検索ワードを取得

  $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    type: 'post',
    url: '/tweet/store', //後述するweb.phpのURLと同じ形にする
    data: {
      'tweet':1 //$('.tweet_form').val(), //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
    },
    dataType: 'json', //json形式で受け取る
  }).done(function (data) { //ajaxが成功したときの処理
    let html = '';
    $.each(data, function (index, value) { //dataの中身からvalueを取り出す
      //ここの記述はリファクタ可能
      let sentence = value.sentence;
      let image = value.content_url;
      let id = value.id;
      // １ユーザー情報のビューテンプレートを作成
      html = `

                        <p>sentence</p>
                        @if(isset(image))
                        <img src="{{ asset('storage/tweetimage/' . $d->content_url) }}">
                        @endif
                        <a href="/destroy/#{id}">削除</a>

                                `
    })
    $('.card-body').append(html); //できあがったテンプレートをビューに追加
    // 検索結果がなかったときの処理
    if (data.length === 0) {
      $('.user-index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
    }

  }).fail(function () {
    //ajax通信がエラーのときの処理
    console.log('どんまい！');
  });
});
