
function linkToTweetShow($) {
    console.log("読み込みました");

    $(document).on('click', '.tweetLink', function(){
    window.location.href = "/tweet/show/" + $(this).find('div').attr('id');
    });
};
