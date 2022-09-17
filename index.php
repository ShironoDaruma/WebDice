<?php
  function console_log($data){
    echo '<script>';
    echo 'console.log('.json_encode($data).')';
    echo '</script>';
  }

  $dsn = 'mysql:host=mysql1.php.xdomain.ne.jp;dbname=shirodaruma_webdice';
  $username = 'shirodaruma_dev1';
  $password = 'dev1DEV1';

  try {
    $db = new PDO($dsn, $username, $password);
    console_log("db接続成功");
  } catch (PDOException $e) {
    console_log("db接続失敗: ".$e->getMessage());
    exit();
  }

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>WebDice</title>
    <link rel="stylesheet" href="WebDice.css">
  </head>
  <body>
    <div class="header">
      <h2><a href="#"><span class="textRed">WebDice</span></a></h1>
    </div>
    <div class="title">
      <form action="" method="POST">
        <h1><span class="textRed">WebDice</span></h1>

        <p><span class="textWhite">簡単な操作でダイスをロールできる会員登録不要のオンラインダイスツールです。</span></p>
        <p><span class="textWhite">ルームURLを自由に決めて、ダイス結果をリアルタイムで皆に共有できます。</span></p><br>

        <p><span class="textWhite">https://shirodaruma.php.xdomain.jp/WebDice/rooms/</span><input type="url" id="url" name="url" placeholder="ルームURLを入力"></p>
        <p><span class="textWhite">パスワードを入力</span><input type="password" id="password" name="password"></p>
        <input type="submit" id="submit" name="newroom" value="新規ルーム">
        <input type="submit" id="submit" name="roomIn" value="ルーム入室">
      </form>
    </div>
  </body>
</html>