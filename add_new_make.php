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
		<?php include('make_nav.php'); ?>
		
		<div id="content">
			<?php include('loggedinas.php'); ?>
			
			<?php
					
					if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {    
						$makeName = $_POST['make_name'];
						$query = "INSERT INTO makes (name)
									VALUES(?)";
						$preparedStmt = @mysqli_prepare($mysqlconn, $query);
						if (@mysqli_stmt_bind_param($preparedStmt, 
                                                    "s", 
                                                    $makeName) 
                                                   &&
                            @mysqli_stmt_execute($preparedStmt))
                        {
                            header("Location: vehicle_makes.php");
                            exit();
                        }
						
						else
                        {
                            $query = "INSERT INTO makes (name)
									VALUES('$makeName')";
                                      
                            $mySqlError = mysqli_error($mysqlconn);
                            echo "<p class='error'>The information of the selected pet could not be added due to a system error. We apologize for any inconvenience.</p>"; 
                            echo "<p>" . $mySqlError . "<br/>Query: " . $query . "</p>";                            
                        }
                    }
                    
					
					
					echo '
					<br>
					<h2>Add Vehicle Make</h2>
					<br>
					<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
						Vehicle Make: <input type="text" name="make_name"><br><br>
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