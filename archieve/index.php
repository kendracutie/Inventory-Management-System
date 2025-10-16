<?php
  session_start();

  // check if the info session and the id parameter is defined 
  // if aren't, redirect to the login page
  if (!isset($_SESSION["info"]) || !isset($_GET["id"])) {
    header("Location: ../");
    exit();
  }

  require "../utility.php";

  // connect to the database
  $connection = dbconnect();

  // Get the id parameter
  $id = $connection->real_escape_string(trim($_GET["id"]));

  $result = $connection->query("SELECT * FROM product WHERE token = '$id'");

  if ($result->num_rows == 0) {
    echo "<script>alert('Product not found');</script>";
    echo "<script>window.location = '../welcome.php';</script>";
    exit();
  }

  $row = $result->fetch_all(MYSQLI_ASSOC);

  // update the status of the product and set to archived
  $connection->query("UPDATE product SET status = 'archieved' WHERE token = '$id'");
  $productName = htmlspecialchars($row[0]["product_name"]);
  $productPrice = htmlspecialchars($row[0]["price"]);
  echo "<script>alert('The product item " . $productName . " " . $productPrice . " is successfully archived.');</script>";
  echo "<script>window.location = '../welcome.php';</script>";
?>
