<?php
	include_once 'lib/config.php';
	include_once 'lib/lib.php';
	
	get_db_conn(0);
	session_start();
	
	//If user is not logged in then send them to the login page
	if (!isset($_SESSION['username'])) {
		header('location:login.php');				
		die();
	}

	
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>One Man Went To Mow - '.$_SESSION['username'].'</title>
		<link rel="stylesheet" href="res/stylesheet.css" type="text/css" media="all" />
	
		
	</head>	
		<body>
			<fieldset>
				<legend>Movember - Get Involved</legend>
				<ul>
					<li><a href="login.php">Logout</a></li>
					<li><a href="view\mediaupload.php">Add to the gallery</a></li>
					<li><a href="view\mediagallery.php">Check out the gallery</a></li>
					<li><a href="view\user.php">Edit your details</a></li>					
				</ul>
			</fieldset>
		</body>';		
?>
</html>
