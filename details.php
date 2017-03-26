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

   <?php include 'template/style2.php';?>
  <body>

     <?php include 'template/header2.php';?>

     <div class="page-content">
        <div>
            <div class="container">
                <div class="no-overflow" style="padding-top: 40px">

          <h1 class="page-header">Products <small>Showcase </small></h1>
<?php

include ('include/connectdb.php');
$output='';
if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysql_query("SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $pid = $row["id"];
			$prod_title = $row["product_name"];
			 $price = $row["price"];
			  $prod_desc  = $row["details"];
			  $category = $row["category"];
			$timestamp = $row["timestamp"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			  $ext = $row["ext"];
			  
			  if (loggedin())
					{
					$botton='<a data-toggle="modal" href="#addtocart" class="btn btn btn-success btn-large">Add to cart</a> ';
					}
					
						else{
							$botton='<a data-toggle="modal" href="#login" class="btn btn btn-success btn-large">Add to cart</a>';
							}
						
					
			 
			 echo 
		 
			 '
			     <section id="features" class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="device-container">
                        <div class="">
                            <div class="device">
                                <div class="screen">
			 
			 
		
                    <img class="img-responsive" src="img/product_image/'.$pid.'.'.$ext.'"data-role="fitImage" data-format="fill">
		 </div>
		




		 <div class="button">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="container-fluid">
                        <div class="row">

						 <div class="col-md-12">
                                <div>


		  <h2>'.$prod_title.'</h2>
                                    <h3><small>price: </small>&#8369; '.number_format($price, 2, '.', ',').'</h3>
                                    <p align="justify">'.$prod_desc.'</p>

		  <br/>
   

		
			<div class="grid no-margin-top">
			<form method="post" action="user.php">
	   	<div class="input-control text" data-role="input">
	   <input type="hidden" class="form-control" name="qty" value="1" placeholder="1">
	   </div>   
        <input name="pid" type="hidden" value="'.$pid.'" />
	    <button type="submit" class="btn btn-success btn-lg" name="addcart">Add to Cart </button>
	    <br>
		 <br>	
	    Mode of payment: <select class="" name="modepayment">
	    	<option value="shipping">Paypal</option>
	    	<option value="cod">Cash On Delivery</option>
	    <select>		
		 </form>
		 </div>
		</div>	
		</div>
		</div>';
			  
	
        }
    } else {
	    echo "<div id='error'>Invalid Id</div>";
		
    }
}
?>

                                </div>
                            </div>
                             <?php
                                    echo '
                                     <h3><small></small></h3>
                                   
                                    
                                    ';
                                              
 
								   ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
      </div>
      </div>
      </div>
      </div>
      
      <hr>
<?php include 'template/footer.php';?>
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>