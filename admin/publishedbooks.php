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
	<meta charset="UTF-8">

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
    <h4><b>Published Books</b></h4>
      <table class="table table-striped">
        
      	<thead>
 		<th>Title</th>
 		<th>Author</th>
 		<th>Description</th>
 		<th>Date Added</th>
 	</thead>

	<tbody>
		
		<?php 

			$sql = mysql_query("SELECT products.product_name, users . * , LEFT(products.details, 20) AS details, products.date_added
FROM products
INNER JOIN users ON products.author_id = users.id
AND users.user_type =2");
		  $requestCount = mysql_num_rows($sql);

		  if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		      $productname = $row['product_name'];
		      $fname = $row['fname'];
		      $lname = $row['lname'];
		      $desc = $row['details'];
		      $dateadded = $row['date_added'];

		      echo "
		        <tr>
		          <td>$productname</td>
		          <td>$fname $lname</td>
		          <td>$desc</td>
		          <td>$dateadded</td>
		        </tr>

		      ";


		     }
		  }

		 ?>

	</tbody>

      </table>
    </div>
    </div>

		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>

	
</body>
</html>