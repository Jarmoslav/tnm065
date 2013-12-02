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
			foreach($result as $r)
			{
				$userDB = $r['userName'];

				if($userDB == $userName)
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
			
		}
		else
		{
			$_SESSION['loggedin']="noSuchUser";
			header("Location: login.php");
		}
		
	}

?>