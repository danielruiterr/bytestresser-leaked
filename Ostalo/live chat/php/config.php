<?php
  $hostname = "localhost";
  $username = "root";
  // $password = "f2f-9j2380fd80jdq";
  $password = "";
  $dbname = "chatapp";

  $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  $GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

  // Second Secure
  $GET = str_replace('<', "&lt;", $GET);
  $GET = str_replace('>', "&gt;", $GET);
  $POST = str_replace('<', "&lt;", $POST);
  $POST = str_replace('>', "&gt;", $POST);

  function Secure($String) {
    $String = str_replace('<', "&lt;", $String);
    $String = str_replace('>', "&gt;", $String);

    return $String;
  }

  if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }

  // include('mysql-wrapper.php');

  $csrftoken = $_SESSION['token'];

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
