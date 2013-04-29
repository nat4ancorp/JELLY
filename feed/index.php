<?php
//some important variables
require("../conf/props.php");
include("../includes/private/tools/converter.php");
@$launchpad	= "portfolio";
@$page		= "blog";

//setup properties class
$properties=new properties();

//connect to database
include("../conf/connect.php");

/* DETERMINE THE WEBSITE_URL */
if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}

//tell what kind of page type this is
header("Content-Type: application/rss+xml; charset=ISO-8859-1");

//setup the rssfeed $variable
$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$rssfeed.= '<rss version="2.0">';
$rssfeed.= '';
$rssfeed.= '<channel>';
$rssfeed.= '<title>'.$properties->WEBSITE_NAME.$properties->WEBSITE_EXT.' RSS Feed</title>';
$rssfeed.= '<link>'.$WEBSITE_URL.'</link>';
$rssfeed.= '<description>Fresh news about Web Development, iPhone, and other Computer-related stuff at your fingertips!</description>';
$rssfeed.= '<language>en-us</language>';
$rssfeed.= '<copyright>Copyright &copy; 2013 '.$properties->WEBSITE_NAME.$properties->WEBSITE_EXT.'</copyright>';

//extract data and place in items
$GET_ALL_DATA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE status='Published' ORDER BY dateandtime DESC");
if(mysql_num_rows($GET_ALL_DATA)<1){
	/* NO DATA */
} else {
	while($FETCH_ALL_DATA=mysql_fetch_array($GET_ALL_DATA)){
		extract($FETCH_ALL_DATA);
		
		$rssfeed.= '<item>';
		$rssfeed.= '<title>'.$title.'</title>';
		$rssfeed.= '<description>'.$content.'</description>';
		$rssfeed.= '<link>'.$WEBSITE_URL.$launchpad.'/'.$page.'/permalink/'.$date_year.'/'.$date_month.'/'.$date_day.'/'.converter($properties,$title,"url","to").'</link>';
		$rssfeed.= '<pubDate>'.$dateandtime.'</pubDate>';		
		$rssfeed.= '</item>';
	}
}
$rssfeed.= '</channel>';
$rssfeed.= '</rss>';

echo $rssfeed;
?>