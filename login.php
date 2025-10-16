<?php
  if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    header("Location: index.php");
    exit();
  }
  

  $recaptcha_response = $_POST['g-recaptcha-response'];

// Your reCAPTCHA secret key
$recaptcha_secret = "6Lfx49EpAAAAAK5Lr2sEpSfalst82IDHkV7S2AV2";

// Verify the reCAPTCHA response
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_data = [
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response
];

$recaptcha_options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($recaptcha_data)
    ]
];

$recaptcha_context = stream_context_create($recaptcha_options);
$recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
$recaptcha_result = json_decode($recaptcha_result);

// Check if reCAPTCHA verification successful
if (!$recaptcha_result->success) {
    // reCAPTCHA verification failed, redirect back to login page
    header("Location: index.php");
    exit();
}
  require "./utility.php";
  

  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  // calling 'dbconnect' to connect to mysql database
  // $connection variable is now holding the mysql object that can be used for queries
  $connection = dbconnect();


  // Sanitize user input from SQL injection using input function from utility.php
  $username = input($username, $connection);
  $password = input($password, $connection);

  // Get the password from the database then compare to the password from user input
  // $result variable is now holding the result of the select query
  $result = $connection->query("SELECT USER_NAME, USER_PASS, USER_TOKEN, USER_POS FROM user_accounts WHERE USER_NAME = '$username'");
  
  // $result->num_rows checked the number of rows from the select query
  // if the number of rows is 0, meaning username was not found in the database 
  if ($result->num_rows == 0) {
    user_not_found($username);
  }

  // Retrieved the password that is in the database
  $row = $result->fetch_all(MYSQLI_ASSOC);
  // $password_hash is now holding the password from the database
  $password_hash = $row[0]["USER_PASS"];



  // compare the hashed password from the database to the password that came from user input
  // password_verify is a function that is used to compare hashed password to the user input password
  // returns true if the passwords matched, otherwise false
  if (password_verify($password, $password_hash)) {
    session_start();
    // save an associative array to the session
    $_SESSION["info"] = [
      "username" => $row[0]["USER_NAME"],
      "token" => $row[0]["USER_TOKEN"],
      "position" => $row[0]["USER_POS"]
    ];
    
    header("Location: welcome.php");
    exit();
  } else{
    // if the password does not matched 
    // call the user_not_found function
    user_not_found($username);
  }

?>