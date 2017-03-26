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

    <!-- <h4>Author Bid Portal</h4> -->

    <div class="container">
    	
    	<form action="authorbid.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">

    		<div class="form-group col-sm-offset-3 col-sm-6">
    			
    			<label for="product-name">Title:</label>
				<input type="text" id="product-name" class="form-control" name="name" required="required">

    		</div>

    		<div class="form-group col-sm-offset-3 col-sm-6">
    			<label for="details">Details:</label>
				<input type="text" id="details" class="form-control" name="details" required="required">
			</div>
			
			<div class="form-group col-sm-offset-3 col-sm-6">
				<label for="author">Author:</label>
				<input type="text" id="author" class="form-control" name="author" required="required">
			</div>

			<div class="form-group col-sm-offset-3 col-sm-6">
				<label for="genre">Genre:</label>
				<input type="text" id="genre" class="form-control" name="genre" required="required">
			</div>
			<div class="form-group col-sm-offset-3 col-sm-6">
				<label for="price">Projected Price:</label>
				<input type="text" id="price" class="form-control" name="price" required="required">
			</div>

			<div class="form-group col-sm-offset-3 col-sm-6">
				<label for="product-name">Attachment (.PDF):</label>
				<input type="file" id="file" accept=".pdf" name="file" class="form-control" required="required" multiple />
			</div>
				<br/>
				<div class="form-group col-sm-offset-3 col-sm-6">
					<input type="submit" name="submit" class="btn btn-default" value="Submit">
				</div>
		
    	</form>


    </div>
	
		

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

				<input class='btn btn-default' type='submit' name='submit' value='View Contract' $disabled />
			</form>
          </td>
          <td>
			<form action='authorsignedcontract.php' method='post'>

				<input type='hidden' name='id' value='$bids_id' />
				<input type='hidden' name='type' value='author' />

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