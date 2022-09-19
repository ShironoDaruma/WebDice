<?php
  // 便利関数など
  require "./tools.php";
  // データベース接続
  require_once "./connection_database.php";

  header('Content-Type: application/json; charset=utf-8');

  // Room.jsから
  $room = $_POST['room'];
  $password = $_POST['password'];
  $p_name = $_POST['sendName'];
  $result_text = $_POST['sendValue'];
  $date_text = $_POST['date'];
  $num = $_POST['num'];

  // 入力内容が半角英数か確認
  if ( ishalfwidth($room) && ishalfwidth($password) ) {
    // ルーム照合
    $sql = 'SELECT * FROM rooms WHERE room = :room AND pass = :pass';
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':room', $room, PDO::PARAM_STR);
    $prepare->bindValue(':pass', $password, PDO::PARAM_STR);
    $prepare->execute();
    $result = $prepare->fetch();
    $resultcnt = count($result);
    // ルームがなければerror
    if (!$resultcnt) {
      $array = array(
        'send'=>'no_room'
      );
      echo json_encode($array);
      exit(0);
    }
    // ルームに送信
    $sql = 'INSERT INTO results (room, num, p_name, result, date_text) VALUE (:room, :num, :p_name, :result, :date_text)';
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':room', $room, PDO::PARAM_STR);
    $prepare->bindValue(':num', $num, PDO::PARAM_INT);
    $prepare->bindValue(':p_name', $p_name, PDO::PARAM_STR);
    $prepare->bindValue(':result', $result_text, PDO::PARAM_STR);
    $prepare->bindValue(':date_text', $date_text, PDO::PARAM_STR);
    $prepare->execute();
    
    $array = array(
      'send'=>'send'
    );
    echo json_encode($array);
    exit(0);
  } else {
    $array = array(
      'send'=>'half_width'
    );
    echo json_encode($array);
    exit(0);
  }
?>