<?php

	include_once '../lib/config.php';
	include_once '../lib/lib.php';
	include_once '../model/user.php';
		
	get_db_conn(1);
	session_start();
	$error = '';
	$erroroccured = false;
	
	$username = $_SESSION['username'];
	$userid = $_SESSION['userid'];
	if (isset($userid) && !($userid == "")) {
		// The userid has been supplied
		$user = getUserByID($userid);
		if (!isset($user["USERID"])) {
			$erroroccured = true;
			$error .= 'ERROR - No details exists for this user ['.$_SESSION['userid'].':'.$_SESSION['username'].'] please try again later';
		} else {
			$action = 'updateuser';
		}
	} else {
		$error .= 'ERROR - Creating a new user as the supplied user details wer - ' . $_SESSION['username'] . ' - '  . $_SESSION['userid'];
		$action = 'createuser';
	}

echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>onemanwenttomow - '.$username. '</title>
		<link rel="stylesheet" href="../res/stylesheet.css" type="text/css" media="all" />
		<script type="text/javascript" src="../lib/jquery/jquery-1.4.2.js"></script>		
		<script type="text/javascript" src="user.js"></script>	
	</head>
	<body>
	<div class="container">';
	include("header.php");
echo '
		<form id="submit" method="post">
			<input type="hidden" name="ACTION" id="ACTION" value="'.$action.'" />
			<input type="hidden" name="USERID" id="USERID" value="'.$userid.'" />';
			if ($erroroccured) {
				echo '<div class="errormessage">'.$error.'</div>	';
			}	
			echo '
			<fieldset>
				<legend>User Details </legend>
					<label>Email</label><input id="USERNAME" class="USERNAME" name="USERNAME" size="25" type="text" value="'.$user['USERNAME'].'" />
					<label>Confirm Email</label><input id="USERNAME_CONFIRM" class="USERNAME_CONFIRM" name="USERNAME_CONFIRM" size="25" type="text" value="'.$user['USERNAME'].'" />					
					<label>Password</label><input id="PASSWORD" class="PASSWORD" name="PASSWORD" size="25" type="password" value="" />				
					<label>Confirm Password</label><input id="PASSWORD_CONFIRM" class="PASSWORD_CONFIRM" name="PASSWORD_CONFIRM" size="25" type="password" value="" />
					<label>First name</label><input id="FIRSTNAME" class="FIRSTNAME" name="FIRSTNAME" size="25" type="text" value="'.$user['FIRSTNAME'].'" />
					<label>Last name</label><input id="LASTNAME" class="LASTNAME" name="LASTNAME" size="25" type="text" value="'.$user['LASTNAME'].'" />				
					<label>Mobile</label><input id="MSISDN" class="MSISDN" name="MSISDN" size="25" type="text" value="'.$user['MSISDN'].'" />
				<div id="clear"></div>';
				if ($action=="createuser") { echo '<button id="userform" name="userform" class="userform">create</button>'; 
				} else { echo '<button id="userform" name="userform" class="userform">save</button>'; }
				echo '
				<div class="message"></div>
				<div id="clear"></div>';
				if ($action=="updateuser") { 
						echo '
						<div class="audit"><b>Created </b>'.$user['CREATIONDATE'].'</div>
						<div class="audit"><b>Modified - </b>'.$user['MODIFIEDDATE'].'</div>';	 
					} 
				echo '
			</fieldset>
			</form>
		<div class="success" style="display:none;">Client has been added.</div>  
	</div>
	</body>
</html>';	
?>
