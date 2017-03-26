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

	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
   <!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
-->

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendor/device-mockups/device-mockups.min.css">

    <!-- Theme CSS -->
    <link href="css/new-age.css" rel="stylesheet">

</head>
<body>

	<?php include 'template/style2.php'; ?>

    <?php include 'template/header2.php'; ?>

    <div class="container">
	
		<form action="authorbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">
		
		
					<div class="form-group col-sm-offset-3 col-sm-6">
						<label>Supplier Bid Portal</label>
					</div>

					<div class="form-group col-sm-offset-3 col-sm-6">

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

	echo "<label>Supplier bid successfully sent! Please wait for admin approval.</label>";


 ?>

 	</div>

					
		</form>

		</div>

		<?php include 'template/footer.php'; ?>

    <!-- jQuery -->
    <!-- <script src="js/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
 <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
-->
    <!-- Theme JavaScript -->
    <script src="js/new-age.min.js"></script>

	
</body>
</html>