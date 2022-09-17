<?php
  $dsn = 'mysql:host=mysql1.php.xdomain.ne.jp;dbname=shirodaruma_webdice';
  $username = 'shirodaruma_dev1';
  $password = 'dev1DEV1';

  try {
    $db = new PDO($dsn, $username, $password);
    console_log("db接続成功");
  } catch (PDOException $e) {
    console_log("db接続失敗: ".$e->getMessage());
    die("接続エラー");
  }
?>