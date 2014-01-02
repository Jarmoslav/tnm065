<?php
	//session för att kolla att  man bara kan komma åt sidan då man är inloggad	
	session_start();
	
	if($_SESSION['loggedin']!="admin" || $_SESSION['user']=="")
	{
		header("Location: index.php");
	}

	//include('dbconnect.inc.php');
?>

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

		<div id ="pagewrapper">
			<h2> Welcome Administrator! </h2>
			<p> Users in the system sorted alphabetically: </p>
			<?php
				include "dbconnect.inc.php";
				$stmt = $dbh->prepare('SELECT userName FROM user');
				$stmt->execute();

				$result = $stmt->fetchAll();
				foreach($result as $r)
				{
					$user = $r['userName'];

					echo "<a class = 'usersAdmin' href = manageUsers.php?userName=$user> $user </a>";
				}
			?>

		</div>

	</body>
</html>