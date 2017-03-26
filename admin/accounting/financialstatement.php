<?php 

	include "../include/connectdb.php";


 ?>

 MUTYA <br>
 INCOME STATEMENT <br>


 <table style="width: 200px">
 	
	<thead>
		<th><b>Revenue:</b></th>
	</thead>

	<tbody>
		
		<?php 

	 	$sql = mysql_query("SELECT sum(mc_gross) FROM transactions");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalamount = $row['sum(mc_gross)'];

		      echo "
		        <tr>
		          <td align='center'><b>Sales:</b></td>
		          <td align='center'><b>$totalamount</b></td>
		        </tr>

		      ";
		  }
		}

	  ?>

	</tbody>

 </table>

 <table style="width: 200px">
 	
	<thead>
		<th align="left"><b>Expenses:</b></th>
	</thead>

	<tbody>
		
		<?php 

		$sql = mysql_query("SELECT * FROM expenses");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $id = $row['id'];

		     $name = $row['name'];
		     $amount = $row['amount'];

		      echo "
		        <tr>
		          <td align='center'>$name</td>
		          <td align='center'>$amount</td>
		        </tr>

		      ";


		     }
		  }

	 ?>

	 <?php 

	 	$sql = mysql_query("SELECT sum(amount) FROM expenses");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalamount = $row['sum(amount)'];

		      echo "
		        <tr>
		          <td><b>Total Expenses:</b></td>
		          <td><b>$totalamount</b></td>
		        </tr>

		      ";
		  }
		}

	  ?>

	</tbody>

 </table>

 <table style="width: 200px">
 	
	<?php 

		$totalsales = 0;
		$totalexpenses = 0;
		$netincome = 0;

	 	$sql = mysql_query("SELECT SUM(mc_gross) AS total_sales FROM transactions");
		$requestCount = mysql_num_rows($sql);

		if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		     $totalsales = $row['total_sales'];

		      
		  }
		}

		
		$sql2 = mysql_query("SELECT SUM(amount) AS total_expenses FROM expenses");
		$requestCount2 = mysql_num_rows($sql2);

		if ($requestCount2 > 0) {
		     while ($row = mysql_fetch_array($sql2)) {

		     $totalexpenses = $row['total_expenses'];

		  }
		}

		$netincome = $totalsales - $totalexpenses;
		
		echo "
		        <tr>
		          <td><b>Net Income:</b></td>
		          <td><b>$netincome</b></td>
		        </tr>

		      ";

	  ?>

 </table>

