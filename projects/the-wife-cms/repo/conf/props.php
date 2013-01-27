<?php
//main variables
class properties 
{
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//       MindPower v. 2.7 - Editables - These are all what you need to customize this website to your liking
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------
	//property declaration	
	//main variables
	public $COMPANY_NAME 		 			 = 'The WIFE';
	public $PLATFORM 			 			 = 'Mind Power';
	public $TITLE_B4_PLATFORM 	 			 = " - powered by "; //item found before the platform on title
	public $TITLE_AFTER_PLATFORM 			 = " v. "; //item found after the platform on title
	public $VERSION_CTRL 		 			 = '2.9';
	public $WEBSITE_NAME 		 			 = 'The WIFE';
	public $WEBSITE_SLOGAN					 = 'A Web Interface for Everyone';
	public $FULL_WURL						 = 'http://localhost/projects/the-wife-cms/repo/main/home';
	public $WEBSITE_URL			 			 = 'http://localhost/projects/the-wife-cms/repo/';
	public $STYLESHEET						 = 'thewife'; /* default: nat4an; alt: creativity */
	public $LAUNCH_DAY						 = '??/??/201?';
	public $TURN_ON_BOTTOM_NAV				 = 'no';
	public $TURN_ON_TOP_NAV					 = 'no';
	
	//SEO STUFF
	public $SITE_DESCRIPTION				 = 'The WIFE is a Web Interface For Everyone that is not another Wordpress and is a fully-customizable template that anyone can use. The WIFE is a full blown CMS that is built in PHP, CSS, JavaScript, and UX.';
	public $SITE_AUTHOR					 	 = 'Nathan Smyth';
	public $SITE_KEYWORDS					 = 'web design,nathan smyth,web site design,HTML,Javascript,PHP,UX,The WIFE,wife,WIFE,CMS'; 
											/* THIS IS FOR THE DEFAULT KEYWORDS THAT LOAD INTO THE HOME PAGES. IN ORDER */
											/* TO CUSTOMIZE THE INDIVIDUAL PAGE KEYWORDS PUT IT INTO THE DB. */
											/* DO NOT END THIS WITH A "," OR ELSE YOU WILL BREAK IT! */
	
	//Variable Properties for MP
	public $PROPS_VAR_BODYSB_WRAP_START			= '<div class="props-var-body-wrap">';
	public $PROPS_VAR_BODYSB_WRAP_END			= '</div>';
			
	//database stuff
	public $DB_HOST							 = 'localhost';
	public $DB_USER							 = 'root'; //remote: "mrnat4an_master" or local: "root"
	public $DB_PASS							 = ''; //remote: "thecreation101" or local: ""
	public $DB_NAME							 = 'thewife';
	public $DB_PREFIX						 = 'h_';
	
	//main-page-elements
	
	//main-page-title
	public $MAIN_TITLE			 			 = 'The WIFE';
	public $MAIN_TITLE_ALIGN	 			 = 'l'; //l = left; c = center; r = right
	
	//main-page-slogan
	public $MAIN_SLOGAN			 			 = 'A Web Interface For Everyone';
	public $MAIN_SLOGAN_EXTRA_PAD1 			 = 'is not a Template and is not another WordPress...:)';
	public $MAIN_SLOGAN_EXTRA_PAD2 			 = 'is built on a solid PHP,UX, &amp; SEO engine that will last';
	public $MAIN_SLOGAN_EXTRA_PAD3 			 = 'is fully customizable - start with the props.php and go!';
	public $MAIN_SLOGAN_EXTRA_PAD4 			 = 'outshines it\'s competitors with robust jQuery support!';
	public $MAIN_SLOGAN_ALIGN	 			 = 'l'; //l = left; c = center; r = right
	
	//header-right-side-content
	public $HEADER_RIGHT_SIDE_CONTENT 		 = '';
	public $HEADER_RIGHT_SIDE_CONTENT_ALIGN	 = 'c'; //l = left; c = center; r = right
	
	//topnav-right-side-content
	public $TN_RIGHT_SIDE_CONTENT	 		 = '';
	public $TN_RIGHT_SIDE_CONTENT_ALIGN		 = 'c'; //l = left; c = center; r = right
	
	//define pad names
	public $PADMAIN							= 'padmain';
	public $PAD1							= 'pad1';
	public $PAD2							= 'pad2';
	public $PAD3							= 'pad3';
	public $PAD4							= 'pad4';
	
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
	if($page == "home"){
		$pageKEYWORDS=$properties->SITE_KEYWORDS;
	} else {
		$CHECK_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'");
		$FETCH_PAGE=mysql_fetch_array($CHECK_PAGE);
		$pageKEYWORDS=$properties->SITE_KEYWORDS.",".$FETCH_PAGE['pageKEYWORDS'];
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
				$THENAVLIST.=" | <a id=\"selected\" href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a>";	
			}
		} else {
			if($i==0){
				$THENAVLIST.=" <a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a>";
			} else {
				$THENAVLIST.=" | <a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a>";	
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
	for($i=0; $i<count($navigation_names); $i++){
		if($navigation_surls[$i]==$page){
			$THENAVLIST.="<li class=\"active\" onclick=\"window.location.href='{$wurl}{$navigation_wurls[$i]}'\"><a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a></li>  ";
		} else {
			$THENAVLIST.="<li onclick=\"window.location.href='{$wurl}{$navigation_wurls[$i]}'\"><a href=\"{$wurl}{$navigation_wurls[$i]}\">{$navigation_names[$i]}</a></li>  ";
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
?>