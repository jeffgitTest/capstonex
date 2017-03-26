<?php
include '../include/connectdb.php';
  include '/include/check_login.php';
if (!isset($_SESSION["manager"])) {
    header("location: ../login.php"); 
    exit();
  
  
  
}
?>

<?php
    
    $username="";
      if (loggedin())
      {
        $query = mysql_query("SELECT * FROM admin WHERE username ='$_SESSION[manager]' ");
          while ($row = mysql_fetch_assoc($query))
          {
            $userid = $row ['id'];
            $username = $row ['username'];
            
          
          }
        
        }
      else
      { 
      //header("Location:login.php");
    //  exit();
      }
      ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">-->

    <link rel="stylesheet" href="css/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">
  <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php';?>
    <?php include 'template/top.php';?>
    </nav>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
    <th>Name</th>
    <th>Product</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT * FROM supplier");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $id = $row['id']; 
      $name = $row['name'];
      $product = $row['product'];

      echo "
        <tr>
          <td>$name</td>
          <td>$product</td>
          <td><a href='/supplier/suppliereditform.php?id=". $id . "&type=edit&name=".$name."&product=".$product."'>Edit</a></td>
          <td><a href='/supplier/processsupplier.php?id=" . $id . "&type=delete'>Delete</a></td>
        </tr>

      ";


     }
  }

   ?>

      </table>
    </div>

    </div>
    </body>
    </html>


