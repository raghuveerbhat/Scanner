<!---
#Title: filter.php
#Use: Used to formulate the query when the filters are selected in the search.php page
#CSS: No CSS
#Javascipt: No Javascript
#php: Uses PHP and MySQL
-->
<?php
//This function is called from search.php
function filter(&$queryr,&$queryb,&$bidR,&$x,&$filter)
{
	//&$queryr - Reference to the $queryr in search.php
	//&$queryb - Reference to the $queryb in search.php
	//&$bidR - Reference to the $bidR in search.php
	//&$x - Reference to the $x in search.php
	//&$filter - Reference to the $filter in search.php ( Used to store the different filters used)


	$easiness='';
	//Easiness Filter
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	if(!(isset($_POST["EASY-BEG"]) && isset($_POST["EASY-MAS"]) && isset($_POST["EASY-INT"])))
	{
		//The following if else statements are different permutations of checking the checkbox
		if(isset($_POST["EASY-BEG"]) && isset($_POST["EASY-MAS"]))
		{
			$easiness='(Easiness>=0 AND Easiness<=35) OR Easiness>=70';
		}
		else if (isset($_POST["EASY-BEG"]) && isset($_POST["EASY-INT"])) 
		{
			$easiness='Easiness>=35';
		}
		else if(isset($_POST["EASY-MAS"]) && isset($_POST["EASY-INT"]))
		{
			$easiness='Easiness<70';
		}
		else if(isset($_POST["EASY-BEG"]))
		{
			$easiness='Easiness>=70';
		}
		else if(isset($_POST["EASY-INT"]))
		{
			$easiness="Easiness>=35 AND Easiness<=70";
		}
		else if(isset($_POST["EASY-MAS"]))
		{
			$easiness="Easiness>=0 AND Easiness<=35";
		}
	}
	//English Filter
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	$english='';
	if(!(isset($_POST["ENG-SIM"]) && isset($_POST["ENG-ADV"]) && isset($_POST["ENG-INT"])))
	{
		//The following if else statements are different permutations of checking the checkbox
		if(isset($_POST["ENG-SIM"]) && isset($_POST["ENG-ADV"]))
		{
			$english='(Easiness>=0 AND Easiness<=35) OR Easiness>=70';
		}
		else if (isset($_POST["ENG-SIM"]) && isset($_POST["ENG-INT"])) 
		{
			$english='Easiness>=35';
		}
		else if(isset($_POST["ENG-ADV"]) && isset($_POST["ENG-INT"]))
		{
			$english='Easiness<70';
		}
		else if(isset($_POST["ENG-SIM"]))
		{
			$english='Easiness>=70';
		}
		else if(isset($_POST["ENG-INT"]))
		{
			$english="Easiness>=35 AND Easiness<=70";
		}
		else if(isset($_POST["ENG-ADV"]))
		{
			$english="Easiness>=0 AND Easiness<=35";
		}
	}
	//Price
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	$price='';
	if(!(isset($_POST["PRI-LOW"]) && isset($_POST["PRI-HIGH"]) && isset($_POST["PRI-MED"])))
	{
		//The following if else statements are different permutations of checking the checkbox
		if(isset($_POST["PRI-LOW"]) && isset($_POST["PRI-HIGH"]))
		{
			$price='(Easiness>=0 AND Easiness<=35) OR Easiness>=70';
		}
		else if (isset($_POST["PRI-LOW"]) && isset($_POST["PRI-MED"])) 
		{
			$price='Easiness>=35';
		}
		else if(isset($_POST["PRI-HIGH"]) && isset($_POST["PRI-MED"]))
		{
			$price='Easiness<70';
		}
		else if(isset($_POST["PRI-LOW"]))
		{
			$price='Easiness>=70';
		}
		else if(isset($_POST["PRI-MED"]))
		{
			$price="Easiness>=35 AND Easiness<=70";
		}
		else if(isset($_POST["PRI-HIGH"]))
		{
			$price="Easiness>=0 AND Easiness<=35";
		}
	}
	//Readability
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	$readability='';
	if(!(isset($_POST["READ-AVG"]) && isset($_POST["READ-BEST"]) && isset($_POST["READ-GOOD"])))
	{
		//The following if else statements are different permutations of checking the checkbox
		if(isset($_POST["READ-AVG"]) && isset($_POST["READ-BEST"]))
		{
			$readability='(Easiness>=0 AND Easiness<=35) OR Easiness>=70';
		}
		else if (isset($_POST["READ-AVG"]) && isset($_POST["READ-GOOD"])) 
		{
			$readability='Easiness>=35';
		}
		else if(isset($_POST["READ-BEST"]) && isset($_POST["READ-GOOD"]))
		{
			$readability='Easiness<70';
		}
		else if(isset($_POST["READ-AVG"]))
		{
			$readability='Easiness>=70';
		}
		else if(isset($_POST["READ-GOOD"]))
		{
			$readability="Easiness>=35 AND Easiness<=70";
		}
		else if(isset($_POST["READ-BEST"]))
		{
			$readability="Easiness>=0 AND Easiness<=35";
		}
	}
	//Content Organisation
	$content='';
	if(isset($_POST["content"]))
	{
		if($_POST["content"]=="CONT-AVG")
		{
			$content='Cont_Org>=0';
		}
		else
		{
			$filter=$filter.' ::content';
			$content='Cont_Org>50';
		}
	}
	//Illustrations
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	$illustrations='';
	if(!(isset($_POST["ILL-NONE"]) && isset($_POST["ILL-LOT"]) && isset($_POST["ILL-AVG"])))
	{
		//The following if else statements are different permutations of checking the checkbox
		if(isset($_POST["ILL-NONE"]) && isset($_POST["ILL-LOT"]))
		{
			$illustrations='(Easiness>=0 AND Easiness<=35) OR Easiness>=70';
		}
		else if (isset($_POST["ILL-NONE"]) && isset($_POST["ILL-AVG"])) 
		{
			$illustrations='Easiness>=35';
		}
		else if(isset($_POST["ILL-LOT"]) && isset($_POST["ILL-AVG"]))
		{
			$illustrations='Easiness<70';
		}
		else if(isset($_POST["ILL-NONE"]))
		{
			$illustrations='Easiness>=70';
		}
		else if(isset($_POST["ILL-AVG"]))
		{
			$illustrations="Easiness>=35 AND Easiness<=70";
		}
		else if(isset($_POST["ILL-LOT"]))
		{
			$illustrations="Easiness>=0 AND Easiness<=35";
		}
	}
	//Problems and Solutions
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	$problems='';
	if(!(isset($_POST["PROB-AVG"]) && isset($_POST["PROB-BEST"]) && isset($_POST["PROB-GOOD"])))
	{
		//The following if else statements are different permutations of checking the checkbox
		if(isset($_POST["PROB-AVG"]) && isset($_POST["PROB-BEST"]))
		{
			$problems='(Easiness>=0 AND Easiness<=35) OR Easiness>=70';
		}
		else if (isset($_POST["PROB-AVG"]) && isset($_POST["PROB-GOOD"])) 
		{
			$problems='Easiness>=35';
		}
		else if(isset($_POST["PROB-BEST"]) && isset($_POST["PROB-GOOD"]))
		{
			$problems='Easiness<70';
		}
		else if(isset($_POST["PROB-AVG"]))
		{
			$problems='Easiness>=70';
		}
		else if(isset($_POST["PROB-GOOD"]))
		{
			$problems="Easiness>=35 AND Easiness<=70";
		}
		else if(isset($_POST["PROB-BEST"]))
		{
			$problems="Easiness>=0 AND Easiness<=35";
		}
	}
	if(isset($_POST["CONT-UD"]))
	{
		$filter=$filter.' :: Content Upto Date';
	}

	//Size
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	$size='';
	if(!(isset($_POST["SIZE-SL"]) && isset($_POST["SIZE-LG"]) && isset($_POST["SIZE-MD"])))
	{
		if(isset($_POST["SIZE-SL"]) && isset($_POST["SIZE-LG"]))
		{
			$size='(Easiness>=0 AND Easiness<=35) OR Easiness>=70';
		}
		else if (isset($_POST["SIZE-SL"]) && isset($_POST["SIZE-MD"])) 
		{
			$size='Easiness>=35';
		}
		else if(isset($_POST["SIZE-LG"]) && isset($_POST["SIZE-MD"]))
		{
			$size='Easiness<70';
		}
		else if(isset($_POST["SIZE-SL"]))
		{
			$size='Easiness>=70';
		}
		else if(isset($_POST["SIZE-MD"]))
		{
			$size="Easiness>=35 AND Easiness<=70";
		}
		else if(isset($_POST["SIZE-LG"]))
		{
			$size="Easiness>=0 AND Easiness<=35";
		}
	}

	//Scanned Bit Score
	//If all three checkboxes are set,no need to add extra part in the query( equivalent to *)
	$sbs='';
	if(!(isset($_POST["SBS-LW"]) && isset($_POST["SBS-HG"]) && isset($_POST["SBS-MD"])))
	{
		if(isset($_POST["SBS-LW"]) && isset($_POST["SBS-HG"]))
		{
			$sbs='(Easiness>=0 AND Easiness<=35) OR Easiness>=65';
		}
		else if (isset($_POST["SBS-LW"]) && isset($_POST["SBS-MD"])) 
		{
			$sbs='Easiness>=35';
		}
		else if(isset($_POST["SBS-HG"]) && isset($_POST["SBS-MD"]))
		{
			$sbs='Easiness<65';
		}
		else if(isset($_POST["SBS-LW"]))
		{
			$sbs='Easiness>=65';
		}
		else if(isset($_POST["SBS-MD"]))
		{
			$sbs="Easiness>=35 AND Easiness<=65";
		}
		else if(isset($_POST["SBS-HG"]))
		{
			$sbs="Easiness>=0 AND Easiness<=35";
		}
	}





	//CHECK FILTERS
	//These are joined to the already existing queries
	//$filter is used to store the different filters being used
	//$x : if 1 then no Where condition was used before , else 0
	//$bidR : used to store only bids of $queryr because it is needed to produce queryb

	//Produce query if Easiness filter is used
	if(!($easiness==''))
	{
		$filter=$filter.' ::Easiness';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$easiness;
			$bidR=$bidR." WHERE ".$easiness;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$easiness;
			$bidR=$bidR." AND ".$easiness;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if English filter is used
	if(!($english==''))
	{
		$filter=$filter.' ::English';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$english;
			$bidR=$bidR." WHERE ".$english;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$english;
			$bidR=$bidR." AND ".$english;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if Price filter is used
	if(!($price==''))
	{
		$filter=$filter.' ::Price';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$price;
			$bidR=$bidR." WHERE ".$price;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$price;
			$bidR=$bidR." AND ".$price;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if Readability filter is used
	if(!($readability==''))
	{
		$filter=$filter.' ::readability';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$readability;
			$bidR=$bidR." WHERE ".$readability;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$readability;
			$bidR=$bidR." AND ".$readability;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if Content Organisation filter is used
	if(!($content==''))
	{
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$content;
			$bidR=$bidR." WHERE ".$content;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$content;
			$bidR=$bidR." AND ".$content;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if Illustrations filter is used
	if(!($illustrations==''))
	{
		$filter=$filter.' ::illustrations';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$illustrations;
			$bidR=$bidR." WHERE ".$illustrations;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$illustrations;
			$bidR=$bidR." AND ".$illustrations;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if Problems and Solutions filter is used
	if(!($problems==''))
	{
		$filter=$filter.' ::problems';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$problems;
			$bidR=$bidR." WHERE ".$problems;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$problems;
			$bidR=$bidR." AND ".$problems;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if Size filter is used
	if(!($size==''))
	{
		$filter=$filter.' ::size';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$size;
			$bidR=$bidR." WHERE ".$size;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$size;
			$bidR=$bidR." AND ".$size;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
	//Produce query if Scanned Bit Score filter is used
	if(!($sbs==''))
	{
		$filter=$filter.' ::sbs';
		if($x==1)
		{
			$queryr=$queryr." WHERE ".$sbs;
			$bidR=$bidR." WHERE ".$sbs;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
			$x=0;
		}
		else{
			$queryr=$queryr." AND ".$sbs;
			$bidR=$bidR." AND ".$sbs;
			$queryb="SELECT * FROM books where Bid IN ( $bidR ) ";
		}
	}
}
?>