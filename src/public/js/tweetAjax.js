function tweetByAjax() {
    $('#tweetButton').on('click', function () {　//classはユニークでない　idはユニークという決まり事　domの処理はidのほうが早い→変なエラー出にくい。処理も早い
        console.log("クリックしました");
        let formData = new FormData($("#tweetForm").get(0));//値が少ないときはvalueで取得して値を自分で配列に入れたほうがわかりやすい、変なデータを送られない対策
        console.log("空にしました");
        sendTweet(formData);
    });
};

function sendTweet(formData) {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: 'post',
        url: '/tweet/store',
        data: formData, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        dataType: 'json', //json形式で受け取る
        processData: false,
        contentType: false,
    }).done(function (data) { //ajaxが成功したときの処理
        if (typeof data == "string") {
            alert(data);
        }
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
            <div class="tweetLink">
            <div id="${data.original.id}">
            <div class="tweet-line">
            <img class="tl-icon" src="../storage/iconimage/${data.original.user.profile_image}" alt="">
            <p class="username-font"><a href="/users/show/${data.original.user_id}">${name}</a></p>
            <p class="tweet-text">${text}</p>
            `;
        if (data.original.bsimage) {
            html += `<img src="${data.original.bsimage}" alt="" class="image-size"></img>`
        }
        if (extension == "image") {
            html += `<img src="../storage/tweetimage/${data.original.content_url}" class="image-size"></img>`;
        } else if (extension == "video") {
            html += `<video src="../storage/tweetimage/${data.original.content_url}" controls playsinline controlsList="nodownload" class="image-size"></video>`
        }

        html += ` <p class="delete"><a href="/destroy/${data.original.id}">削除</a></p>
        </div></div></div>
        <div class="bottom-line"><p class="favorite-mark"><a href="#" class="favorite-button" data-postid="${data.original.id}"><i class="fas fa-heart fa-2x my-pink"></i></a>
        <span id="favoriteCount">0</span></p></div>
        `

        $('#time-line').prepend(html); //できあがったテンプレートをビューに追加
        console.log("appendしたよ");
        $(`#${data.original.id}`).parent().on('click', function () {
            window.location.href = `/tweet/show/${data.original.id}`;
        });


    }).fail(function (data, xhr, err) {
        //ajax通信がエラーのときの処理
        alert("ツイートに失敗しました");
        console.log('どんまい！');
        console.log(data);
        console.log(err);
        console.log(xhr);
    });
}


function initForm() {
    $('#tweet-textarea').val(""); //もともとある要素を空にする
    $('#tweet-image').val(null);
}
