<?php
	include_once '../lib/config.php';
	include_once '../lib/lib.php';
	include_once '../model/user.php';
		
	get_db_conn(0);
	session_start();
	
	// If user is logged in then log them out
	//if (isset($_SESSION['username'])) {
	//	session_destroy(); // Log user out
	//	session_start(); // Start a new session
	//	$logout=true;
	//}
	
	$userid = $_POST['USERID'];
	$username = $_POST['USERNAME'];
	$password = $_POST['PASSWORD'];
	$firstname = $_POST['FIRSTNAME'];
	$lastname = $_POST['LASTNAME'];
	$msisdn = $_POST['MSISDN'];
	$action = $_POST['ACTION'];
	$error = '';
	$erroroccured = false;
	
	if ($action == 'getuserbyid') {
		if (isset($userid) && !($userid == "")) {
			// The userid has been supplied
			$user = getUserByID($userid);
			if (!isset($user["USERID"])) {
				$erroroccured = true;
				$error = 'ERROR - No user exists with the id supplied';
			}
		} else {
			$erroroccured = true;
			$error = 'ERROR - no userid supplied';
		}
	} elseif ($action == 'createuser') {
		if (!isset($username) || ($username == "")) {
			$erroroccured = true;
			$error = 'ERROR - no username supplied';
		} 
		if (!isset($password) || ($password == "")) {
			$erroroccured = true;
			$error = 'ERROR - no password supplied';
		} 
		if (!isset($firstname) || ($firstname == "")) {
			$erroroccured = true;
			$error = 'ERROR - no firstname supplied';
		} 
		if (!isset($lastname) || ($lastname == "")) {
			$erroroccured = true;
			$error = 'ERROR - no lastname supplied';
		} 		
		if (!isset($msisdn) || ($msisdn == "")) {
			$erroroccured = true;
			$error = 'ERROR - no mobile number supplied';
		} 		
		
		if (!$erroroccured) {
			// Going to add a user now have confirmed all the required values were supplied.
			$result = createUser($username,$password,$firstname,$lastname,$username,$msisdn);
			if ($result == "ERROR") {
				$erroroccured = true;
				$error = 'ERROR - not able to create user at this time please try again later.';	
			} else {
				$users = array();
				$users = getUserByUsername($username);
				if (count($users)==0){
					$erroroccured = true;
					$error = 'ERROR - not able to locate user at this time please try again later.';
				} 
			}
		}
	} else {
		$erroroccured = true;
		$error = 'ERROR - no valid action supplied';		
	}
	

echo '
	<?xml version="1.0" encoding="UTF-8"?>';
	if ($erroroccured) {
		echo '		
		<response code="400">
			<error>'.$error.'</error>
		</response>';		
	} else {
		echo '		
		<response code="200">';
			foreach ($users as $user) {
				echo '	
				<user id="'.$user["USERID"].'">
					<username>"'.$user["USERNAME"].'"</username>
					<firstname>"'.$user["FIRSTNAME"].'"</firstname>
					<lastname>"'.$user["LASTNAME"].'"</lastname>
					<msisdn>"'.$user["MSISDN"].'"</msisdn>
				</user>';
			}
			echo '
		</response>';
	}
echo '
	</xml>';		
?>
