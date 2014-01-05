<?php
	//session för att kolla att  man bara kan komma åt sidan då man är inloggad	
	session_start();
	
	if($_SESSION['loggedin']!="admin" || $_SESSION['user']=="")
	{
		header("Location: index.php");
	}

	$adminUser = $_GET['userName'];
	//include('dbconnect.inc.php');
?>

<?php 	  
	  //header("Content-type:text/xml;charset=utf-8");
	  echo '<?xml version="1.0" standalone="no"?>';
	  echo '<!DOCTYPE liugram SYSTEM "http://www.student.itn.liu.se/~johho982/TNM065/ProjektGrejer/liugram.dtd">';
	  include 'prefix.php';
	  echo '<?xml-stylesheet type="text/xsl" href="managUsers.xsl"?>';

	  //xsl-stylesheet
?>
<liugram>

<?php
	
	echo "<username>$adminUser</username>";

	include "dbconnect.inc.php";

	$stmt = $dbh->prepare('SELECT * FROM picture ORDER BY time DESC');
	$stmt->execute();

	$result = $stmt->fetchAll();

	foreach ($result as $r) 
	{
		$picUser = $r['userName'];
			$picURL = $r['picURL'];
			$picTime = $r['time'];
			$picTime = strtotime($picTime);
			$picTime = date('Y-m-d H:i', $picTime);
			$picID = $r['pictureID'];
			$description = $r['description'];
			$pos = strpos($picURL, '/', 4);
			$thumbURL = substr_replace($picURL, '/thumb', $pos, 1);

			//Statement for comments on pictures.

			echo "<picture>
						<picuser>$picUser</picuser>
						<picurl>$thumbURL</picurl> 
						<pictime>$picTime</pictime>
						<picid>$picID</picid>";


			//Sorry för dåligt varibelnamn :D
			$stmt2 = $dbh->prepare('SELECT * FROM comment WHERE pictureID = :PID ORDER BY time DESC');
			$stmt2->execute(array('PID'=>$picID));
			$result2 = $stmt2->fetchAll();

			//The comment element looks like: ELEMENT comment (commenttime, commentuser, commenttext)
			foreach($result2 as $r2)
			{
				$commentText = $r2['text'];
				$commentUser = $r2['userName'];
				$commentTime = $r2['time'];
				$commentTime = strtotime($commentTime);
				$commentTime = date('Y-m-d H:i', $commentTime);
				$commentID = $r2['commentID'];

				echo "<comment>
						<commenttime>$commentTime</commenttime>
						<commentuser>$commentUser</commentuser>
						<commenttext>$commentText</commenttext>
						<commentid>$commentID</commentid>
					</comment>";
			}

			echo "<description>
					$description
				  </description>";
			echo "</picture>";
	}

?>
</liugram>

<?php
	include "postfixManageUsers.php";
?>