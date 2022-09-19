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
    $data_date = new DateTime($result['date_text']);
    $now_date = new DateTime(date('Y/m/d H:i:s'));
    $diff = $data_date->diff($now_date);
    // ルームを作ってから7日を超過している場合error
    if ($diff->d > 7) {
      $array = array(
        'room'=>'excess'
      );
      echo json_encode($array);
      exit(0);
    }
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
    
    $p_name = array();
    $result_text = array();
    $date = array();
    foreach ($result as $loop) {
      array_push($p_name, $loop['p_name']);
      array_push($result_text, $loop['result']);
      array_push($date, $loop['date_text']);
      $num = $loop['num'];
    }
    $array = array(
      'p_name'=>$p_name,
      'result'=>$result_text,
      'date'=>$date,
      'sum'=>$prepare->rowCount(),
      'num'=>$num
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