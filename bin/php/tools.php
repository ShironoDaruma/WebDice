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
?>