<?php
  $room = $_POST['room'];
  $pass = $_POST['password'];
  if ($room && $pass) {
    require "./bin/php/room.php";
    show_room($room, $pass);
  } else {
    require "./bin/php/home.php";
  }
?>