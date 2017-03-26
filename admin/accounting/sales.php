<?php 
	include "../include/connectdb.php";
 ?>

 Sales
 <table>
	<thead>
		<th>Product Name</th>
		<th>Amount</th>
		<th>Quantity</th>
		<th>Purchased Date</th>
	</thead>

	<tbody>
		
		<?php 
		$sql = mysql_query("SELECT products.id, products.product_name, transactions.mc_fee, transactions.qty, transactions.payment_date FROM transactions INNER JOIN products ON products.id = transactions.product_id_array");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $id = $row['id'];

		     $name = $row['product_name'];
		     $amount = $row['mc_fee'];
		     $quantity = $row['qty'];
		     $date = $row['payment_date'];

		      echo "
		        <tr>
		          <td>$name</td>
		          <td>$amount</td>
		          <td>$quantity </td>
		          <td>$date</td>
		        </tr>
		      ";
		     }
		  }

	 	$sql = mysql_query("SELECT sum(mc_gross) FROM transactions");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {
		     $totalamount = $row['sum(mc_gross)'];

		      echo "
		        <tr>
		          <td><b>Total Sales:</b></td>
		          <td><b>$totalamount</b></td>
		        </tr>

		      ";
		  }
		}
	 	$sql = mysql_query("SELECT SUM( transactions.mc_gross ) - SUM( expenses.amount ) AS total_income FROM transactions JOIN expenses");
		$requestCount = mysql_num_rows($sql);
		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalincome = $row['total_income'];

		      echo "
		        <tr>
		          <td><b>Total Income:</b></td>
		          <td><b>$totalincome</b></td>
		        </tr>

		      ";
		  }
		}
	  ?>
	</tbody>
 </table>