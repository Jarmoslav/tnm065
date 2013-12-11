<?php 	 
	  
	  //header("Content-type:text/xml;charset=utf-8");
	  echo '<?xml version="1.0" standalone="no"?>';
	  echo '<!DOCTYPE liugram SYSTEM "http://www.student.itn.liu.se/~johho982/TNM065/ProjektGrejer/liugram.dtd">';
      echo '
      <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
      <script type="text/javascript" src="javasqript.js"></script>';
      
	  include 'prefix.php';
?>
<liugram>
<?php 

	session_start(); 
	if($_SESSION['loggedin'] == true && $_SESSION['user'] != "")
	{
		$userName = $_SESSION['user'];
		echo '<?xml-stylesheet type="text/xsl" href="index_loggedin.xsl"?>';
		echo "<username>$userName</username>";
	}
	else
	{
		echo '<?xml-stylesheet type="text/xsl" href="index.xsl"?>';
	}
    

?>


	<?php
		include "dbconnect.inc.php";

		//liugram tag must include <username> </username>

		//PDO-statement for fetching from database
		$stmt = $dbh->prepare('SELECT * FROM picture ORDER BY time DESC');
		$stmt->execute();

		$result = $stmt->fetchAll();

		//the picture element looks as follows: ELEMENT picture(picuser, picurl, pictime, comment*, description)
		foreach($result as $r)
		{
			$picUser = $r['userName'];
			$picURL = $r['picURL'];
			$picTime = $r['time'];
			$picTime = strtotime($picTime);
			$picTime = date('Y-m-d H:i', $picTime);
			$picID = $r['pictureID'];
			$description = $r['description'];
			//Position where the second slash is.
			$pos = strpos($picURL, '/', 4);
			$thumbURL = substr_replace($picURL, '/thumb', $pos, 1);

			echo "<picture>
						<picuser>$picUser</picuser>					
						<picurl>$thumbURL</picurl> 
						<pictime>$picTime</pictime>
						<picid>$picID</picid>";


			//Statement for comments on pictures.
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

			echo "<description>
					$description
				  </description>";
			echo "</picture>";
		}
	?>
</liugram>
<?php 
	if($_SESSION['loggedin'] == true && $_SESSION['user'] != "")
	{
		include 'postfixindexloggedin.php';
	}
	else
	{
		include 'postfix.php';
	}
?>
