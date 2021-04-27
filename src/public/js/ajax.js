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
  $('.tweet-textarea').val(""); //もともとある要素を空にする
  $('tweet-image').val("");
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
    console.log(data.original[0]);
    let text = data.original[0].text;
    let extension = data.original[0].content_extension;
    let html = '';
    //$.each(data, function (index, value) { //dataの中身からvalueを取り出す

    if (!extension) {
      html = `
      <p>${text}</p>
      <a href="/destroy/${data.original[0].id}">削除</a>
      `
    } else if(extension == "jpg" || extension == "png") {
      html = `
      <p>${text}</p>
      <img src="../storage/tweetimage/${data.original[0].content_url}" class="image-size">
      <a href="/destroy/${data.original[0].id}">削除</a>
      `
    } else {
      html = `
      <p>${text}</p>
      <video src="../storage/tweetimage/${data.original[0].content_url}" autoplay muted class="image-size">
      <a href="/destroy/${data.original[0].id}">削除</a>
      `
    }
    //})
    $('#time-line2').append(html); //できあがったテンプレートをビューに追加
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
