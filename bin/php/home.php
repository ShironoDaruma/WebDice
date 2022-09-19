<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>WebDice</title>
    <link rel="stylesheet" href="./bin/css/WebDice.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="./bin/js/WebDice.js"></script>
  </head>
  <body>
    <div class="load" id="load"><img src="./bin/img/load.gif" class="load-gif"></div>
    <div class="header">
      <div class="logo"><h2><a href="http://shirodaruma.php.xdomain.jp/WebDice/"><span class="textGreen">WebDice</span></a></h2></div>
    </div>
    <div class="title">
      <form autocomplete="off">
        <h1><span class="textGreen">WebDice</span></h1>

        <p><span class="textWhite">簡単な操作でダイスをロールできる会員登録不要のオンラインダイスツールです。</span></p>
        <p><span class="textWhite">ルームIDを自由に決めて、ダイス結果をリアルタイムで皆に共有できます。</span></p><br>

        <label><span class="textWhite">ルームIDを入力</span></label><input type="text" id="room" name="room" class="input" placeholder="半角英数のみ" pattern="^[0-9a-zA-Z]+$" required><br>
        <label><span class="textWhite">パスワードを入力</span></label><input type="password" id="password" class="input" name="password" required><br><br>
        <input type="button" id="newroom" name="newroom" value="新規ルーム">
        <input type="button" id="roomIn" name="roomIn" value="ルーム入室"><br>
        <p id="error"><span class="textRed">(エラー)その他のエラーです(タイムアウトなど)。</span></p>
        <p id="exist_error"><span class="textRed">(エラー)そのルームIDは既に使用されています。</span></p>
        <p id="half_width_error"><span class="textRed">(エラー)ルームIDとパスワードに半角英数以外が含まれています。</span></p>
        <p id="no_room_error"><span class="textRed">(エラー)ルームIDまたはパスワードが一致しません。</span></p>
      </form>
    </div>
  </body>
</html>