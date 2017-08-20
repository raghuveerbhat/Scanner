<!---
#Title: logout.php
#Use: Used for the user to logout
#CSS: -
#Javascipt: -
#php: Uses PHP and MySQL
-->

<?php
//To destroy the session
session_start();

session_destroy();


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!--When refreshed redirects to index.php after 1 sec-->
<meta http-equiv="refresh" content="1;url=index.php" />
</body>
</html>