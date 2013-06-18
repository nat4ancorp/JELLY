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
@$chapter_edit_id=$_POST['chapter_edit_id'];
@$chapter_edit_name=$_POST['chapter_edit_name'];
@$chapter_edit_show_name=$_POST['chapter_edit_show_name'];
@$chapter_edit_launchpad=$_POST['chapter_edit_launchpad'];
@$chapter_edit_page=$_POST['chapter_edit_page'];
@$chapter_edit_issearchable=$_POST['chapter_edit_issearchable'];
@$chapter_edit_for_lp=$_POST['chapter_edit_for_lp'];
@$chapter_edit_delete=$_POST['chapter_edit_delete'];
@$ip=$_SERVER['REMOTE_ADDR'];

/* SAVING SEARCH CHAPTER PROTOCAL */
/* STEP 2: CHECK FOR ACCURACY */
if($chapter_edit_name=="" || $chapter_edit_page==""){
	/* FAILED SOME WHERE; FIND OUT WHERE */
	if($chapter_edit_name==""){
		$error_console="";$error_console="Name cannot be empty.";	
	} else if($chapter_edit_page==""){
		$error_console="";$error_console="Page cannot be empty.";
	}
} else {
	if($error_console==""){
		/* SO FAR SO GOOD; CONTINUE TO CHECK FOR LOGGED */					
			
		if($chapter_edit_delete == "yes"){
			//update the db
			mysql_query("DELETE FROM {$properties->DB_PREFIX}search_chapters WHERE id='".$chapter_edit_id."'");		
			
			$value="<span style=\"color:green;\">Chapter Removed (cannot undo).</span>";
		} else {
			//update the db
			mysql_query("UPDATE {$properties->DB_PREFIX}search_chapters SET launchpadid='".$chapter_edit_launchpad."' WHERE id='".$chapter_edit_id."'");		
			mysql_query("UPDATE {$properties->DB_PREFIX}search_chapters SET name='".$chapter_edit_name."' WHERE id='".$chapter_edit_id."'");		
			mysql_query("UPDATE {$properties->DB_PREFIX}search_chapters SET show_name='".$chapter_edit_show_name."' WHERE id='".$chapter_edit_id."'");		
			mysql_query("UPDATE {$properties->DB_PREFIX}search_chapters SET page='".$chapter_edit_page."' WHERE id='".$chapter_edit_id."'");		
			mysql_query("UPDATE {$properties->DB_PREFIX}search_chapters SET is_searchable='".$chapter_edit_issearchable."' WHERE id='".$chapter_edit_id."'");		
			mysql_query("UPDATE {$properties->DB_PREFIX}search_chapters SET for_lp='".$chapter_edit_for_lp."' WHERE id='".$chapter_edit_id."'");		
			
			$value="<span style=\"color:green;\">Successfully Saved!</span>";	
		}
	} else {
		/* FAILED */
		$error_console="<span style=\"color:red !important;\">".$error_console."</span>";
	}
}
if($error_console!=""){$value=$error_console;}{$value=$value;}
echo "<hr>".$value;	
?>