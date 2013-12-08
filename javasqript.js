/**
 * @author Simon Jare
 */

$(document).ready(function(){
	$(".search").keyup(function(){
		var searchbox = $(this).val();
		var dataString = 'searchword='+ searchbox;
		if(searchbox==''){
	     console.log("empty search string");
	     window.location = "index.php"
	     
		}
		else{
			$.ajax({
			type: "POST",
			url: "search.php",
			data: dataString,
			dataType: "xml",
			cache: false,
			beforesend:function(xml){
			$(xml).find(function(){
					console.log(data);
					$('.photoFrame').text(data);
					
			});
           // $(xml).find("<picture>").empty();
            
            },
			success: function(data){
			   $xml = $(data); // gör om till Jqury object. 
			   $title = $xml.find( "picture" );
			   $( "#mainFeed" ).append( $title);
			   console.log(data);
					
					
		
				}
			});
		}return false;
	});
});