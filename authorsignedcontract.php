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

			$bids_id = @$_POST['id'];


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

    	<form action="downloadcontract.php" method="post" style="margin-top: 69px;">
    		<input type="hidden" name="type" value="author">

			<div class="form-group col-sm-offset-3 col-sm-6">
				<input type="submit" name="download-contract" class="btn btn-default" value="Download Contract File">
			</div>
    		</form>

	
		<form action="authorbidform.php" method="post" enctype="multipart/form-data">

		<input type="hidden" name="id" value="<?php echo $bids_id; ?>">

		
					<div class="form-group col-sm-offset-3 col-sm-6">
						<label>Author Signed Contract</label>
					</div>
					 

					<div class="form-group col-sm-offset-3 col-sm-6">
						<label for="product-name">Contract File (.PDF):</label>
						<input type="file" id="file" accept=".pdf" name="file" class="form-control" required="required" multiple />
					</div>
					<br/>
					<div class="form-group col-sm-offset-3 col-sm-6">
						<input type="submit" name="submit" class="btn btn-default" value="Submit">
					</div>

		</form>
	</div>

		<?php include 'template/footer.php'; ?>

    <!-- jQuery -->
    <!-- <script src="js/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/jquery-3.2.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
 <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
-->
    <!-- Theme JavaScript -->
    <script src="js/new-age.min.js"></script>

	
</body>
</html>