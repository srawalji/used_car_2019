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
		input {
			margin-right:175px;
		}
		
		table {
			margin-bottom:50px;
		}
	</style>
</head>

<body>
	<header id="header">
		<?php include('header.php'); ?>
	</header>
	
	<div id="container">
		<?php include('model_nav.php'); ?>
		
		<div id="content">
			<?php include('loggedinas.php'); ?>
				<br>
				<h2>Vehicle Make Selection</h2>
				<?php 
					$id = '';
					$sql = "SELECT * FROM makes";
					$result = mysqli_query($mysqlconn, $sql);
					$selected = '';
			
					if(mysqli_num_rows($result) > 0)
					{
						echo 'Select Vehicle Make: ';
						echo '<br><br>';
						echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
						echo '<select name="make" >';
						while($row = mysqli_fetch_assoc($result))
						{
							$selected = $_POST['make'];
							$id = $row["id"];
							if($selected == $id)
							{
								echo '<option value="' . $id . '" selected>' . $row["name"] . '</option>';
							}
							else
							{
								echo '<option value="' . $id . '">' . $row["name"] . '</option>';
							}
						}
						echo '</select>
								<input type="submit" name="submit" value="Submit"></input>
								</form><br><br>';
					}
					
					
					if ($_SERVER['REQUEST_METHOD'] == 'POST')
					{
						if(isset($_POST['submit']))
						{
							$selected = $_POST['make'];  
							$query = "SELECT * FROM models WHERE make_id = '$selected'";
							$result = mysqli_query($mysqlconn, $query);
							if(mysqli_num_rows($result) > 0)
							{
								echo '<h2>Vehicle Models</h2>';
								echo '<table> <tr><th>Edit</th> <th>Delete</th> <th>Name</th> </tr>';
								while($row = mysqli_fetch_assoc($result))
								{
									echo '<tr>
											<td><a href="edit_model.php?id=' . $row["id"] . '">Edit</a></td> 
											<td><a href="delete_model.php?id=' . $row["id"] . '">Delete</a></td> 
											<td>' . $row["name"] . '</td></tr>';
								}
								echo '</table>';
							}
						}
					}
				?>
				
		</div>
	</div>

	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>

</html>