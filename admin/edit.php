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
		//	exit();
			}
			?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
   <!-- <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="css/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php'?>
		<?php include 'template/top.php'?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Edit Products <small></small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

        <div class="row">
       		<div class="col-lg-5">
          <?php 
		  include 'include/edit.php';
		  ?>        
          </div>
          
          <div class="col-lg-5 pull-right">
          <?php 
		  
		  include 'include/stockupdate.php';
		  ?>  

      <!-- this is to be continued -->
        <!--   <button class="btn btn-info btn-lg pull-left" data-toggle="modal" data-target="#ModalDeduct'">Deduct</button>
          <div class="modal fade" id="ModalDeduct" role="dialog">
              <div class="modal-dialog"> -->
                <!-- Modal content-->
        <!--         <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Log History of</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-4 col-md-auto">History ID</div>
                      <div class="col-sm-4 col-md-auto">Modified Quantity</div>
                      <div class="col-sm-4 col-md-auto">Date Modified</div>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div> 
              </div>
            </div>
 -->
<!-- end of to be edit -->

        </div><!-- /.row -->
     
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>
