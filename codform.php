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


</head>
<body>

	<?php include 'template/top.php'; ?>

    <?php include 'template/header.php'; ?>
	
		<form action="submitcod.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">

		<input type="hidden" name="isexist" value="<?php echo $isExistingRecord; ?>">

		<fieldset>
			 <div class="row cells2">
			 	<div class="cell">
		
					<h4>Cash on delivery Form</h4>
					 <hr class="bg-magenta">
					 		 <br/>
					
					<div class="form-group">
						<div class="input-control">
							<label for="product-name">Address:</label>
							<input type="text" id="product-name" value="<?php echo $address; ?>" class="input-control" name="address" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="details">Province:</label>
							<input type="text" id="details" value="<?php echo $province; ?>" class="input-control" name="province" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="genre">City / Municipality:</label>
							<input type="text" id="genre" value="<?php echo $city; ?>" class="input-control" name="city" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="price">Zip Code:</label>
							<input type="text" id="price" value="<?php echo $zip; ?>" class="input-control" name="zip" required="required">
						</div>
					</div>
					
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="price">Mobile Number:</label>
							<input type="text" id="price" value="<?php echo $mobile; ?>" class="input-control" name="mobile" required="required">
						</div>
					</div>
					
					<br/>
					<div class="form-group">
						<input type="submit" name="submit" class="button" value="Submit">
					</div>

					
				</div>
			</div>
		</fieldset>
		</form>

		

		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>

	
</body>
</html>