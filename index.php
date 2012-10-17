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
//include "styles/".$properties->STYLESHEET."/c-css.php"; /*SEEMS TO CAUSE HAVOC ON LOCAL SERVER; UNCOMMENT ON UPLOAD*/
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
$lpToggle=tempSystem($properties,'lpToggle','');
$properties->setServerTime();
?>
<title><?php echo $properties->displayWName();?> - <?php echo $properties->WEBSITE_SLOGAN;?><?php echo getPageName($launchpadPN,$page,$properties);?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main.css" />
<?php if(@$launchpadPN=="pad1"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad1.css" />
<?php }if(@$launchpadPN=="pad2"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad2.css" />
<?php }if(@$launchpadPN=="pad3"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad3.css" />
<?php }if(@$launchpadPN=="pad4"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad4.css" />
<?php }if (!isset($_GET['launchpad']) && ($_GET['launchpad'] != "projects") ){printf("<script type=\"text/javascript\">location.href='".$properties->WEBSITE_URL."".$properties->PADMAIN."/home'</script>");}?>

<meta name="description" content="<?php echo $properties->SITE_DESCRIPTION;?>" />
<meta name="keywords" content="<?php echo getPageKeywords($launchpadPN,$page,$properties);?>" />
<meta name="author" content="<?php echo $properties->SITE_AUTHOR;?>" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main_ie6.css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main_ie7.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/ajax/all.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/general.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/tweet/jquery.tweet.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/cycle/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jflickrfeed.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/jquery-ui-min.js"></script>
<link rel="shortcut icon" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/images/favicon.ico">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/colorbox/colorbox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/jc/tango/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/jc/alpha/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/jc/macho/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/jc/ionius/skin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/jquery-ui.css" />
</head>

<body>
	<?php
	//check for INSTALLATION LOCK
	if(file_exists("INSTALL.LOCK")){$FILE_LOCK="yes";}else{$FILE_LOCK="no";}
	
	if($FILE_LOCK=="yes"){
		/* INSTALLATION HAS BEEN DONE AND THE INSTALL DIRECTORY HAS BEEN LOCKED */
		/* determine the mode the site is running in */
		$MODE=getGlobalVars($properties,'mode');
		switch($MODE){
			case 'closed':
			include("includes/private/tools/modes/closed.php");
			break;
	
			case 'alpha mode':
			include("includes/private/tools/modes/alphamode.php");
			break;
	
			case 'closed beta':
			include("includes/private/tools/modes/closedbeta.php");
			break;
	
			case 'open beta':
			include("includes/private/tools/modes/openbeta.php");
			break;
	
			case 'open':
			include("includes/private/tools/modes/open.php");
			break;
			
			case 'maintenance':
			include("includes/private/tools/modes/maintenance.php");
			break;
		}
	} else {
		echo "<center><h1 style=\"line-height: 1.2em;\">Please run the installation by going to <a href=\"".$properties->WEBSITE_URL."INSTALL/\" class=\"black-url\">INSTALL/</a> or rename the &quot;INSTALL&quot; directory to &quot;INSTALL.LOCK&quot; (if you have already ran the installation and the INSTALL directory did not get auto-magically changed to &quot;INSTALL.LOCK&quot;</h1></center>";
	}
	?>
<?php
if($_SERVER['HTTP_HOST']=="localhost"){
	/* DO NOT SEND GAUGES DATA */
} else {
?>
<script type="text/javascript">
  var _gauges = _gauges || [];
  (function() {
    var t   = document.createElement('script');
    t.type  = 'text/javascript';
    t.async = true;
    t.id    = 'gauges-tracker';
    t.setAttribute('data-site-id', '506f033c613f5d722900007e');
    t.src = '//secure.gaug.es/track.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(t, s);
  })();
</script>
<?php
}
?>
</body>
</html>