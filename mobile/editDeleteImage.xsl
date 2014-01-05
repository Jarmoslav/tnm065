<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match = "liugram">
		<html>
			<head>
				<title><xsl:value-of select = "username"/> - edit</title>
				<link rel="stylesheet" type="text/css" media="screen" href="mobile.css"/>
			</head>
			<body>
				<header>
					<div id = "headerContent">
						<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
						<a id = "uploadlink" href = "index.php"> Back to Feed! </a>
						<a id = "signoutlink" href = "logout.php"> Logout </a>
						<p class = "loggedinas">Logged in as <a class = "userlink" href = "userProfile.php"><xsl:value-of select = "username"/></a></p>
					</div>

				</header>

				<div id = "pagewrapper">
					<h2>Edit image description or delete image</h2>
					<div id = "mainFeed">
						<a id = "back" href = "userProfile.php">Go back!</a>
						<div id = "expandedImage">
							<img width = "95%" src = "{picture/picurl}" alt = "test"/>
							<form method = 'post' action = 'editDeleteImage.php?pictureID={picture/picid}' id = 'editForm'>
								<p> Description </p>
								<ul id = 'commentlist'>
									<li><textarea name = 'newDescr' cols = '30' rows = '5'><xsl:value-of select = "picture/description"/></textarea></li>
									<li><input class = 'button' name = 'editDescr' type = 'submit' value = 'Edit Description'/></li>
								</ul>
							</form>
							<button id = 'delete' form = "editForm" name = 'deleteButton' formmethod = 'POST' type = 'submit'> Delete Image </button>
						</div>						
					</div> 
				</div>

			</body>

		</html>
	</xsl:template>

</xsl:stylesheet>