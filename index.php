<?php
  require "./bin/php/room.php";
  $room = $_POST['room'];
  $pass = $_POST['password'];
  if ($room && $pass) {
    show_room($room, $pass);
  } else {
    require "./bin/php/home.php";
  }
?>