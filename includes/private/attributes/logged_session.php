<?php
if($_SERVER['HTTP_HOST'] == "localhost"){
	@$logged_session=$_COOKIE[$properties->_COOKIE_INIT_LOCAL_SESSION];
} else {
	@$logged_session=$_COOKIE[$properties->_COOKIE_INIT_REMOTE_SESSION];
}	
?>