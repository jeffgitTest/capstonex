<?php
include '../include/connectdb.php';
  include 'include/check_login.php';
if (!isset($_SESSION["manager"])) {
    header("location: login.php"); 
    exit();
  
  
  
}?>

<?php
    
    $username="";
      if (loggedin())
      {
        $query = mysql_query("SELECT * FROM admin WHERE username ='$_SESSION[manager]' ");
          while ($row = mysql_fetch_assoc($query))
          {
            $userid = $row ['id'];
            $username = $row ['username'];
            
          
          }
        
        }
      else
      { 
      //header("Location:login.php");
    //  exit();
      }

      $id = $_GET['id'];
      $id2 = $_GET['id2'];
      $id3 = $_GET['id3'];
      $id4 = $_GET['id4'];

      $type = ($_GET['type'] == 'author') ? 'Author' : 'Supplier';
      $action = ($type == 'Author') ? 'authorbidlist.php' : 'supplierbidlist.php';

      ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" href="css/morris-0.4.3.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style>
	.cell2 {
		width: 97% !important;
	}
	.row2 {
		width: 70% !important;
	}
</style>

  </head>

  <body>

    <div id="wrapper">
  <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php';?>
    <?php include 'template/top.php';?>
    </nav>

    	
    	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" style="margin-top: 69px;">

		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="id2" value="<?php echo $id2; ?>">
		<input type="hidden" name="id3" value="<?php echo $id3; ?>">
		<input type="hidden" name="id4" value="<?php echo $id4; ?>">

		<fieldset>
			 <div class="row row2">
			 	<div class="cell cell2">
		
					<h4><?php echo $type; ?> Bid Approval Form</h4>
					 <hr class="bg-magenta">
					 		 <br/>
					
					<div class="form-group">
						<div class="input-control">
							<label for="product-name">Expiry Date:</label>
							<input type="text" id="datepicker" class="form-control" name="expiry" required="required">
						</div>
					</div>
					<br/>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="Submit">
					</div>

					
				</div>
			</div>
		</fieldset>
		</form>
	


    </div>


		<script>
			$( function() {
			    $( "#datepicker" ).datepicker();
			  } );
		</script>

    </body>
    </html>


