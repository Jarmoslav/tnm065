<!DOCTYPE root SYSTEM "http://www.student.itn.liu.se/~johho982/TNM065/ProjektGrejer/liugram.dtd">
<?php header("Content-type:text/xml;charset=utf-8");?>



<root>
	<?php
		include "dbconnect.inc.php";

		//PDO-statement for fetching from database
		$stmt = $dbh->prepare('SELECT * FROM picture ORDER BY time DESC');
		$stmt->execute();

		$result = $stmt->fetchAll();

		//the picture element looks as follows: <!ELEMENT picture(picuser, picurl, pictime, comment*, description)>
		foreach($result as $r)
		{
			$picUser = $r['userName'];
			$picURL = $r['picURL'];
			$picTime = $r['time'];
			$picTime = strtotime($picTime);
			$picTime = date('Y-m-d H:i', $picTime);
			$picID = $r['pictureID'];
			$description = $r['description'];

			//Statement for comments on pictures.

			echo "<picture>
						<picuser>$picUser</picuser>
						<picurl>$picURL</picurl> 
						<pictime>$picTime</pictime>";


			//Sorry för dåligt varibelnamn :D
			$stmt2 = $dbh->prepare('SELECT * FROM comment WHERE pictureID = :PID ORDER BY time DESC');
			$stmt2->execute(array('PID' => $picID));
			$result2 = $stmt2->fetchAll();

			//The comment element looks like: <!ELEMENT comment (commenttime, commentuser, commenttext)>
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
</root>
