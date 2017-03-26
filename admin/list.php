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
				header("Location:login.php");
				exit();
			}
			?>
<?php
//out of stock
$outofstock = "";
$osQuery= mysql_query("SELECT * FROM products WHERE stock=0 ORDER BY id DESC LIMIT 5");
     if (mysql_num_rows($osQuery)==0){
        $outofstock = "<h4 class='alert_error'>No data found</h4>";
    }
    else {
        while($row = mysql_fetch_array($osQuery)){
          $prod_name = $row['product_name'];
          $prod_id = $row ['id'];
          
          /* 
           <div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
            */
           $outofstock .= '<div class="list"><a href="edit_prod.php?id='.$prod_id.'">'.$prod_name.'</a></div><br/>';
          
        }
    }

?>
<?php
//critical
$critical = "";
$cQuery= mysql_query("SELECT * FROM products WHERE stock<=40 and stock>0 ORDER BY id DESC LIMIT 5");
     if (mysql_num_rows($cQuery)==0){
        $critical = "<div class='message'><p>No data found</div>";
    }
    else {
        while($row = mysql_fetch_array($cQuery)){
          $prod_name = $row['product_name'];
          $stock = $row['stock'];
          $prod_id = $row ['id'];
          
          /* 
           <div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
            */
           $critical .= '<a href="edit_prod.php?id='.$prod_id.'">'.$prod_name.' | <strong>Stock: '.$stock.'</strong></a><br/>';
          
        }
    }

?>
<?php
    $sql = mysql_query("SELECT * FROM products ORDER BY id");
	$prodCount = mysql_num_rows($sql); // Counting the database product
	
	$sql = mysql_query("SELECT * FROM products WHERE stock < 41 AND stock > 0");
	$stockCount = mysql_num_rows($sql); // Counting the database product critical
	
	$sql = mysql_query("SELECT * FROM products WHERE stock >=40 AND stock >=40");
	$instockCount = mysql_num_rows($sql); // Counting the database product in-stock
	
	$sql = mysql_query("SELECT * FROM products WHERE stock = 0");
	$outofstock = mysql_num_rows($sql); // Counting the database product out of stock
	
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
            <h1>Products <small></small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

        <div class="row">
    <h2>Product Status</h2>
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Stock Critical</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $stockCount ?></span></div>
                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Out of Stock</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $outofstock?></span></div>
                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Sufficient</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $stockCount?></span></div>
                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

			   <div class="row">
            <h2>Product List</h2>
            <div class="table-responsive">
            
            
              <table class="table table-striped">
<thead>
<tr>
<th width="12%">Image</th>
<th width="21%">Product name</th>
<th width="10%">Price</th>
<th width="9%">Stock</th>
<th width="12%">Display</th>
<th width="14%">Status</th>
<th width="14%">Action</th>
<th width="8%">Logs</th>
</tr>
</thead>


<tbody>
<?php
	if(isset($_get['critical'])){
		$critical = $_get['critical'];
		$sql = mysql_query("SELECT * FROM products WHERE stock < 41 ORDER BY id DESC");
		$productCount2 = mysql_num_rows($sql); // count the output amount
		
		if ($productCount2 > 0) {
			while($row = mysql_fetch_array($sql)){ 
            	$id = $row["id"];
		   		$prod_title = $row["product_name"];
			 	$price = $row["price"];
			  	$prod_desc  = $row["details"];
			    $ext  = $row["ext"];
			    $stock=$row['stock'];
			    $category = $row["category"];
				$sub_category = $row["sub_category"];
				$display = $row["status"];

				if($stock <=40 && $stock > 0){
				 	$s_status = '<span style="color: #F00">Critical &nbsp;<a href="list.php?productid='.$id.'" title="Update Stock"><span class="icon-pencil"></a></span>';
				}else if($stock == 0){
					$s_status = '<span style="color: #333">0 Stock &nbsp;<a title="Update Stock" href="list.php?productid='.$id.'"><span class="icon-pencil"></a></span>';
				}else{
					$s_status= '<span style="color: #090">Sufficient</span>';
				}
			 
			 echo'<tr>
			 	<td><img src="../img/product_image/'.$id.'.'.$ext.'" height="50"  width="50"/></td>
			 	<td>'.$prod_title.'</td>
				<td>'.$sub_category.'</td>
				<td>'.number_format($price, 2, '.', ',').'</td>
				<td>'.$stock.'</td>
				<td>'.$display.'</td>
				<td>'.$s_status.' </td>
				<td><a href="edit.php?id='.$id.'">Update</a></td>
				<td><a href="logs.php?pname='.$prod_title.'&id='.$id.'">View</a>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
				</td>
				</tr>';
			}
		}
			
	}

	if(isset($_get['out_of_stock'])){
		$critical = $_get['out_of_stock'];
		$critical = $_get['critical'];
		$sql = mysql_query("SELECT * FROM products WHERE stock > 40 ORDER BY id DESC");
		$productCount2 = mysql_num_rows($sql); // count the output amount
		
		if ($productCount2 > 0){
			while($row = mysql_fetch_array($sql)){ 
            	$id = $row["id"];
		   		$prod_title = $row["product_name"];
			 	$price = $row["price"];
			  	$prod_desc  = $row["details"];
			    $ext  = $row["ext"];
			    $stock=$row['stock'];
			    $category = $row["category"];
				$sub_category = $row["sub_category"];
				$display = $row["status"];
			 
			 	if($stock <=40 && $stock > 0){
					$s_status = '<span style="color: #F00">Critical &nbsp;<a href="list.php?productid='.$id.'" title="Update Stock"><span class="icon-pencil"></a></span>';
				}else if($stock == 40){
					$s_status = '<span style="color: #333">0 Stock &nbsp;<a title="Update Stock" href="list.php?productid='.$id.'"><span class="icon-pencil"></a></span>';
				}else{
					$s_status= '<span style="color: #090">Sufficient</span>';
				}
			 
			 
			 echo'<tr>
				<td><img src="../img/product_image/'.$id.'.'.$ext.'" height="50"  width="50"/></td>
				<td>'.$prod_title.'</td>
				<td>'.number_format($price, 2, '.', ',').'</td>
				<td>'.$stock.'</td>
				<td>'.$display.'</td>
				<td>'.$s_status.' </td>
				<td><a href="edit.php?id='.$id.'">Update</a> </td>
				<td><a href="logs.php?pname='.$prod_title.'&id='.$id.'">View</a>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
				</td>
				</tr>';
			}
		}
	}else{
			
		$stock='';
		$sql = mysql_query("SELECT * FROM products ORDER BY id DESC");
		$productCount2 = mysql_num_rows($sql); // count the output amount
		if ($productCount2 > 0) {
			while($row = mysql_fetch_array($sql)){ 
            	$id = $row["id"];
		   		$prod_title = $row["product_name"];
			 	$price = $row["price"];
			  	$prod_desc  = $row["details"];
			    $ext  = $row["ext"];
			    $stock=$row['stock'];
			    $category = $row["category"];
				$sub_category = $row["sub_category"];
				$display = $row["status"];

				if($display=='active'){
					$display_title='Do not Display on gallery';	 
				}else{
					$display_title='Display on Gallery';	
				}

				if($stock <=40 && $stock > 0){
				 	$s_status = '<span style="color: #F00">Critical &nbsp;<a href="list.php?productid='.$id.'" title="Update Stock"><span class="icon-pencil"></a></span>';
				}else if($stock == 0){
					$s_status = '<span style="color: #333">0 Stock &nbsp;<a title="Update Stock" href="list.php?productid='.$id.'"><span class="icon-pencil"></a></span>';
				}else{
					$s_status= '<span style="color: #090">Sufficient</span>';
				}
			 
			 
			 echo'<tr>
				<td><img src="../img/product_image/'.$id.'.'.$ext.'" height="50"  width="50"/></td>
				<td>'.$prod_title.'</td>
				<td>'.number_format($price, 2, '.', ',').'</td>
				<td>'.$stock.'</td>
				<td>'.$display.' <a title="'.$display_title.'" href="list.php?activate='.$id.'" alt="Display on gallery"><span class="icon-pencil"></a></				td>
				<td>'.$s_status.' </td>
				<td><a href="edit.php?id='.$id.'">Update</a> </td>
				<td>
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal'.$id.'">View</button>
				</td>
				</tr>';
				?>
				<!-- Modal -->
				  <div class="modal fade" id="myModal<?php echo $id;?>" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Inventory Logs of <?php echo $prod_title; ?></h4>
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
				<?php
	}
}
			}	
			
?>

</tbody>

</table>
    			</div>
         
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
