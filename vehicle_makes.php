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
	<style type="text/css">
		table { 
			width:800px; 
			border:1px navy solid; 
			border-collapse:collapse; 
			margin-bottom:50px;
			margin-right:400px;
		}
	</style>
</head>

<body>
	<header id="header">
		<?php include('header.php'); ?>
	</header>
	
	<div id="container">
		<?php include('make_nav.php'); ?>
		
		<div id="content">
			<?php include('loggedinas.php'); ?>
				<br>
				<h2>Vehicle Makes</h2>
				<br>
				<?php 
				$sql = "SELECT * FROM makes";
				$result = mysqli_query($mysqlconn, $sql);
				if(mysqli_num_rows($result) > 0)
				{
					echo '<table> <tr><th>Edit</th> <th>Delete</th> <th>Name</th> </tr>';
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<tr>
								<td><a href="edit_make.php?id=' . $row["id"] . '">Edit</a></td> 
								<td><a href="delete_make.php?id=' . $row["id"] . '">Delete</a></td> 
								<td>' . $row["name"] . '</td></tr>';
					}
					echo '</table>';
				}
			?>
		</div>
	</div>

	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>

</html>