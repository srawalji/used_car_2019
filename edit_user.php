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
		<?php include('reg_users_page_nav.php'); ?>
		
		<div id="content">
			<?php include('loggedinas.php'); ?>
			<br>
			<?php $id = $_GET['id'];?>
			<?php		
					
				if ($_SERVER['REQUEST_METHOD'] == 'POST')
				{
						$userName = $_POST['user_name'];
						$firstName = $_POST['first_name'];
						$lastName = $_POST['last_name'];
						$email = $_POST['email'];
						$password = SHA1($_POST['password']);
						if($_POST['isadmin'] == '1')
						{
							$isAdmin = 1;
						}
						else
						{
							$isAdmin = 0;
						}
					
					$query = "UPDATE users
								SET user_name = ?, 
									first_name = ?, 
									last_name = ?, 
									email = ?, 
									password = ?, 
									is_admin = ?
								WHERE user_id = ?";
					
					$preparedStmt = @mysqli_prepare($mysqlconn, $query);
                        if (@mysqli_stmt_bind_param($preparedStmt, 
                                                    "sssssii", 
                                                    $userName, 
                                                    $firstName, 
                                                    $lastName,
													$email,													
                                                    $password, 
                                                    $isAdmin,
													$id) &&
                            @mysqli_stmt_execute($preparedStmt))
                        {
                            @mysqli_stmt_close($preparedStmt); 
                            header("Location: reg_users_page.php");
                        } 
                        else
                        {
                            $query = "UPDATE users
								SET user_name = '$userName', 
									first_name = '$firstName', 
									last_name = '$lastName', 
									email = '$email', 
									password = '$password', 
									is_admin = '$isAdmin'
								WHERE user_id = '$id'";
                            echo '<p class="error">This page has been accessed in error.</p>';
                            echo "<p>" . @mysqli_error($mysqlconn) . "<br><br/>Query: " . $query . "</p>";                            
                        }                      
                    
					
				}
				
				$query = "SELECT user_name, first_name, last_name, email, is_admin
						FROM users
						WHERE user_id = ?";
								
					$preparedStmt = @mysqli_prepare($mysqlconn, $query);
                    if (@mysqli_stmt_bind_param($preparedStmt, "i", $id)    && 
                        @mysqli_stmt_execute($preparedStmt)                 &&
                        @mysqli_stmt_bind_result($preparedStmt,
                                                 $userName,
												 $firstName,
												 $lastName,													
                                                    $email,													
													$isAdmin
													))
                    {
                        @mysqli_stmt_fetch($preparedStmt);
                        @mysqli_stmt_close($preparedStmt); 
                        
						$password = '';
						
						echo '<h2>Edit User</h2><br>';
						echo '<form action="' . $_SERVER['PHP_SELF'] . '?id=' . $id . '" method="post">
					
								<label>User Name: </label>
									<input type="text" id="user-name" name="username"
									value="' . $userName . '" ><br><br>
									
								<label>First Name: </label>
									<input type="text" id="first-name" name="firstname"
									value="' . $firstName . '" ><br><br>
								
								<label>Last Name: </label>
									<input type="text" id="last-name" name="lastname"
									value="' . $lastName . '" ><br><br>

								<label>Email Address: </label>
									<input type="text" id="email-address" name="emailaddress"
									value="' . $email . '"  ><br><br>
							
								<label>Password: </label>
									<input type="password" id="password" name="password"
									value="' . $password . '"  ><br><br>
								';
								
								if($isAdmin == 1)
								{ 
									echo '<label>Is Admin </label>
									<input type="checkbox" id="isadmin" name="isadmin" 
									value="' . $isAdmin . '" checked><br><br>';
								}
								if($isAdmin == 0)
								{
									echo '<label>Is Admin </label>
									<input type="checkbox" id="isadmin" name="isadmin" 
									value="' . $isAdmin . '" ><br><br>';
								}

								echo '<input type="submit" id="submit" name="submit"
										value="Edit">
			  
                    </form>';                 
                    }
					
                    else 
                    { 
                        $query = "SELECT user_name, first_name, last_name, email, is_admin
						FROM users
						WHERE user_id = '$id'";
                              
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