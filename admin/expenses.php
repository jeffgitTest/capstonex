
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
    <h4><b>List of expenses</b></h4>
      <table class="table table-striped">
        <thead>
		<th>Name</th>
		<th>Amount</th>
		<th>Date</th>
	</thead>

	<tbody>
		
		<?php 

		$sql = mysql_query("SELECT * FROM expenses");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $id = $row['id'];

		     $name = $row['name'];
		     $amount = $row['amount'];
		     $date = $row['created_date'];

		      echo "
		        <tr>
		          <td>$name</td>
		          <td>$amount</td>
		          <td>$date </td>
		        </tr>

		      ";


		     }
		  }

	 ?>

	 <?php 

	 	$sql = mysql_query("SELECT sum(amount) FROM expenses");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalamount = $row['sum(amount)'];

		      echo "
		        <tr>
		          <td><b>Total:</b></td>
		          <td>$totalamount</td>
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









<!--  Add expense <br>
 <form action="expenses.php" method="post">
 	
	Name: <input type="text" name="name" > <br>
 	Amount <input type="text" name="amount"> <br>
	<input type="submit" name="submit">

 </form> -->