<?php
  // function that connects to a database when it is invoked or called
  function dbconnect() {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "aie";
    // initialization of mysqli object
    return new mysqli($hostname, $username, $password, $database);
  }

  // function that prints script that indicates that a username or password
  // doesn't matched in the database
  function user_not_found($username) {
    echo "<script>";
    echo "alert('Invalid user credentials');";
    echo "window.location = './index.php?username=$username';";
    echo "</script>";
    exit();
  }

  // Sanitize the input from SQL injection
  // $value param is the user input
  // $con is the mysql connection
  function input($value, $con) {
    return $con->real_escape_string($value);
  }

  $tokens = [
    "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
    "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
    "0","1","2","3","4","5","6","7","8","9"];

  // function that generates randomized token
  function generate_token($size = 20) {
    $tokens = $GLOBALS["tokens"];
    $max = count($tokens) - 1;
    $result = [];
    for ($num = 0; $num < $size; $num++) {
      $result[$num] = $tokens[rand(0, $max)];
    }
    return implode($result);
  }
?>