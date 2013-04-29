<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
$FULL_PAD=getGlobalVars($properties,'queries_pad');
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
$ITEMS_PAGE=getGlobalVars($properties,'queries_page');
$ITEMS_LIST=getGlobalVars($properties,'queries_list');
$ITEMS_DEFAULT_LIST=getGlobalVars($properties,'queries_defaults'); // this is where you tell us what item is default to display
$SUBITEMS_LIST=getGlobalVars($properties,'queries_sublist'); //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES=getGlobalVars($properties,'queries_names');
$ITEMS_LIST_SPECIAL=getGlobalVars($properties,'queries_special'); //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM=getGlobalVars($properties,'queries_special_item'); //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER=getGlobalVars($properties,'queries_default_order'); //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
$ITEMS_POCTABLE=getGlobalVars($properties,'queries_poctable'); //if you specified "1" above then put the name of the special item else put "none"
$ITEMS_REASONTABLE=getGlobalVars($properties,'queries_reasontable'); //if you specified "1" above then put the name of the special item else put "none"
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
<h1>Queries</h1>
Filter by
<select id="_chooser" onchange="_chooser();">
<option value="all">All Queries</option>
<?php
$ITEMS_PAD_LIST=explode(",",$ITEMS_PAD);
$ITEMS_PAGE_LIST=explode(",",$ITEMS_PAGE);
$ITEMS_LIST_LIST=explode(",",$ITEMS_LIST);
$ITEMS_DEFAULT_LIST_LIST=explode(",",$ITEMS_DEFAULT_LIST);
$SUBITEMS_LIST_LIST=explode(",",$SUBITEMS_LIST);
$ITEMS_LIST_NAMES_LIST=explode(",",$ITEMS_LIST_NAMES);
$ITEMS_LIST_SPECIAL_LIST=explode(",",$ITEMS_LIST_SPECIAL);
$ITEMS_LIST_SPECIAL_ITEM_LIST=explode(",",$ITEMS_LIST_SPECIAL_ITEM);
$ITEMS_POCTABLE_LIST=explode(",",$ITEMS_POCTABLE);
$ITEMS_REASONTABLE_LIST=explode(",",$ITEMS_REASONTABLE);

/* BEGIN GETTING THE ITEMS OR WHAT EVER YOU GUYS DO :P */
for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
$item=$ITEMS_LIST_LIST[$i];			
$name=$ITEMS_LIST_NAMES_LIST[$i];
$sub_item=$SUBITEMS_LIST_LIST[$i];
$pad=$ITEMS_PAD_LIST[$i];
$page=$ITEMS_PAGE_LIST[$i];
$poctable=$ITEMS_POCTABLE_LIST[$i];
$reasontable=$ITEMS_REASONTABLE_LIST[$i];
?>
<option value="<?php echo $item."_".$sub_item;?>"><?php echo $name;?></option>
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
$poctable=$ITEMS_POCTABLE_LIST[$i];
$reasontable=$ITEMS_REASONTABLE_LIST[$i];
?>
<input type="hidden" id="element_<?php echo $i?>" value="<?php echo $item."_".$sub_item;?>" />
<?php
}
?>
<input type="hidden" id="element_count" value="<?php echo count($ITEMS_LIST_LIST)-1;?>" />
<?php
/* CATCH IF */
if(isset($_GET['action'])){
/* SWITCH THE CATCH */
switch($_GET['action']){
	
case 'delete':
if(isset($_POST['undo_delete'])){
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Open' WHERE ticket_id='".$queryid."'");
echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status != 'Deleted'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
}
if($_POST['ays_answer']=="yes"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE ticket_id='".$queryid."'");
?>
<form method="post">
<br />Okay I have deleted the query titled: <b><?php echo $contact_message;?></b> (<input type="submit" name="undo_delete" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=feedbacks&page=queries" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="no"){
echo "<br />Alright sounds fair to me, I will leave the query titled: <b>".$contact_message."</b> alone. <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status != 'Deleted'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
$atlevel=$FETCH_POST['atlevel'];
$currentpoc=$FETCH_POST['poc'];
}				
if($user_id == $currentpoc && $level == $atlevel){
?>
<form method="post">
<br />Are you sure you want to delete the query titled: <b><?php echo $contact_message;?></b>? 
<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php
} else {
	echo "<br />You cannot do anything to this query since it does not belong to you. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";	
}
}	
}	
}
break;
case 'reopen':
if(isset($_POST['undo_reopen'])){
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Closed' WHERE ticket_id='".$queryid."'");
echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status = 'Closed'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
}
if($_POST['ays_answer']=="yes"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Open' WHERE ticket_id='".$queryid."'");
?>
<form method="post">
<br />Okay I have re-opened the query titled: <b><?php echo $contact_message;?></b> (<input type="submit" name="undo_reopen" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=feedbacks&page=queries" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="no"){
echo "<br />Alright sounds fair to me, I will leave the query titled: <b>".$contact_message."</b> alone. <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status = 'Closed'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
$atlevel=$FETCH_POST['atlevel'];
$currentpoc=$FETCH_POST['poc'];
}				
if($user_id == $currentpoc && $level == $atlevel){
?>
<form method="post">
<br />Are you sure you want to re-open the query titled: <b><?php echo $contact_message;?></b>?
<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php
} else {
	echo "<br />You cannot do anything to this query since it does not belong to you. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";	
}
}	
}	
}
break;

case 'assignto':
if(isset($_POST['undo_assignto'])){
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$poctable=$_GET['poctable'];
$currentpoc=$_GET['currentpoc'];
$lastpoc=$_POST['undo_lastpoc'];
$lastnotes=$_POST['undo_lastnotes'];

mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET poc='".$lastpoc."' WHERE ticket_id='".$queryid."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET extra_notes='".$lastnotes."' WHERE ticket_id='".$queryid."'");
echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$poctable=$_GET['poctable'];
$currentpoc=$_GET['currentpoc'];
$newpoc=$_POST['ays_answer'];
$newnotes=$_POST['ays_notes'];
$ays_currentnotes=$_POST['ays_currentnotes'];

//get the poc name
$GET_POC=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$poctable." WHERE id='".$newpoc."'");
if(mysql_num_rows($GET_POC)<1){
	/* SOMETHING WENT WRONG */	
} else {
	while($FETCH_POC=mysql_fetch_array($GET_POC)){
		$new_poc_name=$FETCH_POC['fname']." ".$FETCH_POC['lname'];		
		$poc_stafftype=$FETCH_POC['staff_type'];
		$poc_level=$FETCH_POC['level'];
	}
}

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
}
if($_POST['ays_answer']!="cancel"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET poc='".$newpoc."' WHERE ticket_id='".$queryid."'");
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET extra_notes='".$newnotes."' WHERE ticket_id='".$queryid."'");
?>
<form method="post">
<input type="hidden" name="undo_lastpoc" value="<?php echo $currentpoc;?>" />
<input type="hidden" name="undo_lastnotes" value="<?php echo $ays_currentnotes;?>" />
<br />Okay I have assigned the query titled: <b><?php echo $contact_message;?></b> to <b><?php echo $new_poc_name;?></b> (<input type="submit" name="undo_assignto" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=feedbacks&page=queries" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="cancel"){
echo "<br />Alright sounds fair to me, I will leave the query titled: <b>".$contact_message."</b> alone. <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$poctable=$_GET['poctable'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status != 'Closed'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
$extra_notes=$FETCH_POST['extra_notes'];
$atlevel=$FETCH_POST['atlevel'];
$thepoc=$FETCH_POST['poc'];
}
if($user_id == $thepoc && $level == $atlevel){
?>
<form method="post">
<br /><span style="font-size:18px;font-weight:bold;">Who do you want to assign  the query titled: <b><?php echo $contact_message;?></b> to?</span>
<br />
<br />
<input type="hidden" name="ays_currentnotes" value="<?php echo $extra_notes;?>" />
<select name="ays_answer" onchange="if(this.value==''){}else{this.form.submit();}">
	<option value="">--- select someone ---</option>
    <?php
	$GET_LIST_OF_POCS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$poctable." WHERE type='admin' AND status='active' ORDER BY fname");
	if(mysql_num_rows($GET_LIST_OF_POCS)<1){
		?>
        <option value="">--- no people to assign ---</option>
        <?php
	} else {
		while($FETCH_LIST_OF_POCS=mysql_fetch_array($GET_LIST_OF_POCS)){
			//get the staff type name
			$GET_STN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='".$FETCH_LIST_OF_POCS['staff_type']."'");
			if(mysql_num_rows($GET_STN)<1){
				/* SOMETHING WENT WRONG */	
			} else {
				while($FETCH_STN=mysql_fetch_array($GET_STN)){
					$poc_stafftype_name=$FETCH_STN['name'];
				}
			}			
			
			if($FETCH_LIST_OF_POCS['id'] == $currentpoc){
				/* CURRENTLY ASSIGNED TO POC */
				?>
				<option value="<?php echo $FETCH_LIST_OF_POCS['id'];?>" disabled="disabled"><?php echo $FETCH_LIST_OF_POCS['fname']." ".$FETCH_LIST_OF_POCS['lname'];?> [currently assigned]</option>
				<?php	
			} else {
				if($FETCH_LIST_OF_POCS['level']<1){
					/* NOT QUALIFIED */
				} else {
					?>
					<option value="<?php echo $FETCH_LIST_OF_POCS['id'];?>"><?php echo $FETCH_LIST_OF_POCS['fname']." ".$FETCH_LIST_OF_POCS['lname'];?> [<?php echo $poc_stafftype_name;?>] [Level: <?php echo $FETCH_LIST_OF_POCS['level'];?>]</option>
					<?php		
				}
			}
		}
	}	
	?>
    <option value="">----------------------</option>
    <option value="cancel">I changed my mind...</option>
</select>
<br />
<br />
<span style="font-size:22px;font-weight:bold;">Anything you would like to add?</span>
<br />
<br />
<textarea name="ays_notes" style="resize:none;" cols="78" rows="7"><?php echo $extra_notes;?></textarea>
</form>
<?php
} else {
	echo "<br />You cannot do anything to this query since it does not belong to you. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";	
}
}	
}	
}
break;

case 'deleteperm':
if(isset($_POST['forsure_ays_answer'])){
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: DELETE THE ENTRY */
mysql_query("DELETE FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."'");
?>
<br />Okay I have permanently deleted the query titled: <b><?php echo $contact_message;?></b> from the Trash (cannot undo) <a href="<?php echo $WEBSITE_URL;?>?menu=feedbacks&page=queries" style="cursor:pointer;">Refresh</a>
<?php
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status != 'Closed'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
	while($FETCH_POST=mysql_fetch_array($GET_POST)){
		$contact_message=$FETCH_POST['contact_message'];
	}
if($_POST['ays_answer']=="no"){
?>
"<br />Okay I have left the query titled: <b><?php echo $contact_message;?></b> in the Trash. <a href="<?php echo $WEBSITE_URL;?>?menu=feedbacks&page=queries" style="cursor:pointer;">Refresh</a>
<?php
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
}									
?>
<form method="post">
<br />Are you really sure you want to permanently delete the query titled: <b><?php echo $contact_message;?></b> which is currently in the trash? (you will lose all data on this post; just making sure you understand).
<input type="radio" name="forsure_ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="forsure_ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php	
}
}										
}
} else {
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status != 'Closed'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
$atlevel=$FETCH_POST['atlevel'];
}				
if($user_id == $currentpoc && $level == $atlevel){
?>
<form method="post">
<br />Are you sure you want to permanently delete the query titled: <b><?php echo $contact_message;?></b> which is currently in the trash</b>? (this action cannot be undone)
<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php
} else {
	echo "<br />You cannot do anything to this query since it does not belong to you. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";	
}
}	
}	
}
break;
case 'recover':
if(isset($_POST['undo_recover'])){
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE ticket_id='".$queryid."'") or die(mysql_error());
echo "<br />I just deleted it again, you sure are having a hard time making up your mind. :) <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE  ticket_id='".$queryid."'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
}
if($_POST['ays_answer']=="yes"){
/* STEP 4: "DELETE" (really set the status to Deleted) */
mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Open' WHERE ticket_id='".$queryid."'");
?>
<form method="post">
<br />Okay I have recovered the query titled: <b><?php echo $contact_message;?></b> from the Trash (<input type="submit" name="undo_recover" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=feedbacks&page=queries" style="cursor:pointer;">Refresh</a>
</form>
<?php
} else if($_POST['ays_answer']=="no"){
echo "<br />Alright sounds fair to me, I will leave the query titled: <b>".$contact_message."</b> in the Trash. <a href=\"".$WEBSITE_URL."?menu=posts\" style=\"cursor:pointer;\">Refresh</a>";
}
}										
}
} else {
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
$atlevel=$FETCH_POST['atlevel'];
}				
if($user_id == $currentpoc && $level == $atlevel){
?>
<form method="post">
<br />Are you sure you want to recover the query titled: <b><?php echo $contact_message;?></b> from the Trash? <input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
</form>
<?php
} else {
	echo "<br />You cannot do anything to this query since it does not belong to you. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";	
}
}	
}	
}
break;	
case 'answer':

if(isset($_POST['undo_answer'])){
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Open' WHERE ticket_id='".$queryid."'");
echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
} else {
if(isset($_POST['ays_answer'])){	
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$currentpoc=$_GET['currentpoc'];

$ays_yourresponse=$_POST['ays_yourresponse'];
/* STEP 2: CHECK FOR ANSWER (blank) */
if($_POST['ays_answer']==""){
echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status != 'Closed'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
$to=$FETCH_POST['yemail'];
$yname=$FETCH_POST['yname'];
$query_id=$FETCH_POST['id'];
}

if($_POST['ays_answer']=="yes"){
	/* STEP 4: "ANSWER OR ESCALATE" */
	/* UPDATE DATABASE */
	//determine if closing or escalating
	if($ays_yourresponse=="" && $_POST['ays_answer'] != "escalate"){
		echo "<br />You must provide a response to this ticket. <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go back</a>";
	} else {
		/* SEND EMAIL */
		/*$b_year=$date_year;
		$b_month=$date_month;
		$b_day=$date_day;
		$pname_contact_message=$entry_contact_message;	
		*/
		//CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,"contact_response",$to,$properties->PADMAIN,$pop);
		mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET extra_notes='".$ays_yourresponse."' WHERE ticket_id='".$queryid."'");
		if($_POST['ays_answer_status']=="yes"){mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Closed' WHERE ticket_id='".$queryid."'");}
		?>
		<form method="post">
		<br />Okay I have answered the query titled: <b><?php echo $contact_message;?></b> with your notes. (<input type="submit" name="undo_answer" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=feedbacks&page=queries" style="cursor:pointer;">Refresh</a>
		</form>
		<?php
	}
} else if($_POST['ays_answer']=="no"){	
	echo "<br />Alright sounds fair to me, I will leave the query title: <b>".$contact_message."</b> alone. <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";
} else if($_POST['ays_answer']=="escalate"){
	if($_POST['ays_answer_status'] == "yes"){
		echo "<br />You cannot close a ticket and escalate it. <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go back</a>";
	} else {
		/* SEND EMAIL */
		/*$b_year=$date_year;
		$b_month=$date_month;
		$b_day=$date_day;
		$pname_contact_message=$entry_contact_message;	
		*/
		//CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,"contact_escalation",$to,$properties->PADMAIN,$pop);
		
		mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET extra_notes='".$ays_yourresponse."' WHERE ticket_id='".$queryid."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Escalated' WHERE ticket_id='".$queryid."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET atlevel=atlevel+1 WHERE ticket_id='".$queryid."'");
		echo "<br />Alright I have marked this for escalation. <a href=\"".$WEBSITE_URL."?menu=feedbacks&page=queries\" style=\"cursor:pointer;\">Refresh</a>";	
	}
}
}										
}
} else {
/* STEP 1: GET DATA */
$queryid=$_GET['queryid'];
$what=$_GET['what'];
$pad=$_GET['pad'];
$pop=$_GET['pop'];
$base=$_GET['base'];
$subbase=$_GET['subbase'];
$postid=$_GET['postid'];
$currentpoc=$_GET['currentpoc'];

/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE ticket_id='".$queryid."' AND status != 'Closed'");
if(mysql_num_rows($GET_POST)<1){
echo "<br />No Queries, with the ID: <b>".$queryid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
} else {
/* STEP 3: CONFIRM DELETE */
while($FETCH_POST=mysql_fetch_array($GET_POST)){
$contact_message=$FETCH_POST['contact_message'];
$extra_notes=$FETCH_POST['extra_notes'];
$atlevel=$FETCH_POST['atlevel'];
$poc=$FETCH_POST['poc'];
}				
if($user_id == $currentpoc && $level == $atlevel){
?>
<form method="post">
<label style="font-size:22px;font-weight:bold;line-height:1.5em;">What do you want to say?</label>
<br />
<textarea rows="5" cols="75" style="resize:none;" name="ays_yourresponse"><?php echo $extra_notes;?></textarea>
<br />Do you want to answer this or escalate it? 
<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No <input type="radio" name="ays_answer" value="escalate" onclick="this.form.submit();" /> Escalate it! 
<br />
Close it? <input type="radio" name="ays_answer_status" value="yes" onclick="" /> Yes <input type="radio" name="ays_answer_status" value="no" onclick="" /> No
</form>
<?php
} else {
	echo "<br />You cannot do anything to this query since it does not belong to you. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
}
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
$ITEMS_POCTABLE_LIST=explode(",",$ITEMS_POCTABLE);
$ITEMS_REASONTABLE_LIST=explode(",",$ITEMS_REASONTABLE);

/* BEGIN GETTING THE ITEMS OR WHAT EVER YOU GUYS DO :P */
for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
$item=$ITEMS_LIST_LIST[$i];			
$sub_item=$SUBITEMS_LIST_LIST[$i];
$pad=$ITEMS_PAD_LIST[$i];
$page=$ITEMS_PAGE_LIST[$i];			
$poctable=$ITEMS_POCTABLE_LIST[$i];
$reasontable=$ITEMS_REASONTABLE_LIST[$i];

?>
<a name="<?php echo $item."-".$sub_item?>"></a>
<div id="<?php echo $item."_".$sub_item;?>_container" style="display:inline;">
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
<div class="formLayoutFullCol InBetween valignMiddle"> No Queries were found...it means no one loves you. Ha ha jk :(</div>
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

<div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=feedbacks&page=queries&order=contact_message#<?php echo $item."-".$sub_item;?>">Title</a>
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $item."-".$sub_item;?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=feedbacks&page=queries&order=contact_name">Inquirer</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $item."-".$sub_item;?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=feedbacks&page=queries&order=poc#<?php echo $item."-".$sub_item;?>">To Whom?</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $item."-".$sub_item;?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=feedbacks&page=queries&order=reason#<?php echo $item."-".$sub_item;?>">Reason</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $item."-".$sub_item;?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }?>
</div>

<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> Inquiry </div>

<div class="formLayoutFullCol alignCenter width-medium valignMiddle fontBig BorderTop BorderBottom"> Extra Notes </div>

<div class="formLayoutFullCol alignLeft width-xsmall valignMiddle fontBig BorderTop BorderBottom BorderRight"> <a href="?menu=feedbacks&page=queries&order=dateandtime">Date</a> 
<?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $item."-".$sub_item;?>">ASC</a>]
<?php }else if($_GET['direction']=="DESC"){?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }}else{?>
[<a href="?menu=feedbacks&page=queries&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "dateandtime";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $item."-".$sub_item;?>">DESC</a>]
<?php }?>
</div> <!-- end of column -->

</div> <!-- end of row -->

<?php
while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
@$ticket_id=$FETCH_ITEMS['ticket_id'];
@$contact_name=$FETCH_ITEMS['contact_name'];
@$contact_email=$FETCH_ITEMS['contact_email'];
@$poc=$FETCH_ITEMS['poc'];
@$reason=$FETCH_ITEMS['reason'];
@$contact_message=$FETCH_ITEMS['contact_message'];
@$dateandtime=$FETCH_ITEMS['dateandtime'];
@$status=$FETCH_ITEMS['status'];
@$extra_notes=$FETCH_ITEMS['extra_notes'];
@$is_searchable=$FETCH_ITEMS['is_searchable'];
@$atlevel=$FETCH_ITEMS['atlevel'];


//get the poc name
$GET_POC=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$poctable." WHERE id='".$poc."'");
if(mysql_num_rows($GET_POC)<1){
	/* SOMETHING WENT WRONG */	
} else {
	while($FETCH_POC=mysql_fetch_array($GET_POC)){
		$poc_name=$FETCH_POC['fname']." ".$FETCH_POC['lname'];		
		$poc_stafftype=$FETCH_POC['staff_type'];		
	}
}

//get the poc staff type name
$GET_POCSTN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='".$poc_stafftype."'");
if(mysql_num_rows($GET_POCSTN)<1){
	/* SOMETHING WENT WRONG */	
} else {
	while($FETCH_POCSTN=mysql_fetch_array($GET_POCSTN)){
		$poc_stafftypename=$FETCH_POCSTN['name'];
	}
}

//get the reason name
$GET_REASON=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries_".$reasontable."_reasons WHERE rcode='".$reason."'");
if(mysql_num_rows($GET_REASON)<1){
	/* SOMETHING WENT WRONG */	
} else {
	while($FETCH_REASON=mysql_fetch_array($GET_REASON)){
		$reason_name=$FETCH_REASON['reason'];
	}
}
?>
<div class="formLayoutFullRow">
<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom BorderTop">
<input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $id;?>" />
</div>
<div class="formLayoutFullCol contact_message alignLeft width-large valignTop BorderBottom BorderTop">
<?php if(strlen($contact_message)>30){$MESSAGE=substr($contact_message,0,30)."...";}else{$MESSAGE=$contact_message;}?>
<?php echo "<span style=\"font-size:22px;font-weight:bold;\">".$MESSAGE."</span>";?>
<br />
<em style="font-style:normal; color:gray;"><?php echo $status;?></em>
<br />
<em style="font-style:normal; color:gray;">Tick #: <?php echo $ticket_id;?></em>
<br />
<?php 
if($status=="Deleted"){
	/* CHECK TO SEE IF IT IS FOR THEM */
	if($user_id==$poc && $level==$atlevel){
		?>
        <a href="?menu=feedbacks&page=queries&action=recover&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&queryid=<?php echo $ticket_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>&currentpoc=<?php echo $poc;?>">Recover</a>
         | 
        <a href="?menu=feedbacks&page=queries&action=deleteperm&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&queryid=<?php echo $ticket_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>&currentpoc=<?php echo $poc;?>">Delete Permanently</a>
        <?php
	} else {
		?>
        <del>Recover</del>
         | 
        <del>Delete Permanently</del>
        <?php
	}
} else {
	/* CHECK TO SEE IF IT IS FOR THEM */
	if($user_id==$poc && $level==$atlevel){
		/* IT'S FOR THE PERSON WHO IS LOGGED IN */
		?>
        <a href="?menu=feedbacks&page=queries&action=delete&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&queryid=<?php echo $ticket_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>&currentpoc=<?php echo $poc;?>">Delete</a>
        | 
        <?php
		if($status == "Closed"){
			?>
            <del>Answer</del>
            | 
            <a href="?menu=feedbacks&page=queries&action=reopen&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&queryid=<?php echo $ticket_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>&currentpoc=<?php echo $poc;?>">Re-open</a>
            |
            Assign-To
            <?php
		} else {
			?>
            <a href="?menu=feedbacks&page=queries&action=answer&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&queryid=<?php echo $ticket_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>&currentpoc=<?php echo $poc;?>">Answer</a>
            |
        <a href="?menu=feedbacks&page=queries&action=assignto&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&queryid=<?php echo $ticket_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>&poctable=<?php echo $poctable;?>&currentpoc=<?php echo $poc;?>">Assign To</a>
            <?php
		}
    } else {
		/* NOT FOR THEM */	
		?>
        <del>Delete</del>
        | 
        <del>Answer</del>
        |
        <del>Assign To</del>
        <?php
	}
}
?>    
</div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $contact_name;?> </div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $poc_name;?> </div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $reason_name;?> </div>
<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $contact_message;?> </div>
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
