/**
 * @author Simon Jare
 */

$(document).ready(function() {
	
	$(".search").keyup(function() {
		var searchbox = $(this).val(); // get the string in the searchbox
		var dataString = 'searchword=' + searchbox;
		if (searchbox == '') {
			window.location = "index.php"

		} else {
			console.log("Fetchin " + dataString);
			$.ajax({				
				type : "POST",
				url : "search.php",
				data : dataString,
				dataType : "xml",
				cache : false,
				success : function(data, textStatus, jqXHR) {
                    //Data repsonse from server
                    $("#mainFeed").html('');
                    var htmlString = '';
                    
                    var pictureNumbers = data.getElementsByTagName("picture");
                    var pictureNumber,
                         i=0;
                    //Since the inversed does not matter, we can iterate backwards.	
					for (i = pictureNumbers.length - 1; i >= 0; i -= 1) {
                        pictureNumber = pictureNumbers[i];
                  
						var picUrl = $(pictureNumber).find('picurl').text();
						var picUser = $(pictureNumber).find('picuser').text();
						var picTime = $(pictureNumber).find('pictime').text();
						var picID = $(pictureNumber).find('picid').text();
		
						htmlString += '<div class = "photoFrame">';
						htmlString += '<a href ="viewImage.php?pictureID=' + picID + '"><img height = "120" src =' + picUrl + ' alt = "test"/></a>';
						htmlString += '<p class = "username">Uploaded by:' + picUser + '</p>';
						htmlString += '<p class = "pictime">' + picTime + '</p>';
						htmlString += '</div>';
					}
					//set the values into the DOM
					$("#mainFeed").append(htmlString);
				},
			    error: function (jqXHR, textStatus, errorThrown)
			    {
			 
			    }
			});
		}

	});
}); 