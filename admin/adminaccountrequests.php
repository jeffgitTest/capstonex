<?php
include '../include/connectdb.php';
  include 'include/check_login.php';
if (!isset($_SESSION["manager"])) {
    header("location: login.php"); 
    exit();
  
  
  
}?>

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

      // from uploadcontract
      if (isset($_POST['submit'])) {
        
        $id = $_POST['id'];

        mysql_query("UPDATE admin SET active=1 WHERE id=$id");

      }

      // // decline bid
      // $action = @$_GET['action'];

      // if ($action == 'decline') {
        
      //   $author_bid_id = $_GET['id'];
      //   $bids_id = $_GET['id2'];
      //   $uploaded_bid_file_id = $_GET['id3'];
      //   $users_id = $_GET['id4'];

      //   mysql_query("UPDATE bids SET active=0 WHERE id=$bids_id");
      //   mysql_query("UPDATE uploaded_bid_file SET active=0 WHERE bid_id=$bids_id");
      //   mysql_query("UPDATE author_bid SET status=-1 WHERE bid_id=$bids_id");

      // }

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

    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" href="css/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">
  <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php';?>
    <?php include 'template/top.php';?>
    </nav>

    <div class="table-responsive" style="margin-top: 87px;">
      <table class="table table-striped">
        <thead>
    <th>Name</th>
    <th>Username</th>
    <th>Type</th>
    <th>Action</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT * FROM admin WHERE active=0");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $id = $row['id'];

      $name = $row['name'];
      $username = $row['username'];
      $type = $row['type'];
      

      echo "
        <tr>
          <td>$name</td>
          <td>$username</td>
          <td>$type</td>
          <td>
            <form action='adminaccountrequests.php' method='post'>

              <input type='hidden' name='id' value='$id' />

              <input class='btn btn-default' type='submit' name='submit' value='Accept' />
            </form>
          </td>
        </tr>

      ";


     }
  }

   ?>

      </table>
    </div>

    </div>

<!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

    
    </body>
    </html>


