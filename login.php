<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'mysqlconn.php';?>
	<title>National University Car Dealership System</title>
	<meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<header id="header">
		<?php include('header.php'); ?>
	</header>
	
	<h2>Login</h2>
	<div id="container">
		<?php
			$username = '';
			$password = '';
		
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				if (!empty($_POST['username']))
				{
					$username = $_POST['username'];
				}
				
				if (!empty($_POST['password']))
				{
					$password = $_POST['password'];
				}
			}
		
			$sql = "SELECT user_name, password, is_admin FROM users WHERE user_name = '$username' AND password = SHA1('$password') ";
			$result = mysqli_query($mysqlconn, $sql);
			
			if(mysqli_num_rows($result) == 1)
			{
				session_start();
				
				$_SESSION = mysqli_fetch_array($result, MYSQLI_BOTH);
				#$_SESSION['username'] = $username;
				$_SESSION['is_admin'] = (int) $_SESSION['is_admin'];
				if($_SESSION['is_admin'] === 1)
				{
					header('Location:admin_page.php');
				}
				else
				{
					header('Location:member_page.php');
				}
			} 
		?>
		<br>
		<div id="content">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				Username: <input type="text" name="username"><br><br>
				Password: <input type="password" name="password">  &nbsp &nbsp  Between 8 and 12 characters<br><br>
				&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp  
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
				&nbsp &nbsp <input type="submit" name="submit" value="Login">
			</form>
		</div>
	</div>
	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>


</html>