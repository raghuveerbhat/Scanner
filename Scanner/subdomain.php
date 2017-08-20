<!---
#Title: subdomain.php
#Use: Used for displaying different subdomains
#CSS: search.css
#Javascipt: Uses script tag with JQuery and JQuery UI
#php: Uses PHP and MySQL to display different subdomains
-->

<?php
	//connect to the scanner database
	$conn=mysqli_connect('localhost','root','','Scanner') or die("Error");	
	$subdomain='';
	//If there is a GET method from the domains page
	if(isset($_GET['fn']))
	{
		//convert the input domain name to upper case
		$subdomain=strtoupper($_GET['fn']);
		//Query to find different dubdomains in the given domain
		$query='SELECT Subname FROM subdomain WHERE DID IN ( SELECT DID FROM domain WHERE Dname="'.$subdomain.'")';
	}
	else{
		//If there is no GET method,redirect to search.php
		header("location:search.php");
	}
	//Store subdomain query
	//execute the query and get the result
	$result=mysqli_query($conn,$query);
	//used to store the results
	$sArr=array();
	$i=1;
	//Stores every query in the $sArr
	while($row=mysqli_fetch_array($result)){
		$sArr[$i]=$row;
		$i++;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Scanned Bits-Subdomain</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/logo.ico" />
	<link rel="stylesheet" type="text/css" href="css/search.css">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<script type="text/javascript">
	//if the document is ready after everything is loaded
		$(document).ready(function(){

			//Get number of rows 
			var no_rows=parseInt("<?php echo mysqli_num_rows($result);?>");

			//convert the php array to javascript array through JSON
			var arr = <?php echo json_encode($sArr); ?>;

			//If there are no rows , Display error
			if(no_rows==0){
				$("#results-table").html("<h1 style='font-family:font1;'>Sorry No Subdomains found !</h1>");
			}

			//Display the table contents
			var col=1;
			var row=1;

			//For each rows create a table element
			//col keeps track of columns where each tr has 4 tds
			for(var i=1;i<=no_rows;i++){
				//for first column,create a new row (tr)
				if(col==1){
					row++;
					$("#results-table").append("<tr id='row"+row+"'></tr>");
				}
				//Create a random colour for the div
				var rand = Math.floor(Math.random()*999999);
				//create the td element
				$("#row"+row).append('<td>'+
					'<div class="subdomain" style="background:#'+rand+'">'+
					'<a href="search.php?fn='+arr[i]['Subname']+'&id=$id"></a>'+
					'</div>'+
					'<div id="subdomain-title">'+arr[i]['Subname']+'</div>'+
				'</td>');
			col++;
			col=col%4;	
			};
		});

	</script>
</head>
<body>
<div id="container" style="width: 100vw;height: 100vh;">
	<div id="header-container">
		<div id="header-buttons">
			<div id="logo"><a href="index.php"><img src="img/logoheader.png"></a></div>
			<!-- This is the search form and the animation is controlled using Jquery-->
			<form method="post" action="search.php" name="searchform">
			<div class="ui-widget"><input name="search" id="search" placeholder="Search"></div>
			<input type="submit" name="searchbutton" class="searchbutton" value="">
			</form>
		</div>
	</div>
<div id="results">
	<table id="results-table">
	<!-- This is the part where all the results will be displayed-->
	</table>
</div>
</div>
</body>
</html>