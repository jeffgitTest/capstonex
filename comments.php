<?php
		include 'include/check_login.php';
    include 'include/connectdb.php';
		$userid="";
		 
if (loggedin()){
  $query = mysql_query("SELECT * FROM users WHERE usn='$_SESSION[username]' ");
    while ($row = mysql_fetch_assoc($query)){
			$userid = $row ['id'];
			$usn = $row ['usn'];
      $fname = $row ['fname'];
			}
    }else{	
			// header("Location:login.php");
			// exit();
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

    <style type="text/css">
      li { list-style: none; }
    </style>
</head>

   <title>Comments
   </title>
  <body id="page-top">
  <?php include 'template/style2.php';?>
    <?php include 'template/header2.php';?>\
     <div class="page-content">
        <div class="">
            <div class="container">	
            
			  	  <h1 class="page-header"><a href="index.html" class="nav-button transform"><span></span></a>&nbsp;Comments</h1>  	
            <?php 
              if(isset($_POST['btnComment'])){
                $message = addslashes(strip_tags($_POST['message']));
                if(isset($message) && !empty($message)){
                  $insert_comment = mysql_query("INSERT INTO comments(`message`, `username`) VALUES ('$message','$usn')");
                  if($insert_comment){
                    echo '  <div class="alert alert-success">Thank you for your feedback! We appreciate your concern</div>';
                  }
                }
              }
            ?>
                <div class="no-overflow" >
			             <div id="register"></div><!--for contact status output-->
                    <h2><small>Comments and Feedback</small></h2>
                    <div class="grid col-md-6">   
                      <div class="form-group">
                         <fieldset>
                           <form action="" method="post">
                              <div class="input-control textarea full-size" data-role="input" data-text-auto-resize="true">
                                  <label for="exampleInputPassword">Send</label>
                                  <textarea name="message" required class="form-control"></textarea>
                              </div> 
                              <hr/>
                              <div class="form-group">
                                <input type="submit" name="btnComment" class="btn btn-info" value="SUBMIT">
                              </div>
                            </form>
                          </fieldset>
                          <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="grid col-md-6">
                      <?php 
                        $sql = mysql_query("SELECT * FROM comments WHERE display= 0 order by date desc");
                        $commentCount = mysql_num_rows($sql); // count the output amount
                        if ($commentCount > 0) {
                          while($row = mysql_fetch_array($sql)){
?>
                      <li>
                        <div>
                          <header><a href="#"><?php echo $row['username'];?></a> - <span>posted <?php echo date("Y-m-d H:i:s", strtotime($row['date'])); ?></span></header>
                          <p>
                          <?php 
                            echo $row['message'];
                          ?></p>
                        </div>
                      </li>
<?php
                          }
                        }else{
                          ?>
                          <h1><small>No comments to display</small></h1>
                          <?php
                        }

                      ?>
                    </div>
            </div>
        </div>
		</div><!-- /.container -->
    <hr>
     <?php include 'template/footer.php' ?>
 

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>
    <script src="js/new-age.min.js"></script>

  </body>
</html>