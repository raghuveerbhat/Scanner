<!---
#Title: search.php
#Use: Used for displaying different books and ratings
#CSS: search.css
#Javascipt: Uses script tag with JQuery and JQuery UI
#php: Uses PHP and MySQL to display different books
-->

<?php
	//start the session
	session_start();

	//include the filter.php if there is a filtering of results required
	include_once 'filter.php';

	//connect to the scanner database
	$conn=mysqli_connect('localhost','root','','Scanner') or die("Error");	

	//Elements required for filtering
	$x=0;
	$filter='';

	//If there is a POST method from the search button
	if(isset($_POST['search'])&&$_POST['search']!='')
	{
		//the subdomain will be converted to uppercase and query is formed
		$subdomain=strtoupper($_POST['search']);
		$queryb="SELECT * FROM books WHERE Sid in ( SELECT Sid FROM subdomain WHERE Subname='$subdomain')";
		$queryr="SELECT * FROM ratings WHERE Bid in (SELECT Bid FROM books WHERE Sid in ( SELECT Sid FROM subdomain WHERE Subname='$subdomain'))";
		$bidR="SELECT bid FROM ratings WHERE Bid in (SELECT Bid FROM books WHERE Sid in ( SELECT Sid FROM subdomain WHERE Subname='$subdomain'))";
	}
	//If there is a GET method from domains or subdomains page
	else if(isset($_GET['fn']))
		{	
			//The GET value is made as tge subdomain and query is formed
			$subdomain=$_GET['fn'];
			$queryb="SELECT * FROM books WHERE Sid in ( SELECT Sid FROM subdomain WHERE Subname='$subdomain')";
			$queryr="SELECT * FROM ratings WHERE Bid in (SELECT Bid FROM books WHERE Sid in ( SELECT Sid FROM subdomain WHERE Subname='$subdomain'))";
			$bidR="SELECT bid FROM ratings WHERE Bid in (SELECT Bid FROM books WHERE Sid in ( SELECT Sid FROM subdomain WHERE Subname='$subdomain'))";
			//GET value is unset 
			unset($_GET['fn']);
		}
	//If none of the above occur, display all the results
	else
		{
			$x=1;
			$queryb='SELECT * FROM books';
			$queryr='SELECT * FROM ratings';
			$bidR='SELECT Bid FROM ratings';
		}

	//call the filter funcion for any filtering
	filter($queryr,$queryb,$bidR,$x,$filter);

	//The query is ordered by Bid for perfect matching
	$queryr=$queryr.' ORDER BY Bid';
	$queryb=$queryb.' ORDER BY Bid';


	//Books Query to be processed
	$result=mysqli_query($conn,$queryb);

	//to store book results
	$bArr=array();
	$i=1;
	while($row=mysqli_fetch_array($result)){
		$bArr[$i]=$row;
		$i++;
	}

	//Ratings Query to be processed

	$result=mysqli_query($conn,$queryr);

	//to store ratings results
	$rArr=array();
	$i=1;
	while($row=mysqli_fetch_array($result)){
		$rArr[$i]=$row;
		$i++;
	}
?>
<!DOCTYPE html>
<html>
<head>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/logo.ico" />
	<link rel="stylesheet" type="text/css" href="css/search.css">
	<!--<link rel="stylesheet" href="css/jquery-ui.css">-->
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<title>Scanned Bits</title>
	<script>
	//If the document is read and loaded
	$(document).ready(function(){
		//get number of rows from php
		var no_rows=parseInt("<?php echo mysqli_num_rows($result);?>");

		//convert the php array to javascript array through JSON
		var bRowArray = <?php echo json_encode($bArr); ?>;
		var rRowArray = <?php echo json_encode($rArr); ?>;

		//If there are no rows , Display error
		if(no_rows==0){
			$("#results-table").html("<h1 style='font-family:font1;'>Sorry No books found !</h1>");
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
			//Append to each row the div structure
			$("#row"+row).append('<td><div class="book-container" style="width:186px;height:280px;" id="book-container'+i+'">'+
				'<img src="'+bRowArray[i]['Path']+'" id="bookimg" class="imgnoblur">'+
				'<div id="book" class="bookiv">'+
					'<div id="easiness'+i+'" class="easiness">Easiness</div>'+
					'<div id="english'+i+'" class="english">English</div>'+
					'<div id="readability'+i+'" class="readability">Readability</div>'+
					'<div id="price'+i+'" class="price">Price</div>'+
					'<div id="illustrations'+i+'" class="illustrations">Illustrations</div>'+
				'</div>'+
				' <button id="title" value="'+i+'">'+bRowArray[i]['Bname']+'</button>'+
				'</div></td');

			//set the values for different progressbars
			$("#easiness"+i).progressbar({
				value:parseInt(rRowArray[i]['Easiness'])
			});
			$("#english"+i).progressbar({
				value:parseInt(rRowArray[i]['English'])
			});
			$("#readability"+i).progressbar({
				value:parseInt(rRowArray[i]['Readability'])
			});
			$("#price"+i).progressbar({
				value:parseInt(rRowArray[i]['Price'])
			});
			$("#illustrations"+i).progressbar({
				value:parseInt(rRowArray[i]['illustrations'])
			});
			col++;
			col=col%4;			
		}

		//This part is used to sense the hover on the books(JQuery)
		//This is only a part of the code that will use php with it later. Other part is in js/script.js
		for(var j=1;j<=no_rows;j++){
				$("#book-container"+eval(""+j)).on('mouseenter',function(){
				//If there is a hover on BOOK(i)
				//Show the book div which is behind the book image
				//Make the book image blur and grayscale
				//Make the cursor as pointer
				//If the book is clicked, make the big black box who's initial visibility is hidden , is shown
				$(this).find("#book").removeClass().addClass("bookshow");
				$(this).find("#bookimg").removeClass().addClass("imgblur");
				$(this).css({"cursor":"arrow"});
				$(this).find("#title").on('click',function(){
					$("#big-results").removeClass().addClass("big-resultsshow");
					display(rRowArray,bRowArray,parseInt($(this).val()));

				})
				});
				//when the cursor leaves the book
				$("#book-container"+eval(""+j)).on('mouseleave',function(){
					//If the mouse leaves BOOK(i)
					//make the book div visibility as hidden behind the book image
					//Bring back the blur and color
					$(this).find("#book").removeClass().addClass("bookiv");
					$(this).find("#bookimg").removeClass().addClass("imgnoblur");
				});
			}
		//To display contents in the big black box
	function display(results,books,i){
			$("#characteristics").html(
    		'<div id="cTitle">'+bRowArray[i]['Bname']+'</div>'+
		'<div id="ratings">'+
			'<label>Easiness  '+results[i]["Easiness"]+'/100</label>'+
			'<div id="rEasiness"></div>'+
			'<label>English  '+results[i]["English"]+'/100</label>'+
			'<div id="rEnglish"></div>'+
			'<label>Readability  '+results[i]["Readability"]+'/100</label>'+
			'<div id="rReadability"></div>'+
			'<label>Price  '+results[i]["Price"]+'/100</label>'+
			'<div id="rPrice"></div>'+
			'<label>Content Organisation  '+results[i]["Cont_Org"]+'/100</label>'+
			'<div id="rContent"></div>'+
			'<label>Accuracy  '+results[i]["accuracy"]+'/100</label>'+
			'<div id="rAccuracy"></div>'+
			'<label>Size  '+results[i]["Size"]+'/100</label>'+
			'<div id="rSize"></div>'+
			'<label>Problems and Solution  '+results[i]["Problems"]+'/100</label>'+
			'<div id="rProblem"></div>'+
			'<label>Illustrations '+results[i]["illustrations"]+'/100</label>'+
			'<div id="rIllustrations"></div>'+
		'</div>'+
		'<div id="author">'+
		'<p>'+
			'<span style="text-decoration: underline;color:#fddb11;font-size:15px;">Author:</span></br>'+books[i]["Author"]+'</br>'+
			'<span style="text-decoration: underline;color:#fddb11;font-size:15px;">Publisher:</span></br>'+books[i]["Publisher"]+'</br>'+
		'</p>'+
		'</div>'+
		'<img src="'+bRowArray[i]['Path']+'" id="rImg">');

		//Sets the progress bar values and colors
		var progressbar = $( "#rEasiness" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]['Easiness'])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#ff0000'
        	 });
        var progressbar = $( "#rEnglish" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]['English'])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#2564ff'
        	 });
       	var progressbar = $( "#rReadability" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]['Readability'])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#329932'
        	 });
       	var progressbar = $( "#rPrice" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]["Price"])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#d415b0'
        	 });
        var progressbar = $( "#rContent" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]["Cont_Org"])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#FF8C00'
        	 });
        var progressbar = $( "#rAccuracy" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]["accuracy"])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#6d69a1'
        	 });
        var progressbar = $( "#rSize" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]["Size"])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#329932'
        	 });
        var progressbar = $( "#rProblem" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]["Problems"])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#ff0000'
        	 });
        var progressbar = $( "#rIllustrations" );
	  	    progressbar.progressbar({
        		  value: parseInt(results[i]["illustrations"])
       		 });
       var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#0000ff'
        	 });
	}


	//When apply button is clicked , the filters div is cleared for next filters
	$("#apply").on('click',function(){
		$('#filters-used').html("Filters Used:");
	})
		
 });
	</script>
</head>
<body>
<!--Used to store the elements. This covers entire screen-->
<div class="container">
<!--Used to store the header elements-->
	<div id="header-container">
	<!--Used to store the header buttons -->
		<div id="header-buttons">
			<div id="logo"><a href="index.php"><img src="img/logoheader.png"></a></div>
			<!-- This is the search form and the animation is controlled using Jquery-->
			<form method="post" action="search.php" name="searchform">
			<!--Search button which on submit redirects to search.php-->
			<div class="ui-widget"><input name="search" id="search" placeholder="Search"></div>
			<input type="submit" name="searchbutton" class="searchbutton" value="">
			</form>
		</div>
	</div>
	<!--This is the filters section placed on the left hand side-->
	<!--This has different forms and is applied using apply button-->
	<section id="filter">
		<h1>Filters</h1>
		<!-- When filters are applied , redirect back to the same page-->
		<form method="post"	action="search.php">
			<input type="submit" name="filter" id="apply" value="Apply">
		<!--Display the different filtering options-->
		<p>
			Easiness
			</br><input type="checkbox" name="EASY-BEG" value="EASY-BEG"> <label>Beginner</label><span>  </span>   
			<input type="checkbox" name="EASY-MAS" value="EASY-MAS"> <label>Master</label>
			</br><input type="checkbox" name="EASY-INT" value="EASY-INT"> <label>Intermediate</label>

			</br></br>
			English Level
			</br><input type="checkbox" name="ENG-SIM" value="ENG-SIM"> <label>Simple</label>
			<input type="checkbox" name="ENG-ADV" value="ENG-ADV"> <label>Advanced</label>
			</br><input type="checkbox" name="ENG-INT" value="ENG-INT"> <label>Intermediate</label>
			</br></br>

			Price
			</br><input type="checkbox" name="PRI-LOW" value="PRI-LOW"> <label>Low Price</label>
			</br><input type="checkbox" name="PRI-MED" value="PRI-MED"> <label>Medium Price</label>
			</br><input type="checkbox" name="PRI-HIGH" value="PRI-HIGH"> <label>High Price</label>
			</br></br>

			Readability
			</br><input type="checkbox" name="READ-AVG" value="READ-AVG"> <label>Average</label>
			<input type="checkbox" name="READ-GOOD" value="READ-GOOD"> <label>Good</label>
			</br><input type="checkbox" name="READ-BEST" value="READ-BEST"> <label>Best</label>

			</br></br>
			Content Organisation
			<select name="content">
				<option name="CONT-AVG" value="CONT-AVG">Average</option>
				<option name="CONT-GOOD" value="CONT-GOOD">Good</option>
			</select>

			</br></br>
			Illustrations
			</br><input type="checkbox" name="ILL-NONE" value="ILL-NONE"> <label>None</label>
			<input type="checkbox" name="ILL-AVG" value="ILL-AVG"> <label>Average</label>
			</br><input type="checkbox" name="ILL-LOT" value="ILL-LOT"> <label>Lot</label>

			</br></br>
			Problems and Solutions
			</br><input type="checkbox" name="PROB-AVG" value="PROB-AVG"> <label>Average</label>
			<input type="checkbox" name="PROB-GOOD" value="PROB-GOOD"> <label>Good</label>
			</br><input type="checkbox" name="PROB-BEST" value="PROB-BEST"> <label>Best</label>

			</br></br>
			Content Update
			</br><input type="checkbox" name="CONT-UD" value="CONT-UD"> <label>Up to Date</label>

			</br></br>
			Size
			</br><input type="checkbox" name="SIZE-SL" value="SIZE-SL"> <label>Small</label>
			<input type="checkbox" name="SIZE-MD" value="SIZE-MD"> <label>Medium</label>
			</br><input type="checkbox" name="SIZE-LG" value="SIZE-LG"> <label>Large</label>

			</br></br>
			Scanned Bit Score(SBS)
			</br><input type="radio" name="SBS-LW" value="SBS-LW"> <label> &lt; 35</label>
			</br><input type="radio" name="SBS-MD" value="SBS-MD"> <label> &lt; 65</label>
			</br><input type="radio" name="SBS-HG" value="SBS-HG"> <label>&gt; 65</label>
		</p>
		</form>
	</section>
	<!--This is the results section to display the books . This is placed in the center-->
	<div id="results">
		<!--Used to display the filters currently being used -->
		<div id="filters-used" class="filters-usedy">
		Filters Used:
		<!-- Display the different filters used -->
		<?php
			echo "$filter";
			$filter='';
		?>
		</div>
		<!--Table to display the results ( 4 in each row)-->
		<table id="results-table">
			
					<!--Each book has a container-->
					<!--In front there will be an image of the book-->
					<!--In the back there will a div of same size as image initially hidden-->
					<!--If the user wants to see, the hidden div will be brought forward-->
					<!--The divs in book are actually progressbars which are controlled by JqueryUi-->

		</table>
	</div>
	<!-- Displays the different rating of clicked div-->
	<div id="big-results" class="big-resultsiv">
		<input type="button" id="back" value="Back">
		<div id="characteristics"></div>
	</div>
</div>
</body>
</html>