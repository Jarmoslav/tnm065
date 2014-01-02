<?php
	//session för att kolla att  man bara kan komma åt sidan då man är inloggad	
	
	include "dbconnect.inc.php";
	
	session_start();
	
	if($_SESSION['loggedin']!="admin" || $_SESSION['user']=="")
	{
		header("Location: index.php");
	}

	$contentType = $_GET['contentType'];
	$content = $_GET['content'];

	if($contentType == "user")
	{
		$userName = $content;

		$getFilePath = $dbh->prepare('SELECT picURL FROM picture WHERE userName = :USER');
		$getFilePath->execute(array('USER'=>$userName));

		$filePaths = $getFilePath->fetchAll();

		foreach($filePaths as $f)
		{
			$theFilePath = $f['picURL'];
			unlink($theFilePath);
			$pos = strpos($theFilePath, '/', 4);
			$thumbURL = substr_replace($theFilePath, '/thumb', $pos, 1);
			unlink($thumbURL);
		}

		rmdir("img/$userName/");

		$deleteUser = $dbh->prepare('DELETE FROM user WHERE userName = :USER');
		$deleteUser->execute(array('USER'=>$userName));

		header("Location: admin.php");
	}

	else if($contentType == "image")
	{
		$picID = $content;
		$user = $_GET['user'];

		$getFilePath = $dbh->prepare('SELECT picURL FROM picture WHERE pictureID = :PID AND userName = :USER');
		$getFilePath->execute(array('PID'=>$picID, 'USER'=>$user));

		$filePath = $getFilePath->fetch();
		$theFilePath = $filePath['picURL'];

		unlink($theFilePath);
		$pos = strpos($theFilePath, '/', 4);
		$thumbURL = substr_replace($theFilePath, '/thumb', $pos, 1);
		unlink($thumbURL);

		$deleteImage = $dbh->prepare('DELETE FROM picture WHERE pictureID = :PID AND userName = :USER');
		$deleteImage->execute(array('PID'=>$picID, 'USER'=>$user));

		header("Location: manageUsers.php?userName=$user");
	}

	else if($contentType == "comment")
	{
		$comment = $content;
		$user = $_GET['user'];

		$deleteComment = $dbh->prepare('DELETE FROM comment WHERE commentID = :CID');
		$deleteComment->execute(array('CID'=>$comment));

		header("Location: manageUsers.php?userName=$user");
	} 
?>