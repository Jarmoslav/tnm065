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
		<title>LiU-Gram - Sign in!</title>
		<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
	</head>
	<body>
		<header>
			<div id = "headerContent">
				<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
				<a href = "index.php" id = "uploadlink"> Back to Feed!</a>
			</div>
		</header>

		<div id ="pagewrapper">
			<div id = "loginwrapp">
				<h2 style ="text-align:center;"> Sign in! </h2>
				<form name = "loginform" method = "post" action = "login_check.php">
					<ul>
						<li><label> UserName: <input class = "login" type="text" name= "username"/></label></li>
						<li><label> Password: <input class = "login" type="password" name= "password"/></label></li>
						<li style = "text-align:center;"><input class = "button" type = "submit" name = "submit" value = "Sign in!"/></li>
					</ul>
				</form>
				<?php
					if($_SESSION['loggedin']=="noSuchUser")
					{
						echo "<p style = 'text-align:center;'>Wrong username or password! </p>";
					}
				?>
			</div>

			<div id = "signupwrapp">
				<h2 style = "text-align:center;"> Sign up! </h2>
				<form name = "signupform" method = "post" action = "createNewUser.php">
					<ul>
						<li><label> UserName: <input class = "login" type="text" name= "signupusername"/></label></li>
						<li><label> Password: <input class = "login" type="password" name= "signuppassword"/></label></li>
						<li><label> Password again: <input class = "login" type="password" name= "signuppassword2"/></label></li>
						<li style = "text-align:center;"><input class = "button" type = "submit" name = "submit2" value = "Sign up!"/></li>
					</ul>
				</form>
				<?php
					if($_GET['loginStatus'] == "userAlreadyExists")
					{
						echo "<p style = 'text-align:center;'>That user name already exists. Pick another one!</p>";
					}
					if($_GET['loginStatus'] == "fillAllFields")
					{
						echo "<p style = 'text-align:center;'>You have to fill all fields!</p>";
					}
					if($_GET['loginStatus'] == "passwordMisMatch")
					{
						echo "<p style = 'text-align:center;'>Passwords do not match!</p>";
					}
					if($_GET['loginStatus'] == "success")
					{
						echo "<p style = 'text-align:center;'>User created successfully. You can now log in!</p>";
					}
				?>
			</div>
			
		</div>

	</body>
</html>
