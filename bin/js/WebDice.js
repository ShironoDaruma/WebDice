var room, password

$(document).on('click', '#newroom', function () {
  $('#load').css('display', 'block')
  $('#error').css('display', 'none')
  $('#half_width_error').css('display', 'none')
  $('#exist_error').css('display', 'none')
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
    data: data,
    timeout: 10000
  })
  .done(function (res) {
    console.log(res["room"])
    if (res["room"] == 'exist') {
      $('#exist_error').css('display', 'block')
    }
    if (res["room"] == 'half_width') {
      $('#half_width_error').css('display', 'block')
    }
    if (res["room"] == 'create') {
      roomIn()
    }
  })
  .fail(function (xhr) {
    console.log(xhr)
    $('#error').css('display', 'block')
  })
  .always(function () {
    setTimeout(function(){
      $('#load').css('display', 'none')
    }, 10)
  })
})

function roomIn() {
  $('<form/>', {action: '', method: 'post'})
  .append($('<input/>', {type: 'hidden', name: 'room', value: room}))
  .append($('<input/>', {type: 'hidden', name: 'password', value: password}))
  .appendTo(document.body)
  .submit();
}

$(document).on('click', '#roomIn', function() {
  room = $('#room').val()
  password = $('#password').val()
  roomIn()
})