function followButton(){
  $(document).on("click", "#follow_button", function (e) {
    button = $(this);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: `/users/follow/${$(this).attr('name')}`,
      type: 'POST',
      //data: $($this).attr("name")
    }).done(function (data) {
      if (data == "open") {
        button.text("フォロー解除する");
        button.attr("id", "unfollow_button");
        console.log("書き換えた");
      } else {
        button.text("申請キャンセル");
        button.attr("id", "cancel_request_button");
      }
    })
  })
}

function unfollowButton() {
  $(document).on("click", "#unfollow_button", function (e) {
    button = $(this);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: `/users/unfollow/${$(this).attr('name')}`,
      type: 'POST',
      //data: $($this).attr("name")
    }).done(function (data) {
      button.text("フォローする");
      button.attr("id", "follow_button");
      console.log("書き換えた");
    })
  })
}

function acceptFollowButton() {
  $(document).on("click", "#accept_follow_button", function (e) {
    button = $(this);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: `/users/acceptFollow/${$(this).attr('name')}`,
      type: 'POST',
      //data: $($this).attr("name")
    }).done(function (data) {
      button.remove();
      button.attr("id", "follow_button");
      console.log("書き換えた");
    }).fail(function (data, xhr, err) {
      console.log("どま");
      console.log(data);
      console.log(err);
      console.log(xhr);
    })
  })
}

function cancelRequestButton() {
  $(document).on("click", "#cancel_request_button", function (e) {
    button = $(this);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: `/users/cancelRequest/${$(this).attr('name')}`,
      type: 'POST',
      //data: $($this).attr("name")
    }).done(function (data) {
      button.text("フォロー申請する");
      button.attr("id", "follow_button");
      console.log("書き換えた");
    }).fail(function (data, xhr, err) {
      console.log("どま");
      console.log(data);
      console.log(err);
      console.log(xhr);
    })
  })
}