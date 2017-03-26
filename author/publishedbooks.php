<?php 

	include "include/connectdb.php";

	echo $_SESSION['user_id'];

 ?>

 <table>
 	<thead>
 		<th>Title</th>
 		<th>Author</th>
 		<th>Description</th>
 		<th>Date Added</th>
 	</thead>

	<tbody>
		
		<?php 

			$sql = mysql_query("SELECT products.product_name, author.name, products.details, products.date_added FROM products inner join author on products.author_id=author.id WHERE author.user_id=3");
		  $requestCount = mysql_num_rows($sql);

		  if ($requestCount > 0) {
		     while ($row = mysql_fetch_array($sql)) {

		      $productname = $row['product_name'];
		      $author = $row['name'];
		      $desc = $row['details'];
		      $dateadded = $row['date_added'];

		      echo "
		        <tr>
		          <td>$productname</td>
		          <td>$author</td>
		          <td>$desc</td>
		          <td>$dateadded</td>
		        </tr>

		      ";


		     }
		  }

		 ?>

	</tbody>

 </table>