<?php
   echo "signup Screen: ";
    //include "dbconnect.inc.php";
    $usernameDB = 'root';
    $passwordDB ='root';
   
    $username = $_POST[ 'username' ];
    $password = $_POST[ 'password' ];
	
	echo $username;
	echo "</br>";
	
	echo "password to hash" . $password;
	//salting the password
	$password = md5( $password );
	echo "hashed: " . $password;
	//$hash = 

	try {
	
    $db = new PDO('mysql:host=localhost;dbname=tnm065', $usernameDB, $passwordDB);
	$sql = "INSERT INTO user (username, password) VALUES ( :username, :password )";
	$query = $db->prepare($sql);
    $query->execute( array( ':username'=>$username, ':password'=>$password));
	// check that the insert operation has returned ‘true’ to indicate that the insertion has gone ahead 
	$result = $query->execute( array( ':username'=>$username, ':password'=>$password));
	//If the insert is ok, the execute method will return true, and false if something goes wrong
	/*
	if ($result){
      echo "<p>Thank you. You have been registered</p>";
   }else {
	  echo "<p>Sorry, there has been a problem inserting your details. Please contact admin.</p>";
   }
	*/
	} catch(PDOException $e) {
			    echo 'ERROR: ' . $e->getMessage();
	}
	
?>