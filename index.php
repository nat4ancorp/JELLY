<?php
/* WEB INTERFACE TO LEARN & TO LOVE (WITLL) CORE SYSTEM */
/* WITLL WAS DEVELOPED AND DEBUGGED BY NATHAN SMYTH AND IS AVAILABLE TO BE USED AS A FREEWARE */
/* SOFTWARE BY ANYONE WHO CAN DECYFER THE CODE. HA JK. ALL YOU NEED TO DO IS RUN THE INSTALL  */
/* AND USE IT JUST LIKE YOU WOULD WORDPRESS                                                   */

/* PLEASE LEAVE THIS COPYRIGHT OWNERSHIP INFO INTACT AS YOU USE THIS PIECE OF WEB SOFTWARE    */
/* YOU CAN ALWAYS GET PLUGINS, THEMES, AND MODULES FROM WITLL.NET!!!                          */

/* ---------------------------- END OWNERSHIP INFO ------------------------------------------ */
session_start(); //start this for use with captcha
ob_start(); //Initiate the output buffer
error_reporting(0); //turn off errors
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
/* LOAD IN YOUR INCLUDES THAT ARE IMPORTANT */
include 'conf/props.php';

$properties=new properties();

/* INCLUDES/REQUIRES THAT NEED PROPERTIES IN ORDER TO FUNCTION */
include 'conf/connect.php';
require 'includes/private/tools/converter.php';

/* GET SOME BARE ESSENTIAL GETS, POSTS, SERVERS, ETC */
@$page="";
@$page=$_GET['page'];
@$subpage=$_GET['subpage'];
@$launchpad=$_GET['launchpad'];
$ip=$_SERVER['REMOTE_ADDR'];

/* DEFINE CRITICAL VARIABLES */
@$launchpadPN="";

/* DEFINE VARIABLES FROM FUNCTIONS */
@$launchpadID=GET_LP_ID($properties,$launchpad);
@$GETFULLWURL=$WEBSITE_URL;
@$lpToggle=tempSystem($properties,'lpToggle','');
@$SESSIONID=tempSystem($properties,"getSESSION","");

/* CONDITIONAL VARIABLES */
if($launchpad==$properties->PADMAIN){$launchpadPN="padmain";}
if($launchpad==$properties->PAD1){$launchpadPN="pad1";}
if($launchpad==$properties->PAD2){$launchpadPN="pad2";}
if($launchpad==$properties->PAD3){$launchpadPN="pad3";}
if($launchpad==$properties->PAD4){$launchpadPN="pad4";}

/* DO SOME MUCH NEED FUNCTIONS */
tempSystem($properties,'_INIT','');
Theme($properties,"checkNewlyInstalled",$ip,$SESSIONID);
$properties->setServerTime();

/* REQUIRES/INCLUDES THAT REQUIRE A FUNCTION TO PERFORM FIRST */
require 'includes/private/attributes/logged_session.php';

/* DETERMINE THE WEBSITE_URL */
if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}

/* DETECT IF LOGGED IN AND AGREED TO TOU */
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");if(mysql_num_rows($CHECK_LOGIN)<1){$logged=0;}else{$logged=1;}

/* THEME CHANGING IN ASSETS SETUP */
$THEME_ASSETS_STRING=$properties->PATH_TO_THEME_ASSETS;
if($logged==1){$REPLACEMENT_THE_ACTION="getCurrThemeNameUser";}else if($logged==0){$REPLACEMENT_THE_ACTION="getCurrThemeNameTemp";}

/* BUILDING THE THEME NAME BASED ON SESSIONID */
//search temp for cookie session
$SEARCH_FOR_LOGGED_SESSION=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip='".$ip."' AND temp_session='".$logged_session."'");
if(mysql_num_rows($SEARCH_FOR_LOGGED_SESSION)<1){$SESSION_IN_DB_MATCH=0;}else{$SESSION_IN_DB_MATCH=1;}
if($SESSIONID=="" || $SESSION_IN_DB_MATCH==0){
	/* FIRST INIT; WAITING FOR REFRESH; DISPLAY DEFAULT THEME */
	$defaultThemeID=Theme($properties,"getDefaultThemeID","","");
	//look for theme name
	$GET_THEME_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE id='".$defaultThemeID."'") or die(mysql_error());
	if(mysql_num_rows($GET_THEME_NAME)<1){
		/* SOMETHING WENT WRONG; NO THEMES */	
		@$THEME_NAME="themes/".$properties->DB_PREFIX."/exempt/";
	} else {
		while($FETCH_THEME_NAME=mysql_fetch_array($GET_THEME_NAME)){
			@$THEME_NAME="themes/".$FETCH_THEME_NAME['name']."/exempt/";
		}
	}
} else {
	@$THEME_NAME="themes/".str_replace("(THEME_NAME)",Theme($properties,$REPLACEMENT_THE_ACTION,$ip,$SESSIONID),$THEME_ASSETS_STRING)."/exempt/";
}
?>
<title><?php echo $properties->WEBSITE_NAME?> - <?php echo getSlogan($properties,$launchpadPN);?><?php echo getPageName($launchpadPN,$page,$properties);?></title>

<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>mainall/main.css" media="screen" >
<?php if(@$launchpadPN=="pad1"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>mainall/pad1.css" >
<?php }if(@$launchpadPN=="pad2"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>mainall/pad2.css" >
<?php }if(@$launchpadPN=="pad3"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>mainall/pad3.css" >
<?php }if(@$launchpadPN=="pad4"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo $THEME_NAME;?>mainall/pad4.css" >
<?php }if (!isset($_GET['launchpad']) && ($_GET['launchpad'] != "projects") ){if($_SERVER['HTTP_HOST']=="localhost"){printf("<script type=\"text/javascript\">location.href='".$properties->WEBSITE_TEST_URL."".$properties->PADMAIN."/home'</script>");}else{printf("<script type=\"text/javascript\">location.href='".$properties->WEBSITE_REMO_URL."".$properties->PADMAIN."/home'</script>");}}?>

<link rel="home" title="<?php echo $properties->WEBSITE_NAME;?> home page" href="<?php echo $WEBSITE_URL;?>" >
<link rel="contents" title="Site map" href="<?php echo $WEBSITE_URL;?>sitemap" >
<meta name="description" content="<?php echo $properties->SITE_DESCRIPTION;?>" >
<link rel="help" title="Accessibility statement" href="/accessibility" >
<meta name="keywords" content="<?php echo getPageKeywords($launchpadPN,$page,$properties);?>" >
<meta name="author" content="<?php echo $properties->SITE_AUTHOR;?>" >
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >

<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>mainall/main_ie6.css" >
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>mainall/main_ie7.css" >
<![endif]-->

<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/general.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/c_config.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/c_smartmenus.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/tweet/jquery.tweet.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/cycle/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jflickrfeed.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery-ui-min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery.bpopup-0.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/jquery.orbit.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/backstretch.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL;?>includes/private/js/hover.transitions.js"></script>

<script type="text/javascript">
$(function(){	
	$(window).scroll(function(){
		if($(this).scrollTop() != 0){
			$('#toTop').fadeIn();
			//$('input#search').fadeOut();
		} else {
			$('#toTop').fadeOut();
			//$('input#search').fadeIn();
		}		
	});
	
	$('#toTop').click(function(){
		$('body,html').animate({scrollTop:0},800);
	});
	$('#searchToggle').click(function(){
		$('input#search').fadeOut();
	});
});
</script>

<link rel="shortcut icon" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>images/favicon.ico" >

<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>mode/modes.css" >
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>jquery/colorbox/colorbox.css" >
<?php
$GET_JC_SKINS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}jc_themes WHERE status='active'");
if(mysql_num_rows($GET_JC_SKINS)<1){
/* NONE */	
} else {
	while($FETCH_JC_SKINS=mysql_fetch_array($GET_JC_SKINS)){
		?>
        <link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL.@$THEME_NAME;?>jquery/jc/<?php echo $FETCH_JC_SKINS['name'];?>/skin.css" >
        <?php
	}
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>jquery/jquery-ui.css" >
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>jquery/jquery.countdown.css" >
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>jquery/datepick/jquery.datepick.css" >
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>jquery/orbit/orbit.css" >
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>jquery/sparkles.css" >
</head>

<body>
	<script type="text/javascript">
	<?php
	//MAKE IT READ THE FOLDER STRUCTURE
	if(getGlobalVars($properties,'tm_cbc')=="on"){
		/* THEMES CAN BE CHANGED; DO BASED OFF OF USER OR TEMP */
		if($logged==1){
			/* LOGGED IN */
			$currthemeid=Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);	
			//get the default themeid and work with that
			$GET_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE name='".$currthemeid."'");
		}else if($logged==0){
			/* NOT LOGGED IN */
			$currthemeid=Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);
			//get the default themeid and work with that
			$GET_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE name='".$currthemeid."'");
		}
	} else {
		/* THEME CHANGING IS LOCKED DOWN; D0 BASED ON DEFAULT */
		$currthemeid=Theme($properties,"getDefaultThemeID",$ip,$SESSIONID);
		//get the default themeid and work with that
		$GET_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE id='".$currthemeid."'");
	}
	
	while($FETCH_THEME=mysql_fetch_array($GET_THEME)){
		$CURRTHEME=$FETCH_THEME['name'];
	}	
	$directories=array_diff(scandir(@$THEME_NAME."images/walls/".getGlobalVars($properties,'walls_pack_name')."/"),array('.', '..','.DS_STORE')); // this specifies what to get and what not to get
	foreach($directories as $directory){
		$wall.=$directory.",";
	}
	
	//$wall=getGlobalVars($properties,'walls_list');
	$wall_list=explode(",",$wall);
	$START=rand(0,count($wall_list)-1);
	for($i=$START; $i<count($wall_list)-1; $i++){
		if($i==count($wall_list)){/*$new_wall_list.="\"".$wall_list[$i]."\"";*/}else{$new_wall_list.="\"".$wall_list[$i]."\",";}
	}
	$LEFTOVER=(0-$START) * -1;
	for($ii=0; $ii<$LEFTOVER; $ii++){
		$new_wall_list.="\"".$wall_list[$ii]."\",";
	}
	$new_wall_list=explode(",",$new_wall_list);
	$new_wall_list=str_replace("\"","",$new_wall_list);
	$THESwitch=getGlobalVars($properties,'walls_toggle');
	$randomizeSwitch=getGlobalVars($properties,'walls_randomize');
	
	if($THESwitch=="on"){
		if($randomizeSwitch=="yes"){
			/* RANDOMIZE!!! */
			$START=0;
			$END=count($new_wall_list)-1;
			?>
			$.backstretch([
				<?php for($i=$START; $i<$END; $i++){?>
				<?php if($i==0){?>
					"<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>images/walls/<?php echo getGlobalVars($properties,'walls_pack_name');?>/<?php echo $new_wall_list[$i];?>/bg.png"
				<?php } else {?>
					, "<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>images/walls/<?php echo getGlobalVars($properties,'walls_pack_name');?>/<?php echo $new_wall_list[$i];?>/bg.png"
				<?php }?>
				
				<?php }?>
			], {duration: <?php echo getGlobalVars($properties,'walls_duration');?>, fade: <?php echo getGlobalVars($properties,'walls_fade');?>});
			<?php
		} else {
			/* DO IN ORDER */
			$START=0;
			$END=count($wall_list)-1;
			?>
			$.backstretch([
				<?php for($i=$START; $i<$END; $i++){?>
				<?php if($i==0){?>
					"<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>images/walls/<?php echo getGlobalVars($properties,'walls_pack_name');?>/<?php echo $wall_list[$i];?>/bg.png"
				<?php } else {?>
					, "<?php echo $WEBSITE_URL;?><?php echo @$THEME_NAME;?>images/walls/<?php echo getGlobalVars($properties,'walls_pack_name');?>/<?php echo $wall_list[$i];?>/bg.png"
				<?php }?>
				
				<?php }?>
			], {duration: <?php echo getGlobalVars($properties,'walls_duration');?>, fade: <?php echo getGlobalVars($properties,'walls_fade');?>});
			<?php
		}
	} else if($THESwitch=="off") {
		/* TURNED OFF */
	}
	?>		
	</script>
    <?php
	//check for INSTALLATION LOCK
	if(file_exists("INSTALL.LOCK")){$FILE_LOCK="yes";}else{$FILE_LOCK="no";}
	
	if($FILE_LOCK=="yes"){
		/* INSTALLATION HAS BEEN DONE AND THE INSTALL DIRECTORY HAS BEEN LOCKED */
		/* determine the mode the site is running in */
		$MODE=getGlobalVars($properties,'mode');			
		include("includes/private/attributes/mode.php");			
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
							include("includes/private/attributes/fb_popup.php");
						} else {
							/* SHOW POPUP */
							include("includes/private/attributes/fb_popup.php");
						}
					}
				} else {
					/* NOT LOGGED IN; TEMPSYSTEM */
					$CHECK_FB_LIKE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip='".$ip."' AND temp_session='".$SESSIONID."'") or die(mysql_error());
					$FETCH_FB_LIKE=mysql_fetch_array($CHECK_FB_LIKE);
					$FB_LIKE=$FETCH_FB_LIKE['fb_like'];
					if($FB_LIKE=="yes"){
						/* LIKED IT; DONT DISPLAY */					
					} else {
						/* DIDN'T LIKE IT YET; DISPLAY */
						if($_SERVER['HTTP_HOST']=="localhost"){
							include("includes/private/attributes/fb_popup.php");
						} else {
							/* SHOW POPUP */
							include("includes/private/attributes/fb_popup.php");
						}
					}
				}
			} else {
				/* NOT LOGGED OR IN SITE */					
			}
		} else {
			/* MODE is in position that requires no prior access (Open beta, Open, Maintainance) */
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
						include("includes/private/attributes/fb_popup.php");
					} else {
						/* SHOW POPUP */
						include("includes/private/attributes/fb_popup.php");
					}
				}
			} else {
				/* NOT LOGGED IN; TEMPSYSTEM */
				$CHECK_FB_LIKE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip='".$ip."' AND temp_session='".$SESSIONID."'") or die(mysql_error());
				$FETCH_FB_LIKE=mysql_fetch_array($CHECK_FB_LIKE);
				$FB_LIKE=$FETCH_FB_LIKE['fb_like'];
				if($FB_LIKE=="yes"){
					/* LIKED IT; DONT DISPLAY */					
				} else {
					/* DIDN'T LIKE IT YET; DISPLAY */
					if($_SERVER['HTTP_HOST']=="localhost"){
						include("includes/private/attributes/fb_popup.php");
					} else {
						/* SHOW POPUP */
						include("includes/private/attributes/fb_popup.php");
					}
				}
			}
		}
	} else {
		echo "<center><h1 style=\"line-height: 1.2em;\">Please run the installation by going to <a href=\"".$WEBSITE_URL."INSTALL/\" class=\"black-url\">INSTALL/</a> or rename the &quot;INSTALL&quot; directory to &quot;INSTALL.LOCK&quot; (if you have already ran the installation and the INSTALL directory did not get auto-magically changed to &quot;INSTALL.LOCK&quot;</h1></center>";
	}	
	?>
<script type="text/javascript">
$(document).ready(function(e) {
    $('#topmessage-actioncenter').delay(1000).slideDown('fast', function() {
		//done	
	});
});
</script>
</body>
</html>