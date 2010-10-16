<?php
	//-----------------------------------------------------------------------------------------------------------------
	// MEDIA - This library is used for all database interaction related to a media object
	//-----------------------------------------------------------------------------------------------------------------

	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to retrieve a media item using a mediaid
	//-----------------------------------------------------------------------------------------------------------------
	function getMediaByID($mediaid) {
		$query = '	SELECT m.mediaid AS MEDIAID, m.title AS TITLE, m.description AS DESCRIPTION, m.url AS URL
					FROM onemanwenttomow.media m
					WHERE m.mediaid=' . $mediaid;
		$result = mysql_query($query) or die ("getMediaByID() query failed: " . mysql_error() . "The query was " . $query);
		$return = array();
		while ($row = mysql_fetch_assoc($result)) {
			array_push($return,$row);
		}
		return $return;
	}
	
	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to retrieve an array of media items for a user using their username
	//-----------------------------------------------------------------------------------------------------------------
	function getMediaByUser($username) {
		$query = '	SELECT m.mediaid AS MEDIAID, m.title AS TITLE, m.description AS DESCRIPTION, m.url AS URL, DATE_FORMAT(m.creationdate,\'%W %D %H:%i\') AS CREATIONDATE, m.lastmodifieddate AS LASTMODIFIEDDATE
				FROM onemanwenttomow.user u, onemanwenttomow.media m
				WHERE u.username="' . $username. '" AND m.userid=u.userid';
		$result = mysql_query($query) or die ("getMediaByUser() query failed: " . mysql_error() . "The query was " . $query);
		$return = array();
		while ($row = mysql_fetch_assoc($result)) {
			array_push($return,$row);
		}
		return $return;
	}
	
	//-----------------------------------------------------------------------------------------------------------------
	// This is the query used to create a media item
	//-----------------------------------------------------------------------------------------------------------------
	function insertNewMediaRecord($userid,$basepath,$fileextension) {

		$query = 'SELECT MAX(m.mediaid) as MAX_MEDIA_ID FROM onemanwenttomow.media m';
		$result_new_id = mysql_query($query) or die ("Get next media ID failed: " . mysql_error());					
		$row_media_id = mysql_fetch_assoc($result_new_id);

		if (!$row_media_id['MAX_MEDIA_ID']) {
			// Must be the first file to be added to the meida table
			$mediaid = 1000;
			$mediaurl = $basepath . $mediaid .".". $fileextension;
		} else {
			$mediaid = $row_media_id['MAX_MEDIA_ID'] +1;
			$mediaurl = $basepath . $mediaid .".". $fileextension;
		}

		$query_add_media = 'INSERT INTO	onemanwenttomow.media
							SET	mediaid = '.$mediaid.',
								creationdate = now(),
								userid = '.$userid.',
								lastmodifieddate = now(),
								title = "'.$mediaid.'",
								url = "'.$mediaurl.'",
								statusid = 100';		
			$result_add_media = mysql_query($query_add_media) or die ("Adding Media failed: " . mysql_error() . ":" . $query_add_media);
		return $mediaid;
	}
?>