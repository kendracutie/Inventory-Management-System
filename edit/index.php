<?php
  session_start();

  if (!isset($_GET["id"])) {
    header("Location: ../welcome.php");
    exit();
  }

  if (!isset($_SESSION["info"])) {
    header("Location: ../");
    exit();
  }

  require "../utility.php";

  $connection = dbconnect();

  $id = input(trim($_GET["id"]), $connection);
  $info = $connection->query("SELECT * FROM product WHERE token = '$id'");

  if ($info->num_rows == 0) {
    echo "<script>";
    echo "alert('Product not found');";
    echo "window.location = 'index.php';";
    echo "</script>";
    exit();
  } else {
    $result = $connection->query("SELECT * FROM product WHERE token = '$id'");
    $row = $result->fetch_all(MYSQLI_ASSOC);

    $product_name = $row[0]["product_name"];
    $price = $row[0]["price"];
    $type = $row[0]["type"];
  }

  function output($value) {
    echo htmlentities($value);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Apple Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/fav.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body{
    background-image: url('../assets/images/appp.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
    background-attachment: fixed;
  }
</style>
<body>
<div class="container-fluid mb-4 text-center shadow-lg p-3 mb-3 bg-body rounded">
<img src="../assets/images/logo2.png" class="img-fluid" alt="logo">
</div>
  <div class="container">
    <h2 class="text-center" style="color: white">Update Product</h2>
    <form method="POST" class="form-inline" action="../save/">
        <div class="form-group ms-3 mt-3">
           <input type="hidden" name="mode" value="update" >
          <input type="hidden" name="id" value="<?php output($id); ?>">

            <label for="name"  style="color: white">Product Name</label>
         <input type="text" class="form-control" name="product_name" value="<?php output($product_name); ?>">
        </div>
        <div class="form-group ms-3 mt-3">
            <label for="name"  style="color: white">Price</label>
            <input type="text" class="form-control" name="price" value="<?php output($price); ?>">
        </div>
        <div class="form-group ms-3 mt-3">
            <label for="name"  style="color: white">Type</label>
            <input type="text" class="form-control" name="type" value="<?php output($type); ?>">
        </div>
        <div class="form-group ms-3 mt-3">
        <input type="submit" value="Save" class="btn btn-success">
        <a href="../add.php" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"  style="color: blue" ></i>Add</a>
        <a href="../welcome.php" class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"  style="color: grey" ></i>View Records</a>
      </div>
   
    </form>
</div>

</body>
</html>