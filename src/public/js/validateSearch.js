$(function () {
  console.log("読み込んだよ");
  $('#searchForm').submit(function () {
    if ($("input[name='keyword']").val() == "" || $("input[name='keyword']").val().match(/\s/g)) {
      return false;
    } else {
      $("#searchButton").prop('disabled', false);
    }
  });
});