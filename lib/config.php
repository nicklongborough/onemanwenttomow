<?php
// DB connection info
//Local Development

$db_ip = 'db2465.oneandone.co.uk';
$db_user = 'dbo328145735';
$db_pass = 'w3bus3r';
$db_user_write = 'db0328145735';
$db_pass_write = 'w3bus3r';

	if ($_SERVER["SERVER_NAME"] == 'localhost') {
		$db_ip = 'localhost';
		$db_user = 'web';
		$db_pass = 'w3bus3r';
		$db_user_write = 'web';
		$db_pass_write = 'w3bus3r';
	} else {
		$db_ip = 'db2465.oneandone.co.uk';
		$db_user = 'dbo328145735';
		$db_pass = 'w3bus3r';
		$db_ip_write = 'db2465.oneandone.co.uk';
		$db_user_write = 'dbo328145735';
		$db_pass_write = 'w3bus3r';
	}
// Set the cache limiter to ensure that back button always works, but page is reloaded when a link is clicked (beware: also means that user can click back after logging out)
session_cache_limiter('must-revalidate');

// Set timezone
putenv("TZ=Europe/London");

?>
