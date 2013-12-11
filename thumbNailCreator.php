<?php
	//A thumbnail creator function. We use the simpleImage() class which is based on the GD-package.

	header("Content-Type: image/jpg");

	include "SimpleImage.php";

	$scaledImage = new SimpleImage();
	$scaledImage->load($_GET['scaledImage']);
	$scaledImage->resizeToWidth(400);
	$scaledImage->crop(67, 20, 323, 200);	
?>