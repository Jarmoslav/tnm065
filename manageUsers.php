<?php
	require_once "Mobile_Detect.php";
	  $detect = new Mobile_Detect;

	  if($detect->isMobile())
	  {
	  	header("Location: mobile/viewImage.php");
	  } 
	//session för att kolla att  man bara kan komma åt sidan då man är inloggad	
	session_start();
	
	if($_SESSION['loggedin']!="admin" || $_SESSION['user']=="")
	{
		header("Location: index.php");
	}

	$adminUser = $_GET['userName'];
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
			<h2 style = "margin-bottom: 15px;"> Administrate user <?php echo "$adminUser <a class = 'edit' href = 'adminDelete.php?contentType=user&content=$adminUser'> Delete User </a>"; ?> </h2>
			
			<div id = "adminImages">
				<p style = "text-align: center;"> Images uploaded: </p>
				<?php 
					include "dbconnect.inc.php";

					$stmt = $dbh->prepare('SELECT * FROM picture WHERE userName = :USER ORDER BY time DESC');
					$stmt->execute(array('USER'=>$adminUser));

					$result = $stmt->fetchALL();

					foreach($result as $r)
					{
						$picURL = $r['picURL'];
						$picTime = $r['time'];
						$picTime = strtotime($picTime);
						$picTime = date('Y-m-d H:i', $picTime);
						$picID = $r['pictureID'];
						$description = $r['description'];
						//Position where the second slash is.
						$pos = strpos($picURL, '/', 4);
						$thumbURL = substr_replace($picURL, '/thumb', $pos, 1);



						echo "<div class = 'photoFrame'>
								<img src = '$thumbURL' height = '100'/>
								<p class = 'pictime'>$picTime</p>
								<a class = 'edit' href = 'adminDelete.php?contentType=image&content=$picID&user=$adminUser'> Delete Image</a>								
							  </div>";
					} 
				?>
			</div>

			<div id = "adminComments">
				<p style = "text-align: center;"> Comments posted: </p>
				<?php

					$stmt = $dbh->prepare('SELECT * FROM comment WHERE userName = :USER ORDER BY time DESC');
					$stmt->execute(array('USER'=>$adminUser));

					$result = $stmt->fetchALL();

					foreach($result as $r)
					{
						$comment = $r['text'];
						$picID = $r['pictureID'];
						$time = $r['time'];
						$time = strtotime($time);
						$time = date('Y-m-d H:i', $time);
						$commentID = $r['commentID'];

						$stmt2 = $dbh->prepare('SELECT picURL FROM picture WHERE pictureID = :PID');
						$stmt2->execute(array('PID'=>$picID));

						$result2 = $stmt2->fetchALL();

						echo "<p style = 'padding-top: 10px;border-top: 1px solid #DDD;'> $comment </p>";
						echo "<p class = 'commentTime'> $time </p>";
						echo "<p> On image:  </p>";

						foreach($result2 as $r2)
						{
							$picURL = $r2['picURL'];
							$pos = strpos($picURL, '/', 4);
							$thumbURL = substr_replace($picURL, '/thumb', $pos, 1);

							echo "<div class = 'photoFrame'>
									<img src = '$thumbURL' height = '100' />
								  </div>";

							echo "<a class = 'edit' href = 'adminDelete.php?contentType=comment&content=$commentID&user=$adminUser'> Delete Comment</a>";
						}
					}
				?>
			</div>

		</div>

	</body>
</html>

