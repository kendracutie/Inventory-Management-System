<?php
session_start();

// Check if the info session and the id parameter are defined 
// If not, redirect to the login page
if (!isset($_SESSION["info"]) || !isset($_GET["id"])) {
    header("Location: ../");
    exit();
}

require "../utility.php";

// Connect to the database
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


$productName = htmlspecialchars($row[0]["product_name"]);
$productPrice = htmlspecialchars($row[0]["price"]);

// Update the status of the product and set to active, so that it will be removed from the bin
$connection->query("DELETE FROM product WHERE token = '$id'");
echo "<script>alert('The product item " . $productName . " " . $productPrice . " is permanently deleted.');</script>";
echo "<script>window.location = './info.php';</script>";
?>
