function followButton(){
  $(document).on("click", "#follow_button", function (e) {
    console.log("押したよ");
    console.log($(this).attr("name"));
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: `/users/follow/${$(this).attr('name')}`,
      type: 'POST',
      //data: $($this).attr("name")
    })
  })
}