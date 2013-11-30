<?php

	include "dbconnect.inc.php";
	session_start();

	$userName = $_POST['username'];
	$password = md5($_POST['password']);

	/*
	 * The Prepared Statement for login
	 */	  

	if(!empty($password) && !empty($userName))
	{
		
		$stmt = $dbh->prepare('SELECT * FROM user WHERE userName=:username AND password=:password');
		$stmt->execute(array('username'=> $userName, 'password'=> $password));

		$result = $stmt->fetchAll();

	
		if($stmt->rowCount() == 1)
		{
			
			$_SESSION['loggedin']=true;
			$_SESSION['user']="$userName";
			header("Location: index.php");
		}
		else
		{
			$_SESSION['loggedin']="noSuchUser";
			header("Location: login.php");
		}
	}
	/*else
	{
			$_SESSION['inloggad']="fillAllFields";
			header("Location: posta.php");
	}*/

	/*try {
		
		$sql = "SELECT * FROM user WHERE userName=:username AND password=:password";
		$query = $dbh->prepare($sql);
		$query->execute(array('username'=> $username, 'password'=> $password));
		$results = $query->fetchAll(); 

		//checks if user exists in db
		if ($query->rowCount() > 0) {
			echo "valid user";
			session_start();
		    $_SESSION['username'] = $username;
		}
		else{
			echo "no user with that name exits or password exists";
		}
		
		
	} catch(PDOException $e) {
			    echo 'ERROR: ' . $e->getMessage();
	}*/

	?>