function favoriteByAjax() {
  $(document).on('click', '.favorite-button', function (e) {
    console.log("押した");
    $this = $(this);
    $post_id = $this.data('postid');
    e.preventDefault();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/api/favorite/store',
      type: 'POST',
      data: {
        'tweet_id': $post_id
      },
      dataType: 'json'
    }).done(function (data) {
      $this.toggleClass('doneFav');
      $this.next('#favoriteCount').html(data);
      console.log(data);
    }).fail(function (data, xhr, err){
      console.log("どま");
      console.log(data);
      console.log(err);
      console.log(xhr);
    })
  })
};