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
        
        $author_bid_id = $_POST['id'];
        $bids_id = $_POST['id2'];
        $uploaded_bid_file_id = $_POST['id3'];
        $users_id = $_POST['id4'];

        $expiry = $_POST['expiry'];

        // Product Details
        $initialProductStock = 50;
        $initialCriticalLevel = 100;
        $title = "";
        $price = "";

        $allowed_ext = array ('pdf', 'doc');
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        mysql_query("INSERT INTO contract (bid, user_id, type, validity, active) VALUES ('$bids_id', '$users_id', 'author', '$expiry', 1)");

        mysql_query("UPDATE bids SET active=0 WHERE id=$bids_id");
        mysql_query("UPDATE uploaded_bid_file SET active=0 WHERE bid_id=$bids_id");
        mysql_query("UPDATE author_bid SET status=1 WHERE bid_id=$bids_id");

        $sql = mysql_query("SELECT * FROM author_bid WHERE bid_id=$bids_id");
        $requestCount = mysql_num_rows($sql);

        if ($requestCount > 0) {
           while ($row = mysql_fetch_array($sql)) {

            $title = $row['title'];
            $price = $row['projected_price'];

           }
         }

         mysql_query("INSERT INTO products (author_id, product_name, price, details, stock, category, sub_category, status, ext) VALUES ('$users_id', '$title', '$price', '', '$initialProductStock', '', '', 'unactive', 'png')");

         $imageid = mysql_insert_id();

         mysql_query("INSERT INTO product_history(`pid`, `qty_added`) VALUES('$imageid', '$initialProductStock')");
         mysql_query("INSERT INTO critical_level (product_id, crit_level) VALUES ('$imageid', '$initialCriticalLevel')");

      }

      // decline bid
      $action = @$_GET['action'];

      if ($action == 'decline') {
        
        $author_bid_id = $_GET['id'];
        $bids_id = $_GET['id2'];
        $uploaded_bid_file_id = $_GET['id3'];
        $users_id = $_GET['id4'];

        mysql_query("UPDATE bids SET active=0 WHERE id=$bids_id");
        mysql_query("UPDATE uploaded_bid_file SET active=0 WHERE bid_id=$bids_id");
        mysql_query("UPDATE author_bid SET status=-1 WHERE bid_id=$bids_id");

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

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
    <th>Author</th>
    <th>Co-author</th>
    <th>Title</th>
    <th>Details</th>
    <th>Genre</th>
    <th>Price</th>
    <th>Proposal file name</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT author_bid.id as author_bid_id, author_bid. * , bids.id as bids_id, bids . *, uploaded_bid_file.id as uploaded_bid_file_id,  uploaded_bid_file.*, users.id as users_id, users.*
FROM author_bid
INNER JOIN bids ON bids.id = author_bid.bid_id
INNER JOIN users ON author_bid.author_id=users.id
INNER JOIN uploaded_bid_file ON uploaded_bid_file.bid_id=bids.id WHERE users.user_type=2 AND author_bid.status!=-1 AND author_bid.status!=1 AND uploaded_bid_file.active=1 AND bids.active=1");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $author_bid_id = $row['author_bid_id'];
      $bids_id = $row['bids_id'];
      $uploaded_bid_file_id = $row['uploaded_bid_file_id'];
      $users_id = $row['users_id'];

      $fname = $row['fname'];
      $lname = $row['lname'];
      $coauthor = $row['co_author'];
      $title = $row['title'];
      $details = $row['details'];
      $genre = $row['genre'];
      $price = $row['projected_price'];
      $filename = $row['file_name'];
      $date = $row['created_date'];
      $status = ($row['status'] == '0' ? 'Pending' : 'Completed');
      

      echo "
        <tr>
          <td>$fname $lname</td>
          <td>$coauthor</td>
          <td>$title</td>
          <td>$details</td>
          <td>$genre</td>
          <td>$price</td>
          <td><a href='viewuploadedbid.php?filename=$filename'>$filename</a></td>
          <td>$date</td>
          <td>$status</td>
          <td><a href='uploadcontract.php?type=author&id=$author_bid_id&id2=$bids_id&id3=$uploaded_bid_file_id&id4=$users_id'>Accept</a> | <a href='authorbidlist.php?action=decline&id=$author_bid_id&id2=$bids_id&id3=$uploaded_bid_file_id&id4=$users_id'>Decline</a></td>
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


