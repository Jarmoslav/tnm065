<?php
	
	include "dbconnect.inc.php";
	
	if(isset($_POST['submit2']))
	{
		$newUser = $_POST['signupusername'];

		$password = md5($_POST['signuppassword']);
		$password2 = md5($_POST['signuppassword2']);

		$checkUser = $dbh->prepare('SELECT * FROM user WHERE userName = :USER');
		$checkUser->execute(array('USER'=>$newUser));

		if($checkUser->rowCount() == 1)
		{
			header("Location: login.php?loginStatus=userAlreadyExists");
		}
		else if($newUser == "" || empty($newUser) || empty($password) || empty($password2))
		{
			header("Location: login.php?loginStatus=fillAllFields");
		}
		else if($password != $password2)
		{
			header("Location: login.php?loginStatus=passwordMisMatch");
		}
		else
		{
			$stmt = $dbh->prepare('INSERT INTO user (userName,password) VALUES (:USER,:PASSWORD)');
			$stmt->execute(array('USER'=>$newUser,'PASSWORD'=>$password));

			mkdir("img/$newUser/");
			header("Location: login.php?loginStatus=success");
		}
		
	}	
?>