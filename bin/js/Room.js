$(function(){
	setInterval("getRoom()",500)
})

var room, password, sum

function getRoom() {
  sum = $('#sum').val()
  room = $('#room').val()
  password = $('#pass').val()
  // console.log("data-get")
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
    console.log(res)
  
    if (res["room"] == 'half_width') {
      alert('ルームIDが不正です。再度ログインしてください。')
      // window.location.href = "http://shirodaruma.php.xdomain.jp/WebDice/"
      return
    }
    if (res["room"] == 'no_room') {
      alert('ルームIDまたはパスワードが不正です。再度ログインしてください。')
      // window.location.href = "http://shirodaruma.php.xdomain.jp/WebDice/"
      return
    }
    var roomData = ""
    for (var i = 0; i < res["sum"]; i++) {
      roomData += `
      <div class="hist" id="`+i+`">
        <div class="name">`+res["p_name"][i]+`</div>
        <div class="date">`+res["date"][i]+`</div>
        <div class="text">`+res["result"][i]+`</div>
      </div>
      `
    }
    // console.log(roomData)
    if (sum == res["sum"]) {
      return
    } else {
      $('#getData').remove()
      $('#field').append(`
      <div id="getData">
        <input type="hidden" id="maxNum" value="`+res["num"]+`" style="display:none">
        <input type="hidden" id="sum" value="`+res["sum"]+`" style="display:none">
        `+roomData+`
      </div>
      `)
    }
  })
  .fail(function (xhr) {
    console.log(xhr)
    console.log("fail")
  })
}

var sendName, sendValue, maxNum

$(document).on('click', '#send', function () {
  room = $('#room').val()
  password = $('#pass').val()
  sendName = $('#sendName').val()
  sendValue = $('#sendValue').val()
  maxNum = $('#maxNum').val()
  if (isNaN(maxNum)) {
    maxNum = 0;
  }

  console.log("data-send")

  var now = new Date()
  var date = now.getFullYear() + "/" + now.getMonth() + 1 + "/" + now.getDate() + " " + now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds()
  
  var data = {
    'room' : room,
    'password' : password,
    'sendName' : sendName,
    'sendValue' : sendValue,
    'date' : date,
    'num' : maxNum + 1
  }
  
  $.ajax({
    type: 'POST',
    url: 'http://shirodaruma.php.xdomain.jp/WebDice/bin/php/sendRoom.php',
    dataType: 'json',
    data: data,
    timeout: 10000
  })
  .done(function (res) {
    console.log("send:"+res["send"])
  
    if (res["send"] == 'half_width') {
      alert('ルームIDが不正です。再度ログインしてください。')
      // window.location.href = "http://shirodaruma.php.xdomain.jp/WebDice/"
      return
    }
    if (res["send"] == 'no_room') {
      alert('ルームIDまたはパスワードが不正です。再度ログインしてください。')
      // window.location.href = "http://shirodaruma.php.xdomain.jp/WebDice/"
      return
    }
    getRoom()
  })
  .fail(function (xhr) {
    console.log(xhr)
    console.log("fail")
  })
})