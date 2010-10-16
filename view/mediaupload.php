<?php

	include_once '../lib/config.php';
	include_once '../lib/lib.php';
	
	session_start();
	
	//If user is not logged in then send them to the login page
	if (!isset($_SESSION['userid'])) {
		header('location:login.php');				
		die();
	}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>onemanwenttomow - </title>
		<link rel="stylesheet" href="../res/stylesheet.css" type="text/css" media="all" />	
	</head>
	<body>
	<div class="container">
		<div id="upload">
			<form id="form" action="../service/photoloader.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Add Picture</legend>
					<label></label><input type="file" name="file" id="file" />
					<div id="clear"></div>
					<input type="submit" id="submit" value="Upload Image" />
					<div id="clear"></div>
				</fieldset>
			</form>
		</div>
	</div>';
	?>
	</body>
</html>