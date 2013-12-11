<?php
include ('dbconnect.inc.php');

if ($_POST) {
    echo '<?xml version="1.0" standalone="no"?>';
    echo '<!DOCTYPE liugram SYSTEM "http://www.student.itn.liu.se/~johho982/TNM065/ProjektGrejer/liugram.dtd">';
    echo '<?xml-stylesheet type="text/xsl" href="index.xsl"?>';
	$searchword = $_POST['searchword'];
	$sql = "SELECT * FROM picture WHERE description LIKE :searchword";
	$query = $dbh -> prepare($sql);
	$query -> execute(array('searchword' => '%' . $searchword . '%'));
	

	while ($results = $query -> fetchAll()) {
		
		if($query->rowCount() != 0)
		{		

			$outputUser =  $results['userName'];
			$outputPicURL = $results['picURL'];
			$outputTime = $results['time'];
			$outputTime = strtotime($outputTime);
			$outputTime = date('Y-m-d H:i', $outputTime);	
			$outputString = $results['description'];	
	        $outputPicID = $results['pictureID'];
	        $outputDesc = $results['description'];	

	        $pos = strpos($outputPicURL, '/', 4);
			$thumbURL = substr_replace($outputPicURL, '/thumb', $pos, 1);
			
			 echo "<picture>
							<picuser>$outputUser</picuser>
							<picurl>$thumbURL</picurl> 
							<pictime>$outputTime</pictime>
							<picid>$outputPicID</picid>
						<comment>
							<commenttime>hej</commenttime>
							<commentuser>are</commentuser>
							<commenttext>eesadasdasds</commenttext>
						</comment>
					<description>
	                    $outputDesc
	                </description>	
				</picture>";

		}
?>

<?php
	}
}
else
{}
?>