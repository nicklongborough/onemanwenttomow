<?php
	
	// Will not rely on the session will expect the user to post their username and password with the image

	include_once '../lib/config.php';
	include_once '../lib/lib.php';
	include_once '../model/user.php';
	include_once '../model/media.php';	

	get_db_conn(1);
	session_start();
		
	$erroroccured = false;
	$isvaliduser = false;
	$upload_name = "file";
	$path_info = pathinfo($_FILES[$upload_name]['name']);
	$file_extension = $path_info["extension"];
	if (isset($_SESSION['userid'])) {
		$userid = $_SESSION['userid'];
		$isvaliduser = true;
	} else {
		// Accept username and password to allow non-logged-in users to submit photos
		$username = $_POST['USERNAME'];				 
		$password = $_POST['PASSWORD'];
		$isvaliduser = checkUser($username,$password);
		$userid = getUserIdByUsername($username);
	}
	
	if ( !isset($_FILES["file"]) || !is_uploaded_file($_FILES["file"]["tmp_name"]) || $_FILES["file"]["error"] != 0) {
		$erroroccured = true;
		$error = 'ERROR - No file data recieved - ' . $file_extension;		
	} else {
		if ($isvaliduser) {	
			// Create a media record for the Image file
			$media_basepath = "../res/user/";
			$mediaID_image = insertNewMediaRecord($userid,$media_basepath,$file_extension);
			if ($mediaID_image != "ERROR") {
				$media_url_image = $media_basepath . $mediaID_image . '.' . $file_extension;
				// Now we know the mediaid we update the record we have just created with the correct path
				// Move the Image file to the write location							 			
				move_uploaded_file($_FILES["file"]["tmp_name"],$media_url_image);
			} else {
				$erroroccured = true;
				$error = 'ERROR - Unable to create the media record';		
			}
		} else {
			$erroroccured = true;
			$error = 'ERROR - Incorrect user account details supplied';					
		}
	}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>onemanwenttomow - </title>
		<link rel="stylesheet" href="../res/stylesheet.css" type="text/css" media="all" />
		<script type="text/javascript" src="../lib/jquery/jquery-1.4.2.js"></script>			
	</head>
	<body>
	<div class="container">';
	include("../view/header.php");
		if ($erroroccured) {
			echo 'An error has occured <a href="../view/mediaupload.php">click here</a> to try again . . ';
		} else {
			echo '
			<fieldset>
				<legend><b>Image added to gallery</b></legend>
					<img class="b b20" src="'.$media_url_image.'"/>
					<ul>
						<li><a href="../view/mediaupload.php">Add</a> another image . .</li> 
						<li><a href="../view/mediagallery.php">Go</a> to the gallery </li>
					</ul>
				</fieldset>';
		}
echo '
	</div>';
	?>
	</body>
</html>