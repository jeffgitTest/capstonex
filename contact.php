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


</head>

   <?php include 'template/style2.php' ?>
   <title>Contact
   </title>
  <body>
     <?php include 'template/header2.php' ?>
     <div class="page-content">
        <div class="">
            <div class="container">	
			  	  <h1 class="page-header"><a href="index.html" class="nav-button transform"><span></span></a>&nbsp;Contact<small> us </small></h1>  	
		
                <div class="no-overflow" >
			
 			
<form action="" method="post" class="col-md-6">
         <div id="register"></div><!--for contact status output-->
         <h2>Contact Us Form</h2>
         <fieldset>
		 <br/>
          <div class="form-group">
		  <div class="input-control text full-size" data-role="input">
      	  <label for="exampleInputEmail">Email address</label>
     	  <input type="email" class="form-control"  name="email" id="email" placeholder="Enter email" required >
   		 </div>
   		 </div>
  <br/>       
   <div class="form-group">
   <div class="input-control text" data-role="input">
      <label for="exampleInputPassword">Firstname</label>
      <input type="text" class="form-control"  name="fname" id="fname" placeholder="Firstname">
    </div>
    </div>
	<br/>
    <div class="form-group">
	<div class="input-control text" data-role="input">
      <label for="exampleInputPassword">Lastname</label>
      <input type="text" class="form-control"  name="lname" id="lname" placeholder="Lastname">
    </div>
    </div>

    <div class="form-group">
	<div class="input-control textarea full-size"
    data-role="input" data-text-auto-resize="true">
      <label for="exampleInputPassword">Message</label>
      <textarea name="message" class="form-control"></textarea>
    </div> 
    </div> 
	<div class="form-group">
    	<input type="submit" name="contactus" class="button info" value="Send">
 </div>
  </fieldset>
      
     <div class="clearfix"></div>
	  
 </form>		
<fieldset>
<div class="grid col-md-6">		  
<div class="row cells2">
      <div class="cell">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.457141165559!2d120.96542181429099!3d14.686721178899072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b40da0b06065%3A0x4522e76db025b399!2sMutya+Publishing+House+Inc.!5e0!3m2!1sen!2sph!4v1486787114964" width="450" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>

<br /><small><a href="https://www.google.com/maps/place/Mutya+Publishing+House+Inc./@14.6867212,120.9654218,17z/data=!4m12!1m6!3m5!1s0x3397b40da0b06065:0x4522e76db025b399!2sMutya+Publishing+House+Inc.!8m2!3d14.686716!4d120.9676105!3m4!1s0x3397b40da0b06065:0x4522e76db025b399!8m2!3d14.686716!4d120.9676105?hl=en-PH"target="_blank">View Larger Map</a></small>
        
        
        <hr>
        <h2> Manila Office</h2>
		<h2> Address</h2>
        <p> No. 105 Engineering Rd. Araneta University Village, Potrero, Malabon City</p>
        <h2>Telefax</h2>
        <p>(63 2) 448 1114 </p>
        <h2>Telephone  Phone</h2>
        <p > (63 2) 365 3405 / (63 2) 365 3239</p>
       
        <hr>
        <h3> Davao Office</h3>
		<h2> Address</h2>
        <p> Door 3 Vega-Quitain Bldg., Anda St., Davao City (In front of UP-Mindanao)</p>
        <h2>Mobile</h2>
        <p> 0917 386 6111 / 0922 818 0657</p>
        <h2>Telefax</h2>
        <p>(63 82) 297 0270 </p>
        <h3>Telephone  Phone</h3>
        <p > (63 82) 301 7343</p>
       
        </div>

        <div class="cell">
       
<?php

include 'include/connectdb.php';
if (isset($_POST['contactus']))
{
	$lname = addslashes(strip_tags($_POST['lname']));
	$fname = addslashes(strip_tags($_POST['fname']));
	$email = addslashes(strip_tags($_POST['email']));
	$message = addslashes(strip_tags($_POST['message']));
	
    $dateToday = mktime(0,0,0,date("m"),date("d"),date("Y"));				
	$today = date("d\tM\tY", $dateToday);
                
	if ($fname&&$lname&&$email&&$message)
	{
		//send email		
            $register = mysql_query("INSERT INTO inbox(`name`, `subject`, `email`, `message`) VALUES ('$fname','$lname', '$email','$message'");
            
               echo '  <div class="alert alert-success"> Message sent thank you  </div>';
                            				
      }
	  else {
		  echo '<div class="alert alert-error">Please fill out all the fields </div> ';
		  }

}		
?>


 

        </div>
        </div>
        </div>
		</fieldset>
        
        </div>
        
        </div>
        
        </div>
		</div><!-- /.container -->
        
    <hr>
     <?php include 'template/footer.php' ?>
 

    <!-- JavaScript -->
    <!-- jQuery -->
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="js/jquery-3.2.0.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>


    <!-- Theme JavaScript -->
    <script src="js/new-age.min.js"></script>

  </body>
</html>