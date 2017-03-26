

  <?php
  if (isset($_GET['category']))
	{
	
		
				$cat=$_GET['category'];
				$sql = mysql_query("SELECT * FROM products WHERE status='active' AND category='$cat' ORDER BY id DESC");
						$productCount2 = mysql_num_rows($sql); // count the output amount
						if ($productCount2 > 0) 
							{
							while($row = mysql_fetch_array($sql))
										{ 
											$pid = $row["id"];
		   									$prod_title = $row["product_name"];
			    							$price = $row["price"];
			   								$prod_desc  = $row["details"];
			    							$ext  = $row["ext"];
			    							$category = $row["category"];
			    							$timestamp = $row["timestamp"];
											
											echo '
			
    <div class="col-sm-4">
        <div class="thumbnail">
          <img src="img/product_image/'.$pid.'.'.$ext.'" alt="'.$prod_title.'" width="150" height="100">
      
          <a href="details.php?pid='.$pid.'"><button class="btn" data-toggle="modal" data-target="">DETAIL</button></a>
        </div>
      </div>
	  ';}
		}
		else
		{echo '<div class="alert alert-error">No products </div>';}
			
			}
			
else if (isset($_POST['searchP']))
{
	$searchP = addslashes(strip_tags($_POST['searchP']));

	
	//pages
	$per_page = 12;
	$pages_query = mysql_query("SELECT COUNT('id') FROM products WHERE product_name LIKE '%$searchP%' AND status='active'");
    $pages = ceil(mysql_result($pages_query, 0) / $per_page);
	$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
    $start = ($page - 1) * $per_page;
       
    if ($pages >=1 && $page <= $pages)
	{
		for($x=1; $x<=$pages; $x++) 
		{
			$disPage = ($x == $page) ? '<strong><a href="?p='.$x.'" style="color:#e4a817;">'.$x.'</a></strong> ' : ' | <a  href="?p='.$x.' " >'.$x.'</a> ';
			//$pageNum .= $disPage;
		}
	}
				
	$prod_query = mysql_query ("SELECT * FROM products WHERE product_name LIKE '%$searchP%' AND status='active' ORDER BY id DESC LIMIT $start, $per_page ");
	if (mysql_num_rows($prod_query)>0)
	{
	while ($row = mysql_fetch_assoc ($prod_query))
	{
											$pid = $row["id"];
		   									$prod_title = $row["product_name"];
			    							$price = $row["price"];
			   								$prod_desc  = $row["details"];
			    							$ext  = $row["ext"];
			    							$category = $row["category"];
			    							$timestamp = $row["timestamp"];		
			echo '
			
    <div class="col-sm-4">
        <div class="thumbnail">
          <img src="img/product_image/'.$pid.'.'.$ext.'" alt="'.$prod_title.'" width="150" height="100">
      
          <a href="details.php?pid='.$pid.'"><button class="btn" data-toggle="modal" data-target="">DETAIL</button></a>
        </div>
      </div>';
	
	}
	}
	else
	{
		echo "<div class='alert alert-error'>Sorry the product you are trying to find is not avialable in our store</div>";
	}
}
		
		
else{
		 $sql = mysql_query("SELECT * FROM products WHERE status='active' ORDER BY id DESC");
						$productCount2 = mysql_num_rows($sql); // count the output amount
						if ($productCount2 > 0) 
							{
							while($row = mysql_fetch_array($sql))
										{ 
											$pid = $row["id"];
		   									$prod_title = $row["product_name"];
			    							$price = $row["price"];
			   								$prod_desc  = $row["details"];
			    							$ext  = $row["ext"];
			    							$category = $row["category"];
			    							$timestamp = $row["timestamp"];
											
			echo '
			
    <div class="col-sm-4">
        <div class="thumbnail">
          <img src="img/product_image/'.$pid.'.'.$ext.'" alt="'.$prod_title.'" width="150" height="100">
      
          <a href="details.php?pid='.$pid.'"><button class="btn" data-toggle="modal" data-target="">DETAIL</button></a>
        </div>
      </div>
			';
   		}
	}
}
	
							
		

?>