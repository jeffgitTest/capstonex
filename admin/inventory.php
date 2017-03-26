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

      function isBestSeller ($productid) {

        $found = 0;

        $query = mysql_query("SELECT products.id, SUM( transactions.qty ) AS total_qty
FROM transactions
INNER JOIN products ON transactions.product_id_array = products.id
GROUP BY products.id
ORDER BY total_qty DESC
LIMIT 5");
          while ($row = mysql_fetch_assoc($query))
          {
          
            if($row['id'] == $productid) {
              $found++;
            }
          }

          return $found > 0;

      }

      function getCritLevel($type) {

        $query = ($type == 'bs') ? "SELECT * FROM critical_level where type='bs'" : "SELECT * FROM critical_level where type='nbs'";
        $critlevelbs = "";
        $sql = mysql_query($query);

         while ($row = mysql_fetch_assoc($sql))
          {
          
            $critlevel = $row['crit_level'];
          }

          return $critlevel;

      }

      function updateCriticalLevel($type, $value) {
        $query = "UPDATE critical_level SET crit_level='$value' where type='$type'";

        mysql_query($query);
      }


      if (isset($_POST['submitcrit'])) {
        
        $critlevel = $_POST['critlevel'];
        $critlevel2 = $_POST['critlevel2'];

        updateCriticalLevel('bs', $critlevel);
        updateCriticalLevel('nbs', $critlevel2);

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
    <link href="css/sb-admin.css" rel="stylesheet">-->
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
            <h1>Inventory <small></small></h1>

           <hr>
          </div>
        </div><!-- /.row -->

       <div class="row">
       <div class="table-responsive">
        <table class="table table-striped">
          <thead>
                  
    <th>Product name</th>
    <th>Sold</th>
    <th>Stock Now</th>
    <th>Stock Before</th>
     <th>Status</th>
     <th>Action</th>
	 		    </thead>
          <tbody>
  				   <?php 
//Run a select query to get my latest 3 items

include ('../include/connectdb.php');  

// $bestSellerCritLevel = getCritLevel('bs');
// $criticalLevel = getCritLevel('nbs');

$sql = mysql_query("SELECT products.*, critical_level.product_id, critical_level.crit_level FROM products INNER JOIN critical_level ON products.id=critical_level.product_id ORDER BY product_name ASC");
$productCount = mysql_num_rows($sql); // count the output amount
$count = 0;

$productid = "";
$critLevel = "";

if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
			$id = $row['id'];
      $pname = $row["product_name"];

      $productid = $row['product_id'];
      $critLevel = $row['crit_level'];

			$stock_query = mysql_query("SELECT qty_added as stock, SUM(qty_added) as sold FROM product_history WHERE pid = $id ORDER BY Date asc limit 1");
      $stock_query_count = mysql_num_rows($stock_query); // count the output amount
		  $previous_stock='empty';
      $lessted_value='empty';
      if ($stock_query_count > 0) {
      // output data of each row
        while($stock_row = mysql_fetch_array($stock_query)) {
          if(!empty($stock_row['stock'])){
            $previous_stock = $stock_row['stock'];
          }
          if(!empty($stock_row['sold'])){
            $lessted_value = $stock_row['sold'];
          }
        }
      } 
      // if(!empty($result->fetch_row()['stock'])){
      //   $previous_stock = $stock_query->fetch_row()[0];
      // }
      // if(!empty($stock_query->fetch_row()['sold'])){
      //   $lessted_value = $stock_query->fetch_row()[1];
      // }
			 // $lessted_value= $row["lessted_value"];
			  $current_stock = $row["stock"];
			   // $previous_stock = $row["previous stock"];
			    // $date = $row["date"];

      
          if($current_stock <= $critLevel){
         $status = '<span style="color: #F00">Critical</span>';
         }
         else if($current_stock == 0){
            $status = '<span style="color: #333">0 Stock</span>';
           }
           else{
             $status = '<span style="color: #090">Sufficient</span>';
             }

			
	 
   
	echo '
  <tr>
	    <td>'.$pname.'</td>
    <td>'.$lessted_value.'</td>

    <td>'.$current_stock.'</td>
     <td >'.$previous_stock.'</td>
	  <td>'.$status.'</td>
	 <td><button class="btn btn-info btn-lg pull-left" data-toggle="modal" data-target="#myModal'.$count.'">View History</button></td>
  </tr>
  ';

  ?>
    <!-- Modal -->
          <div class="modal fade" id="<?php echo 'myModal'.$count;?>" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Log History of <?php echo ucfirst($pname);?></h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-4 col-md-auto">History ID</div>
                    <div class="col-sm-4 col-md-auto">Modified Quantity</div>
                    <div class="col-sm-4 col-md-auto">Date Modified</div>
                  </div>
                      <?php 
                          $prod_invent = mysql_query("SELECT * FROM product_history WHERE pid='$id'");
                          $prod_invent2 = mysql_num_rows($prod_invent); // count the output amount
                          if ($prod_invent2 > 0) {
                            while($rowInvet = mysql_fetch_array($prod_invent)){ 
                            echo "
                            <div class='row justify-content-md-center'>
                              <div class='col-sm-4 col-md-auto'>".$rowInvet['id']."</div>
                              <div class='col-sm-4 col-md-auto'>".$rowInvet['qty_added']."</div>
                              <div class='col-sm-4 col-md-auto'>".$rowInvet['date']."</div>
                            </div>";
                      }
                    }
                        ?>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div> 
              
            </div>
          </div>
          <!-- End of Modal -->
  <?php
  $count++;
    }
} 
else 
{
	$product_list = "You have no products listed in your store yet";
}
?>


    		</tbody>		
     
   	      </table>
       </div>
        </div><!-- /.row -->

        <!-- <button class="btn btn-warning btn-lg pull-left" data-toggle="modal" data-target="#myModal">Update Critical Level</button> -->


        <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Set Critical Level</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    
                  <form action="inventory.php" method="post">
                    <label>Critical level for best sellers:</label> <input class="form-control" type="text" value="<?php echo getCritLevel('bs'); ?>" name="critlevel"> <br>
                    <label>Critical level for non best sellers:</label> <input class="form-control" value="<?php echo getCritLevel('nbs'); ?>" type="text" name="critlevel2"> <br>
                    <input class="btn btn-primary" type="submit" name="submitcrit" value="Submit">
                  </form>

                  </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div> 
              
            </div>
          </div>
     
		
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
