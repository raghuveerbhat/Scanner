<!---
#Title: home.php
#Use: Used to show index.php if a user has logged in
#CSS: home.css
#Javascipt: script.js
#php: Uses PHP and MySQL
-->

<?php
/*Used to check whether a user has logged in or not. 
If not logged in then it redirects to login.php */
	session_start();
	if(!isset($_SESSION['id']))
	{
		header("Location: login.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="img/logo.ico" />
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<title>Scanned Bits</title>
</head>
<body>
<!--Used to store the elements. This covers entire screen-->
<div class="container">
	<!--Used to store the header elements-->
	<div id="header-container">
		<!--Used to store the header buttons -->
		<div id="header-buttons">
			<!--Stores the header logo-->
			<div id="logo"><a href="index.php"><img src="img/logoheader.png"></a></div>
			<!--Search button which on submit redirects to search.php-->
			<form method="post" action="search.php">
			<input type="text" name="search" id="search" placeholder="Search">
			<input type="submit" name="searchbutton" class="searchbutton" value="">
			</form>
			<!--About and Logout button-->
			<a href="logout.php" class="button" id="login">Logout <?php echo substr( $_SESSION['username'], 0,5).'.';?>
			<a href="about.php" class="button" id="about">About</a>
		</div>
	</div>
	<!-- Used to display the different domains in tabular format-->
	<table id="listTable">
		<tr>
			<td>
				<!--The href leads to search.php through a get method-->
				<a href="search.php?fn=algorithms%20and%20data%20structures&id=$id"><img src="img/algorithms.png" id="tableImage"></a>
			</td>
			<td>
				<a href="subdomain.php?fn=programming&id=$id"><img src="img/programming.png" id="tableImage"></a>
			</td>
			<td>
				<a href="subdomain.php?fn=web&id=$id"><img src="img/web.png" id="tableImage"></a>
			</td>
			<td>
				<a href="subdomain.php?fn=mobile&id=$id.php"><img src="img/android.png" id="tableImage"></a></td>
		</tr>
		<tr>
			<td>
				<a href="search.php?fn=dbms&id=$id"><img src="img/dbms.png" id="tableImage"></a></td>
			<td>
				<a href="subdomain.php?fn=networks&id=$id"><img src="img/networks.png" id="tableImage"></a></td>
			<td>
				<a href="subdomain.php?fn=design&id=$id"><img src="img/design.png" id="tableImage"></a></td>
			<td>
				<a href="subdomain.php?fn=misc&id=$id"><img src="img/misc.png" id="tableImage"></a></td>
		</tr>
	</table>
	<!--Displays the boy in the right bottom-->
	<div id="boy">
	<img src="img/boy.png">
	</div>
</div>
</body>
</html>