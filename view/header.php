<?php
	include_once '../lib/config.php';
	include_once '../lib/lib.php';
	
	get_db_conn(0);
	session_start();
	
echo '
<fieldset class="header">
	<div class="header" onclick="location.href=\'mediagallery.php\';" style="cursor:pointer;">Onemanwenttomow</div>	
	<div class="clear"></div>
	<div class="leftlink">
		<a href="mediagallery.php">Gallery</a>
	</div>
	<div class="leftlink">
		<a href="user.php">Account</a>				
	</div>
	<div class="rightlink">
		<a href="../login.php">Logout</a>
	</div>
</fieldset>
<br />';		
?>