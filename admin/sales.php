
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
    <h4><b>Sales</b></h4>
      <table class="table table-striped">
        <thead>
		<th>Product Name</th>
		<th>Amount</th>
		<th>Quantity</th>
		<th>Purchased Date</th>
	</thead>

	<tbody>
		
		<?php 
		$sql = mysql_query("SELECT products.id, products.product_name, transactions.mc_fee, transactions.qty, transactions.payment_date FROM transactions INNER JOIN products ON products.id = transactions.product_id_array");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $id = $row['id'];

		     $name = $row['product_name'];
		     $amount = $row['mc_fee'];
		     $quantity = $row['qty'];
		     $date = $row['payment_date'];

		      echo "
		        <tr>
		          <td>$name</td>
		          <td>$amount</td>
		          <td>$quantity </td>
		          <td>$date</td>
		        </tr>
		      ";
		     }
		  }

	 	$sql = mysql_query("SELECT sum(mc_gross) FROM transactions");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {
		     $totalamount = $row['sum(mc_gross)'];

		      echo "
		        <tr>
		          <td><b>Total Sales:</b></td>
		          <td><b>$totalamount</b></td>
		        </tr>

		      ";
		  }
		}
	 	$sql = mysql_query("SELECT SUM( transactions.mc_gross ) - SUM( expenses.amount ) AS total_income FROM transactions JOIN expenses");
		$requestCount = mysql_num_rows($sql);
		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalincome = $row['total_income'];

		      echo "
		        <tr>
		          <td><b>Total Income:</b></td>
		          <td><b>$totalincome</b></td>
		        </tr>

		      ";
		  }
		}
	  ?>
	</tbody>

      </table>
    </div>

    </div>
    </body>
    </html>
