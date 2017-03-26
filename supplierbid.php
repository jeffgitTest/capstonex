<?php 

	include 'include/check_login.php';
	include 'include/connectdb.php';
	include 'include/bid.php';

	

 ?>

 <?php
		$userid="";
			if (loggedin())
			{
				$query = mysql_query("SELECT * FROM users WHERE usn='$_SESSION[username]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$usn = $row ['usn'];
						$fname = $row ['fname'];
					
					}
				
				}
			else
			{	
			//header("Location:login.php");
		//	exit();
			}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Bid Portal</title>


</head>
<body>

	<?php include 'template/top.php'; ?>

    <?php include 'template/header.php'; ?>
	
		<form action="authorbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">
		<fieldset>
			 <div class="row cells2">
			 	<div class="cell">
		
					<h4>Author Bid Portal</h4>
					 <hr class="bg-magenta">
					 		 <br/>

					 <?php 

	$supplierid =  $_SESSION['supplier_id'];

	$name = $_POST['name'];
	$details = $_POST['details'];
	$price = $_POST['price'];

	$file_name = $_FILES['file']['name'];
	$file_size = $_FILES['file']['size'];
	$file_temp = $_FILES['file']['tmp_name'];

	$allowed_ext = array ('pdf', 'doc');
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $file_id = 0;

	$bidid = insert_bid('supplier');

	$sql = mysql_query("INSERT INTO supplier_bid (bid_id, supplier_id, product_bid, details, price, status) VALUES ('$bidid', '$supplierid', '$name', '$details', '$price', 0)");

	$file_id = mysql_insert_id();
	$file = $file_name;
	move_uploaded_file($file_temp, 'admin/bids/' . $file);

	$sql = mysql_query("INSERT INTO uploaded_supp_bid_file (bid_id, supplier_id, file_name, ext, active) VALUES ('$bidid', '$supplierid', '$file_name', '$file_ext', 1)");

	echo "<h4>Supplier bid successfully sent! Please wait for admin approval.</h3>";


 ?>

					
					
					
				</div>
			</div>
		</fieldset>
		</form>

		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>

	
</body>
</html>