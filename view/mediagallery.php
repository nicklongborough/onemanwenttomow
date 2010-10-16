<?php

	include_once '../lib/config.php';
	include_once '../lib/lib.php';
	include_once '../model/user.php';
	include_once '../model/media.php';	

	get_db_conn(1);
	session_start();
	
	//If user is not logged in then send them to the login page
	if (!isset($_SESSION['userid'])) {
		header('location:login.php');				
		die();
	}
	$message = "";
	$images = getMediaByUser($_SESSION['username']);
	if (!count($images)>0) {
		$message = 'No images added yet <a href="medialoader.php">click</a> to add one now';
	}
	

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>onemanwenttomow - '.$_SESSION['username'].'</title>
		<link rel="stylesheet" href="../res/stylesheet.css" type="text/css" media="all" />	
	</head>
	<body>
	<div class="container">
		<h1>'.$_SESSION['username'].' - Image Gallery</h1>
		<div class="gallery">
			<ul>
				<li><a href="../view/mediaupload.php">Add</a> another image . .</li> 
			</ul>	';
		foreach ($images as $image) {
			echo '
			<div class="imagegallerythumbnail">
				<div class="imagegalleryimage"><img class="thumbnail" src="'.$image['URL'].'"/></div>
				<div class="caption">'.$image['TITLE'].'</div>
				<div class="smallcaption">'.$image['CREATIONDATE'].'</div>
			</div>';		
		}		
echo '
		</div>
	</div>';
	?>
	</body>
</html>