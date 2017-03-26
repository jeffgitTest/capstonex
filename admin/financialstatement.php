
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
    <h4 style="text-align: center;"><b>MUTYA</b></h4>
    <h4 style="text-align: center;"><b>INCOME STATEMENT</b></h4>
     
      <table class="table table-striped">
        <thead>
		<th><b>Revenue:</b></th>
	</thead>

	<tbody>
		
		<?php 

	 	$sql = mysql_query("SELECT sum(mc_gross) FROM transactions");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalamount = $row['sum(mc_gross)'];

		      echo "
		        <tr>
		          <td ><b>Sales:</b></td>
		          <td><b>$totalamount</b></td>
		        </tr>

		      ";
		  }
		}

	  ?>

	</tbody>

      </table>

      <table class="table table-striped">

      <thead>
		<th><b>Revenue:</b></th>
	</thead>

	<tbody>
		
		<?php 

	 	$sql = mysql_query("SELECT sum(mc_gross) FROM transactions");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalamount = $row['sum(mc_gross)'];

		      echo "
		        <tr>
		          <td ><b>Sales:</b></td>
		          <td><b>$totalamount</b></td>
		        </tr>

		      ";
		  }
		}

	  ?>

	</tbody>



      </table>

      <table class="table table-striped">

      	<?php 

		$totalsales = 0;
		$totalexpenses = 0;
		$netincome = 0;

	 	$sql = mysql_query("SELECT SUM(mc_gross) AS total_sales FROM transactions");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalsales = $row['total_sales'];

		      
		  }
		}

		
		$sql2 = mysql_query("SELECT SUM(amount) AS total_expenses FROM expenses");
		$requestCount2 = mysql_num_rows($sql2);

		if ($requestCount2 > 0) {
		     while ($row = mysql_fetch_array($sql2)) {

		     $totalexpenses = $row['total_expenses'];

		  }
		}

		$netincome = $totalsales - $totalexpenses;
		
		echo "
		        <tr>
		          <td><b>Net Income:</b></td>
		          <td><b>$netincome</b></td>
		        </tr>

		      ";

	  ?>

      </table>

    </div>

    </div>
    </body>
    </html>


 


