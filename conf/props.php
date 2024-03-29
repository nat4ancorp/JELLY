<?php
/* WEB INTERFACE TO LEARN & TO LOVE (WITLL) CORE SYSTEM CONFIGURATION */
/* WITLL WAS DEVELOPED AND DEBUGGED BY NATHAN SMYTH AND IS AVAILABLE TO BE USED AS A FREEWARE */
/* SOFTWARE BY ANYONE WHO CAN DECYFER THE CODE. HA JK. ALL YOU NEED TO DO IS RUN THE INSTALL  */
/* AND USE IT JUST LIKE YOU WOULD WORDPRESS                                                   */

/* PLEASE LEAVE THIS COPYRIGHT OWNERSHIP INFO INTACT AS YOU USE THIS PIECE OF WEB SOFTWARE    */
/* YOU CAN ALWAYS GET PLUGINS, THEMES, AND MODULES FROM WITLL.NET!!!                          */

/* IF YOU HAVE NOT RAN THE INSTALLATION (MEANING THE INSTALL FOLDER IS NOT CALLED "INSTALL.   */
/* LOCK") THEN PLEASE DO NOT EDIT ANYTHING IN THIS FILE UNTIL YOU HAVE DONE SO.               */
/* WHY? BECAUSE I HAVE MADE A COMPREHENSIVE INSTALLATION SYSTEM THAT DOES ALL THE CHANGES TO  */
/* THIS CONFIGURATION FILE AUTO-MAGICALLY.                                                    */


/* ---------------------------- END OWNERSHIP INFO ------------------------------------------ */


/* ----------------------------------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------------------------------- */
/*                                          DO NOT EDIT BELOW THIS OR ELSE YOU WILL BREAK IT!!! :                                                      */
/* ----------------------------------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------------------------------- */
include("constants.inc.php");

//CHECK AS OF 3.9.1
if($_SERVER['HTTP_HOST']==CONSTANTS::HTTP_HOST){/* ON LOCAL */$ONLY_ON_LOCAL=CONSTANTS::HTTP_HOST_LOCAL_ONLY;} else {/* ON REMOTE */}

if($_SERVER['HTTP_HOST']==CONSTANTS::HTTP_HOST){
	/* ON LOCAL */
	$globalvars_passpage_title					 = "<h1 style=\"font-size:62px;text-align:center;position:relative;top:10px;\" class=\"header\" onclick=\"window.location.href='".$ONLY_ON_LOCAL."".CONSTANTS::HTTP_HOST."/".CONSTANTS::APP_NAME.CONSTANTS::BRANCH.CONSTANTS::VERSION."/'\">".CONSTANTS::MAIN_TITLE.CONSTANTS::WEBSITE_EXT."</h1>";

} else {
	/* ON REMOTE */
	$globalvars_passpage_title					 = "<h1 style=\"font-size:62px;text-align:center;position:relative;top:10px;\" class=\"header\" onclick=\"window.location.href='".CONSTANTS::HTTP_HOST_REMOTE."/".CONSTANTS::APP_NAME_REMOTE.CONSTANTS::BRANCH_REMOTE.CONSTANTS::VERSION_REMOTE."/'\">Nat4an.com</h1>";
}

$globalvars_passpage_slogan					 = ""; //<h2 style=\"font-size:48px;text-align:center;position:relative;top:10px;\">".CONSTANTS::WEBSITE_SLOGAN_SHORT."</h2>
$globalvars_passpage_closed_st				 = ""; //<h2 style=\"font-size:48px;text-align:center;position:relative;top:10px;\">(Closed)</h2>
$globalvars_passpage_closedbeta_st			 = ""; //<h2 style=\"font-size:48px;text-align:center;position:relative;top:10px;\">(Closed BETA)</h2>

class properties extends CONSTANTS
{	
	public $COMPANY_NAME 		 			 = CONSTANTS::COMPANY_NAME;
	public $PLATFORM 			 			 = CONSTANTS::PLATFORM;
	public $PLATFORM_WEBSITE				 = CONSTANTS::PLATFORM_WEBSITE;
	public $TITLE_B4_PLATFORM 	 			 = CONSTANTS::TITLE_B4_PLATFORM;
	public $TITLE_AFTER_PLATFORM 			 = CONSTANTS::TITLE_AFTER_PLATFORM;
	public $VERSION_CTRL 		 			 = CONSTANTS::VERSION_NUMBER;
	public $WEBSITE_NAME 		 			 = CONSTANTS::WEBSITE_NAME;
	public $WEBSITE_EXT 		 			 = CONSTANTS::WEBSITE_EXT;
	public $WEBSITE_SLOGAN					 = CONSTANTS::WEBSITE_SLOGAN;
	
	public $HTTP_HOST						 = CONSTANTS::HTTP_HOST;	
	
	public $FULL_WEBSITE_TEST_URL			 = CONSTANTS::FULL_WEBSITE_TEST_URL;
	public $FULL_WEBSITE_REMO_URL			 = CONSTANTS::FULL_WEBSITE_REMO_URL;
	
	public $WEBSITE_TEST_URL	 			 = CONSTANTS::WEBSITE_TEST_URL;
	public $WEBSITE_REMO_URL	 			 = CONSTANTS::WEBSITE_REMO_URL;
	
	public $PATH_TO_THEME_ASSETS			 = CONSTANTS::PATH_TO_THEME_ASSETS;	
	public $TURN_ON_BOTTOM_NAV				 = CONSTANTS::TURN_ON_BOTTOM_NAV;
	public $TURN_ON_TOP_NAV					 = CONSTANTS::TURN_ON_TOP_NAV;
	public $DEFAULT_SEARCH_TEXT_PADMAIN		 = CONSTANTS::DEFAULT_SEARCH_TEXT_PADMAIN;
	public $DEFAULT_SEARCH_TEXT_PAD1		 = CONSTANTS::DEFAULT_SEARCH_TEXT_PAD1;
	public $DEFAULT_SEARCH_TEXT_PAD2		 = CONSTANTS::DEFAULT_SEARCH_TEXT_PAD2;
	public $DEFAULT_SEARCH_TEXT_PAD3		 = CONSTANTS::DEFAULT_SEARCH_TEXT_PAD3;
	public $DEFAULT_SEARCH_TEXT_PAD4		 = CONSTANTS::DEFAULT_SEARCH_TEXT_PAD4;
	public $SERVER_LOCATION					 = CONSTANTS::SERVER_LOCATION;		
	public $SITE_DESCRIPTION				 = CONSTANTS::SITE_DESCRIPTION;
	public $SITE_AUTHOR					 	 = CONSTANTS::SITE_AUTHOR;
	public $SITE_KEYWORDS					 = CONSTANTS::SITE_KEYWORDS; 
	public $PROPS_VAR_BODYSB_WRAP_START		 = CONSTANTS::PROPS_VAR_BODYSB_WRAP_START;
	public $PROPS_VAR_BODYSB_WRAP_END		 = CONSTANTS::PROPS_VAR_BODYSB_WRAP_END;
	public $DB_HOST							 = CONSTANTS::DB_HOST;
	public $DB_USER							 = CONSTANTS::DB_USER;
	public $DB_PASS							 = CONSTANTS::DB_PASS;
	public $DB_NAME							 = CONSTANTS::DB_NAME;
	public $DB_PREFIX						 = CONSTANTS::DB_PREFIX;
	public $MAIN_TITLE			 			 = CONSTANTS::MAIN_TITLE;
	public $MAIN_TITLE_ALIGN	 			 = CONSTANTS::MAIN_TITLE_ALIGN;
	public $MAIN_SLOGAN			 			 = CONSTANTS::MAIN_SLOGAN;
	public $MAIN_SLOGAN_EXTRA_PAD1 			 = CONSTANTS::MAIN_SLOGAN_EXTRA_PAD1;
	public $MAIN_SLOGAN_EXTRA_PAD2 			 = CONSTANTS::MAIN_SLOGAN_EXTRA_PAD2;
	public $MAIN_SLOGAN_EXTRA_PAD3 			 = CONSTANTS::MAIN_SLOGAN_EXTRA_PAD3;
	public $MAIN_SLOGAN_EXTRA_PAD4 			 = CONSTANTS::MAIN_SLOGAN_EXTRA_PAD4;
	public $MAIN_SLOGAN_ALIGN	 			 = CONSTANTS::MAIN_SLOGAN_ALIGN;	
	public $HEADER_RIGHT_SIDE_CONTENT 		 = CONSTANTS::HEADER_RIGHT_SIDE_CONTENT;
	public $HEADER_RIGHT_SIDE_CONTENT_ALIGN	 = CONSTANTS::HEADER_RIGHT_SIDE_CONTENT_ALIGN;
	public $TN_RIGHT_SIDE_CONTENT	 		 = CONSTANTS::TN_RIGHT_SIDE_CONTENT;
	public $TN_RIGHT_SIDE_CONTENT_ALIGN		 = CONSTANTS::TN_RIGHT_SIDE_CONTENT_ALIGN;	
	public $PAD_AMOUNT						 = CONSTANTS::PAD_AMOUNT;
	public $PADMAIN							 = CONSTANTS::NAME_PADMAIN;
	public $PAD1							 = CONSTANTS::NAME_PAD1;
	public $PAD2							 = CONSTANTS::NAME_PAD2;
	public $PAD3							 = CONSTANTS::NAME_PAD3;
	public $PAD4							 = CONSTANTS::NAME_PAD4;
	public $SPADMAIN						 = CONSTANTS::SNAME_PADMAIN;
	public $SPAD1							 = CONSTANTS::SNAME_PAD1;
	public $SPAD2							 = CONSTANTS::SNAME_PAD2;
	public $SPAD3							 = CONSTANTS::SNAME_PAD3;
	public $SPAD4							 = CONSTANTS::SNAME_PAD4;
	public $FPADMAIN						 = CONSTANTS::FNAME_PADMAIN;
	public $FPAD1							 = CONSTANTS::FNAME_PAD1;
	public $FPAD2							 = CONSTANTS::FNAME_PAD2;
	public $FPAD3							 = CONSTANTS::FNAME_PAD3;
	public $FPAD4							 = CONSTANTS::FNAME_PAD4;
	public $_COOKIE_INIT_LOCAL_SESSION		 = CONSTANTS::_COOKIE_INIT_LOCAL_SESSION;
	public $_COOKIE_INIT_REMOTE_SESSION		 = CONSTANTS::_COOKIE_INIT_REMOTE_SESSION;
	public $_COOKIE_INIT_TEMP_LOCAL_SESSION	 = CONSTANTS::_COOKIE_INIT_TEMP_LOCAL_SESSION;
	public $_COOKIE_INIT_TEMP_REMOTE_SESSION = CONSTANTS::_COOKIE_INIT_TEMP_REMOTE_SESSION;
	public $FOOTER_AUTHOR_INFO				 = CONSTANTS::FOOTER_AUTHOR_INFO;

	//main-page-title
	public function displayMainTitle(){
		if($this->MAIN_TITLE_ALIGN=="l"){
			echo "<div align=\"left\">".$this->MAIN_TITLE."</div>";
		}
		else if($this->MAIN_TITLE_ALIGN=="c"){
			echo "<div align=\"center\">".$this->MAIN_TITLE."</div>";
		}
		else if($this->MAIN_TITLE_ALIGN=="r"){
			echo "<div align=\"right\">".$this->MAIN_TITLE."</div>";
		}
	}	
	
	//main page slogan
	public function displayMainSlogan($properties,$launchpad,$varType){
		switch($launchpad){
			case $properties->PADMAIN:
				switch($varType){
					case 'main':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN;
						}
					break;
					
					case 'extra':
						
					break;	
				}
			break;
			
			case $properties->PAD1:
				switch($varType){
					case 'main':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN;
						}
					break;
					
					case 'extra':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD1;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD1;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD1;
						}
					break;	
				}
			break;
			
			case $properties->PAD2:
				switch($varType){
					case 'main':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN;
						}
					break;
					
					case 'extra':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD2;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD2;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD2;
						}
					break;	
				}
			break;
			
			case $properties->PAD3:
				switch($varType){
					case 'main':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN;
						}
					break;
					
					case 'extra':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD3;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD3;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD3;
						}
					break;	
				}
			break;
			
			case $properties->PAD4:
				switch($varType){
					case 'main':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN;
						}
					break;
					
					case 'extra':
						if($this->MAIN_SLOGAN_ALIGN=="l"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD4;
						}
						else if($this->MAIN_SLOGAN_ALIGN=="c"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD4;
						}	
						else if($this->MAIN_SLOGAN_ALIGN=="r"){
							echo $this->MAIN_SLOGAN_EXTRA_PAD4;
						}
					break;	
				}
			break;
		}
	}
	
	//header right side content
	public function displayHeaderRightSideContent(){
		if($this->HEADER_RIGHT_SIDE_CONTENT_ALIGN=="l"){
			echo "<div align=\"left\">".$this->HEADER_RIGHT_SIDE_CONTENT."</div>";
		}
		else if($this->HEADER_RIGHT_SIDE_CONTENT_ALIGN=="c"){
			echo "<div align=\"center\">".$this->HEADER_RIGHT_SIDE_CONTENT."</div>";
		}
		else if($this->HEADER_RIGHT_SIDE_CONTENT_ALIGN=="r"){
			echo "<div align=\"right\">".$this->HEADER_RIGHT_SIDE_CONTENT."</div>";
		}
	}
	
	//top nav right side content
	public function displayTopNavRightSideContent(){
		if($this->TN_RIGHT_SIDE_CONTENT_ALIGN=="l"){
			echo "<div align=\"left\">".$this->TN_RIGHT_SIDE_CONTENT."</div>";
		}
		else if($this->TN_RIGHT_SIDE_CONTENT_ALIGN=="c"){
			echo "<div align=\"center\">".$this->TN_RIGHT_SIDE_CONTENT."</div>";
		}
		else if($this->TN_RIGHT_SIDE_CONTENT_ALIGN=="r"){
			echo "<div align=\"right\">".$this->TN_RIGHT_SIDE_CONTENT."</div>";
		}
	}
	
	public function setServerTime(){
		return date_default_timezone_set($this->SERVER_LOCATION); 
	}
	
}

//get the page of the site
function getPageContents($launchpadID,$page,$subpage,$wurl,$launchpadPN,$properties,$THEME_NAME,$HTDN){
	$ip=$_SERVER['REMOTE_ADDR'];
	if($_SERVER['HTTP_HOST']==$properties->HTTP_HOST){
		$logged_session=$_COOKIE[$properties->_COOKIE_INIT_TEMP_LOCAL_SESSION];
	} else {
		$logged_session=$_COOKIE[$properties->_COOKIE_INIT_TEMP_REMOTE_SESSION];
	}
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
		$user_id=$FETCH_LOGIN['id'];
	}
	
	//$launchpad=@$launchpadNAME;
	$pageFile="includes/public/page.php";
	
	//check to see if file exists in db
	include 'conf/connect.php';
	$CHECK_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'");
	$CHECK_SUBPAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND subpage='$subpage'");
	if((mysql_num_rows($CHECK_PAGE)<1) || (mysql_num_rows($CHECK_SUBPAGE)<1)){
		//page not found
		@$PAGE_NOT_EXISTS="1";
	} else {
		$PAGE_NOT_EXISTS="0";
	}
	
	//load the contents
	if($PAGE_NOT_EXISTS=="0"){
		include $pageFile;
	} else if($PAGE_NOT_EXISTS=="1") {
		//no page found
		$code="404";
		$pageFile="includes/public/error.php";
		include $pageFile;
	}
}

function getPageName($launchpadPN,$page,$properties){
	include 'conf/connect.php';
	if($page == "home"){
		$pageNAME="";
	} else {
		$CHECK_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'");
		$FETCH_PAGE=mysql_fetch_array($CHECK_PAGE);
		$pageNAME=" - ".$FETCH_PAGE['pageNAME'];	
	}
	return $pageNAME;
}
function getSlogan($properties,$launchpadPN){
	include 'conf/connect.php';
	
	switch($launchpadPN){
		case 'padmain':
		$slogan=$properties->WEBSITE_SLOGAN;
		break;
		case 'pad1':
		$slogan=$properties->SPAD1;
		break;
		case 'pad2':
		$slogan=$properties->SPAD2;
		break;
		case 'pad3':
		$slogan=$properties->SPAD3;
		break;
		case 'pad4':
		$slogan=$properties->SPAD4;
		break;
	}
	
	return $slogan;
}
function getPageKeywords($launchpadPN,$page,$properties){
	include 'conf/connect.php';
	@$meta=$_GET['meta'];
	@$launchpad=$_GET['launchpad'];
	if($page == "home"){
		$pageKEYWORDS=$properties->SITE_KEYWORDS;
	} else {
		$CHECK_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'");
		$FETCH_PAGE=mysql_fetch_array($CHECK_PAGE);
		$pageKEYWORDS=$properties->SITE_KEYWORDS.",".$FETCH_PAGE['pageKEYWORDS'];
	}
	
	//get keywords of blog entry if permalink
	if($meta == "permalink"){
		//its a blog entry
		@$blogtitle=converter($properties,$_GET['title'],'url','from');
		$CHECK_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE title='$blogtitle'");
		$FETCH_PAGE=mysql_fetch_array($CHECK_PAGE);
		$pageKEYWORDS.=",".$FETCH_PAGE['tags'];
	}
	
	//get keywords of work if permalink
	if(($launchpad == $properties->PADMAIN) && ($page == "work") && ($meta == "permalink") && ($_GET['name'] != "")){
		//its a project
		@$projectname=$_GET['name'];
		$projectname=str_replace("-"," ",$projectname);
		$GET_REAL_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE title='$projectname'");
		$FETCH_REAL_NAME=mysql_fetch_array($GET_REAL_NAME);
		@$real_name=$FETCH_REAL_NAME['title'];
		$CHECK_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE title='$real_name'");		
		$FETCH_PAGE=mysql_fetch_array($CHECK_PAGE);
		$pageKEYWORDS.=$FETCH_PAGE['tags'];
	}
	return $pageKEYWORDS;
}

//build the top navigation matrix
function topnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage){
	//define constants
	$navigation_names = '';
	$navigation_surls = '';
	$navigation_wurls = '';
	$type_of_nav = 'topnav';
	
	$GET_NAVIGATION_FOR_SUBPAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='{$launchpadID}' AND type='{$type_of_nav}' AND parent='{$page}' ORDER BY name") or die(mysql_error());
	if(mysql_num_rows($GET_NAVIGATION_FOR_SUBPAGE)<1){
		//no parent page; it is a page
		$GET_NAVIGATION_FOR_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='{$launchpadID}' AND type='{$type_of_nav}' AND parent='' ORDER BY name") or die(mysql_error());
		if(mysql_num_rows($GET_NAVIGATION_FOR_PAGE)<1){
			//no top nav links, load it with basic credentials
			$GET_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='1' AND type='{$type_of_nav}' AND parent='home' ORDER BY name") or die(mysql_error());
			while($FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS=mysql_fetch_array($GET_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS)){
				$navigation_names .= $FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS['name'].',';
				$navigation_surls .= $FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS['surl'].',';
				$navigation_wurls .= $launchpadNAME.'/'.$page.'/'.$FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS['surl'].',';
			}
		} else {
			//has top links
			while($FETCH_NAVIGATION_FOR_PAGE=mysql_fetch_array($GET_NAVIGATION_FOR_PAGE)){
				$navigation_names .= $FETCH_NAVIGATION_FOR_PAGE['name'].',';
				$navigation_surls .= $FETCH_NAVIGATION_FOR_PAGE['surl'].',';
				$navigation_wurls .= $launchpadNAME.'/'.$page.'/'.$FETCH_NAVIGATION_FOR_PAGE['surl'].',';
			}
		}
	} else {
		//subpage
		while($FETCH_NAVIGATION_FOR_SUBPAGE=mysql_fetch_array($GET_NAVIGATION_FOR_SUBPAGE)){
			$navigation_names .= $FETCH_NAVIGATION_FOR_SUBPAGE['name'].',';
			$navigation_surls .= $FETCH_NAVIGATION_FOR_SUBPAGE['surl'].',';
			$navigation_wurls .= $launchpadNAME.'/'.$page.'/'.$FETCH_NAVIGATION_FOR_SUBPAGE['surl'].',';
		}
	}
	
	//explode the list
	$navigation_names=explode(",",$navigation_names);
	$navigation_surls=explode(",",$navigation_surls);
	$navigation_wurls=explode(",",$navigation_wurls);
		
	//do it now!
	$THENAVLIST="";
	for($i=0; $i<count($navigation_names)-1; $i++){
		if($navigation_surls[$i]==$subpage){
			//check to see if it is the first item, if so no line, if not line
			if($i==0){
				$THENAVLIST.=" <a id=\"selected\" href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a>";
			} else {
				$THENAVLIST.=" &nbsp; <a id=\"selected\" href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a>";	
			}
		} else {
			if($i==0){
				$THENAVLIST.=" <a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a>";
			} else {
				$THENAVLIST.=" &nbsp; <a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a>";	
			}
		}
	}
	return $THENAVLIST;
}

//build the navigation matrix
function navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage){
	//define constants
	$navigation_names = '';
	$navigation_surls = '';
	$navigation_wurls = '';
	$type_of_nav = 'nav';
		
	$GET_NAVIGATION=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='{$launchpadID}' AND type='{$type_of_nav}' AND parent='{$page}' ORDER BY name");
	if(mysql_num_rows($GET_NAVIGATION)<1){
		//not a subpage
		$GET_NAVIGATION=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='{$launchpadID}' AND type='{$type_of_nav}' ORDER BY name");
		while($FETCH_NAVIGATION=mysql_fetch_array($GET_NAVIGATION)){
			$navigation_names .= $FETCH_NAVIGATION['name'].',';
			$navigation_surls .= $FETCH_NAVIGATION['surl'].',';
			$navigation_wurls .= $launchpadNAME.'/'.$FETCH_NAVIGATION['surl'].',';
		}
	} else {
		while($FETCH_NAVIGATION=mysql_fetch_array($GET_NAVIGATION)){
			$navigation_names .= $FETCH_NAVIGATION['name'].',';
			$navigation_surls .= $FETCH_NAVIGATION['surl'].',';
			$navigation_wurls .= $launchpadNAME.'/'.$page.'/'.$FETCH_NAVIGATION['surl'].',';
		}
	}
	
	//explode the list
	$navigation_names=explode(",",$navigation_names);
	$navigation_surls=explode(",",$navigation_surls);
	$navigation_wurls=explode(",",$navigation_wurls);
		
	//do it now!
	$THENAVLIST="";
	for($i=0; $i<count($navigation_names)-1; $i++){
		if($navigation_surls[$i]==$page){
			$THENAVLIST.="<div class=\"nav-item-{$launchpadID}-{$i}-active\" onclick=\"window.location.href='{$wurl}{$navigation_wurls[$i]}'\">{$navigation_names[$i]}</div>";
		} else {
			$THENAVLIST.="<div class=\"nav-item-{$launchpadID}-{$i}\" onclick=\"window.location.href='{$wurl}{$navigation_wurls[$i]}'\">{$navigation_names[$i]}</div>";
		}
	}
	return $THENAVLIST;
}

//build the bottom navigation matrix
function bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage){
	//define constants
	$navigation_names = '';
	$navigation_surls = '';
	$navigation_wurls = '';
	$type_of_nav = 'bottomnav';
		
	$GET_NAVIGATION_FOR_SUBPAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='{$launchpadID}' AND type='{$type_of_nav}' AND parent='{$page}' ORDER BY name") or die(mysql_error());
	if(mysql_num_rows($GET_NAVIGATION_FOR_SUBPAGE)<1){
		//no parent page; it is a page
		$GET_NAVIGATION_FOR_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='{$launchpadID}' AND type='{$type_of_nav}' AND parent='' ORDER BY name") or die(mysql_error());
		if(mysql_num_rows($GET_NAVIGATION_FOR_PAGE)<1){
			//no top nav links, load it with basic credentials
			$GET_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}navigation WHERE launchpad='1' AND type='{$type_of_nav}' AND parent='home' ORDER BY name") or die(mysql_error());
			while($FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS=mysql_fetch_array($GET_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS)){
				$navigation_names .= $FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS['name'].',';
				$navigation_surls .= $FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS['surl'].',';
				$navigation_wurls .= $launchpadNAME.'/'.$FETCH_NAVIGATION_FOR_PAGE_WITH_NO_TOP_LINKS['surl'].',';
			}
		} else {
			//has top links
			while($FETCH_NAVIGATION_FOR_PAGE=mysql_fetch_array($GET_NAVIGATION_FOR_PAGE)){
				$navigation_names .= $FETCH_NAVIGATION_FOR_PAGE['name'].',';
				$navigation_surls .= $FETCH_NAVIGATION_FOR_PAGE['surl'].',';
				$navigation_wurls .= $launchpadNAME.'/'.$FETCH_NAVIGATION_FOR_PAGE['surl'].',';
			}
		}
	} else {
		//subpage
		while($FETCH_NAVIGATION_FOR_SUBPAGE=mysql_fetch_array($GET_NAVIGATION_FOR_SUBPAGE)){
			$navigation_names .= $FETCH_NAVIGATION_FOR_SUBPAGE['name'].',';
			$navigation_surls .= $FETCH_NAVIGATION_FOR_SUBPAGE['surl'].',';
			$navigation_wurls .= $launchpadNAME.'/'.$FETCH_NAVIGATION_FOR_SUBPAGE['surl'].',';
		}
	}
	
	//explode the list
	$navigation_names=explode(",",$navigation_names);
	$navigation_surls=explode(",",$navigation_surls);
	$navigation_wurls=explode(",",$navigation_wurls);
		
	//do it now!
	$THENAVLIST="";
	for($i=0; $i<count($navigation_names); $i++){
		if($navigation_surls[$i]==$subpage){
			$THENAVLIST.="<li class=\"active\" onclick=\"window.location.href='{$wurl}{$navigation_wurls[$i]}'\"><a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a></li>  ";
		} else {
			$THENAVLIST.="<li onclick=\"window.location.href='{$wurl}{$navigation_wurls[$i]}'\"><a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a></li>  ";
		}
	}
	return $THENAVLIST;
}

/* SPECIAL FUNCTIONS */

function GET_LP_ID($properties,$launchpad){
	include 'conf/connect.php';
	$GET_LP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}launchpads WHERE short='$launchpad'");
	if(mysql_num_rows($GET_LP)<1){
		//error	
	} else {
		$FETCH_LP=mysql_fetch_array($GET_LP);
		$id=$FETCH_LP['id'];
		return $id;
	}
}

/* SPECIAL PAGE INCLUDES */

/* TempSystem Protocals */
function tempSystem($properties,$operand,$setValue){
	switch($operand){
		case 'getIP':
			return $_SERVER['REMOTE_ADDR'];
		break;
		case 'getSESSION':
			if($_SERVER['HTTP_HOST']==$properties->HTTP_HOST){
				$SESSIONID=$_COOKIE[$properties->_COOKIE_INIT_TEMP_LOCAL_SESSION];
			} else {
				$SESSIONID=$_COOKIE[$properties->_COOKIE_INIT_TEMP_REMOTE_SESSION];
			}
			return $SESSIONID;
		break;
		case '_INIT':
			$ipaddress=$_SERVER['REMOTE_ADDR'];
			include 'conf/connect.php';
			if($_SERVER['HTTP_HOST']==$properties->HTTP_HOST){
				$SESSIONID=$_COOKIE[$properties->_COOKIE_INIT_TEMP_LOCAL_SESSION];
			} else {
				$SESSIONID=$_COOKIE[$properties->_COOKIE_INIT_TEMP_REMOTE_SESSION];
			}
			$GET_TEMP_BY_IP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip='".$ipaddress."' AND temp_session='".$SESSIONID."'");
			if(mysql_num_rows($GET_TEMP_BY_IP)<1){
				/* Temp User is not found; put a temp user in */				
				//make logged session id
				$lsessionid=str_shuffle($ipaddress.rand("000000000000","999999999999"));
															
				//set session cookie that will expire in 20 years (it's ok)
				if($_SERVER['HTTP_HOST']==$properties->HTTP_HOST){
					setcookie($properties->_COOKIE_INIT_TEMP_LOCAL_SESSION,$lsessionid,(time() + (20 * 365 * 24 * 60 * 60)),"/");
				} else {
					setcookie($properties->_COOKIE_INIT_TEMP_REMOTE_SESSION,$lsessionid,(time() + (20 * 365 * 24 * 60 * 60)),"/");
				}

				// set the defaulted theme in their temp user system table and update the rest
				$defaultTheme=Theme($properties,"getDefaultThemeID","","");
				mysql_query("INSERT INTO {$properties->DB_PREFIX}tempsystem(ip,lptoggle,is_searchable,fb_like,temp_session,themeID) VALUES('".$ipaddress."', '1','no','no','".$lsessionid."','".$defaultTheme."')") or die(mysql_error());
				
				// REFRESH THE PAGE
				//header("Refresh: .5"); as of 1.0.4b2 the default theme name gets put into the field in case no session id is found
				
			} else {
				while($FETCH_TEMP_BY_IP=mysql_fetch_array($GET_TEMP_BY_IP)){
					/* GET DATA */
					$lpToggle=$FETCH_TEMP_BY_IP['lptoggle'];
				}
			}
		break;
		case 'lpToggle':
			$ipaddress=$_SERVER['REMOTE_ADDR'];
			include 'conf/connect.php';
			if($setValue!=""){
				/* set a new lptoggle value */
				//if($setValue==1){$setValue="on";}else if($setValue==0){$setValue="off";}
				mysql_query("UPDATE {$properties->DB_PREFIX}tempsystem SET lptoggle='".$setValue."' WHERE ip='".$ipaddress."'") or die(mysql_error());
			} else {
				$GET_TEMP_BY_IP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip=\"".$ipaddress."\"") or die(mysql_error());
				while($FETCH_TEMP_BY_IP=mysql_fetch_array($GET_TEMP_BY_IP)){
					$lpToggle=$FETCH_TEMP_BY_IP['lptoggle'];
				}
				return $lpToggle;
			}
		break;
	}
}
function getGlobalVars($properties,$type){
	include 'conf/connect.php';
	switch($type){
		case $type:
			$GET_ITEM=mysql_query("SELECT * FROM {$properties->DB_PREFIX}globalvars");
			$FETCH_ITEM=mysql_fetch_array($GET_ITEM);
			$item=$FETCH_ITEM[$type];
			return $item;
		break;
	}	
}

function SEARCH($properties,$searchQuery,$HTDN){
	global $THEME_NAME;
	global $HTDN;
	include 'conf/connect.php';
	@$launchpad=$_GET['launchpad'];	
	@$total_results=0;
	@$not_allowed=0;
	@$o_not_allowed=0;
	@$not_allowed_list="";
	@$o_not_allowed_list="";
	
	//set up a div to put all the stuff in
	echo "<div style=\"padding:10px;\">";
	
	//get the launchpadID
	$launchpadID=GET_LP_ID($properties,$launchpad);
	
	//get the general filter list
	$GET_FILTER_GEN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}filter_list WHERE type='general'");
	if(mysql_num_rows($GET_FILTER_GEN)<1){
		echo "No filters";
	} else {
		while($FETCH_FILTER_GEN=mysql_fetch_array($GET_FILTER_GEN)){
			if($FETCH_FILTER_GEN['status'] == "not allowed"){
				$not_allowed_list.=$FETCH_FILTER_GEN['word'].",";
			} else if($FETCH_FILTER_GEN['status'] == "allowed"){ 
				/* ALLOWED */
			}
		}
	}
	//get the obscene filter list
	$GET_FILTER_O=mysql_query("SELECT * FROM {$properties->DB_PREFIX}filter_list WHERE type='obscene'");
	if(mysql_num_rows($GET_FILTER_O)<1){
		echo "No filters";
	} else {
		while($FETCH_FILTER_O=mysql_fetch_array($GET_FILTER_O)){
			if($FETCH_FILTER_O['status'] == "not allowed"){
				$o_not_allowed_list.=$FETCH_FILTER_O['word'].",";
			} else if($FETCH_FILTER_O['status'] == "allowed"){ 
				/* ALLOWED */
			}
		}
	}
	
	$not_allowed_list=explode(",",$not_allowed_list);
	$o_not_allowed_list=explode(",",$o_not_allowed_list);
	for($i=0; $i<count($not_allowed_list); $i++){
		if($searchQuery == $not_allowed_list[$i]){$not_allowed = 1;}
		if(strtolower($searchQuery) == $not_allowed_list[$i]){$not_allowed = 1;}
	}
	
	for($i=0; $i<count($o_not_allowed_list); $i++){
		if($searchQuery == $o_not_allowed_list[$i]){$o_not_allowed = 1;}
		if(strtolower($searchQuery) == $o_not_allowed_list[$i]){$o_not_allowed = 1;}
	}
	
	if($not_allowed == 1){
		echo "<h1>Hey! You're not allow to search for &quot;{$searchQuery}&quot;!</h1>";
		echo "<p><u>Why am I seeing this?</u><br />Because our system is built to store pages (HTML/PHP) in a database and load them in dynamically. These pages have regular HTML (and some PHP) markup on them. This is a much more secure way to store info and it is a heck of a lot easier way to manipulate this website.<br /><br />However, this method comes at a cost and that cost is the search-ability of words, symbols, or phrases, like &quot;{$searchQuery}&quot;. The reason we do this is because this is one more way to prevent hacking on this website. What could I do if I search something that pulled up a page with markup language on it? You could be able to know where pages are (structures), find the ends and outs of this site, and may even be able to hack us. :(<br /><br />If you believe this is a mistake, or you don't like the way we do things on this site, you could turn around and leave this site (which we highly recommend not doing...:)) or contact us ";?><a href="<?php if($_SERVER['HTTP_HOST']==$properties->HTTP_HOST){echo $properties->WEBSITE_TEST_URL.$properties->PADMAIN;}else{echo $properties->WEBSITE_REMO_URL.$properties->PADMAIN;}?>contact"<?php echo "class=\"black-url\">here</a>.</p>";
	} else if($o_not_allowed == 1){
		echo "<h1>Hey! You're not allow to search for &quot;{$searchQuery}&quot;!</h1>";
		echo "<p><u>Why am I seeing this?</u><br />Because the word or phrase &quot;{$searchQuery}&quot; you search for is not a nice word and it directly violates our Terms of Service.<br /><br />If you believe this is a mistake, or you don't like the way we do things on this site, you could turn around and leave this site (which we highly recommend not doing...:)) or contact us ";?><a href="<?php if($_SERVER['HTTP_HOST']==$properties->HTTP_HOST){echo $properties->WEBSITE_TEST_URL.$properties->PADMAIN;}else{echo $properties->WEBSITE_REMO_URL.$properties->PADMAIN;}?>contact" <?php echo "class=\"black-url\">here</a>.</p>";
	} else {
		/* DYNAMICALLY LOAD IN THE SEARCH CHAPTERS */
		//check for launchpad
		if($launchpad != $properties->PADMAIN){
			//its a launchpad that is not the main
			$GET_SEARCH_CHAPTERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}search_chapters WHERE is_searchable='yes' AND launchpad_id='$launchpadID' ORDER BY name");
		} else {
			$GET_SEARCH_CHAPTERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}search_chapters WHERE is_searchable='yes' ORDER BY name");
		}
		if(mysql_num_rows($GET_SEARCH_CHAPTERS)<1){
			echo "<h2>No Search Chapters Found...</h2>";	
		} else {
			while($FETCH_SEARCH_CHAPTERS=mysql_fetch_array($GET_SEARCH_CHAPTERS)){
				$id=$FETCH_SEARCH_CHAPTERS['id'];
				$chapter_id=$FETCH_SEARCH_CHAPTERS['chapter_id'];
				$name=$FETCH_SEARCH_CHAPTERS['name'];
				$item_id=$FETCH_SEARCH_CHAPTERS['item_id'];
				$search_this=$FETCH_SEARCH_CHAPTERS['search_this'];
				
				$item_single=$FETCH_SEARCH_CHAPTERS['item_single'];
				$item_single_list=explode(",",$item_single);				
				
				$item_plural=$FETCH_SEARCH_CHAPTERS['item_plural'];
				$item_plural_list=explode(",",$item_plural);		
				
				$connector_single=$FETCH_SEARCH_CHAPTERS['connector_single'];
				$connector_single_list=explode(",",$connector_single);		
				
				$connector_plural=$FETCH_SEARCH_CHAPTERS['connector_plural'];
				$connector_plural_list=explode(",",$connector_plural);
				
				$ending_single=$FETCH_SEARCH_CHAPTERS['ending_single'];
				$ending_single_list=explode(",",$ending_single);
				
				$ending_plural=$FETCH_SEARCH_CHAPTERS['ending_plural'];
				$ending_plural_list=explode(",",$ending_plural);				
				
				$where_clause=$FETCH_SEARCH_CHAPTERS['where_clause'];
				$order_by=$FETCH_SEARCH_CHAPTERS['order_by'];
				echo "<h1 style=\"font-size: 36px;font-weight:bold;\"><u>".$name."</u></h1>";
				$item_id_list=explode(",",$item_id);
				$chapter_id_list=explode(",",$chapter_id);
				$search_this_list=explode(",",$search_this);
				$where_clause_list=explode(",",$where_clause);
				$order_by_list=explode(",",$order_by);
				for($i=0; $i<count($search_this_list)-1; $i++){
					
					/* SEARCH IN ... */
					@$NUM_="";
					$NUM_=$id;
					@$item="";
					@$connector="";
					@$ending="";
					@$search_this_ind=$search_this_list[$i];
					@$where_clause_ind=$where_clause_list[$i];
					@$order_by_ind=$order_by_list[$i];
					$where_clause_ind=str_replace("(searchQuery)","'%$searchQuery%'",$where_clause_ind);
					@$query="SELECT * FROM {$properties->DB_PREFIX}".$search_this_ind." WHERE ".$where_clause_ind." AND is_searchable='yes'";					
					$COUNT=mysql_query($query);
					
					if(@mysql_num_rows($COUNT)<1){$item=$item_plural_list[$i];$connector=$connector_plural_list[$i];$ending=$ending_plural_list[$i];}else if((@mysql_num_rows($COUNT)>0) && (@mysql_num_rows($COUNT)<2)){$item=$item_single_list[$i];$connector=$connector_single_list[$i];$ending=$ending_single_list[$i];}else{$item=$item_plural_list[$i];$connector=$connector_plural_list[$i];$ending=$ending_plural_list[$i];}
					/* CUSTOM QUERIES GO IN HERE */
					@$THEBLOG_BLOGCATEGORIES_GET_CAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_categories WHERE name LIKE '%$searchQuery%'");
					@$THEBLOG_BLOGCATEGORIES_FETCH_CAT=mysql_fetch_array($THEBLOG_BLOGCATEGORIES_GET_CAT);
					@$theblog_blogcategories_id_of_cat=$THEBLOG_BLOGCATEGORIES_FETCH_CAT['id'];
					$where_clause_ind=str_replace("(id_of_cat)",$theblog_blogcategories_id_of_cat,$where_clause_ind);
					/* CUSTOM QUERIES GO IN HERE */
					
					$query="SELECT * FROM {$properties->DB_PREFIX}".$search_this_ind." WHERE ".$where_clause_ind." ORDER BY ".$order_by_ind."";
					$GET_ITEM=mysql_query($query);
					$total_results+=mysql_num_rows($GET_ITEM);
					if(mysql_num_rows($GET_ITEM)<1){
						/* NO ITEMS FOUND */
						echo "<h2>".mysql_num_rows($GET_ITEM)." {$item} {$connector} &quot;{$searchQuery}&quot;{$ending}</h2>";
					} else {
						echo "<h2><a id=\"search_container_link_".$NUM_."_".str_replace(" ","_",$item_id_list[$i])."\" class=\"black-url-no-underline\" style=\"cursor:pointer;\" onclick=\"searchToggle('Expand',".$NUM_.",'".str_replace(" ","_",$item_id_list[$i])."')\">[+]</a> ".mysql_num_rows($GET_ITEM)." {$item} {$connector} &quot;{$searchQuery}&quot;{$ending}</h2>";
						echo "<div id=\"search_container_contents_".$NUM_."_".str_replace(" ","_",$item_id_list[$i])."\" style=\"display:none;\">";
						while($FETCH_ITEM=mysql_fetch_array($GET_ITEM)){
							/* CHECK TO SEE IF THE ITEM IS SEARCHABLE */
							if($FETCH_ITEM['is_searchable'] == "no"){
								/* NOT SEARCHABLE */
								if(mysql_num_rows($GET_ITEM)<1){$privacy_connector="this";$privacy_results="results";$privacy_ending="has";}else if((mysql_num_rows($GET_ITEM)>0) && (mysql_num_rows($GET_ITEM)<2)){$privacy_connector="this";$privacy_results="result";$privacy_ending="has";}else if(mysql_num_rows($GET_ITEM)>1){$privacy_connector="this";$privacy_results="results";$privacy_ending="has";}
								echo "<h2>Your search matched ".mysql_num_rows($GET_ITEM)." {$privacy_results}, however {$privacy_connector} ".$item_single_list[$i]." {$privacy_ending} choosen to hide their profile information from our search. :(</h2>";
							} else {
								/* FOUND ITEMS; DISPLAY THEM */
								$query="SELECT * FROM {$properties->DB_PREFIX}search_chapters_items WHERE item_id='$item_id_list[$i]' AND chapter_id='$chapter_id_list[$i]'";
								$GET_ITEM_CONTENTS=mysql_query($query);
								if(mysql_num_rows($GET_ITEM_CONTENTS)<1){
									echo $query;
									echo "Sorry! Something is missing!<br />";	
								} else {
									$FETCH_ITEM_CONTENTS=mysql_fetch_array($GET_ITEM_CONTENTS);
									echo eval($FETCH_ITEM_CONTENTS['content']);
								}
								/* END FOUND ITEMS; DISPLAY THEM */
							}
						}
						echo "</div>";
					}	
					
				}
				echo "<br />";
			}
		}
		
		echo "<br />";
		/* END DYNAMICALLY LOAD IN THE SEARCH CHAPTERS */		
		@$total_ending="";
		if($total_results < 1){$total_ending="s";}
		if(($total_results > 0) && ($total_ending < 2)){$total_ending="";}
		if($total_results > 1){$total_ending="s";}
		echo "<h1 class=\"searching-text-h1\">Searching &quot;{$searchQuery}&quot; gave {$total_results} result{$total_ending}</h1>";
	}
	//close up the div to put all the stuff in
	echo "</div>";
}
function CHECK_EMAIL($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,$message_indicator,$to,$PADINFO,$pname_uri){
	//access all the variables needed
	global $comment_id;
	global $yname;
	global $b_year;
	global $b_month;
	global $b_day;
	global $pname_title;
	global $webmaster_title;
	global $comment_ticket_id;
	global $EXTRA_NAME;
	global $poc_name;
	global $reason_name;
	global $dateandtime;
	global $ymessage;
	global $ticket_id;
	global $FORMNAME;
	global $event_name;
	global $username;
	global $password;
	global $full_pin;
	global $fname;
	global $lname;
	global $typeofuser;
	
	$to=$to;
	
	//get the message by message_indicator from the db
	$GET_MI=mysql_query("SELECT * FROM {$properties->DB_PREFIX}cers_messages WHERE message_indicator='".$message_indicator."'");
	$FETCH_MI=mysql_fetch_array($GET_MI);
	$subject=$FETCH_MI['subject'];
	$message=$FETCH_MI['content'];
	
	//interpret subject
	$subject=str_replace("(WEBSITE_URL_NAME)",$properties->WEBSITE_NAME.$properties->WEBSITE_EXT,$subject);
	$subject=str_replace("(EXTRA_NAME)",$EXTRA_NAME,$subject);
	$subject=str_replace("(EVENT_NAME)",$event_name,$subject);
	$subject=str_replace("(TYPE_OF_USER)",$typeofuser,$subject);
		
	//interpret message
	$message=str_replace("(FNAME)",$fname,$message);
	$message=str_replace("(LNAME)",$lname,$message);
	//special implementation as of 3.9.1
	/* DETERMINE THE WEBSITE_URL */
	if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}
	$message=str_replace("(WEBSITE_URL)",$WEBSITE_URL,$message);
	$message=str_replace("(COMMENT_ID)",$comment_id,$message);
	$message=str_replace("(WEBSITE_URL_NAME)",$properties->WEBSITE_NAME.$properties->WEBSITE_EXT,$message);
	$message=str_replace("(TO_WHOM_IT_MAY_CONCERN)",$yname,$message);
	$message=str_replace("(PNAME_URI)",$pname_uri,$message);
	$message=str_replace("(PADINFO)",$PADINFO,$message);
	$message=str_replace("(PNAME_TITLE)",$pname_title,$message);
	$message=str_replace("(PNAME_TITLE_SAFE)",converter($properties,$pname_title,'url','to'),$message);
	$message=str_replace("(B_YEAR)",$b_year,$message);
	$message=str_replace("(B_MONTH)",$b_month,$message);
	$message=str_replace("(B_DAY)",$b_day,$message);
	$message=str_replace("(COMMENT_TICKET_ID)",$comment_ticket_id,$message);
	$message=str_replace("(PADMAIN)",$properties->PADMAIN,$message);
	$message=str_replace("(POC_NAME)",$poc_name,$message);
	$message=str_replace("(REASON_NAME)",$reason_name,$message);
	$message=str_replace("(DATEANDTIME)",$dateandtime,$message);
	$message=str_replace("(YMESSAGE)",$ymessage,$message);
	$message=str_replace("(TICKET_ID)",$ticket_id,$message);
	$message=str_replace("(FORMNAME)",$FORMNAME,$message);
	$message=str_replace("(EXTRA_NAME)",$EXTRA_NAME,$message);
	$message=str_replace("(EVENT_NAME)",$event_name,$message);
	$message=str_replace("(USERNAME)",$username,$message);
	$message=str_replace("(PASSWORD)",$password,$message);
	$message=str_replace("(FULL_PIN)",$full_pin,$message);
	
	
	//get the headwebmaster's title
	$GET_HW_TITLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE is_webmaster='yes'");
	$FETCH_HW_TITLE=mysql_fetch_array($GET_HW_TITLE);
	$staff_type=$FETCH_HW_TITLE['staff_type'];
	$how_to_display_name=$FETCH_HW_TITLE['how_to_display_name'];
	if($how_to_display_name=="full"){$webmaster_name=$FETCH_HW_TITLE['fname']." ".$FETCH_HW_TITLE['lname'];}else if($how_to_display_name=="only first name"){$webmaster_name=$FETCH_HW_TITLE['fname'];}else if($how_to_display_name=="only username"){$webmaster_name=$FETCH_HW_TITLE['uname'];}
	
	//fetch the staff type name
	$GET_TITLE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='{$staff_type}'");
	$FETCH_TITLE_NAME=mysql_fetch_array($GET_TITLE_NAME);
	$webmaster_title=$FETCH_TITLE_NAME['name'];
	
	$message=str_replace("(WEBMASTER_TITLE)",$webmaster_title,$message);
	$message=str_replace("(COMPANY_NAME)",$properties->COMPANY_NAME,$message);	
	$message=str_replace("(AUTORESPONDER_CLOSING_LINE)",getGlobalVars($properties,'autoresponder_closing_line'),$message);
	$message=str_replace("(WEBMASTER_NAME)",$webmaster_name,$message);
		
	$headers="From: ". getGlobalVars($properties,'webmaster_email') . "\r\n" .
			 "MIME-Version: 1.0" . "\r\n" .
			 "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
			 "Reply-To: ".getGlobalVars($properties,'webmaster_email') . "\r\n" .
			 "X-Mailer: PHP/" . phpversion();
			 									 
	if($_SERVER['HTTP_HOST']==$properties->HTTP_HOST){/* on localhost; do not send because i have no email system set up on localhost and it will give errors */echo "<b>[OUTPUT MESSAGE]</b> Due to the type of system being used (localhost) we have shut off the email sending function because of lack of ability to send emails on this server. Instead, here is the outputted message of the email you just &quot;Sent&quot;:<br /><br />To: {$to}<br />Subject: {$subject}<br />Message: {$message}<br />Headers: {$headers}<br /><b>[/OUTPUT MESSAGE]</b>";}else{mail($to,$subject,$message,$headers);}
}

function Theme($properties,$action,$ip,$SESSIONID){
	require("includes/private/attributes/logged_session.php");
	include("conf/connect.php");
	switch($action){
		case 'getDefaultThemeID':
			return getGlobalVars($properties,'defaultThemeID');
		break;
		
		case 'getCurrThemeNameTemp':
			$GET_CURRENT_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip='$ip' AND temp_session='$SESSIONID'") or die(mysql_error());
			if(mysql_num_rows($GET_CURRENT_THEME)<1){
				/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */	
			} else {
				while($FETCH_CURRENT_THEME=mysql_fetch_array($GET_CURRENT_THEME)){
					$themeID=$FETCH_CURRENT_THEME['themeID'];
					// now go to themes and select the name
					$GET_THEME_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE id='$themeID'");
					if(mysql_num_rows($GET_THEME_NAME)<1){
						/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */
					} else {
						while($FETCH_THEME_NAME=mysql_fetch_array($GET_THEME_NAME)){
							$themeNAME=$FETCH_THEME_NAME['name'];
							return $themeNAME;
						}
						
					}
				}				
			}
		break;
		
		case 'getCurrThemeNameUser':
			$GET_CURRENT_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'") or die(mysql_error());
			if(mysql_num_rows($GET_CURRENT_THEME)<1){
				/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */	
			} else {
				while($FETCH_CURRENT_THEME=mysql_fetch_array($GET_CURRENT_THEME)){
					$themeID=$FETCH_CURRENT_THEME['themeID'];
					// now go to themes and select the name
					$GET_THEME_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE id='$themeID'");
					if(mysql_num_rows($GET_THEME_NAME)<1){
						/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */
					} else {
						while($FETCH_THEME_NAME=mysql_fetch_array($GET_THEME_NAME)){
							$themeNAME=$FETCH_THEME_NAME['name'];
							return $themeNAME;
						}
						
					}
				}				
			}
		break;
		
		case 'getThemeID':
		
		break;
		
		case 'checkNewlyInstalled':
			/* REGULAR CHECK FOR THEMES */
			if(file_exists("themes/")){
				/* GOOD TO GO; CHECK FOR FOLDERS */
				$directories=array_diff(scandir("themes"),array('.', '..','.DS_STORE','exempt','setup')); // this specifies what to get and what not to get
				foreach($directories as $directory){
					//check to see if there are any changes to the themes/ folder and db (make sure they match)
					//get the list of themes in an array
					$GET_ALL_THEMES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes ORDER BY id");
					if(mysql_num_rows($GET_ALL_THEMES)<1){
						//no themes
						$error_console="There are no themes";
					} else {
						//normal
						@$themesList="";
						while($FETCH_ALL_THEMES=mysql_fetch_array($GET_ALL_THEMES)){
							$themesList.=",".$FETCH_ALL_THEMES['name'];
						}
						//explode the themesList
						$themesListList=explode(",",$themesList);
						for($i=0; $i<count($themesListList); $i++){
							if(file_exists("themes/".$themesListList[$i])){
								/* THEME @ $i EXISTS */
								continue;				
							} else {
								/* THEME @ $i DOES NOT EXIST; DELETE FROM DB */
								mysql_query("DELETE FROM {$properties->DB_PREFIX}themes WHERE name='".$themesListList[$i]."'");
							}
						}
					}
					
					/* SEE IF DIRECTORY EXISTS IN THEMES TABLE */
					$CHECK_FOR_THEME_IN_TABLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE name='".$directory."'");
					if(mysql_num_rows($CHECK_FOR_THEME_IN_TABLE)<1){
						/* THEME DOES NOT EXIST; NEW THEME; PUT IN TABLE */
						$directory_pretty_name=str_replace(" ","_",$directory);
						//read the n4ml file for the properties of the theme
						if(file_exists("themes/".$directory."/props.n4ml")){
							/* FILE IS PRESENT */
							/* NOW READ THE CONTENTS */
							$props_filename="themes/".$directory."/props.n4ml";
							$props_handle=fopen($props_filename, "r");
							$props_contents=fread($props_handle,filesize($props_filename));
							
							/* NOW INTERPRET */
							$param_type=substr($props_contents,0,strpos($props_contents,":"));
							$param_endrun=substr($props_contents,strpos($props_contents,":")+1);
						} else {
							/* NOT THERE */	
						}
						$type=$param_type;
						$endrun=$param_endrun;
						mysql_query("INSERT INTO {$properties->DB_PREFIX}themes (name,pretty_name,type,endrun) VALUES ('".$directory."','".$directory_pretty_name."','".$type."','".$endrun."')") or die(mysql_error());
						return;
					} else {
						/* THEME EXISTS; DONT DO ANYTHING */
						continue;
					}
				}
			} else {
				/* UM...WHY IS THE THEMES/ DIRECTORY NOT THERE?; DONT DO ANYTHING */
				continue;
			}
		break;
	}
}
function ThemeInside($properties,$action,$ip,$SESSIONID){
	require("../includes/private/attributes/logged_session.php");
	include("../conf/connect.php");
	switch($action){
		case 'getDefaultThemeID':
			return getGlobalVars($properties,'defaultThemeID');
		break;
		
		case 'getCurrThemeNameTemp':
			$GET_CURRENT_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip='$ip' AND temp_session='$SESSIONID'") or die(mysql_error());
			if(mysql_num_rows($GET_CURRENT_THEME)<1){
				/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */	
			} else {
				while($FETCH_CURRENT_THEME=mysql_fetch_array($GET_CURRENT_THEME)){
					$themeID=$FETCH_CURRENT_THEME['themeID'];
					// now go to themes and select the name
					$GET_THEME_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE id='$themeID'");
					if(mysql_num_rows($GET_THEME_NAME)<1){
						/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */
					} else {
						while($FETCH_THEME_NAME=mysql_fetch_array($GET_THEME_NAME)){
							$themeNAME=$FETCH_THEME_NAME['name'];
							return $themeNAME;
						}
						
					}
				}				
			}
		break;
		
		case 'getCurrThemeNameUser':
			$GET_CURRENT_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'") or die(mysql_error());
			if(mysql_num_rows($GET_CURRENT_THEME)<1){
				/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */	
			} else {
				while($FETCH_CURRENT_THEME=mysql_fetch_array($GET_CURRENT_THEME)){
					$themeID=$FETCH_CURRENT_THEME['themeID'];
					// now go to themes and select the name
					$GET_THEME_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE id='$themeID'");
					if(mysql_num_rows($GET_THEME_NAME)<1){
						/* UM...SOME INJECTION THING IS HAPPENING...HACKERS */
					} else {
						while($FETCH_THEME_NAME=mysql_fetch_array($GET_THEME_NAME)){
							$themeNAME=$FETCH_THEME_NAME['name'];
							return $themeNAME;
						}
						
					}
				}				
			}
		break;
		
		case 'getThemeID':
		
		break;
		
		case 'checkNewlyInstalled':
			/* REGULAR CHECK FOR THEMES */
			if(file_exists("themes/")){
				/* GOOD TO GO; CHECK FOR FOLDERS */
				$directories=array_diff(scandir("themes"),array('.', '..','.DS_STORE','exempt','setup')); // this specifies what to get and what not to get
				foreach($directories as $directory){
					//check to see if there are any changes to the themes/ folder and db (make sure they match)
					//get the list of themes in an array
					$GET_ALL_THEMES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes ORDER BY id");
					if(mysql_num_rows($GET_ALL_THEMES)<1){
						//no themes
						$error_console="There are no themes";
					} else {
						//normal
						@$themesList="";
						while($FETCH_ALL_THEMES=mysql_fetch_array($GET_ALL_THEMES)){
							$themesList.=",".$FETCH_ALL_THEMES['name'];
						}
						//explode the themesList
						$themesListList=explode(",",$themesList);
						for($i=0; $i<count($themesListList); $i++){
							if(file_exists("themes/".$themesListList[$i])){
								/* THEME @ $i EXISTS */
								continue;				
							} else {
								/* THEME @ $i DOES NOT EXIST; DELETE FROM DB */
								mysql_query("DELETE FROM {$properties->DB_PREFIX}themes WHERE name='".$themesListList[$i]."'");
							}
						}
					}
					
					/* SEE IF DIRECTORY EXISTS IN THEMES TABLE */
					$CHECK_FOR_THEME_IN_TABLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE name='".$directory."'");
					if(mysql_num_rows($CHECK_FOR_THEME_IN_TABLE)<1){
						/* THEME DOES NOT EXIST; NEW THEME; PUT IN TABLE */
						$directory_pretty_name=str_replace(" ","_",$directory);
						//read the n4ml file for the properties of the theme
						if(file_exists("themes/".$directory."/props.n4ml")){
							/* FILE IS PRESENT */
							/* NOW READ THE CONTENTS */
							$props_filename="themes/".$directory."/props.n4ml";
							$props_handle=fopen($props_filename, "r");
							$props_contents=fread($props_handle,filesize($props_filename));
							
							/* NOW INTERPRET */
							$param_type=substr($props_contents,0,strpos($props_contents,":"));
							$param_endrun=substr($props_contents,strpos($props_contents,":")+1);
						} else {
							/* NOT THERE */	
						}
						$type=$param_type;
						$endrun=$param_endrun;
						mysql_query("INSERT INTO {$properties->DB_PREFIX}themes (name,pretty_name,type,endrun) VALUES ('".$directory."','".$directory_pretty_name."','".$type."','".$endrun."')") or die(mysql_error());
						return;
					} else {
						/* THEME EXISTS; DONT DO ANYTHING */
						continue;
					}
				}
			} else {
				/* UM...WHY IS THE THEMES/ DIRECTORY NOT THERE?; DONT DO ANYTHING */
				continue;
			}
		break;
	}
}
function admaker($properties,$ADID,$ADTYPE,$ADURL,$ADTARGET,$ADIMGLOCATION,$ADIMGBORDER,$ADIMGALT,$ADIMGWIDTH,$ADIMGHEIGHT,$ADIMGALIGN){
	if(getGlobalVars($properties,"display_admaker") == "yes"){
		switch($ADTYPE){
			case 'top':
				//update amount of times displayed	
				if($ADID=="0000"){/* NOT AN AD */}else{mysql_query("UPDATE {$properties->DB_PREFIX}modules_ads SET times_displayed=times_displayed+1 WHERE id='$ADID'");}
										
				if($ADIMGBORDER=="on"){$ADIMGBORDER=1;}else if($ADIMGBORDER=="off"){$ADIMGBORDER=0;}
				$output="<a href=\"".$ADURL."\" target=\"".$ADTARGET."\"><img src=\"".$ADIMGLOCATION."\" align=\"".$ADIMGALIGN."\" border=".$ADIMGBORDER." width=\"".$ADIMGWIDTH."\" height=\"".$ADIMGHEIGHT."\" alt=\"".$ADIMGALT."\" onmouseover=\"fade('up') onmouseout=\"fade('down')\"\"></a>";	
				return $output;
			break;
		}
	} else {
		/* NO ADMAKER */
	}
}

function convertSafeNumber($NUM){
	if($NUM>999999999999999){$NUM=round($NUM / 1000000000000000,1) . "Q";}
	if($NUM>999999999999){$NUM=round($NUM / 1000000000000,1) . "Tril";}
	if($NUM>999999999){$NUM=round($NUM / 1000000000,2) . "Bil";}
	if($NUM>999999){$NUM=round($NUM / 1000000,2) . "M";}
	if($NUM>9999){$NUM=round($NUM / 1000,2) . "K";}	
	return $NUM;
}

function getReturnURL(){
	/* THE MAKING OF THE RETURN URL */
	$RETURN_URL=@$_SERVER['HTTP_REFERER'];
	if((strpos("blog",$RETURN_URL)!="-1") || (strpos("a-z-list-reviews",$RETURN_URL)!="-1")){
		/* BLOG PAGE */
		/* GET THE GETS */
		if(isset($_GET['meta'])){
			/* META IS SET */
			$meta=$_GET['meta'];
			$RETURN_URL.="/".$meta;
		}
		
		if(isset($_GET['year'])){
			/* YEAR IS SET */
			$year=$_GET['year'];
			$RETURN_URL.="/".$year;
		}
		
		if(isset($_GET['month'])){
			/* MONTH IS SET */
			$month=$_GET['month'];
			$RETURN_URL.="/".$month;
		}
		
		if(isset($_GET['day'])){
			/* YEAR IS SET */
			$day=$_GET['day'];
			$RETURN_URL.="/".$day;
		}
		
		if(isset($_GET['title'])){
			/* TITLE IS SET */
			$title=$_GET['title'];
			$RETURN_URL.="/".$title;
		}
		
		/*if(strpos("#top",$RETURN_URL)!="-1"){
			/* #TOP IS SET */
			//$RETURN_URL.="#top";
		//}
	}	
	return $RETURN_URL;
}

function runAchievementCheck($action,$properties,$uid,$weburl){	
	global $launchpad;
	$PADINFO=$launchpad;
	include("conf/connect.php");
	$GET_ACTION_CONTENT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}achievement_check_actions WHERE action='".$action."'") or die(mysql_error());
	if(mysql_num_rows($GET_ACTION_CONTENT)<1){
		/* NOT THERE */
		echo "Something went wrong!";
	} else {
		while($FETCH_ACTION_CONTENT=mysql_fetch_array($GET_ACTION_CONTENT)){
			$content=$FETCH_ACTION_CONTENT['content'];					
		}
		eval($content);
	}
}
?>