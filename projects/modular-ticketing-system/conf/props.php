<?php
/* MODULAR TICKETING SYSTEM (MTS) CORE CONFIGURATION */
/* MTS WAS DEVELOPED AND DEBUGGED BY NATHAN SMYTH AND IS AVAILABLE TO BE USED AS A FREEWARE */
/* SOFTWARE BY ANYONE WHO CAN DECYFER THE CODE.

/* PLEASE LEAVE THIS COPYRIGHT OWNERSHIP INFO INTACT AS YOU USE THIS PIECE OF WEB SOFTWARE    */
/* ---------------------------- END OWNERSHIP INFO ------------------------------------------ */

//main variables
class properties 
{
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//       MTS v. 1.0 - Editables - These are all what you need to customize this website to your liking
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
	//property declaration	
	//main variables
	public $COMPANY_NAME 		 			 = 'Nat4an Corp';
	public $PLATFORM 			 			 = 'Mind Power';
	public $TITLE_B4_PLATFORM 	 			 = " - powered by "; //item found before the platform on title
	public $TITLE_AFTER_PLATFORM 			 = " v. "; //item found after the platform on title
	public $VERSION_CTRL 		 			 = '1.0';
	public $WEBSITE_NAME 		 			 = 'Nat4an';
	public $WEBSITE_SLOGAN					 = 'Modular Ticketing System';	
	public $FORM_TITLE						 = 'Modular Ticket System using FormLayout CSS';
	public $WURL							 = 'http://localhost//projects/modular-ticketing-system/';
	//SEO STUFF
	public $SITE_DESCRIPTION				 = 'A PHP Ticketing System that you can use to slap into your current site to be used as a contact page or a comment form or what ever else you want to use a ticketing system for. This ticketing system is completely modular, meaning all you have to do is slap it on and change the parameters to fix your configuration. It comes with a generic formLayout CSS Style that can be change via a console into any theme placed in the themes folder, delivers nice autoresponse email notifications to the email of your choice, and you can supply any number and any values of inputs/selects/options/buttons/labels. If you need an autoresponder and don\'t wanna build one, use MTS! If you need a nice comment form for your blog, use MTS! If you need to allow people to contact you, use MTS! MTS also allows users who submit a ticket to have a unique ticket number that they get in an email and they can use to check the status of a ticket. Don\'t remember your ticket number? No worries! MTS also accepts emails as a method of checking the status. There is no limit to what you can do with MTS!';
	public $SITE_AUTHOR					 	 = 'Nathan Smyth';
	public $SITE_KEYWORDS					 = 'mts,modular ticketing system,php,modular,cms ticketing,system,comments,autoresponder,email,form'; 
											   /* THIS IS FOR THE DEFAULT KEYWORDS THAT LOAD INTO THE HOME PAGES. IN ORDER */
											   /* TO CUSTOMIZE THE INDIVIDUAL PAGE KEYWORDS PUT IT INTO THE DB. */
											   /* DO NOT END THIS WITH A "," OR ELSE YOU WILL BREAK IT! */
	//Variable Properties for MP
	public $PROPS_VAR_BODYSB_WRAP_START		 = '<div class="props-var-body-wrap">';
	public $PROPS_VAR_BODYSB_WRAP_END		 = '</div>';
	//database stuff
	public $DB_HOST							 = 'localhost';
	public $DB_USER							 = 'root'; //remote: "mrnat4an_project" or local: "root"
	public $DB_PASS							 = ''; //remote: "T7VSRyk@pTn9" or local: ""
	public $DB_NAME							 = 'mrnat4an_mts';
	public $DB_PREFIX						 = 't_';
	
	//main-page-elements
	
	//main-page-title
	public $MAIN_TITLE			 			 = 'Nat4an';
	public $MAIN_TITLE_ALIGN	 			 = 'l'; //l = left; c = center; r = right
	
	//main-page-slogan
	public $MAIN_SLOGAN			 			 = '';
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
	
	//define pad names
	public $PADMAIN							= 'portfolio'; /* YOU CAN CHANGE THE OTHER PADS EXCEPT THIS ONE; WILL  */
	public $PAD1							= 'af';
	public $PAD2							= 'gf';
	public $PAD3							= 'tmm';
	public $PAD4							= 'ln';
	
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
		$GET_SEARCH_CHAPTERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}search_chapters WHERE is_searchable='yes' ORDER BY name");
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
?>