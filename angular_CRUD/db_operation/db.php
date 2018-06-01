<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "angulartest";

  $connect = mysqli_connect( $host, $user, $pass, $db );
  if ( !$connect ) {
    mysqli_error( $connect );
  }
 ?>
