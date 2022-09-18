var room, password

$(document).on('click', '#newroom', function () {
  $('#load').css('display', 'block')
  room = $('#room').val()
  password = $('#password').val()

  var data = {
    'room' : room,
    'password' : password
  }

  $.ajax({
    type: 'POST',
    url: 'http://shirodaruma.php.xdomain.jp/WebDice/bin/php/createRoom.php',
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
    if (res["room"] == 'half_width') {
      $('#half_width_error').css('display', 'block')
    } else {
      $('#half_width_error').css('display', 'block')
    }
  })
  .fail(function(xhr) {
    console.log(xhr)
  })
  $('#load').css('display', 'none')
})