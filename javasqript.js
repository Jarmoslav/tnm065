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
			$.ajax({
				type : "POST",
				url : "search.php",
				data : dataString,
				dataType : "xml",
				cache : false,
				success : function(data) {
                    $("#mainFeed").html('');
                    var htmlString = '';
					//get the xml info via javasqript
					var picUrl = $(data).find('picurl').text();
					var picUser = $(data).find('picuser').text();
					var picTime = $(data).find('pictime').text();
					
					htmlString += '<div class = "photoFrame">';
					htmlString += '<a href ="viewImage.php?pictureID="' + picUrl + '><img height = "120" src = ' + picUrl + ' alt = "test"/></a>';
					htmlString += '<p>Uploaded by:<a class = "userlink" href="#">' + picUser + ' </a></p>';
					htmlString += '<p class = "pictime">' + picTime + '</p>';
					htmlString += '</div>';
					//set the values into the DOM
					$("#mainFeed").append(htmlString);
				}
			});
		}
		return false;
	});
}); 