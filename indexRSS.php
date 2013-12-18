<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:syn="http://purl.org/rss/1.0/modules/syndication/">
    
 	<channel rdf:about="http://localhost:8888/TNM065/repo/">
		<title>LiU-Gram</title>
		<description>LiU-Gram the almost Instagram experience, only on LiU!</description>
		<dc:language>en</dc:language>
		<dc:rights>Copyright LiU-Gram</dc:rights>
		<dc:publisher>LiU-Gram Crew</dc:publisher>
		<dc:creator>John Hollén and Simon Jare</dc:creator>
		<syn:updatePeriod>daily</syn:updatePeriod>
		<syn:updateFrequency>1</syn:updateFrequency>
		<syn:updateBase>1970-01-01T00:00+00:00</syn:updateBase>
	</channel>
	
	<?php
		include "dbconnect.inc.php";

		//liugram tag must include <username> </username>

		//PDO-statement for fetching from database
		$stmt = $dbh->prepare('SELECT * FROM picture ORDER BY time DESC');
		$stmt->execute();

		$result = $stmt->fetchAll();

		foreach($result as $r)
		{
			$picUser = $r['userName'];
			$picURL = $r['picURL'];
			$picTime = $r['time'];
			$picTime = strtotime($picTime);
			$picTime = date('Y-m-d H:i', $picTime);
			$picID = $r['pictureID'];
			$description = $r['description'];

			echo "<item rdf:about='http://localhost:8888/TNM065/repo/viewImage.php?pictureID=$picID'>
					<title>Image by user: $picUser</title>
					<link>http://localhost:8888/TNM065/repo/viewImage.php?pictureID=$picID</link>
					<description>
						<![CDATA[
							<img src = '$picURL' alt = 'newsImage' width = '100%' />
							<br/>
							$description <br /><br />
							Comments: <br /><br />";
						


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

				echo "$commentUser <br /> $commentTime <br /><br /> $commentText <br /><br /><br /><br /> ";
			}
			echo "]]>
					</description>
					<dc:creator>$picUser</dc:creator>
				  	<dc:date>picTime</dc:date>
				  </item>";
		}
	?>
</rdf:RDF>
