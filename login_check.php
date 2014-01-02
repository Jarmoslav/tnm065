<?php

	include "dbconnect.inc.php";
	session_start();

	$userName = $_POST['username'];
	$password = $_POST['password'];

	/*
	 * The Prepared Statement for login
	 */	  

	if(!empty($password) && !empty($userName)) 
	{
		$password = md5($password);

		if($userName == "admin")
		{
			if($password == md5("adminpassword"))
			{
				$_SESSION['user']="admin";
				$_SESSION['loggedin'] = "admin";
				header("Location: admin.php");
			}
			else
			{
				header("Location: login.php?loginStatus=noSuchUser");
			}
		}
		else
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
						header("Location: login.php?loginStatus=noSuchUser");
					}
				}
				
			}
			else
			{
				header("Location: login.php?loginStatus=noSuchUser");
			}
		}		
	}
	else
	{
		//$_SESSION['loggedin']="fillAllFields";
		header("Location: login.php?loginStatus=fillAllFieldsLogin");
	}

?>