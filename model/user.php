<?php
	//-----------------------------------------------------------------------------------------------------------------
	// USER - This library is used for all database interaction related to a user object
	//-----------------------------------------------------------------------------------------------------------------

	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to retrieve a user using their userid
	//-----------------------------------------------------------------------------------------------------------------
	function getUserByID($userid) {
		$query = '	SELECT u.userid AS USERID, u.username AS USERNAME, u.firstname AS FIRSTNAME, u.lastname AS LASTNAME,u.msisdn AS MSISDN, DATE_FORMAT(u.creationdate,\'%W %D %H:%i\') AS CREATIONDATE, DATE_FORMAT(u.lastmodifieddate,\'%W %D %H:%i\') AS MODIFIEDDATE
					FROM onemanwenttomow.user u
					WHERE u.userid=' . $userid;
		$result = mysql_query($query) or die ("getUserByID() query failed: " . mysql_error() . "The query was " . $query);
		$return = mysql_fetch_assoc($result);
		return $return;
	}
	
	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to retrieve a user using their userid
	//-----------------------------------------------------------------------------------------------------------------	
	function getUserIdByUsername($username) {
		$query = '	SELECT u.userid AS USERID, u.username AS USERNAME, u.firstname AS FIRSTNAME, u.lastname AS LASTNAME,u.msisdn AS MSISDN
					FROM onemanwenttomow.user u
					WHERE u.username="' . $username . '"';
		$result = mysql_query($query) or die ("getUserIdByUsername() query failed: " . mysql_error() . "The query was " . $query);
		$return = array();
		$row = mysql_fetch_assoc($result);
		$userid = $row['USERID'];
		return $userid;
	}
	
	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to check supplied user credentials - should return one and only one result.
	//-----------------------------------------------------------------------------------------------------------------
	function checkUser($username,$password) {
		$query = 'SELECT COUNT(u.userid) AS NUMBER_OF_USERS 
					FROM onemanwenttomow.user u
					WHERE u.username="'.$username.'" 
						AND u.password="'.$password.'"';
		$result = mysql_query($query) or die ("checkUser() query failed: " . mysql_error() . "The query was " . $query);
		// This function returns a true false boolean response based on the looked up user credentials
		$row = mysql_fetch_assoc($result);
		if ($row['NUMBER_OF_USERS']!= 1) {
			return false;	
		} else {
			return true;
		}	
	}
	
	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to retrieve a user using their username
	//-----------------------------------------------------------------------------------------------------------------
	function getUserByUsername($username) {
		$query = '	SELECT u.userid AS USERID, u.username AS USERNAME, u.firstname AS FIRSTNAME, u.lastname AS LASTNAME,u.msisdn AS MSISDN
				FROM onemanwenttomow.user u
				WHERE u.username="' . $username. '"';
		$result = mysql_query($query) or die ("getUserByUsername() query failed: " . mysql_error() . "The query was " . $query);
		$return = array();
		while ($row = mysql_fetch_assoc($result)) {
			array_push($return,$row);
		}
		return $return;
	}
	
	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to create a user
	//-----------------------------------------------------------------------------------------------------------------
	function createUser($username,$password,$firstname,$lastname,$username,$msisdn) {
		$query = 'INSERT INTO onemanwenttomow.user
					SET	username = "'.$username.'",
					password = "'.$password.'",
					firstname = "'.$firstname.'",
					lastname = "'.$lastname.'",
					msisdn = "'.$msisdn.'",
					statusid = 100,
					creationdate = now(),
					lastmodifieddate = now()'; 
		$result = mysql_query($query) or die ("createuser() query failed: " . mysql_error() . "The query was " . $query);
		if ($result){
			return "SUCCESS";
		} else {
			return "ERROR";
		}
	}
?>