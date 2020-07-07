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
			margin-right:300px;
		}

		td { 
			border:1px navy solid; 
			padding:1px 0 1px 4px; 
			text-align:left; 
		}

		th { 
			border:1px navy solid; 
			padding:1px 0 1px 4px; 
			text-align:center; 
		}
	</style>
</head>

<body>
	<header id="header">
		<?php include('header.php'); ?>
	</header>
	
	<div id="container">
		<?php include('reg_users_page_nav.php'); ?>
		<div id="content">
			<?php include('loggedinas.php'); ?>
			<br>
			<h2>Registered Users</h2>
			<?php 
				
				$sql = "SELECT user_id, user_name, last_name, first_name, email, 
								DATE_FORMAT(registration_date, '%M, %d, %Y') as registration_date
						FROM users";
				$result = mysqli_query($mysqlconn, $sql);
				if(mysqli_num_rows($result) > 0)
				{
					echo '<table> <tr><th>Edit</th> <th>Delete</th> <th>Name</th> <th>Username</th> <th>Email</th> 
							<th>Date Registered</th></tr>';
					while($row = mysqli_fetch_assoc($result))
					{
						if($row["user_name"] != ($_SESSION['user_name']))
						{
							echo '<tr>
									<td><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td> 
									<td><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td> 
									<td>' . $row["last_name"] . ', ' . $row["first_name"] . '</td> 
									<td>' . $row["user_name"] . '</td> <td>' . $row["email"] . '</td>
									<td>' . $row["registration_date"] . '</td></tr>';
						}
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