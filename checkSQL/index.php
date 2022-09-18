<?php
  require_once "../bin/php/connection_database.php";

  // roomsの全レコードを確認
  echo "--rooms--";
  $sql = 'SELECT * FROM rooms';
  $prepare = $db->prepare($sql);
  $prepare->execute();
  $result = $prepare->fetchALL();
  foreach ($result as $loop) {
    echo "id = ".$loop['id']." room".$loop['room']." pass".$loop['pass'].PHP_EOL;
  }
  // resultsの全レコードを確認
  echo "--results--";
  $sql = 'SELECT * FROM results';
  $prepare = $db->prepare($sql);
  $prepare->execute();
  $result = $prepare->fetchALL();
  foreach ($result as $loop) {
    echo "id = ".$loop['id']." room".$loop['room']." num".$loop['num']." p_name".$loop['p_name']." p_id".$loop['p_id']." result".$loop['result'].PHP_EOL;
  }
?>