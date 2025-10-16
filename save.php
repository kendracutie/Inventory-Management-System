<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./assets/css/save.css">
  <link rel="shortcut icon" href="./assets/images/fav.png" type="image/x-icon">
</head>
<body>
<?php
session_start();
require "./utility.php";

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

// Establish database connection
$con = dbconnect();

if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["ConfirmPassword"])) {
    header("Location: registration.php");
    exit();
}

$username = $_POST["username"];
$password = $_POST["password"];
$ConfirmPassword = $_POST["ConfirmPassword"];

$username = trim($username);
$password = trim($password);
$ConfirmPassword = trim($ConfirmPassword);

if (strlen($username) == 0) {
    echo "<script>alert('Invalid Email');</script>";
    echo "<script>window.location = 'registration.php';</script>";
    return;
}
if (strlen($password) == 0) {
    echo "<script>alert('Invalid Password');</script>";
    echo "<script>window.location = 'registration.php';</script>";
    return;
}

if ($password != $ConfirmPassword) {
    echo "<script>alert('Password didnt match');</script>"; 
    echo "<script>window.location = 'registration.php';</script>";
    return;
}
$hash_password = password_hash($password, PASSWORD_DEFAULT);
$user_token = generate_token(); // Generate a unique token

$stmt = $con->prepare("INSERT INTO user_accounts (USER_NAME, USER_PASS, USER_TOKEN) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hash_password, $user_token);
$stmt->execute();
$result = $stmt->get_result();

echo "<script>alert('Registered Successfully');</script>"; 
echo "<script>window.location = 'index.php';</script>";
?>
</body>
</html>
