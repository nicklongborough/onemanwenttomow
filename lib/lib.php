<?php

// Connect to the DB
	function get_db_conn($write = 0) {
		if ($write == 1) {
			$conn = mysql_connect($GLOBALS['db_ip_write'], $GLOBALS['db_user_write'], $GLOBALS['db_pass_write']);
		} else {
			$conn = mysql_connect($GLOBALS['db_ip'], $GLOBALS['db_user'], $GLOBALS['db_pass']);
		}
		mysql_select_db($GLOBALS['db_name'], $conn);

		if (!$conn) {
			echo 'Could not connect to database';
			die('Could not connect to DB: ' . mysql_error());
		}
		return $conn;
	}

// Prepare a string for a SQL statement (make it safe, prohibit SQL injection etc.)
	function prep_string($string) {
		return(mysql_real_escape_string(stripslashes($string)));
	}

// Process the parameters and session variables which are relevant to every page
	function process_params() {

		// Make global arrays available to this function
		global $_SESSION;
		global $_REQUEST;

		// Start a PHP session
		session_start();

		// Determine whether user is logged in
		if (!isset($_SESSION['username'])) {
			// Redirect user to login page
			header('location:/login.php');
			die();
		}

	}

?>