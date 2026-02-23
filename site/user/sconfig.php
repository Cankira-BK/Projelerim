<?php
	DEFINE('SQL_HOST', '31.58.244.32');
	DEFINE('SQL_USER', 'root');
	DEFINE('SQL_PASS', 'SNooP.789');
	
	$sqlServ = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS);
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
?>