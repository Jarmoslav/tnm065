<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match = "root">
		<html>
			<head>
				<title>LiU-Gram</title>
				<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
			</head>
			<body>
				<header>
					<div id = "headerContent">
						<a href = "index.xml" id = "heading"><h1>LiU-Gram, ser fult ut just nu, Design kommer!</h1></a>

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
			<img height = "120" src = "{picurl}" alt = "test"/>
			<p>Uploaded by: <xsl:value-of select = "picuser"/></p>
		</div>
	</xsl:template>

</xsl:stylesheet>