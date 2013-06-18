<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
/* INCLUDE IMPORTANT FILES */
include("../conf/props.php");

/* CREATE THE PROPERTIES INSTANCE */
$properties=new properties();

/* INCLUDES/REQUIRES THAT NEED PROPERTIES IN ORDER TO FUNCTION */
include ("../conf/connect.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Installation</title>
</head>

<body>
<style type="text/css">
.formLayout {
	display: table;
	width: 100%;	
}
.formLayoutRow {
	display: table-row;	
}
.formLayoutRowLcol {
	display: table-cell;
	width: 10%;	
	border: dashed black thin;
	padding: 7px; 
}
.formLayoutRowRcol {
	display: table-cell;
	border: dashed black thin;
	padding: 7px;
}
</style>
<h1><?php echo $properties->PLATFORM;?></h1>
<p>Welcome to the installer of infamous <?php echo $properties->PLATFORM;?> Content Management System (CMS)! You may want to browse the ReadMe documentation at your leisure. Otherwise, just fill in the information below and you'll be on your way to using a new Website Framework System for publishing your content all over the world.</p>

<h2>Information needed</h2>
<p>Please provide the following information. Don't worry, you can always change these settings later.</p>
<div class="formLayout">
	<div class="formLayoutRow">
    	<div class="formLayoutRowLcol">
        	Website Title
        </div>
        <div class="formLayoutRowRcol">
        	<input type="text" name="website_title" />
        </div>
    </div>
    <div class="formLayoutRow">
    	<div class="formLayoutRowLcol">
        	You're Email
        </div>
        <div class="formLayoutRowRcol">
        	<input type="text" name="website_email" />
        </div>
    </div>
</div>
<input type="checkbox" name="website_allowsearch" value="yes" /> Allow my website to appear in search engines like Google.
<br /><br />
<div class="formLayout">
	<div class="formLayoutRow">
    	<div class="formLayoutRowCol">
        	<input type="submit" name="website_install" value="Install <?php echo $properties->PLATFORM;?>" />
        </div>
    </div>
</div>
</body>
</html>