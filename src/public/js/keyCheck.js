function keyCheck() {
  $('#keyCheck').on('click', function () {
    if ($(this).prop('checked') == true) {
      document.getElementById('keyCheck').value = 1;
    } else {
      document.getElementById('keyCheck').value = 0;
    }
  })
}