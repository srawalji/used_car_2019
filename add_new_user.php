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
	<style type="text/css">
		form { 
			margin-right:200px; 
		}
	</style>
</head>

<body>
	<header id="header">
		<?php include('header.php'); ?>
	</header>

	<div id="container">
		<?php include('reg_users_page_nav.php'); ?>
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$password = SHA1($_POST['password']);
				$regdate = date("Y-m-d H:i:s");
				if($_POST['isadmin'] == '1')
				{
					$isadmin = 1;
				}
				else
				{
					$isadmin = 0;
				}
				
				$query = "INSERT INTO users (user_name, first_name, last_name, email, password, is_admin, registration_date)
							VALUES ('$_POST[username]', '$_POST[firstname]', '$_POST[lastname]', '$_POST[emailaddress]', '$password', '$isadmin', '$regdate')";
				
				if(!mysqli_query($mysqlconn, $query))
				{
					die('Error: ' . mysqli_error($mysqlconn));
				}
				else
				{
					header("Location: reg_users_page.php");
				}
				
				mysqli_close($mysqlconn);
			}
		?>
		
		
		<div id="content">
			<?php include('loggedinas.php'); ?>
			<h2>Add User</h2><br>
			<form method="post">
				<label>User Name: </label>
					<input type="text" id="user-name" name="username"
					value="<?php if(isset($_POST['user-name']))echo $_POST['user-name']; ?>" ><br><br>
					
				<label>First Name: </label>
					<input type="text" id="first-name" name="firstname"
					value="<?php if(isset($_POST['first-name']))echo $_POST['first-name']; ?>" ><br><br>
				
				<label>Last Name: </label>
					<input type="text" id="last-name" name="lastname"
					value="<?php if(isset($_POST['last-name']))echo $_POST['last-name']; ?>" ><br><br>

				<label>Email Address: </label>
					<input type="text" id="email-address" name="emailaddress"
					value="<?php if(isset($_POST['email-address']))echo $_POST['email-address']; ?>" ><br><br>
			
				<label>Password: </label>
					<input type="password" id="password" name="password"
					value="<?php if(isset($_POST['password']))echo $_POST['password']; ?>" ><br><br>
				
				<label>Is Admin </label>
					<input type="checkbox" id="isadmin" name="isadmin" value="1"
					value="<?php if(isset($_POST['isadmin']))echo $_POST['isadmin']?>"><br><br>

				<input type="submit" id="submit" name="submit"
						value="Add">
				
			</form>
		</div>
	</div>

	<footer>
		<?php include('footer.php'); ?>
	</footer>
</body>

</html>