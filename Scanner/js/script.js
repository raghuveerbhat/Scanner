$(document).ready(function(){
			var width=$(window).width();
			var height=$(window).height();
			//console.log("width:"+width+" Height:"+height);
			$(window).resize(function(){
				width=$(window).width();
				height=$(window).height();
				//console.log("width:"+width+" Height:"+height);
				if(width<=800){
					$('#boy').hide();
				}
				else{
					$('#boy').show();
				}
				if(width<=1000 && height<=700){
					//console.log('Changed');
					jQuery("[id=tableImage]").css({"width":"200px","height":"200px"});
				}
				else{
					jQuery("[id=tableImage]").css({"width":"240px","height":"240px"});
				}
			})
$(function(){
	var searchField=$('#search');
	var icon=$('.searchbutton');

	$(searchField).on('focus',function(){
		$(this).animate({
			width:'400px'
		},400);
		$(icon).animate({
			left:'810px'
		},400);
	});

	$(searchField).on('blur',function(){
		if(searchField.val()==""){
			$(searchField).animate({
				width:'200px'
			},400,function(){});
			$(icon).animate({
				left:'610px'
			},400,function(){});
		}
	});
  });
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
})

