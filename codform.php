<?php
		include 'include/check_login.php';
	  	include 'include/connectdb.php';
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

		$sql = mysql_query("SELECT * FROM cod_details WHERE user_id=$userid");
		$countrows = mysql_num_rows($sql);
		while ($row = mysql_fetch_assoc($sql))
		{
			
			$id = @$row['id'];
			$address = @$row['address'];
			$province = @$row['province'];
			$city = @$row['city_municipality'];
			$zip = @$row['zip_code'];
			$mobile = @$row['mobile_number'];
		
		}

		$isExistingRecord = ($countrows > 0) ? 1 : 0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>COD</title>

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
	
		<form action="submitcod.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">

		<input type="hidden" name="isexist" value="<?php echo $isExistingRecord; ?>">

		<fieldset>
			 <div class="row cells2">
			 	<div class="cell">
		

					 		 <div class="form-group col-sm-offset-3 col-sm-6">
						<label>Cash on delivery Forml</label>
					</div>
					
					<div class="form-group col-sm-offset-3 col-sm-6">
						<label for="product-name">Address:</label>
						<input type="text" id="product-name" value="<?php echo $address; ?>" class="form-control" name="address" required="required">
					</div>
					<br/>
					<div class="form-group col-sm-offset-3 col-sm-6">
						<label for="details">Province:</label>
						<input type="text" id="details" value="<?php echo $province; ?>" class="form-control" name="province" required="required">form
					</div>
					<br/>
					<div class="form-group col-sm-offset-3 col-sm-6">
						<label for="genre">City / Municipality:</label>
						<input type="text" id="genre" value="<?php echo $city; ?>" class="form-control" name="city" required="required">
					</div>
					<br/>
					<div class="form-group col-sm-offset-3 col-sm-6">
						<label for="price">Zip Code:</label>
						<input type="text" id="price" value="<?php echo $zip; ?>" class="form-control" name="zip" required="required">
					</div>
					
					<br/>
					<div class="form-group col-sm-offset-3 col-sm-6">
						<label for="price">Mobile Number:</label>
						<input type="text" id="price" value="<?php echo $mobile; ?>" class="form-control" name="mobile" required="required">
					</div>
					
					<br/>
					<div class="form-group col-sm-offset-3 col-sm-6">
						<input type="submit" name="submit" class="btn btn-default" value="Submit">
					</div>

					
				</div>
			</div>
		</fieldset>
		</form>

		

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