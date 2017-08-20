<!---
#Title: login.php
#Use: Used for the user to login
#CSS: login.css
#Javascipt: -
#php: Uses PHP and MySQL
-->

<?php
/*Create a session.
 A session is a way to store information (in variables) to be used across multiple pages.*/
session_start();

//used to import the connect.php file
require_once('connect.php');

/*check if superglobals i.e. $_POST(array) is set or not.....
 $_POST is set when we fill the form of method="post" and it contains
 all the values entered in the form  */
$pwd="";
$db_password="";
if (isset($_POST['username']) & isset($_POST['password']))
{
	//remove the slashes and tags to avoid SQL Injection
	$username = stripslashes(strip_tags($_POST['username']));
	$pwd = stripslashes(strip_tags($_POST['password']));

	//Remove special char
	$username = mysqli_real_escape_string($connection, $username);
	$pwd = md5(mysqli_real_escape_string($connection, $pwd));

	//get the info of the user and store it in $result
	$query = "SELECT * FROM `users` WHERE username='$username' LIMIT 1";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	//store the result in $row array
	$row = mysqli_fetch_array($result);
	//Get the Uid
	$id = $row['Uid'];

	//Get the database password 
	$db_password = $row['Password'];
	//Check if passwords match
	if($pwd == $db_password)
	{	
		//create a session cookie and go to home.php
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $id;
		header("Location: home.php");
	}
	
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="img/logo.ico" />
	<title>Scanned Bits-Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div id="container">
		<a href="index.php"><img src="img/logoheader.png"></a>
		<div id="selection">
			<a type="button" name="login" href="login.php" id="login">Login</a>
			<a type="button" name="register" href="register.php" id="register">Register</a>
		</div>
		<div id="form">
		<form method="post" name="loginform" id="loginform">
			<input type="text" name="username" id="username" required="required" placeholder="username"></br>
			<input type="password" name="password" id="password" required="required" placeholder="password">
			<input type="submit" name="submit" value="Login">
		</form>
		<div class="error">
		<?php
			if($pwd != $db_password){
				echo "<h1 class='error'>Please check the username and password</h1>";
			}
		?>
		</div>
		</div>
	</div>
</body>
</html>