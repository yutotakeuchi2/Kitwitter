$(function () {
  $('#tweetButton').on('click', function () {　//classはユニークでない　idはユニークという決まり事　domの処理はidのほうが早い→変なエラー出にくい。処理も早い
    console.log("クリックしました");
    let formData = new FormData($("#tweetForm").get(0));//値が少ないときはvalueで取得して値を自分で配列に入れたほうがわかりやすい、変なデータを送られない対策
    console.log("空にしました");
    sendTweet(formData);

  });
});

function sendTweet(formData) {
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
    initForm();
    console.log(data);
    let text = "";
    if (data.original.text) {//表示の参照でnull/undefindなどで問題が起きたら表示のほうで何とかする
      text = data.original.text;
    }

    let extension = data.original.content_extension;
    let html = '';

    if (!extension) { //テンプレートを利用する場合tagを生成→文字列として要素を入れるという手順を踏まないとセキュリティホールになりうる　、クロススクリプティング
      html = `
      <div class="tweet-line">
      <p>${text}</p>
      <p class="delete"><a href="/destroy/${data.original.id}">削除</a></p>
      </div>
      `
    } else if (extension == "jpg" || extension == "png") {
      html = `
      <div class="tweet-line">
      <p>${text}</p>
      <img src="../storage/tweetimage/${data.original.content_url}" class="image-size">
      <p class="delete"><a href="/destroy/${data.original.id}">削除</a></p>
      </div>
      `
    } else {
      html = `
      <div class="tweet-line">
      <p>${text}</p>
      <video src="../storage/tweetimage/${data.original.content_url}" autoplay muted class="image-size"></video>
      <p class="delete"><a href="/destroy/${data.original.id}">削除</a></p>
      </div>
      `
    }
    $('#time-line').prepend(html); //できあがったテンプレートをビューに追加
    console.log("appendしたよ");
    // 検索結果がなかったときの処理
    if (data.length === 0) {
      $('.user-index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
    }

  }).fail(function () {
    //ajax通信がエラーのときの処理
    alert("ツイートに失敗しました");
    console.log('どんまい！');
  });
}

function initForm() {
  $('#tweet-textarea').val(""); //もともとある要素を空にする
  $('#tweet-image').val(null);
}