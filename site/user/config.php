<?php
	DEFINE('SQL_HOST', 'BURAYA_IP');
	DEFINE('SQL_USER', 'root');
	DEFINE('SQL_PASS', 'SIFRE');
	
	$sqlServ = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS);
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
?>