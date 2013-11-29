<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match = "liugram">
		<html>
			<head>
				<title>LiU-Gram</title>
				<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
			</head>
			<body>
				<header>
					<div id = "headerContent">
						<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
						<a id = "signinlink" href = '#'>Sign in!</a>
					</div>

				</header>

				<div id = "pagewrapper">
					<h2> Picture Feed </h2>
					<div id = "mainFeed">
						<xsl:apply-templates />
					</div> 
				</div>

			</body>

		</html>
	</xsl:template>

	<xsl:template match = "picture">
		<div class = "photoFrame">
			<a href = 'viewImage.php?pictureID={picid}'><img height = "120" src = "{picurl}" alt = "test"/></a>
			<p>Uploaded by: <a class = "userlink" href="#"><xsl:value-of select = "picuser"/></a></p>
			<p class = "pictime"><xsl:value-of select = "pictime"/></p> 
		</div>
	</xsl:template>

</xsl:stylesheet>