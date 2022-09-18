$(function(){
	setInterval(getRoom(),500)
})

var room, password, sum

function getRoom() {
  sum = $('#sum').val()
  room = $('#room').val()
  password = $('#pass').val()

  var data = {
    'room' : room,
    'password' : password
  }
  
  $.ajax({
    type: 'POST',
    url: 'http://shirodaruma.php.xdomain.jp/WebDice/bin/php/getRoom.php',
    dataType: 'json',
    data: data,
    timeout: 10000
  })
  .done(function (res) {
    console.log(res["room"])
    console.log(res["num"])
    console.log(res["p_name"])
    console.log(res["p_id"])
    console.log(res["result"])
    console.log(res["sum"])
  
    if (res["room"] == 'half_width') {
      alert('ルームIDが不正です。再度ログインしてください。')
      // window.location.href = "http://shirodaruma.php.xdomain.jp/WebDice/"
      return
    }
    if (res["room"] == 'no_room') {
      lert('ルームIDまたはパスワードが不正です。再度ログインしてください。')
      // window.location.href = "http://shirodaruma.php.xdomain.jp/WebDice/"
      return
    }
    var roomData = ""
    for (var i = 0; i < res["sum"]; i++) {
      roomData += `
      <div class="hist" id="`+i+`">
        <div class="name">`+res["p_name"]+`</div>
        <div class="id">`+res["p_id"]+`</div>
        <div class="date">`+res["date"]+`</div>
        <div class="text">`+res["result"]+`</div>
      </div>
      `
    }
    if (sum == res["sum"]) {
      return
    } else {
      $('#getData').remove()
      $('#field').append(`
      <div id="getData">
        <input type="hidden" id="sum" value="`+res["sum"]+`" style="display:none">
        `+roomData+`
      </div>
      `)
    }
  })
  .fail(function (xhr) {
    console.log(xhr)
    $('#error').css('display', 'block')
  })
}