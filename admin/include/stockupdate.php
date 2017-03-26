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

				if($_POST['update'] == "Deduct Stock"){
					mysql_query("UPDATE products SET stock= stock - '$stock' WHERE id='$pid'");
					mysql_query("INSERT INTO product_history(`pid`,`qty_added`) VALUES('$pid', '-$stock')");
				}

				header("Location: edit.php?id=$pid&success&pnm=".$row['product_name']."&stock=".$stock);

				
			// }
		}else{
			echo 'Invalid id';
		}	
	}
}
if(isset($_GET['success'])){
		echo '<div class="alert alert-success"> '.$_GET['stock'].' Products Added to '.$_GET['pnm'].' | In-Stock '.$_GET['stock'].' <a href="list.php">View </a></div>';
	}

?>
<form action="edit.php?id=<?php echo $targetID?>" method="post" >
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
	
	 <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
<!-- <input type="submit" name="update" class="btn btn-primary btn-lg pull-left" value="Deduct Stock"> -->