<?php
  // デバッグ用
  function console_log($data) {
    echo '<script>';
    echo 'console.log('.json_encode($data).')';
    echo '</script>';
  }

  // 半角英数かどうか判定
  function ishalfwidth($data) {
    if (preg_match("/^[a-zA-Z0-9]+$/", $data)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  // Diceの結果を返す
  function DiceToResult($data) {
    if ($data == "tens") {
      return random_int(0, 9) * 10;
    }
    $data = mb_strtolower($data);
    $d_num = preg_split("/d/", $data);
    $sum = 0;
    for ($num = 0; $num < $d_num[0]; $num++) {
      $sum += random_int(1, $d_num[1]);
    }
    return $sum;
  }

  // 結果タグをつける
  function addResult($data) {
    return "<span class=\"dice_result\">".$data."</span>";
  }
?>