<?php
//global includes
require "../../../conf/props.php";

//make the properties
$properties = new properties();

//include connect stuff
include "../../../conf/connect.php";

// you can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
/* RESET VARIABLES */
$value="";
$error_console="";

/* DETERMINE THE WEBSITE_URL */
if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}

$RETURN_URL=getReturnURL();

/* STEP 1: GET VARIABLES */
@$uname=$_POST['uname'];
@$upass=$_POST['upass'];
@$launchpad=$_POST['launchpad'];
@$ip=$_SERVER['REMOTE_ADDR'];

if(isset($_POST['fu']) || isset($_POST['fp'])){
	/* FORGET PROTOCAL */
	if(isset($_POST['fu'])){
		/* FORGET USERNAME PROTOCAL */
		echo "What is your username?";
	} else if(isset($_POST['fp'])){
		/* FORGET PASSWORD PROTOCAL */
		echo "What is your username?";
	}
} else {
	/* LOGGING IN PROTOCAL */
	/* STEP 2: CHECK FOR ACCURACY */
	if($uname=="Username" || $uname==""){
		/* FAILED SOME WHERE; FIND OUT WHERE */
		if($uname==""){
			$error_console="";$error_console="Username cannot be empty.";	
		} else if($uname=="Username"){
			$error_console="";$error_console="Can't use <b>{$uname}</b>!";
		}
	} else {
		/* PASSED USERNAME; CHECK PASSWORD */
		if($upass=="" || $upass=="Password"){
			/* FAILED SOMEWHERE; FIND OUT WHERE */
			if($upass==""){
				$error_console="";$error_console="Password cannot be empty.";	
			} else if($upass=="Password"){
				$error_console="";$error_console="Can't use this Password!";
			}	
		} else {
			/* PASSED PASSWORD; MOVE ON */
			//check for user in DB
			$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='{$uname}'");
			if(mysql_num_rows($CHECK_LOGIN)<1){
				/* USER NOT FOUND */
				$error_console="<b>{$uname}</b> does not exist on our server.";
			} else {
				/* USER FOUND */
				//find out if password matches
				while($FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN)){
					$in_db_pass=$FETCH_LOGIN['upass'];
					$status=$FETCH_LOGIN['status'];
					$suspended_reason=$FETCH_LOGIN['suspended_reason'];
				}
				if(hash('sha256',md5(sha1($upass))) == $in_db_pass){
					/* PASSWORD MATCHES */				
					//check for status
					switch($status){
						case 'active':
							$error_console="";
						break;
						case 'pending':
							$error_console="<b>{$uname}</b> is a new user and is currently being reviewed at the moment.";
						break;
						case 'deleted':
							$error_console="<b>{$uname}</b> does not exist on our server.";
						break;
						case 'suspended':
							$error_console="<b>{$uname}</b> has been suspended due to <b>{$suspended_reason}</b>.<br /><br /><b><u>Solution</u></b><br />You must contact the<br />the Webmaster <a href=\"".$WEBSITE_URL.$launchpad."/contact\" class=\"white-url\" style=\"color: white !important; padding:0 !important;\">here</a>.";
						break;
						case 'denied':
							$error_console="<b>{$uname}</b> does not exist on our server.";
						break;
					}
					
					if($error_console==""){
						/* SO FAR SO GOOD; CONTINUE TO CHECK FOR LOGGED */					
						$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$uname'");
						$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
						if($FETCH_IP['loggedin']=="yes"){
							/*USER IS LOGGED IN*/
							$error_console="<b>{$uname}</b> is already logged in. <a onclick=\"window.open('".$RETURN_URL."help.php','the_why_of_not_login', 'width=500,height=500')\" style=\"cursor:pointer;\">Why?</a>";
						} else {
							/* NOT LOGGED; LOG THEM IN */	
							//make logged session id
							$lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));
							
							//set session cookie that will expire in 20 years (it's ok)
							include("cookie_setter_user.php");
							
							//get dateand time
							//0000-00-00 00:00:00
							$dateandtime=date("Y-m-d H:i:s");
							
							//update the db
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$uname'");
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$uname'");
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$uname'");
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$uname'");
							
							$value="You have been successfully logged in! <a href=\"".$RETURN_URL."\" class=\"white-url\">Reload</a>";
						}
						
					} else {
						/* FAILED */
						$error_console=$error_console;
					}
					
					/* STEP 3: MASTER SOME STUFF */
					
					
					/* STEP 4: LOG PERSON IN */
				} else {
					/* PASSWORD FAILS */
					$error_console="Wrong Password! Try again :)";		
				}
			}
		}
	}
	if($error_console!=""){$value=$error_console;}{$value=$value;}
	echo "<hr>".$value;	
}
?>