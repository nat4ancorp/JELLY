<?php
//global includes
require "../../../conf/props.php";

//make the properties
$properties = new properties();

//include connect stuff
include "../../../conf/connect.php";

// you can access the values posted by jQuery.ajax
// through the global variable $_POST, like this:
/* RESET VARIABLES */
$value="";
$error_console="";

/* DETERMINE THE WEBSITE_URL */
if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}

/* STEP 1: GET VARIABLES */
@$chapter_add_id=$_POST['chapter_add_id'];
@$chapter_add_name=$_POST['chapter_add_name'];
@$chapter_add_show_name=$_POST['chapter_add_show_name'];
@$chapter_add_launchpad=$_POST['chapter_add_launchpad'];
@$chapter_add_page=$_POST['chapter_add_page'];
@$chapter_add_issearchable=$_POST['chapter_add_issearchable'];
@$chapter_add_for_lp=$_POST['chapter_add_for_lp'];
@$ip=$_SERVER['REMOTE_ADDR'];

/* SAVING SEARCH CHAPTER PROTOCAL */
/* STEP 2: CHECK FOR ACCURACY */
if($chapter_add_name=="" || $chapter_add_show_name=="" || $chapter_add_page=="" || $chapter_add_issearchable==""){
	/* FAILED SOME WHERE; FIND OUT WHERE */
	if($chapter_add_name==""){
		$error_console="";$error_console="Name cannot be empty.";	
	} else if($chapter_add_show_name==""){
		$error_console="";$error_console="You must select yes or no.";
	} else if($chapter_add_page==""){
		$error_console="";$error_console="Page cannot be empty.";
	} else if($chapter_add_issearchable==""){
		$error_console="";$error_console="You must select yes or no.";
	}
} else {
	if($error_console==""){
		/* SO FAR SO GOOD; CONTINUE TO CHECK FOR LOGGED */					
			
		//update the db
		mysql_query("INSERT INTO {$properties->DB_PREFIX}search_chapters (launchpad_id,name,show_name,page,is_searchable,for_lp) VALUES ('".$chapter_add_launchpad."','".$chapter_add_name."','".$chapter_add_show_name."','".$chapter_add_page."','".$chapter_add_issearchable."','".$chapter_add_for_lp."')") or die(mysql_error());
		
		$value="<span style=\"color:green;\">Successfully Added!</span>";
	} else {
		/* FAILED */
		$error_console="<span style=\"color:red !important;\">".$error_console."</span>";
	}
}
if($error_console!=""){$value=$error_console;}{$value=$value;}
echo "<hr>".$value;	
?>