<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
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
<h1>Posts <a href="?menu=posts&page=add-new" class="small">Add New</a></h1>
Filter by
<select id="_chooser" onchange="_chooser();">
  <option value="all">All Posts</option>
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
			if(isset($_POST['editpost_publish'])){
				/* STEP 1: GET DATA */
				$postid=$_GET['postid'];
				$what=$_GET['what'];
				$pad=$_GET['pad'];
				$pop=$_GET['pop'];
				$base=$_GET['base'];
				$subbase=$_GET['subbase'];
				
				$editpost_title=mysql_real_escape_string($_POST['editpost_title']);
				$editpost_content=mysql_real_escape_string($_POST['editpost_content']);
				$editpost_status=mysql_real_escape_string($_POST['editpost_status']);
				$editpost_publish=mysql_real_escape_string($_POST['editpost_publish']);
				$editpost_publicize=mysql_real_escape_string($_POST['editpost_publicize']);
				$editpost_date=mysql_real_escape_string($_POST['editpost_date']);
				$editpost_time=mysql_real_escape_string($_POST['editpost_time']);
				$editpost_dategts=mysql_real_escape_string($_POST['editpost_dategts']);
				$editpost_timegts=mysql_real_escape_string($_POST['editpost_timegts']);
				$editpost_startedit=mysql_real_escape_string($_POST['editpost_started']);
				$editpost_isfeatured=mysql_real_escape_string($_POST['editpost_isfeatured']);
				$editpost_featuredimage=mysql_real_escape_string($_POST['editpost_featuredimage']);
				$editpost_category=mysql_real_escape_string($_POST['editpost_category']);
				$editpost_customcategory=mysql_real_escape_string($_POST['editpost_customcategory']);
				$editpost_tags=mysql_real_escape_string($_POST['editpost_tags']);
				
				/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
				/* ADDON: AF : A-Z LIST */
				if($pop=="a-z-list"){
					$editpost_director=mysql_real_escape_string($_POST['editpost_director']);
					$editpost_director_new=mysql_real_escape_string($_POST['editpost_director_new']);
										
					$editpost_studio=mysql_real_escape_string($_POST['editpost_studio']);
					$editpost_studio_new=mysql_real_escape_string($_POST['editpost_studio_new']);

					$editpost_network=mysql_real_escape_string($_POST['editpost_network']);
					$editpost_network_new=mysql_real_escape_string($_POST['editpost_network_new']);
					
					$editpost_original_run_start=mysql_real_escape_string($_POST['editpost_original_run_start']);
					$editpost_original_run_end=mysql_real_escape_string($_POST['editpost_original_run_end']);
					$editpost_episodes=mysql_real_escape_string($_POST['editpost_episodes']);
					$editpost_watch_type=mysql_real_escape_string($_POST['editpost_watch_type']);
					$editpost_plot=mysql_real_escape_string($_POST['editpost_plot']);
					$editpost_screenshots=mysql_real_escape_string($_POST['editpost_screenshots']);	
					$editpost_eyecandy=mysql_real_escape_string($_POST['editpost_eyecandy']);
				}
				/* END ADDON: OTHER WORK */
				
				/* ADDON: OTHER WORK */
				if($base=="otherwork"){
					$editpost_link=mysql_real_escape_string($_POST['editpost_link']);
				}
				/* END ADDON: OTHER WORK */
				
				/* ADDON: WORK */
				if($base=="work"){
					$editpost_filename=mysql_real_escape_string($_POST['editpost_filename']);
					$editpost_portfolio=mysql_real_escape_string($_POST['editpost_portfolio']);
					$editpost_portfolio_new=mysql_real_escape_string($_POST['editpost_portfolio_new']);
					$editpost_imagename=mysql_real_escape_string($_POST['editpost_imagename']);
					$editpost_image_size_width=mysql_real_escape_string($_POST['editpost_image_size_width']);
					$editpost_image_size_full_width=mysql_real_escape_string($_POST['editpost_image_size_full_width']);
					$editpost_image_size_height=mysql_real_escape_string($_POST['editpost_image_size_height']);
					$editpost_image_size_full_height=mysql_real_escape_string($_POST['editpost_image_size_full_height']);
					$editpost_type=mysql_real_escape_string($_POST['editpost_type']);
					$editpost_type_new=mysql_real_escape_string($_POST['editpost_type_new']);
					$editpost_is_installable=mysql_real_escape_string($_POST['editpost_is_installable']);
					$editpost_installation=mysql_real_escape_string($_POST['editpost_installation']);
					$editpost_progress=mysql_real_escape_string($_POST['editpost_progress']);
				}
				/* END ADDON: WORK */
				/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */
				
				/* STEP 2: CHECK DATA FOR ACCURACY */
				if($editpost_category=="custom" && $editpost_customcategory==""){/* DID NOT ENTER CUSTOM CATEGORY NAME */$error_console.="<br />Since you selected a custom category, you must name your new category. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";}
				
				if(($editpost_status=="Deleted") || ($editpost_status=="Recovered")){$error_console.="<br />Status cannot be set on Deleted or Recovered.";}				
				if($editpost_isfeatured=='yes'){if($editpost_featuredimage==""){$error_console.="<br />Since you chosen to feature this, it must have a featured image. Constrains: 912px x 200px";}}
				/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
				/* ADDON: AF : A-Z LIST */
				if($pop=="a-z-list"){
					if($editpost_director=="custom"){if($editpost_director_new==""){$error_console.="<br />Since you're adding a new Director you must tell me the Director's name.";}}
					if($editpost_studio=="custom"){if($editpost_studio_new==""){$error_console.="<br />Since you're adding a new Studio you must tell me the Director's name.";}}
					if($editpost_network=="custom"){if($editpost_network_new==""){$error_console.="<br />Since you're adding a new Network you must tell me the Network's name.";}}
					
					if($editpost_director=="custom"){
						/* CHECK TO SEE IF IT IS ALREAY IN DB */
						$CHECK_FOR_DIRECTOR=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_directors WHERE name='".$editpost_director_new."'");
						if(mysql_num_rows($CHECK_FOR_DIRECTOR)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$editpost_director_new."</b> is already in the database.";}
					}
					if($editpost_studio=="custom"){
						/* CHECK TO SEE IF IT IS ALREAY IN DB */
						$CHECK_FOR_STUDIO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_studios WHERE name='".$editpost_studio_new."'");
						if(mysql_num_rows($CHECK_FOR_STUDIO)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$editpost_studio_new."</b> is already in the database.";}
					}
					
					if($editpost_network=="custom"){
						/* CHECK TO SEE IF IT IS ALREAY IN DB */
						$CHECK_FOR_NETWORK=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_networks WHERE name='".$editpost_network_new."'");
						if(mysql_num_rows($CHECK_FOR_NETWORK)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$editpost_network_new."</b> is already in the database.";}
					}
					
					if($editpost_original_run_start==""){$error_console.="<br />You must select a date for original run.";}
					if($editpost_original_run_end==""){$error_console.="<br />You must select a date for original run.";}
					if($editpost_episodes=="" || $editpost_episodes==0){$error_console.="<br />Cannot be 0 or blank; Must have at least 1.";}
				}
				/* END ADDON: OTHER WORK */
				
				/* ADDON: OTHER WORK */
				if($base=="otherwork"){
					if($editpost_link==""){$error_console.="<br />You are missing the link for your other work post.";}
					
				}
				/* END ADDON: OTHER WORK */
				
				/* ADDON: WORK */
				if($base=="work"){
					if($editpost_portfolio=="custom"){
						/* CHECK TO SEE IF IT IS ALREAY IN DB */
						$CHECK_FOR_PORTFOLIO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_portfolios WHERE name='".$editpost_portfolio_new."'");
						if(mysql_num_rows($CHECK_FOR_PORTFOLIO)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$editpost_portfolio_new."</b> is already in the database.";}
					}
					
					if($editpost_type=="custom"){
						/* CHECK TO SEE IF IT IS ALREAY IN DB */
						$CHECK_FOR_PROJECTTYPE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects_types WHERE name='".$editpost_type_new."'");
						if(mysql_num_rows($CHECK_FOR_PROJECTTYPE)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$editpost_type_new."</b> is already in the database.";}
					}									
				}
				/* END ADDON: WORK */
				/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */								
				
				if($error_console!=""){
					echo $error_console." <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go Back</a>";
				} else {
					/* STEP 3: UPLOAD/SAVE */
					
					/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
					/* ADDON: AF : A-Z LIST */
					if($pop=="a-z-list"){						
						if($editpost_director=="custom"){
							/* INSERT NEW */
							mysql_query("INSERT INTO {$properties->DB_PREFIX}pages_af_atoz_directors (name,shortname,website,gender,born,parentid,is_searchable) VALUES ('".$editpost_director_new."','".converter($properties,$editpost_director_new,"url","to")."','','other','0000-00-00','0','yes')");
							$editpost_director_new_id=mysql_insert_id();
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET director='".$editpost_director_new_id."' WHERE id='".$postid."'");
						} else {
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET director='".$editpost_director."' WHERE id='".$postid."'");	
						}
											
						if($editpost_studio=="custom"){
							/* INSERT NEW */
							mysql_query("INSERT INTO {$properties->DB_PREFIX}pages_af_atoz_studios (name,shortname,website,parentid,is_searchable) VALUES ('".$editpost_studio_new."','".converter($properties,$editpost_studio_new,"url","to")."','','0','yes')");
							$editpost_studio_new_id=mysql_insert_id();
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET studio='".$editpost_studio_new_id."' WHERE id='".$postid."'");
						} else {
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET director='".$editpost_studio."' WHERE id='".$postid."'");	
						}
												
						if($editpost_network=="custom"){
							/* INSERT NEW */
							mysql_query("INSERT INTO {$properties->DB_PREFIX}pages_af_atoz_networks (name,shortname,website,parentid,is_searchable) VALUES ('".$editpost_network_new."','".converter($properties,$editpost_network_new,"url","to")."','','0','yes')");
							$editpost_network_new_id=mysql_insert_id();
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET network='".$editpost_network_new_id."' WHERE id='".$postid."'");
						} else {
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET network='".$editpost_network."' WHERE id='".$postid."'");	
						}

						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET original_run_start='".$editpost_original_run_start."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET original_run_end='".$editpost_original_run_end."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET episodes='".$editpost_episodes."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET watch_type='".$editpost_watch_type."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET plot='".$editpost_plot."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET screenshots='".$editpost_screenshots."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET eyecandy='".$editpost_eyecandy."' WHERE id='".$postid."'");
					}
					/* END ADDON: OTHER WORK */
					
					/* ADDON: OTHER WORK */
					if($base=="otherwork"){
						$editpost_link=mysql_real_escape_string($_POST['link']);
					}
					/* END ADDON: OTHER WORK */
					
					/* ADDON: WORK */
					if($base=="work"){
						if($editpost_portfolio=="custom"){
							/* INSERT NEW */
							mysql_query("INSERT INTO {$properties->DB_PREFIX}work_portfolios (name,carousel_name,is_searchable) VALUES ('".$editpost_portfolio_new."','".converter($properties,$editpost_portfolio_new,"url","to")."','yes')");
							$editpost_portfolio_new_id=mysql_insert_id();
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET portfolio='".$editpost_portfolio_new_id."' WHERE id='".$postid."'");
						} else {
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET network='".$editpost_portfolio."' WHERE id='".$postid."'");	
						}
						
						if($editpost_type=="custom"){
							/* INSERT NEW */
							mysql_query("INSERT INTO {$properties->DB_PREFIX}work_projects_types (name,display_in_types_list,is_web_dir,is_searchable,shortname) VALUES ('".$editpost_type_new."','yes','no','yes','".converter($properties,$editpost_type_new,"url","to")."')");
							$editpost_type_new_id=mysql_insert_id();
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET type='".$editpost_type_new_id."' WHERE id='".$postid."'");
						} else {
							mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET network='".$editpost_type."' WHERE id='".$postid."'");	
						}

						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET filename='".$editpost_filename."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET image_name='".$editpost_imagename."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET image_size_width='".$editpost_image_size_width."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET image_size_full_width='".$editpost_image_size_full_width."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET image_size_height='".$editpost_image_size_height."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET image_size_full_height='".$editpost_image_size_full_height."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET is_installable='".$editpost_is_installable."' WHERE id='".$postid."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET installation='".$editpost_installation."' WHERE id='".$postid."'") or die(mysql_error());
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET progress='".$editpost_progress."' WHERE id='".$postid."'");
					}					
					/* END ADDON: WORK */
					/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */
					
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET title='".$editpost_title."' WHERE id='".$postid."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content='".$editpost_content."' WHERE id='".$postid."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='".$editpost_status."' WHERE id='".$postid."'") or die(mysql_error());
					if($editpost_startedit=="no"){
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime_goingtostart='".$editpost_date." ".$editpost_time."' WHERE id='".$postid."'");	
					} else if($editpost_startedit=="yes") {
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime='".$editpost_date." ".$editpost_time."' WHERE id='".$postid."'");
					}
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET featured='".$editpost_isfeatured."' WHERE id='".$postid."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET featured_image='".$editpost_featuredimage."' WHERE id='".$postid."'");
					if($editpost_customcategory != ""){
						/* NEW CATEGORY */
						/* INSERT THE NEW CAT */
						mysql_query("INSERT INTO {$properties->DB_PREFIX}".$base."_categories (name,shortname,parentid,is_searchable) VALUES ('$editpost_customcategory','".converter($properties,$editpost_customcategory,"url","to")."','0','yes')");
						/* GET INSERT ID */
						$new_category_id=mysql_insert_id();
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET category='".$new_category_id."' WHERE id='".$postid."'");
					} else {
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET category='".$editpost_category."' WHERE id='".$postid."'");
					}
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET tags='".$editpost_tags."' WHERE id='".$postid."'");
					
					/* STEP 4: POST RETURN OF RECEIPT */
					echo "<br /><b>".$editpost_title."</b> has been successfully updated! <a href=\"".$WEBSITE_URL."?menu=posts\">Refresh</a>";
				}
				
			} else {
				$postid=$_GET['postid'];
				$what=$_GET['what'];
				$pad=$_GET['pad'];
				$pop=$_GET['pop'];
				$base=$_GET['base'];
				$subbase=$_GET['subbase'];
				/* CREATE what starter */
				$what_starter=substr($what,0,strpos($what,"_entries"));
				
				$GET_ENTRY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."' AND status != 'Deleted'");
				if(mysql_num_rows($GET_ENTRY_INFO)<1){
					echo "<br />Cannot find an entry with the info you provided (truth is you probably changed the URL or the entry has been deleted, you can recover it by clicking the &quot;Recover&quot; next to the &quot;Edit&quot; button). <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";	
				} else {
					while($FETCH_ENTRY_INFO=mysql_fetch_array($GET_ENTRY_INFO)){
						$postid_name=$FETCH_ENTRY_INFO['title'];
						$postid_content=$FETCH_ENTRY_INFO['content'];																		
						$postid_dateyear=$FETCH_ENTRY_INFO['date_year'];
						$postid_datemonth=$FETCH_ENTRY_INFO['date_month'];
						$postid_dateday=$FETCH_ENTRY_INFO['date_day'];
						$postid_datehour=$FETCH_ENTRY_INFO['date_hour'];
						$postid_datemin=$FETCH_ENTRY_INFO['date_min'];
						$postid_datesec=$FETCH_ENTRY_INFO['date_sec'];
						$postid_tags=$FETCH_ENTRY_INFO['tags'];
						$postid_featured=$FETCH_ENTRY_INFO['featured'];
						$postid_featured_image=$FETCH_ENTRY_INFO['featured_image'];
						$postid_dateandtime=$FETCH_ENTRY_INFO['dateandtime'];
						$postid_dateandtime_goingtostart=$FETCH_ENTRY_INFO['dateandtime_goingtostart'];
						$postid_nameclean=converter($properties,$postid_name,"url","to");
						$postid_category=$FETCH_ENTRY_INFO['category'];
						$postid_status=$FETCH_ENTRY_INFO['status'];
						echo "<h3>Editing the post of &quot;".$postid_name."&quot; apart of the page: ".$pop."</h3>";
						//0000-00-00 00:00:00
						//0123456789012345678
						$postid_dateyeargts=substr($dateandtime_goingtostart,0,4);
						$postid_datemonthgts=substr($dateandtime_goingtostart,5,2);
						$postid_datedaygts=substr($dateandtime_goingtostart,8,2);
						$postid_datehourgts=substr($dateandtime_goingtostart,11,2);
						$postid_datemingts=substr($dateandtime_goingtostart,14,2);
						$postid_datesecgts=substr($dateandtime_goingtostart,17,2);
						
						/* --------------- CUSTOM ADDONS ----------------------------------------------------------------------------------------- */
						/* ADDON: AF : A-Z LIST */
						if($pop=="a-z-list"){
							$postid_addon_director=$FETCH_ENTRY_INFO['director'];
							$postid_addon_studio=$FETCH_ENTRY_INFO['studio'];
							$postid_addon_network=$FETCH_ENTRY_INFO['network'];
							$postid_addon_original_run_start=$FETCH_ENTRY_INFO['original_run_start'];
							$postid_addon_original_run_end=$FETCH_ENTRY_INFO['original_run_end'];
							$postid_addon_episodes=$FETCH_ENTRY_INFO['episodes'];
							$postid_addon_watch_type=$FETCH_ENTRY_INFO['watch_type'];
							$postid_addon_plot=$FETCH_ENTRY_INFO['plot'];
							$postid_addon_screenshots=$FETCH_ENTRY_INFO['screenshots'];	
							$postid_addon_eyecandy=$FETCH_ENTRY_INFO['eyecandy'];
						}
						/* END ADDON: OTHER WORK */
						
						/* ADDON: OTHER WORK */
						if($base=="otherwork"){
							$postid_content=$FETCH_ENTRY_INFO['description'];
							$postid_addon_link=$FETCH_ENTRY_INFO['link'];
						}
						/* END ADDON: OTHER WORK */
						
						/* ADDON: WORK */
						if($base=="work"){
							$postid_content=$FETCH_ENTRY_INFO['description'];
							$postid_addon_filename=$FETCH_ENTRY_INFO['filename'];
							$postid_addon_portfolio=$FETCH_ENTRY_INFO['portfolio_id'];
							$postid_addon_imagename=$FETCH_ENTRY_INFO['image_name'];
							$postid_addon_image_size_width=$FETCH_ENTRY_INFO['image_size_width'];
							$postid_addon_image_size_full_width=$FETCH_ENTRY_INFO['image_size_full_width'];
							$postid_addon_image_size_height=$FETCH_ENTRY_INFO['image_size_height'];
							$postid_addon_image_size_full_height=$FETCH_ENTRY_INFO['image_size_full_height'];
							$postid_addon_type=$FETCH_ENTRY_INFO['type'];
							$postid_addon_is_installable=$FETCH_ENTRY_INFO['is_installable'];
							$postid_installation=$FETCH_ENTRY_INFO['installation'];
							$postid_addon_progress=$FETCH_ENTRY_INFO['progress'];							
							
							//break apart date
							//0000-00-00 00:00:00
							//0123456789012345678
							if($postid_dateandtime_goingtostart!="0000-00-00 00:00:00"){
								$postid_dateyear	= substr($postid_dateandtime_goingtostart,0,4);
								$postid_datemonth	= substr($postid_dateandtime_goingtostart,5,2);
								$postid_dateday		= substr($postid_dateandtime_goingtostart,8,2);
								$postid_datehour	= substr($postid_dateandtime_goingtostart,11,2);
								$postid_datemin		= substr($postid_dateandtime_goingtostart,14,2);
								$postid_datesec		= substr($postid_dateandtime_goingtostart,17,2);
							} else {
								$postid_dateyear	= substr($postid_dateandtime,0,4);
								$postid_datemonth	= substr($postid_dateandtime,5,2);
								$postid_dateday		= substr($postid_dateandtime,8,2);
								$postid_datehour	= substr($postid_dateandtime,11,2);
								$postid_datemin		= substr($postid_dateandtime,14,2);
								$postid_datesec		= substr($postid_dateandtime,17,2);	
							}
						}
						/* END ADDON: WORK */
						/* --------------END CUSTOM ADDONS --------------------------------------------------------------------------------------- */
						?>
<form action="" method="post">
<div class="cp-table">
<div class="cp-row">
<div class="cp-lcol">
  <div class="formLayoutTable">
    <div class="formLayoutTableRow">
      <div class="formLayoutTableRowLeftCol">
        <input type="text" name="editpost_title" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $postid_name;?>" class="full-input" />
      </div>
      <div class="formLayoutTableRowRightCol"> </div>
    </div>
    <div class="formLayoutTableRow">
      <div class="formLayoutTableRowLeftCol">
        <?php
		$FORMULA_CONDENSED=substr($WEBSITE_URL_ROOT.$pad,0,20)."...";
		?>
        <?php echo $FORMULA_CONDENSED."/".$pop."/"."permalink/".$postid_dateyear."/".$postid_datemonth."/".$postid_dateday."/".$postid_nameclean;?> <a href="<?php echo $WEBSITE_URL_ROOT.$pad."/".$pop."/"."permalink/".$postid_dateyear."/".$postid_datemonth."/".$postid_dateday."/".$postid_nameclean;?>" target="_blank">Preview</a> </div>
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
        <textarea name="editpost_content" id="nEditor" rows="30" cols="80"><?php echo $postid_content;?></textarea>
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
      <input type="submit" name="editpost_publish" value="Publish" class="submit" />
      <input type="submit" name="editpost_savedraft" disabled="disabled" value="Save Draft" class="submit" />
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
        <?php if($postid_status=="Drafted"){?>
        <option value="Drafted" selected="selected">Draft</option>
        <?php } else {?>
        <option value="Drafted">Draft</option>
        <?php }?>
        
        <?php if($postid_status=="Published"){?>
        <option value="Published" selected="selected">Final</option>
        <?php } else {?>
        <option value="Published">Final</option>
        <?php }?>
        
        <?php if($postid_status=="On Hold"){?>
        <option value="On Hold" selected="selected">Hold</option>
        <?php } else {?>
        <option value="On Hold">Hold</option>
        <?php }?>
        
        <?php if($postid_status=="Deleted"){?>
        <option value="Deleted" selected="selected" disabled="disabled">Deleted</option>
        <?php } else {?>
        <option value="Deleted" disabled="disabled">Deleted</option>
        <?php }?>
        
        <?php if($postid_status=="Recovered"){?>
        <option value="Recovered" selected="selected" disabled="disabled">Recovered</option>
        <?php } else {?>
        <option value="Recovered" disabled="disabled">Recovered</option>
        <?php }?>
      </select>
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Publish: </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_publish">
        <option value="immediately">Immediately</option>
        <option value="in_24_hours">In 24 hours</option>
      </select>
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Publicize: </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_publicize">
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select>
      <a href="?menu=settings&page=sharing">Settings</a> </div>
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
      <input type="date" name="editpost_date" min="<?php echo $postid_dateyear."-".$postid_datemonth."-".$postid_dateday;?>" id="editpost_date" value="<?php echo $postid_dateyear."-".$postid_datemonth."-".$postid_dateday;?>" style="width:120px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Time: </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="time" name="editpost_time" step="1" value="<?php echo $postid_datehour.":".$postid_datemin.":".$postid_datesec;?>" style="width:120px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> 
      <script type="text/javascript">
														$(function() {
															$('#editpost_dategts').datepick({dateFormat: 'yyyy-mm-dd'});
															//$('#inlineDatepicker').datepick({onSelect: showDate});
														});
													</script> 
      GTS (<a title="I means Going to Start" style="cursor:pointer;">?</a>) Date: </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="date" name="editpost_dategts" min="<?php echo $postid_dateyeargts."-".$postid_datemonthgts."-".$postid_datedaygts;?>" id="editpost_dategts" value="<?php echo $postid_dateyeargts."-".$postid_datemonthgts."-".$postid_datedaygts;?>" style="width:120px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> GTS (<a title="It means Going to Start" style="cursor:pointer;">?</a>) Time: </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="time" name="editpost_timegts" step="1" value="<?php echo $postid_datehourgts.":".$postid_datemingts.":".$postid_datesecgts;?>" style="width:120px;" />
    </div>
  </div>
</div>
<div class="formLayoutTableMainAll">
<div class="formLayoutTableRowMainAll">
  <div class="formLayoutTableRowMainAllLeftCol"> Started it? (<a title="If checked no, then will place a &quot;going to start&quot; date in the database." style="cursor:pointer;">?</a>) </div>
  <div class="formLayoutTableRowMainAllRightCol">
    <?php if($postid_dateandtime_goingtostart == "0000-00-00 00:00:00"){?>
    <input type="radio" name="editpost_startedit" value="yes" class="radio" checked="checked" />
    Yes
    <input type="radio" name="editpost_startedit" value="no" class="radio" />
    No
    <?php } else {?>
    <input type="radio" name="editpost_startedit" value="yes" class="radio" />
    Yes
    <input type="radio" name="editpost_startedit" value="no" checked="checked" class="radio" />
    No
    <?php }?>
  </div>
</div>
<div class="formLayoutTableRowMainAll">
  <div class="formLayoutTableRowMainAllLeftCol"> Feature this? </div>
  <div class="formLayoutTableRowMainAllRightCol">
    <?php if($postid_featured == "yes"){?>
    <input type="radio" name="editpost_isfeatured" value="yes" class="radio" checked="checked" />
    Yes
    <input type="radio" name="editpost_isfeatured" value="no" class="radio" />
    No
    <?php } else {?>
    <input type="radio" name="editpost_isfeatured" value="yes" class="radio" />
    Yes
    <input type="radio" name="editpost_isfeatured" value="no" checked="checked" class="radio" />
    No
    <?php }?>
  </div>
</div>
<div class="formLayoutTableRowMainAll">
  <div class="formLayoutTableRowMainAllLeftCol">
    <?php
													if($postid_datemonth=="01"){$postid_datemonth_word="Jan";}
													if($postid_datemonth=="02"){$postid_datemonth_word="Feb";}
													if($postid_datemonth=="03"){$postid_datemonth_word="Mar";}
													if($postid_datemonth=="04"){$postid_datemonth_word="Apr";}
													if($postid_datemonth=="05"){$postid_datemonth_word="May";}
													if($postid_datemonth=="06"){$postid_datemonth_word="Jun";}
													if($postid_datemonth=="07"){$postid_datemonth_word="Jul";}
													if($postid_datemonth=="08"){$postid_datemonth_word="Aug";}
													if($postid_datemonth=="09"){$postid_datemonth_word="Sep";}
													if($postid_datemonth=="10"){$postid_datemonth_word="Oct";}
													if($postid_datemonth=="11"){$postid_datemonth_word="Nov";}
													if($postid_datemonth=="12"){$postid_datemonth_word="Dec";}
													?>
    FImage (<a title="This is the featured image file name. This file is relative to <?php echo ucfirst($pop)."/".$postid_dateyear."/".$postid_datemonth_word."/".$postid_dateday."/".str_replace(":","",$postid_nameclean);?>/ but you only need to type the file name.extension." style="cursor:pointer;">?</a>): </div>
  <div class="formLayoutTableRowMainAllRightCol">
    <input type="text" name="editpost_featuredimage" id="editpost_featuredimage" value="<?php echo $postid_featured_image;?>" style="width:190px;" />
  </div>
</div>
<div class="formLayoutTableRowMainAll">
<div class="formLayoutTableRowMainAllLeftCol"> OR </div>
<div class="formLayoutTableRowMainAllRightCol">
<div id="upload_popup" style="display:none;" class="upload-popup">
<?php
														/* FILE UPLOADER DETERMINATION */
														/* ------------------------------------------------------------------------------------------- */
														/* Here is where we determine what file upload to use based on the globalvars provided         */
														/* ------------------------------------------------------------------------------------------- */
														/* FLASHY WITH FILE WITH FILE SCANNING */
														if(getGlobalVars($properties,"uploader_type")=="flashy-enhanced"){
														?>
<center>
  <iframe src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/uploader-flashy-enhanced/index.php?id=<?php echo $postid;?>&pop=<?php echo ucfirst($pop);?>&year=<?php echo $postid_dateyear;?>&month=<?php echo $postid_datemonth_word;?>&day=<?php echo $postid_dateday;?>&title=<?php echo $postid_nameclean;?>" style="position:relative; top: 5px;" width="880" height="584"></iframe>
</center>
<?php
														/* FLASHY WITHOUT FILE WITH FILE SCANNING */
														} else if(getGlobalVars($properties,"uploader_type")=="flashy"){
														?>
<script type="text/javascript">
														$('#upload').ajaxupload({
															url: '<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/uploader-flashy/upload.php',
															remotePath: '../../../public/uploads/<?php echo ucfirst($pop)."/".$postid_dateyear."/".$postid_datemonth_word."/".$postid_dateday."/".$postid_nameclean."/";?>',
															finish:function(files){
																document.getElementById("post_featuredimage").value = files;
															},
															 success:function(file){
																console.log('File ' + file + ' uploaded correctly');
															},
															beforeUpload: function(filename, fileobj){
																if(filename.length>20){
																	return false; //file will not be uploaded
																}
																else
																{
																	return true; //file will be uploaded
																}
															},
															error:function(txt, obj){
																alert('An error occour '+ txt);
															},
															dropArea: '#drop_here'														
														});
														</script>
<div id="upload"></div>
<center>
  <div id="drop_here" style="width:50%;height:200px;border:1px dashed black; border-radius: 5px;">or drop files here</div>
</center>
<?php
														/* SIMPLE */
														} else if(getGlobalVars($properties,"uploader_type")=="simple"){
														?>
<form id="upload" action="upload.php" method="post">
  <input type="file" name="uploading" />
  <input type="submit" name="upload_btn" value="Upload" />
</form>
<?php	
														}
														?>
</div>
<script type="text/javascript">
													function upload(){
														$('#upload_popup').bPopup({
															appendTo: 'body',
															modalClose: true,
															modalColor: 'gray'																									
														});
													}
													</script>
<input type="button" name="editpost_upload_fimage" onclick="editpost_featuredimage.value='';upload()" value="Browse" class="button" />
<input type="button" name="editpost_clear_fimage" onclick="editpost_featuredimage.value=''" value="Clear" class="button" />
</div>
</div>
</div>
<div class="formLayoutTable">
  <div class="formLayoutTableRow">
    <div class="formLayoutTableRowLeftCol">
      <h2>Category</h2>
      <select name="editpost_category" size="10" style="width:280px;">
        <?php
													$GET_ALL_CATEGORIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what_starter."_categories ORDER BY name");
													if(mysql_num_rows($GET_ALL_CATEGORIES)<1){
														/* NO CATEGORIES */	
														if($base=="work"){?>
        <option value="">See Portfolio field below</option>
        <?php }else{?>
        <option value="">No Categories</option>
        <?php }
													} else {
														while($FETCH_ALL_CATEGORIES=mysql_fetch_array($GET_ALL_CATEGORIES)){
															if($FETCH_ALL_CATEGORIES['id'] == $postid_category){
																?>
        <option selected="selected" value="<?php echo $FETCH_ALL_CATEGORIES['id'];?>"><?php echo $FETCH_ALL_CATEGORIES['name'];?> [current]</option>
        <?php
															} else {
																?>
        <option value="<?php echo $FETCH_ALL_CATEGORIES['id'];?>"><?php echo $FETCH_ALL_CATEGORIES['name'];?></option>
        <?php	
															}
														}
														?>
        <option value="" disabled="disabled">----------------------------------------------------------------</option>
        <option value="custom">Custom</option>
        <?php
													}
													?>
      </select>
      <br />
      <br />
      Custom (new) Category Name
      <input type="text" name="editpost_customcategory" style="width:280px;" />
    </div>
    <div class="formLayoutTableRowRightCol"> </div>
  </div>
</div>
<div class="formLayoutTable">
  <div class="formLayoutTableRow">
    <div class="formLayoutTableRowLeftCol">
      <h2>Tags</h2>
      <input type="text" name="editpost_tags" value="<?php echo $postid_tags;?>" onfocus="if(this.value=='comma separated tags here'){this.value='';}" onblur="if(this.value==''){this.value='comma separated tags here';}" style="width:280px;" />
    </div>
    <div class="formLayoutTableRowRightCol"> </div>
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
										
                                        /* ADDON NAME: AF : A-Z LIST CUSTOMS */
										if($pop=="a-z-list"){
										?>
<h2>Custom Fields</h2>
<div class="formLayoutTableMainAll">
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Director </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_director">
        <?php
														$GET_DIRECTORS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_directors ORDER BY name");
														if(mysql_num_rows($GET_DIRECTORS)<1){
															?>
        <option value="none">No Directors</option>
        <?php	
														} else {
															while($FETCH_DIRECTORS=mysql_fetch_array($GET_DIRECTORS)){
																if($postid_addon_director==$FETCH_DIRECTORS['id']){?>
        <option value="<?php echo $FETCH_DIRECTORS['id'];?>" selected="selected"><?php echo $FETCH_DIRECTORS['name'];?> [current]</option>
        <?php }else{?>
        <option value="<?php echo $FETCH_DIRECTORS['id'];?>"><?php echo $FETCH_DIRECTORS['name'];?></option>
        <?php }
															}
														}
														?>
        <option value="" disabled="disabled">---------------------------------------------</option>
        <option value="custom">Add New (add below)</option>
      </select>
      <input type="text" name="editpost_director_new" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Studio </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_studio">
        <?php
														$GET_STUDIOS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_studios ORDER BY name");
														if(mysql_num_rows($GET_STUDIOS)<1){
															?>
        <option value="none">No Studios</option>
        <?php	
														} else {
															while($FETCH_STUDIOS=mysql_fetch_array($GET_STUDIOS)){
																if($postid_addon_studio==$FETCH_STUDIOS['id']){?>
        <option value="<?php echo $FETCH_STUDIOS['id'];?>" selected="selected"><?php echo $FETCH_STUDIOS['name'];?> [current]</option>
        <?php }else{?>
        <option value="<?php echo $FETCH_STUDIOS['id'];?>"><?php echo $FETCH_STUDIOS['name'];?></option>
        <?php }
															}
														}
														?>
        <option value="" disabled="disabled">---------------------------------------------</option>
        <option value="custom">Add New (add below)</option>
      </select>
      <input type="text" name="editpost_studio_new" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Network </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_network">
        <?php
														$GET_NETWORKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_networks ORDER BY name");
														if(mysql_num_rows($GET_NETWORKS)<1){
															?>
        <option value="none">No Directors</option>
        <?php	
														} else {
															while($FETCH_NETWORKS=mysql_fetch_array($GET_NETWORKS)){
																if($postid_addon_network==$FETCH_NETWORKS['id']){?>
        <option value="<?php echo $FETCH_NETWORKS['id'];?>" selected="selected"><?php echo $FETCH_NETWORKS['name'];?> [current]</option>
        <?php }else{?>
        <option value="<?php echo $FETCH_NETWORKS['id'];?>"><?php echo $FETCH_NETWORKS['name'];?></option>
        <?php }
															}
														}
														?>
        <option value="" disabled="disabled">---------------------------------------------</option>
        <option value="custom">Add New (add below)</option>
      </select>
      <input type="text" name="editpost_network_new" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Airdate Start </div>
    <div class="formLayoutTableRowMainAllRightCol"> 
      <script type="text/javascript">
														$(function() {
															$('#editpost_original_run_start').datepick({dateFormat: 'yyyy-mm-dd'});
															//$('#inlineDatepicker').datepick({onSelect: showDate});
														});
													</script>
      <input type="text" id="editpost_original_run_start" name="editpost_original_run_start" value="<?php echo $postid_addon_original_run_start;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Airdate End </div>
    <div class="formLayoutTableRowMainAllRightCol"> 
      <script type="text/javascript">
														$(function() {
															$('#editpost_original_run_end').datepick({dateFormat: 'yyyy-mm-dd'});
															//$('#inlineDatepicker').datepick({onSelect: showDate});
														});
													</script>
      <input type="text" id="editpost_original_run_end" name="editpost_original_run_end" value="<?php echo $postid_addon_original_run_end;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Episodes # </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="number" name="editpost_episodes" step="1" min="0" value="<?php echo $postid_addon_episodes;?>" onchange="if(this.value<0){this.value=0;}" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Activity </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_watch_type">
        <?php if($postid_addon_watch_type=="Watched"){?>
        <option value="Watched" selected="selected"></option>
        <?php } else {?>
        <option value="Watched">Watched</option>
        <?php }?>
        <?php if($postid_addon_watch_type=="Watching Now"){?>
        <option value="Watching Now" selected="selected">Watching Now</option>
        <?php } else {?>
        <option value="Watching Now">Watching Now</option>
        <?php }?>
        <?php if($postid_addon_watch_type=="Need to Watch"){?>
        <option value="Need to Watch" selected="selected">Need to Watch</option>
        <?php } else {?>
        <option value="Need to Watch">Need to Watch</option>
        <?php }?>
      </select>
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Plot </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <textarea name="editpost_plot" rows="5" cols="22"><?php echo $postid_addon_plot;?></textarea>
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> ScrShots </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="text" name="editpost_screenshots" value="<?php echo $postid_addon_screenshots;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
      <br />
      * separated by commas <br />
      ** only put filename.extension </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> EyeCandy </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="text" name="editpost_eyecandy" value="<?php echo $postid_addon_eyecandy;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
      <br />
      * separated by commas <br />
      ** only put filename.extension </div>
  </div>
</div>
<?php
										}										
										/* END ADDON NAME: AF : A-Z LIST CUSTOMS */
										
										/* ADDON NAME: OTHERWORK CUSTOMS */
										if($base=="otherwork"){
										?>
<h2>Custom Fields</h2>
<div class="formLayoutTableMainAll">
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Link </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="text" name="editpost_link" value="<?php echo $postid_addon_link;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
    </div>
  </div>
</div>
<?php
										}										
										/* END ADDON NAME: OTHERWORK CUSTOMS */
										
										/* ADDON NAME: MYWORK CUSTOMS */
										if($base=="work"){
										?>
<h2>Custom Fields</h2>
<div class="formLayoutTableMainAll">
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Filename </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="text" name="editpost_filename" value="<?php echo $postid_addon_filename;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Portfolio </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_portfolio">
        <option value="">---- select a portfolio ----</option>
        <?php
														$GET_PORTFOLIOS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_portfolios ORDER BY name");
														if(mysql_num_rows($GET_PORTFOLIOS)<1){
															?>
        <option value="none">No Portfolios :(</option>
        <?php
														} else {
															while($FETCH_PORTFOLIOS=mysql_fetch_array($GET_PORTFOLIOS)){
																if($postid_addon_portfolio==$FETCH_PORTFOLIOS['id']){?>
        <option value="<?php echo $FETCH_PORTFOLIOS['id'];?>" selected="selected"><?php echo $FETCH_PORTFOLIOS['name'];?></option>
        <?php } else {?>
        <option value="<?php echo $FETCH_PORTFOLIOS['id'];?>"><?php echo $FETCH_PORTFOLIOS['name'];?></option>
        <?php }
															}
														}
														?>
        <option value="" disabled="disabled">-------------------------------------------</option>
        <option value="custom">Add New (add below)</option>
      </select>
      <input type="text" name="editpost_portfolio_new" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Image </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="text" name="editpost_imagename" value="<?php echo $postid_addon_imagename;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> SizeW </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="number" step="1" min="0" max="660" onchange="if(this.value<0){this.value=0;}if(this.value>660){this.value=660;}if(this.value==''){this.value='660'}" name="editpost_image_size_width" value="<?php echo $postid_addon_image_size_width;?>" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> SizeFW </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="number" step="1" min="0" max="645" onchange="if(this.value<0){this.value=0;}if(this.value>645){this.value=645;}if(this.value==''){this.value='645'}" name="editpost_image_size_full_width" value="<?php echo $postid_addon_image_size_full_width;?>" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> SizeH </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="number" name="editpost_image_size_height" step="1" min="0" max="770" onchange="if(this.value<0){this.value=0;}if(this.value>330){this.value=330;}if(this.value==''){this.value='330'}" value="<?php echo $postid_addon_image_size_height;?>" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> SizeFH </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <input type="number" step="1" min="0" max="500" onchange="if(this.value<0){this.value=0;}if(this.value>500){this.value=500;}if(this.value==''){this.value='500'}" name="editpost_image_size_full_height" value="<?php echo $postid_addon_image_size_full_height;?>" style="width:200px;" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Type </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_type">
        <?php
														$GET_PROJECT_TYPES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects_types ORDER BY name");
														if(mysql_num_rows($GET_PROJECT_TYPES)<1){
															?>
        <option value="none">No Project Types :(</option>
        <?php
														} else {
															while($FETCH_PROJECT_TYPES=mysql_fetch_array($GET_PROJECT_TYPES)){
																if($postid_addon_type==$FETCH_PROJECT_TYPES['id']){?>
        <option value="<?php echo $FETCH_PROJECT_TYPES['id'];?>" selected="selected"><?php echo $FETCH_PROJECT_TYPES['name'];?></option>
        <?php }else{?>
        <option value="<?php echo $FETCH_PROJECT_TYPES['id'];?>"><?php echo $FETCH_PROJECT_TYPES['name'];?></option>
        <?php }
															}
														}
														?>
        <option value="" disabled="disabled">-------------------------------------------</option>
        <option value="custom">Add New (add below)</option>
      </select>
      <input type="text" name="editpost_type_new" />
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Installable? </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <?php if($postid_is_installable == "yes"){?>
      <input type="radio" name="editpost_is_installable" value="yes" class="radio" checked="checked" />
      Yes
      <input type="radio" name="editpost_is_installable" value="no" class="radio" />
      No
      <?php } else {?>
      <input type="radio" name="editpost_is_installable" value="yes" class="radio" />
      Yes
      <input type="radio" name="editpost_is_installable" value="no" checked="checked" class="radio" />
      No
      <?php }?>
    </div>
  </div>
  <div class="formLayoutTableRowMainAll">
    <div class="formLayoutTableRowMainAllLeftCol"> Progress </div>
    <div class="formLayoutTableRowMainAllRightCol">
      <select name="editpost_progress">
        <?php if($postid_addon_progress=="not started"){?>
        <option value="not started" selected="selected">Not Started</option>
        <?php } else {?>
        <option value="not started">Not Started</option>
        <?php }?>
        <?php if($postid_addon_progress=="in progress"){?>
        <option value="in progress" selected="selected">In Progress</option>
        <?php } else {?>
        <option value="in progress">In Progress</option>
        <?php }?>
        <?php if($postid_addon_progress=="completed"){?>
        <option value="completed" selected="selected">Completed</option>
        <?php } else {?>
        <option value="completed">Completed</option>
        <?php }?>
        <?php if($postid_addon_progress=="deprecated"){?>
        <option value="deprecated" selected="selected">Deprecated</option>
        <?php } else {?>
        <option value="deprecated">Deprecated</option>
        <?php }?>
      </select>
    </div>
  </div>
</div>
<?php
										}										
										/* END ADDON NAME: MYWORK CUSTOMS */
																				
										/* ------------ END CUSTOMIZED ADDONS ------------------------------------------------------------------------------ */
										?>
</div>
</div>
</div>
</form>
<?php
					}
				}	
			}
			
			
			
			
			
			
		break;
		case 'delete':
			if(isset($_POST['undo_delete'])){
				$postid=$_GET['postid'];
				$what=$_GET['what'];
				$pad=$_GET['pad'];
				$pop=$_GET['pop'];
				$base=$_GET['base'];
				$subbase=$_GET['subbase'];
				$postid=$_GET['postid'];
				mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$postid."'");
				echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=posts\" style=\"cursor:pointer;\">Refresh</a>";
			} else {
				if(isset($_POST['ays_answer'])){
					/* STEP 1: GET DATA */
					$postid=$_GET['postid'];
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
						$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."'");
						if(mysql_num_rows($GET_POST)<1){
							echo "No Entries, with the ID: <b>".$postid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
						} else {
							while($FETCH_POST=mysql_fetch_array($GET_POST)){
								$title=$FETCH_POST['title'];
							}
							if($_POST['ays_answer']=="yes"){
								/* STEP 4: "DELETE" (really set the status to Deleted) */
								mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$postid."'");
								?>
								<form method="post">
								<br />Okay I have deleted <b><?php echo $title;?></b> from <?php echo ucfirst($pop);?> (<input type="submit" name="undo_delete" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=posts" style="cursor:pointer;">Refresh</a>
								</form>
								<?php
							} else if($_POST['ays_answer']=="no"){
								echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> from <b>".ucfirst($pop)."</b> alone. <a href=\"".$WEBSITE_URL."?menu=posts\" style=\"cursor:pointer;\">Refresh</a>";
							}
						}										
					}
				} else {
					/* STEP 1: GET DATA */
					$postid=$_GET['postid'];
					$what=$_GET['what'];
					$pad=$_GET['pad'];
					$pop=$_GET['pop'];
					$base=$_GET['base'];
					$subbase=$_GET['subbase'];
					$postid=$_GET['postid'];
					
					/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
					$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."'");			
					if(mysql_num_rows($GET_POST)<1){
						echo "No Entries, with the ID: <b>".$postid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
					} else {
						/* STEP 3: CONFIRM DELETE */
						while($FETCH_POST=mysql_fetch_array($GET_POST)){
							$title=$FETCH_POST['title'];
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
		break;
		case 'deleteperm':
			if(isset($_POST['forsure_ays_answer'])){
				/* STEP 1: GET DATA */
				$postid=$_GET['postid'];
				$what=$_GET['what'];
				$pad=$_GET['pad'];
				$pop=$_GET['pop'];
				$base=$_GET['base'];
				$subbase=$_GET['subbase'];
				$postid=$_GET['postid'];
				
				/* STEP 2: DELETE THE ENTRY */
				mysql_query("DELETE FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."'");
				?>
				<br />Okay I have permanently deleted <b><?php echo $title;?></b> from the Trash which was apart of <b><?php echo ucfirst($pop);?></b> (cannot undo) <a href="<?php echo $WEBSITE_URL;?>?menu=posts" style="cursor:pointer;">Refresh</a>
                <?php
			} else {
				if(isset($_POST['ays_answer'])){
					/* STEP 1: GET DATA */
					$postid=$_GET['postid'];
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
						$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."'");
						if(mysql_num_rows($GET_POST)<1){
							echo "No Entries, with the ID: <b>".$postid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
						} else {
							if($_POST['ays_answer']=="no"){
								?>
								"<br />Okay I have left <b><?php echo $title;?></b> in the Trash which was apart of <b><?php echo ucfirst($pop);?></b>. <a href="<?php echo $WEBSITE_URL;?>?menu=posts" style="cursor:pointer;">Refresh</a>
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
					$postid=$_GET['postid'];
					$what=$_GET['what'];
					$pad=$_GET['pad'];
					$pop=$_GET['pop'];
					$base=$_GET['base'];
					$subbase=$_GET['subbase'];
					$postid=$_GET['postid'];
					
					/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
					$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."'");			
					if(mysql_num_rows($GET_POST)<1){
						echo "No Entries, with the ID: <b>".$postid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
					} else {
						/* STEP 3: CONFIRM DELETE */
						while($FETCH_POST=mysql_fetch_array($GET_POST)){
							$title=$FETCH_POST['title'];
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
		break;
		case 'recover':
			if(isset($_POST['undo_recover'])){
				$postid=$_GET['postid'];
				$what=$_GET['what'];
				$pad=$_GET['pad'];
				$pop=$_GET['pop'];
				$base=$_GET['base'];
				$subbase=$_GET['subbase'];
				$postid=$_GET['postid'];
				mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$postid."'") or die(mysql_error());
				echo "<br />I just deleted it again, you sure are having a hard time making up your mind. :) <a href=\"".$WEBSITE_URL."?menu=posts\" style=\"cursor:pointer;\">Refresh</a>";
			} else {
				if(isset($_POST['ays_answer'])){
					/* STEP 1: GET DATA */
					$postid=$_GET['postid'];
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
						$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."'");
						if(mysql_num_rows($GET_POST)<1){
							echo "No Entries, with the ID: <b>".$postid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
						} else {
							while($FETCH_POST=mysql_fetch_array($GET_POST)){
								$title=$FETCH_POST['title'];
							}
							if($_POST['ays_answer']=="yes"){
								/* STEP 4: "DELETE" (really set the status to Deleted) */
								mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$postid."'");
								?>
								<form method="post">
								<br />Okay I have recovered <b><?php echo $title;?></b> from the Trash and placed it in <?php echo ucfirst($pop);?> (<input type="submit" name="undo_recover" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=posts" style="cursor:pointer;">Refresh</a>
								</form>
								<?php
							} else if($_POST['ays_answer']=="no"){
								echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> in the Trash. <a href=\"".$WEBSITE_URL."?menu=posts\" style=\"cursor:pointer;\">Refresh</a>";
							}
						}										
					}
				} else {
					/* STEP 1: GET DATA */
					$postid=$_GET['postid'];
					$what=$_GET['what'];
					$pad=$_GET['pad'];
					$pop=$_GET['pop'];
					$base=$_GET['base'];
					$subbase=$_GET['subbase'];
					$postid=$_GET['postid'];
					
					/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
					$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$postid."'");			
					if(mysql_num_rows($GET_POST)<1){
						echo "No Entries, with the ID: <b>".$postid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
					} else {
						/* STEP 3: CONFIRM DELETE */
						while($FETCH_POST=mysql_fetch_array($GET_POST)){
							$title=$FETCH_POST['title'];
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
				?>
    <div class="formLayoutFull" class="InBetween alignCenter">
    <div class="formLayoutFullRow InBetween">
      <div class="formLayoutFullCol InBetween">
        <?php						
								echo "<h2>".$ITEMS_LIST_NAMES_LIST[$i]."</h2>";
							?>
      </div>
    </div>
  </div>
  <div class="formLayoutFull" class="InBetween alignCenter BorderLeftRight BorderTop BorderBottom">
  <div class="formLayoutFullRow InBetween">
    <div class="formLayoutFullCol InBetween valignMiddle"> No Entries were found or even exist in the database. :( <a href="?menu=posts&page=add-new">Start one right now!</a> </div>
  </div>
</div>
<?php
			} else {
				?>
<div class="formLayoutFull" class="InBetween alignCenter">
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
    <div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=posts&page=all-posts&order=title#<?php echo $ITEMS_LIST_LIST[$i];?>">Title</a>
      <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>
      [<a href="?menu=posts&page=all-posts&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC#<?php echo $ITEMS_LIST_LIST[$i];?>">ASC</a>]
      <?php }else if($_GET['direction']=="DESC"){?>
      [<a href="?menu=posts&page=all-posts&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
      <?php }}else{?>
      [<a href="?menu=posts&page=all-posts&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC#<?php echo $ITEMS_LIST_LIST[$i];?>">DESC</a>]
      <?php }?>
    </div>
    <div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=posts&page=all-posts&order=author">Author</a> </div>
    <div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> <a href="?menu=posts&page=all-posts&order=category">Categories</a> </div>
    <div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom"> Tags </div>
    <div class="formLayoutFullCol alignCenter width-small valignMiddle fontBig BorderTop BorderBottom"> Stats </div>
    <div class="formLayoutFullCol alignCenter width-small valignMiddle fontBig BorderTop BorderBottom"> C </div>
    <div class="formLayoutFullCol alignCenter width-small valignMiddle fontBig BorderTop BorderBottom"> L </div>
    <div class="formLayoutFullCol alignLeft width-xsmall valignMiddle fontBig BorderTop BorderBottom BorderRight"> <a href="?menu=posts&page=all-posts&order=date">Date</a> </div>
  </div>
  <?php
				while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
					@$entry_id=$FETCH_ITEMS['id'];
					@$title=$FETCH_ITEMS['title'];
					@$author=$FETCH_ITEMS['author'];
					@$reviewedby=$FETCH_ITEMS['reviewedby'];
					@$category=$FETCH_ITEMS['category'];
					@$category_id=$FETCH_ITEMS['category'];
					@$tags=$FETCH_ITEMS['tags'];
					@$dateandtime=$FETCH_ITEMS['dateandtime'];
					@$dateandtime_goingtostart=$FETCH_ITEMS['dateandtime_goingtostart'];
					@$status=$FETCH_ITEMS['status'];
					@$featured=$FETCH_ITEMS['featured'];
					@$link=$FETCH_ITEMS['link'];
					@$description=$FETCH_ITEMS['description'];
					@$name=$FETCH_ITEMS['name'];
					@$type=$FETCH_ITEMS['type'];
					
					//fetch the comments
					$GET_ITEMS_COMMENTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_comments");
					$COUNT_ITEMS_COMMENTS=mysql_num_rows($GET_ITEMS_COMMENTS);
					
					//get author name or reviewer name
					if($author!=""){
						/* AUTHOR IS NEEDED */
						$GET_ENTRY_AUTHOR=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$author'");
						$FETCH_ENTRY_AUTHOR=mysql_fetch_array($GET_ENTRY_AUTHOR);
						$author_name=$FETCH_ENTRY_AUTHOR['uname'];
					} else if($reviewedby!=""){
						/* A REVIEW TYPE */
						$GET_ENTRY_REVIEWER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$reviewedby'");
						$FETCH_ENTRY_REVIEWER=mysql_fetch_array($GET_ENTRY_REVIEWER);
						$author_name=$FETCH_ENTRY_REVIEWER['uname'];
					}
					
					//convert and get the category
					//#,#,
					if($type!=""){$category=$type;}
					if(strpos($category,",")!=""){
						/* MULTIPLE CATEGORIES */
						$category_list=explode(",",$category);
						$category="";
						for($icat=0; $icat<=count($category_list)-1; $icat++){
							if($type!=""){$GET_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item."_types WHERE id='{$category_list[$icat]}'") or die('uh oh! '.mysql_error());}else{$GET_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_categories WHERE id='{$category_list[$icat]}'") or die('uh oh! '.mysql_error());}
							while($FETCH_CATEGORY_INFO=mysql_fetch_array($GET_CATEGORY_INFO)){
								$category_id=$FETCH_CATEGORY_INFO['id'];
							 if($icat==count($category_list)-1){$category.="<a href=\"".$WEBSITE_URL."?menu=posts&page=categories&category=".$category_id."\">" . $FETCH_CATEGORY_INFO['name'] . "</a>";}else{$category.="<a href=\"".$WEBSITE_URL."?menu=posts&page=categories&category=".$category_id."\">" . $FETCH_CATEGORY_INFO['name'] . "</a>, ";}
							}
						}
					} else {
						if($type!=""){$GET_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item."_types WHERE id='{$category}'") or die('uh oh! '.mysql_error());}else{$GET_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_categories WHERE id='{$category}'") or die('uh oh! '.mysql_error());}
						while($FETCH_CATEGORY_INFO=mysql_fetch_array($GET_CATEGORY_INFO)){
							$category_shortname=$FETCH_CATEGORY_INFO['shortname'];
							$category="<a href=\"".$WEBSITE_URL."?menu=posts&page=categories&category=".$category_id."\">".$FETCH_CATEGORY_INFO['name']."</a>";
						}	
					}
					
					//put spaces in between tags
					$tags_list=$tags;
					$tags="";
					$tags_list_list=explode(",",$tags_list);
					
					for($itag=0; $itag<count($tags_list_list)-1; $itag++){
						if($itag==5){
							/* END OF DISPLAY TAGS */
						} else {
							if($itag==count($tags_list_list)-2){
								/* END OF FILE */
								$tags.="<a href=\"".$WEBSITE_URL."?menu=posts&page=tags&tag=".str_replace(" ","-",$tags_list_list[$itag])."\">".$tags_list_list[$itag]."</a>";
							} else {
								$tags.="<a href=\"".$WEBSITE_URL."?menu=posts&page=tags&tag=".str_replace(" ","-",$tags_list_list[$itag])."\">".$tags_list_list[$itag]."</a>, ";	
							}	
						}
					}
					
					?>
  <div class="formLayoutFullRow">
    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom BorderTop">
      <input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $id;?>" />
    </div>
    <div class="formLayoutFullCol title alignLeft width-medium valignTop BorderBottom BorderTop">
      <?php if($name!=""){echo "<a href=\"\">".$name."</a>";}else{echo "<a href=\"\">".$title."</a>";}?>
      <br />
      <em style="font-style:normal; color:gray;"><?php echo $status;?><?php if($featured=="yes"){echo " | Featured";}?></em> <br />
      <?php if($status=="Deleted"){?><a href="?menu=posts&page=all-posts&action=recover&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&postid=<?php echo $entry_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Recover</a> | <a href="?menu=posts&page=all-posts&action=deleteperm&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&postid=<?php echo $entry_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete Permanently</a><?php }else{?><a href="?menu=posts&page=all-posts&action=edit&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&postid=<?php echo $entry_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Edit</a> | <a href="?menu=posts&page=all-posts&action=delete&what=<?php echo $item."_".$sub_item;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&postid=<?php echo $entry_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete</a><?php }?></div>
    <div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo "<a href=\"\">".$author_name."</a>";?> </div>
    <div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $category;?> </div>
    <div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop"> <?php echo $tags;?> </div>
    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom BorderTop"> Stats </div>
    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom BorderTop"> <?php echo $COUNT_ITEMS_COMMENTS;?> </div>
    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom BorderTop"> 0 </div>
    <div class="formLayoutFullCol alignLeft width-xsmall valignMiddle BorderRight BorderBottom BorderTop">
      <?php if($dateandtime=="0000-00-00 00:00:00"){echo $dateandtime_goingtostart;}else{echo $dateandtime;}?>
      <?php echo $status;?> </div>
  </div>
  <br />
  <?php
				}
			}
			?>
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
