<?php
include ('dbconnect.inc.php');

if ($_POST) {
    header('Content-type: application/xml');    
    echo '<?xml version="1.0" standalone="no"?>';
    
 
	$searchword = $_POST['searchword'];
	$sql = "SELECT * FROM picture WHERE description LIKE :searchword";
	$query = $dbh -> prepare($sql);
	$query -> execute(array('searchword' => '%' . $searchword . '%'));
	$nr=0;
    $outputXML ="";
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $outputUser1="";
    
    $outputXML.= "<liugram>";
    
    foreach($results as $row) {
      
        //echo " outputuser: ".$outputUser;
        $outputUser =  $row['userName'];
        $outputPicURL = $row['picURL'];
        $outputTime = date('Y-m-d H:i',  $row['time']); 
        $outputString = $row['description'];    
        $outputPicID = $row['pictureID'];   
        $outputXML.= "<picture>";
        $outputXML.= "
                    <picuser>$outputUser</picuser>
                    <picurl>$outputPicURL</picurl> 
                    <pictime>$outputTime</pictime>
                    <picid>$outputPicID</picid>
                    <comment>
                        <commenttime>hej</commenttime>
                        <commentuser>are</commentuser>
                        <commenttext>eesadasdasds</commenttext>
                    </comment>
                <description>
                    Lorem ipsum
                </description>  
           ";
        $outputXML .= "</picture>";
     }
    $outputXML.= "</liugram>";
     
     echo $outputXML;
}

 
?>