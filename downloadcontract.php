<?php 

	include 'include/check_login.php';
	  	include 'include/connectdb.php';

	  	$type = $_POST['type'];

	$sql = mysql_query("SELECT * FROM uploaded_contract_template_file WHERE type='$type'");

				$requestCount = mysql_num_rows($sql);

				$filename = "";

				  if ($requestCount > 0) {
				     while ($row = mysql_fetch_array($sql)) {

				     	$filename = $row['file_name'];

				   }
				}
				$fileName = 'admin/contracttemplate/' . $filename;


				//Download the database file
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/pdf');
			    header('Content-Disposition: attachment; filename='.basename($fileName));
			    header('Content-Transfer-Encoding: binary');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($fileName));

			    @readfile($fileName);
	

 ?>