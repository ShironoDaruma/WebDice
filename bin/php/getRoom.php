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
        'room'=>'no_room'
      );
      echo json_encode($array);
      exit(0);
    }
    // ルーム情報取得
    $sql = 'SELECT * FROM results WHERE room = :room ORDER BY num';
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':room', $room, PDO::PARAM_STR);
    $prepare->execute();
    $result = $prepare->fetchALL();
    $resultcnt = count($result);
    
    $p_name = array();
    $result = array();
    $date = array();
    $sum = 0;
    foreach ($result as $loop) {
      array_push($p_name, $loop['p_name']);
      array_push($result, $loop['result']);
      array_push($date, $loop['date_text']);
      $sum++;
    }
    $array = array(
      'p_name'=>$p_name,
      'result'=>$result,
      'date'=>$date,
      'sum'=>$sum
    );
    echo json_encode($array);
    exit(0);
  } else {
    $array = array(
      'room'=>'half_width'
    );
    echo json_encode($array);
    exit(0);
  }
?>