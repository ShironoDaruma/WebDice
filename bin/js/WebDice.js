function newRoom() {
  $('#load').css('display', 'block')
  
  var room = $('#room').val()
  var password = $('#password').val()

  var data = {
    'room' : room,
    'password' : password
  }

  $.ajax({
    type: 'POST',
    url: 'http://shirodaruma.php.xdomain.jp/WebDice/bin/php/res.php',
    dataType: 'json',
    data: data
  })
  .done(function(res) {
    console.log(res["room"])
    if (res["room"] == 'exist') {
      $('#exist_error').css('display', 'block')
    } else {
      $('#exist_error').css('display', 'none')
    }
  })
  .fail(function(xhr) {
    console.log(xhr)
  })
  $('#load').css('display', 'none')
}