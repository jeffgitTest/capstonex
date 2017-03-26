<?php 

	include "connectdb.php";

	function insert_bid($type) {

		$sql = mysql_query("INSERT INTO bids (type, active) VALUES ('$type', 1)");

		if (!$sql) {
			echo "Error bids table!";
		}

		return mysql_insert_id();

	}

 ?>