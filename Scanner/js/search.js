$(document).ready(function(){
		//Autocomplete
		  $( function() {
    		var availableTags = [
    		  "Algorithms and Data Structures",
   		 	  "C",
   		 	  "DBMS",
   		 	  "IOS Development",
   		 	  "Android Development",
   		 	  "Windows Development",
   		 	  "Computer Networks",
   		 	  "Cryptography",
   		 	  "Photoshop",
   		 	  "Illustrator",
   		 	  "Data Mining",
   		 	  "Machine Learning",
   		 	  "Computer Architecture",
              "C++",
      		  "Java",
      		  "JavaScript",
       		  "Perl",
     		  "PHP"
    ];
    $( "#search" ).autocomplete({
      source: availableTags,
       messages: {
        noResults: '',
        results: function() {}
    }
    });
   } 
  );

		//This function is used to animate the search button
		$(function(){
			var searchField=$('#search');
			var icon=$('.searchbutton');
			//If there is focus on the searchField
			$(searchField).on('focus',function(){
				$(this).animate({
					//increase the width by 2
					width:'400px'
					},400);
				$(icon).animate({
					//move the search button to accomadate the increase
					left:'1010px'
					},400);
			});
			//If nothing is entered in the searchField
			$(searchField).on('blur',function(){
				if(searchField.val()==""){
					$(searchField).animate({
						//make the width as initial width
						width:'200px'
					},400,function(){});
					$(icon).animate({
						//bring back the search button to intital position
						left:'810px'
					},400,function(){});
				}
			});
  		});



		//This code will execute if back button of the big black box is clicked.It will make the box invisible 
		$("#big-results").find("#back").on('click',function(){
			$("#big-results").removeClass().addClass("big-resultsiv");
		});


		//This function is used to set the general progressbars in the book div. Intitally all values are set to 75
        $(function(){

        	//sets easiness progress bar
			var progressbar = $( ".easiness" );
	  	    progressbar.progressbar({
        		  value: 75
       		 });
       		 var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#ff0000'
        	 });

        	 //sets english progress bar
      	     var progressbar = $( ".english" );
	  	    progressbar.progressbar({
        		  value: 75
       		 });
       		 var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#f7f60a'
        	 });

        	 //sets readability progress bar
        	 var progressbar = $( ".readability" );
	  	    progressbar.progressbar({
        		  value: 75
       		 });
       		 var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#00ff00'
        	 });

        	 //sets price progress bar
        	 var progressbar = $( ".price" );
	  	    progressbar.progressbar({
        		  value: 75
       		 });
       		 var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#0aeaf7'
        	 });

        	 //sets illustrations progress bar
        	 var progressbar = $( ".illustrations" );
	  	    progressbar.progressbar({
        		  value: 75
       		 });
       		 var progressbarValue = progressbar.find( ".ui-progressbar-value" );
      	     progressbarValue.css({
         		 "background": '#b419e4'
        	 });

        })

    function display(i,arr){
    	$("#characteristics").html(
    		'<div id="cTitle">Ratings</div>'+
		'<div id="ratings">'+
			'<label>Easiness</label>'+
			'<div id="rEasiness"></div>'+
			'<label>English</label>'+
			'<div id="rEnglish"></div>'+
			'<label>Readability</label>'+
			'<div id="rReadability"></div>'+
			'<label>Price</label>'+
			'<div id="rPrice"></div>'+
			'<label>Content Organisation</label>'+
			'<div id="rContent"></div>'+
			'<label>Accuracy</label>'+
			'<div id="rAccuracy"></div>'+
			'<label>Size</label>'+
			'<div id="rSize"></div>'+
			'<label>Problems and Solution</label>'+
			'<div id="rProblem"></div>'+
		'</div>'+
		'<img src="'+arr[i]['Path']+'" id="rImg">'


    		);

    }




})

