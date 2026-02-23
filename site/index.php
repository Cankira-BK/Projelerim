<?php
	// error_reporting(0);
	session_start();
	require("user/config.php");
?>
<!DOCTYPE html>
<html lang="tr" >
	<head>
		<?php include("./head.php"); ?>
	</head>
	<body>
		<?php
			include("./main.php");
			include("./footer.php");
		?>
	</body>
</html>
<?php mysqli_close($sqlServ); ?>
