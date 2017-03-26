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


</head>
<body>

	<?php include 'template/top.php'; ?>

    <?php include 'template/header.php'; ?>

    	<form action="downloadcontract.php" method="post" style="margin-top: 69px;">
    	<input type="hidden" name="type" value="supplier">

    		<fieldset>
    			<div class="row cells2">
    				<div class="cell">
    					<div class="form-group">
							<input type="submit" name="download-contract" class="button" value="Download Contract File">
						</div>
    				</div>
    			</div>
    			</fieldset>
    		</form>

	
		<form action="supplierbidform.php" method="post" enctype="multipart/form-data">

		<input type="hidden" name="id" value="<?php echo $bids_id; ?>">
		
		<fieldset>
			 <div class="row cells2">
			 	<div class="cell">
		
					<h4>Supplier Signed Contract</h4>
					 <hr class="bg-magenta">
					 		 <br/>

					<div class="form-group">
						<div class="input-control">
							<label for="product-name">Contract File (.PDF):</label>
							<input type="file" id="file" accept=".pdf" name="file" class="input-control" required="required" multiple />
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