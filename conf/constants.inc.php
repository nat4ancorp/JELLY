<?php
class CONSTANTS {

/* CORE APP DATA (TESTING SERVER PURPOSE) */
const HTTP_HOST 						= "localhost";
const HTTP_HOST_LOCAL_ONLY				= "http://"; /* LEAVE THIS; IMPLEMENTED AS OF 3.9.1 TO FIX HTTP REDIRECT BUG */
const APP_NAME 							= "WITLL/"; /* *** MUST HAVE TRAILING SLASH *** */
const BRANCH							= "Master/"; /* *** MUST HAVE TRAILING SLASH *** */
const VERSION 							= "Versions/1.0.39/"; /* *** MUST HAVE TRAILING SLASH *** */ /* DEFAULT: "Versions/..." (WHERE ... REPRESENTS THE NUMBER) */

/* CORE APP DATA (REMOTE; REAL PURPOSE) */
const HTTP_HOST_REMOTE 					= "http://www.witll.net";
const APP_NAME_REMOTE					= ""; /* *** MUST HAVE TRAILING SLASH *** */
const BRANCH_REMOTE						= ""; /* *** MUST HAVE TRAILING SLASH *** */
const VERSION_REMOTE					= ""; /* *** MUST HAVE TRAILING SLASH *** */ /* DEFAULT: "Versions/..." (WHERE ... REPRESENTS THE NUMBER) */

const VERSION_NUMBER					= "1.0.39"; /* JUST THE NUMBER, NO TRAILING SLASH */

/* THE REST */
const DOMAIN 							= "WITLL.net";
const COMPANY_NAME 						= "Nat4an Corp";
const PLATFORM 							= "WITLL";
const PLATFORM_WEBSITE					= "http://www.witll.net";
const TITLE_B4_PLATFORM 				= " - powered by "; /* item found before the platform on title */
const TITLE_AFTER_PLATFORM				= " v. "; /* item found after the platform on title */
const WEBSITE_NAME						= "WITLL";
const WEBSITE_EXT						= ".net";
const WEBSITE_SLOGAN					= "A Web Interface to Learn &amp; To Love";
const WEBSITE_SLOGAN_SHORT 				= "To Learn &amp; To Love";

/* URL CORE DATA */
/* DEFINE YOUR TEST BED (IF YOU HAVE ONE) AND YOUR REMOTE BED (IF YOU HAVE NO TEST SERVER THAN LEAVE BLANK AS YOU WILL NEVER USE IT */
/* **** WEBSITE_(TEST OR REMO)_URL IS WHAT YOU WANT TO FOCUS ON THE MOST **** */
/* FULL_(TEST OR REMO)_WURL IS THE FULL URL PROVIDED WITH THE PADMAIN NAME AND DEFAULT PAGE */
const FULL_WEBSITE_TEST_URL				= "http://localhost/WITLL/Master/Versions/1.0.39/padmain/home";
const FULL_WEBSITE_REMO_URL				= "http://www.witll.net/base/home";
const WEBSITE_TEST_URL					= "http://localhost/WITLL/Master/Versions/1.0.39/";
const WEBSITE_REMO_URL					= "http://www.witll.net/";

/* THEME DATA */
const PATH_TO_THEME_ASSETS 				= "includes/private/bin/tm-assets/"; /* where the theme assets are located (must include trailing slash */

const TURN_ON_BOTTOM_NAV 				= "yes";
const TURN_ON_TOP_NAV 					= "yes";

const DEFAULT_SEARCH_TEXT_PADMAIN 		= "Search WITLL.net...";
const DEFAULT_SEARCH_TEXT_PAD1 			= "Search ...";
const DEFAULT_SEARCH_TEXT_PAD2 			= "Search ...";
const DEFAULT_SEARCH_TEXT_PAD3 			= "Search ...";
const DEFAULT_SEARCH_TEXT_PAD4 			= "Search ...";

const SERVER_LOCATION 					= "America/Mexico_City"; /* for a list of locations, see here ->  http://www.php.net/manual/en/timezones.php */

/* SEO CORE DATA */
const SITE_DESCRIPTION					= "A Website CMS Interface that is fun and friendly and easy to Learn &amp; to Love. Packed with all kinds of features while combining a robust SEO and Spiderable system/framework and web 3.0 optimization.";
const SITE_AUTHOR 						= "Nathan Smyth";
/* THIS IS FOR THE DEFAULT KEYWORDS THAT LOAD INTO THE HOME PAGES. IN ORDER */
/* TO CUSTOMIZE THE INDIVIDUAL PAGE KEYWORDS PUT IT INTO THE DB. */
/* DO NOT END THIS WITH A "," OR ELSE YOU WILL BREAK IT! */
const SITE_KEYWORDS 					= "nathan smyth,web site design,HTML,Javascript,PHP,UX,WITLL,To learn and to love,learn,love,web3.0,3.0,framework"; 

/* I WOULD SUGGEST NOT TOUCHING THIS :) */
const PROPS_VAR_BODYSB_WRAP_START		= "<div class=\"props-var-body-wrap\">";
const PROPS_VAR_BODYSB_WRAP_END			= "</div>";

/* DATABASE CORE DATA */
const DB_HOST 							= "localhost";
const DB_USER 							= "root"; /*remote: "mrnat4an_master" or local: "root"*/
const DB_PASS							= ""; /*remote: "thecreation101" or local: ""*/
const DB_NAME 							= "mrnat4an_witll";
const DB_PREFIX 						= "h_";

const MAIN_TITLE 						= "WITLL";
const MAIN_TITLE_ALIGN					= "l"; //l = left; c = center; r = right
const MAIN_SLOGAN 						= "Web Interface CMS";
const MAIN_SLOGAN_EXTRA_PAD1 			= "...";
const MAIN_SLOGAN_EXTRA_PAD2 			= "...";
const MAIN_SLOGAN_EXTRA_PAD3 			= "...";
const MAIN_SLOGAN_EXTRA_PAD4 			= "...";
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

/* CORE SESSION DATA */
const _COOKIE_INIT_LOCAL_SESSION 		= "witll_beta_local_session";
const _COOKIE_INIT_REMOTE_SESSION 		= "witll_beta_remote_session";
const _COOKIE_INIT_TEMP_LOCAL_SESSION 	= "witll_beta_temp_local_session";
const _COOKIE_INIT_TEMP_REMOTE_SESSION  = "witll_beta_temp_remote_session";	
}
?>