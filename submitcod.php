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

	$cartTotal = "";
		foreach ($_SESSION["cart_array"] as $each_item) { 
		//$size=$each_item['size'];
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$id = $row["id"];
			$product_name = $row["product_name"];
			$prod_desc = $row["details"];
			$price = $row["price"];
			$ext = $row["ext"];
			$date = date ("Y-m-d");
			
					
		}
		
		$pricetotal = $price * $each_item['quantity'];	
		$cartTotal = $pricetotal + $cartTotal;


		$sql = mysql_query("SELECT * FROM users WHERE id=$userid");
		while ($row = mysql_fetch_array($sql)) {
			
			$email = $row['email'];
			$fname = $row['fname'];
			$lname = $row['lname'];

					
		}
		$txn_id = mt_rand();
		$payment_type = "cod";
		$payment_status = "Pending";
		$mc_currency = "PHP";
		$mc_fee = $price;
		$qty = $each_item['quantity'];

		mysql_query("INSERT INTO transactions (product_id_array, user_id, payer_email, first_name, last_name, mc_gross, txn_id, payment_type, payment_status, mc_currency, mc_fee, qty) VALUES ('$id', '$userid', '$email', '$fname', '$lname', '$pricetotal', '$txn_id', '$payment_type', '$payment_status', '$mc_currency', '$mc_fee', '$qty')");

     }

     if (isset($_POST['submit'])) {
     	

     	$codaddress = $_POST['address'];
     	// $codprovince = $_POST['province'];
     	$codprovince = "NCR";
     	$codcity = $_POST['city'];
     	$codzip = $_POST['zip'];
     	$codmobile = $_POST['mobile'];

     	$isexist = $_POST['isexist'];

     	if ($isexist == '1') {
     		mysql_query("UPDATE cod_details SET address='$codaddress', province='$codprovince', city_municipality='$codcity', zip_code='$codzip', mobile_number='$codmobile' WHERE user_id=$userid");
     	} else {
     		mysql_query("INSERT INTO cod_details (user_id, address, province, city_municipality, zip_code, mobile_number) VALUES ('$userid', '$codaddress', '$codprovince', '$codcity', '$codzip', '$codmobile') ");
     	}

     }


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

    <div class="container">


 <form action="authorbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">
		

					 <div class="form-group col-sm-offset-3 col-sm-6">
						<label>COD</label>
					</div>

					<div class="form-group col-sm-offset-3 col-sm-6">

					 <?php 


	echo "<label>COD order successfully sent! Please wait for the delivery. TXN No. $txn_id</label>";
	unset($_SESSION["cart_array"]);

	require_once('include/class.phpmailer.php');
				include("include/class.smtp.php");

	$mail  = new PHPMailer();

									
										$body = 'Transaction Complete Succesfully, TXN No. '.$txn_id.'<br/><br/>Thank You <br/><br/>Mutya';
									

									$mail->IsSMTP(); // telling the class to use SMTP
									$mail->Host       = "smtp.gmail.com"; // SMTP server
									$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           
									// 1 = errors and messages
                                           
									// 2 = messages only


									$mail->SMTPAuth   = true;                  // enable SMTP authentication

									$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

									$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

									$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

									$mail->Username   = "essentialitas@gmail.com";  // GMAIL username

									$mail->Password   = "slvmimtrvpnspeqm";            // GMAIL password


									$mail->SetFrom('essentialitas@gmail.com', 'Mutya');


									$mail->AddReplyTo("essentialitas@gmail.com","Mutya");


									$mail->Subject    = "Transaction COD Success";


									$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

									$mail->MsgHTML($body);


									// $address = $email;
									$address = $email;
									$mail->AddAddress($address, "Mutya");

									// $mail->AddAddress($address, "M");


					
									if(!$mail->Send()) 
									{ 
										echo "Mailer Error: " . $mail->ErrorInfo;
									} 

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