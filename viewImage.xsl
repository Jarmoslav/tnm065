<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match = "liugram">
		<html>
			<head>
				<title>LiU-Gram - View Image</title>
				<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
			</head>
			<body>
				<header>
					<div id = "headerContent">
						<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
						<a id = "signinlink" href = 'login.php'>Sign in!</a>
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
			<p>Uploaded By: <a href = "#" class = "userlink"><xsl:value-of select = "picuser"/></a></p>
			<img width = "700" src = "{picurl}" alt = "test"/>
			<h3> Description: </h3>
			<p><xsl:value-of select = "description"/></p>
		</div>

		<div id = "comments">
			<h3> Comments </h3>
			<xsl:apply-templates select = "comment"/>
		</div>

	</xsl:template>

	<xsl:template match = "comment">
			<div id = "comment">
				<p><a href = "#" class = "userlink"><xsl:value-of select = "commentuser"/></a></p>
				<p class = "commenttime"><xsl:value-of select = "commenttime"/></p>
				<p class = "commenttext"><xsl:value-of select = "commenttext"/></p>
		</div>
	</xsl:template>

</xsl:stylesheet>