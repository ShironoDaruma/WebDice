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
  .done(function (res) {
    console.log(res["room"])
    if (res["room"] == 'exist') {
      $('#exist_error').css('display', 'block')
    } else {
      $('#exist_error').css('display', 'none')
    }
    if (res["room"] == 'half_width') {
      $('#half_width_error').css('display', 'block')
    } else {
      $('#half_width_error').css('display', 'none')
    }
  })
  .fail(function (xhr) {
    console.log(xhr)
  })
  $('#load').css('display', 'none')
})

function roomIn() {
  var data = {
    'room' : room,
    'password' : password
  }

  $.ajax({
    type: 'POST',
    url: 'http://shirodaruma.php.xdomain.jp/WebDice/bin/php/getRoom.php',
    dataType: 'json',
    data: data
  })
  .done(function (res) {
    console.log(res["room"])
    console.log(res["num"])
    console.log(res["p_name"])
    console.log(res["p_id"])
    console.log(res["result"])

    if (res["room"] == 'half_width') {
      $('#half_width_error').css('display', 'block')
    } else {
      $('#half_width_error').css('display', 'none')
    }
    if (res["room"] == 'no_room') {
      $('#no_room_error').css('display', 'block')
    } else {
      $('#no_room_error').css('display', 'none')
    }
  })
  .fail(function (xhr) {
    console.log(xhr)
  })
}

$(document).on('click', '#roomin', function() {
  $('#load').css('display', 'block')
  room = $('#room').val()
  password = $('#password').val()

  roomIn()

  $('#load').css('display', 'none')
})