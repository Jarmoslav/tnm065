<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match = "liugram">
		<html>
			<head>
				<title>LiU-Gram</title>
				<!--javasqript stuffy-->
				<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
				<!-- stylesheets-->
				<link rel="stylesheet" type="text/css" media="screen" href="mobile.css"/>
			

			</head>
			<body>
				<header>
					<div id = "headerContent">

						<a href = "index.php" id = "heading">
							<h1>LiU-Gram</h1>
						</a>
						<a id = "signinlink" href = 'login.php'>Sign in!</a>
						<a id = "rsslink" href = "../indexRSS.php"><img height = "12%" src = '../miscImg/bigrss.png' alt = 'rss'/>Feed as RSS</a>

					</div>

				</header>
				<div id = "pagewrapper">
					<h2>Picture Feed</h2>
					<div id = "mainFeed">
						<xsl:apply-templates />						
					</div>
					
				</div>
				<div id="display"></div>

			</body>

		</html>
	</xsl:template>
	<xsl:template match = "picture">
		<div class = "photoFrame">
			<a href = 'viewImage.php?pictureID={picid}'><img height = "600" src = "{picurl}" alt = "test"/></a>
			<p class = "username">Uploaded by: <xsl:value-of select = "picuser"/></p>
			<p class = "pictime"><xsl:value-of select = "pictime"/></p> 
		</div>
	</xsl:template>

</xsl:stylesheet>