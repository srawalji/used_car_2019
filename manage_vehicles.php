<?php
	session_start();
	
	include('mysqlconn.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>National University Car Dealership System</title>
	<meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>	
		table { 
			
			border:1px navy solid; 
			border-collapse:collapse; 
			margin-bottom:50px;
			margin-right:600px;
		}
		
		th { 
			border:1px navy solid; 
			padding:1px 0 1px 4px; 
			text-align:center; 
			background-color:black;
			color:white;
		}

	</style>
</head>

<body>
	<header id="header">
		<?php include('header.php'); ?>
	</header>

	<div id="container">
		<?php include('manage_vehicles_nav.php'); ?>
		
		<div id="content">
			<?php include('loggedinas.php'); ?>
			<br>
			<table>
				<tr>
					<th>Domestic</th>
					<th>Foreign</th>
					<th>European</th>
				</tr>
				
				<tr>
					<td>
						<img src="images/domestic.jpg" height="400" width="300">
					</td>
					
					<td>
						<img src="images/foreign.jpg" height="400" width="300">
					</td>
					
					<td>
						<img src="images/european.jpg" height="400" width="300">
					</td>
				</tr>
			</table>
		</div>
	</div>

	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>

</html>