<?php
	$dbh = new PDO('mysql:host=localhost;dbname=TNM065', 'root', 'root');
	$dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1);
	//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
?>