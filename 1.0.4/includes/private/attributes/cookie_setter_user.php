<?php
if($_SERVER['HTTP_HOST'] == 'localhost'){
	setcookie($properties->_COOKIE_INIT_LOCAL_SESSION,$lsessionid,(time() + (20 * 365 * 24 * 60 * 60)),"/");	
} else {
	setcookie($properties->_COOKIE_INIT_REMOTE_SESSION,$lsessionid,(time() + (20 * 365 * 24 * 60 * 60)),"/");
}
?>