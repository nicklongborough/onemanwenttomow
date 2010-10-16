<?php

	include_once 'lib/config.php';
	include_once 'lib/lib.php';
	include_once 'model/user.php';
	get_db_conn(0);
	$erroroccured = false;
	session_start();
	// If user is logged in then log them out
	if (isset($_SESSION['username'])) {
		session_destroy(); // Log user out
		session_start(); // Start a new session
		$logout=true;
		$erroroccured = true;
		$error = "You have been logged out please login again.";
	} 
	
	$requiredparameterssupplied = false;
	if (isset($_POST['USERNAME'])) {
		$username = $_POST['USERNAME'];
		if (isset($_POST['PASSWORD'])) {
			$password = $_POST['PASSWORD'];
			$requiredparameterssupplied = true;
		}
	} 
	
	// Validate credentials if user has attempted to login
	if ($requiredparameterssupplied) {
		$login_failed = false;
		$isvaliduser = checkUser($username,$password);
		// Process the results of the attempt to login.
		if ($isvaliduser) {
			$userid = getUserIdByUsername($username);
			$_SESSION['username'] = $username;
			$_SESSION['userid'] = $userid; 
			header('location:index.php');				
			die();
		} else {
			session_destroy(); // Log user out
			$erroroccured = true;
			$error = "Incorrect Email and/or Password combination.";
		}
	} else {
		$error = "Email and/or Password not supplied.";
	}

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="res/stylesheet.css" type="text/css" media="all" />
	</head>
	<body>
		<div class="container">
		<fieldset>';
			if ($erroroccured) {
				echo '<div class="loginerrormessage">'.$error.'</div>	';
			}	
			echo '
			<table id="login_table">
				<form method="post" name="login_form" id="login_form" action="login.php">
					<tr><td style="border-width:0px;">Email:</td><td style="border-width:0px;"><input type="text" name="USERNAME" size="30" value="'.$username.'"/></td></tr>
					<tr><td style="border-width:0px;">Password:</td><td style="border-width:0px;"><input type="password" name="PASSWORD" size="30" /></td></tr>
					<tr><td colspan="2" style="text-align:right; border-width:0px;"><button onclick="this.submit();">Go</button></td></tr>
				</form>
			</table>
		</fieldset>
		</div>
	</body>
</html>';

?>
