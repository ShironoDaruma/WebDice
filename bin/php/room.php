<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>WebDice</title>
    <link rel="stylesheet" href="bin/css/WebDice.css">
    <script src="bin/js/WebDice.js"></script>
  </head>
  <body>
    <div class="header">
      <h2><a href="#"><span class="textRed">WebDice</span></a></h1>
    </div>
    <div class="title">
      <form action="" method="POST" autocomplete="off">
        <h1><span class="textRed">WebDice</span></h1>

        <p><span class="textWhite">簡単な操作でダイスをロールできる会員登録不要のオンラインダイスツールです。</span></p>
        <p><span class="textWhite">ルームIDを自由に決めて、ダイス結果をリアルタイムで皆に共有できます。</span></p><br>

        <label><span class="textWhite">ルームIDを入力</span></label><input type="text" id="room" name="room" class="input" placeholder="半角英数のみ" pattern="^[0-9a-zA-Z]+$" required><br>
        <label><span class="textWhite">パスワードを入力</span></label><input type="password" id="password" class="input" name="password" required><br><br>
        <input type="submit" id="newroom" name="newroom" value="新規ルーム">
        <input type="submit" id="roomIn" name="roomIn" value="ルーム入室">
      </form>
    </div>
  </body>
</html>