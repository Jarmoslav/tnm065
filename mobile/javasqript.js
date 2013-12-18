/**
 * @author Simon Jare
 */

$(document).ready(function() {
	$(".search").keyup(function() {
		var searchbox = $(this).val();
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
				success : function(data) {
					console.log("Fetchin " + dataString);
                    $("#mainFeed").html('');
                    var htmlString = '';
                    console.log(data);
					//get the xml info via javasqript
					var picUrl = $(data).find('picurl').text();
					var picUser = $(data).find('picuser').text();
					var picTime = $(data).find('pictime').text();
					var picID = $(data).find('picid').text();
					
					htmlString += '<div class = "photoFrame">';
					htmlString += '<a href ="viewImage.php?pictureID=' + picID + '"><img height = "120" src =' + picUrl + ' alt = "test"/></a>';
					htmlString += '<p class = "username">Uploaded by:' + picUser + '</p>';
					htmlString += '<p class = "pictime">' + picTime + '</p>';
					htmlString += '</div>';
					//set the values into the DOM
					$("#mainFeed").append(htmlString);
				}
			});
		}
	});
}); 