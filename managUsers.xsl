<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match = "liugram">
		<html>
			<head>
				<title>LiU-Gram - Admin</title>
				<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
			</head>
			<body>
				<header>
					<div id = "headerContent">
						<a href = "#" id = "heading"><h1>LiU-Gram</h1></a>
						<a href = "logout.php" id = "signoutlink" style = "margin-left: 400px;"> Logout</a>
					</div>
				</header>

				<div id ="pagewrapper">
					<h2 style = "margin-bottom: 15px;"> Administrate user <xsl:value-of select = "username" /> <a class = 'edit' href = "adminDelete.php?contentType=user&#38;content={username}"> Delete User </a> </h2>
					
					<div id = "adminImages">
						<p style = "text-align: center;"> Images uploaded: </p>
						<xsl:apply-templates select = "picture" />

					</div>

					<div id = "adminComments">
						<p style = "text-align: center;"> Comments posted: </p>
						<xsl:apply-templates select = "picture/comment"/>
					</div>

				</div>

			</body>
		</html>
	</xsl:template>

	<xsl:template match = "picture">
		<xsl:if test = "picuser = ../username">
			<div class = "photoFrame">
				<img src = "{picurl}" alt = "test" width = "150"/> <br />
				<a class = "edit" href = "adminDelete.php?contentType=image&#38;content={picid}&#38;user={../username}">Delete Image</a>
			</div>
		</xsl:if>
	</xsl:template>

	<xsl:template match = "comment">
		<xsl:if test = "commentuser = ../../username">
			<p style = "padding-top: 10px;border-top:1px solid #DDD;"><xsl:value-of select = "commenttext" /></p>
			<p>On image: </p>
			<div class = "photoFrame">
				<img src = "{../picurl}" alt = "test" width = "160"/>
			</div>
			<a class = "edit" href = "adminDelete.php?contentType=comment&#38;content={commentid}&#38;user={../../username}"> Delete Comment </a>
		</xsl:if>
	</xsl:template>

</xsl:stylesheet>