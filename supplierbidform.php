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

			function getContractFileName($contractId) {

				$filename = "";

				$sql = mysql_query("SELECT * FROM  uploaded_contract_file WHERE contract_id=$contractId");

				$requestCount = mysql_num_rows($sql);

				  if ($requestCount > 0) {
				     while ($row = mysql_fetch_array($sql)) {

				     	$filename = $row['file_name'];

				   }
				}

				return $filename;

			}

			if (isset($_POST['submit'])) {
				
				$bid_id = $_POST['id'];

				$file_name = $_FILES['file']['name'];
		        $file_size = $_FILES['file']['size'];
		        $file_temp = $_FILES['file']['tmp_name'];

		        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

		        $fileName = "$bid_id-supplier-contract.pdf";

		        mysql_query("INSERT INTO uploaded_contract_file (contract_id, file_name, ext) VALUES ('$bid_id', '$fileName', '$file_ext')");

		        move_uploaded_file($file_temp, 'admin/contracts/' . $fileName);

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
	
		<form action="supplierbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">
	
					
		<div class="form-group col-sm-offset-3 col-sm-6">
			<label for="product-name">Product Name:</label>
			<input type="text" id="product-name" required="required" class="form-control" name="name">
		</div>
		<br/>
		<div class="form-group col-sm-offset-3 col-sm-6">
			<label for="details">Details:</label>
			<input type="text" id="details" required="required" class="form-control" name="details">
		</div>
		<br/>
		<div class="form-group col-sm-offset-3 col-sm-6">
			<label for="price">Price:</label>
			<input type="text" id="price" required="required" class="form-control" name="price">
		</div>
		<br/>
		<div class="form-group col-sm-offset-3 col-sm-6">
			<label for="product-name">Attachment (.PDF, .DOC):</label>
			<input type="file" id="file" accept=".pdf" name="file" class="form-control" required="required" multiple />
		</div>				<br/>
		<div class="form-group col-sm-offset-3 col-sm-6">
			<input type="submit" name="submit" class="btn btn-default" value="Submit">
		</div>

					
		</form>
		</div>


		<hr class="bg-magenta">

		<div class="table-responsive">
      <table class="table table-striped">
        <thead>
    <th>Name</th>
    <th>Product</th>
    <th>Details</th>
    <th>Price</th>
    <th>Date</th>
    <th>Status</th>
    <th>Contract</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT supplier_bid.id as supplier_bid_id, supplier_bid. * , bids.id as bids_id, bids . *, uploaded_supp_bid_file.id as uploaded_supp_bid_file_id,  uploaded_supp_bid_file.*, users.id as users_id, users.*
FROM supplier_bid
INNER JOIN bids ON bids.id = supplier_bid.bid_id
INNER JOIN users ON supplier_bid.supplier_id=users.id
INNER JOIN uploaded_supp_bid_file ON uploaded_supp_bid_file.bid_id=bids.id WHERE users.user_type=3 AND users.id=" . $userid);
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $author_bid_id = $row['supplier_bid_id'];
      $bids_id = $row['bids_id'];
      $uploaded_bid_file_id = $row['uploaded_supp_bid_file_id'];
      $users_id = $row['users_id'];

      $fname = $row['fname'];
      $lname = $row['lname'];
      $product = $row['product_bid'];
      $detail = $row['details'];
      $price = $row['price'];
      $filename = $row['file_name'];
      $date = $row['created_date'];
      $status = ($row['status'] == '0' ? 'Pending' : 'Approved');

      $disabled = ($status == 'Approved') ? '' : 'disabled';

      $contractfilename = "";

      if ($status == 'Approved') {
      	$contractfilename = getContractFileName($bids_id);
      }
      

      echo "
        <tr>
          <td>$fname $lname</td>
          <td>$product</td>
          <td>$detail</td>
          <td>".number_format($price, 2, '.', ',')."</td>
          <td>$date</td>
          <td>$status</td>
          <td>
			<form action='showcontract.php' method='post'>

				<input type='hidden' name='id' value='$bids_id' />
				<input type='hidden' name='filename' value='$contractfilename' />

				<input class='btn btn-default' type='submit' name='submit' value='View Contract' $disabled />
			</form>
          </td>
          <td>
			<form action='suppliersignedcontract.php' method='post'>

				<input type='hidden' name='id' value='$bids_id' />
				<input type='hidden' name='type' value='supplier' />

				<input class='btn btn-default' type='submit' name='submit1' value='Signed Contract' $disabled />
			</form>
          </td>
        </tr>

      ";


     }
  }

   ?>

      </table>
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