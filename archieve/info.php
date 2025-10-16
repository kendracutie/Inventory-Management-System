<?php
session_start();

if (!isset($_SESSION["info"])) {
  header("Location: ./");
  exit();
}

require "../utility.php";

$username = $_SESSION["info"]["username"];
$token = $_SESSION["info"]["token"];
$position = ($_SESSION["info"]["position"] == "admin") ? "Administrator" : "User";
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
          
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>
<style>    
    body{
    background-image: url('../assets/images/appp.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
    background-attachment: fixed;
  }</style>
<body>
<div class="container-fluid mb-4 text-center shadow-lg p-3 mb-3 bg-body rounded">
<img src="../assets/images/logo2.png" class="img-fluid" alt="logo">
</div>
  <h2 style="color: white">Archieved</h2>
  <button class="btn btn-primary"  onclick="window.location = '../welcome.php';"><i class="fa fa-eye" aria-hidden="true" style="color: blue"></i>View Active records</button>
  <button class="btn btn-success" onclick="window.location = '../bin/info.php';"><i class="fa fa-recycle" aria-hidden="true" style="color: green"></i>View Bin</button>

  <a class="btn btn-danger float-end"  href="../logout.php" onclick="return confirmLogout()"><i class="fa fa-sign-out" aria-hidden="true" style="color: red"></i>Logout</a>
  <div class="mt-3">
  <table class="table text-dark text-center table-striped table-hover table-bordered">
  <thead class="text-uppercase">
    <tr class="table-active table-dark">
      <th>Product Name</th>
      <th>Price</th>
      <th>Type</th>
      <th>Action</th>
    </thead> 
    <tbody>
      <?php
      $connection = dbconnect();

      // Get all the data in the product table except for those data that are on the bin and archieved
      $result = $connection->query("SELECT * FROM product WHERE status = 'archieved'");

      if ($result->num_rows > 0) {
        foreach ($result as $row) {
      ?>
      <tr>
        <td><?php echo htmlspecialchars($row["product_name"]); ?></td>
        <td><?php echo htmlspecialchars($row["price"]); ?></td>
        <td><?php echo htmlspecialchars($row["type"]); ?></td>
        <td>
          <a href="../edit/?id=<?php echo htmlspecialchars($row['token']); ?>"><i class="fas fa-edit" style="color: blue" title="Edit"></i></a>
          <a href="../bin/?id=<?php echo htmlspecialchars($row['token']); ?>" onclick="return confirmDelete()"><i class="fas fa-trash" style="color: red" title="Delete"></i></a>
          <a href="./restore.php?id=<?php echo htmlspecialchars($row['token']); ?>" onclick="return confirmRestore()"><i class="fa fa-wrench" aria-hidden="true" style="color: grey" title="Restore"></i></a>
        </td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan=4 style="text-align: center;"><i>No Available data</i></td>
      </tr>
      <?php
      }
      ?>
    <tbody>
    </div>
  </table>
</body>
<script>
  // function that will be called if logout link is clicked
  function confirmLogout() {
    return confirm("This will logging out you from this application.\nDo you still want to continue?");
  }

  // function that will be called if Delete link is clicked
  function confirmDelete() {
    return confirm("This link will moved the selected data on the bin, after that you are still able to restore it.\n\n Do you still want to continue?");
  }

  // function that will be called if Archived link is clicked
  function confirmRestore() {
    return confirm("This link will restore the selected data and will be removed from the archived.\n\n Do you still want to continue?");
  }
</script>
</html>
