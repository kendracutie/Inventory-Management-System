<?php
session_start();

if (!isset($_SESSION["info"])) {
  header("Location: ./");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Apple Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="./assets/images/fav.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>     body{
    background-image: url('./assets/images/appp.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
    background-attachment: fixed;
  }</style>
<body>
    
<div class="container-fluid mb-4 text-center shadow-lg p-3 mb-3 bg-body rounded">
<img src="./assets/images/logo2.png" class="img-fluid" alt="logo">
</div>
<div class="container">
    <h2 class="text-center" style="color: white">Add Product Here</h2>
    <form method="POST" class="form-inline" action="./save/">
        <div class="form-group ms-3 mt-3">
            <label for="name" style="color: white">Product Name</label>
            <input type="hidden" name="mode" value="register">
            <input type="text" class="form-control" name="product_name" value="<?php echo htmlspecialchars($_POST['product_name'] ?? ''); ?>" required>
        </div>
        <div class="form-group ms-3 mt-3">
            <label for="name" style="color: white">Price</label>
            <input type="text" class="form-control" name="price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>" required>
        </div>
        <div class="form-group ms-3 mt-3">
            <label for="name" style="color: white">Type</label>
            <input type="text" class="form-control" name="type" value="<?php echo htmlspecialchars($_POST['type'] ?? ''); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary ms-3 mt-3 mb-3"><i class="fa fa-plus" aria-hidden="true" style="color: blue"></i>Add item</button>
        <input type="button" value="View Records" class="btn btn-secondary " onclick="window.location = './welcome.php';">

    </form>
</div>
</body>
</html>
