<?php
  // 便利関数など
  require "./tools.php";
  // データベース接続
  require_once "./connection_database.php";

  header('Content-Type: application/json; charset=utf-8');

  // WebDice.jsから
  $room = $_POST['room'];
  $password = $_POST['password'];

  // 入力内容が半角英数か確認
  if ( ishalfwidth($room) && ishalfwidth($password) ) {
    // ルームが既にあるか確認
    $sql = 'SELECT * FROM rooms WHERE room = :room';
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':room', $room, PDO::PARAM_STR);
    $prepare->execute();
    $result = $prepare->fetchALL();
    $resultcnt = count($result);
    // ルームがなければルームを新規作成
    if (!$resultcnt) {
      $sql = 'INSERT INTO rooms (room, pass) VALUE (:room, :pass)';
      $prepare = $db->prepare($sql);
      $prepare->bindValue(':room', $room, PDO::PARAM_STR);
      $prepare->bindValue(':pass', $password, PDO::PARAM_STR);
      $prepare->execute();
      $array = array(
        'room'=>'create'
      );
      echo json_encode($array);
      exit(0);
    }
  } else {
    $array = array(
      'room'=>'half_width'
    );
    echo json_encode($array);
    exit(0);  
  }
  $array = array(
    'room'=>'exist'
  );
  echo json_encode($array);
  exit(0);
?>