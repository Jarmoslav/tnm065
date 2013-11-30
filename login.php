<?php

	//session för att kolla att  man bara kan komma åt sidan då man är inloggad
	
	session_start();
	
	if($_SESSION['loggedin']==true && $_SESSION['user']!="")
	{
		header("Location: index.php");
	}

	//include('dbconnect.inc.php');
?>

<html>
	<head>
		<title>LiU-Gram</title>
		<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
	</head>
	<body>
		<header>
			<div id = "headerContent">
				<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
			</div>
		</header>

<div id ="pagewrapper">
	<h2> Sign in! </h2>
	<form name = "loginform" method = "post" action = "login_check.php">
		<ul id = "commentlist">
			<li><label> UserName: <input type="text" name= "username"/></label></li>
			<li><label> Password: <input type="password" name= "password"/></label></li>
			<li><input class = "button" type = "submit" name = "submit" value = "Sign in!"/></li>
		</ul>
	</form>

	

	<?php
		if($_SESSION['loggedin']=="noSuchUser")
		{
			echo "Wrong username or password!";
		}
	?>
	
<div id ="pagewrapper">

	</body>
</html>
