<?php
	session_start();

	if($_SESSION['loggedin'] != true || $_SESSION['user'] == "")
	{
		header("Location: index.php");
	}
	$userName = $_SESSION['user'];
?>

<?php 	  
	  //header("Content-type:text/xml;charset=utf-8");
	  echo '<?xml version="1.0" standalone="no"?>';
	  echo '<!DOCTYPE liugram SYSTEM "http://www.student.itn.liu.se/~johho982/TNM065/ProjektGrejer/liugram.dtd">';
	  include 'prefix.php';

	  //xsl-stylesheet
?>

<liugram>
	<?php 

		echo '<?xml-stylesheet type="text/xsl" href="postfixEditDeleteImage.xsl"?>';
		echo "<username>$userName</username>";

		include "dbconnect.inc.php";
		$pictureID = $_GET['pictureID'];

		$stmt = $dbh->prepare('SELECT * FROM picture WHERE userName = :USER AND pictureID = :PID ORDER BY time DESC');
		$stmt->execute(array('USER'=>$userName, 'PID'=>$pictureID));

		$result = $stmt->fetchAll();
		foreach ($result as $r) 
		{
				$picUser = $r['userName'];
				$picURL = "../";
				$tempPicURL = $r['picURL'];
				$picURL .= $tempPicURL;
				$picTime = $r['time'];
				$picTime = strtotime($picTime);
				$picTime = date('Y-m-d H:i', $picTime);
				$picID = $r['pictureID'];
				$description = $r['description'];
				//$pos = strpos($picURL, '/', 4);
				//$thumbURL = substr_replace($picURL, '/thumb', $pos, 1);

				//Statement for comments on pictures.

				echo "<picture>
							<picuser>$picUser</picuser>
							<picurl>$picURL</picurl> 
							<pictime>$picTime</pictime>
							<picid>$picID</picid>";


				//Sorry för dåligt varibelnamn :D
				$stmt2 = $dbh->prepare('SELECT * FROM comment WHERE pictureID = :PID ORDER BY time DESC');
				$stmt2->execute(array('PID' => $picID));
				$result2 = $stmt2->fetchAll();

				//The comment element looks like: ELEMENT comment (commenttime, commentuser, commenttext)
				foreach($result2 as $r2)
				{
					$commentText = $r2['text'];
					$commentUser = $r2['userName'];
					$commentTime = $r2['time'];
					$commentTime = strtotime($commentTime);
					$commentTime = date('Y-m-d H:i', $commentTime);

					echo "<comment>
							<commenttime>$commentTime</commenttime>
							<commentuser>$commentUser</commentuser>
							<commenttext>$commentText</commenttext>
						</comment>";
				}

				echo "<description>$description</description>";
				echo "</picture>";
		}
	?>	
</liugram>

<?php
	//Scripts for editing.
	if(isset($_POST['editDescr']))
	{
		$newDescr = $_POST['newDescr'];

		if(!empty($newDescr))
		{
			$update = $dbh->prepare('UPDATE picture SET description = :DESCR WHERE userName = :USER AND pictureID = :PID');
			$update->execute(array('DESCR'=>$newDescr, 'USER'=>$userName, 'PID'=>$pictureID));


		}								
	}

	if(isset($_POST['deleteButton']))
	{
		$getFilePath = $dbh->prepare('SELECT picURL FROM picture WHERE pictureID = :PID AND userName = :USER');
		$getFilePath->execute(array('PID'=>$pictureID, 'USER'=>$userName));

		$filePath = $getFilePath->fetch();
		$theFilePath = $filePath['picURL'];

		$deleteImage = $dbh->prepare('DELETE FROM picture WHERE pictureID = :PID AND userName = :USER');
		$deleteImage->execute(array('PID'=>$pictureID, 'USER'=>$userName));

		unlink($theFilePath);
		$pos = strpos($theFilePath, '/', 4);
		$thumbURL = substr_replace($theFilePath, '/thumb', $pos, 1);
		unlink($thumbURL);
	}

?>

<?php
	if($_SESSION['loggedin'] == true && $_SESSION['user'] != "")
	{
		include "postfixEditDeleteImage.php";
	}

?>