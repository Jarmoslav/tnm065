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
						<a href = "index.xml" id = "heading"><h1>LiU-Gram</h1></a>
						<a id = "signinlink" href = 'login_check.php'>Sign in!</a>

					</div>

				</header>

				<div id = "pagewrapper">
					<p> This is the wrapper </p>
					<div id = "mainFeed">
						<xsl:apply-templates />
					</div> 
				</div>

			</body>

		</html>
	</xsl:template>

	<xsl:template match = "picture">
		<div class = "photoFrame">
			<a href = "viewImage.php?pictureID={picid}"><img height = "120" src = "{picurl}" alt = "test"/></a>
			<a class = "userlink" href = "#"><p>Uploaded by: <xsl:value-of select = "picuser"/></p></a>
			<p class = "pictime"><xsl:value-of select = "pictime"/></p> 
		</div>
	</xsl:template>

</xsl:stylesheet>