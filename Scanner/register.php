<!---
#Title: register.php
#Use: Used for the user to login
#CSS: login.css
#Javascipt: -
#php: Uses PHP and MySQL
-->

<?php
//used to import the connect.php file
require_once('connect.php');

/*check if superglobals i.e. $_POST(array) is set or not.....
 $_POST is set when we fill the form of method="post" and it contains
 all the values entered in the form  */
 $password="password";
 $rpassword="rpassword";
 $result="";
if(isset($_POST) & !empty($_POST))
{

	//sanitize the inputs by removing special characters to prevent SQL Injections

	$firstname = mysqli_real_escape_string($connection, $_POST['fname']);
	$lastname = mysqli_real_escape_string($connection, $_POST['lname']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	
	//md5() is a hashing algo used to hide password

	$password = md5(mysqli_real_escape_string($connection, $_POST['password']));
	$rpassword = md5(mysqli_real_escape_string($connection, $_POST['password2']));

	if($password == $rpassword)
	{
		//Insert query to insert values into db

		$sql = "INSERT INTO `users` (Fname, Lname, Email, Username, Password) VALUES ('$firstname',  '$lastname', '$email', '$username', '$password') ";
		
		$result = mysqli_query($connection, $sql);
	
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
<!--Container stores the entire document which fits the whole screen -->
	<div id="container">
		<a href="index.php"><img src="img/logoheader.png"></a>
		<div id="selection">
			<a type="button" name="login" href="login.php" id="login">Login</a>
			<a type="button" name="register" href="register.php" id="register">Register</a>
		</div>
		<!--Used to represent the registration form with different fields-->
		<div id="regform">
		<!--Redirects to itself after a post method on submitting-->
		<form method="POST" name="loginform" id="registerform">
			<input type="text" name="fname" id="fname" required="required" placeholder="First Name"></br>
			<input type="text" name="lname" id="lname" required="required" placeholder="Last Name"></br>
			<input type="text" name="email" id="email" required="required" placeholder="Email"></br>
			<input type="text" name="username" id="username" required="required" placeholder="username"></br>
			<input type="password" name="password" id="password" required="required" placeholder="password"></br>
			<input type="password" name="password2" id="password2" required="required" placeholder="re-enter password"></br>
			<input type="submit" name="submit" value="Register">
		</form>
		<!--Used to give out a message to the user on successful or unsuccessful registration-->
		<div class="message">
			<?php
				if($password == $rpassword)
				{
					if($result)
					{
						echo "<h1 style='color:green;'>User Regitration successful!</h1>";
					}
					else
					{
						echo "<h1 style='color:red;'>Regitration failed.Check the detailes entered.</h1>";
					}
				}
				else if($password=="password" &&$rpassword=="rpassword"){
					
				}
				else
				{
						echo "<h1 style='color:red;'>password doesn't match</h1>";
				}
			?>
		</div>
		</div>
	</div>
</body>
</html>