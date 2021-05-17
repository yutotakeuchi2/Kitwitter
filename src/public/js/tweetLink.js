
$(function ($) {
    console.log("読み込みました");

    $('.tweetLink').on('click',function(){
    window.location.href = "/tweet/show/" + $(this).find('div').attr('id');
    });
});
