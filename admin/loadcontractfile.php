<?php 
	
	$filename = $_GET['filename'];

	$file = 'contracts/' . trim($filename);

	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="' . $filename . '"');
	header('Content-Transfer-Encoding: binary');
	header('Accept-Ranges: bytes');
	@readfile($file);


 ?>