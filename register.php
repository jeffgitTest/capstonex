<?php
		include 'include/check_login.php';
	  	include 'include/connectdb.php';
		$userid="";
			if (loggedin())
			{
				$query = mysql_query("SELECT * FROM users WHERE email='$_SESSION[username]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$email = $row ['email'];
						$fname = $row ['fname'];
					
					}
				
				}
			else
			{	
			//header("Location:login.php");
		//	exit();
			}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Project for Capstone">
    <meta name="author" content="Mindo">

    <title>Mutya Publishing | </title>

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

     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>
 <?php include 'template/style2.php';?>
  <body>
<?php include 'template/header2.php';?>
<div class="page-content">
            <div class="container">
                <div class="no-overflow" style="padding-top: 20px">
				<br/>
          <h1><a href="index.php" class="nav-button block-shadow transform"><span></span></a>&nbsp;Registration Page</h1>

            
     <hr class="bg-amber no-padding-top">
	 
   <div class="grid">
    <?php include 'include/regform.php';?>
         
    </div><!-- /.container -->
    </div><!-- /.container -->
    </div><!-- /.container -->
    </div><!-- /.container -->
   <hr>
      <?php include 'template/footer.php';?>


    <script>
      $( function() {
          $( "#datepicker" ).datepicker();
        } );
    </script>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>