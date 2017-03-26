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

		        $fileName = "$bid_id-author-contract.pdf";

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
	
		<form action="authorbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">
		<fieldset>
			 <div class="row cells2">
			 	<div class="cell">
		
					<h4>Author Bid Portal</h4>
					 <hr class="bg-magenta">
					 		 <br/>
					
					<div class="form-group">
						<div class="input-control">
							<label for="product-name">Title:</label>
							<input type="text" id="product-name" class="input-control" name="name" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="details">Details:</label>
							<input type="text" id="details" class="input-control" name="details" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="author">Author:</label>
							<input type="text" id="author" class="input-control" name="author" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="genre">Genre:</label>
							<input type="text" id="genre" class="input-control" name="genre" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<div class="input-control">
							<label for="price">Projected Price:</label>
							<input type="text" id="price" class="input-control" name="price"required="required">
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
    <th>Author</th>
    <th>Co-author</th>
    <th>Title</th>
    <th>Details</th>
    <th>Genre</th>
    <th>Price</th>
    <th>Date</th>
    <th>Status</th>
    <th>Contract</th>
    <th>Action</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT author_bid.id as author_bid_id, author_bid. * , bids.id as bids_id, bids . *, uploaded_bid_file.id as uploaded_bid_file_id,  uploaded_bid_file.*, users.id as users_id, users.*
FROM author_bid
INNER JOIN bids ON bids.id = author_bid.bid_id
INNER JOIN users ON author_bid.author_id=users.id
INNER JOIN uploaded_bid_file ON uploaded_bid_file.bid_id=bids.id WHERE users.user_type=2 AND users.id=" . $userid);
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $author_bid_id = $row['author_bid_id'];
      $bids_id = $row['bids_id'];
      $uploaded_bid_file_id = $row['uploaded_bid_file_id'];
      $users_id = $row['users_id'];

      $fname = $row['fname'];
      $lname = $row['lname'];
      $coauthor = $row['co_author'];
      $title = $row['title'];
      $details = $row['details'];
      $genre = $row['genre'];
      $price = $row['projected_price'];
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
          <td>$coauthor</td>
          <td>$title</td>
          <td>$details</td>
          <td>$genre</td>
          <td>$price</td>
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
			<form action='authorsignedcontract.php' method='post'>

				<input type='hidden' name='id' value='$bids_id' />
				<input type='hidden' name='type' value='author' />

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