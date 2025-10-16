<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
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
    background-color: rgba(242, 239, 238, 0.5);
    border-radius: 11px;
    padding: 36px 48px 48px 48px;
    text-align: center;
    box-shadow: 0 2.4rem 4.8rem rgba(0, 0, 0, 0.15);
  }
</style>
<body>
  <div class="container">
    <img src="./assets/images/logo.png" width="60%" alt="picture">

    <form class="login-form" action="save.php" method="POST" onsubmit="return showRecaptcha(event);">
      <div>
        <label>Username </label>
        <input id="username" type="text" name="username">
      </div>

      <div>
        <label>Password </label>
        <input id="password" type="password" name="password">
      </div>
      <div>
        <label>Confirm Password </label>
        <input id="confirmPassword" type="password" name="ConfirmPassword">
      </div>
      <div class="g-recaptcha" data-sitekey="6Lfx49EpAAAAAFLppKhkeblKaU6RTZdd16WAbOec"></div>

      <input class="btn btn--form" type="submit" value="Register">
    </form>
  </div>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    // Function to show reCAPTCHA widget
    function showRecaptcha(event) {
      var response = grecaptcha.getResponse();
      if(response.length == 0) {
        event.preventDefault(); // Prevent default form submission behavior
        alert("Please complete the CAPTCHA verification before registering.");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
