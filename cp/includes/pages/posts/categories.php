<?php
//tell us categories you want to get (the table names without the "_categories" part that is)
$FULL_PAD=getGlobalVars($properties,'posts_pad');
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
$ITEMS_PAGE=getGlobalVars($properties,'posts_page');
$ITEMS_LIST=getGlobalVars($properties,'posts_list');
$ITEMS_DEFAULT_LIST=getGlobalVars($properties,'posts_defaults'); // this is where you tell us what item is default to display
$SUBITEMS_LIST=getGlobalVars($properties,'posts_sublist'); //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES=getGlobalVars($properties,'posts_names');
$ITEMS_LIST_SPECIAL=getGlobalVars($properties,'posts_special'); //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM=getGlobalVars($properties,'posts_special_item'); //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER=getGlobalVars($properties,'posts_default_order'); //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
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
<h1>Categories <a href="?menu=posts&page=categories&action=addnew" class="small">Add New</a></h1>
Filter by
<select id="_chooser" onchange="_chooser();">
<option value="all">All Types</option>
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
<option value="<?php echo $item;?>"><?php echo $name;?> Type</option>
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
if($type == "admin" || $type == "writer"){
	if(isset($_POST['editpost_publish'])){
	/* STEP 1: GET DATA */
	$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	
	$editpost_name=mysql_real_escape_string($_POST['editpost_name']);
	$editpost_shortname=str_replace(" ","-",$editpost_name);
	$editpost_is_searchable=mysql_real_escape_string($_POST['editpost_is_searchable']);
	$editpost_status=mysql_real_escape_string($_POST['editpost_status']);
	
	/* STEP 2: CHECK DATA FOR ACCURACY */
	if(($editpost_status=="Deleted") || ($editpost_status=="Recovered")){$error_console.="<br />Status cannot be set on Deleted or Recovered.";}											
	
	if($editpost_name==""){$error_console.="<br />You must provide a name for the category.";}
	
	if($error_console!=""){
	echo $error_console." <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go Back</a>";
	} else {
	/* STEP 3: UPLOAD/SAVE */
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET name='".$editpost_name."' WHERE id='".$catid."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET shortname='".$editpost_shortname."' WHERE id='".$catid."'");
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET is_searchable='".$editpost_is_searchable."' WHERE id='".$catid."'") or die(mysql_error());
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='".$editpost_status."' WHERE id='".$catid."'");
	
	/* STEP 4: POST RETURN OF RECEIPT */
	echo "<br /><b>".$editpost_name."</b> has been successfully updated! <a href=\"".$WEBSITE_URL."?menu=posts&page=categories\">Refresh</a>";
	}
	} else {$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	/* CREATE what starter */
	$what_starter=substr($what,0,strpos($what,"_entries"));
	
	$GET_ENTRY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."' AND status != 'Deleted'");
	if(mysql_num_rows($GET_ENTRY_INFO)<1){
	echo "<br />Cannot find a Category with the info you provided (truth is you probably changed the URL or the entry has been deleted, you can recover it by clicking the &quot;Recover&quot; next to the &quot;Edit&quot; button). <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";	
	} else {
	while($FETCH_ENTRY_INFO=mysql_fetch_array($GET_ENTRY_INFO)){
	$catid_name=$FETCH_ENTRY_INFO['name'];
	$catid_is_searchable=$FETCH_ENTRY_INFO['is_searchable'];
	$catid_status=$FETCH_ENTRY_INFO['status'];
	
	echo "<h3>Editing the Category of &quot;".$catid_name."&quot; apart of the page: ".$pop."</h3>";
	
	?>
	<form action="" method="post">
	<div class="cp-table">
	<div class="cp-row">
	<div class="cp-lcol">
	<div class="formLayoutTable">
	<div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol">
	<label>Name</label>
	<input type="text" name="editpost_name" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $catid_name;?>" class="full-input" />
	</div>
	<div class="formLayoutTableRowRightCol"> </div>
	</div>
	<div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol"> </div>
	<div class="formLayoutTableRowRightCol"> </div>
	</div>
	<br />
	<div class="formLayoutTableRow">
	<div class="formLayoutTableRowLeftCol">
	
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
	<?php if($catid_status=="Active"){?>
	<option value="Active" selected="selected">Active</option>
	<?php } else {?>
	<option value="Active">Active</option>
	<?php }?>
	
	<?php if($catid_status=="Deleted"){?>
	<option value="Deleted" selected="selected" disabled="disabled">Deleted</option>
	<?php } else {?>
	<option value="Deleted" disabled="disabled">Deleted</option>
	<?php }?>
	
	<?php if($catid_status=="Recovered"){?>
	<option value="Recovered" selected="selected" disabled="disabled">Recovered</option>
	<?php } else {?>
	<option value="Recovered" disabled="disabled">Recovered</option>
	<?php }?>
	</select>
	</div>
	</div>
	
	<div class="formLayoutTableRowMainAll">
	<div class="formLayoutTableRowMainAllLeftCol"> Searchable? </div>
	<div class="formLayoutTableRowMainAllRightCol">
	<?php if($catid_is_searchable == "yes"){?>
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
	</div>
	
	</div>
	</div>
	</div>
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
case 'delete':
if($type == "admin" || $type == "writer"){
	if(isset($_POST['undo_delete'])){
	$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$catid=$_GET['catid'];
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$catid."'");
	echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=posts&page=categories\" style=\"cursor:pointer;\">Refresh</a>";
	} else {
	if(isset($_POST['ays_answer'])){
	/* STEP 1: GET DATA */
	$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$catid=$_GET['catid'];
	
	/* STEP 2: CHECK FOR ANSWER (blank) */
	if($_POST['ays_answer']==""){
	echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."'");
	if(mysql_num_rows($GET_POST)<1){
	echo "No Categories, with the ID: <b>".$catid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$title=$FETCH_POST['name'];
	}
	if($_POST['ays_answer']=="yes"){
	/* STEP 4: "DELETE" (really set the status to Deleted) */
	mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$catid."'");
	?>
	<form method="post">
	<br />Okay I have deleted <b><?php echo $title;?></b> from <?php echo ucfirst($pop);?> (<input type="submit" name="undo_delete" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=posts&page=categories" style="cursor:pointer;">Refresh</a>
	</form>
	<?php
	} else if($_POST['ays_answer']=="no"){
	echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> from <b>".ucfirst($pop)."</b> alone. <a href=\"".$WEBSITE_URL."?menu=posts&page=categories\" style=\"cursor:pointer;\">Refresh</a>";
	}
	}										
	}
	} else {
	/* STEP 1: GET DATA */
	$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$catid=$_GET['catid'];
	
	/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."'");			
	if(mysql_num_rows($GET_POST)<1){
	echo "No Categories, with the ID: <b>".$catid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: CONFIRM DELETE */
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$title=$FETCH_POST['name'];
	}				
	?>
	<form method="post">
	<br />Are you sure you want to delete <b><?php echo $title;?></b> from the <b><?php echo ucfirst($pop);?></b>? 
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
if($type == "admin" || $type == "writer"){
	if(isset($_POST['forsure_ays_answer'])){
	/* STEP 1: GET DATA */
	$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$catid=$_GET['catid'];
	
	/* STEP 2: DELETE THE ENTRY */
	mysql_query("DELETE FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."'");
	?>
	<br />Okay I have permanently deleted <b><?php echo $title;?></b> from the Trash which was apart of <b><?php echo ucfirst($pop);?></b> (cannot undo) <a href="<?php echo $WEBSITE_URL;?>?menu=posts&page=categories" style="cursor:pointer;">Refresh</a>
	<?php
	} else {
	if(isset($_POST['ays_answer'])){
	/* STEP 1: GET DATA */
	$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$catid=$_GET['catid'];
	
	/* STEP 2: CHECK FOR ANSWER (blank) */
	if($_POST['ays_answer']==""){
	echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."'");
	if(mysql_num_rows($GET_POST)<1){
	echo "No Categories, with the ID: <b>".$catid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	if($_POST['ays_answer']=="no"){
	?>
	"<br />Okay I have left <b><?php echo $title;?></b> in the Trash which was apart of <b><?php echo ucfirst($pop);?></b>. <a href="<?php echo $WEBSITE_URL;?>?menu=posts&page=categories" style="cursor:pointer;">Refresh</a>
	<?php
	} else {
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$title=$FETCH_POST['title'];
	}									
	?>
	<form method="post">
	<br />Are you really sure you want to permanently delete <b><?php echo $title;?></b> from the <b><?php echo ucfirst($pop);?></b> which is currently in the trash? (you will lose all data on this post; just making sure you understand)
	<input type="radio" name="forsure_ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="forsure_ays_answer" value="no" onclick="this.form.submit();" /> No
	</form>
	<?php	
	}
	}										
	}
	} else {
	/* STEP 1: GET DATA */
	$catid=$_GET['catid'];
	$what=$_GET['what'];
	$pad=$_GET['pad'];
	$pop=$_GET['pop'];
	$base=$_GET['base'];
	$subbase=$_GET['subbase'];
	$catid=$_GET['catid'];
	
	/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
	$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."'");			
	if(mysql_num_rows($GET_POST)<1){
	echo "No Categories, with the ID: <b>".$catid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
	} else {
	/* STEP 3: CONFIRM DELETE */
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
	$title=$FETCH_POST['name'];
	}				
	?>
	<form method="post">
	<br />Are you sure you want to permanently delete <b><?php echo $title;?></b> from the <b><?php echo ucfirst($pop);?> which is currently in the trash</b>? (this action cannot be undone)
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
$catid=$_GET['catid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$catid=$_GET['catid'];
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$catid."'") or die(mysql_error());
echo "<br />I just deleted it again, you sure are having a hard time making up your mind. :) <a href=\"".$WEBSITE_URL."?menu=posts&page=categories\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$catid=$_GET['catid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$catid=$_GET['catid'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."'");
if(mysql_num_rows($GET_POST)<1){
echo "No Categories, with the ID: <b>".$catid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$title=$FETCH_POST['name'];
}
if($_POST['ays_answer']=="yes"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$catid."'");
?>
<form method="post">
<br />Okay I have recovered <b><?php echo $title;?></b> from the Trash and placed it in <?php echo ucfirst($pop);?> (<input type="submit" name="undo_recover" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=posts&page=categories" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="no"){
echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> in the Trash. <a href=\"".$WEBSITE_URL."?menu=posts&page=categories\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$catid=$_GET['catid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$catid=$_GET['catid'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$catid."'");			
if(mysql_num_rows($GET_POST)<1){
echo "No Categories, with the ID: <b>".$catid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$title=$FETCH_POST['name'];
}				
?>
<form method="post">
<br />Are you sure you want to recover <b><?php echo $title;?></b> from the Trash? It will be returned to <b><?php echo ucfirst($pop);?></b>. <input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php
}	
}	
}
break;	

case 'addnew':
if($type == "admin" || $type == "writer"){
	if(isset($_POST['addnew_next_next'])){
		//GET LAST FORM DATA
		$addnew_name=$_POST['addnew_name'];
		$addnew_belongto=$_POST['addnew_belongto'];
		if($addnew_belongto == ""){
			echo "<br />You must tell me where to put it. <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";
		} else {
			//THE SAVE PHASE
			/* CHECK TO SEE IF CATEGORY EXISTS */
			$CHECK_CAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$addnew_belongto."_categories WHERE name='".$addnew_name."'");
			if(mysql_num_rows($CHECK_CAT)<1){
				/* DOES NOT EXIST; PROCEED */
				/* SAVE */
				mysql_query("INSERT INTO {$properties->DB_PREFIX}".$addnew_belongto."_categories (name,shortname,parentid,is_searchable,status) VALUES ('".$addnew_name."','".str_replace(" ","-",$addnew_name)."','0','yes','Active')");
				echo "<br />The Category <b>".$addnew_name."</b> has successfully been added to <b>".$addnew_belongto."</b>. <a href=\"".$WEBSITE_URL."?menu=posts&page=categories\" style=\"cursor:pointer;\">Refresh</a>.";
			} else {
				/* ALREADY EXISTS */
				echo "<br /><b>".$addnew_name."</b> already exists in <b>".$addnew_belongto."</b>. <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";
			}
		}
	} else {
		if(isset($_POST['addnew_next'])){
			//GET LAST FORM DATA
			$addnew_name=$_POST['addnew_name'];
			if($addnew_name == ""){
				echo "<br />You must give it a name. <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";
			} else {
				/* NEXT PHASE */
				?>
				<h2>What does it belong to?</h2>
				<form method="post">
					<input type="hidden" name="addnew_name" value="<?php echo $addnew_name;?>" />
					<select name="addnew_belongto">
						<option value="">---- choose one ----</option>
						<?php
						/* GET THE THINGS */
						for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
							$item=$ITEMS_LIST_LIST[$i];
							$name=$ITEMS_LIST_NAMES_LIST[$i];
							?>
							<option value="<?php echo $item?>"><?php echo $name;?></option>
							<?php
						}
						?>
					</select>
					<br /><br />    
					<input type="submit" name="addnew_next_next" value="Next" style="width: 60px;height:30px;font-size:18px;" />
					OR <a onclick="history.go(-1)" style="cursor:pointer;">Go Back</a>
				</form>
				<?php
			}
		} else {
			?>
			<h2>What do you want to call the new category?</h2>
			<form method="post">
				<input type="text" name="addnew_name" style="width:300px;height:30px;font-size:18px;" />
				<br /><br />    
				<input type="submit" name="addnew_next" value="Next" style="width: 60px;height:30px;font-size:18px;" />
				OR <a href="<?php echo $WEBSITE_URL;?>?menu=posts&page=categories" style="cursor:pointer;">Cancel</a>
			</form>
			<?php
		}	
	}
} else {
	?>
    <center><h1>You do not have the permission to use this feature. :(</h1></center>
	<?php
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
if($item=="work"){$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item."_types ORDER BY name ".$direction."");}else{$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_categories ORDER BY name ".$direction."");}
} else {
/* NO ORDER SET */
if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="DESC";}
if($item=="work"){$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item."_types ORDER BY name ".$direction."");}else{$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_categories ORDER BY name ".$direction."");}
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
<div class="formLayoutFullCol InBetween valignMiddle"> No Categories were found or even exist in the database. :( <a href="?menu=posts&page=categories&action=add-new">Start one right now!</a> </div>
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

<div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom BorderRight"> <a href="?menu=posts&page=categories&order=title#<?php echo $ITEMS_LIST_LIST[$i];?>">Title</a>
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=posts&page=categories&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=posts&page=categories&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=posts&page=categories&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
<?php }?>
</div>



</div> <!-- end of row -->

<?php
while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
@$cat_id=$FETCH_ITEMS['id'];
@$title=$FETCH_ITEMS['name'];
@$status=$FETCH_ITEMS['status'];

if($item=="work"){$sub_item=str_replace("projects","projects_types",$sub_item);}else{$sub_item=str_replace("entries","categories",$sub_item);}
?>
<div class="formLayoutFullRow">
<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom BorderTop">
<input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $id;?>" />
</div>
<div class="formLayoutFullCol title alignLeft width-medium valignTop BorderBottom BorderTop BorderRight">
<?php echo "<a href=\"\">".$title."</a>";?>
<br />
<?php echo $status;?>
<br />
<?php if($status=="Deleted"){?><a href="?menu=posts&page=categories&action=recover&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&catid=<?php echo $cat_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Recover</a> | <a href="?menu=posts&page=categories&action=deleteperm&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&catid=<?php echo $cat_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete Permanently</a><?php }else{?><a href="?menu=posts&page=categories&action=edit&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&catid=<?php echo $cat_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Edit</a> | <a href="?menu=posts&page=categories&action=delete&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&catid=<?php echo $cat_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete</a><?php }?></div>
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
