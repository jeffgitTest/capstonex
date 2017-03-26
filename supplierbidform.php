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


</head>
<body>

	<?php include 'template/top.php'; ?>

    <?php include 'template/header.php'; ?>
	
		<form action="supplierbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">
		<fieldset>
			 <div class="row cells2">
			 	<div class="cell">
		
					<h4>Supplier Bid Portal</h4>
					 <hr class="bg-magenta">
					 		 <br/>
					
					<div class="form-group">
						<div class="input-control">
							<label for="product-name">Product Name:</label>
							<input type="text" id="product-name" required="required" class="input-control" name="name">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="details">Details:</label>
							<input type="text" id="details" required="required" class="input-control" name="details">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="price">Price:</label>
							<input type="text" id="price" required="required" class="input-control" name="price">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="product-name">Attachment (.PDF, .DOC):</label>
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

				<input type='submit' name='submit' value='View Contract' $disabled />
			</form>
          </td>
          <td>
			<form action='suppliersignedcontract.php' method='post'>

				<input type='hidden' name='id' value='$bids_id' />
				<input type='hidden' name='type' value='supplier' />

				<input type='submit' name='submit1' value='Signed Contract' $disabled />
			</form>
          </td>
        </tr>

      ";


     }
  }

   ?>

      </table>
    </div>


		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>

	
</body>
</html>