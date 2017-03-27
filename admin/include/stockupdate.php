<?php 
if(isset($_POST['update'])){
	$pid=$_POST['pid'];
	$stock=$_POST['stock'];
	  $errors = array();

	if(!preg_replace('#[^0-9]#i', '',$stock)){
		$errors[] = '<div class="alert alert-error">Please input numbers only</div>';
	}

	if(empty($stock)){
		$errors[] = '<div class="alert alert-error">Stock Field Cannot be empty</div>';
	}

	if (!empty($errors)){
		foreach ($errors as $error){
			echo $error, '<br/>';
		}
	}else{
		$sql = mysql_query("SELECT * FROM products WHERE id='$pid' LIMIT 1");
		$productCount = mysql_num_rows($sql); // count the output amount
		$row = mysql_fetch_array($sql, MYSQL_ASSOC);
		if ($productCount > 0) {
			// while($row = mysql_fetch_array($sql)){ 
			// 	$pid = $row["id"];
			// 	$ustock = $row["stock"];
			// 	$pnme=$row['product_name'];
			// 	$update_stock = $ustock + $stock;
			// 	$notice="";

			// 	if($stock>1){$notice='stocks';}else{$notice='stock';}
				if($_POST['update'] == "Add Stock"){
					mysql_query("UPDATE products SET stock= stock + '$stock' WHERE id='$pid'");
					mysql_query("INSERT INTO product_history(pid,qty_added) VALUES('$pid','$stock')");
				}

				header("Location: edit.php?id=$pid&success&pnm=".$row['product_name']."&stock=".$stock);

				
			// }
		}else{
			echo 'Invalid id';
		}	
	}
}


if(isset($_GET['deduct'])) {
	if(!empty($_POST){
		$pid		=$_POST['pid'];
		$fname 		= $_POST['fname'];
		$lname 		= $_POST['lname'];
		$stock   	= $_POST['qty'];
		$receipt 	= $_POST['receipt'];
		$emailAdd 	= $_POST['emailAdd'];
		$cn 		= $_POST['cn'];
	}
	mysql_query("UPDATE products SET stock= stock - '$stock' WHERE id='$pid'");
	mysql_query("INSERT INTO product_history(`pid`,`qty_added`) VALUES('$pid', '-$stock')");
}

if(isset($_GET['success'])){
		echo '<div class="alert alert-success"> '.$_GET['stock'].' Products Added to '.$_GET['pnm'].' | In-Stock '.$_GET['stock'].' <a href="list.php">View </a></div>';
	}

?>
<form action="edit.php?id=<?php echo $targetID?>&deduct" method="post" >
          <h4 class="modal-title">Stock Update</h4>   
        <fieldset>
       <br />
  	 <div class="form-group">
      <div class="form-group col-lg-12">
      <input type="text" autofocus required name="stock" id="stock" class="col-lg-4 " placeholder="0">
      <input type="hidden" required name="pid" id="pid" class="input-xlarge" value="<?php echo $targetID ?>">
      </div>
    </fieldset>       
<input type="submit" name="update" class="btn btn-primary btn-lg pull-left" value="Add Stock">

</form>
<a class="btn btn-info btn-lg pull-left" data-toggle="modal" data-target="#ModalDeduct" ui-sref="deduct">Deduct</a>
<!-- <button class="btn btn-info btn-lg pull-left" data-toggle="modal" data-target="#ModalDeduct'">Deduct</button> -->


<div class="modal fade" id="ModalDeduct" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Details for deduction</h4>
      </div>
      <div class="modal-body">
      		<form action="edit.php?id=<?php echo $targetID?>&sample" method="post" >
      		
      			
    		<div class="row thead">
               <div class="col-sm-4 col-md-auto">First Name</div>
               <div class="col-sm-4 col-md-auto">Last Name</div>
               <div class="col-sm-4 col-md-auto">Quantity</div>
            </div>
    		<div class="row">
    			<div class="col-sm-4 col-md-auto">
    				<input type="text" class="form-control"  name="fname" id="fname" placeholder="First name">
    			</div>
                <div class="col-sm-4 col-md-auto">
                	<input type="text" class="form-control"  name="lname" id="lname" placeholder="Last name">
                </div>
                <div class="col-sm-4 col-md-auto">
                	<input type="text" class="form-control"  name="qty" id="qty" placeholder="Items bought">
                </div>
             </div>
            <br>
            <div class="row thead">
               <div class="col-sm-4 col-md-auto">Receipt Number</div>
               <div class="col-sm-4 col-md-auto">Email Address</div>
               <div class="col-sm-4 col-md-auto">Contact</div>
            </div>
    		<div class="row">
    			<div class="col-sm-4 col-md-auto">
    				<input type="text" class="form-control"  name="receipt" id="receipt" placeholder="Input OR">
    			</div>
                <div class="col-sm-4 col-md-auto">
                	<input type="text" class="form-control"  name="emailAdd" id="emailAdd" placeholder="EmailAdd">
                </div>
                <div class="col-sm-4 col-md-auto">
                	<input type="text" class="form-control"  name="cn" id="cn" placeholder="Contact Number">
                </div>
             </div>
             
    	</div>
      <div class="modal-footer">
      	<div class="col-sm-2">
      		<input type="hidden" required name="pid" id="pid" class="input-xlarge" value="<?php echo $targetID ?>">
      		<!-- <input type="hidden" required name="payment_type" class="input-xlarge" value="cash">
      		<input type="hidden" required name="payment_status" class="input-xlarge" value="Completed"> -->
        	<input type="submit">
        </div>
      	</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	 <!-- JavaScript -->
   <!--  // <script src="js/jquery-1.10.2.js"></script>
    // <script src="js/bootstrap.js"></script> -->

    <!-- Page Specific Plugins -->
   <!--  // <script src="js/raphael-min.js"></script>
    // <script src="js/morris-0.4.3.min.js"></script>
    // <script src="js/morris/chart-data-morris.js"></script>
    // <script src="js/tablesorter/jquery.tablesorter.js"></script>
    // <script src="js/tablesorter/tables.js"></script> -->
<!-- <input type="submit" name="update" class="btn btn-primary btn-lg pull-left" value="Deduct Stock"> -->

