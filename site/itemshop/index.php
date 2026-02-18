<?php
	// error_reporting(0);
	session_start();
	require("../user/config.php");
	mysqli_query($sqlServ, 'SET NAMES utf8');
?>
<!DOCTYPE html>
<html lang="hu" >
	<head>
		<?php include("./head.php"); ?>
	</head>
	<body class="twoColFixLtHdr" scroll="no">
		<?php
			if(isset($_GET['s']) && !empty($_GET['s'])) {
				if(file_exists("./pages/".$_GET['s'].".php")) {
					include("./pages/".$_GET['s'].".php");
				} else {
					include("./pages/home.php");
				}
			} else {
				include("./pages/home.php");
			}?>
	</body>
</html>
<?php mysqli_close($sqlServ); ?>
