<?php
  // 便利関数など
  require "./tools.php";
  // データベース接続
  require_once "./connection_database.php";

  header('Content-Type: application/json; charset=utf-8');

  // WebDice.jsから
  $room = $_POST['room'];
  $password = $_POST['password'];
  $date_text = date('Y/m/d H:i:s');

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
      $sql = 'INSERT INTO rooms (room, pass, date_text) VALUE (:room, :pass, :date_text)';
      $prepare = $db->prepare($sql);
      $prepare->bindValue(':room', $room, PDO::PARAM_STR);
      $prepare->bindValue(':pass', $password, PDO::PARAM_STR);
      $prepare->bindValue(':date_text', $date_text, PDO::PARAM_STR);
      $prepare->execute();
      $array = array(
        'room'=>'create'
      );
      echo json_encode($array);
      exit(0);
    } else {
      // ルームが既にあっても7日超えていたら新規作成
      $data_date = new DateTime($result['date_text']);
      $now_date = new DateTime(date('Y/m/d H:i:s'));
      $diff = $data_date->diff($now_date);
      // ルームを作ってから7日を超過している場合新規作成
      if ($diff->d > 7) {
        $sql = 'UPDATE rooms SET pass = :pass, date_text = :date_text WHERE room = :room';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(':room', $room, PDO::PARAM_STR);
        $prepare->bindValue(':pass', $password, PDO::PARAM_STR);
        $prepare->bindValue(':date_text', $date_text, PDO::PARAM_STR);
        $prepare->execute();
        $sql = 'DELETE FROM results WHERE room = :room';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(':room', $room, PDO::PARAM_STR);
        $prepare->execute();
        $array = array(
          'room'=>'create'
        );
        echo json_encode($array);
        exit(0);
      }
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