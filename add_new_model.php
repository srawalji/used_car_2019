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
		form { 
			margin-right:180px; 
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
			<?php
				if($_SERVER['REQUEST_METHOD'] == 'POST')
				{
					$modelName = $_POST['model_name'];
					$makeId = $_POST['make_select'];
					$query = "INSERT INTO models (name, make_id) VALUES ('$modelName', '$makeId')";
					
					if(!mysqli_query($mysqlconn, $query))
					{
						die('Error: ' . mysqli_error($mysqlconn));
					}
					else
					{
						header("Location: vehicle_models.php");
					}
					
					mysqli_close($mysqlconn);
				}
				
				
				
				
				$makeSelectOptions = "";
				$query = "SELECT id, name
							FROM makes";
				$result = @mysqli_query($mysqlconn, $query);
				if ($result)
				{
					$makeSelectOptions = "Vehicle Make: &nbsp;<select name='make_select' id='make_select' required>";
					while ($row = @mysqli_fetch_array($result, MYSQLI_BOTH))
					{
						$makeSelectOptions .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
					}           
					$makeSelectOptions .= "</select><br><br>";                             
					@mysqli_free_result($result); 
				}						
										
		
				echo '
					<br>
					<h2>Add Vehicle Model</h2>
					<br>
					<form action="' . $_SERVER['PHP_SELF'] . '"  method="post">
						Vehicle Model: <input type="text" name="model_name">
					<br><br>';
				echo $makeSelectOptions;
				echo '	
					<input type="submit" name="add" value="Add">
				</form>
				
				';
			?>
		</div>
	</div>

	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>

</html>