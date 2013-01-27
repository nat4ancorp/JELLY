<?php
/* WEB INTERFACE TO LEARN & TO LOVE (WITLL) CORE SYSTEM */
/* WITLL WAS DEVELOPED AND DEBUGGED BY NATHAN SMYTH AND IS AVAILABLE TO BE USED AS A FREEWARE */
/* SOFTWARE BY ANYONE WHO CAN DECYFER THE CODE. HA JK. ALL YOU NEED TO DO IS RUN THE INSTALL  */
/* AND USE IT JUST LIKE YOU WOULD WORDPRESS                                                   */

/* PLEASE LEAVE THIS COPYRIGHT OWNERSHIP INFO INTACT AS YOU USE THIS PIECE OF WEB SOFTWARE    */
/* YOU CAN ALWAYS GET PLUGINS, THEMES, AND MODULES FROM WITLL.NET!!!                          */

/* ---------------------------- END OWNERSHIP INFO ------------------------------------------ */
ob_start(); //Initiate the output buffer
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
//load global vars from another php file (props.php)
include 'conf/props.php';
require 'includes/private/tools/converter.php';

$properties=new properties();
@$page="";
@$page=$_GET['page'];
@$subpage=$_GET['subpage'];
@$launchpad=$_GET['launchpad'];
@$launchpadPN="";
if($launchpad==$properties->PADMAIN){$launchpadPN="padmain";}
if($launchpad==$properties->PAD1){$launchpadPN="pad1";}
if($launchpad==$properties->PAD2){$launchpadPN="pad2";}
if($launchpad==$properties->PAD3){$launchpadPN="pad3";}
if($launchpad==$properties->PAD4){$launchpadPN="pad4";}
@$launchpadID=GET_LP_ID($properties,$launchpad);
include 'conf/connect.php';
$GETFULLWURL=$properties->getFULLWURL();
tempSystem($properties,'_INIT','');
//checks for newly installed themes
Theme($properties,"checkNewlyInstalled",$ip,$SESSIONID);
$lpToggle=tempSystem($properties,'lpToggle','');
$properties->setServerTime();
$ip=$_SERVER['REMOTE_ADDR'];
$SESSIONID=tempSystem($properties,"getSESSION","");
require("includes/private/attributes/logged_session.php");
/* TO BE USED FOR INIT LOGGED - NOT THE SAME AS WHAT IS IN MODE.PHP */
/* DETECT IF LOGGED IN AND AGREED TO TOU */
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");if(mysql_num_rows($CHECK_LOGIN)<1){$logged=0;}else{$logged=1;}
?>
<title><?php echo $properties->displayWName();?> - <?php echo $properties->WEBSITE_SLOGAN;?><?php echo getPageName($launchpadPN,$page,$properties);?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mainall/main.css" />
<?php if(@$launchpadPN=="pad1"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mainall/pad1.css" />
<?php }if(@$launchpadPN=="pad2"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mainall/pad2.css" />
<?php }if(@$launchpadPN=="pad3"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mainall/pad3.css" />
<?php }if(@$launchpadPN=="pad4"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mainall/pad4.css" />
<?php }if (!isset($_GET['launchpad']) && ($_GET['launchpad'] != "projects") ){printf("<script type=\"text/javascript\">location.href='".$properties->WEBSITE_URL."".$properties->PADMAIN."/home'</script>");}?>

<link rel="home" title="<?php echo $properties->displayWName();?> home page" href="<?php echo $properties->WEBSITE_URL;?>" />
<link rel="contents" title="Site map" href="<?php echo $properties->WEBSITE_URL;?>sitemap" />
<meta name="description" content="<?php echo $properties->SITE_DESCRIPTION;?>" />
<link rel="help" title="Accessibility statement" href="/accessibility" />
<meta name="keywords" content="<?php echo getPageKeywords($launchpadPN,$page,$properties);?>" />
<meta name="author" content="<?php echo $properties->SITE_AUTHOR;?>" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mainall/main_ie6.css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mainall/main_ie7.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/ajax/all.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/general.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/c_config.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/c_smartmenus.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/tweet/jquery.tweet.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/cycle/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jflickrfeed.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery-ui-min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery.bpopup-0.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery.orbit.min.js"></script>

<link rel="shortcut icon" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/favicon.ico">

<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/modes.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/colorbox/colorbox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/jc/tango/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/jc/alpha/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/jc/macho/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/jc/ionius/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/jquery.countdown.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/datepick/jquery.datepick.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/orbit.css" />
</head>

<body>
	<script type="text/javascript">
	$(window).load(function() {    	
		var theWindow        = $(window),
			$bg              = $("#bg"),
			aspectRatio      = $bg.width() / $bg.height();
									
		function resizeBg() {
			
			if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
				$bg
					.removeClass()
					.addClass('bgheight');
			} else {
				$bg
					.removeClass()
					.addClass('bgwidth');
			}
						
		}
									
		theWindow.resize(resizeBg).trigger("resize");
	
	});
	</script>
	<!--<img src="<?php //echo $properties->WEBSITE_URL;?>styles/<?php //echo $properties->STYLESHEET;?>/images/bg.jpg" id="bg" alt="" />-->
	<?php
	//include a mobile detection script
	include("includes/private/tools/detectmobile.php");

	if(@$is_mobile=="yes"){
		?>
        <script type="text/javascript">
		<!--
		window.location = "http://www.nat4an.com/mobile"
		//-->
		</script>
        <?php
	} else {
		//check for INSTALLATION LOCK
		if(file_exists("INSTALL.LOCK")){$FILE_LOCK="yes";}else{$FILE_LOCK="no";}
		
		if($FILE_LOCK=="yes"){
			/* INSTALLATION HAS BEEN DONE AND THE INSTALL DIRECTORY HAS BEEN LOCKED */
			/* determine the mode the site is running in */
			$MODE=getGlobalVars($properties,'mode');			
			include("includes/private/tools/mode.php");
			if(($MODE=="closed") || ($MODE=="closed beta")){
				/* MODE requires login before seeing site */
				if(($logged==1) && ($in_site=="yes")){
					
					/* CHECK TO SEE IF THE IP (AND SESSION COOKIE) LIKE FB PAGE  */
					$ip=tempSystem($properties,"getIP","");
					$SESSIONID=tempSystem($properties,"getSESSION","");
					if($logged==1){
						/* LOGGED IN; USERS */
						$CHECK_FB_LIKE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='".$ip."' AND logged_session='".$logged_session."'");
						$FETCH_FB_LIKE=mysql_fetch_array($CHECK_FB_LIKE);
						$FB_LIKE=$FETCH_FB_LIKE['fb_like'];
						if($FB_LIKE=="yes"){
							/* LIKED IT; DONT DISPLAY */					
						} else {
							/* DIDN'T LIKE IT YET; DISPLAY */
							if($_SERVER['HTTP_HOST']=="localhost"){
								include("includes/private/bin/fb_popup.php");
							} else {
								/* SHOW POPUP */
								include("includes/private/bin/fb_popup.php");
							}
						}
					} else {
						/* NOT LOGGED IN; TEMPSYSTEM */
						$CHECK_FB_LIKE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip='".$ip."' AND temp_session='".$SESSIONID."'");
						$FETCH_FB_LIKE=mysql_fetch_array($CHECK_FB_LIKE);
						$FB_LIKE=$FETCH_FB_LIKE['fb_like'];
						if($FB_LIKE=="yes"){
							/* LIKED IT; DONT DISPLAY */					
						} else {
							/* DIDN'T LIKE IT YET; DISPLAY */
							if($_SERVER['HTTP_HOST']=="localhost"){
								include("includes/private/bin/fb_popup.php");
							} else {
								/* SHOW POPUP */
								include("includes/private/bin/fb_popup.php");
							}
						}
					}
				} else {
					/* NOT LOGGED OR IN SITE */					
				}
			} else {
				/* MODE is in position that requires no prior access (Open beta, Open, Maintainance) */
				if($_SERVER['HTTP_HOST']=="localhost"){
					
				} else {
					/* SHOW POPUP */
					include("includes/private/bin/fb_popup.php");
				}
			}
		} else {
			echo "<center><h1 style=\"line-height: 1.2em;\">Please run the installation by going to <a href=\"".$properties->WEBSITE_URL."INSTALL/\" class=\"black-url\">INSTALL/</a> or rename the &quot;INSTALL&quot; directory to &quot;INSTALL.LOCK&quot; (if you have already ran the installation and the INSTALL directory did not get auto-magically changed to &quot;INSTALL.LOCK&quot;</h1></center>";
		}	
	}
	?>
</body>
</html>