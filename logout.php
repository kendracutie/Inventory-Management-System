<?php
  session_start();
  session_unset();
  session_destroy();
?>

<script>
alert("You are successfully logged out in this application.\nYou will now be redirected to the home page.");
window.location = './';
</script>