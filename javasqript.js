/**
 * @author Simon Jare
 */

$(document).ready(function() {
	
	$(".search").keyup(function() {
		var searchbox = $(this).val(); // get the string in the searchbox
		var dataString = 'searchword=' + searchbox;
		if (searchbox == '') {
			//window.location = "index.php"

		} else {
			$.ajax({
				type : "POST",
				url : "search.php",
				data : dataString,
				dataType : "xml",
				async: false,
				cache : false,
				success : function(data, textStatus, jqXHR) {
                    //Data repsonse from server
                    $("#mainFeed").html('');
                    var htmlString = '';
                    console.log(data);
                    var pictureNumbers = data.getElementsByTagName("picture");
                    var pictureNumber, i;
                    console.log(pictureNumbers);
					//get the xml info via javasqript
					for(i = 0; i < pictureNumbers.length; i++){
                       
                        pictureNumber = pictureNumbers[i];
                        data = pictureNumber;
						var picUrl = $(data).find('picurl').text();
						var picUser = $(data).find('picuser').text();
						var picTime = $(data).find('pictime').text();
						var picID = $(data).find('picid').text();
						
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
		//return false;
		
		
		
	});
}); 