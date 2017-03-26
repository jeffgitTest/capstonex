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

			if (isset($_POST['submit'])) {
		

				$bidId = $_POST['id'];
				$filename = $_POST['filename'];



			}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Bid Portal</title>

	<link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">-->

    <link rel="stylesheet" href="css/morris-0.4.3.min.css">

</head>
<body>

	<?php include 'template/top.php'; ?>

    <?php include 'template/header.php'; ?>
	
	<div style="height: 700px;">
      <embed src="loadfile.php?filename=<?php echo $filename; ?>" width="100%" height="100%"></embed>
    </div>

		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>

	
</body>
</html>