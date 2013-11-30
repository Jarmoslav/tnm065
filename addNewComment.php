<?php
	//Lägg till session här uppe.
	
	if(isset($_POST['publishComment']))
	{
		$newcomment = $_POST['newcomment'];
		$picid = $_GET['pictureID'];
		echo $newcomment;
		echo $picid;
	}
?>