<?php
	session_start();

	if($_SESSION['loggedin'] != true || $_SESSION['user'] == "")
	{
		header("Location: index.php");
	}
	$userName = $_SESSION['user'];
?>

<html>
	<head>
		<title><?php echo "$userName"?> - Edit</title>
		<link rel="stylesheet" type="text/css" media="screen" href="liugram.css"/>
	</head>
	<body>
		<header>
			<div id = "headerContent">
				<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
				<a id = "uploadlink" href = 'index.php'>Back to Feed!</a>
				<a id = "signoutlink" href = 'logout.php'>Sign out!</a>
				<?php 					
					echo "<p class = 'loggedinas'>Logged in as <a class = 'userlink' href = 'userProfile.php'>$userName</a></p>";
				?>
			</div>

			</header>

			<div id = "pagewrapper">
				<h2> Edit or delete image.</h2>

				<p>Edit description! </p>
				<div id = "editdescr">
					<?php 
						include "dbconnect.inc.php";
						$pictureID = $_GET['pictureID'];

						$stmt = $dbh->prepare('SELECT * FROM picture WHERE userName = :USER AND pictureID = :PID ORDER BY time DESC');
						$stmt->execute(array('USER'=>$userName, 'PID'=>$pictureID));

						$result = $stmt->fetchAll();
						foreach($result as $r)
						{
							$picTime = $r['time'];
							$picTime = strtotime($picTime);
							$picTime = date('Y-m-d H:i', $picTime);
							$description = $r['description'];
							$picURL = $r['picURL'];
							$pos = strpos($picURL, '/', 4);
							$thumbURL = substr_replace($picURL, '/thumb', $pos, 1);

							echo "<div class = 'photoFrame'>
								  	<img height = '160' src = '$thumbURL' alt = 'test' />
								  	<form method = 'post' action = ''>
								  		<ul id = 'commentlist'>
											<li><textarea name = 'newDescr' cols = '40' rows = '5'>$description</textarea></li>
											<li><input class = 'button' name = 'editDescr' type = 'submit' value = 'Edit Comment'/></li>
										</ul>
								  	</form>";
							if(isset($_POST['editDescr']))
							{

								$newDescr = $_POST['newDescr'];

								if(!empty($newDescr))
								{
									$update = $dbh->prepare('UPDATE picture SET description = :DESCR WHERE userName = :USER AND pictureID = :PID');
									$update->execute(array('DESCR'=>$newDescr, 'USER'=>$userName, 'PID'=>$pictureID));
									header("Location editDelete.php?pictureID = $pictureID");
								}								

								
							}

							echo "</div>";


						}
					?>
				</div>

			</div>

	</body>
</html>