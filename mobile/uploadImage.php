<?php
	session_start();

	if($_SESSION['loggedin'] != true || $_SESSION['user'] == "")
	{
		header("Location: index.php");
	}
	$userName = $_SESSION['user'];
?>

<html>
	<head>
		<title>LiU-Gram - View Image</title>
		<link rel="stylesheet" type="text/css" media="screen" href="mobile.css"/>
	</head>
	<body>
		<header>
			<div id = "headerContent">
				<a href = "index.php" id = "heading"><h1>LiU-Gram</h1></a>
				<a id = "uploadlink" href = 'index.php'>Back to Feed!</a>
				<a id = "signoutlink" href = 'logout.php'>Sign out!</a>
				<?php 					
					echo "<p class = 'loggedinas'>Logged in as <a class = 'userlink' href = 'userProfile.php'>$userName</a></p>";
				?>
			</div>

			</header>

			<div id = "pagewrapper">
				<h2> Upload an Image! </h2>
				<form action = "" method = "post"  enctype="multipart/form-data" id = "imageUploader">
					<ul id ="commentlist">						
						<li><label for="file">Choose an image: </label><input type="file" name="file" id="mobileFile"/></li>
						<li><textarea name = "description" cols ="40" rows = "10">Description... </textarea></li>
						<li><input class = "button" type="submit" name="publiceraNyhet" value="Upload!"/></li> 
					</ul>
				</form>

				<?php
					//GÖR DETTA SEN!!!
					date_default_timezone_set('Europe/Stockholm');
					$description = $_POST['description'];
					$time =  date(YmdHis);

					//kod för att ladda upp en fil, hämtad från w3schools

					if($_FILES["file"]["name"])
					{
						$allowedExts = array("jpg", "jpeg", "gif", "png");

						$extension = end(explode(".", $_FILES["file"]["name"]));

						$picPath = "img/$userName/".$_FILES["file"]["name"];

						//echo $picPath;

						if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg")	|| ($_FILES["file"]["type"] == "image/png")	|| ($_FILES["file"]["type"] == "image/pjpeg"))
							&& ($_FILES["file"]["size"] < 2000000)&& in_array($extension, $allowedExts))
						  {
						  	if ($_FILES["file"]["error"] > 0)
						    {
						    	echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
						    }
						  	else
						    {
							    
							    if (file_exists("img/$userName/" . $_FILES["file"]["name"]))
							    {
							    	echo $_FILES["file"]["name"] . "File already exists";
							    }

							    else
							    {
								    
									if(!empty($description))
									{				
										include "dbconnect.inc.php";
										$stmt = $dbh->prepare('INSERT INTO picture (userName,picURL,time,description) VALUES (:USER,:URL,:TIME,:DESCRIPTION)');
										$stmt->execute(array('USER'=>$userName, 'URL'=>$picPath, 'TIME'=>$time, 'DESCRIPTION'=>$description));

										move_uploaded_file($_FILES["file"]["tmp_name"], "img/$userName/" . $_FILES["file"]["name"]);

										include "SimpleImage.php";

										

										$scaledImage = new SimpleImage();
										$scaledImage->load("$picPath");
										$scaledImage->resizeToWidth(400);
										$scaledImage->crop(67, 20, 323, 200);
										$scaledImage->save("img/$userName/"."thumb".$_FILES["file"]["name"]);
										echo "Image uploaded!";

									}
									else
									{
										echo "You must write a description!";
									}
							    }
						    }
						  }
						else
						{
							echo "You must choose an image!";
						}

					}

				?>
			</div>

	</body>
</html>