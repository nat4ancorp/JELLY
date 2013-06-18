<?php
//global includes
require "../../../conf/props.php";

//make the properties
$properties = new properties();

//include connect stuff
include "../../../conf/connect.php";

// you can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
@$themeToID=$_POST['themeToID'];
@$username=$_POST['username'];
@$ACTION=$_GET['action'];
//if($dismissCheck == "Yes"){$value="yes";} else {$value="no";}

//get stuff for the update
$ip=tempSystem($properties,"getIP","");
$SESSIONID=tempSystem($properties,"getSESSION","");

switch($ACTION){
	case 'leavesite':
	/* function for leaving site */
	
	if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}
	
	//check the error console
	if($error_console!=""){
		/* FAILED */
		echo $error_console;
	} else {
		/* PASSED */												
		//update the db
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
		echo "yes";
	}
	break;
	
	case 'logout':
	/* function for logout */
	if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}
	
	//check the error console
	if($error_console!=""){
		/* FAILED */
		echo $error_console;
	} else {
		/* PASSED */												
		//update the db
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
		
		// REMOVE THE COOKIE FROM THE BROWSER
		include("../attributes/cookie_destroyer_user.php");
		echo "yes";
	}
	break;
	
	case 'changeThemeUser':
	/* function for leaving site */
	
	if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}
	
	//check the error console
	if($error_console!=""){
		/* FAILED */
		echo $error_console;
	} else {
		/* PASSED */												
		//update the db
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET themeID='".$themeToID."' WHERE uname='$username'");
		echo "yes";
	}
	break;
}
?>