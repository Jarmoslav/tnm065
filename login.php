<?php

/*
 * The Prepared Statement for login
 * 
 */
 
$id = 1;
$username = 'root';
$password ='root';

try {
    $conn = new PDO('mysql:host=localhost;dbname=tnm065', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('SELECT * FROM users');
    $stmt->execute(array('firstname' => $id));
 
    while($row = $stmt->fetch()) {
        print_r($row);
    }
	
	
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

?>
