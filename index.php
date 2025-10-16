<?php
session_start();

// Initialize $username variable
$username = isset($_GET["username"]) ? $_GET["username"] : "";

// check if session info is already defined
// if it is defined redirect to welcome.php
if (isset($_SESSION["info"])) {
  header("Location: welcome.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In</title>
  <link rel="stylesheet" href="./assets/css/login.css">
  <link rel="shortcut icon" href="./assets/images/fav.png" type="image/x-icon">
</head>
<style>
  body{
    background-image: url('./assets/images/appbg.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
    background-attachment: fixed;
  }
  .container {
    background-color: rgba(242, 239, 238, 0.6); 
    border-radius: 11px;
    padding: 36px 48px 48px 48px;
    text-align: center;
    box-shadow: 0 2.4rem 4.8rem rgba(0, 0, 0, 0.15);
  }
  .error-message {
    color: red;
  }
</style>
<body>
  <div class="container">
    <img src="./assets/images/logo.png" width="60%" alt="picture">

    <form id="login-form" class="login-form" action="login.php" method="POST">
    <?php
        require "./utility.php";
       //echo generate_token();
      // echo "<br>";
      //echo password_hash("aie",PASSWORD_DEFAULT);
      ?>
      <div>
        <label for="username">Username </label>
        <input id="username" type="username" name="username" value="<?php echo htmlentities($username); ?>" >
      </div>

      <div>
        <label for="password">Password </label>
        <input id="password" type="password" name="password" <?php if (!empty($username)) echo "autofocus"; ?>>
      </div>
      
      <!-- Add reCAPTCHA widget -->
      <div class="g-recaptcha" data-sitekey="6Lfx49EpAAAAAFLppKhkeblKaU6RTZdd16WAbOec" data-callback="onSubmit">
      </div>
      <div id="captcha-error" class="error-message" style="display: none;">Please check the reCAPTCHA before signing in.</div>
      <button id="submit-btn" class="btn btn--form" type="button" onclick="validateCaptcha()">Sign In</button>
      <p>Don't have an account?<a href="registration.php">Click Here</a></p>

    </form>
  </div>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    // Function to validate reCAPTCHA before form submission
    function validateCaptcha() {
      var response = grecaptcha.getResponse();
      if (response.length === 0) {
        document.getElementById('captcha-error').style.display = 'block';
      } else {
        document.getElementById('captcha-error').style.display = 'none';
        document.getElementById("login-form").submit();
      }
    }

    // Function to handle form submission after successful reCAPTCHA verification
    function onSubmit(token) {
      document.getElementById("submit-btn").disabled = false;
    }
  </script>
</body>
</html>
