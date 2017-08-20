<!---
#Title: connect.php
#Use: Used to connect to the scanner database
#CSS: No CSS
#Javascipt: No Javascript
#php: Connection
-->

<?php
//Used to connect to the db 
$connection = mysqli_connect("localhost","root","") or die("Couldn't connect to server!");
mysqli_select_db($connection,"scanner") or die("Couldn't connect to the database!");

?>