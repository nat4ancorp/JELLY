<html>
<head>
<?php
/* LOAD IN YOUR INCLUDES THAT ARE IMPORTANT */
include 'conf/props.php';

$properties=new properties();

/* INCLUDES/REQUIRES THAT NEED PROPERTIES IN ORDER TO FUNCTION */
include 'conf/connect.php';
?>
<title>Help!</title>
<script type="text/javascript">
window.onunload = refreshParent;
function refreshParent(){
	window.opener.location.reload();
}
</script>
</head>
<body>
<h1>Need help?</h1>
<p>See if you can find out from one of the FAQs below:</p>
<hr>
<p>
<b>When I login, I get a "...is already logged in." message, what do I do?</b>
<br />
If you are trying to access your account and you stumble upon a message that reads "<i>your_username</i> is already loggedin." and you do not think you are logged in - chances are you forgot to log out the last time you were on this site which could have been on a different computer. 
<br /><br />
<b>Explanation:</b> The reason we do this is because of the way our highly secure system works. We are attempting to limit or prevent hacking by using a 3-key system. Not going to go into too much code junk but the three-key system matches data in our database to your computer.
<br /><br />

<b>Solution:</b> To log yourself out, please use the form below:
<center>
<?php
error_reporting(0);
if(isset($_POST['logout'])){
	/* DO CHECK */
	//get user
	$username=$_POST['uname'];
	$password=$_POST['upass'];
	$ip=$_SERVER['REMOTE_ADDR'];
	
	//check for blanks
	if($password==""){$error_console.="Password is missing.<br />";}
	if($username==""){$error_console.="Username is missing.<br />";}
	
	if($error_console==""){
		//check for username in db
		$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'") or die(mysql_error());
		if(mysql_num_rows($CHECK_USERNAME)<1){
			/* user not there */
			$error_console.="<b>{$username}</b> does not exist on our server.<br />";
		} else {
			$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
			$status=$FETCH_USERNAME['status'];
			$suspended_reason=$FETCH_USERNAME['suspended_reason'];
															
			switch($status){
				case 'active':
					$error_console.="";
				break;
				case 'pending':
					$error_console.="<b>{$username}</b> is a new user and it currently being reviewed at the moment.<br />";
				break;
				case 'deleted':
					$error_console.="<b>{$username}</b> does not exist on our server.<br />";
				break;
				case 'suspended':
					$error_console.="<b>{$username}</b> has been suspended due to <b>{$suspended_reason}</b>.<br />";
				break;
				case 'denied':
					$error_console.="<b>{$username}</b> does not exist on our server.<br />";
				break;
			}
		}
		
		if($error_console==""){
			//check the password
			$CHECK_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
			if(mysql_num_rows($CHECK_PASSWORD)<1){
				/* not a user */
			} else {
				$FETCH_PASSWORD=mysql_fetch_array($CHECK_PASSWORD);
				$db_upass=$FETCH_PASSWORD['upass'];
				if(hash('sha256',md5(sha1($password)))!=$db_upass){
					$error_console.="The password you entered does not match with what is on file.<br />";
				} else {
					//logged them out
					if($error_console==""){
						//check if user is logged in
						$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'") or die(mysql_error());
						$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
						if($FETCH_IP['loggedin']=="yes"){
							/*USER IS LOGGED IN*/
							$error_console.="";
						} else {
							$error_console.="<b>{$username}</b> is not logged in.<br />";
							echo $error_console;
							echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
						}
					} else {
						echo $error_console;
						echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
					}
				}
			}					
			
		} else {
			echo $error_console;
			echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
		}
		
	} else {
		echo $error_console;
		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
	}
	
	//check the error console
	if($error_console!=""){
	/* FAILED */
	} else {
	/* PASSED */
	
	//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
	include("includes/private/attributes/cookie_destroyer_user.php");
	
	//update the db
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
					
	echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
	}
} else {
	?>
	<form action="" method="post">
	<label>Username</label>
	<input type="text" name="uname" value="">
	<label>Password</label>
	<input type="password" name="upass" value="">
	<input type="submit" name="logout" value="Fix it...Fix IT...FIX IT!">
	</form>
	<?php
}
?>
</center>
NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href="forgotpassword" class="white">here</a>
</p>
<hr />
</body>
</html>