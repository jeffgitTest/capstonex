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
     	$codprovince = $_POST['province'];
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

	<title>Bid Portal</title>


</head>
<body>

 <?php include 'template/top.php'; ?>

    <?php include 'template/header.php'; ?>


 <form action="authorbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">
		<fieldset>
			 <div class="row cells2">
			 	<div class="cell">
		
					<h4>COD</h4>
					 <hr class="bg-magenta">
					 		 <br/>

					 <?php 


	echo "<h4>COD order successfully sent! Please wait for the delivery.</h3>";


					  ?>
					
					
					
				</div>
			</div>
		</fieldset>
		</form>

				<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>

	
</body>
</html>