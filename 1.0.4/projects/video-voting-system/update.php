<?php
/* add configuration files */
require("conf/props.php");

/* create a new instance of the properties class */
$properties=new properties();

/* connect to the database via including the config connect file */
include("conf/connect.php");

//get important variables
$entry_id	= $_GET['entry_id'];
$value		= $_GET['value'];

$QUERY=mysql_query("UPDATE {$properties->DB_PREFIX}entries SET status='".$value."' WHERE id='".$entry_id."'");

if(!$QUERY){
	echo "Something went wrong! Error: ".mysql_error($QUERY);
} else {
	echo "The Entry #".$entry_id." has been updated with the status: ".$value;	
}
?>