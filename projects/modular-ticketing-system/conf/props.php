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
//       MTS v. 1.0 - Editables - These are all what you need to customize the MTS to your liking
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
	public $WURL							 = 'http://www.nat4an.com/projects/modular-ticketing-system/';
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
	public $DB_USER							 = 'mrnat4an_project'; //remote: "mrnat4an_project" or local: "root"
	public $DB_PASS							 = 'T7VSRyk@pTn9'; //remote: "T7VSRyk@pTn9" or local: ""
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
?>