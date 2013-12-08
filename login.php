<?php
session_start(); 
/*
 * The Prepared Statement for login
 * 
 */
$username = $_POST[ 'username' ];
$password = $_POST[ 'password' ];
  
echo $username;
echo $password;

$password = md5( $password );  
echo $password;
$usernameDB = 'root';
$passwordDB ='root';

try {
	
    $db = new PDO('mysql:host=localhost;dbname=tnm065', $usernameDB, $passwordDB);
	$sql = "SELECT * FROM user WHERE userName=:username AND password=:password";
	$query = $db->prepare($sql);
	$query->execute(array('username'=> $username, 'password'=> $password));
	$results = $query->fetchAll(); 

	//checks if user exists in db
	if ($query->rowCount() > 0) {
		echo "valid user";
		
		$_SESSION['loggad'] = true;
	    $_SESSION['username'] = $username;
	}
	else{
		echo "no user with that name exits or password exists";
	}
	
	
} catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
}

?>
