<?php
class CONSTANTS {

/* CORE APP DATA (TESTING SERVER PURPOSE) */
const HTTP_HOST 						= "localhost";
const HTTP_HOST_LOCAL_ONLY				= "http://"; /* LEAVE THIS; IMPLEMENTED AS OF 3.9.1 TO FIX HTTP REDIRECT BUG */
const APP_NAME 							= "WITLL/"; /* *** MUST HAVE TRAILING SLASH *** */
const BRANCH							= "Nat4andotcom/"; /* *** MUST HAVE TRAILING SLASH *** */
const VERSION 							= "Versions/Strawberry/"; /* *** MUST HAVE TRAILING SLASH *** */ /* DEFAULT: "Versions/..." (WHERE ... REPRESENTS THE NUMBER) */

/* CORE APP DATA (REMOTE; REAL PURPOSE) */
const HTTP_HOST_REMOTE 					= "http://www.nat4an.com";
const APP_NAME_REMOTE					= ""; /* *** MUST HAVE TRAILING SLASH *** */
const BRANCH_REMOTE						= ""; /* *** MUST HAVE TRAILING SLASH *** */
const VERSION_REMOTE					= ""; /* *** MUST HAVE TRAILING SLASH *** */ /* DEFAULT: "Versions/..." (WHERE ... REPRESENTS THE NUMBER) */

const VERSION_NUMBER					= "1.0.41"; /* JUST THE NUMBER, NO TRAILING SLASH */

/* THE REST */
const DOMAIN 							= "Nat4an.com";
const COMPANY_NAME 						= "Nat4an Corp";
const PLATFORM 							= "JELLY";
const PLATFORM_WEBSITE					= "http://www.witll.net";
const TITLE_B4_PLATFORM 				= " - powered by "; /* item found before the platform on title */
const TITLE_AFTER_PLATFORM				= " v. "; /* item found after the platform on title */
const WEBSITE_NAME						= "Nat4an";
const WEBSITE_EXT						= "";
const WEBSITE_SLOGAN					= "Freelance Web Designer in San Antonio, TX Area";
const WEBSITE_SLOGAN_SHORT 				= "Freelance Web Designer";

/* URL CORE DATA */
/* DEFINE YOUR TEST BED (IF YOU HAVE ONE) AND YOUR REMOTE BED (IF YOU HAVE NO TEST SERVER THAN LEAVE BLANK AS YOU WILL NEVER USE IT */
/* **** WEBSITE_(TEST OR REMO)_URL IS WHAT YOU WANT TO FOCUS ON THE MOST **** */
/* FULL_(TEST OR REMO)_WURL IS THE FULL URL PROVIDED WITH THE PADMAIN NAME AND DEFAULT PAGE */
const FULL_WEBSITE_TEST_URL				= "http://localhost/JELLY/Nat4andotcom/Versions/Strawberry/portfolio/home";
const FULL_WEBSITE_REMO_URL				= "http://www.nat4an.com/portfolio/home";
const WEBSITE_TEST_URL					= "http://localhost/JELLY/Nat4andotcom/Versions/Strawberry/";
const WEBSITE_REMO_URL					= "http://www.nat4an.com/";

/* THEME DATA */
const PATH_TO_THEME_ASSETS 				= "themes/(THEME_NAME)/exempt/"; /* where the theme assets are located (must include trailing slash */

const TURN_ON_BOTTOM_NAV 				= "yes";
const TURN_ON_TOP_NAV 					= "yes";

const DEFAULT_SEARCH_TEXT_PADMAIN 		= "Search Nat4an.com...";
const DEFAULT_SEARCH_TEXT_PAD1 			= "Search The Anime Fanatic...";
const DEFAULT_SEARCH_TEXT_PAD2 			= "Search The Gamer Freak...";
const DEFAULT_SEARCH_TEXT_PAD3 			= "Search The Musik Maker...";
const DEFAULT_SEARCH_TEXT_PAD4 			= "Search The Linux Nerd...";

const SERVER_LOCATION 					= "America/Mexico_City"; /* for a list of locations, see here ->  http://www.php.net/manual/en/timezones.php */

/* SEO CORE DATA */
const SITE_DESCRIPTION					= "Nat4an is a Freelance Web Designer of CSS, PHP, JavaScript, and User Experience (UX who lives and operates mainly in the San Antonio, TX Area. Nat4an is also an Anime Fanatic, a Gamer Freak, The Musik Maker, and a Linux Nerd. Nat4an is a self-motivated child of the code who wants to become the impossible in Web Design. I make Smart, Friendly, Fast websites that are SEO-Friendly, UX-Optimized, Search Engine Spider-able, and Eye-Catching-ly Amazing.";
const SITE_AUTHOR 						= "Nathan Smyth";
const FOOTER_AUTHOR_INFO				= "Nathan Smyth. Freelance Web Designer. San Antonio, TX Area. (210) 863 8843";
/* THIS IS FOR THE DEFAULT KEYWORDS THAT LOAD INTO THE HOME PAGES. IN ORDER */
/* TO CUSTOMIZE THE INDIVIDUAL PAGE KEYWORDS PUT IT INTO THE DB. */
/* DO NOT END THIS WITH A "," OR ELSE YOU WILL BREAK IT! */
const SITE_KEYWORDS 					= "web design,nathan smyth,freelance web developer,web site design,web design san antonio tx,anime,gaming,musik,linux,nerd,portfolio,HTML,Javascript,PHP,UX"; 

/* I WOULD SUGGEST NOT TOUCHING THIS :) */
const PROPS_VAR_BODYSB_WRAP_START		= "<div class=\"props-var-body-wrap\">";
const PROPS_VAR_BODYSB_WRAP_END			= "</div><br /><br /><br /><br />";

/* DATABASE CORE DATA */
const DB_HOST 							= "localhost";
const DB_USER 							= "root"; /*remote: "mrnat4an_master" or local: "root"*/
const DB_PASS							= ""; /*remote: "thecreation101" or local: ""*/
const DB_NAME 							= "mrnat4an_nat4an";
const DB_PREFIX 						= "h_";

const MAIN_TITLE 						= "Nat4an.com";
const MAIN_TITLE_ALIGN					= "l"; //l = left; c = center; r = right
const MAIN_SLOGAN 						= "My VR Playground";
const MAIN_SLOGAN_EXTRA_PAD1 			= "For your Anime Needs!"; /* a Righteous, Dedicated, and Intrigued Anime Fanatic */
const MAIN_SLOGAN_EXTRA_PAD2 			= "Covering Games you Love!"; /* a Hardcore Gamer Freak who Lives for Kill-Joys...:P */
const MAIN_SLOGAN_EXTRA_PAD3 			= "Where we Listen & Share Beats!"; /* is a Kid from TX who makes Epic Dance Music 4 U */
const MAIN_SLOGAN_EXTRA_PAD4 			= "A Place to Nerd Around!"; /* is a Super Linux Nerd who Lives in the Terminal $ su */
const MAIN_SLOGAN_ALIGN 				= "l"; //l = left; c = center; r = right
const HEADER_RIGHT_SIDE_CONTENT			= "";
const HEADER_RIGHT_SIDE_CONTENT_ALIGN 	= "c"; //l = left; c = center; r = right
const TN_RIGHT_SIDE_CONTENT 			= "";
const TN_RIGHT_SIDE_CONTENT_ALIGN 		= "l";
const PAD_AMOUNT 						= 5;
const NAME_PADMAIN 						= "portfolio";
const NAME_PAD1							= "af";
const NAME_PAD2							= "gf";
const NAME_PAD3							= "tmm";
const NAME_PAD4							= "ln";
const SNAME_PADMAIN 					= "Portfolio";
const SNAME_PAD1						= "Anime Fanatic";
const SNAME_PAD2						= "Gamer Freak";
const SNAME_PAD3						= "The Musik Maker";
const SNAME_PAD4						= "Linux Nerd";
const FNAME_PADMAIN 					= "Portfolio";
const FNAME_PAD1						= "Anime Fanatic";
const FNAME_PAD2						= "Gamer Freak";
const FNAME_PAD3						= "The Musik Maker";
const FNAME_PAD4						= "Linux Nerd";

/* CORE SESSION DATA */
const _COOKIE_INIT_LOCAL_SESSION 		= "nat4an_beta_local_session";
const _COOKIE_INIT_REMOTE_SESSION 		= "nat4an_beta_remote_session";
const _COOKIE_INIT_TEMP_LOCAL_SESSION 	= "nat4an_beta_temp_local_session";
const _COOKIE_INIT_TEMP_REMOTE_SESSION  = "nat4an_beta_temp_remote_session";	
}
?>