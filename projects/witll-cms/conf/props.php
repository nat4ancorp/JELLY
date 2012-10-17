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

//main non-class variables
//GLOBAL VARIABLES THAT CAN BE CHANGED
$globalvars_passpage_title			= "<h1 style=\"font-size:62px;text-align:center;position:relative;top:10px;\" class=\"header\" onclick=\"window.location.href='http://localhost/projects/witll-cms'\">WITLL.NET</h1>"; /* local: localhost/projects/witll-cms remote: witll.net */
$globalvars_passpage_slogan			= "<h2 style=\"font-size:48px;text-align:center;position:relative;top:10px;\">Welcome to Witllacity!</h2>";
$globalvars_passpage_closed_st		= "<h2 style=\"font-size:48px;text-align:center;position:relative;top:10px;\">(Closed)</h2>";
$globalvars_passpage_closedbeta_st	= "<h2 style=\"font-size:48px;text-align:center;position:relative;top:10px;\">(Closed BETA)</h2>";

//main variables
class properties 
{
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//       MindPower v. 3.4 - Editables - These are all what you need to customize this website to your liking
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
	//property declaration	
	//main variables
	public $COMPANY_NAME 		 			 = 'Project Witllacity';
	public $PLATFORM 			 			 = 'Mind Power';
	public $TITLE_B4_PLATFORM 	 			 = " - powered by "; //item found before the platform on title
	public $TITLE_AFTER_PLATFORM 			 = " v. "; //item found after the platform on title
	public $VERSION_CTRL 		 			 = '3.7';
	public $WEBSITE_NAME 		 			 = 'WITLL';
	public $WEBSITE_EXT 		 			 = '.NET';
	public $WEBSITE_SLOGAN					 = 'A Web Interface To Learn &amp; to Love';
	public $FULL_WURL						 = 'http://localhost/projects/witll-cms/';
	public $WEBSITE_URL			 			 = 'http://localhost/projects/witll-cms/';
	public $STYLESHEET						 = 'witllacity'; /* default: nat4an; alt: creativity */
	public $TURN_ON_BOTTOM_NAV				 = 'yes'; /* DO NOT USE THIS ATM */
	public $TURN_ON_TOP_NAV					 = 'yes'; /* DO NOT USE THIS ATM */
	public $DEFAULT_SEARCH_TEXT_PADMAIN		 = 'Search My Website...';
	public $DEFAULT_SEARCH_TEXT_PAD1		 = 'Search...';
	public $DEFAULT_SEARCH_TEXT_PAD2		 = 'Search...';
	public $DEFAULT_SEARCH_TEXT_PAD3		 = 'Search...';
	public $DEFAULT_SEARCH_TEXT_PAD4		 = 'Search...';
	
	public $SERVER_LOCATION					 = 'America/Mexico_City'; /* for a list of locations, see here -> 
																	     http://www.php.net/manual/en/timezones.php */
	
	//SEO STUFF
	public $SITE_DESCRIPTION				 = 'An on-going project that was created to be a Web Interface To Learn and to Love. This is my first official attempt at creating a CMS that everyone will love! WITLL is a CMS that is purely driven by database and brilliantly written PHP code.It\'s an engine that you can basically take and build any other website off of it. It cuts out the base work that comes with building a website. It\'s not another Wordpress. It\'s a fully customizable (even more than wordpress) CMS that is rock solid and SEO Optimized.';
	public $SITE_AUTHOR					 	 = 'Nathan Smyth';
	public $SITE_KEYWORDS					 = 'web design,nathan smyth,witll,cms,web interface to learn and to love,cool,designed,mp,mind power,website,platform,php'; 
											   /* THIS IS FOR THE DEFAULT KEYWORDS THAT LOAD INTO THE HOME PAGES. IN ORDER */
											   /* TO CUSTOMIZE THE INDIVIDUAL PAGE KEYWORDS PUT IT INTO THE DB. */
											   /* DO NOT END THIS WITH A "," OR ELSE YOU WILL BREAK IT! */
	//Variable Properties for MP
	public $PROPS_VAR_BODYSB_WRAP_START		 = '<div class="props-var-body-wrap">';
	public $PROPS_VAR_BODYSB_WRAP_END		 = '</div>';
	//database stuff
	public $DB_HOST							 = 'localhost';
	public $DB_USER							 = 'root'; //remote: "mrnat4an_master" or local: "root"
	public $DB_PASS							 = ''; //remote: "T7VSRyk@pTn9" or local: ""
	public $DB_NAME							 = 'mrnat4an_witll';
	public $DB_PREFIX						 = 'h_';
	
	//main-page-elements
	
	//main-page-title
	public $MAIN_TITLE			 			 = 'WITLL.NET';
	public $MAIN_TITLE_ALIGN	 			 = 'l'; //l = left; c = center; r = right
	
	//main-page-slogan
	public $MAIN_SLOGAN			 			 = 'A Web Interface To Learn &amp; to Love';
	public $MAIN_SLOGAN_EXTRA_PAD1 			 = '';
	public $MAIN_SLOGAN_EXTRA_PAD2 			 = '';
	public $MAIN_SLOGAN_EXTRA_PAD3 			 = '';
	public $MAIN_SLOGAN_EXTRA_PAD4 			 = '';
	public $MAIN_SLOGAN_ALIGN	 			 = 'l'; //l = left; c = center; r = right
	
	//header-right-side-content
	public $HEADER_RIGHT_SIDE_CONTENT 		 = '';
	public $HEADER_RIGHT_SIDE_CONTENT_ALIGN	 = 'c'; //l = left; c = center; r = right
	
	//topnav-right-side-content
	public $TN_RIGHT_SIDE_CONTENT	 		 = ''; /* THIS IS NOT USED ATM */
	public $TN_RIGHT_SIDE_CONTENT_ALIGN		 = 'l'; //l = left; c = center; r = right
	
	//specify pad amount
	public $PAD_AMOUNT						 = 1;
	
	//define pad names
	public $PADMAIN							 = 'witllacity'; /* YOU CAN CHANGE THE OTHER PADS EXCEPT THIS ONE; WILL  */
	public $PAD1							 = '';
	public $PAD2							 = '';
	public $PAD3							 = '';
	public $PAD4							 = '';
	
	//session variable names
	public $_COOKIE_INIT_SESSION			 = 'witll_beta_session';
	
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
//       DO NOT EDIT BELOW THIS OR ELSE YOU WILL BREAK IT!!! :)
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
		
	//method declaration
	//title
	public function displayCName(){
		echo $this->COMPANY_NAME;
	}
	public function displayPlatform(){
		echo $this->PLATFORM;
	}
	public function displayTitleB4Platform(){
		echo $this->TITLE_B4_PLATFORM;
	}
	public function displayTitleAfterPlatform(){
		echo $this->TITLE_AFTER_PLATFORM;
	}
	public function displayVersion(){
		echo $this->VERSION_CTRL;
	}	
	public function displayWName(){
		echo $this->WEBSITE_NAME;
	}
	public function displayWURL(){
		echo $this->WEBSITE_URL;
	}
	public function getWURL(){
		return $this->WEBSITE_URL;
	}
	public function getFULLWURL(){
		return $this->FULL_WURL;
	}
	public function getFULLCURL(){
		return $this->FULL_CURL;
	}
	
	//main-page-elements
	
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
function getPageContents($launchpadID,$page,$subpage,$wurl,$launchpadPN,$properties){
	$ip=$_SERVER['REMOTE_ADDR'];
	$logged_session=$_COOKIE['nat4an_beta_session'];
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
		$GET_REAL_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE name='$projectname'");
		$FETCH_REAL_NAME=mysql_fetch_array($GET_REAL_NAME);
		@$real_name=$FETCH_REAL_NAME['name'];
		$CHECK_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE name='$real_name'");		
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
		case '_INIT':
			$ipaddress=$_SERVER['REMOTE_ADDR'];
			include 'conf/connect.php';
			$GET_TEMP_BY_IP=mysql_query("SELECT * FROM {$properties->DB_PREFIX}tempsystem WHERE ip=\"".$ipaddress."\"");
			if(mysql_num_rows($GET_TEMP_BY_IP)<1){
				/* Temp User is not found; put a temp user in */				
				mysql_query("INSERT INTO h_tempsystem(ip,lptoggle) VALUES('".$ipaddress."', '1')") or die(mysql_error());
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
				mysql_query("UPDATE h_tempsystem SET lptoggle='".$setValue."' WHERE ip='".$ipaddress."'") or die(mysql_error());
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

function SEARCH($properties,$searchQuery){
	include 'conf/connect.php';
	@$launchpad=$_GET['launchpad'];	
	@$total_results=0;
	@$not_allowed=0;
	@$o_not_allowed=0;
	@$not_allowed_list="";
	@$o_not_allowed_list="";
	
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
		echo "<h2>Hey! You're not allow to search for &quot;{$searchQuery}&quot;!</h2>";
		echo "<p><u>Why am I seeing this?</u><br />Because our system is built to store pages (HTML/PHP) in a database and load them in dynamically. These pages have regular HTML (and some PHP) markup on them. This is a much more secure way to store info and it is a heck of a lot easier way to manipulate this website.<br /><br />However, this method comes at a cost and that cost is the search-ability of words, symbols, or phrases, like &quot;{$searchQuery}&quot;. The reason we do this is because this is one more way to prevent hacking on this website. What could I do if I search something that pulled up a page with markup language on it? You could be able to know where pages are (structures), find the ends and outs of this site, and may even be able to hack us. :(<br /><br />If you believe this is a mistake, or you don't like the way we do things on this site, you could turn around and leave this site (which we highly recommend not doing...:)) or contact us <a href=\"".$properties->WEBSITE_URL.$properties->PADMAIN."/contact\" class=\"black-url\">here</a>.</p>";
	} else if($o_not_allowed == 1){
		echo "<h2>Hey! You're not allow to search for &quot;{$searchQuery}&quot;!</h2>";
		echo "<p><u>Why am I seeing this?</u><br />Because the word or phrase &quot;{$searchQuery}&quot; you search for is not a nice word and it directly violates our Terms of Service.<br /><br />If you believe this is a mistake, or you don't like the way we do things on this site, you could turn around and leave this site (which we highly recommend not doing...:)) or contact us <a href=\"".$properties->WEBSITE_URL.$properties->PADMAIN."/contact\" class=\"black-url\">here</a>.</p>";
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
				echo "<h1>".$name."</h1>";				
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
		echo "<h1 style=\"color: #ccc;line-height:1.2em;\">Searching &quot;{$searchQuery}&quot; gave {$total_results} result{$total_ending}</h1>";
	}
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

function CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,$message_indicator,$to,$PADINFO,$pname_uri){
	//access all the variables needed
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
	$message=str_replace("(WEBSITE_URL)",$properties->WEBSITE_URL,$message);
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
			 									 
	if($_SERVER['HTTP_HOST']=="localhost"){/* on localhost; do not send because i have no email system set up on localhost and it will give errors */echo "<b>[OUTPUT MESSAGE]</b> Due to the type of system being used (localhost) we have shut off the email sending function because of lack of ability to send emails on this server. Instead, here is the outputted message of the email you just &quot;Sent&quot;:<br /><br />To: {$to}<br />Subject: {$subject}<br />Message: {$message}<br />Headers: {$headers}<br /><b>[/OUTPUT MESSAGE]</b>";}else{mail($to,$subject,$message,$headers);}
}
?>