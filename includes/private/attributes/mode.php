<?php
/*
CORE MODE DETERMINATION SYSTEM
This system was designed as of 3.9 to be simpler and easier to edit versus having multiple files to update.
The way this file operates is depending on what mode you have set the framework on it will do a switch statement to determine what to display. If you would like to edit a "page", just search "MODE: <THE MODE TO BE EDITED>" while replacing "<THE MODE TO BE EDITED>" with the name of the mode in UPPERCASE. IE: I wanted to edit the Closed mode, I would search "MODE: CLOSED".

CODE HELPERS
I have also taken the liberty to add code helpers to each particular section that you may need to be able to find
Just type "[CODE-HELPER: <the code helper name>]" (without quotes of course), replacing the "<the code helper name> with a name from below:

MESSAGE_TOP					= The top section of the box with text.
CLOSED_BETA_TOP_MESSAGE		= The message of the top of the closed beta thing
*/
?>
<!-- MODE DETERMINATION -->
<?php
switch($MODE){
case 'closed':
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* ---------------------------------------------------- MODE: CLOSED --------------------------------------------------- */

/* DETECT IF LOGGED IN AND AGREED TO TOU */
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
$logged=0;
} else {
$logged=1;
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$loggedin=$FETCH_LOGIN['loggedin'];
$tou_s=$FETCH_LOGIN['tou_status'];
$in_site=$FETCH_LOGIN['in_site'];
$status=$FETCH_LOGIN['status'];
$suspended_reason=$FETCH_LOGIN['suspended_reason'];
if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
$username=$FETCH_LOGIN['uname'];
$type=$FETCH_LOGIN['type'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];

}

if($logged==1){		
/* LOGGED IN */
/* CHECK IF GOING TO SITE */
if( ($in_site=="yes") ){			
/* IN SITE */
//check to see the user account status
if($status!="active"){
/* SOMETHING WRONG WITH THEIR ACCOUNT STANDING */
switch($status){				
	case 'pending':
	?>	
	<div id="splash-container3">
		<div id="splash-container2">
			<div id="splash-container1">
				<div id="splash-col1"> </div>
				<div id="splash-col2">
					<div id="top"> 
						<?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> 
					</div>
					<div id="mid">
						<?php
						//get necessary stuff
						$ip=$_SERVER['REMOTE_ADDR'];
						include("includes/private/attributes/logged_session.php");
						
						//check for logged in status
						$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
						$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
						$fname=$FETCH_LOGIN['fname'];
						$username=$FETCH_LOGIN['uname'];
						$lname=$FETCH_LOGIN['lname'];
						$type=$FETCH_LOGIN['type'];
						$tou_status=$FETCH_LOGIN['tou_status'];
						?>
						<div id="mid-table">
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol">
									<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
									Welcome to the Admin Access Event Panel</h1>
								</div>
								<div id="mid-table-rightcol"> </div>
							</div>
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol">
									<?php
									$DISPLAY_STATUS_MESSAGE="Your account is new and is still under review. Please be patient.";									
									if(isset($_POST['logout'])){
										$username=$_POST['username'];
										//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
										include("includes/private/attributes/cookie_destroyer_user.php");
									
										//update the db
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
																
										echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
									} else {
										echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
										?>
										<form action="" method="post">
											<input type="hidden" name="username" value="<?php echo $username;?>" />
											<input type="submit" name="logout" value="Logout" />
										</form>
										<?php
									}
									?>
								</div>
								<div id="mid-table-rightcol"> </div>
							</div>
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol"> </div>
								<div id="mid-table-rightcol"> </div>
							</div>
						</div>
					</div>
					<div id="bottom">
						<center>
							<?php
								/* LOAD DYNAMICALLY-UPDATED LINK FILE */
								include("includes/private/attributes/splashlinks.php");
							?>
						</center>
					</div>
				</div>
				<div id="splash-col3"> </div>
			</div>
		</div>
	</div>
	<?php
	break;

	case 'deleted':
	?>
	<div id="splash-container3">
		<div id="splash-container2">
			<div id="splash-container1">
				<div id="splash-col1"> </div>
				<div id="splash-col2">
					<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
					<div id="mid">
						<?php
						//get necessary stuff
						$ip=$_SERVER['REMOTE_ADDR'];
						include("includes/private/attributes/logged_session.php");
						
						//check for logged in status
						$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
						$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
						$fname=$FETCH_LOGIN['fname'];
						$username=$FETCH_LOGIN['uname'];
						$lname=$FETCH_LOGIN['lname'];
						$type=$FETCH_LOGIN['type'];
						$tou_status=$FETCH_LOGIN['tou_status'];
						?>
						<div id="mid-table">
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol">
									<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
									Welcome to the Admin Access Event Panel</h1>
								</div>
								<div id="mid-table-rightcol"> </div>
							</div>
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol">
									<?php
									$DISPLAY_STATUS_MESSAGE="The Account you are logged in with does not exist in the system. Long-story-short, your account got \"deleted\" for some reason.";
									if(isset($_POST['logout'])){
										$username=$_POST['username'];
										//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
										include("includes/private/attributes/cookie_destroyer_user.php");
									
										//update the db
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
																
										echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
									} else {
										echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
										?>
										<form action="" method="post">
											<input type="hidden" name="username" value="<?php echo $username;?>" />
											<input type="submit" name="logout" value="Logout" />
										</form>
										<?php
									}
									?>
								</div>
								<div id="mid-table-rightcol"> </div>
							</div>                                  
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol"> </div>
								<div id="mid-table-rightcol"> </div>
							</div>      
						</div>                                        
					</div>
					<div id="bottom">
						<center>
							<?php
								/* LOAD DYNAMICALLY-UPDATED LINK FILE */
								include("includes/private/attributes/splashlinks.php");
							?>
						</center>
					</div>
			   </div>
			   <div id="splash-col3"> </div>
			</div>
		</div>
	</div>
	<?php
	break;

	case 'suspended':
	?>
	<div id="splash-container3">
		<div id="splash-container2">
			<div id="splash-container1">
				<div id="splash-col1"> </div>
				<div id="splash-col2">
				<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
				<div id="mid">
					<?php
					//get necessary stuff
					$ip=$_SERVER['REMOTE_ADDR'];
					include("includes/private/attributes/logged_session.php");
					
					//check for logged in status
					$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
					$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
					$fname=$FETCH_LOGIN['fname'];
					$username=$FETCH_LOGIN['uname'];
					$lname=$FETCH_LOGIN['lname'];
					$type=$FETCH_LOGIN['type'];
					$tou_status=$FETCH_LOGIN['tou_status'];
					$suspended_reason=$FETCH_LOGIN['suspended_reason'];
					?>
					<div id="mid-table">
						<div class="mid-table-row">
							<div id="mid-table-leftcol"> </div>
							<div id="mid-table-midcol">
								<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
								Welcome to the Admin Access Event Panel</h1>
							</div>
							<div id="mid-table-rightcol"> </div>
						</div>
						<div class="mid-table-row">
							<div id="mid-table-leftcol"> </div>
							<div id="mid-table-midcol">
							<?php
							if($suspended_reason==""){$suspended_reason="you did something wrong. :(";}
	$DISPLAY_STATUS_MESSAGE="We're sorry but your account has been temporarily suspended because <b>".$suspended_reason."</b>.";
							if(isset($_POST['logout'])){
								$username=$_POST['username'];
								//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
								include("includes/private/attributes/cookie_destroyer_user.php");
							
								//update the db
								mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
								mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
								mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
								mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
														
								echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
							} else {
								echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
								?>
								<form action="" method="post">
									<input type="hidden" name="username" value="<?php echo $username;?>" />
									<input type="submit" name="logout" value="Logout" />
								</form>
								<?php
							}
							?>
							</div>
							<div id="mid-table-rightcol"> </div>
						</div>
						<div class="mid-table-row">
							<div id="mid-table-leftcol"> </div>
							<div id="mid-table-midcol"> </div>
							<div id="mid-table-rightcol"> </div>
						</div>
					</div>
				</div>
				<div id="bottom">
					<center>
					<?php
						/* LOAD DYNAMICALLY-UPDATED LINK FILE */
						include("includes/private/attributes/splashlinks.php");
					?>
					</center>
				</div>
				</div>
				<div id="splash-col3"> </div>
			</div>
		</div>
	</div>
	<?php
	break;

	case 'denied':
	?>
		<div id="splash-container3">
			<div id="splash-container2">	
				<div id="splash-container1">
					<div id="splash-col1"> </div>
					<div id="splash-col2">
						<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
						<div id="mid">
							<?php
							//get necessary stuff
							$ip=$_SERVER['REMOTE_ADDR'];
							include("includes/private/attributes/logged_session.php");
							
							//check for logged in status
							$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
							$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
							$fname=$FETCH_LOGIN['fname'];
							$username=$FETCH_LOGIN['uname'];
							$lname=$FETCH_LOGIN['lname'];
							$type=$FETCH_LOGIN['type'];
							$tou_status=$FETCH_LOGIN['tou_status'];
							?>
							<div id="mid-table">
								<div class="mid-table-row">
									<div id="mid-table-leftcol"> </div>
									<div id="mid-table-midcol">
										<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
										Welcome to the Admin Access Event Panel</h1>
									</div>
									<div id="mid-table-rightcol"> </div>
								</div>
								<div class="mid-table-row">
									<div id="mid-table-leftcol"> </div>
									<div id="mid-table-midcol">
										<?php
										$DISPLAY_STATUS_MESSAGE="The Account that you are logged in with has currently been denied access by the admin. Sorry about this. No real way of getting the account back. :) You can create a new account for FREE!";
										if(isset($_POST['logout'])){
											$username=$_POST['username'];
											//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
											include("includes/private/attributes/cookie_destroyer_user.php");
										
											//update the db
											mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
											mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
											mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
											mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
																	
											echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
										} else {
											echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
											?>
											<form action="" method="post">
												<input type="hidden" name="username" value="<?php echo $username;?>" />
												<input type="submit" name="logout" value="Logout" />
											</form>
											<?php
										}
										?>
									</div>
									<div id="mid-table-rightcol"> </div>
								</div>
								<div class="mid-table-row">
									<div id="mid-table-leftcol"> </div>
									<div id="mid-table-midcol"> </div>
									<div id="mid-table-rightcol"> </div>
								</div>
							</div>
						</div>
						<div id="bottom">
							<center>
								<?php
								/* LOAD DYNAMICALLY-UPDATED LINK FILE */
								include("includes/private/attributes/splashlinks.php");

								?>
							</center>
						</div>
					</div>
					<div id="splash-col3"> </div>
				</div>
			</div>
		</div>
	<?php
	break;
}
} else {
//check for agree to tou
if($agreed==1){
/* AGREED */
runAchievementCheck('checkBadgeMessages',$properties,$user_id,$WEBSITE_URL);
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>
<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
?>
<?php
} else if($agreed==0){
/* DISAGREED */
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
<div id="mid">
<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Admin Access Control Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php											
if(isset($_POST['set_tou'])){
/* POST ACTION FOR TOU */
//get post elements
$agree_status="unchecked";
$disagree_status="unchecked";
$set_tou=$_POST['tou'];

if($set_tou=="agree"){
/* agreed to tou */
$error_console="";

} else if($set_tou=="disagree") {
/* disagreed to tou */
$error_console="You must agree to the Terms of Use before you go in";
} else {
$error_console="You must respond before you go in";
}

if($error_console!=""){
/* FAILED */
echo $error_console;

} else {
/* PASSED */
//update user
mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
}

} else {
/* TOU BAD */
?>
Before entering this site, you must agree to the <a onclick="window.open('<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE <br />
<br />
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Your response</label>
</div>
<div class="formLayoutTableConstructionRowLeftCol">
<input type="hidden" name="wtd" value="enter_site" />
<input type="radio" name="tou" value="agree" />
I agree
<input type="radio" name="tou" value="disagree" />
I disagree </div>
</div>
<br />
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="set_tou" value="Enter" class="submit" />
</div>
</div>
</div>
</form>
<?php
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
</div>
<div id="bottom">
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
}
}
} else {
/* OUT OF SITE */		
if($status!="active"){
/* SOMETHING WRONG WITH THEIR ACCOUNT STANDING */
switch($status){				
	case 'pending':
	?>
	<div id="splash-container3">
		<div id="splash-container2">
			<div id="splash-container1">
				<div id="splash-col1"> </div>
				<div id="splash-col2">
					<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
					<div id="mid">
						<?php
						//get necessary stuff
						$ip=$_SERVER['REMOTE_ADDR'];
						include("includes/private/attributes/logged_session.php");

						//check for logged in status
						$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
						$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
						$fname=$FETCH_LOGIN['fname'];
						$username=$FETCH_LOGIN['uname'];
						$lname=$FETCH_LOGIN['lname'];
						$type=$FETCH_LOGIN['type'];
						$tou_status=$FETCH_LOGIN['tou_status'];
						?>
						<div id="mid-table">
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol">
									<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
									Welcome to the Admin Access Event Panel</h1>
								</div>
								<div id="mid-table-rightcol"> </div>
							</div>
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol">
									<?php
									$DISPLAY_STATUS_MESSAGE="Your account is new and is still under review. Please be patient.";									
									if(isset($_POST['logout'])){
										$username=$_POST['username'];
										//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
										include("includes/private/attributes/cookie_destroyer_user.php");
									
										//update the db
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
										mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
																
										echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
									} else {
										echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
										?>
										<form action="" method="post">
											<input type="hidden" name="username" value="<?php echo $username;?>" />
											<input type="submit" name="logout" value="Logout" />
										</form>
										<?php
									}
									?>
								</div>
								<div id="mid-table-rightcol"> </div>
							</div>
							<div class="mid-table-row">
								<div id="mid-table-leftcol"> </div>
								<div id="mid-table-midcol"> </div>
								<div id="mid-table-rightcol"> </div>
							</div>
						</div>
					</div>
					<div id="bottom">
						<?php
							/* LOAD DYNAMICALLY-UPDATED LINK FILE */
							include("includes/private/attributes/splashlinks.php");
						?>
					</div>
				</div>
				<div id="splash-col3"> </div>
			</div>
		</div>
	</div>
	<?php
	break;

	case 'deleted':
	?>
	<div id="splash-container3">
	<div id="splash-container2">
	<div id="splash-container1">
	<div id="splash-col1"> </div>
	<div id="splash-col2">
	<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
	<div id="mid">
	<?php
	//get necessary stuff
	$ip=$_SERVER['REMOTE_ADDR'];
	include("includes/private/attributes/logged_session.php");
	
	//check for logged in status
	$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
	$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
	$fname=$FETCH_LOGIN['fname'];
	$username=$FETCH_LOGIN['uname'];
	$lname=$FETCH_LOGIN['lname'];
	$type=$FETCH_LOGIN['type'];
	$tou_status=$FETCH_LOGIN['tou_status'];
	?>
	<div id="mid-table">
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol">
	<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
	Welcome to the Admin Access Event Panel</h1>
	</div>
	<div id="mid-table-rightcol"> </div>
	</div>
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol">
	<?php
	$DISPLAY_STATUS_MESSAGE="The Account you are logged in with does not exist in the system. Long-story-short, your account got \"deleted\" for some reason.";	
	if(isset($_POST['logout'])){
		$username=$_POST['username'];
		//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
		include("includes/private/attributes/cookie_destroyer_user.php");
	
		//update the db
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
								
		echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
	} else {
		echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
		?>
		<form action="" method="post">
			<input type="hidden" name="username" value="<?php echo $username;?>" />
			<input type="submit" name="logout" value="Logout" />
		</form>
		<?php
	}
	?>
	</div>
	<div id="mid-table-rightcol"> </div>
	</div>
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol"> </div>
	<div id="mid-table-rightcol"> </div>
	</div>
	</div>
	</div>
	<div id="bottom">
	<?php
	/* LOAD DYNAMICALLY-UPDATED LINK FILE */
	include("includes/private/attributes/splashlinks.php");
	?>
	</div>
	</div>
	<div id="splash-col3"> </div>
	</div>
	</div>
	</div>
	<?php
	break;
	
	case 'suspended':
	?>
	<div id="splash-container3">
	<div id="splash-container2">
	<div id="splash-container1">
	<div id="splash-col1"> </div>
	<div id="splash-col2">
	<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
	<div id="mid">
	<?php
	//get necessary stuff
	$ip=$_SERVER['REMOTE_ADDR'];
	$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
	
	//check for logged in status
	$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
	$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
	$fname=$FETCH_LOGIN['fname'];
	$username=$FETCH_LOGIN['uname'];
	$lname=$FETCH_LOGIN['lname'];
	$type=$FETCH_LOGIN['type'];
	$tou_status=$FETCH_LOGIN['tou_status'];
	?>
	<div id="mid-table">
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol">
	<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
	Welcome to the Admin Access Event Panel</h1>
	</div>
	<div id="mid-table-rightcol"> </div>
	</div>
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol">
	<?php
	if($suspended_reason==""){$suspended_reason="you did something wrong. :(";}
	$DISPLAY_STATUS_MESSAGE="We're sorry but your account has been temporarily suspended because <b>".$suspended_reason."</b>.";
	if(isset($_POST['logout'])){
		$username=$_POST['username'];
		//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
		include("includes/private/attributes/cookie_destroyer_user.php");
	
		//update the db
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
								
		echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
	} else {
		echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
		?>
		<form action="" method="post">
			<input type="hidden" name="username" value="<?php echo $username;?>" />
			<input type="submit" name="logout" value="Logout" />
		</form>
		<?php
	}
	?>
	</div>
	<div id="mid-table-rightcol"> </div>
	</div>
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol"> </div>
	<div id="mid-table-rightcol"> </div>
	</div>
	</div>
	</div>
	<div id="bottom">
	<?php
	/* LOAD DYNAMICALLY-UPDATED LINK FILE */
	include("includes/private/attributes/splashlinks.php");
	?>
	</div>
	</div>
	<div id="splash-col3"> </div>
	</div>
	</div>
	</div>
	<?php
	break;
	
	case 'denied':
	?>
	<div id="splash-container3">
	<div id="splash-container2">
	<div id="splash-container1">
	<div id="splash-col1"> </div>
	<div id="splash-col2">
	<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
	<div id="mid">
	<?php
	//get necessary stuff
	$ip=$_SERVER['REMOTE_ADDR'];
	include("includes/private/attributes/logged_session.php");
	
	//check for logged in status
	$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
	$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
	$fname=$FETCH_LOGIN['fname'];
	$username=$FETCH_LOGIN['uname'];
	$lname=$FETCH_LOGIN['lname'];
	$type=$FETCH_LOGIN['type'];
	$tou_status=$FETCH_LOGIN['tou_status'];
	?>
	<div id="mid-table">
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol">
	<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
	Welcome to the Admin Access Event Panel</h1>
	</div>
	<div id="mid-table-rightcol"> </div>
	</div>
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol">
	<?php
	$DISPLAY_STATUS_MESSAGE="The Account that you are logged in with has currently been denied access by the admin. Sorry about this. No real way of getting the account back. :) You can create a new account for FREE!";
	if(isset($_POST['logout'])){
		$username=$_POST['username'];
		//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
		include("includes/private/attributes/cookie_destroyer_user.php");
	
		//update the db
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
								
		echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
	} else {
		echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
		?>
		<form action="" method="post">
			<input type="hidden" name="username" value="<?php echo $username;?>" />
			<input type="submit" name="logout" value="Logout" />
		</form>
		<?php
	}
	?>
	</div>
	<div id="mid-table-rightcol"> </div>
	</div>
	<div class="mid-table-row">
	<div id="mid-table-leftcol"> </div>
	<div id="mid-table-midcol"> </div>
	<div id="mid-table-rightcol"> </div>
	</div>
	</div>
	</div>
	<div id="bottom">
	<?php
	/* LOAD DYNAMICALLY-UPDATED LINK FILE */
	include("includes/private/attributes/splashlinks.php");
	?>
	</div>
	</div>
	<div id="splash-col3"> </div>
	</div>
	</div>
	</div>
	<?php
	break;
}
} else {
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
<div id="mid">
<?php
if( (isset($_POST['login'])) || ($_GET['page']=="forgotusername") || ($_GET['page']=="forgotpassword") || ($_GET['page']=="request") || ($_GET['page']=="control") || (isset($_POST['logout'])) ){
if((isset($_POST['login'])) || (isset($_POST['logout']))){
if(isset($_POST['login'])){
/* LOGIN ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
Logging in to <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get the $_POST variables
$username=$_POST['username'];
$password=$_POST['password'];
$ip=$_SERVER['REMOTE_ADDR'];

//check for username in db
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_USERNAME)<1){
/* user not there */
$error_console="<b>{$username}</b> does not exist on our server";
} else {
$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
$status=$FETCH_USERNAME['status'];
$suspended_reason=$FETCH_USERNAME['suspended_reason'];
				
switch($status){
case 'active':
$error_console="";
break;
case 'pending':
$error_console="<b>{$username}</b> is a new user and it currently being reviewed at the moment";
break;
case 'deleted':
$error_console="<b>{$username}</b> does not exist on our server";
break;
case 'suspended':
if($suspended_reason==""){$suspended_reason="you did something wrong. :(";}
$error_console="<b>{$username}</b> has been suspended because <b>{$suspended_reason}</b>";
break;
}
}

//check the password
$CHECK_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_PASSWORD)<1){
/* not a user */
} else {
$FETCH_PASSWORD=mysql_fetch_array($CHECK_PASSWORD);
//HERE
$db_upass=$FETCH_PASSWORD['upass'];
if(hash('sha256',md5(sha1($password)))!=$db_upass){
$error_console="The password you entered does not match with what is on file";
} else {
//check if user is logged in
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
if($FETCH_IP['loggedin']=="yes"){/*USER IS LOGGED IN*/$error_console="<b>{$username}</b> is already logged in. If this is your account and you do not think you are logged in: chances are you forgot to log out the last time you were on this site. To log yourself out, please <form action=\"\" method=\"post\"><input type=\"hidden\" name=\"logoutusername\" value=\"".$username."\"><input type=\"submit\" name=\"logout\" value=\"click here\"></form>NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href=\"forgotpassword\" class=\"white\">here</a>";}
}
}

//check for blanks
if($password==""){$error_console="Password is missing";}
if($username==""){$error_console="Username is missing";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
} else {
/* PASSED */
//make logged session id
$lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));

//set session cookie that will expire in 20 years (it's ok)
include("includes/private/attributes/cookie_setter_user.php");

//get dateand time
//0000-00-00 00:00:00
$dateandtime=date("Y-m-d H:i:s");

//update the db
mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$username'");

echo "<br />You have been successfully logged in!<br />Click <a href=\"".$WEBSITE_URL."\" class=\"white\">here</a> to go to your Admin Panel";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if(isset($_POST['logout'])){
/* LOGOUT ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
<br />
Logging out of <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php			
//get user
$username=$_POST['logoutusername'];

if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
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
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}

} else {
switch($_GET['page']){

case 'control':
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="top-sadminium"><br />
Admin Access</h1>
Use this form to login to the Admin Controls for this Flood Gate. Once logged in, you will be able to change everything about how this flood gate works. <br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="login" value="Login" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
$max_positions=getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<br />
<?php if($num_of_pos_left<1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open...:(</h1>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> position open!</h1>
<?php }else if($num_of_pos_left>1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open!!!</h1>
<?php }?>
<div class="forgot-assets">
<div class="forgot-assets">
<a class="white" href="forgotusername">Forget Username?</a> | <a class="white" href="forgotpassword">Forget Password?</a> |
<?php if($num_of_pos_left<1){?>
<a class="white" style="text-decoration:line-through;cursor:help;" title="There are no positions open so this link is not accessible">Request Access</a>
<?php }else{?>
<a class="white" href="request">Request Access</a>
<?php }?>
</div>
</div>
<br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="top-sadminium"><br />
Admin Access</h1>
<br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> YOU ARE CURRENTLY LOGGED IN </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a href="../" class="white">Go home</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;
case 'forgotusername':
if( isset($_POST['recover']) || isset($_POST['theanswer']) ){
if(isset($_POST['recover'])){
/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='".$_POST['email']."'");
?>
<h1 class="cbeta-top">
<?php 
if(($_POST['email']=="") || (CHECK_EMAIL($_POST['email'])==false)){
echo "<br /><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_EMAIL)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['email']}&quot;";
} else{
echo "<br />Security Information<br />We found an email matching<br />&quot;".$_POST['email']."&quot;<br />Now answer your Security Question to obtain your username:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$email=$_POST['email'];												

//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($FIND_EMAIL)<1){
/* DID NOT FIND EMAIL */
$error_console="<b>{$email}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_EMAIL_STATS=mysql_fetch_array($FIND_EMAIL);
$sqid=$FETCH_EMAIL_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}

//check for valid email
if(CHECK_EMAIL($email)==false){$error_console="Your Email doesn't look valid";}

//check for blank fields
if($email==""){$error_console="Your Email is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q']))){
/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$email=$_POST['email'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];
$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}

//check to see if pin is blank
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}
} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$email=$_POST['email'];


//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
echo "<br /><br /><br /><br /><br /><br /><h1>Your username is: ".$username."</h1>";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<?php if($error_console==""){?>
<a href="../" class="white">Go Home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;

case 'forgotpassword':
if( isset($_POST['recover']) || isset($_POST['theanswer']) || (isset($_POST['savenewpassword']))){
if(isset($_POST['recover'])){
/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$_POST['username']."'");
?>
<h1 class="cbeta-top">
<?php 
if($_POST['username']==""){
echo "<br /><br />Forget your password? No problem! Fill out the form with the your username and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_USERNAME)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['username']}&quot;";
} else{
echo "<br />Security Information<br />We found a username matching<br />&quot;".$_POST['username']."&quot;<br />Now answer your Security Question to reset your password:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$username=$_POST['username'];												

//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($FIND_USERNAME)<1){
/* DID NOT FIND USERNAME */
$error_console="<b>{$username}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_USERNAME_STATS=mysql_fetch_array($FIND_USERNAME);
$sqid=$FETCH_USERNAME_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}
						
//check for blank fields
if($username==""){$error_console="Your Username is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q'])) || (isset($_POST['savenewpassword']))){
/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php	
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$username=$_POST['username'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];

$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}


//check to see if pin is blank												
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}

} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$username=$_POST['username'];

//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
//reset password
if(isset($_POST['savenewpassword'])){
//get $_POST data
$username=$_POST['username'];
$newpassword=$_POST['newpassword'];
$cnewpassword=$_POST['cnewpassword'];

//check the last password
$CHECK_LAST_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_LAST_PASSWORD=mysql_fetch_array($CHECK_LAST_PASSWORD);
$upass=$FETCH_LAST_PASSWORD['upass'];
$email=$FETCH_LAST_PASSWORD['email'];
global $fname;
global $lname;
$fname=$FETCH_LAST_PASSWORD['fname'];
$lname=$FETCH_LAST_PASSWORD['lname'];
$gender=$FETCH_LAST_PASSWORD['gender'];
global $typeofuser;
$typeofuser=$FETCH_LAST_PASSWORD['type'];

if(strlen($newpassword)<6){$error_console="Your password must be at least 6 characters";}
if($cnewpassword!=$newpassword){$error_console="You passwords don't match";}
if($cnewpassword==""){$error_console="You must confirm your password";}
if($newpassword==""){$error_console="Your New Password is missing";}
//make sure they are not blank and other checks
if(hash('sha256',md5(sha1($newpassword))) == $upass){$error_console="You cannot use the same password. :(";}

//check the error_console
if($error_console!=""){
echo "<br /><br /><br /><br /><br />".$error_console;
} else {
//encrypt it
$newpassword=hash('sha256',md5(sha1($newpassword)));

//update database
mysql_query("UPDATE {$properties->DB_PREFIX}users SET upass='$newpassword' WHERE uname='$username'");

echo "<br /><br /><br /><br /><br />Thank you! Your password has successfully been changed. We have also sent you an email to <b>{$email}</b> for your reference.";

if(($fname=="BETA Member") || ($fname=="Admin")){if($gender=="male"){$fname="Mr.";}else if($gender=="female"){$fname="Ms.";}else if($gender=="other"){$fname="whom ever";}}
if($lname==$username){if($gender=="male"){$lname=$uname;;}else if($gender=="female"){$lname=$upass;}else if($gender=="other"){$lname="it may concern";}}

//convert typeofuser
if($typeofuser=="admin"){$typeofuser="Admin";}
if($typeofuser=="beta"){$typeofuser="BETA Member";}

//send an email with login details
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_reset_password',$to,$PADINFO,$pname_uri);
}
} else {
?>
Now create your new password <br />
<br />
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>New Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="newpassword" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cnewpassword" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="savenewpassword" value="Save" />
</div>
</div>
</div>
</form>
<?php
}
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<?php if($error_console==""){?>
<a href="../" class="white">Go home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your password? No problem! Fill out the form with your username and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;

case 'request':
if(isset($_POST['request'])){
/* DO REQUEST PROCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
/* CHECK CONTENT */

//get $_POST data
global $username;
global $password;															
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$email=$_POST['email'];
$why=$_POST['why'];

$pin_1=$_POST['pin_1'];
$pin_2=$_POST['pin_2'];
$pin_3=$_POST['pin_3'];
$pin_4=$_POST['pin_4'];

global $full_pin;
$full_pin=$pin_1.$pin_2.$pin_3.$pin_4;

//check the pin for accuracy
if(!is_numeric($full_pin)){$error_console="PIN must be numeric (no letters)";}
if(strlen($full_pin)<4){$error_console="PIN is not long enough; You missed a few numbers";}
if($full_pin==""){$error_console="PIN is missing";}

//check for blanks
if($why==""){$error_console="Why is missing";}
//check email in db
$CHECK_EMAIL_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email' AND status!='denied'");
if(mysql_num_rows($CHECK_EMAIL_IN_DB)<1){/* NOT FOUND; WE'RE GOOD */$email_in_db=false;} else {/* FOUND EMAIL; BAD */$email_in_db=true;}													
if($email_in_db == true){$error_console="<b>".$email."</b> is already in use";}
if(CHECK_EMAIL($email) == false){$error_console="Your Email doesn't look valid";}
if($email==""){$error_console="Your Email is missing";}
if($cpassword==""){$error_console="You must confirm your password";}
if($password==""){$error_console="Your Password is missing";}
if($username==""){$error_console="Your Username is missing";}

//check for passwords match
if($password != $cpassword){$error_console="Your passwords don't match";}

//check password len
if(strlen($password)<6){$error_console="Your password must be at least 6 characters long";}

//check for username avail in db
$GET_USER_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username' AND status!='denied'");
if(mysql_num_rows($GET_USER_IN_DB)<1){
/* username is cleared; not in db */
} else {												
$error_console="{$username} is already taken";
}											

//check to see if there are any errors
if($error_console != ""){
/* THERE ARE ERRORS */
echo "<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />".$error_console."</center>";
echo " <a href=\"javascript:history.go(-1)\" class=\"white\">Go back</a>";
} else {
/* PASSED */
echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Thank you for your interest in wanting to join our Admin team! We will review your application and should be able to get back to you within in 24 to 72 hours. Please be patient as bugging us will prolong the application process. :) <a href=\"../\" class=\"white\">Go Home</a>";
//encrypt the password
$epassword=hash('sha256',md5(sha1($password)));

//get the date and time
$dateandtime_applied=date("Y-m-d H:i:s");

//put user into db
mysql_query("INSERT INTO {$properties->DB_PREFIX}users (fname,lname,uname,upass,email,type,is_searchable,staff_type,status,pin,why,dateandtime_applied) VALUES ('ADMIN','$username','$username','$epassword','$email','admin','yes','','pending','$full_pin','$why','$dateandtime_applied')");

//get user data

//specials for email
global $event_name;
$event_name="Admin Registration";

//get the headwebmaster's title
$GET_HW_TITLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$properties->WEBMASTER_UNAME."'");
$FETCH_HW_TITLE=mysql_fetch_array($GET_HW_TITLE);
$staff_type=$FETCH_HW_TITLE['staff_type'];

//fetch the staff type name
$GET_TITLE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='{$staff_type}'");
$FETCH_TITLE_NAME=mysql_fetch_array($GET_TITLE_NAME);
global $webmaster_title;
$webmaster_title=$FETCH_TITLE_NAME['name'];

//send an email with login details
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_admin_registration',$to,$PADINFO,$pname_uri);
//send an email to web admin
//find the head admin or is_webmaster email
$FIND_HAORWM_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE head_admin='yes' AND is_webmaster='yes'");
$FETCH_HAORWM_EMAIL=mysql_fetch_array($FIND_HAORWM_EMAIL);
$HAORWM_EMAIL=$FETCH_HAORWM_EMAIL['email'];
//set to = to HAORWM
$to=$HAORWM_EMAIL;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'towebadmin_beta_admin_registration',$to,$PADINFO,$pname_uri);
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
$max_positions=getGlobalVars($properties,'max_admin_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
if($num_of_pos_left<1){
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 style="font-size:28px;line-height: 1em;"><br />
<br />
<br />
<br />
Well this is embarrassing...</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> Sorry...there are no positions available and the fact that you are here let's us know you are trying to get around the system and that is not going to look good if you want to work for us since we monitor all activity on this website. :) </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top">Want to be an admin? Fill out form.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cpassword" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Why?</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="why" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Create a PIN [<a style="cursor:pointer;" class="white" title="This is for extra security; Plus it is used to recover your username or password if you have not set up a Security Question and Answer">?</a>]</label>
</div>
<div class="formLayoutTableConstructionRowRightCol"> &nbsp;&nbsp;
<input type="password" name="pin_1" class="pin" maxlength=1 />
<input type="password" name="pin_2" class="pin" maxlength=1 />
<input type="password" name="pin_3" class="pin" maxlength=1 />
<input type="password" name="pin_4" class="pin" maxlength=1 />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="request" value="Request" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php	
}
}
break;
default:
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
/* USER NOT LOGGED */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> 
<!-- [CODE-HELPER: MESSAGE_TOP] -->
<h1 class="message-top"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/guts_of_constr.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
/* USER LOGGED IN */
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Admin Access Control Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<p class="panel-using">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</p>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/sadminium/mainall.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;
}	
}
} else {
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
/* USER NOT LOGGED */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> 
<!-- [CODE-HELPER: MESSAGE_TOP] -->
<h1 class="message-top"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/guts_of_constr.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
/* USER LOGGED IN */
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Admin Access Control Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<p class="panel-using">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</p>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/sadminium/mainall.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
}
?>
</div>
<div id="bottom">
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
}

}
} else if($logged==0) {
/* NOT LOGGED */
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closed_st;?> </div>
<div id="mid">
<?php
if( (isset($_POST['login'])) || ($_GET['page']=="forgotusername") || ($_GET['page']=="forgotpassword") || ($_GET['page']=="request") || ($_GET['page']=="control") || (isset($_POST['logout'])) ){
if((isset($_POST['login'])) || (isset($_POST['logout']))){
if(isset($_POST['login'])){

/* LOGIN ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
Logging in to <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get the $_POST variables
$username=$_POST['username'];
$password=$_POST['password'];
$ip=$_SERVER['REMOTE_ADDR'];

//check for username in db
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_USERNAME)<1){
/* user not there */
$error_console="<b>{$username}</b> does not exist on our server";
} else {
$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
$status=$FETCH_USERNAME['status'];
$suspended_reason=$FETCH_USERNAME['suspended_reason'];

switch($status){
case 'active':
$error_console="";
break;
case 'pending':
$error_console="<b>{$username}</b> is a new user and it currently being reviewed at the moment";
break;
case 'deleted':
$error_console="<b>{$username}</b> does not exist on our server";
break;
case 'suspended':
if($suspended_reason==""){$suspended_reason="you did something wrong. :(";}
$error_console="<b>{$username}</b> has been suspended because <b>{$suspended_reason}</b>";
break;
case 'denied':
$error_console="<b>{$username}</b> does not exist on our server";
break;
}
}

//check the password
$CHECK_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_PASSWORD)<1){
/* not a user */
} else {
$FETCH_PASSWORD=mysql_fetch_array($CHECK_PASSWORD);
$db_upass=$FETCH_PASSWORD['upass'];
if(hash('sha256',md5(sha1($password)))!=$db_upass){
$error_console="The password you entered does not match with what is on file";
} else {
//check if user is logged in
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
if($FETCH_IP['loggedin']=="yes"){/*USER IS LOGGED IN*/$error_console="<b>{$username}</b> is already logged in. If this is your account and you do not think you are logged in: chances are you forgot to log out the last time you were on this site. To log yourself out, please <form action=\"\" method=\"post\"><input type=\"hidden\" name=\"logoutusername\" value=\"".$username."\"><input type=\"submit\" name=\"logout\" value=\"click here\"></form>NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href=\"forgotpassword\" class=\"white\">here</a>";}
}
}



//check for blanks
if($password==""){$error_console="Password is missing";}
if($username==""){$error_console="Username is missing";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
} else {
/* PASSED */
//make logged session id
$lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));

//set session cookie that will expire in 20 years (it's ok)
include("includes/private/attributes/cookie_setter_user.php");

//get dateand time
//0000-00-00 00:00:00
$dateandtime=date("Y-m-d H:i:s");															

//update the db
mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$username'");

echo "<br />You have been successfully logged in!<br />Click <a href=\"".$WEBSITE_URL."\" class=\"white\">here</a> to go to your Admin Panel";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

} else if(isset($_POST['logout'])){

/* LOGOUT ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
<br />
Logging out of <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php			
//get user
$username=$_POST['logoutusername'];

if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
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
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

}

} else {
switch($_GET['page']){										
case 'control':
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){

?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="top-sadminium"><br />
Admin Access</h1>
Use this form to login to the Admin Controls for this Flood Gate. Once logged in, you will be able to change everything about how this flood gate works. <br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="login" value="Login" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
$max_positions=getGlobalVars($properties,'max_admin_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<?php if($num_of_pos_left<1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open...:(</h1>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> position open!</h1>
<?php }else if($num_of_pos_left>1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open!!!</h1>
<?php }?>
<div class="forgot-assets">
<a class="white" href="forgotusername">Forget Username?</a> | <a class="white" href="forgotpassword">Forget Password?</a> |
<?php if($num_of_pos_left<1){?>
<a class="white" style="text-decoration:line-through;cursor:help;" title="There are no positions open so this link is not accessible">Request Access</a>
<?php }else{?>
<a class="white" href="request">Request Access</a>
<?php }?>
</div>
<br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="top-sadminium"><br />
Admin Access</h1>
<br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> YOU ARE CURRENTLY LOGGED IN </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a href="../" class="white">Go home</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php


}
break;
case 'forgotusername':
if( isset($_POST['recover']) || isset($_POST['theanswer']) ){
if(isset($_POST['recover'])){


/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='".$_POST['email']."'");
?>
<h1 class="cbeta-top">
<?php 
if(($_POST['email']=="") || (CHECK_EMAIL($_POST['email'])==false)){
echo "<br /><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_EMAIL)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;".$_POST['email']."&quot;";
} else{
echo "<br />Security Information<br />We found an email matching<br />&quot;".$_POST['email']."&quot;<br />Now answer your Security Question to obtain your username:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$email=$_POST['email'];												

//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($FIND_EMAIL)<1){
/* DID NOT FIND EMAIL */
$error_console="<b>{$email}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_EMAIL_STATS=mysql_fetch_array($FIND_EMAIL);
$sqid=$FETCH_EMAIL_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}

//check for valid email
if(CHECK_EMAIL($email)==false){$error_console="Your Email doesn't look valid";}

//check for blank fields
if($email==""){$error_console="Your Email is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q']))){

/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$email=$_POST['email'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];
$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}

//check to see if pin is blank
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}
} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$email=$_POST['email'];

//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
echo "<br /><br /><br /><br /><br /><br /><h1>Your username is: ".$username."</h1>";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<?php if($error_console==""){?>
<a href="../" class="white">Go Home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

}
} else {

?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

}
break;

case 'forgotpassword':
if( isset($_POST['recover']) || isset($_POST['theanswer']) || (isset($_POST['savenewpassword']))){
if(isset($_POST['recover'])){

/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$_POST['username']."'");
?>
<h1 class="cbeta-top">
<?php 
if($_POST['username']==""){
echo "<br /><br />Forget your password? No problem! Fill out the form with the your username and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_USERNAME)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['username']}&quot;";
} else{
echo "<br />Security Information<br />We found a username matching<br />&quot;".$_POST['username']."&quot;<br />Now answer your Security Question to reset your password:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$username=$_POST['username'];												

//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($FIND_USERNAME)<1){
/* DID NOT FIND USERNAME */
$error_console="<b>{$username}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_USERNAME_STATS=mysql_fetch_array($FIND_USERNAME);
$sqid=$FETCH_USERNAME_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}
			
//check for blank fields
if($username==""){$error_console="Your Username is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q'])) || (isset($_POST['savenewpassword']))){

/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php	
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$username=$_POST['username'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];

$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}

//check to see if pin is blank												
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}

} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$username=$_POST['username'];

//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
//reset password
if(isset($_POST['savenewpassword'])){
//get $_POST data
$username=$_POST['username'];
$newpassword=$_POST['newpassword'];
$cnewpassword=$_POST['cnewpassword'];

//check the last password
$CHECK_LAST_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_LAST_PASSWORD=mysql_fetch_array($CHECK_LAST_PASSWORD);
$upass=$FETCH_LAST_PASSWORD['upass'];
$email=$FETCH_LAST_PASSWORD['email'];
global $fname;
global $lname;
$fname=$FETCH_LAST_PASSWORD['fname'];
$lname=$FETCH_LAST_PASSWORD['lname'];
$gender=$FETCH_LAST_PASSWORD['gender'];
$typeofuser=$FETCH_LAST_PASSWORD['type'];

//make sure they are not blank and other checks
if(sha1($newpassword) == $upass){$error_console="You cannot use the same password. :(";}
if(strlen($newpassword)<6){$error_console="Your password must be at least 6 characters";}
if($cnewpassword!=$newpassword){$error_console="You passwords don't match";}
if($cnewpassword==""){$error_console="You must confirm your password";}
if($newpassword==""){$error_console="Your New Password is missing";}
//make sure they are not blank and other checks
if(hash('sha256',md5(sha1($newpassword))) == $upass){$error_console="You cannot use the same password. :(";}

//check the error_console
if($error_console!=""){
echo "<br /><br /><br /><br /><br />".$error_console;
} else {
//encrypt it
$newpassword=hash('sha256',md5(sha1($newpassword)));

//update database
mysql_query("UPDATE {$properties->DB_PREFIX}users SET upass='$newpassword' WHERE uname='$username'");

echo "<br /><br /><br /><br /><br />Thank you! Your password has successfully been changed. We have also sent you an email to <b>{$email}</b> for your reference.";

//if fname and lname are equal to BETA and BETA, then the user has not specified their fname and lname
if(($fname=="BETA Member") || ($fname=="Admin")){if($gender=="male"){$fname="Mr.";}else if($gender=="female"){$fname="Ms.";}else if($gender=="other"){$fname="whom ever";}}
if($lname==$username){if($gender=="male"){$lname=$uname;;}else if($gender=="female"){$lname=$upass;}else if($gender=="other"){$lname="it may concern";}}

//convert typeofuser
global $typeofuser;
if($typeofuser=="admin"){$typeofuser="Admin";}
if($typeofuser=="beta"){$typeofuser="BETA Member";}

//send an email with login details
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'sadminium_reset_password',$to,$PADINFO,$pname_uri);
}
} else {
?>
Now create your new password <br />
<br />
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>New Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="newpassword" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cnewpassword" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="savenewpassword" value="Save" />
</div>
</div>
</div>
</form>
<?php
}
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<?php if($error_console==""){?>
<a href="../" class="white">Go home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

}
} else {

?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your password? No problem! Fill out the form with your username and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

}
break;

case 'request':
if(isset($_POST['request'])){
/* DO REQUEST PROCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
/* CHECK CONTENT */

//get $_POST data
global $username;
global $password;
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$email=$_POST['email'];
$why=$_POST['why'];

$pin_1=$_POST['pin_1'];
$pin_2=$_POST['pin_2'];
$pin_3=$_POST['pin_3'];
$pin_4=$_POST['pin_4'];

global $full_pin;
$full_pin=$pin_1.$pin_2.$pin_3.$pin_4;

//check the pin for accuracy
if(!is_numeric($full_pin)){$error_console="PIN must be numeric (no letters)";}
if(strlen($full_pin)<4){$error_console="PIN is not long enough; You missed a few numbers";}
if($full_pin==""){$error_console="PIN is missing";}

//check for blanks
if($why==""){$error_console="Why is missing";}
//check email in db
$CHECK_EMAIL_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email' AND status!='denied'");
if(mysql_num_rows($CHECK_EMAIL_IN_DB)<1){/* NOT FOUND; WE'RE GOOD */$email_in_db=false;} else {/* FOUND EMAIL; BAD */$email_in_db=true;}													
if($email_in_db == true){$error_console="<b>".$email."</b> is already in use";}
if(CHECK_EMAIL($email) == false){$error_console="Your Email doesn't look valid";}
if($email==""){$error_console="Your Email is missing";}
if($cpassword==""){$error_console="You must confirm your password";}
if($password==""){$error_console="Your Password is missing";}
if($username==""){$error_console="Your Username is missing";}

//check for passwords match
if($password != $cpassword){$error_console="Your passwords don't match";}

//check password len
if(strlen($password)<6){$error_console="Your password must be at least 6 characters long";}

//check for username avail in db
$GET_USER_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username' AND status!='denied'");
if(mysql_num_rows($GET_USER_IN_DB)<1){
/* username is cleared; not in db */
} else {												
$error_console="{$username} is already taken";
}											

//check to see if there are any errors
if($error_console != ""){
/* THERE ARE ERRORS */
echo "<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />".$error_console."</center>";
echo " <a href=\"javascript:history.go(-1)\" class=\"white\">Go back</a>";
} else {
/* PASSED */
echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Thank you for your interest in wanting to join our Admin team! We will review your application and should be able to get back to you within in 24 to 72 hours. Please be patient as bugging us will prolong the application process. :) <a href=\"../\" class=\"white\">Go Home</a>";
//encrypt the password
$epassword=hash('sha256',md5(sha1($password)));

//get the date and time
$dateandtime_applied=date("Y-m-d H:i:s");

//put user into db
mysql_query("INSERT INTO {$properties->DB_PREFIX}users (fname,lname,uname,upass,email,type,is_searchable,staff_type,status,pin,why,dateandtime_applied) VALUES ('ADMIN','$username','$username','$epassword','$email','admin','yes','','pending','$full_pin','$why','$dateandtime_applied')");

//get user data

//specials for email
global $event_name;
$event_name="Admin Registration";

//get the headwebmaster's title
$GET_HW_TITLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$properties->WEBMASTER_UNAME."'");
$FETCH_HW_TITLE=mysql_fetch_array($GET_HW_TITLE);
$staff_type=$FETCH_HW_TITLE['staff_type'];

//fetch the staff type name
$GET_TITLE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='{$staff_type}'");
$FETCH_TITLE_NAME=mysql_fetch_array($GET_TITLE_NAME);
$webmaster_title=$FETCH_TITLE_NAME['name'];

//send an email with login details
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_admin_registration',$to,$PADINFO,$pname_uri);
//send an email to web admin
//find the head admin or is_webmaster email
$FIND_HAORWM_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE head_admin='yes' AND is_webmaster='yes'");
$FETCH_HAORWM_EMAIL=mysql_fetch_array($FIND_HAORWM_EMAIL);
$HAORWM_EMAIL=$FETCH_HAORWM_EMAIL['email'];
//set to = to HAORWM
$to=$HAORWM_EMAIL;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'towebadmin_beta_admin_registration',$to,$PADINFO,$pname_uri);
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
$max_positions=getGlobalVars($properties,'max_admin_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
if($num_of_pos_left<1){
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 style="font-size:28px;line-height: 1em;"><br />
<br />
<br />
<br />
Well this is embarrassing...</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> Sorry...there are no positions available and the fact that you are here let's us know you are trying to get around the system and that is not going to look good if you want to work for us since we monitor all activity on this website. :) </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top">Want to be an admin? Fill out form.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cpassword" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Why?</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="why" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Create a PIN [<a style="cursor:pointer;" class="white" title="This is for extra security; Plus it is used to recover your username or password if you have not set up a Security Question and Answer">?</a>]</label>
</div>
<div class="formLayoutTableConstructionRowRightCol"> &nbsp;&nbsp;
<input type="password" name="pin_1" class="pin" maxlength=1 />
<input type="password" name="pin_2" class="pin" maxlength=1 />
<input type="password" name="pin_3" class="pin" maxlength=1 />
<input type="password" name="pin_4" class="pin" maxlength=1 />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="request" value="Request" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php	
}
}
break;

default:
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){

/* USER NOT LOGGED */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> 
<!-- [CODE-HELPER: MESSAGE_TOP] -->
<h1 class="message-top"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/guts_of_constr.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

} else {												
/* USER LOGGED IN */
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Admin Access Control Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<p class="panel-using">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</p>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/sadminium/mainall.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

}
break;

}
}
} else {
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){

/* USER NOT LOGGED */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> 
<!-- [CODE-HELPER: MESSAGE_TOP] -->
<h1 class="message-top"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/guts_of_constr.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

} else {

/* USER LOGGED IN */
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Admin Access Control Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<p class="panel-using">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</p>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/sadminium/mainall.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php

}
}
?>
</div>
<div id="bottom">
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
}

/* -------------------------------------------------  END MODE: CLOSED ------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
break;

case 'alpha mode':
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------- MODE: ALPHA MODE ------------------------------------------------- */

if(($_SERVER['REMOTE_ADDR'] == "localhost") || ($_SERVER['REMOTE_ADDR'] == "127.0.0.1"))
{
?>
<div id="topmessage">THIS SITE IS CURRENTLY RUNNING IN ALPHA MODE. ONLY THOSE ON LOCALHOST CAN SEE THIS SITE.</div>
<?php
/* DETECT IF LOGGED IN AND AGREED TO TOU */
@$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'") or die(mysql_error());
if(mysql_num_rows($CHECK_LOGIN)<1){
$logged=0;
} else {
$logged=1;
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$loggedin=$FETCH_LOGIN['loggedin'];
$tou_s=$FETCH_LOGIN['tou_status'];
$in_site=$FETCH_LOGIN['in_site'];
$status=$FETCH_LOGIN['status'];
$suspended_reason=$FETCH_LOGIN['suspended_reason'];
if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
$username=$FETCH_LOGIN['uname'];
$type=$FETCH_LOGIN['type'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];

}
if($logged==1){
/* LOGGED IN */
/* CHECK FOR STATUS */
switch($status){
case 'active':
runAchievementCheck('checkBadgeMessages',$properties,$user_id,$WEBSITE_URL);
?>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
break;

case 'pending':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account is pending (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'deleted':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account does not exist (possible deletion?) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'suspended':
if($suspended_reason==""){$suspended_reason="<b>you did something wrong</b>. :( This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}else{$suspended_reason.="</b>.
This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been suspended because <?php echo $suspended_reason;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'denied':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been denied (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;
}
} else {
/* NOT LOGGED IN */
?>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>
<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
}

} else {
?>
<h1 style="text-align:center;">This website is running in alpha mode and you are not authorized to view this website!</h1>
<?php
}

/* ------------------------------------------------ END MODE: ALPHA MODE ----------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
break;

case 'closed beta':
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------- MODE: CLOSED BETA ------------------------------------------------ */

/* DETECT IF LOGGED IN AND AGREED TO TOU */
@$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
$logged=0;
} else {
$logged=1;
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$loggedin=$FETCH_LOGIN['loggedin'];
$tou_s=$FETCH_LOGIN['tou_status'];
$in_site=$FETCH_LOGIN['in_site'];
$status=$FETCH_LOGIN['status'];
$suspended_reason=$FETCH_LOGIN['suspended_reason'];
if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
$username=$FETCH_LOGIN['uname'];
$type=$FETCH_LOGIN['type'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];

}

if($logged==1){
/* LOGGED IN */
/* CHECK IF GOING TO SITE */
if( ($in_site=="yes") ){
//check to see the user account status
if($status!="active"){
/* SOMETHING WRONG WITH THEIR ACCOUNT STANDING */
switch($status){				
case 'pending':
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closedbeta_st;?> </div>
<div id="mid">
<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Closed BETA Member Access Event Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
$DISPLAY_STATUS_MESSAGE="Your account is new and is still under review. Please be patient.";
if(isset($_POST['logout'])){
	$username=$_POST['username'];
	//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
	include("includes/private/attributes/cookie_destroyer_user.php");

	//update the db
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
	mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
							
	echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
} else {
	echo "<div class=\"action-center-message\">".$DISPLAY_STATUS_MESSAGE."</div>";
	?>
	<form action="" method="post">
		<input type="hidden" name="username" value="<?php echo $username;?>" />
		<input type="submit" name="logout" value="Logout" />
	</form>
	<?php
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
</div>
<div id="bottom"> <br />
<center>
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</center>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
break;

case 'deleted':
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closedbeta_st;?> </div>
<div id="mid">
<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Closed BETA Member Access Event Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php											
echo "<h2>Your account does not exist.</h2>";
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
</div>
<div id="bottom">
<center>
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</center>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
break;

case 'suspended':
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closedbeta_st;?> </div>
<div id="mid">
<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
$suspended_reason=$FETCH_LOGIN['suspended_reason'];
if($suspended_reason==""){$suspended_reason="You did something wrong. :(";}
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Closed BETA Member Access Event Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php											
echo "<h2>Uh oh! Your account has been suspended because <b>{$suspended_reason}</b></h2>";
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
</div>
<div id="bottom">
<center>
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</center>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
break;

case 'denied':
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closedbeta_st;?> </div>
<div id="mid">
<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Closed BETA Member Access Event Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php											
echo "<h2>Uh oh! Your account has been denied.</h2>";
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
</div>
<div id="bottom">
<center>
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</center>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
break;
}
} else {
//check for agree to tou
if($agreed==1){

/* AGREED */
runAchievementCheck('checkBadgeMessages',$properties,$user_id,$WEBSITE_URL);
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>
<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
?>
<?php
} else if($agreed==0){
/* DISAGREED */
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closedbeta_st;?> </div>
<div id="mid">
<?php
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Closed BETA Member Access Event Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php											
if(isset($_POST['set_tou'])){
/* POST ACTION FOR TOU */
//get post elements
$agree_status="unchecked";
$disagree_status="unchecked";
$set_tou=$_POST['tou'];

if($set_tou=="agree"){
/* agreed to tou */
$error_console="";

} else if($set_tou=="disagree") {
/* disagreed to tou */
$error_console="You must agree to the Terms of Use before you go in";
} else {
$error_console="You must respond before you go in";
}

if($error_console!=""){
/* FAILED */
echo $error_console;

} else {
/* PASSED */
//update user
mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
}

} else {
/* TOU BAD */
?>
Before entering this site, you must agree to the <a onclick="window.open('<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE <br />
<br />
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Your response</label>
</div>
<div class="formLayoutTableConstructionRowLeftCol">
<input type="hidden" name="wtd" value="enter_site" />
<input type="radio" name="tou" value="agree" />
I agree
<input type="radio" name="tou" value="disagree" />
I disagree </div>
</div>
<br />
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="set_tou" value="Enter" class="submit" />
</div>
</div>
</div>
</form>
<?php
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
</div>
<div id="bottom">
<center>
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</center>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
}
}
} else {
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closedbeta_st;?> </div>
<div id="mid">
<?php
if( (isset($_POST['login'])) || ($_GET['page']=="forgotusername") || ($_GET['page']=="forgotpassword") || ($_GET['page']=="request") || ($_GET['page']=="control") || (isset($_POST['logout'])) ){
if((isset($_POST['login'])) || (isset($_POST['logout']))){
if(isset($_POST['login'])){
/* LOGIN ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
<br />
Logging in to <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Closed BETA Event!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get the $_POST variables
$username=$_POST['username'];
$password=$_POST['password'];
$ip=$_SERVER['REMOTE_ADDR'];

//check for username in db
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_USERNAME)<1){
/* user not there */
$error_console="<b>{$username}</b> does not exist on our server";
} else {
$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
$status=$FETCH_USERNAME['status'];
$suspended_reason=$FETCH_USERNAME['suspended_reason'];
	
switch($status){
case 'active':
$error_console="";
break;
case 'pending':
$error_console="<b>{$username}</b> is a new user and it currently being reviewed at the moment";
break;
case 'deleted':
$error_console="<b>{$username}</b> does not exist on our server";
break;
case 'suspended':
if($suspended_reason==""){$suspended_reason="you did something wrong. :(";}
$error_console="<b>{$username}</b> has been suspended because <b>{$suspended_reason}</b>";
break;
}	
}

//check the password
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_USERNAME)<1){
/* not a user */
} else {
$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
$db_upass=$FETCH_USERNAME['upass'];
if(hash('sha256',md5(sha1($password)))!=$db_upass){

$error_console="The password you entered does not match with what is on file";
} else {
//logged them in
}
}

//check if user is logged in
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
if($FETCH_IP['loggedin']=="yes"){/*USER IS LOGGED IN*/$error_console="<b>{$username}</b> is already logged in. If this is your account and you do not think you are logged in: chances are you forgot to log out the last time you were on this site. To log yourself out, please <form action=\"\" method=\"post\"><input type=\"hidden\" name=\"logoutusername\" value=\"".$username."\"><input type=\"submit\" name=\"logout\" value=\"click here\"></form>NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href=\"forgotpassword\" class=\"white\">here</a>";}

//check for blanks
if($password==""){$error_console="Password is missing";}
if($username==""){$error_console="Username is missing";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
} else {
/* PASSED */
//make logged session id
$lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));

//set session cookie that will expire in 20 years (it's ok)
include("includes/private/attributes/cookie_setter_user.php");

//get dateand time
//0000-00-00 00:00:00
$dateandtime=date("Y-m-d H:i:s");

//update the db
mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$username'");

echo "<br />You have been successfully logged in!<br />Click <a href=\"".$WEBSITE_URL."\" class=\"white\">here</a> to go to your Event Panel";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if(isset($_POST['logout'])){
/* LOGOUT ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
<br />
Logging out of <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Closed BETA Event!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php			
//get user
$username=$_POST['logoutusername'];

if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
} else {
/* PASSED */												
//update the db

//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
include("includes/private/attributes/cookie_destroyer_user.php");

mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
	
echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}

} else {
switch($_GET['page']){
case 'forgotusername':
if( isset($_POST['recover']) || isset($_POST['theanswer']) ){
if(isset($_POST['recover'])){
/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='".$_POST['email']."'");
?>
<h1 class="cbeta-top">
<?php 
if(($_POST['email']=="") || (CHECK_EMAIL($_POST['email'])==false)){
echo "<br /><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become a BETA member and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_EMAIL)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['email']}&quot;";
} else{
echo "<br />Security Information<br />We found an email matching<br />&quot;".$_POST['email']."&quot;<br />Now answer your Security Question to obtain your username:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$email=$_POST['email'];												

//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($FIND_EMAIL)<1){
/* DID NOT FIND EMAIL */
$error_console="<b>{$email}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_EMAIL_STATS=mysql_fetch_array($FIND_EMAIL);
$sqid=$FETCH_EMAIL_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}

//check for valid email
if(CHECK_EMAIL($email)==false){$error_console="Your Email doesn't look valid";}

//check for blank fields
if($email==""){$error_console="Your Email is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q']))){
/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$email=$_POST['email'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];
$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}

//check to see if pin is blank
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}
} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$email=$_POST['email'];

//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
echo "<br /><br /><br /><br /><br /><br /><h1>Your username is: ".$username."</h1>";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php if($error_console==""){?>
<a href="../" class="white">Go Home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your username? No problem! Fill out the form with the email you used when you registered to become a BETA member and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;

case 'forgotpassword':
if( isset($_POST['recover']) || isset($_POST['theanswer']) || (isset($_POST['savenewpassword']))){
if(isset($_POST['recover'])){
/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$_POST['username']."'");
?>
<h1 class="cbeta-top">
<?php 
if($_POST['username']==""){
echo "<br /><br />Forget your password? No problem! Fill out the form with the your username and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_USERNAME)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['username']}&quot;";
} else{
echo "<br />Security Information<br />We found a username matching<br />&quot;".$_POST['username']."&quot;<br />Now answer your Security Question to reset your password:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$username=$_POST['username'];												

//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($FIND_USERNAME)<1){
/* DID NOT FIND USERNAME */
$error_console="<b>{$username}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_USERNAME_STATS=mysql_fetch_array($FIND_USERNAME);
$sqid=$FETCH_USERNAME_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}
			
//check for blank fields
if($username==""){$error_console="Your Username is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q'])) || (isset($_POST['savenewpassword']))){
/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php	
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$username=$_POST['username'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];
$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}

//check to see if pin is blank												
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}

} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$username=$_POST['username'];

//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
//reset password
if(isset($_POST['savenewpassword'])){
//get $_POST data
$username=$_POST['username'];
$newpassword=$_POST['newpassword'];
$cnewpassword=$_POST['cnewpassword'];

//check the last password
$CHECK_LAST_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_LAST_PASSWORD=mysql_fetch_array($CHECK_LAST_PASSWORD);
$upass=$FETCH_LAST_PASSWORD['upass'];
$email=$FETCH_LAST_PASSWORD['email'];
global $fname;
global $lname;
$fname=$FETCH_LAST_PASSWORD['fname'];
$lname=$FETCH_LAST_PASSWORD['lname'];
$gender=$FETCH_LAST_PASSWORD['gender'];
global $typeofuser;
$typeofuser=$FETCH_LAST_PASSWORD['type'];

//make sure they are not blank and other checks
if(sha1($newpassword) == $upass){$error_console="You cannot use the same password. :(";}
if(strlen($newpassword)<6){$error_console="Your password must be at least 6 characters";}
if($cnewpassword!=$newpassword){$error_console="You passwords don't match";}
if($cnewpassword==""){$error_console="You must confirm your password";}
if($newpassword==""){$error_console="Your New Password is missing";}

//check the error_console
if($error_console!=""){
echo "<br /><br /><br /><br /><br />".$error_console;
} else {
//encrypt it
$newpassword=hash('sha256',md5(sha1($newpassword)));

//update database
mysql_query("UPDATE {$properties->DB_PREFIX}users SET upass='$newpassword' WHERE uname='$username'");

echo "<br /><br /><br /><br /><br />Thank you! Your password has successfully been changed. We have also sent you an email to <b>{$email}</b> for your reference.";

if(($fname=="BETA Member") || ($fname=="Admin")){if($gender=="male"){$fname="Mr.";}else if($gender=="female"){$fname="Ms.";}else if($gender=="other"){$fname="whom ever";}}
if($lname==$username){if($gender=="male"){$lname=$uname;;}else if($gender=="female"){$lname=$upass;}else if($gender=="other"){$lname="it may concern";}}

//convert typeofuser
if($typeofuser=="admin"){$typeofuser="Admin";}
if($typeofuser=="beta"){$typeofuser="BETA Member";}


//send an email with login details
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'sadminium_reset_password',$to,$PADINFO,$pname_uri);
}
} else {
?>
Now create your new password <br />
<br />
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>New Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="newpassword" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cnewpassword" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="savenewpassword" value="Save" />
</div>
</div>
</div>
</form>
<?php
}
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php if($error_console==""){?>
<a href="../" class="white">Go home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your password? No problem! Fill out the form with your username and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;

case 'request':
if(isset($_POST['request'])){
/* DO REQUEST PROCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
/* CHECK CONTENT */

//get $_POST data
global $username;
global $password;
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$email=$_POST['email'];
$why=$_POST['why'];

$pin_1=$_POST['pin_1'];
$pin_2=$_POST['pin_2'];
$pin_3=$_POST['pin_3'];
$pin_4=$_POST['pin_4'];

global $full_pin;
$full_pin=$pin_1.$pin_2.$pin_3.$pin_4;

//check the pin for accuracy
if(!is_numeric($full_pin)){$error_console="PIN must be numeric (no letters)";}
if(strlen($full_pin)<4){$error_console="PIN is not long enough; You missed a few numbers";}
if($full_pin==""){$error_console="PIN is missing";}

//check for blanks
if($why==""){$error_console="Why is missing";}
//check email in db
$CHECK_EMAIL_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email' AND status!='denied'");
if(mysql_num_rows($CHECK_EMAIL_IN_DB)<1){/* NOT FOUND; WE'RE GOOD */$email_in_db=false;} else {/* FOUND EMAIL; BAD */$email_in_db=true;}													
if($email_in_db == true){$error_console="<b>".$email."</b> is already in use";}
if(CHECK_EMAIL($email) == false){$error_console="Your Email doesn't look valid";}
if($email==""){$error_console="Your Email is missing";}
if($cpassword==""){$error_console="You must confirm your password";}
if($password==""){$error_console="Your Password is missing";}
if($username==""){$error_console="Your Username is missing";}

//check for passwords match
if($password != $cpassword){$error_console="Your passwords don't match";}

//check password len
if(strlen($password)<6){$error_console="Your password must be at least 6 characters long";}

//check for username avail in db
$GET_USER_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username' AND status!='denied'");
if(mysql_num_rows($GET_USER_IN_DB)<1){
/* username is cleared; not in db */
} else {												
$error_console="{$username} is already taken";
}											

//check to see if there are any errors
if($error_console != ""){
/* THERE ARE ERRORS */
echo "<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />".$error_console."</center>";
echo " <a href=\"javascript:history.go(-1)\" class=\"white\">Go back</a>";
} else {
/* PASSED */
echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Thank you for your interest in wanting to join our BETA team! We will review your application and should be able to get back to you within in 24 to 72 hours. Please be patient as bugging us will prolong the application process. :) <a href=\"../\" class=\"white\">Go Home</a>";
//encrypt the password
$epassword=hash('sha256',md5(sha1($password)));

//get the date and time
$dateandtime_applied=date("Y-m-d H:i:s");

//put user into db
mysql_query("INSERT INTO {$properties->DB_PREFIX}users (fname,lname,uname,upass,email,type,is_searchable,staff_type,status,pin,why,dateandtime_applied) VALUES ('BETA Member','$username','$username','$epassword','$email','beta','yes','','pending','$full_pin','$why','$dateandtime_applied')");

//get user data

//specials for email
global $event_name;
$event_name="Closed BETA";

//get the headwebmaster's title
$GET_HW_TITLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$properties->WEBMASTER_UNAME."'");
$FETCH_HW_TITLE=mysql_fetch_array($GET_HW_TITLE);
$staff_type=$FETCH_HW_TITLE['staff_type'];

//fetch the staff type name
$GET_TITLE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='{$staff_type}'");
$FETCH_TITLE_NAME=mysql_fetch_array($GET_TITLE_NAME);
$webmaster_title=$FETCH_TITLE_NAME['name'];

//send an email with login details
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_closedbeta_registration',$to,$PADINFO,$pname_uri);
//send an email to web admin
//find the head admin or is_webmaster email
$FIND_HAORWM_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE head_admin='yes' AND is_webmaster='yes'");
$FETCH_HAORWM_EMAIL=mysql_fetch_array($FIND_HAORWM_EMAIL);
$HAORWM_EMAIL=$FETCH_HAORWM_EMAIL['email'];
//set to = to HAORWM
$to=$HAORWM_EMAIL;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'towebadmin_beta_closedbeta_registration',$to,$PADINFO,$pname_uri);
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {

$max_positions=getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'beta' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}

$max_positions=getGlobalVars($properties,'max_admin_positions');
$max_positions=$max_positions+getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}

if($num_of_pos_left<1){
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 style="font-size:28px;line-height: 1em;"><br />
<br />
<br />
<br />
Well this is embarrassing...</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> Sorry...there are no positions available and the fact that you are here let's us know you are trying to get around the system and that is not going to look good if you want to work for us since we monitor all activity on this website. :) </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top">Want BETA Membership? Fill out form.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cpassword" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Why?</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="why" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Create a PIN [<a style="cursor:pointer;" class="white" title="This is for extra security; Plus it is used to recover your username or password if you have not set up a Security Question and Answer">?</a>]</label>
</div>
<div class="formLayoutTableConstructionRowRightCol"> &nbsp;&nbsp;
<input type="password" name="pin_1" class="pin" maxlength=1 />
<input type="password" name="pin_2" class="pin" maxlength=1 />
<input type="password" name="pin_3" class="pin" maxlength=1 />
<input type="password" name="pin_4" class="pin" maxlength=1 />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="request" value="Request" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php	
}
}
break;

default:
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top">I'm sorry but this website is open to a limited number of people. If you are a BETA member please login below to use this site</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="login" value="Login" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
$max_positions=getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type == 'beta' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<br />
<?php if($num_of_pos_left<1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open :(</h1>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> position open!</h1>
<?php }else if($num_of_pos_left>1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open!!!</h1>
<?php }?>
<?php
$max_positions=getGlobalVars($properties,'max_admin_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<?php if($num_of_pos_left<1){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin positions open :(</p>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin position open!</p>
<?php }else if($num_of_pos_left>1){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin positions open!!!</p>
<?php }?>
<a class="white" href="forgotusername">Forget Username?</a> | <a class="white" href="forgotpassword">Forget Password?</a> | <a class="white" href="request">Request Access</a> <br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
break;
}
}
} else {
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
/* USER NOT LOGGED */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> 
<!-- [CODE-HELPER: CLOSED_BETA_TOP_MESSAGE -->
<h1 class="cbeta-top">I'm sorry but this website is open to a limited number of people. If you are a BETA member please login below to use this site</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="login" value="Login" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
$max_positions=getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'beta' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<br />
<?php if($num_of_pos_left<1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open :(</h1>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> position open!</h1>
<?php }else if($num_of_pos_left>1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open!!!</h1>
<?php }?>
<?php
$max_positions=getGlobalVars($properties,'max_admin_positions');
$max_positions=$max_positions+getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<?php if($num_of_pos_left<1){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin positions open :(</p>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin position open!</p>
<?php }else if($num_of_pos_left>1){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin positions open!!!</p>
<?php }?>
<div class="forgot-assets">
<a class="white" href="forgotusername">Forget Username?</a> | <a class="white" href="forgotpassword">Forget Password?</a> |
<?php if($num_of_pos_left<1){?>
<a class="white" style="text-decoration:line-through;cursor:help;" title="There are no positions open so this link is not accessible">Request Access</a>
<?php }else{?>
<a class="white" href="request">Request Access</a>
<?php }?>
</div>
<br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
/* USER LOGGED IN */
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Closed BETA Member Access Event Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<p class="panel-using">Using this panel gives you full access to this site to be able to test it out</p>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/sadminium/mainall.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
}
?>
</div>
<div id="bottom">
<center>
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</center>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
}
} else if($logged==0) {
/* NOT LOGGED */
?>
<div id="splash-container3">
<div id="splash-container2">
<div id="splash-container1">
<div id="splash-col1"> </div>
<div id="splash-col2">
<div id="top"> <?php echo $globalvars_passpage_title;?> <?php echo $globalvars_passpage_slogan;?> <?php echo $globalvars_passpage_closedbeta_st;?> </div>
<div id="mid">
<?php
if( (isset($_POST['login'])) || ($_GET['page']=="forgotusername") || ($_GET['page']=="forgotpassword") || ($_GET['page']=="request") || ($_GET['page']=="control") || (isset($_POST['logout'])) ){
if((isset($_POST['login'])) || (isset($_POST['logout']))){
if(isset($_POST['login'])){
/* LOGIN ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
<br />
Logging in to <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Closed BETA Event!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get the $_POST variables
$username=$_POST['username'];
$password=$_POST['password'];
$ip=$_SERVER['REMOTE_ADDR'];

//check for username in db
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_USERNAME)<1){
/* user not there */
$error_console="<b>{$username}</b> does not exist on our server";
} else {
$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
$status=$FETCH_USERNAME['status'];
$suspended_reason=$FETCH_USERNAME['suspended_reason'];

switch($status){
case 'active':
$error_console="";
break;
case 'pending':
$error_console="<b>{$username}</b> is a new user and it currently being reviewed at the moment";
break;
case 'deleted':
$error_console="<b>{$username}</b> does not exist on our server";
break;
case 'suspended':
if($suspended_reason==""){$suspended_reason="you did something wrong. :(";}
$error_console="<b>{$username}</b> has been suspended because <b>{$suspended_reason}</b>";
break;
case 'denied':
$error_console="<b>{$username}</b> does not exist on our server";
break;
}	
}

//check the password
$CHECK_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($CHECK_PASSWORD)<1){
/* not a user */
} else {
$FETCH_PASSWORD=mysql_fetch_array($CHECK_PASSWORD);
$dbupass=$FETCH_PASSWORD['upass'];
if(hash('sha256',md5(sha1($password)))!=$dbupass){

$error_console="The password you entered does not match with what is on file";
} else {
//check if user is logged in
$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
if($FETCH_IP['loggedin']=="yes"){/*USER IS LOGGED IN*/$error_console="<b>{$username}</b> is already logged in. If this is your account and you do not think you are logged in: chances are you forgot to log out the last time you were on this site. To log yourself out, please <form action=\"\" method=\"post\"><input type=\"hidden\" name=\"logoutusername\" value=\"".$username."\"><input type=\"submit\" name=\"logout\" value=\"click here\"></form>NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href=\"forgotpassword\" class=\"white\">here</a>";}
}
}

//check for blanks
if($password==""){$error_console="Password is missing";}
if($username==""){$error_console="Username is missing";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
} else {
/* PASSED */
//make logged session id
$lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));

//set session cookie that will expire in 20 years (it's ok)
include("includes/private/attributes/cookie_setter_user.php");

//get dateand time
//0000-00-00 00:00:00
$dateandtime=date("Y-m-d H:i:s");

//update the db
mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$username'");

echo "<br />You have been successfully logged in!<br />Click <a href=\"".$WEBSITE_URL."\" class=\"white\">here</a> to go to your Event Panel";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if(isset($_POST['logout'])){
/* LOGOUT ACCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
<br />
<br />
<br />
Logging out of <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Closed BETA Event!</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php			
//get user
$username=$_POST['logoutusername'];

if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}

//check the error console
if($error_console!=""){
/* FAILED */
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
} else {
/* PASSED */												
//update the db

//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
include("includes/private/attributes/cookie_destroyer_user.php");

mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");

echo "<br />You have been successfully logged out!<br /><a href=\"".$WEBSITE_URL."\" class=\"white\">Go home</a>";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}

} else {
switch($_GET['page']){
case 'forgotusername':
if( isset($_POST['recover']) || isset($_POST['theanswer']) ){
if(isset($_POST['recover'])){
/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='".$_POST['email']."'");
?>
<h1 class="cbeta-top">
<?php 
if(($_POST['email']=="") || (CHECK_EMAIL($_POST['email'])==false)){
echo "<br /><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become a BETA member and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_EMAIL)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['email']}&quot;";
} else{
echo "<br />Security Information<br />We found an email matching<br />&quot;".$_POST['email']."&quot;<br />Now answer your Security Question to obtain your username:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$email=$_POST['email'];												

//search for email in db
$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($FIND_EMAIL)<1){
/* DID NOT FIND EMAIL */
$error_console="<b>{$email}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_EMAIL_STATS=mysql_fetch_array($FIND_EMAIL);
$sqid=$FETCH_EMAIL_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="email" value="<?php echo $email;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}

//check for valid email
if(CHECK_EMAIL($email)==false){$error_console="Your Email doesn't look valid";}

//check for blank fields
if($email==""){$error_console="Your Email is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q']))){
/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$email=$_POST['email'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];
$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}

//check to see if pin is blank
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}
} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$email=$_POST['email'];

//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
echo "<br /><br /><br /><br /><br /><br /><h1>Your username is: ".$username."</h1>";
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php if($error_console==""){?>
<a href="../" class="white">Go Home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your username? No problem! Fill out the form with the email you used when you registered to become a BETA member and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;

case 'forgotpassword':
if( isset($_POST['recover']) || isset($_POST['theanswer']) || (isset($_POST['savenewpassword']))){
if(isset($_POST['recover'])){
/* RECOVERY GENERAL */
/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$_POST['username']."'");
?>
<h1 class="cbeta-top">
<?php 
if($_POST['username']==""){
echo "<br /><br />Forget your password? No problem! Fill out the form with the your username and we'll look it up for you.";
} else {
if(mysql_num_rows($FIND_USERNAME)<1){
echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['username']}&quot;";
} else{
echo "<br />Security Information<br />We found a username matching<br />&quot;".$_POST['username']."&quot;<br />Now answer your Security Question to reset your password:";
}
}															
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
//get $_POST data
$username=$_POST['username'];												

//search for email in db
$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($FIND_USERNAME)<1){
/* DID NOT FIND USERNAME */
$error_console="<b>{$username}</b> was not found on our server";
} else {
/* FOUND EMAIL */
$FETCH_USERNAME_STATS=mysql_fetch_array($FIND_USERNAME);
$sqid=$FETCH_USERNAME_STATS['security_question'];
if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}

//check security
?>
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Security Question</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
if(mysql_num_rows($GET_SQS)<1){
/* something went wrong */
} else {
$FETCH_SQS=mysql_fetch_array($GET_SQS);
$sqvalue=$FETCH_SQS['value'];
$is_auto_q=$FETCH_SQS['is_auto_q'];
echo $sqvalue."?";
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<?php
if($is_auto_q == "yes"){
/* SQ NOT ASSIGNED; USED DEFAULT PIN */
?>
<input type="password" name="sapin_1" class="pin" maxlength=1 />
<input type="password" name="sapin_2" class="pin" maxlength=1 />
<input type="password" name="sapin_3" class="pin" maxlength=1 />
<input type="password" name="sapin_4" class="pin" maxlength=1 />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<input type="hidden" name="is_auto_q" value="yes" />
<?php
} else {
?>
<input type="text" name="theanswervalue" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
<?php
}
?>
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" name="theanswer" value="Answer" class="submit" />
</div>
</div>
</div>
</form>
<?php
}
		
//check for blank fields
if($username==""){$error_console="Your Username is missing";}

//check to see if there are any errors
if($error_console != ""){
/* FAILED */
echo "<br /><br />".$error_console;
echo "<br />
<a class=\"white\" href=\"javascript:history.go(-1)\">Back</a>";
} else {
/* PASSED */
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q'])) || (isset($_POST['savenewpassword']))){
/* CHECKING SECURITY */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Security Information
<?php	
//get $_POST variables
$is_auto_q=$_POST['is_auto_q'];

//determine which method: by pin or security question												
if($is_auto_q == "yes") {
//get $_POST variables
$sapin_1=$_POST['sapin_1'];
$sapin_2=$_POST['sapin_2'];
$sapin_3=$_POST['sapin_3'];
$sapin_4=$_POST['sapin_4'];
$username=$_POST['username'];

//make full length pin
$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;

//check for correct pin
$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_PIN)<1){

} else {
$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
$dbpin=$FETCH_USER_PIN['pin'];
$username=$FETCH_USER_PIN['uname'];
if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
}

//check to see if pin is blank												
if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
if($full_pin==""){$error_console="PIN is missing";}

} else {
/* DOING IT BY SQ */

//get $_POST variables
$theanswer=$_POST['theanswervalue'];
$username=$_POST['username'];

//check for correct answer
$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_SA)<1){

} else {
$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
$dbsa=$FETCH_USER_SA['security_answer'];
$username=$FETCH_USER_SA['uname'];
if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
}

}


if($error_console!=""){
?>
<br />
Bad authentication!
<?php	
} else {
?>
<br />
Successfully authenticated!
<?php
}
?>
</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php													
//check error_console
if($error_console!=""){
/*FAILED*/
echo "<br /><br /><br /><br /><br /><br /><br />";
echo $error_console;
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
} else {
/*PASSED*/
//reset password
if(isset($_POST['savenewpassword'])){
//get $_POST data
$username=$_POST['username'];
$newpassword=$_POST['newpassword'];
$cnewpassword=$_POST['cnewpassword'];

//check the last password
$CHECK_LAST_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
$FETCH_LAST_PASSWORD=mysql_fetch_array($CHECK_LAST_PASSWORD);
$upass=$FETCH_LAST_PASSWORD['upass'];
$email=$FETCH_LAST_PASSWORD['email'];
global $fname;
global $lname;
$fname=$FETCH_LAST_PASSWORD['fname'];
$lname=$FETCH_LAST_PASSWORD['lname'];
$gender=$FETCH_LAST_PASSWORD['gender'];
global $typeofuser;
$typeofuser=$FETCH_LAST_PASSWORD['type'];

//make sure they are not blank and other checks
if(sha1($newpassword) == $upass){$error_console="You cannot use the same password. :(";}
if(strlen($newpassword)<6){$error_console="Your password must be at least 6 characters";}
if($cnewpassword!=$newpassword){$error_console="You passwords don't match";}
if($cnewpassword==""){$error_console="You must confirm your password";}
if($newpassword==""){$error_console="Your New Password is missing";}

//check the error_console
if($error_console!=""){
echo "<br /><br /><br /><br /><br />".$error_console;
} else {
//encrypt it
$newpassword=hash('sha256',md5(sha1($newpassword)));

//update database
mysql_query("UPDATE {$properties->DB_PREFIX}users SET upass='$newpassword' WHERE uname='$username'");

echo "<br /><br /><br /><br /><br />Thank you! Your password has successfully been changed. We have also sent you an email to <b>{$email}</b> for your reference.";

if(($fname=="BETA Member") || ($fname=="Admin")){if($gender=="male"){$fname="Mr.";}else if($gender=="female"){$fname="Ms.";}else if($gender=="other"){$fname="whom ever";}}
if($lname==$username){if($gender=="male"){$lname=$uname;;}else if($gender=="female"){$lname=$upass;}else if($gender=="other"){$lname="it may concern";}}

//convert typeofuser
if($typeofuser=="admin"){$typeofuser="Admin";}
if($typeofuser=="beta"){$typeofuser="BETA Member";}

//send an email with login details
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'sadminium_reset_password',$to,$PADINFO,$pname_uri);
}
} else {
?>
Now create your new password <br />
<br />
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>New Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="newpassword" value="" />
<input type="hidden" name="username" value="<?php echo $username;?>" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cnewpassword" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="savenewpassword" value="Save" />
</div>
</div>
</div>
</form>
<?php
}
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php if($error_console==""){?>
<a href="../" class="white">Go home</a>
<?php }else{?>
<a class="white" href="javascript:history.go(-1)">Back</a>
<?php }?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"><br />
Forget your password? No problem! Fill out the form with your username and we'll look it up for you.</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="recover" value="Recover" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
break;

case 'request':
if(isset($_POST['request'])){
/* DO REQUEST PROCESS */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top"></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
/* CHECK CONTENT */

//get $_POST data
global $username;
global $password;
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$email=$_POST['email'];
$why=$_POST['why'];
$typeofrequest=$_POST['typeofrequest'];

$pin_1=$_POST['pin_1'];
$pin_2=$_POST['pin_2'];
$pin_3=$_POST['pin_3'];
$pin_4=$_POST['pin_4'];

if($typeofrequest==""){$error_console="You must choose a type of request";}	

global $full_pin;
$full_pin=$pin_1.$pin_2.$pin_3.$pin_4;

//check the pin for accuracy
if(!is_numeric($full_pin)){$error_console="PIN must be numeric (no letters)";}
if(strlen($full_pin)<4){$error_console="PIN is not long enough; You missed a few numbers";}
if($full_pin==""){$error_console="PIN is missing";}

//check for blanks
if($why==""){$error_console="Why is missing";}
//check email in db
$CHECK_EMAIL_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email' AND status!='denied'");
if(mysql_num_rows($CHECK_EMAIL_IN_DB)<1){/* NOT FOUND; WE'RE GOOD */$email_in_db=false;} else {/* FOUND EMAIL; BAD */$email_in_db=true;}													
if($email_in_db == true){$error_console="<b>".$email."</b> is already in use";}
if(CHECK_EMAIL($email) == false){$error_console="Your Email doesn't look valid";}
if($email==""){$error_console="Your Email is missing";}
if($cpassword==""){$error_console="You must confirm your password";}
if($password==""){$error_console="Your Password is missing";}
if($username==""){$error_console="Your Username is missing";}

//check for passwords match
if($password != $cpassword){$error_console="Your passwords don't match";}

//check password len
if(strlen($password)<6){$error_console="Your password must be at least 6 characters long";}

//check for username avail in db
$GET_USER_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
if(mysql_num_rows($GET_USER_IN_DB)<1){
/* username is cleared; not in db */
} else {												
$error_console="{$username} is already taken";
}

//check to see if there are any errors
if($error_console != ""){
/* THERE ARE ERRORS */
echo "<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />".$error_console."</center>";
echo " <a href=\"javascript:history.go(-1)\" class=\"white\">Go back</a>";
} else {
/* PASSED */
echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Thank you for your interest in wanting to join our BETA team! We will review your application and should be able to get back to you within in 24 to 72 hours. Please be patient as bugging us will prolong the application process. :) <a href=\"../\" class=\"white\">Go Home</a>";
//encrypt the password
$epassword=hash('sha256',md5(sha1($password)));

//get the date and time
$dateandtime_applied=date("Y-m-d H:i:s");

//put user into db
if($typeofrequest=="beta"){
mysql_query("INSERT INTO {$properties->DB_PREFIX}users (fname,lname,uname,upass,email,type,is_searchable,staff_type,status,pin,why,dateandtime_applied) VALUES ('BETA Member','$username','$username','$epassword','$email','$typeofrequest','yes','','pending','$full_pin','$why','$dateandtime_applied')");
} else if($typeofrequest=="admin"){
mysql_query("INSERT INTO {$properties->DB_PREFIX}users (fname,lname,uname,upass,email,type,is_searchable,staff_type,status,pin,why,dateandtime_applied) VALUES ('ADMIN','$username','$username','$epassword','$email','$typeofrequest','yes','','pending','$full_pin','$why','$dateandtime_applied')");	
}

//get user data

//specials for email
global $event_name;
$event_name="Closed BETA";

//get the headwebmaster's title
$GET_HW_TITLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$properties->WEBMASTER_UNAME."'");
$FETCH_HW_TITLE=mysql_fetch_array($GET_HW_TITLE);
$staff_type=$FETCH_HW_TITLE['staff_type'];

//fetch the staff type name
$GET_TITLE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='{$staff_type}'");
$FETCH_TITLE_NAME=mysql_fetch_array($GET_TITLE_NAME);
$webmaster_title=$FETCH_TITLE_NAME['name'];

//send an email with login details
if($typeofrequest=="beta"){
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_closedbeta_registration',$to,$PADINFO,$pname_uri);
//find the head admin or is_webmaster email
$FIND_HAORWM_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE head_admin='yes' AND is_webmaster='yes'");
$FETCH_HAORWM_EMAIL=mysql_fetch_array($FIND_HAORWM_EMAIL);
$HAORWM_EMAIL=$FETCH_HAORWM_EMAIL['email'];
//set to = to HAORWM
$to=$HAORWM_EMAIL;

CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'towebadmin_beta_closedbeta_registration',$to,$PADINFO,$pname_uri);
} else if($typeofrequest=="admin"){
$to=$email;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_admin_registration',$to,$PADINFO,$pname_uri);
//find the head admin or is_webmaster email
$FIND_HAORWM_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE head_admin='yes' AND is_webmaster='yes'");
$FETCH_HAORWM_EMAIL=mysql_fetch_array($FIND_HAORWM_EMAIL);
$HAORWM_EMAIL=$FETCH_HAORWM_EMAIL['email'];
//set to = to HAORWM
$to=$HAORWM_EMAIL;
CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'towebadmin_beta_admin_registration',$to,$PADINFO,$pname_uri);
}
}
?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
$max_positions=getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'beta' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}

$max_positions=getGlobalVars($properties,'max_admin_positions');
$max_positions=$max_positions+getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
if($num_of_pos_left<1){
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 style="font-size:28px;line-height: 1em;"><br />
<br />
<br />
<br />
Well this is embarrassing...</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> Sorry...there are no positions available and the fact that you are here let's us know you are trying to get around the system and that is not going to look good if you want to work for us since we monitor all activity on this website. :) </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top">Want to be an admin or BETA Member?</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Confirm Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="cpassword" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Email</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="email" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Why?</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="why" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Create a PIN [<a style="cursor:pointer;" class="white" title="This is for extra security; Plus it is used to recover your username or password if you have not set up a Security Question and Answer">?</a>]</label>
</div>
<div class="formLayoutTableConstructionRowRightCol"> &nbsp;&nbsp;
<input type="password" name="pin_1" class="pin" maxlength=1 />
<input type="password" name="pin_2" class="pin" maxlength=1 />
<input type="password" name="pin_3" class="pin" maxlength=1 />
<input type="password" name="pin_4" class="pin" maxlength=1 />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> <label>Type</label> </div>
<div class="formLayoutTableConstructionRowRightCol">
<select name="typeofrequest" class="select-small">
<option value="" class="option-small"></option>
<?php
//check to see if any beta or admin positions open
$max_positions=getGlobalVars($properties,'max_admin_positions');
$max_positions=$max_positions+getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}

if($num_of_pos_left<1){/* NO POSITIONS FOR ADMIN*/}else{?>
<option value="admin" class="option-small">Admin</option>
<?php }
$max_positions=getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'beta' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}

if($num_of_pos_left<1){/* NO POSITIONS FOR BETA*/}else{?>
<option value="beta" class="option-small">BETA</option>
<?php }
?>
</select>
<input type="submit" class="submit" name="request" value="Request" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> <br />
<a class="white" href="javascript:history.go(-1)">Back</a> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php	
}
}
break;

default:
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="cbeta-top">I'm sorry but this website is open to a limited number of people. If you are a BETA member please login below to use this site</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<form action="" method="post">
<div id="formLayoutTableConstruction">
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Username</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="text" name="username" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol">
<label>Password</label>
</div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="password" name="password" value="" />
</div>
</div>
<div class="formLayoutTableConstructionRow">
<div class="formLayoutTableConstructionRowLeftCol"> </div>
<div class="formLayoutTableConstructionRowRightCol">
<input type="submit" class="submit" name="login" value="Login" />
</div>
</div>
</div>
</form>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php
$max_positions=getGlobalVars($properties,'max_closed_beta_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'beta' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<?php if($num_of_pos_left<1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open :(</h1>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> position open!</h1>
<?php }else if($num_of_pos_left>1){?>
<h1 class="cbeta-mid">We have <?php echo $num_of_pos_left;?> positions open!!!</h1>
<?php }?>
<?php
$max_positions=getGlobalVars($properties,'max_admin_positions');
//get the number of users
$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
$num_of_users=mysql_num_rows($GET_USERS);
$num_of_pos_left=$max_positions - $num_of_users;
if($num_of_pos_left<0){$num_of_pos_left=0;}
?>
<?php if($num_of_pos_left<1){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin positions open :(</p>
<?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin position open!</p>
<?php }else if($num_of_pos_left>1){?>
<p class="cbeta-mid">We have <?php echo $num_of_pos_left;?> Admin positions open!!!</p>
<?php }?>
<a class="white" href="forgotusername">Forget Username?</a> | <a class="white" href="forgotpassword">Forget Password?</a> | <a class="white" href="request">Request Access</a> <br />
<br />
</div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
break;
}
}
} else {
//get necessary stuff
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");

//check for logged in status
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
/* USER NOT LOGGED */
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> 
<!-- [CODE-HELPER: MESSAGE_TOP] -->
<h1 class="message-top"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/guts_of_constr.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
} else {
/* USER LOGGED IN */
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$fname=$FETCH_LOGIN['fname'];
$username=$FETCH_LOGIN['uname'];
$lname=$FETCH_LOGIN['lname'];
$type=$FETCH_LOGIN['type'];
$tou_status=$FETCH_LOGIN['tou_status'];
?>
<div id="mid-table">
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<h1 class="panel-top">Hello <?php echo $fname." ".$lname;?>!<br />
Welcome to the Closed BETA Member Access Event Panel</h1>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<p class="panel-using">Using this panel gives you full access to this site to be able to test it out</p>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol">
<?php include("includes/private/attributes/sadminium/mainall.php");?>
</div>
<div id="mid-table-rightcol"> </div>
</div>
<div class="mid-table-row">
<div id="mid-table-leftcol"> </div>
<div id="mid-table-midcol"> </div>
<div id="mid-table-rightcol"> </div>
</div>
</div>
<?php
}
}
?>
</div>
<div id="bottom">
<center>
<?php
/* LOAD DYNAMICALLY-UPDATED LINK FILE */
include("includes/private/attributes/splashlinks.php");
?>
</center>
</div>
</div>
<div id="splash-col3"> </div>
</div>
</div>
</div>
<?php
}

/* -----------------------------------------------  END MODE: CLOSED BETA ---------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
break;

case 'open beta':
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------- MODE: OPEN BETA ------------------------------------------------- */
?>
<div id="topmessage">THIS SITE IS CURRENTLY RUNNING AS AN OPEN BETA. IF YOU SEE A BUG, PLEASE REPORT IT <a href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL.$properties->PADMAIN."/report";}else{echo $properties->WEBSITE_REMO_URL.$properties->PADMAIN."/report";}?>">HERE</a>. THANK YOU! MGMNT</div>
<?php
/* DETECT IF LOGGED IN AND AGREED TO TOU */
@$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'") or die(mysql_error());
if(mysql_num_rows($CHECK_LOGIN)<1){
$logged=0;
} else {
$logged=1;
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$loggedin=$FETCH_LOGIN['loggedin'];
$tou_s=$FETCH_LOGIN['tou_status'];
$in_site=$FETCH_LOGIN['in_site'];
$status=$FETCH_LOGIN['status'];
$suspended_reason=$FETCH_LOGIN['suspended_reason'];
if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
$username=$FETCH_LOGIN['uname'];
$type=$FETCH_LOGIN['type'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];
}
if($logged==1){
/* LOGGED IN */
/* CHECK FOR STATUS */
switch($status){
case 'active':
?>
<?php
runAchievementCheck('checkBadgeMessages',$properties,$user_id,$WEBSITE_URL);
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
break;

case 'pending':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account is pending (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'deleted':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account does not exist (possible deletion?) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'suspended':
if($suspended_reason==""){$suspended_reason="<b>you did something wrong</b>. :( This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}else{$suspended_reason.="</b>.
This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been suspended because <?php echo $suspended_reason;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'denied':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been denied (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;
}
} else {
/* NOT LOGGED IN */
?>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>
<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
}

/* ------------------------------------------------- END MODE: OPEN BETA ----------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
break;

case 'open':
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* ------------------------------------------------------ MODE: OPEN --------------------------------------------------- */

/* DETECT IF LOGGED IN AND AGREED TO TOU */
@$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'") or die(mysql_error());
if(mysql_num_rows($CHECK_LOGIN)<1){
$logged=0;
} else {
$logged=1;
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$loggedin=$FETCH_LOGIN['loggedin'];
$tou_s=$FETCH_LOGIN['tou_status'];
$in_site=$FETCH_LOGIN['in_site'];
$status=$FETCH_LOGIN['status'];
$suspended_reason=$FETCH_LOGIN['suspended_reason'];
if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
$username=$FETCH_LOGIN['uname'];
$type=$FETCH_LOGIN['type'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];

}
if($logged==1){
/* LOGGED IN */
/* CHECK FOR STATUS */
switch($status){
case 'active':
?>
<?php
runAchievementCheck('checkBadgeMessages',$properties,$user_id,$WEBSITE_URL);
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
break;

case 'pending':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account is pending (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'deleted':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account does not exist (possible deletion?) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'suspended':
if($suspended_reason==""){$suspended_reason="<b>you did something wrong</b>. :( This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}else{$suspended_reason.="</b>.
This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been suspended because <?php echo $suspended_reason;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'denied':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been denied (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;
}	
} else {
/* NOT LOGGED IN */
?>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>
<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
}

/* ---------------------------------------------------- END MODE: OPEN ------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
break;

case 'maintenance':
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------- MODE: MAINTENANCE ------------------------------------------------ */

?>
<div id="topmessage">THIS WEBSITE IS RUNNING IN MAINTENANCE MODE. BE CAREFUL ON THIS SITE AS THINGS ARE ABOUT TO GET HAIRY. :)</div>
<?php
/* DETECT IF LOGGED IN AND AGREED TO TOU */
@$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'") or die(mysql_error());
if(mysql_num_rows($CHECK_LOGIN)<1){
$logged=0;
} else {
$logged=1;
$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
$loggedin=$FETCH_LOGIN['loggedin'];
$tou_s=$FETCH_LOGIN['tou_status'];
$in_site=$FETCH_LOGIN['in_site'];
$status=$FETCH_LOGIN['status'];
$suspended_reason=$FETCH_LOGIN['suspended_reason'];
if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
$username=$FETCH_LOGIN['uname'];
$type=$FETCH_LOGIN['type'];
$head_admin=$FETCH_LOGIN['head_admin'];
$email=$FETCH_LOGIN['email'];
$user_id=$FETCH_LOGIN['id'];
$gender=$FETCH_LOGIN['gender'];

}
if($logged==1){
/* LOGGED IN */
/* CHECK FOR STATUS */
switch($status){
case 'active':
?>
<?php
runAchievementCheck('checkBadgeMessages',$properties,$user_id,$WEBSITE_URL);
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
break;

case 'pending':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account is pending (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'deleted':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account does not exist (possible deletion?) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'suspended':
if($suspended_reason==""){$suspended_reason="<b>you did something wrong</b>. :( This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}else{$suspended_reason.="</b>.
This means you cannot access your account. Ask us why <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a>";}
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been suspended because <?php echo $suspended_reason;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;

case 'denied':
$helper="We can fix this! Just click <a href=\"".$WEBSITE_URL.$properties->PADMAIN."/report\" class=\"black-url\" style=\"color: black;\">here</a> to query us";
?>
<div id="topmessage-actioncenter" style="display:none">ATTENTION! Your account has been denied (which is weird) so you cannot access it. <?php echo $helper;?>.</div>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>

<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME,$HTDN); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
break;
}	
} else {
/* NOT LOGGED IN */
?>
<?php
/* START OF INSIDE PAGE */
?>
<?php
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation-full">
<div class="wrap">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
</div>
<?php
}
?>
<div class="wrap">
<?php
if(getGlobalVars($properties,"display_admaker") == "yes"){?><div id="admaker-top"><?php include("includes/private/bin/modules/admaker/module.php");?></div><?php } else {/* NO ADMAKER */}
if($properties->TURN_ON_TOP_NAV=="yes"){
?>
<div id="topnavigation">
<div id="topnav">
<?php
if(getGlobalVars($properties,'top_nav_use') == "toolkit"){

include("includes/private/bin/modules/native/toolkit.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){

include("includes/private/bin/modules/native/topnavwithsearch.php");

} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){

include("includes/private/bin/modules/native/topnavwithoutsearch.php");
}
?>
</div>
</div>
<!-- end top navigation -->
<?php
} else if($properties->TURN_ON_TOP_NAV=="no") {
/* NO TOP NAV */	
}
?>
</div>
<div id="container-header">
<div id="header">
<div id="header-row">
<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $WEBSITE_URL;?><?php echo $launchpad;?>/home'">
<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
<div class="big"><?php echo $properties->displayMainTitle();?></div>
<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?>
</div>
<!-- end of #left --> 
</div>
<!-- end of #header-leftcol -->

<div id="header-rightcol">

</div>
</div>
<!-- end of #header-row --> 
</div>
<!-- end of #header --> 
<div id="navigation">
<div id="nav-row">
<?php
/* PHP NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</div>
<!-- end of nav-row --> 
</div>
<!-- end of #navigation --> 
</div>
<?php
include("includes/private/art/top_left.php");
?> 
<?php
include("includes/private/art/top_right.php");
?>
<?php if($logged==1){?><div id="container-already"><?php }else{?><div id="container"><?php }?>
<?php
include("includes/private/bin/modules/native/featureslider.php");
?>

<!-- PLUGIN: WHATIDO START CODE -->
<?php
include("includes/private/bin/plugins/whatido/plugin.php");
?>
<!-- PLUGIN: WHATIDO END CODE -->

<?php getPageContents($launchpadID,$page,$subpage,$WEBSITE_URL,$launchpadPN,$properties,$THEME_NAME); ?>
<!-- end of PAGE CONTENTS --> 

</div>


<!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
<?php
include("includes/private/art/lower_right.php");
?>
<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
<div class="wrap-bottom">
<div id="bottomnav">
<div class="left">
<ul>
<?php
/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
$wurl=$WEBSITE_URL;
//determine launchpad constants
$launchpadNAME=$launchpad;
$launchpadID=GET_LP_ID($properties,$launchpad);
echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
?>
</ul>
</div>
<!-- end of #left --> 
</div>
<!-- end of #bottomnav --> 
</div>
<!-- end of .wrap --> 
</div>
<!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
/* LEAVE BOTTOM NAV OFF */
}
?>
<?php
include("includes/private/bin/modules/native/footer.php");
/* END OF INSIDE PAGE */
}

/* ----------------------------------------------- END MODE: MAINTENANCE ----------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------- */
break;
}
?>
<!-- END MODE DETERMINATION -->