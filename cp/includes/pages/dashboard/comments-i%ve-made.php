<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
$FULL_PAD=getGlobalVars($properties,'comments_pad');
$FULL_PAD_LIST=explode(",",$FULL_PAD); //you will get [0](P) content
$ITEMS_PAD="";
$VECTOR="";
for($ipad=0; $ipad<count($FULL_PAD_LIST); $ipad++){
if($FULL_PAD_LIST[$ipad]=="(PADMAIN)"){$VECTOR=$properties->PADMAIN;}
if($FULL_PAD_LIST[$ipad]=="(PAD1)"){$VECTOR=$properties->PAD1;}
if($FULL_PAD_LIST[$ipad]=="(PAD2)"){$VECTOR=$properties->PAD2;}
if($FULL_PAD_LIST[$ipad]=="(PAD3)"){$VECTOR=$properties->PAD3;}
if($FULL_PAD_LIST[$ipad]=="(PAD4)"){$VECTOR=$properties->PAD4;}
$FULL_PAD_LIST.=$VECTOR.",";
}
$ITEMS_PAD=$FULL_PAD;
$ITEMS_PAGE=getGlobalVars($properties,'comments_page');
$ITEMS_LIST=getGlobalVars($properties,'comments_list');
$ITEMS_DEFAULT_LIST=getGlobalVars($properties,'comments_defaults'); // this is where you tell us what item is default to display
$SUBITEMS_LIST=getGlobalVars($properties,'comments_sublist'); //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES=getGlobalVars($properties,'comments_names');
$ITEMS_LIST_SPECIAL=getGlobalVars($properties,'comments_special'); //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM=getGlobalVars($properties,'comments_special_item'); //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER=getGlobalVars($properties,'comments_default_order'); //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
$ITEMS_COLUMNS="title,content,director,studio,network,category,tags,dateandtime,dateandtime_goingtostart,date_year,date_month,date_day,date_hour,date_min,date_sec,original_run_start,original_run_end,is_searchable,episodes,reviewedby,watch_type,plot,eye_candy,screenshots,status:::title,content,author,category,tags,dateandtime,dateandtime_goingtostart,date_year,date_month,date_day,date_hour,date_min,date_sec,is_searchable,status,featured,featured_image:::title,author,link,dateandtime,dateandtime_goingtostart,description,category,tags,status:::name,author,description,filename,portfolio_id,image_name,image_size_width,image_size_full_width,image_size_height,image_size_full_height,type,dateandtime,dateandtime_goingtostart,tags,installation,is_searchable,is_installable,progress,featured,featured_image,status:::"; //these are the columns that exist in the $SUBITEMS_LIST separated by ::: for each ITEM and separated by , for each column

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
.width-large {
width: 360px;
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
<h1>Comments I've Made</h1>
Filter by
<select id="_chooser" onchange="_chooser();">
<option value="all">All Comments</option>
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
<option value="<?php echo $item;?>"><?php echo $name;?> Comments</option>
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
if(isset($_POST['editpost_publish'])){
/* STEP 1: GET DATA */
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];

$editpost_yname=mysql_real_escape_string($_POST['editpost_yname']);
$editpost_yemail=mysql_real_escape_string($_POST['editpost_yemail']);
$editpost_yweb=mysql_real_escape_string($_POST['editpost_yweb']);
$editpost_mood=mysql_real_escape_string($_POST['editpost_mood']);
$editpost_title=mysql_real_escape_string($_POST['editpost_title']);
$editpost_content=mysql_real_escape_string($_POST['editpost_content']);
$editpost_date=mysql_real_escape_string($_POST['editpost_date']);
$editpost_time=mysql_real_escape_string($_POST['editpost_time']);
$editpost_status=mysql_real_escape_string($_POST['editpost_status']);
$editpost_extra_notes=mysql_real_escape_string($_POST['editpost_extra_notes']);
$editpost_is_searchable=mysql_real_escape_string($_POST['editpost_is_searchable']);

/* STEP 2: CHECK DATA FOR ACCURACY */
if(($editpost_status=="Deleted") || ($editpost_status=="Recovered")){$error_console.="<br />Status cannot be set on Deleted or Recovered.";}										

if($error_console!=""){
echo $error_console." <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go Back</a>";
} else {
/* STEP 3: UPLOAD/SAVE */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET yname='".$editpost_yname."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET yemail='".$editpost_yemail."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET yweb='".$editpost_yweb."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET mood='".$editpost_mood."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET title='".$editpost_title."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content='".$editpost_content."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime='".$editpost_date." ".$editpost_time."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='".$editpost_status."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET is_searchable='".$editpost_is_searchable."' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");

/* STEP 4: POST RETURN OF RECEIPT */
echo "<br /><b>".$editpost_title."</b> has been successfully updated! <a href=\"".$WEBSITE_URL."?menu=dashboard&page=comments-i%ve-made\">Refresh</a>";
}
} else {
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
/* CREATE what starter */
$what_starter=substr($what,0,strpos($what,"_entries"));

$GET_ENTRY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."' AND status != 'Deleted' AND yemail='".$user_logged_email."'");
if(mysql_num_rows($GET_ENTRY_INFO)<1){
echo "<br />Cannot find a comment with the info you provided (truth is you probably changed the URL or the entry has been deleted, you can recover it by clicking the &quot;Recover&quot; next to the &quot;Edit&quot; button). <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";	
} else {
while($FETCH_ENTRY_INFO=mysql_fetch_array($GET_ENTRY_INFO)){
$editpost_yname=$FETCH_ENTRY_INFO['yname'];
$editpost_yemail=$FETCH_ENTRY_INFO['yemail'];
$editpost_yweb=$FETCH_ENTRY_INFO['yweb'];
$editpost_mood=$FETCH_ENTRY_INFO['mood'];
$editpost_title=$FETCH_ENTRY_INFO['title'];
$editpost_content=$FETCH_ENTRY_INFO['content'];
$editpost_dateandtime=$FETCH_ENTRY_INFO['dateandtime'];
$editpost_status=$FETCH_ENTRY_INFO['status'];
$editpost_extra_notes=$FETCH_ENTRY_INFO['extra_notes'];
$editpost_is_searchable=$FETCH_ENTRY_INFO['is_searchable'];

//make date
//0000-00-00 00:00:00
//0123456789012345678

$editpost_dateyear=substr($editpost_dateandtime,0,4);
$editpost_datemonth=substr($editpost_dateandtime,5,2);
$editpost_dateday=substr($editpost_dateandtime,8,2);
$editpost_datehour=substr($editpost_dateandtime,11,2);
$editpost_datemin=substr($editpost_dateandtime,14,2);
$editpost_datesec=substr($editpost_dateandtime,17,2);

$GET_THE_ENTRY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$base."_entries WHERE id='".$entryid."'");
$FETCH_THE_ENTRY=mysql_fetch_array($GET_THE_ENTRY);
$entry_name=$FETCH_THE_ENTRY['title'];

echo "<h3>Editing the comment of &quot;".$editpost_title."&quot; posted on the Entry: ".$entry_name." apart of the: ".$pop."</h3>";
?>
<form action="" method="post">
<div class="cp-table">
<div class="cp-row">
<div class="cp-lcol">
<div class="formLayoutTable">
<div class="formLayoutTableRow">
<div class="formLayoutTableRowLeftCol">
<input type="text" name="editpost_title" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $editpost_title;?>" class="full-input" />
</div>
<div class="formLayoutTableRowRightCol"> </div>
</div>
<div class="formLayoutTableRow">
<div class="formLayoutTableRowLeftCol">

</div>
<div class="formLayoutTableRowRightCol"> </div>
</div>
<br />
<div class="formLayoutTableRow">
<div class="formLayoutTableRowLeftCol">
<h2>Description</h2>
<div class="innerTable">
<div class="innerTableRow">
<div class="innerTableRowLeftCol">
<a href="#" class="add">Insert</a>
</div>
<div class="innerTableRowRightCol">
Kitchen Sink: <a href="#" class="toggle"><span>On</span></a>
</div>
</div>
</div>
<textarea name="editpost_content" id="nEditor" rows="30" cols="80"><?php echo $editpost_content;?></textarea>
<script type="text/javascript">
$(function() {
$('#nEditor').markItUp(nEditorSettings);
// You can add content from anywhere in your page
// $.markItUp( { Settings } );	
$('.add').click(function() {
$('#nEditor').markItUp('insert',
{ 	openWith:'<opening tag>',
closeWith:'<\/closing tag>',
placeHolder:"New content"
}
);
return false;
});

// And you can add/remove markItUp! whenever you want
// $(textarea).markItUpRemove();
$('.toggle').click(function() {
if ($("#nEditor.markItUpEditor").length === 1) {
$("#nEditor").markItUp('remove');
$("span", this).text("Off");
} else {
$('#nEditor').markItUp(nEditorSettings);
$("span", this).text("On");
}
return false;
});
});
</script>

<?php
if($base=="work"){
?>
<h2>Installable Instructions</h2>
<div class="innerTable">
<div class="innerTableRow">
<div class="innerTableRowLeftCol">
<a href="#" class="add">Insert</a>
</div>
<div class="innerTableRowRightCol">
Kitchen Sink: <a href="#" class="toggle2"><span>On</span></a>
</div>
</div>
</div>
<textarea name="editpost_installation" id="nEditor2" rows="30" cols="80"><?php echo $postid_installation;?></textarea>
<script type="text/javascript">
$(function() {
$('#nEditor2').markItUp(nEditorSettings);
// You can add content from anywhere in your page
// $.markItUp( { Settings } );	
$('.add').click(function() {
$('#nEditor2').markItUp('insert',
{ 	openWith:'<opening tag>',
closeWith:'<\/closing tag>',
placeHolder:"New content"
}
);
return false;
});

// And you can add/remove markItUp! whenever you want
// $(textarea).markItUpRemove();
$('.toggle2').click(function() {
if ($("#nEditor2.markItUpEditor").length === 1) {
$("#nEditor2").markItUp('remove');
$("span", this).text("Off");
} else {
$('#nEditor2').markItUp(nEditorSettings);
$("span", this).text("On");
}
return false;
});
});
</script>
<?php
}
?>
</div>
<div class="formLayoutTableRowRightCol"></div>
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
<input type="submit" name="editpost_publish" value="Save" class="submit" />
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
<select name="editpost_status">
<?php if($editpost_status=="Approved"){?>
<option value="Approved" selected="selected" disabled="disabled">Approved</option>
<?php } else {?>
<option value="Approved" disabled="disabled">Approved</option>
<?php }?>

<?php if($editpost_status=="Pending"){?>
<option value="Pending" selected="selected">Pending</option>
<?php } else {?>
<option value="Pending">Pending</option>
<?php }?>

<?php if($editpost_status=="Denied"){?>
<option value="Denied" disabled="disabled" selected="selected">Denied</option>
<?php } else {?>
<option value="Denied" disabled="disabled">Denied</option>
<?php }?>

<?php if($editpost_status=="Deleted"){?>
<option value="Deleted" selected="selected" disabled="disabled">Deleted</option>
<?php } else {?>
<option value="Deleted" disabled="disabled">Deleted</option>
<?php }?>

<?php if($editpost_status=="Recovered"){?>
<option value="Recovered" selected="selected" disabled="disabled">Recovered</option>
<?php } else {?>
<option value="Recovered" disabled="disabled">Recovered</option>
<?php }?>
</select>
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> Mood: </div>
<div class="formLayoutTableRowMainAllRightCol">
<select name="editpost_mood">
<?php
$DISPLAY_BLOG_MOODS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$base."_moods ORDER BY name");
if(mysql_num_rows($DISPLAY_BLOG_MOODS)<1){
	?>
    <option value="">---- No Moods :( ----</option>
    <?php	
} else {
	while($FETCH_DISPLAY_BLOG_MOODS=mysql_fetch_array($DISPLAY_BLOG_MOODS)){
		?>
        <option value="<?php echo $FETCH_DISPLAY_BLOG_MOODS['id'];?>"><?php echo $FETCH_DISPLAY_BLOG_MOODS['name'];?></option>
        <?php
	}
}
?>
</select>
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> 
<script type="text/javascript">
$(function() {
$('#editpost_date').datepick({dateFormat: 'yyyy-mm-dd'});
//$('#inlineDatepicker').datepick({onSelect: showDate});
});
</script> 
Date: </div>
<div class="formLayoutTableRowMainAllRightCol">
<input type="date" name="editpost_date" min="<?php echo $editpost_dateyear."-".$editpost_datemonth."-".$editpost_dateday;?>" id="editpost_date" value="<?php echo $editpost_dateyear."-".$editpost_datemonth."-".$editpost_dateday;?>" style="width:120px;" />
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> Time: </div>
<div class="formLayoutTableRowMainAllRightCol">
<input type="time" name="editpost_time" step="1" value="<?php echo $editpost_datehour.":".$editpost_datemin.":".$editpost_datesec;?>" style="width:120px;" />
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> Name: </div>
<div class="formLayoutTableRowMainAllRightCol">
<input type="text" name="editpost_yname" value="<?php echo $editpost_yname?>" />
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> Email: (<a title="Changing this may remove it from your &quot;Comments I've Made&quot; section." style="cursor: help;">?</a>)</div>
<div class="formLayoutTableRowMainAllRightCol">
<input type="text" name="editpost_yemail" value="<?php echo $editpost_yemail?>" />
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> Website: </div>
<div class="formLayoutTableRowMainAllRightCol">
<input type="text" name="editpost_yweb" value="<?php echo $editpost_yweb?>" />
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> Searchable? </div>
<div class="formLayoutTableRowMainAllRightCol">
<?php if($editpost_is_searchable == "yes"){?>
<input type="radio" name="editpost_is_searchable" value="yes" class="radio" checked="checked" />
Yes
<input type="radio" name="editpost_is_searchable" value="no" class="radio" />
No
<?php } else {?>
<input type="radio" name="editpost_is_searchable" value="yes" class="radio" />
Yes
<input type="radio" name="editpost_is_searchable" value="no" checked="checked" class="radio" />
No
<?php }?>
</div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> Notes: </div>
<div class="formLayoutTableRowMainAllRightCol">
<input type="text" name="editpost_extra_notes" value="<?php echo $editpost_extra_notes?>" />
</div>
</div>
</div>
<?php
/* -------------- CUSTOMIZED ADDONS ------------------------------------------------------------------------------ */
/* HERE IS WHERE YOU CAN ADD YOUR OWN CUSTOMIZED FIELDS FOR TABLES THAT HAVE OTHER STUFF IN THEM THAT ARE NOT THE  */
/* SAME AS THE BASIC SETUP. MAKE SURE TO ADD THE POST ACTION STUFF UP AT THE TOP.                                  */

/* ADDON NAME: TEMPLATE */
?>
<!-- TEMPLATE
<div class="formLayoutTable">
<div class="formLayoutTableRow">
<div class="formLayoutTableRowLeftCol">
<h2>ADDON NAME</h2>
<input type="text" name="editpost_ADDONNAME" value="<?php //echo $postid_addon_ADDONNAME;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:280px;" />
</div>
<div class="formLayoutTableRowRightCol">

</div>
</div>
</div>
-->
<?php
/* END ADDON NAME: TEMPLATE */
/* ------------ END CUSTOMIZED ADDONS ------------------------------------------------------------------------------ */
?>
</div>
</div>
</div>
</form>
<?php
}
}}

break;
case 'delete':
if(isset($_POST['undo_delete'])){
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$postid=$_GET['postid'];
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Pending' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."' AND yemail='".$user_logged_email."'");
echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=dashboard&page=comments-i%ve-made\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$postid=$_GET['postid'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."' AND yemail='".$user_logged_email."'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Comments, with the ID: <b>".$commentid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$title=$FETCH_POST['title'];
}
if($_POST['ays_answer']=="yes"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."' AND yemail='".$user_logged_email."'");
?>
<form method="post">
<br />Okay I have deleted the comment titled: <b><?php echo $title;?></b> posted on the <?php echo ucfirst($pop);?> (<input type="submit" name="undo_delete" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=dashboard&page=comments-i%ve-made" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="no"){
echo "<br />Alright sounds fair to me, I will leave the comment titled: <b>".$title."</b> on the <b>".ucfirst($pop)."</b> alone. <a href=\"".$WEBSITE_URL."?menu=dashboard&page=comments-i%ve-made\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$postid=$_GET['postid'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
if(mysql_num_rows($GET_POST)<1){
echo "No Comments, with the ID: <b>".$commentid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$title=$FETCH_POST['title'];
}				
?>
<form method="post">
<br />Are you sure you want to delete the comment titled: <b><?php echo $title;?></b> posted on the <b><?php echo ucfirst($pop);?></b>? 
<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php
}	
}	
}
break;
case 'recover':
if(isset($_POST['undo_recover'])){
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$postid=$_GET['postid'];
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'") or die(mysql_error());
echo "<br />I just deleted it again, you sure are having a hard time making up your mind. :) <a href=\"".$WEBSITE_URL."?menu=dashboard&page=comments-i%ve-made\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$postid=$_GET['postid'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
if(mysql_num_rows($GET_POST)<1){
echo "No Comments, with the ID: <b>".$commentid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$title=$FETCH_POST['title'];
}
if($_POST['ays_answer']=="yes"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
?>
<form method="post">
<br />Okay I have recovered the comment titled: <b><?php echo $title;?></b> from the Trash and placed it in the <?php echo ucfirst($pop);?> (<input type="submit" name="undo_recover" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=dashboard&page=comments-i%ve-made" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="no"){
echo "<br />Alright sounds fair to me, I will leave the comment titled: <b>".$title."</b> in the Trash. <a href=\"".$WEBSITE_URL."?menu=posts\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$commentid=$_GET['commentid'];
$entryid=$_GET['entryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$postid=$_GET['postid'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$commentid."' AND entry_id='".$entryid."' AND yemail='".$user_logged_email."'");
if(mysql_num_rows($GET_POST)<1){
echo "No Comments, with the ID: <b>".$commentid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$title=$FETCH_POST['title'];
}				
?>
<form method="post">
<br />Are you sure you want to recover the comment titled: <b><?php echo $title;?></b> from the Trash? It will be returned to the <b><?php echo ucfirst($pop);?></b>. <input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
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
$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item." WHERE yemail='".$user_logged_email."' ORDER BY ".$order." ".$direction."");
} else {
/* NO ORDER SET */
if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="DESC";}
$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item." WHERE yemail='".$user_logged_email."' ORDER BY ".$DEFAULT_ORDER." ".$direction."");
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
<div class="formLayoutFullCol InBetween valignMiddle"> You have not commented on anything yet.</div>
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

<div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=dashboard&page=comments-i%ve-made&order=title#<?php echo $ITEMS_LIST_LIST[$i];?>">Title</a>
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=dashboard&page=comments-i%ve-made&order=commenter">Poster</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=dashboard&page=comments-i%ve-made&order=mood">Mood</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> Content </div>

<div class="formLayoutFullCol alignCenter width-medium valignMiddle fontBig BorderTop BorderBottom"> Extra Notes </div>

<div class="formLayoutFullCol alignLeft width-xsmall valignMiddle fontBig BorderTop BorderBottom BorderRight"> <a href="?menu=dashboard&page=comments-i%ve-made&order=dateandtime">Date</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=dashboard&page=comments-i%ve-made&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div> <!-- end of column -->

</div> <!-- end of row -->

<?php
while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
@$id=$FETCH_ITEMS['id'];
@$yname=$FETCH_ITEMS['yname'];
@$yemail=$FETCH_ITEMS['yemail'];
@$yweb=$FETCH_ITEMS['yweb'];
@$mood=$FETCH_ITEMS['mood'];
@$titlecomment=$FETCH_ITEMS['title'];
@$content=$FETCH_ITEMS['content'];
@$dateandtime=$FETCH_ITEMS['dateandtime'];
@$entry_id=$FETCH_ITEMS['entry_id'];
@$status=$FETCH_ITEMS['status'];
@$comment_ticket_id=$FETCH_ITEMS['comment_ticket_id'];
@$extra_notes=$FETCH_ITEMS['extra_notes'];
@$is_searchable=$FETCH_ITEMS['is_searchable'];

//fetch the mood
$GET_ITEMS_MOOD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_moods WHERE id='".$mood."'");
if(mysql_num_rows($GET_ITEMS_MOOD)<1){
	/* NO MOODS */	
	$the_comment_mood="No mood";
} else {
	/* DISPLAY MOOD NAME */
	while($FETCH_ITEMS_MOOD=mysql_fetch_array($GET_ITEMS_MOOD)){
		$mood_name=$FETCH_ITEMS_MOOD['name'];
		$the_comment_mood=$mood_name;
	}	
}

//fetch the entry name
$GET_ITEMS_ENTRYNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_entries WHERE id='".$entry_id."'");
if(mysql_num_rows($GET_ITEMS_ENTRYNAME)<1){
	/* NO MOODS */	
	$the_comment_entry_name="No Entry Name";
} else {
	/* DISPLAY ENTRY NAME */
	while($FETCH_ITEMS_ENTRYNAME=mysql_fetch_array($GET_ITEMS_ENTRYNAME)){
		$entry_name=$FETCH_ITEMS_ENTRYNAME['title'];
		$the_comment_entry_name=$entry_name;
	}	
}

?>
<div class="formLayoutFullRow">
<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom BorderTop">
<input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $id;?>" />
</div>
<div class="formLayoutFullCol title alignLeft width-large valignTop BorderBottom BorderTop">
<?php if($name!=""){echo "<a href=\"\">".$titlecomment."</a>";}else{echo "<a href=\"\">".$titlecomment."</a>";}?>
<br />
<em style="font-style:normal; color:gray;"><?php echo $status;?></em>
<br />
<em style="font-style:normal; font-size: 12px; color:gray;">Posted on <b><?php if(strlen($entry_name)>44){echo substr($entry_name,0,44)."...";}else{echo $entry_name;}?></b></em>
<br />
<em style="font-style:normal; color:gray;">Ticket #: <?php echo $comment_ticket_id;?></em>
<br />
<?php if($status=="Deleted"){
	?>
    <a href="?menu=dashboard&page=comments-i%ve-made&action=recover&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&commentid=<?php echo $id;?>&entryid=<?php echo $entry_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Recover</a>
	<?php
    } else {
	?>
    <a href="?menu=dashboard&page=comments-i%ve-made&action=edit&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&commentid=<?php echo $id;?>&entryid=<?php echo $entry_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Edit</a>
     | 
    <a href="?menu=dashboard&page=comments-i%ve-made&action=delete&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&commentid=<?php echo $id;?>&entryid=<?php echo $entry_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete</a>
	<?php
    }
	?>     
    
    </div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php if($yweb!=$WEBSITE_URL){echo "<a href=\"".$yweb."\">YOU</a>";}else{echo "YOU";}?> </div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $the_comment_mood;?> </div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $content;?> </div>
<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom BorderTop"> <?php if($extra_notes==""){echo "...No notes...";}else{echo $extra_notes;}?> </div>
<div class="formLayoutFullCol alignLeft width-xsmall valignMiddle BorderRight BorderBottom BorderTop">
<?php if($dateandtime=="0000-00-00 00:00:00"){echo $dateandtime_goingtostart;}else{echo $dateandtime;}?>
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
