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
    let name = data.original.user.name;
    let text = "";
    if (data.original.text) {//表示の参照でnull/undefindなどで問題が起きたら表示のほうで何とかする
      text = data.original.text;
    }

    let extension = data.original.content_extension;
    let html = `
      <div class="tweet-line">
      <p class="username-font">User : ${name}</p>
      <p>${text}</p>
      `;
    if (extension == "image") {
      html += `<img src="../storage/tweetimage/${data.original.content_url}" class="image-size"></img>`;
    } else if (extension == "video") {
      html += `<video src="../storage/tweetimage/${data.original.content_url}" controls playsinline controlsList="nodownload" class="image-size"></video>`
    }

    html += ` <p class="delete"><a href="/destroy/${data.original.id}">削除</a></p>
              </div>
    `

    $('#time-line').prepend(html); //できあがったテンプレートをビューに追加
    console.log("appendしたよ");

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