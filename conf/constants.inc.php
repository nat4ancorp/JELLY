<?php
class CONSTANTS {

/* CORE APP DATA (TESTING SERVER PURPOSE) */
const HTTP_HOST 						= "localhost";
const HTTP_HOST_LOCAL_ONLY				= "http://"; /* LEAVE THIS; IMPLEMENTED AS OF 3.9.1 TO FIX HTTP REDIRECT BUG */
const APP_NAME 							= "JELLY/"; /* *** MUST HAVE TRAILING SLASH *** */
const BRANCH							= "Master/"; /* *** MUST HAVE TRAILING SLASH *** */
const VERSION 							= "Versions/Strawberry/"; /* *** MUST HAVE TRAILING SLASH *** */ /* DEFAULT: "Versions/..." (WHERE ... REPRESENTS THE NUMBER) */

/* CORE APP DATA (REMOTE; REAL PURPOSE) */
const HTTP_HOST_REMOTE 					= "http://www.jellycms.com";
const APP_NAME_REMOTE					= ""; /* *** MUST HAVE TRAILING SLASH *** */
const BRANCH_REMOTE						= ""; /* *** MUST HAVE TRAILING SLASH *** */
const VERSION_REMOTE					= ""; /* *** MUST HAVE TRAILING SLASH *** */ /* DEFAULT: "Versions/..." (WHERE ... REPRESENTS THE NUMBER) */

const VERSION_NUMBER					= "1.0.41"; /* JUST THE NUMBER, NO TRAILING SLASH */

/* THE REST */
const DOMAIN 							= "YourWebsite.com";
const COMPANY_NAME 						= "YourCompanyName";
const PLATFORM 							= "JELLY";
const PLATFORM_WEBSITE					= "http://www.jellycms.com";
const TITLE_B4_PLATFORM 				= " - powered by "; /* item found before the platform on title */
const TITLE_AFTER_PLATFORM				= " v. "; /* item found after the platform on title */
const WEBSITE_NAME						= "MyWebsite";
const WEBSITE_EXT						= "";
const WEBSITE_SLOGAN					= "MyWebsite build by JELLYCMS!";
const WEBSITE_SLOGAN_SHORT 				= "MyWebsite";

/* URL CORE DATA */
/* DEFINE YOUR TEST BED (IF YOU HAVE ONE) AND YOUR REMOTE BED (IF YOU HAVE NO TEST SERVER THAN LEAVE BLANK AS YOU WILL NEVER USE IT */
/* **** WEBSITE_(TEST OR REMO)_URL IS WHAT YOU WANT TO FOCUS ON THE MOST **** */
/* FULL_(TEST OR REMO)_WURL IS THE FULL URL PROVIDED WITH THE PADMAIN NAME AND DEFAULT PAGE */
const FULL_WEBSITE_TEST_URL				= "http://localhost/JELLY/Master/Versions/Strawberry/base/home";
const FULL_WEBSITE_REMO_URL				= "http://www.jellycms.com/base/home";
const WEBSITE_TEST_URL					= "http://localhost/JELLY/Master/Versions/Strawberry/";
const WEBSITE_REMO_URL					= "http://www.jellycms.com/";

/* THEME DATA */
const PATH_TO_THEME_ASSETS 				= "themes/(THEME_NAME)/exempt/"; /* where the theme assets are located (must include trailing slash */

const TURN_ON_BOTTOM_NAV 				= "yes";
const TURN_ON_TOP_NAV 					= "yes";

const DEFAULT_SEARCH_TEXT_PADMAIN 		= "Search MyWebsite.com...";
const DEFAULT_SEARCH_TEXT_PAD1 			= "Search Pad 1...";
const DEFAULT_SEARCH_TEXT_PAD2 			= "Search Pad 2...";
const DEFAULT_SEARCH_TEXT_PAD3 			= "Search Pad 3...";
const DEFAULT_SEARCH_TEXT_PAD4 			= "Search Pad 4...";

const SERVER_LOCATION 					= "America/Mexico_City"; /* for a list of locations, see here ->  http://www.php.net/manual/en/timezones.php */

/* SEO CORE DATA */
const SITE_DESCRIPTION					= "An on-going project that was created to be a Web Interface To Learn and to Love. This is my first official attempt at creating a CMS that everyone will love! JELLY stands for Just an Essential Liberating Library for You. This is a fully-customizable CMS for creating websites with modules, plugins, and themes. ";
const SITE_AUTHOR 						= "Nathan Smyth";
const FOOTER_AUTHOR_INFO				= "Your Name. Your Title?. Your Area. (555) 555 5555"; //you can put whatever you want in here
/* THIS IS FOR THE DEFAULT KEYWORDS THAT LOAD INTO THE HOME PAGES. IN ORDER */
/* TO CUSTOMIZE THE INDIVIDUAL PAGE KEYWORDS PUT IT INTO THE DB. */
/* DO NOT END THIS WITH A "," OR ELSE YOU WILL BREAK IT! */
const SITE_KEYWORDS 					= "web design,nathan smyth,web site design,HTML,Javascript,PHP,UX,CMS,JELLY,rock-solid,content management system"; 

/* I WOULD SUGGEST NOT TOUCHING THIS :) */
const PROPS_VAR_BODYSB_WRAP_START		= "<div class=\"props-var-body-wrap\">";
const PROPS_VAR_BODYSB_WRAP_END			= "</div><br /><br /><br /><br />";

/* DATABASE CORE DATA */
const DB_HOST 							= "localhost";
const DB_USER 							= "root"; /*remote: "mrnat4an_master" or local: "root"*/
const DB_PASS							= ""; /*remote: "thecreation101" or local: ""*/
const DB_NAME 							= "mrnat4an_master";
const DB_PREFIX 						= "h_";

const MAIN_TITLE 						= "MyWebsite.com";
const MAIN_TITLE_ALIGN					= "l"; //l = left; c = center; r = right
const MAIN_SLOGAN 						= "My Website";
const MAIN_SLOGAN_EXTRA_PAD1 			= "Title #1"; /* a Righteous, Dedicated, and Intrigued Anime Fanatic */
const MAIN_SLOGAN_EXTRA_PAD2 			= "Title #2"; /* a Hardcore Gamer Freak who Lives for Kill-Joys...:P */
const MAIN_SLOGAN_EXTRA_PAD3 			= "Title #3"; /* is a Kid from TX who makes Epic Dance Music 4 U */
const MAIN_SLOGAN_EXTRA_PAD4 			= "Title #4"; /* is a Super Linux Nerd who Lives in the Terminal $ su */
const MAIN_SLOGAN_ALIGN 				= "l"; //l = left; c = center; r = right
const HEADER_RIGHT_SIDE_CONTENT			= "";
const HEADER_RIGHT_SIDE_CONTENT_ALIGN 	= "c"; //l = left; c = center; r = right
const TN_RIGHT_SIDE_CONTENT 			= "";
const TN_RIGHT_SIDE_CONTENT_ALIGN 		= "l";
const PAD_AMOUNT 						= 5;
const NAME_PADMAIN 						= "base";
const NAME_PAD1							= "pad1";
const NAME_PAD2							= "pad2";
const NAME_PAD3							= "pad3";
const NAME_PAD4							= "pad4";
const SNAME_PADMAIN 					= "Base";
const SNAME_PAD1						= "Pad 1";
const SNAME_PAD2						= "Pad 2";
const SNAME_PAD3						= "Pad 3";
const SNAME_PAD4						= "Pad 4";
const FNAME_PADMAIN 					= "Base";
const FNAME_PAD1						= "Pad 1";
const FNAME_PAD2						= "Pad 2";
const FNAME_PAD3						= "Pad 3";
const FNAME_PAD4						= "Pad 4";

/* CORE SESSION DATA */
const _COOKIE_INIT_LOCAL_SESSION 		= "mywebsite_local_session";
const _COOKIE_INIT_REMOTE_SESSION 		= "mywebsite_remote_session";
const _COOKIE_INIT_TEMP_LOCAL_SESSION 	= "mywebsite_temp_local_session";
const _COOKIE_INIT_TEMP_REMOTE_SESSION  = "mywebsite_temp_remote_session";	
}
?>