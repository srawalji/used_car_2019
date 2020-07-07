<?php
	session_start();
	
	include 'mysqlconn.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>National University Car Dealership System</title>
	<meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<header id="header">
		<?php include('header.php'); ?>
	</header>

	<div id="container">
		<?php include('member_page_nav.php'); ?>
		
		<div id="content">
			<?php include('loggedinas.php'); ?>
			<br>
			<img src="images/autos-shares.jpg">
		</div>
	</div>

	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>

</html>
