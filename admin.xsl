<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:key name="picuser" match="picture/picuser/text()" use="." />
	<xsl:template match = "liugram">
		<html>
			<head>
				<title>LiU-Gram - Admin</title>
				<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
			</head>
			<body>
				<header>
					<div id = "headerContent">
						<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
						<a href = "logout.php" id = "signoutlink" style = "margin-left: 400px;"> Logout</a>
					</div>
				</header>

				<div id = "pagewrapper">
					<h2> Welcome Administrator! </h2>
					<p> Users in the system sorted alphabetically: </p>

					

					<xsl:for-each select="picture/picuser/text()[generate-id()=generate-id(key('picuser',.)[1])]">
					    
					      <a class = "usersAdmin" href = "manageUsers.php?userName={.}"><xsl:value-of select="."/></a>
					   
					</xsl:for-each>

				</div>

			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>