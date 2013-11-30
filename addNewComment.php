<?php
	//Lägg till session här uppe.
	
	if(isset($_POST['publishComment']))
	{
		$newcomment = $_POST['newcomment'];
		$picid = $_POST['pictureID'];
		echo $newcomment;
		echo $picid;
	}
?>