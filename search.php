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

	while ($results = $query -> fetch()) {
		$nr++;    
		$outputUser =  $results['userName'];
		$outputPicURL = $results['picURL'];
		$outputTime = date('Y-m-d H:i',  $results['time']);	
		$outputString = $results['description'];	
        $outputPicID = $results['pictureID'];	
		
		 echo "<picture>
						<picuser>$outputUser</picuser>
						<picurl>$outputPicURL</picurl> 
						<pictime>$outputTime</pictime>
						<picid>$outputPicID</picid>
					<comment>
						<commenttime>$nr</commenttime>
						<commentuser>are</commentuser>
						<commenttext>eesadasdasds</commenttext>
					</comment>
				<description>
                    Lorem ipsum
                </description>	
			</picture>";
?>

<?php
	}
}
else
{}
?>