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

      // for supplier contract termination
      $action = @$_GET['action'];

      if ($action == 'terminate') {

        $contract_id = $_GET['id'];
        
        mysql_query("UPDATE contract SET active=0 WHERE bid=$contract_id");

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
    <th>Supplier Name</th>
    <th>Product</th>
    <th>Validity</th>
    <th>Date</th>
    <th>Status</th>
    <th>Contract</th>
    <th>Action</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT contract.id AS contract_id, contract.created_date AS contract_date, contract. * , users.id AS users_id, users. * , supplier_bid.id AS supplier_bid_id, supplier_bid. * , uploaded_contract_file.id AS uploaded_contract_file_id, uploaded_contract_file . * 
FROM contract
INNER JOIN users ON contract.user_id = users.id
INNER JOIN supplier_bid ON contract.bid = supplier_bid.bid_id
INNER JOIN uploaded_contract_file ON uploaded_contract_file.contract_id = contract.bid
WHERE users.user_type =3 AND contract.active=1");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $contract_id = $row['contract_id'];
      $supplier_bid_id = $row['supplier_bid_id'];
      $users_id = $row['users_id'];

      $fname = $row['fname'];
      $lname = $row['lname'];
      $product = $row['product_bid'];
      $validity = $row['validity'];
      $date = $row['contract_date'];
      $status = ($row['active'] == '0' ? 'Inactive' : 'Active');
      $filename = $row['file_name'];
      

      echo "
        <tr>
          <td>$fname $lname</td>
          <td>$product</td>
          <td>$validity</td>
          <td>$date</td>
          <td>$status</td>
          <td>
            <form action='showcontract.php' method='post'>

              <input type='hidden' name='id' value='$contract_id' />
              <input type='hidden' name='filename' value='$filename' />

              <input type='submit' class='btn btn-default' name='submit' value='View Contract' />
            </form>
          </td>
          <td><a href='suppliercontracts.php?action=terminate&id=$contract_id'>Terminate Contract</a></td>
          
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
