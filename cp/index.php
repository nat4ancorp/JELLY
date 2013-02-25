<?php
ob_start(); //Initiate the output buffer

error_reporting(0); /* IMPLEMENTED DUE TO WEIRD ISSUE WITH MYSQL_NUM_ROWS ARGUMENT THING IN 1.0.39 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
//load global vars from another php file (props.php)
include '../conf/props.php';
$properties=new properties();
include '../conf/connect.php';
$CURRENT_MENU=$_GET['menu'];
$CURRENT_PAGE=$_GET['page'];

/* DETERMINE THE WEBSITE_URL */
if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL."cp";$WEBSITE_URL_ROOT=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL."cp";$WEBSITE_URL_ROOT=$properties->WEBSITE_REMO_URL;}
?>
<title><?php echo $properties->WEBSITE_NAME;?> - cPanel</title>

<meta name="description" content="<?php echo $properties->SITE_DESCRIPTION;?>" />
<meta name="keywords" content="<?php echo getPageKeywords(@$launchpadPN,@$page,$properties);?>" />
<meta name="author" content="<?php echo $properties->SITE_AUTHOR;?>" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL_ROOT;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>/main_ie6.css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL_ROOT;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>/main_ie7.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/ajax/all.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/general.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/c_config.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/c_smartmenus.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/tweet/jquery.tweet.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/cycle/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jflickrfeed.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jquery-ui-min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jquery.bpopup-0.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/jquery.orbit.min.js"></script>
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/ajaxupload.js"></script>
<!-- markItUp! -->
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/markitup/jquery.markitup.js"></script>
<!-- markItUp! toolbar settings -->
<script type="text/javascript" src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/markitup/sets/default/set.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL_ROOT;?>cp/styles/all.css" />
<link rel="shortcut icon" href="<?php echo $WEBSITE_URL_ROOT;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/favicon.ico">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $WEBSITE_URL_ROOT;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/colorbox/colorbox.css" />
<?php $GET_JC_SKINS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}jc_themes WHERE status='active'");
if(mysql_num_rows($GET_JC_SKINS)<1){/* NONE */} else {while($FETCH_JC_SKINS=mysql_fetch_array($GET_JC_SKINS)){?><link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL.$properties->PATH_TO_THEME_ASSETS;?>jquery/jc/<?php echo $FETCH_JC_SKINS['name'];?>/skin.css" /><?php }}?>
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL_ROOT;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL_ROOT;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/datepick/jquery.datepick.css" />
<link rel="stylesheet" href="<?php echo $WEBSITE_URL_ROOT;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>jquery/ajaxupload/classicTheme/style.css" type="text/css" media="all" />

<!-- markItUp! skin -->
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/markitup/skins/markitup/style.css">
<!--  markItUp! toolbar skin -->
<link rel="stylesheet" type="text/css" href="<?php echo $WEBSITE_URL_ROOT;?>includes/private/js/markitup/sets/default/style.css">
</head>

<body>

<?php
/* DETECT IF LOGGED IN AND AGREED TO TOU */
$ip=$_SERVER['REMOTE_ADDR'];
$properties->setServerTime();
include("../includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
	$logged=0;
} else {
	$logged=1;
	$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
	$user_id=$FETCH_LOGIN['id'];
	$loggedin=$FETCH_LOGIN['loggedin'];
	$tou_s=$FETCH_LOGIN['tou_status'];
	$in_site=$FETCH_LOGIN['in_site'];
	$status=$FETCH_LOGIN['status'];
	$suspended_reason=$FETCH_LOGIN['suspended_reason'];
	if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
	$username=$FETCH_LOGIN['uname'];
	$type=$FETCH_LOGIN['type'];
	$head_admin=$FETCH_LOGIN['head_admin'];
}
if($logged==1){
?>
<div id="top-bar">
<a href="<?php echo $WEBSITE_URL_ROOT;?>" tabindex="-1"><?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?></a> | <a href="<?php echo $WEBSITE_URL;?>?menu=posts&page=add-new" tabindex="-1">New Post</a>
</div>
<!-- BUILD THE PAGE HERE -->
<div id="container2">
	<div id="container1">
		<div id="col1">
			<ul id="adminmenu" role="navigation">
            	<?php
				/* MAKE THE MENU MATRIX */
				$GET_MENUS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cp_adminmenu") or die(mysql_error());
				if(mysql_num_rows($GET_MENUS)<1){
					/* NO MENUS */
					echo "No Menus :(";
				} else {
					//count the number of page = 0 (this gets the amount of menus
					$GET_NUM_OF_MENUS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cp_adminmenu WHERE page='0'");
					$COUNT_OF_MENUS=mysql_num_rows($GET_NUM_OF_MENUS);
										
					//repeat how ever many times that there are menus
					for($icm=1; $icm<=$COUNT_OF_MENUS; $icm++){
						$GET_MENUS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cp_adminmenu WHERE menu='$icm'");
						?>
                        <a name="<?php echo $icm;?>"></a>
						<div class="menu-submenu" id="menu-<?php echo $icm;?>">
						<?php
                    	while($FETCH_MENUS=mysql_fetch_array($GET_MENUS)){							
							$pageid=$FETCH_MENUS['page'];
							$menuid=$FETCH_MENUS['menu'];
														
							//get the menu name
							$GET_MENU_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cp_adminmenu_menus WHERE id='$menuid'");
							$FETCH_MENU_NAME=mysql_fetch_array($GET_MENU_NAME);
							$menu=$FETCH_MENU_NAME['name'];
							$special=$FETCH_MENU_NAME['special'];
							$default_state=$FETCH_MENU_NAME['default_state'];
														
							//get the page name
							$GET_PAGE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cp_adminmenu_pages WHERE id='$pageid' AND menu='$menuid'");
							$FETCH_PAGE_NAME=mysql_fetch_array($GET_PAGE_NAME);
							$page=$FETCH_PAGE_NAME['name'];
							$special_code=$FETCH_PAGE_NAME['special_code'];
							
							//convert to safe html
							$menu_short=str_replace(" ","-",$menu);
							$menu_short=str_replace("'","%",$menu_short);
							$menu_short=strtolower($menu_short);
							
							//convert to safe html
							$page_short=str_replace(" ","-",$page);
							$page_short=str_replace("'","%",$page_short);
							$page_short=strtolower($page_short);
							
							if($pageid==0){
								/* ITS A FIRST ITEM */
								if($menu_short==$CURRENT_MENU){
									?>
									<li class="menu-first-item selected-menu"><a href="?menu=<?php echo $menu_short;?>" tabindex="-1"><?php echo $menu;?><?php if($special!=""){/* SPECIAL CODE */echo "<div class=\"special\">&nbsp;";echo eval($special);echo "</div>";}else{/* NO SPECIAL CODE */}?></a></li>
									<?php
								} else {
									?>
									<li class="menu-first-item"><a href="?menu=<?php echo $menu_short;?>" tabindex="-1"><?php echo $menu;?><?php if($special!=""){/* SPECIAL CODE */echo "<div class=\"special\">&nbsp;";echo eval($special);echo "</div>";}else{/* NO SPECIAL CODE */}?></a></li>
									<?php	
								}
							} else {
								//check for default state
								if(($default_state == "show") || ($menu_short==$CURRENT_MENU)){
									if(($menu_short==$CURRENT_MENU) && ($page_short==$CURRENT_PAGE)){
										?>
										<div class="submenu-item selected-page"><a href="?menu=<?php echo $menu_short;?>&page=<?php echo $page_short;?>"><?php echo $page;?><?php if($special_code!=""){/* SPECIAL CODE */echo "<div class=\"special-active\">&nbsp;";echo eval($special_code);echo "</div>";}else{/*NO SPECIAL CODE*/}?></a></div>
										<?php
									} else {
										?>
										<div class="submenu-item"><a href="?menu=<?php echo $menu_short;?>&page=<?php echo $page_short;?>"><?php echo $page;?><?php if($special_code!=""){/* SPECIAL CODE */echo "<div class=\"special\">&nbsp;";echo eval($special_code);echo "</div>";}else{/*NO SPECIAL CODE*/}?></a></div>
										<?php	
									}
								} else if($default_state == "hidden") {
									if(($menu_short==$CURRENT_MENU) && ($page_short==$CURRENT_PAGE)){
										?>
										<div class="submenu-item selected-page hidden"><a href="?menu=<?php echo $menu_short;?>&page=<?php echo $page_short;?>"><?php echo $page;?><?php if($special_code!=""){/* SPECIAL CODE */echo "<div class=\"special-active\">&nbsp;";echo eval($special_code);echo "</div>";}else{/*NO SPECIAL CODE*/}?></a></div>
										<?php
									} else {
										?>
										<div class="submenu-item hidden"><a href="?menu=<?php echo $menu_short;?>&page=<?php echo $page_short;?>"><?php echo $page;?><?php if($special_code!=""){/* SPECIAL CODE */echo "<div class=\"special\">&nbsp;";echo eval($special_code);echo "</div>";}else{/*NO SPECIAL CODE*/}?></a></div>
										<?php	
									}	
								}
							}
						}
						?>
						</div>
						<?php
					}					
				}
				?>
            </ul>
            <div id="under-adminmenu"></div>
        </div>
    	<div id="col2">
        	<!-- BUILD PAGE RIGHT SIDE SECTION : WHERE ALL THE CONTENT ARE -->
            <?php
			//get the menu and page variables
			$MENU=$_GET['menu'];
			$PAGE=$_GET['page'];
			
			//switch gate for the menu and page
			if(isset($MENU) || isset($PAGE)){
				//switch for menu
				if(isset($MENU)){
					/* MENU SET */
					//check for page
					if(isset($PAGE)){
						/* PAGE SET; WITH A PAGE DISPLAY */											
						include("includes/pages/".$MENU."/".$PAGE.".php");?>
                        <?php
					} else {
						/* NO PAGE SET; WITHOUT A PAGE DISPLAY */
						switch($MENU){
							default:
								//find the menu id
								$GET_MENUID=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cp_adminmenu_menus WHERE name='".str_replace("-"," ",ucfirst($MENU))."'");
								$FETCH_MENUID=mysql_fetch_array($GET_MENUID);
								$menuid=$FETCH_MENUID['id'];
							
								//find the default page of the menu set
								$GET_DEFAULT_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cp_adminmenu_pages WHERE menu='$menuid'");
								while($FETCH_DEFAULT_PAGE=mysql_fetch_array($GET_DEFAULT_PAGE)){
									$is_default=$FETCH_DEFAULT_PAGE['is_default'];
									$is_special=$FETCH_DEFAULT_PAGE['is_special'];
									$name=$FETCH_DEFAULT_PAGE['name'];
									if($is_default=="yes"){$PAGE=strtolower(str_replace("'","%",str_replace(" ","-",$name)));}
									if($is_special=="yes"){$SPECIAL="yes";}else if($is_special=="no"){$SPECIAL="no";}
								}
								
								if($SPECIAL == "yes"){
									/* NO REDIRECT */
									printf("<script type=\"text/javascript\">location.href='".$WEBSITE_URL."?menu=".$MENU."&page=home'</script>");
								} else if($SPECIAL == "no") {
									printf("<script type=\"text/javascript\">location.href='".$WEBSITE_URL."?menu=".$MENU."&page=".$PAGE."'</script>");
								}
							break;
						}
					}
				}				
			} else {
				printf("<script type=\"text/javascript\">location.href='".$WEBSITE_URL."?menu=dashboard'</script>");
			}
			?>
            <!-- END BUILD PAGE RIGHT SIDE SECTION : WHERE ALL THE CONTENT ARE -->
        </div>
	</div>
</div>
<!-- END BUILD THE PAGE HERE -->
<?php
} else {
	echo "<h1><center>You must be logged in to use this page!</center></h1>";	
}
?>
</body>
</html>