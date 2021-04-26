//$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') } });

$("input").on('click', function () {
  console.log("クリックされました");
})

console.log("読み込みました");
$(document).on('click', '.tweet-button', function () {
  let form_data = new FormData($(".tweet-form").get(0));
  console.log(form_data.get('sentence'));
})


$(document).on('click', '.tweet-button',function () { //そもそもボタンを押してもここから先が読み込めません
  console.log("クリックしました");
  let formData = new FormData($(".tweet-form").get(0));
  $('.tweet-textarea').empty(); //もともとある要素を空にする
  //let tweet = $(".tweet-textarea").val();
  console.log("空にしました");
  //console.log(tweet);

  $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    type: 'post',
    url: '/tweet/store', //後述するweb.phpのURLと同じ形にする
    data: formData, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
    dataType: 'json', //json形式で受け取る
    processData: false,
    contentType: false,
  }).done(function (data) { //ajaxが成功したときの処理
    console.log("成功しました");
    console.log(data);
    //let text = data.original[0].text;
    let html = '';
    //$.each(data, function (index, value) { //dataの中身からvalueを取り出す

      // １ユーザー情報のビューテンプレートを作成
    html = `

      <p>${text}</p>
      <a href="/destroy/${data.original[0].id}">削除</a>
      `

    //})
    $('#time-line2').last().append(html); //できあがったテンプレートをビューに追加
    //$('#time-line').first().append(text);
    console.log("appendしたよ");
    // 検索結果がなかったときの処理
    if (data.length === 0) {
      $('.user-index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
    }

  }).fail(function () {
    //ajax通信がエラーのときの処理
    console.log('どんまい！');
  });
});
