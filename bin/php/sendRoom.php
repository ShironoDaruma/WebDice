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
  $result_before = $_POST['sendValue'];
  $result_after = DiceToResult($result_before);
  $result_text = $result_before . " > ". addResult($result_after);
  $date_text = date('Y/m/d H:i:s');
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
    $data_date = new DateTime($result['date_text']);
    $now_date = new DateTime(date('Y/m/d H:i:s'));
    $diff = $data_date->diff($now_date);
    // ルームを作ってから7日を超過している場合error
    if ($diff->d > 7) {
      $array = array(
        'send'=>'excess'
      );
      echo json_encode($array);
      exit(0);
    }
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