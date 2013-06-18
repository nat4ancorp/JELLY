<?php
$ITEMS_PAD=",";
$ITEMS_PAGE=",";
$ITEMS_LIST="modules,";
$ITEMS_DEFAULT_LIST="no,"; // this is where you tell us what item is default to display
$SUBITEMS_LIST="ads,"; //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES="All Ads,";
$ITEMS_LIST_SPECIAL="0,"; //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM="none,"; //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER="id"; //if order is not set in the url, it will order by this (You can add boolean values with " OR ")

/* -------------------------------------------------------- DO NOT EDIT BELOW THIS LINE -------------------------------------------------------------------- */
require("../includes/private/tools/converter.php");
?>
<style type="text/css">
.upload-popup {
background: white;
width: 900px;
height: 600px;
-moz-border-radius: 20px 20px 20px 20px;
-webkit-border-radius: 20px 20px 20px 20px;
-khtml-border-radius: 20px 20px 20px 20px;
border-radius: 20px 20px 20px 20px;
behavior: url(images/border-radius.htc);
border: thick solid black;
}
#formLayoutFull {
display: table;
width: 103.7%;
margin: 0 auto;
}
.BorderLeftRight {
border-left: #ccc thin solid;
border-right: #ccc thin solid;
}
.BorderLeft {
border-left: #ccc thin solid;
}
.BorderRight {
border-right: #ccc thin solid;
}
.BorderALL {
border-top: #ccc thin solid;
border-left: #ccc thin solid;
border-right: #ccc thin solid;
border-bottom: #ccc thin solid;
}
.BorderTop {
border-top: #ccc thin solid;
}
.BorderBottom {
border-bottom: #ccc thin solid;
}
.InBetween {
display: table;
width: 103.7%;
margin: 0 auto;
}
.NoBorder {
border: none;
border-collapse: collapse;
}
.formLayoutFullRow {
display: table-row;
height: 40px;
}
.formLayoutFullCol {
display: table-cell;
padding: 5px;
}
.alignLeft {
text-align: left;
}
.alignCenter {
text-align: center;
}
.alignRight {
text-align: right;
}
.width-full {
width: 100%;
}
.width-small {
width: 35px;
}
.width-xsmall {
width: 100px;
}
.width-semimedium {
width: 160px;
}
.width-medium {
width: 220px;
}
.valignTop {
vertical-align: top;
}
.valignMiddle {
vertical-align: middle;
}
.valignBottom {
vertical-align: bottom;
}
.fontBig {
font-size: 18px;
}
</style>
<script type="text/javascript">
function checkAll(source,what){
checkboxes = document.getElementsByName('check_'+what);
for(var i in checkboxes)
checkboxes[i].checked = source.checked;
}

</script>
<h1>ADs <a href="?menu=ad-maker&page=add-new" class="small">Add New</a></h1>
Filter by
<select id="_chooser" onchange="_chooser();">
<option value="all">All ADs</option>
<?php
$ITEMS_PAD_LIST=explode(",",$ITEMS_PAD);
$ITEMS_PAGE_LIST=explode(",",$ITEMS_PAGE);
$ITEMS_LIST_LIST=explode(",",$ITEMS_LIST);
$ITEMS_DEFAULT_LIST_LIST=explode(",",$ITEMS_DEFAULT_LIST);
$SUBITEMS_LIST_LIST=explode(",",$SUBITEMS_LIST);
$ITEMS_LIST_NAMES_LIST=explode(",",$ITEMS_LIST_NAMES);
$ITEMS_LIST_SPECIAL_LIST=explode(",",$ITEMS_LIST_SPECIAL);
$ITEMS_LIST_SPECIAL_ITEM_LIST=explode(",",$ITEMS_LIST_SPECIAL_ITEM);

/* BEGIN GETTING THE ITEMS OR WHAT EVER YOU GUYS DO :P */
for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
$item=$ITEMS_LIST_LIST[$i];			
$name=$ITEMS_LIST_NAMES_LIST[$i];
$sub_item=$SUBITEMS_LIST_LIST[$i];
$pad=$ITEMS_PAD_LIST[$i];
$page=$ITEMS_PAGE_LIST[$i];
?>
<option value="<?php echo $item;?>"><?php echo $name;?> Posts</option>
<?php
}
?>
</select>
<?php
for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
$item=$ITEMS_LIST_LIST[$i];			
$name=$ITEMS_LIST_NAMES_LIST[$i];
$sub_item=$SUBITEMS_LIST_LIST[$i];
$pad=$ITEMS_PAD_LIST[$i];
$page=$ITEMS_PAGE_LIST[$i];
?>
<input type="hidden" id="element_<?php echo $i?>" value="<?php echo $item;?>" />
<?php
}
?>
<input type="hidden" id="element_count" value="<?php echo count($ITEMS_LIST_LIST)-1;?>" />
<?php
/* CATCH IF */
if(isset($_GET['action'])){
/* SWITCH THE CATCH */
switch($_GET['action']){
case 'edit':
if($type == "admin"){
	if(isset($_POST['editad_publish'])){
	/* STEP 1: GET DATA */
	$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	
	$editad_id=mysql_escape_string($_POST['editad_id']);
	$editad_name=mysql_escape_string($_POST['editad_name']);
	$editad_status=mysql_escape_string($_POST['editad_status']);
	$editad_type=mysql_escape_string($_POST['editad_type']);
	$editad_url=mysql_escape_string($_POST['editad_url']);
	$editad_date=mysql_escape_string($_POST['editad_date']);
	$editad_time=mysql_escape_string($_POST['editad_time']);
	$editad_target=mysql_escape_string($_POST['editad_target']);
	$editad_img_location=mysql_escape_string($_POST['editad_img_location']);
	$editad_img_border=mysql_escape_string($_POST['editad_img_border']);
	$editad_img_alt=mysql_escape_string($_POST['editad_img_alt']);
	$editad_img_width=mysql_escape_string($_POST['editad_img_width']);
	$editad_img_height=mysql_escape_string($_POST['editad_img_height']);
	$editad_img_align=mysql_escape_string($_POST['editad_img_align']);
	$editad_times_displayed=mysql_escape_string($_POST['editad_times_displayed']);
	
	//0000-00-00 00:00:00
	//0123456789012345678
	$dateandtime=$editad_date." ".$editad_time;
	$editad_dateyear=substr($dateandtime,0,4);
	$editad_datemonth=substr($dateandtime,5,2);
	$editad_dateday=substr($dateandtime,8,2);
	$editad_datehour=substr($dateandtime,11,2);
	$editad_datemin=substr($dateandtime,14,2);
	$editad_datesec=substr($dateandtime,17,2);
	
	/* STEP 2: CHECK DATA FOR ACCURACY */							
	
	if($error_console!=""){
	echo $error_console." <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go Back</a>";
	} else {
	/* STEP 3: UPLOAD/SAVE */
	
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='".$editad_status."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET name='".$editad_name."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET type='".$editad_type."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET url='".$editad_url."' WHERE id='".$editad."'") or die(mysql_error());
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET img_border='".$editad_img_border."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET img_alt='".$editad_img_alt."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET img_width='".$editad_img_width."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET img_height='".$editad_img_height."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET img_align='".$editad_img_align."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime='".$editad_date." ".$editad_time."' WHERE id='".$editad."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET date_year='".$editad_dateyear."' WHERE id='".$editad."'");	
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET date_month='".$editad_datemonth."' WHERE id='".$editad."'");	
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET date_day='".$editad_dateday."' WHERE id='".$editad."'");	
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET date_hour='".$editad_datehour."' WHERE id='".$editad."'");	
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET date_min='".$editad_datemin."' WHERE id='".$editad."'");	
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET date_sec='".$editad_datesec."' WHERE id='".$editad."'");	
	
	
	/* STEP 4: POST RETURN OF RECEIPT */
	echo "<br /><b>".$editad_name."</b> has been successfully updated! <a href=\"".$WEBSITE_URL."?menu=ad-maker&page=manage\">Refresh</a>";
	}
	} else {$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	/* CREATE what starter */
	$what_starter=substr($what,0,strpos($what,"_entries"));
	
	$GET_ENTRY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."' AND status != 'Deleted'");
	if(mysql_num_rows($GET_ENTRY_INFO)<1){
	echo "<br />Cannot find an ad with the info you provided (truth is you probably changed the URL or the ad has been deleted, you can recover it by clicking the &quot;Recover&quot; next to the &quot;Edit&quot; button). <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";	
	} else {
	while($FETCH_ENTRY_INFO=mysql_fetch_array($GET_ENTRY_INFO)){
	$editad_id=$FETCH_ENTRY_INFO['id'];
	$editad_name=$FETCH_ENTRY_INFO['name'];
	$editad_status=$FETCH_ENTRY_INFO['status'];
	$editad_type=$FETCH_ENTRY_INFO['type'];
	$editad_url=$FETCH_ENTRY_INFO['url'];
	$editad_target=$FETCH_ENTRY_INFO['target'];
	$editad_dateandtime=$FETCH_ENTRY_INFO['dateandtime'];
	$editad_img_location=$FETCH_ENTRY_INFO['img_location'];
	$editad_img_border=$FETCH_ENTRY_INFO['img_border'];
	$editad_img_alt=$FETCH_ENTRY_INFO['img_alt'];
	$editad_img_width=$FETCH_ENTRY_INFO['img_width'];
	$editad_img_height=$FETCH_ENTRY_INFO['img_height'];
	$editad_img_align=$FETCH_ENTRY_INFO['img_align'];
	$editad_times_displayed=$FETCH_ENTRY_INFO['times_displayed'];
	echo "<h3>Editing the ad of &quot;".$editad_name."&quot;</h3>";
	//0000-00-00 00:00:00
	//0123456789012345678
	$editad_dateyear=substr($editad_dateandtime,0,4);
	$editad_datemonth=substr($editad_dateandtime,5,2);
	$editad_dateday=substr($editad_dateandtime,8,2);
	$editad_time=substr($editad_dateandtime,11,8);
	
	?>
	<form action="" method="post">
	<div class="cp-table">
	<div class="cp-row">
	<div class="cp-lcol">
	<div class="formLayoutTable">
	<div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol">
    <label>Advertisement Name (does not display)</label>
    <br />
	<input type="text" name="editad_name" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $editad_name;?>" class="full-input" />
	</div>
	<div class="formLayoutTableRowRightCol"> </div>
	</div>
    
    <div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol">
    <label>Target URL</label>
    <br />
	<input type="text" name="editad_url" onfocus="if(this.value=='http://www.toyouradvertisement.com'){this.value='';}" onblur="if(this.value==''){this.value='http://www.toyouradvertisement.com';}" value="<?php echo $editad_url;?>" class="full-input" />
	</div>
	<div class="formLayoutTableRowRightCol"> </div>
	</div>
    
    <div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol">
    <label>Banner Graphic Location (url only)</label>
    <br />
	<input type="text" name="editad_img_location" onfocus="if(this.value=='Where is your banner located?'){this.value='';}" onblur="if(this.value==''){this.value='Where is your banner located?';}" value="<?php echo $editad_img_location;?>" class="full-input" />
	</div>
	<div class="formLayoutTableRowRightCol"> </div>
	</div>
    
    <div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol">
    <label>Alternative Text (for graphic)</label>
    <br />
	<input type="text" name="editad_img_alt" onfocus="if(this.value=='This is my banner here, so click on it'){this.value='';}" onblur="if(this.value==''){this.value='This is my banner here, so click on it';}" value="<?php echo $editad_img_alt;?>" class="full-input" />
	</div>
	<div class="formLayoutTableRowRightCol"> </div>
	</div>
    
	</div>
	</div>
	<div class="cp-rcol">
	<div class="formLayoutTableMainAll">
	<div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol" style="text-align:left;">
	<h2></h2>
	</div>
	<div class="formLayoutTableRowRightCol" style="text-align:left;">
	<h2>&nbsp;&nbsp;Sync</h2>
	</div>
	</div>
	<div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol"> </div>
	<div class="formLayoutTableRowRightCol" style="text-align:left;">
	<input type="submit" name="editad_publish" value="Publish" class="submit" />
	<input type="submit" name="editad_savedraft" disabled="disabled" value="Save Draft" class="submit" />
	</div>
	</div>
	<div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol">
	<h2>General</h2>
	</div>
	<div class="formLayoutTableRowMainAllRightCol">
	<h2>&nbsp;Attributes</h2>
	</div>
	</div>
	<div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Status: </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<select name="editad_status">
	<?php if($editad_status=="active"){?>
	<option value="active" selected="selected">Active</option>
	<?php } else {?>
	<option value="active">Active</option>
	<?php }?>
	
	<?php if($editad_status=="inactive"){?>
	<option value="inactive" selected="selected">Inactive</option>
	<?php } else {?>
	<option value="inactive">Inactive</option>
	<?php }?>
	
	<?php if($editad_status=="deleted"){?>
	<option value="deleted" selected="selected">Deleted</option>
	<?php } else {?>
	<option value="deleted">Deleted</option>
	<?php }?>

	</select>
	</div>
	</div>
    
    <div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Target: </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<select name="editad_target">
	<?php if($editad_target=="_blank"){?>
	<option value="_blank" selected="selected">_blank</option>
	<?php } else {?>
	<option value="_blank">_blank</option>
	<?php }?>
	
	<?php if($editad_target=="_self"){?>
	<option value="_self" selected="selected">_self</option>
	<?php } else {?>
	<option value="_self">_self</option>
	<?php }?>
	
	<?php if($editad_target=="_parent"){?>
	<option value="_parent" selected="selected">_parent</option>
	<?php } else {?>
	<option value="_parent">_parent</option>
	<?php }?>

	</select>
	</div>
	</div>
    
    <div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Type: </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<select name="editad_type">
	<?php if($editad_type=="top"){?>
	<option value="top" selected="selected">Top</option>
	<?php } else {?>
	<option value="top">Top</option>
	<?php }?>

	</select>
	</div>
	</div>
	
	<div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> 
	<script type="text/javascript">
	$(function() {
	$('#editad_date').datepick({dateFormat: 'yyyy-mm-dd'});
	//$('#inlineDatepicker').datepick({onSelect: showDate});
	});
	</script> 
	Date: </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<input type="date" name="editad_date" id="editad_date" value="<?php echo $editad_dateyear."-".$editad_datemonth."-".$editad_dateday;?>" style="width:120px;" />
	</div>
	</div>
	<div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Time: </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<input type="time" name="editad_time" step="1" value="<?php echo $editad_time;?>" style="width:120px;" />
	</div>
	</div>
    
    <div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Image Border? </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<?php if($editad_img_border == "on"){?>
	<input type="radio" name="editad_img_border" value="yes" class="radio" checked="checked" />
	Yes
	<input type="radio" name="editad_img_border" value="no" class="radio" />
	No
	<?php } else {?>
	<input type="radio" name="editad_img_border" value="yes" class="radio" />
	Yes
	<input type="radio" name="editad_img_border" value="no" checked="checked" class="radio" />
	No
	<?php }?>
	</div>
	</div>    
    
    <div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Width </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<input type="text" name="editad_img_width" value="<?php echo $editad_img_width;?>" style="width:150px;" />
	</div>
	</div>
    
    <div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Height </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<input type="text" name="editad_img_height" value="<?php echo $editad_img_height;?>" style="width:150px;" />
	</div>
	</div>
    
    <div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Align: </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<select name="editad_img_align">
	<?php if($editad_type=="center"){?>
	<option value="center" selected="selected">Center</option>
	<?php } else {?>
	<option value="center">Center</option>
	<?php }?>

	</select>
	</div>
	</div>    
    
	</div>
	
	</div>
	</div>
	</div>
	</form>
	<?php
	}
	}}			
} else {
	?>
	<center><h1>You do not have the permission to use this feature. :(</h1></center>
	<?php	
}


break;
case 'delete':
if($type == "admin"){
	if(isset($_POST['undo_delete'])){
	$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$editad=$_GET['adid'];
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='inactive' WHERE id='".$editad."'");
	echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=ad-maker\" style=\"cursor:pointer;\">Refresh</a>";
	} else {
	if(isset($_POST['ays_answer'])){
	/* STEP 1: GET DATA */
	$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$editad=$_GET['adid'];
	
	/* STEP 2: CHECK FOR ANSWER (blank) */
	if($_POST['ays_answer']==""){
	echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."'");
	if(mysql_num_rows($GET_POST)<1){
	echo "No Ads, with the ID: <b>".$editad."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$name=$FETCH_POST['name'];
	}
	if($_POST['ays_answer']=="yes"){
	/* STEP 4: "DELETE" (really set the status to Deleted) */
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='deleted' WHERE id='".$editad."'");
	?>
	<form method="post">
	<br />Okay I have deleted <b><?php echo $name;?></b> from the AD Rotator (<input type="submit" name="undo_delete" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=ad-maker&page=manage" style="cursor:pointer;">Refresh</a>
	</form>
	<?php
	} else if($_POST['ays_answer']=="no"){
	echo "<br />Alright sounds fair to me, I will leave <b>".$name."</b> alone. <a href=\"".$WEBSITE_URL."?menu=ad-maker&page=manage\" style=\"cursor:pointer;\">Refresh</a>";
	}
	}										
	}
	} else {
	/* STEP 1: GET DATA */
	$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$editad=$_GET['adid'];
	
	/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."'");			
	if(mysql_num_rows($GET_POST)<1){
	echo "No Ads, with the ID: <b>".$editad."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: CONFIRM DELETE */
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$title=$FETCH_POST['title'];
	}				
	?>
	<form method="post">
	<br />Are you sure you want to delete <b><?php echo $name;?></b> from the <b>AD Rotator</b>? 
	<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
	</form>
	<?php
	}	
	}	
	}	
} else {
	?>
	<center><h1>You do not have the permission to use this feature. :(</h1></center>
	<?php	
}
break;
case 'deleteperm':
if($type == "admin"){
	if(isset($_POST['forsure_ays_answer'])){
	/* STEP 1: GET DATA */
	$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$editad=$_GET['adid'];
	
	/* STEP 2: DELETE THE ENTRY */
	mysql_query("DELETE FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."'");
	?>
	<br />Okay I have permanently deleted <b><?php echo $name;?></b> from the Trash (cannot undo) <a href="<?php echo $WEBSITE_URL;?>?menu=ad-maker&page=manage" style="cursor:pointer;">Refresh</a>
	<?php
	} else {
	if(isset($_POST['ays_answer'])){
	/* STEP 1: GET DATA */
	$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$editad=$_GET['adid'];
	
	/* STEP 2: CHECK FOR ANSWER (blank) */
	if($_POST['ays_answer']==""){
	echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."'");
	if(mysql_num_rows($GET_POST)<1){
	echo "No Ads, with the ID: <b>".$editad."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	if($_POST['ays_answer']=="no"){
	?>
	"<br />Okay I have left <b><?php echo $name;?></b> in the Trash. <a href="<?php echo $WEBSITE_URL;?>?menu=ad-maker&page=manage" style="cursor:pointer;">Refresh</a>
	<?php
	} else {
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$name=$FETCH_POST['name'];
	}									
	?>
	<form method="post">
	<br />Are you really sure you want to permanently delete <b><?php echo $name;?></b> from the <b>AD Rotator</b> which is currently in the trash? (you will lose all data on this AD; just making sure you understand)
	<input type="radio" name="forsure_ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="forsure_ays_answer" value="no" onclick="this.form.submit();" /> No
	</form>
	<?php	
	}
	}										
	}
	} else {
	/* STEP 1: GET DATA */
	$editad=$_GET['adid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$editad=$_GET['adid'];
	
	/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."'");			
	if(mysql_num_rows($GET_POST)<1){
	echo "No Ads, with the ID: <b>".$editad."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: CONFIRM DELETE */
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$title=$FETCH_POST['title'];
	}				
	?>
	<form method="post">
	<br />Are you sure you want to permanently delete <b><?php echo $name;?></b> from the <b>AD Rotator</b> which is currently in the trash? (this action cannot be undone)
	<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
	</form>
	<?php
	}	
	}	
	}
} else {
	?>
	<center><h1>You do not have the permission to use this feature. :(</h1></center>
	<?php	
}

break;
case 'recover':
if(isset($_POST['undo_recover'])){
$editad=$_GET['adid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$editad=$_GET['adid'];
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='deleted' WHERE id='".$editad."'") or die(mysql_error());
echo "<br />I just deleted it again, you sure are having a hard time making up your mind. :) <a href=\"".$WEBSITE_URL."?menu=ad-maker&page=manage\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$editad=$_GET['adid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$editad=$_GET['adid'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."'");
if(mysql_num_rows($GET_POST)<1){
echo "No Ads, with the ID: <b>".$editad."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$name=$FETCH_POST['name'];
}
if($_POST['ays_answer']=="yes"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='inactive' WHERE id='".$editad."'");
?>
<form method="post">
<br />Okay I have recovered <b><?php echo $name;?></b> from the Trash (<input type="submit" name="undo_recover" value="undo" />). It has not been placed on the AD Rotator; you must manually Edit it and change the status to <b>Active</b> in order to get it back on the AD Rotator. <a href="<?php echo $WEBSITE_URL;?>?menu=ad-maker&page=manage" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="no"){
echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> in the Trash. <a href=\"".$WEBSITE_URL."?menu=ad-maker\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$editad=$_GET['adid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$editad=$_GET['adid'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$editad."'");			
if(mysql_num_rows($GET_POST)<1){
echo "No Ads, with the ID: <b>".$editad."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$title=$FETCH_POST['title'];
}				
?>
<form method="post">
<br />Are you sure you want to recover <b><?php echo $name;?></b> from the Trash? <input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php
}	
}	
}
break;	
default:
echo "<br />Um...that was wrong. <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";
break;
}
} else {
?>
<div class="formLayoutFull">
<?php	
$ITEMS_PAD_LIST=explode(",",$ITEMS_PAD);
$ITEMS_PAGE_LIST=explode(",",$ITEMS_PAGE);
$ITEMS_LIST_LIST=explode(",",$ITEMS_LIST);
$SUBITEMS_LIST_LIST=explode(",",$SUBITEMS_LIST);
$ITEMS_LIST_NAMES_LIST=explode(",",$ITEMS_LIST_NAMES);
$ITEMS_LIST_SPECIAL_LIST=explode(",",$ITEMS_LIST_SPECIAL);
$ITEMS_LIST_SPECIAL_ITEM_LIST=explode(",",$ITEMS_LIST_SPECIAL_ITEM);

/* BEGIN GETTING THE ITEMS OR WHAT EVER YOU GUYS DO :P */
for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
$item=$ITEMS_LIST_LIST[$i];			
$sub_item=$SUBITEMS_LIST_LIST[$i];
$pad=$ITEMS_PAD_LIST[$i];
$page=$ITEMS_PAGE_LIST[$i];			

?>
<a name="<?php echo $ITEMS_LIST_LIST[$i];?>"></a>
<div id="<?php echo $item;?>_container" style="display:inline;">
<?php
//check for ordering
if(isset($_GET['order']) && $_GET['order']!=""){
/* ORDER IS SET */
if($ITEMS_LIST_SPECIAL_LIST[$i]==1){$order=$ITEMS_LIST_SPECIAl_ITEM_LIST[$i];}else{$order=$_GET['order'];}
if($_GET['order']=="date"){$order=$DEFAULT_ORDER[$i];}
if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="ASC";}
$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item." ORDER BY ".$order." ".$direction."");
} else {
/* NO ORDER SET */
if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="DESC";}
$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item." ORDER BY ".$DEFAULT_ORDER." ".$direction."");
}

if(mysql_num_rows($GET_ITEMS)<1){
/* NO ENTRIES */
?>
<div class="formLayoutFull InBetween alignCenter">
<div class="formLayoutFullRow InBetween">
<div class="formLayoutFullCol InBetween">
<?php						
echo "<h2>".$ITEMS_LIST_NAMES_LIST[$i]."</h2>";
?>
</div>
</div>
</div>
<div class="formLayoutFull InBetween alignCenter BorderLeftRight BorderTop BorderBottom">
<div class="formLayoutFullRow InBetween">
<div class="formLayoutFullCol InBetween valignMiddle"> No Ads were found or even exist in the database. :( <a href="?menu=ad-maker&page=add-new">Start one right now!</a> </div>
</div>
</div>
<?php	
} else {
/* FOUND ENTRIES */	
?>
<div class="formLayoutFull InBetween">
<div class="formLayoutFullRow InBetween">
<div class="formLayoutFullCol InBetween">
<?php						
echo "<h2>".$ITEMS_LIST_NAMES_LIST[$i]."</h2>";
?>
</div>
</div>
</div>

<div class="formLayoutFull">
<div class="formLayoutFullRow">
<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderTop BorderLeft BorderBottom">
<input type="checkbox" onclick="checkAll(this,'<?php echo $ITEMS_LIST_LIST[$i];?>')" />
</div>

<div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=ad-maker&page=manage&order=name#<?php echo $ITEMS_LIST_LIST[$i];?>">Name</a>
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="id"){echo "id DESC";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=ad-maker&page=manage&order=url">URL</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="id"){echo "id DESC";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=ad-maker&page=manage&order=type">Type</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="id"){echo "id DESC";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=ad-maker&page=manage&order=times_displayed">Displayed</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="id"){echo "id DESC";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-xsmall valignMiddle fontBig BorderTop BorderBottom BorderRight"> <a href="?menu=ad-maker&page=manage&order=dateandtime">Date</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=ad-maker&page=manage&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="id"){echo "id DESC";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div> <!-- end of column -->

</div> <!-- end of row -->

<?php
while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
@$id=$FETCH_ITEMS['id'];
@$status=$FETCH_ITEMS['status'];
@$type=$FETCH_ITEMS['type'];
@$name=$FETCH_ITEMS['name'];
@$url=$FETCH_ITEMS['url'];
@$target=$FETCH_ITEMS['target'];
@$img_location=$FETCH_ITEMS['img_location'];
@$img_border=$FETCH_ITEMS['img_border'];
@$img_alt=$FETCH_ITEMS['img_alt'];
@$img_width=$FETCH_ITEMS['img_width'];
@$img_height=$FETCH_ITEMS['img_height'];
@$img_align=$FETCH_ITEMS['img_align'];
@$times_displayed=$FETCH_ITEMS['times_displayed'];
@$dateandtime=$FETCH_ITEMS['dateandtime'];
@$date_year=$FETCH_ITEMS['date_year'];
@$date_month=$FETCH_ITEMS['date_month'];
@$date_day=$FETCH_ITEMS['date_day'];
@$date_hour=$FETCH_ITEMS['date_hour'];
@$date_min=$FETCH_ITEMS['date_min'];
@$date_sec=$FETCH_ITEMS['date_sec'];

?>
<div class="formLayoutFullRow">
<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom BorderTop">
<input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $id;?>" />
</div>
<div class="formLayoutFullCol title alignLeft width-medium valignTop BorderBottom BorderTop">
<?php if($name!=""){echo "<a href=\"\">".$name."</a>";}else{echo "<a href=\"\">".$name."</a>";}?>
<br />
<em style="font-style:normal; color:gray;"><?php echo $status;?><?php if($featured=="yes"){echo " | Featured";}?></em> <br />
<?php if($status=="deleted"){?><a href="?menu=ad-maker&page=manage&action=recover&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&adid=<?php echo $id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Recover</a> | <a href="?menu=ad-maker&page=manage&action=deleteperm&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&adid=<?php echo $id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete Permanently</a><?php }else{?><a href="?menu=ad-maker&page=manage&action=edit&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&adid=<?php echo $id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Edit</a> | <a href="?menu=ad-maker&page=manage&action=delete&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&adid=<?php echo $id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete</a><?php }?></div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $url;?> </div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $type;?> </div>
<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom BorderTop"> <?php echo $times_displayed;?> </div>
<div class="formLayoutFullCol alignLeft width-xsmall valignMiddle BorderRight BorderBottom BorderTop">
<?php echo $dateandtime;?>
</div>
</div>
<?php
} /* END OF _FETCH_ITEMS WHILE LOOP */
?>

</div> <!-- end of table -->
<?php
}
?>
</div>
<!-- end _container -->
<?php
}
/* END BEGIN GETTING THE ENTERIES OR WHAT EVER YOU GUYS DO :P */
?>
</div>
<br />
<br />
<?php
}

?>
