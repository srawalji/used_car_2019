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
			<br>
			<h2>Edit Vehicle Model</h2>
			<br>
			
			<?php $id = $_GET['id'];?>
			<?php
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST')
					{
						$modelName = $_POST['model_name'];
					
						$query = "UPDATE models
								SET name = ?
								WHERE id = ?";
					
						$preparedStmt = @mysqli_prepare($mysqlconn, $query);
                        if (@mysqli_stmt_bind_param($preparedStmt, 
                                                    "si", 
                                                    $modelName,
													$id) &&
                            @mysqli_stmt_execute($preparedStmt))
                        {
                            @mysqli_stmt_close($preparedStmt); 
                            header("Location: vehicle_models.php");
                        } 
                        else
                        {
                            $query = "UPDATE models
								SET name = '$modelName'
								WHERE id = '$id'";
                            echo '<p class="error">This page has been accessed in error.</p>';
                            echo "<p>" . @mysqli_error($mysqlconn) . "<br><br/>Query: " . $query . "</p>";                            
                        }                      
                    
					
					}
				
					$query = "SELECT ma.name AS make_name, mo.name AS model_name
						FROM makes ma, models mo
						WHERE ma.id = mo.make_id AND mo.id = ?";
								
					$preparedStmt = @mysqli_prepare($mysqlconn, $query);
                    if (@mysqli_stmt_bind_param($preparedStmt, "i", $id)    && 
                        @mysqli_stmt_execute($preparedStmt)                 &&
                        @mysqli_stmt_bind_result($preparedStmt,
                                                 $makeName,
												 $modelName))
                    {
                        @mysqli_stmt_fetch($preparedStmt);
                        @mysqli_stmt_close($preparedStmt); 
                        
						echo '
						<form action="' . $_SERVER['PHP_SELF'] . '?id=' . $id . '" method="post">
						Vehicle Make: <input type="text" name="model_name" value="' . $modelName . '"><br><br>
						
						Vehicle Make: <input type="text" name="make_name" value="' . $makeName . '" readonly>
						
						<br><br>
							<input type="submit" name="edit" value="Edit">
						</form>';           
                    }
					
                    else 
                    { 
                        $query = "SELECT ma.name AS make_name, mo.name AS model_name
						FROM makes ma, models mo
						WHERE ma.id = mo.make_id AND mo.id = '$id'";
                              
                        echo '<p class="error">This page has been accessed in error.</p>';
                        echo "<p>" . @mysqli_error($mysqlconn) . "<br><br/>Query: " . $query . "</p>";
                    }  
			
			?>
			
		</div>
	</div>

	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>

</html>