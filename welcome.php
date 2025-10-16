<?php
session_start();

if (!isset($_SESSION["info"])) {
  header("Location: ./");
  exit();
}

require "./utility.php";

$username = $_SESSION["info"]["username"];
$token = $_SESSION["info"]["token"];
$position = $_SESSION["info"]["position"];

// Handle search query
$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .user-icon {
            font-size: 20px;
            margin-left: 5px;
        }
        body{
    background-image: url('./assets/images/appp.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
    background-attachment: fixed;
  }
    </style>
</head>
<body>

<div class="container-fluid mb-4 text-center shadow-lg p-3 mb-3 bg-body rounded">
    <img src="./assets/images/logo2.png" class="img-fluid" alt="logo">
</div>

    <form method="GET" class="form-inline" action="">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="search" placeholder="Search by product name" value="<?php echo $search; ?>">
                    </div>

                    <div class="col-md-2 text-start">
                        <button type="submit" class="btn btn-dark"><i class="fa fa-search" aria-hidden="true" style="color: black"></i> Search</button>
                    </div>
                </div>
            </div>

           
            <div class="col-md-12 mt-2">
            <?php if($position == 'admin'){?>
                <a href="add.php" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true" style="color: blue"></i>Add New</a>
               <a href="./archieve/info.php" class="btn btn-secondary"><i class="fa fa-wrench" aria-hidden="true" style="color: grey"></i>View Archieved</a>
               <a href="./bin/info.php" class="btn btn-success"><i class="fa fa-recycle" aria-hidden="true"  style="color: green" ></i>View Bin</a>
               <?php }?>
                  <!-- Logout Button -->
                <button class="btn btn-danger float-end"  title="Logout" onclick="window.location = 'logout.php';"><?php echo ($position == 'admin') ? '<i class="fas fa-user-shield user-icon" style="color: blue"></i>' : '<i class="fas fa-user user-icon" style="color: green"></i>'; ?> Logout
                </button>
            </div>
          
            
        </div>
    </form>


  <div class="mt-3">
    <table class="table text-dark text-center table-striped table-hover table-bordered">
        <thead class="text-uppercase">
        <tr class="table-active table-dark">
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Type</th>
            <?php if($position == 'admin'){?>
            <th scope="col">Action</th>
            <?php }?>
        </tr>
        </thead>
        <tbody>
        <?php
       $connection = dbconnect();
 
       // Get all the data in the product table except for those data that are on the bin and archieved
       $query = "SELECT * FROM product WHERE status != 'bin' AND status != 'archieved'";
       
       // Add search filter if search term is provided
       if (!empty($search)) {
           $query .= " AND product_name LIKE '%$search%'";
       }
       
       $result = $connection->query($query);
       foreach ($result as $row) {
       ?>
                <tr>
                    <th><?php echo htmlspecialchars($row["product_name"]); ?></th>
                    <th><?php echo htmlspecialchars($row["price"]); ?></th>
                    <th><?php echo htmlspecialchars($row["type"]); ?></th>
                    <?php if ($position == 'admin'){?>

                    
                    <th>
                    <a href="./edit/?id=<?php echo htmlspecialchars($row['token']); ?>"><i class="fas fa-edit" style="color: blue" title="Edit"></i></a>
                    <a href="./bin/?id=<?php echo htmlspecialchars($row['token']); ?>" onclick="return confirmDelete()"><i class="fas fa-trash" style="color: red" title="Delete"></i></a>
                    <a href="./archieve/?id=<?php echo htmlspecialchars($row['token']); ?>" onclick="return confirmArchieved()"><i class="fa fa-archive" aria-hidden="true"  style="color: green" title="Archieved"></i></a>     
                    </th>
                    <?php }?>
                </tr>
                <?php } ?>
        </tbody>
    </table>
     </div>
    <div class="text-center"> 
            <?php
            // Check if no products found and display message
            if ($result->num_rows == 0) {
                echo "<p style='color:white'><i>No products found.</i></p>";
                
            }
            ?>
        </div>
    </div>
    <script>
        // Check if the page was loaded through browser history navigation
        window.addEventListener('pageshow', function(event) {
            // If the page was loaded through navigation history
            if (event.persisted || (window.performance && window.performance.navigation.type == 2)) {
                // Clear the search input field
                document.querySelector('input[name="search"]').value = '';
            }
        });
    </script>

<script>
  // function that will be called if logout link is clicked
  function confirmLogout() {
    return confirm("This will logging out you from this application.\n Do you still want to continue?");
  }

  // function that will be called if Delete link is clicked
  function confirmDelete() {
    return confirm("This link will moved the selected data on the bin, after that you are still able to restore it.\n\n Do you still want to continue?");
  }

  // function that will be called if Archieved link is clicked
  function confirmArchieved() {
    return confirm("This link will archieved the selected data, after that you are still able to restore it.\n\n Do you still want to continue?");
  }
</script>
</body>
</html>
