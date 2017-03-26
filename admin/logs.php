<?php
  include '../include/connectdb.php';
  include 'include/check_login.php';
  if (!isset($_SESSION["manager"])) {
    header("location: login.php"); 
    exit();
  }

  $username="";

  if (loggedin()){
    $query = mysql_query("SELECT * FROM admin WHERE username ='$_SESSION[manager]' ");
    while ($row = mysql_fetch_assoc($query)){
	 		$userid = $row ['id'];
	 		$username = $row ['username'];
    }
  }else{	
    header("Location:login.php");
    exit();
  }

  $productCount = 0;
  $product_name = "No Logs to be display";
  $row = array();
  if(isset($_GET['id']) && !empty($_GET['id'])){
    $pid = $_GET['id'];
    $sql = mysql_query("SELECT * FROM product_history WHERE pid='$pid' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    $product_name = $_GET['pname'];
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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">-->
   <!-- <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="css/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php'?>
		<?php include 'template/top.php'?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1><?php echo $product_name;?> Logs History<small></small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

       <div class="row">
       <div class="table-responsive">
        <table class="table table-striped">
          <thead>
                  
    <th>Product name</th>
    <th>Sold</th>
    <th>Stock Now</th>
    <th>Stock Before</th>
     <th>Status</th>
     <th>Action</th>
	 		    </thead>
          <tbody>
<?php 

if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
			$id = $row['id'];
             $pname = $row["product_name"];
			$stock_query = mysql_query("SELECT qty_added as stock, SUM(qty_added) as sold FROM product_history WHERE pid = $id ORDER BY Date asc limit 1");
      $stock_query_count = mysql_num_rows($stock_query); // count the output amount
		  $previous_stock='empty';
      $lessted_value='empty';
      if ($stock_query_count > 0) {
      // output data of each row
        while($stock_row = mysql_fetch_array($stock_query)) {
          if(!empty($stock_row['stock'])){
            $previous_stock = $stock_row['stock'];
          }
          if(!empty($stock_row['sold'])){
            $lessted_value = $stock_row['sold'];
          }
        }
      } 
      // if(!empty($result->fetch_row()['stock'])){
      //   $previous_stock = $stock_query->fetch_row()[0];
      // }
      // if(!empty($stock_query->fetch_row()['sold'])){
      //   $lessted_value = $stock_query->fetch_row()[1];
      // }
			 // $lessted_value= $row["lessted_value"];
			  $current_stock = $row["stock"];
			   // $previous_stock = $row["previous stock"];
			    // $date = $row["date"];
			 
	 if($current_stock < 10 && $current_stock >=40){
				 $status = '<span style="color: #F00">Critical</span>';
				 }
				 else if($current_stock == 0){
					  $status = '<span style="color: #333">0 Stock</span>';
					 }
					 else{
						 $status = '<span style="color: #090">Sufficient</span>';
						 }
   
	echo '
  <tr>
	    <td>'.$pname.'</td>
    <td>'.$lessted_value.'</td>

    <td>'.$current_stock.'</td>
     <td >'.$previous_stock.'</td>
	  <td>'.$status.'</td>
	 <td>'.$date='empty'.'</td>
  </tr>
  ';
    }
} 
else 
{
	$product_list = "You have no products listed in your store yet";
}
?>


    		</tbody>		
     
   	      </table>
       </div>
        </div><!-- /.row -->
     
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

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
