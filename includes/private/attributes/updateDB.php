<?php
//global includes
require "../../../conf/props.php";

//make the properties
$properties = new properties();

//include connect stuff
include "../../../conf/connect.php";

// you can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
@$dismissCheck = $_POST['dismissCheck'];
@$typeOfUser=$_POST['typeOfUser'];
$logged_session=$_POST['loggedSession'];
if($dismissCheck == "yes"){$value="yes";} else {$value="no";}

//get stuff for the update
$ip=tempSystem($properties,"getIP","");
$SESSIONID=tempSystem($properties,"getSESSION","");

if($typeOfUser=="user"){
	/* UPDATE USERS */
	$result=mysql_query("UPDATE {$properties->DB_PREFIX}users SET fb_like='".$value."' WHERE logged_ip='".$ip."' AND logged_session='".$logged_session."'") or die("Um...an error happened: ".mysql_error());
} else if($typeOfUser=="temp") {
	/* UPDATE TEMPSYSTEM */
	mysql_query("UPDATE {$properties->DB_PREFIX}tempsystem SET fb_like='".$value."' WHERE ip='".$ip."' AND temp_session='".$SESSIONID."'") or die("Um...an error happened: ".mysql_error());	
}
if(!$result){$value=mysql_error($result);}
echo $value;
?>