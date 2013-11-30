<?php
	session_start();

	if($_SESSION['loggedin'] != true || $_SESSION['user'] == "")
	{
		header("Location: index.php");
	}

	include "dbconnect.inc.php";

	
	
	if(isset($_POST['publishComment']))
	{

		date_default_timezone_set('Europe/Stockholm');
		$newComment = $_POST['newcomment'];
		$picid = $_GET['pictureID'];
		$time =  date(YmdHis);
		$userName = $_SESSION['user'];
		if(!empty($newComment))
		{
			$stmt = $dbh->prepare('INSERT INTO comment (pictureID,userName,text, time) VALUES (:PID,:USER,:COMMENT,:TIME)');
			$stmt->execute(array('PID'=>$picid, 'USER'=>$userName, 'COMMENT'=>$newComment, 'TIME'=>$time));
		}
		
	}
	header("Location: viewImage.php?pictureID=$picid");
?>