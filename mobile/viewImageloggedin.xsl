<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match = "liugram">
		<html>
			<head>
				<title>LiU-Gram - View Image</title>
				<link rel="stylesheet" type="text/css" media="screen" href="mobile.css"/>
			</head>
			<body>
				<header>
					<div id = "headerContent">
						<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
						<a id = "uploadlink" href = "uploadImage.php"> Upload Image! </a>
						<a id = "signoutlink" href = 'logout.php'>Sign out!</a>
						<p class = "loggedinas">Logged in as <a class = "userlink" href = "userProfile.php"><xsl:value-of select = "username"/></a></p>
					</div>

				</header>

				<div id = "pagewrapper">
					<h2> View Image </h2>
					<a id = "back" href = "index.php">Go back!</a>
					<div id = "mainFeed">
						<xsl:apply-templates select = "picture"/>
						<xsl:apply-templates select = "comment"/>

					</div> 
				</div>

			</body>

		</html>
	</xsl:template>

	<xsl:template match = "picture">
		<div id = "expandedImage">
			<p class = "username">Uploaded By: <xsl:value-of select = "picuser"/></p>
			<img width = "99%" src = "{picurl}" alt = "test"/>
			<h3> Description: </h3>
			<p><xsl:value-of select = "description"/></p>
		</div>

		<div id = "comments">
			<h3> Comments </h3>
			<xsl:apply-templates select = "comment"/>
		</div>

		<div id = "addcomment">
			<p>Write new comment!</p>

				<form action = "addNewComment.php?pictureID={picid}" method = "post">
					<ul id = "commentlist">
						<li><textarea name = "newcomment" cols = "55" rows = "10">Write new comment...</textarea></li>
						<li><input class = "button" name = "publishComment" type = "submit" value = "Add Comment"/></li>
					</ul>
				</form>


				<p style = "margin: 20px;"> Share this image on twitter! </p>
				<a href="https://twitter.com/share" class="twitter-share-button" data-text="Check out this image on LiU-Gram!" data-url="http://bit.ly/viewImage?pictureID={picid}" data-counturl="http://localhost:8888/TNM065/repo/viewImage.php?pictureID={picid}" data-size="large" data-lang="en">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</xsl:template>

	<xsl:template match = "comment">
			<div id = "comment">
				<p class = "username"><xsl:value-of select = "commentuser"/></p>
				<p class = "commenttime"><xsl:value-of select = "commenttime"/></p>
				<p class = "commenttext"><xsl:value-of select = "commenttext"/></p>

		</div>
	</xsl:template>

</xsl:stylesheet>