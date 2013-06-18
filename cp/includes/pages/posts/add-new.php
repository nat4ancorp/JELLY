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
	
/* -------------------------------------------------------- DO NOT EDIT BELOW THIS LINE -------------------------------------------------------------------- */
require("../includes/private/tools/converter.php");

/* EXPLODES */
$ITEMS_PAD_LIST=explode(",",$ITEMS_PAD);
$ITEMS_PAGE_LIST=explode(",",$ITEMS_PAGE);
$ITEMS_LIST_LIST=explode(",",$ITEMS_LIST);
$ITEMS_DEFAULT_LIST_LIST=explode(",",$ITEMS_DEFAULT_LIST);
$SUBITEMS_LIST_LIST=explode(",",$SUBITEMS_LIST);
$ITEMS_LIST_NAMES_LIST=explode(",",$ITEMS_LIST_NAMES);
$ITEMS_LIST_SPECIAL_LIST=explode(",",$ITEMS_LIST_SPECIAL);
$ITEMS_LIST_SPECIAL_ITEM_LIST=explode(",",$ITEMS_LIST_SPECIAL_ITEM);
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
</style>
<?php
if($type == "admin" || $type == "writer"){
	if((isset($_POST['_chooser'])) && ($_POST['_chooser']!="") || isset($_POST['post_publish'])){
		?>
		<h1><span style="">Add New Post for </span>
		<select id="_chooser" disabled="disabled" style="width:200px;height:35px;vertical-align:text-top;font-size:22px;border:thin solid gray;" onchange="_chooser();">
			<?php
			/* BEGIN GETTING THE ITEMS OR WHAT EVER YOU GUYS DO :P */
			for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
				$item=$ITEMS_LIST_LIST[$i];			
				$name=$ITEMS_LIST_NAMES_LIST[$i];
				$sub_item=$SUBITEMS_LIST_LIST[$i];
				$pad=$ITEMS_PAD_LIST[$i];
				$page=$ITEMS_PAGE_LIST[$i];
				if($item==$_POST['_chooser']){?><option value="<?php echo $item;?>" selected="selected"><?php echo $name;?></option><?php }else{?><option value="<?php echo $item;?>"><?php echo $name;?></option><?php }
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
		?><input type="hidden" id="element_count" value="<?php echo count($ITEMS_LIST_LIST)-1;?>" /></h1>
		<?php
		if(isset($_POST['post_publish'])){
			/* STEP 1: GET DATA */
			$post_pop=mysql_real_escape_string($_POST['post_pop']);
			$post_postedto=mysql_real_escape_string($_POST['post_postedto']);
			$post_title=mysql_real_escape_string($_POST['post_title']);
			$post_content=mysql_real_escape_string($_POST['post_content']);
			$post_author=mysql_real_escape_string($_POST['post_author']);
			$post_status=mysql_real_escape_string($_POST['post_status']);
			$post_publish=mysql_real_escape_string($_POST['post_publish']);
			$post_publicize=mysql_real_escape_string($_POST['post_publicize']);
			$post_date=mysql_real_escape_string($_POST['post_date']);
			$post_time=mysql_real_escape_string($_POST['post_time']);
			$post_dategts=mysql_real_escape_string($_POST['post_dategts']);
			$post_timegts=mysql_real_escape_string($_POST['post_timegts']);
			$post_startedit=mysql_real_escape_string($_POST['post_startedit']);
			$post_isfeatured=mysql_real_escape_string($_POST['post_isfeatured']);
			$post_featuredimage=mysql_real_escape_string($_POST['post_featuredimage']);
			$post_category=mysql_real_escape_string($_POST['post_category']);
			$post_customcategory=mysql_real_escape_string($_POST['post_customcategory']);
			$post_tags=mysql_real_escape_string($_POST['post_tags']);		
			
			/* STEP 2: CHECK DATA FOR ACCURACY */
			$error_console="";		
			if($post_title=="" || $post_title=="Give the post a clever title"){$error_console.="<br />You must provide a title.";}
			if($post_content==""){$error_console.="<br />Your post is missing content.";}
			if($post_startedit==""){$error_console.="<br />Did you start this post or not? (HINT: Means check the &quot;Started it?&quot; option on the right.)";}
			if($post_isfeatured==""){$error_console.="<br />Is this post featured or not? (HINT: Means check the &quot;Featured this?&quot; option on the right.)";}		
			if($post_isfeatured=="yes" && $post_featuredimage==""){$error_console.="<br />Since this post is featured please provide a name for the featured image or upload one. :)";}
			if($post_category==""){$error_console.="<br />You must choose a category for this post.";}
			if($post_category=="custom" && $post_customcategory==""){/* DID NOT ENTER CUSTOM CATEGORY NAME */$error_console.="<br />Since you selected a custom category, you must name your new category.";}
			if($post_tags==""){$error_console.="<br />This post seems to be missing its tags.";}		
			
			/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
			/* ADDON: AF : A-Z LIST */
			if($post_pop=="pages_af_atoz"){
				$post_director=mysql_real_escape_string($_POST['post_director']);
				$post_director_new=mysql_real_escape_string($_POST['post_director_new']);
									
				$post_studio=mysql_real_escape_string($_POST['post_studio']);
				$post_studio_new=mysql_real_escape_string($_POST['post_studio_new']);
	
				$post_network=mysql_real_escape_string($_POST['post_network']);
				$post_network_new=mysql_real_escape_string($_POST['post_network_new']);
				
				$post_original_run_start=mysql_real_escape_string($_POST['post_original_run_start']);
				$post_original_run_end=mysql_real_escape_string($_POST['post_original_run_end']);
				$post_episodes=mysql_real_escape_string($_POST['post_episodes']);
				$post_watch_type=mysql_real_escape_string($_POST['post_watch_type']);
				$post_plot=mysql_real_escape_string($_POST['post_plot']);
				$post_screenshots=mysql_real_escape_string($_POST['post_screenshots']);	
				$post_eyecandy=mysql_real_escape_string($_POST['post_eyecandy']);
				
				$post_reviewedby=mysql_real_escape_string($_POST['post_author']);
				
			}
			/* END ADDON: OTHER WORK */
			
			/* ADDON: OTHER WORK */
			if($base=="otherwork"){
				$post_link=mysql_real_escape_string($_POST['post_link']);
			}
			/* END ADDON: OTHER WORK */
			
			/* ADDON: WORK */
			if($base=="work"){
				$post_filename=mysql_real_escape_string($_POST['post_filename']);
				$post_portfolio=mysql_real_escape_string($_POST['post_portfolio']);
				$post_portfolio_new=mysql_real_escape_string($_POST['post_portfolio_new']);
				$post_imagename=mysql_real_escape_string($_POST['post_image_name']);
				$post_image_size_width=mysql_real_escape_string($_POST['post_image_size_width']);
				$post_image_size_full_width=mysql_real_escape_string($_POST['post_image_size_full_width']);
				$post_image_size_height=mysql_real_escape_string($_POST['post_image_size_height']);
				$post_image_size_full_height=mysql_real_escape_string($_POST['post_image_size_full_height']);
				$post_type=mysql_real_escape_string($_POST['post_type']);
				$post_type_new=mysql_real_escape_string($_POST['post_type_new']);
				$post_is_installable=mysql_real_escape_string($_POST['post_is_installable']);
				$post_progress=mysql_real_escape_string($_POST['post_progress']);
			}
			/* END ADDON: WORK */
			/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */
			
			/* STEP 2: CHECK DATA FOR ACCURACY */
			if($post_category=="custom" && $post_customcategory==""){/* DID NOT ENTER CUSTOM CATEGORY NAME */$error_console.="<br />Since you selected a custom category, you must name your new category.";}
			
			/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
			/* ADDON: AF : A-Z LIST */
			if($post_pop=="pages_af_atoz"){
				if($post_director=="custom"){if($post_director_new==""){$error_console.="<br />Since you're adding a new Director you must tell me the Director's name.";}}
				if($post_studio=="custom"){if($post_studio_new==""){$error_console.="<br />Since you're adding a new Studio you must tell me the Director's name.";}}
				if($post_network=="custom"){if($post_network_new==""){$error_console.="<br />Since you're adding a new Network you must tell me the Network's name.";}}
				
				if($post_director=="custom"){
					/* CHECK TO SEE IF IT IS ALREAY IN DB */
					$CHECK_FOR_DIRECTOR=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_directors WHERE name='".$post_director_new."'");
					if(mysql_num_rows($CHECK_FOR_DIRECTOR)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$post_director_new."</b> is already in the database.";}
				}
				if($post_studio=="custom"){
					/* CHECK TO SEE IF IT IS ALREAY IN DB */
					$CHECK_FOR_STUDIO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_studios WHERE name='".$post_studio_new."'");
					if(mysql_num_rows($CHECK_FOR_STUDIO)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$post_studio_new."</b> is already in the database.";}
				}
				
				if($post_network=="custom"){
					/* CHECK TO SEE IF IT IS ALREAY IN DB */
					$CHECK_FOR_NETWORK=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_networks WHERE name='".$post_network_new."'");
					if(mysql_num_rows($CHECK_FOR_NETWORK)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$post_network_new."</b> is already in the database.";}
				}
				
				if($post_original_run_start==""){$error_console.="<br />You must select a date for original run.";}
				if($post_original_run_end==""){$error_console.="<br />You must select a date for original run.";}
				if($post_episodes=="" || $post_episodes==0){$error_console.="<br />Cannot be 0 or blank; Must have at least 1.";}
			}
			/* END ADDON: OTHER WORK */
			
			/* ADDON: OTHER WORK */
			if($post_pop=="otherwork"){
				if($post_link==""){$error_console.="<br />You are missing the link for your other work post.";}
				
			}
			/* END ADDON: OTHER WORK */
			
			/* ADDON: WORK */
			if($post_pop=="work"){
				if($post_portfolio=="custom"){
					/* CHECK TO SEE IF IT IS ALREAY IN DB */
					$CHECK_FOR_PORTFOLIO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_portfolios WHERE name='".$post_portfolio_new."'");
					if(mysql_num_rows($CHECK_FOR_PORTFOLIO)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$post_portfolio_new."</b> is already in the database.";}
				}
				
				if($post_type=="custom"){
					/* CHECK TO SEE IF IT IS ALREAY IN DB */
					$CHECK_FOR_PROJECTTYPE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects_types WHERE name='".$post_type_new."'");
					if(mysql_num_rows($CHECK_FOR_PROJECTTYPE)<1){/* NOT THERE; IT'S SAFE */}else{$error_console.="<br />It appears that <b>".$post_type_new."</b> is already in the database.";}
				}									
			}
			/* END ADDON: WORK */
			/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */
			
			if($error_console!=""){
				echo "<h2>Uh oh! There appear to be errors among us.</h2>";
				echo $error_console."<br /><br /><a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";
			} else {
				/* STEP 2.5: MASTER SOME STUFF */
				if($post_category=="custom"){
					/* NEW CATEGORY */
					/* INSERT THE NEW CAT */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}".$post_pop."_categories (name,shortname,parentid,is_searchable) VALUES ('$post_customcategory','".converter($properties,$post_customcategory,"url","to")."','0','yes')");
					/* GET INSERT ID */
					$new_category_id=mysql_insert_id();
					$post_category=$new_category_id;
				} else {
					$post_category=$post_category;
				}
				if($post_startedit=="no"){
					$post_date						= "0000-00-00";
					$post_time						= "00:00:00";
					$post_dateandtime				= $post_date." ".$post_time;
					$post_dateandtime_goingtostart	= $post_dategts." ".$post_timegts;
					$post_date_year					= substr($post_dateandtime_goingtostart,0,4);
					$post_date_month				= substr($post_dateandtime_goingtostart,5,2);
					$post_date_day					= substr($post_dateandtime_goingtostart,8,2);
					$post_date_hour					= substr($post_dateandtime_goingtostart,11,2);
					$post_date_min					= substr($post_dateandtime_goingtostart,14,2);
					$post_date_sec					= substr($post_dateandtime_goingtostart,17,2);
				} else if($post_startedit=="yes"){
					$post_dategts					= "0000-00-00";
					$post_timegts					= "00:00:00";
					$post_dateandtime				= $post_date." ".$post_time;
					$post_dateandtime_goingtostart	= $post_dategts." ".$post_timegts;
					$post_date_year					= substr($post_dateandtime,0,4);
					$post_date_month				= substr($post_dateandtime,5,2);
					$post_date_day					= substr($post_dateandtime,8,2);
					$post_date_hour					= substr($post_dateandtime,11,2);
					$post_date_min					= substr($post_dateandtime,14,2);
					$post_date_sec					= substr($post_dateandtime,17,2);
				}
				
				/* STEP 3: UPLOAD/SAVE */
				
				
				
				/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
				/* ADDON: AF : A-Z LIST */
				if($post_pop=="pages_af_atoz"){
					/* SAVE MAIN DATA */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}".$post_postedto." (title,content,director,studio,network,category,tags,dateandtime,dateandtime_goingtostart,date_year,date_month,date_day,date_hour,date_min,date_sec,original_run_start,original_run_end,is_searchable,episodes,reviewedby,watch_type,plot,eye_candy,screenshots,status,featured,featured_image) VALUES ('".$post_title."','".$post_content."','".$post_director."','".$post_studio."','".$post_network."','".$post_category."','".$post_tags."','".$post_dateandtime."','".$post_dateandtime_goingtostart."','".$post_date_year."','".$post_date_month."','".$post_date_day."','".$post_date_hour."','".$post_date_min."','".$post_date_sec."','".$post_original_run_start."','".$post_original_run_end."','".$post_is_searchable."','".$post_episodes."','".$post_author."','".$post_watch_type."','".$post_plot."','".$post_eye_candy."','".$post_screenshots."','".$post_status."','".$post_featured."','".$post_featured_image."')");
					$post_id_new=mysql_insert_id();
					/* SAVE EXTRA DATA */
					if($post_director=="custom"){
						mysql_query("INSERT INTO {$properties->DB_PREFIX}".$post_pop."_directors (name,shortname,website,gender,born,parentid,is_searchable) VALUES ('$post_director_new','".converter($properties,$post_director_new,'url','to')."','','other','0000-00-00','0','yes')") or die(mysql_error());
						$post_director_new_id=mysql_insert_id();
						mysql_query("UPDATE {$properties->DB_PREFIX}".$post_postedto." SET director='".$post_director_new_id."' WHERE id='".$post_id_new."'");
					}
					if($post_studio=="custom"){
						mysql_query("INSERT INTO {$properties->DB_PREFIX}".$post_pop."_studios (name,shortname,website,parentid,is_searchable) VALUES ('$post_studio_new','".converter($properties,$post_studio_new,'url','to')."','','0','yes')") or die(mysql_error());
						$post_studio_new_id=mysql_insert_id();
						mysql_query("UPDATE {$properties->DB_PREFIX}".$post_postedto." SET studio='".$post_studio_new_id."' WHERE id='".$post_id_new."'");
					}
					
					if($post_network=="custom"){
						mysql_query("INSERT INTO {$properties->DB_PREFIX}".$post_pop."_networks (name,shortname,website,parentid,is_searchable) VALUES ('$post_network_new','".converter($properties,$post_network_new,'url','to')."','','0','yes')") or die(mysql_error());
						$post_network_new_id=mysql_insert_id();
						mysql_query("UPDATE {$properties->DB_PREFIX}".$post_postedto." SET network='".$post_network_new_id."' WHERE id='".$post_id_new."'");
					}
					
				}
				/* END ADDON: OTHER WORK */
				
				/* ADDON: OTHER WORK */
				if($post_pop=="otherwork"){
									
				}
				/* END ADDON: OTHER WORK */
				
				/* ADDON: WORK */
				if($post_pop=="work"){
											
				}
				/* END ADDON: WORK */
				/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */
				
				
				
				
				
				if($post_pop == "work"){				
					mysql_query("INSERT INTO {$properties->DB_PREFIX}".$post_postedto." (title,description,author,type,tags,dateandtime,dateandtime_goingtostart,date_year,date_month,date_day,date_hour,date_min,date_sec,is_searchable,status,featured,featured_image) VALUES ('".$post_title."','".$post_content."','".$post_author."','".$post_category."','".$post_tags."','".$post_dateandtime."','".$post_dateandtime_goingtostart."','".$post_date_year."','".$post_date_month."','".$post_date_day."','".$post_date_hour."','".$post_date_min."','".$post_date_sec."','yes','".$post_status."','".$post_isfeatured."','".$post_featuredimage."')") or die(mysql_error());
				} else if($post_pop == "pages_af_atoz"){
					/* HANDLED ABOVE */
				} else {
					mysql_query("INSERT INTO {$properties->DB_PREFIX}".$post_postedto." (title,content,author,category,tags,dateandtime,dateandtime_goingtostart,date_year,date_month,date_day,date_hour,date_min,date_sec,is_searchable,status,featured,featured_image) VALUES ('".$post_title."','".$post_content."','".$post_author."','".$post_category."','".$post_tags."','".$post_dateandtime."','".$post_dateandtime_goingtostart."','".$post_date_year."','".$post_date_month."','".$post_date_day."','".$post_date_hour."','".$post_date_min."','".$post_date_sec."','yes','".$post_status."','".$post_isfeatured."','".$post_featuredimage."')") or die(mysql_error());
				}
				
				/* STEP 4: POST RETURN OF RECEIPT */
				echo "<br /><b>".$post_title."</b> has been successfully posted to <b>".ucfirst($post_pop)."</b>! <a href=\"".$WEBSITE_URL."?menu=posts\">Refresh</a>";
			}
			
		} else {		
			$postedto=$_POST['_chooser']."_".$_POST['subitem_'.$_POST['_chooser']]; //output example: blog_entries
			$pop=$_POST['_chooser'];
			?>
			<form action="" method="post">
				<input type="hidden" name="_chooser" value="<?php echo $_POST['_chooser'];?>" />
				<input type="hidden" name="post_author" value="<?php echo $user_id;?>" />
				<input type="hidden" name="post_postedto" value="<?php echo $postedto;?>" />
				<input type="hidden" name="post_pop" value="<?php echo $pop;?>" />
				<div class="cp-table">
					<div class="cp-row">
						<div class="cp-lcol">
							<div class="formLayoutTable">
								<div class="formLayoutTableRow">
									<div class="formLayoutTableRowLeftCol">
										<input type="text" name="post_title" id="post_title" value="Give the post a clever title" onfocus="if(this.value=='Give the post a clever title'){this.value='';}" onblur="if(this.value==''){this.value='Give the post a clever title';}" class="full-input" />
									</div>
									<div class="formLayoutTableRowRightCol">
										
									</div>
								</div>
								
								<div class="formLayoutTableRow">
									<div class="formLayoutTableRowLeftCol">
										<?php
										$FORMULA_CONDENSED=substr($WEBSITE_URL_ROOT.$pad,0,20)."...";
										?>
										<?php //echo $FORMULA_CONDENSED."/".$page."/"."permalink/".$postid_dateyear."/".$postid_datemonth."/".$postid_dateday."/".$postid_nameclean;?> <!--<a href="<?php //echo $WEBSITE_URL_ROOT.$pad."/".$pop."/"."permalink/".$postid_dateyear."/".$postid_datemonth."/".$postid_dateday."/".$postid_nameclean;?>" target="_blank">Preview</a>-->
									</div>
									<div class="formLayoutTableRowRightCol">
										
									</div>
								</div>
								
								<br />
								
								<div class="formLayoutTableRow">
									<div class="formLayoutTableRowLeftCol">
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
										<textarea name="post_content" id="nEditor" rows="35"></textarea>
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
									</div>
									<div class="formLayoutTableRowRightCol">
										
									</div>
								</div>
							</div>
						</div>
						<div class="cp-rcol">
							<div class="formLayoutTableMainAll">
								<div class="formLayoutTableRow">
									<div class="formLayoutTableRowLeftCol">
										<h2>Publish</h2>
									</div>
									<div class="formLayoutTableRowRightCol">
										
									</div>
								</div>
								
								<div class="formLayoutTableRow">
									<div class="formLayoutTableRowLeftCol">
										<input type="submit" name="post_publish" value="Save" class="submit" />
									</div>
									<div class="formLayoutTableRowRightCol">
										
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Status:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_status">
											<option value="Drafted" >Draft</option>
											<option value="Published" >Final</option>
											<option value="On Hold" >Hold</option>
										</select>
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Publish:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										 <select name="post_publish">
											<option value="immediately">Immediately</option>
											<option value="in_24_hours">In 24 hours</option>
										 </select>
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Publicize:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_publicize">
											<option value="yes">Yes</option>
											<option value="no">No</option>
										</select> <a href="?menu=settings&page=sharing">Settings</a>
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										<script type="text/javascript">
											$(function() {
												$('#post_date').datepick({dateFormat: 'yyyy-mm-dd'});
												//$('#inlineDatepicker').datepick({onSelect: showDate});
											});
										</script>
										Date:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="date" name="post_date" min="<?php echo date("Y-m-d");?>" id="post_date" value="<?php echo date("Y-m-d");?>" style="width:120px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Time:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="time" name="post_time" step="1" value="<?php echo date("H:i:s");?>" style="width:120px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										<script type="text/javascript">
											$(function() {
												$('#post_dategts').datepick({dateFormat: 'yyyy-mm-dd'});
												//$('#inlineDatepicker').datepick({onSelect: showDate});
											});
										</script>
										GTS (<a title="I means Going to Start" style="cursor:pointer;">?</a>) Date:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="date" name="post_dategts" min="<?php echo date("Y-m-d");?>" id="post_dategts" value="<?php echo date("Y-m-d");?>" style="width:120px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										GTS (<a title="It means Going to Start" style="cursor:pointer;">?</a>) Time:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="time" name="post_timegts" step="1" value="<?php echo date("H:i:s");?>" style="width:120px;" />
									</div>
								</div>
							</div>
							
							<div class="formLayoutTableMainAll">
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Started it? (<a title="If checked no, then will place a &quot;going to start&quot; date in the database." style="cursor:pointer;">?</a>)
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="radio" name="post_startedit" value="yes" class="radio" /> Yes <input type="radio" name="post_startedit" value="no" class="radio" /> No
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol"> 
										Feature this?
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										 <input type="radio" name="post_isfeatured" value="yes" class="radio" /> Yes <input type="radio" name="post_isfeatured" value="no" class="radio" /> No
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">									
										<?php
										for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
											$pad=$ITEMS_PAD_LIST[$i];
											
											if($ITEMS_LIST_LIST[$i]==$postedto){$page=$ITEMS_PAGE_LIST[$i];}
										}
										?>
										
										FImage (<a title="This is the featured image file name. This file is relative to the title but you only need to type the file name.extension." style="cursor:pointer;">?</a>):
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="text" name="post_featuredimage" id="post_featuredimage" value="" style="width:190px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">                                            	
										OR
									</div>
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
											<center><iframe src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/modules/native/uploader-flashy-enhanced/index.php?id=<?php echo $postid;?>&pop=<?php echo ucfirst($pop);?>&year=<?php echo $postid_dateyear;?>&month=<?php echo $postid_datemonth_word;?>&day=<?php echo $postid_dateday;?>&title=<?php echo $postid_nameclean;?>" style="position:relative; top: 5px;" width="880" height="584"></iframe></center>																				
											<?php
											/* FLASHY WITHOUT FILE WITH FILE SCANNING */
											} else if(getGlobalVars($properties,"uploader_type")=="flashy"){
											?>			
											<script type="text/javascript">
											/* GET THE DATE SELECTED */
											var date_choosen=document.getElementById("post_date").value;
											var date_choosen_gts=document.getElementById("post_dategts").value;
											
											/* CHECK FOR GTS */
											if(date_choosen_gts!=""){/* USE GTS */var final_date=date_choosen_gts;}else{var final_date=date_choosen;}
											
											/* BREAK APART DATE */
											//0000-00-00 00:00:00
											//0123456789012345678
											var dc_year		= final_date.substr(0,4);
											var dc_month	= final_date.substr(5,2);
											var dc_day		= final_date.substr(8,2);
											var dc_hour		= final_date.substr(11,2);
											var dc_min		= final_date.substr(14,2);
											var dc_sec		= final_date.substr(17,2);
											
											/* INTERPRET */
											if(dc_month=="01"){var dc_month_name="Jan";}
											if(dc_month=="02"){var dc_month_name="Feb";}
											if(dc_month=="03"){var dc_month_name="Mar";}
											if(dc_month=="04"){var dc_month_name="Apr";}
											if(dc_month=="05"){var dc_month_name="May";}
											if(dc_month=="06"){var dc_month_name="Jun";}
											if(dc_month=="07"){var dc_month_name="Jul";}
											if(dc_month=="08"){var dc_month_name="Aug";}
											if(dc_month=="09"){var dc_month_name="Sep";}
											if(dc_month=="10"){var dc_month_name="Oct";}
											if(dc_month=="11"){var dc_month_name="Nov";}
											if(dc_month=="12"){var dc_month_name="Dec";}
											
											/* GET THE NAME AND SANTIZE */
											var nameclean=document.getElementById("post_title").value;
											nameclean=str_replace(' ','-',nameclean);
											nameclean=str_replace('!','@',nameclean);
											nameclean=str_replace('.','~',nameclean);
											nameclean=str_replace('#','+',nameclean);
											nameclean=str_replace('+','[PLUS]',nameclean);																														
											
											$('#upload').ajaxupload({
												url: '<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/modules/native/uploader-flashy/upload.php',
												remotePath: '../../../public/uploads/<?php echo ucfirst($pop);?>'+'/'+dc_year+'/'+dc_month+'dc_day'+'/'+nameclean+'/',											
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
											<center><div id="drop_here" style="width:50%;height:200px;border:1px dashed black; border-radius: 5px;">or drop files here</div></center>                                        
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
										<input type="button" name="post_upload_fimage" onclick="post_featuredimage.value='';upload()" value="Browse" class="button" /> <input type="button" name="post_clear_fimage" onclick="post_featuredimage.value=''" value="Clear" class="button" />
									</div>
								</div>
							</div>
							
							<div class="formLayoutTable">
								<div class="formLayoutTableRow">
									<div class="formLayoutTableRowLeftCol">
										<h2>Category</h2>
										<select name="post_category" size="10" style="width:280px;">
										<?php
										if($pop=="work"){$GET_ALL_CATEGORIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pop."_projects_types ORDER BY name");}else{$GET_ALL_CATEGORIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pop."_categories ORDER BY name");}
										if(mysql_num_rows($GET_ALL_CATEGORIES)<1){
											/* NO CATEGORIES */	
											?>
											<option value="">No Categories</option>
											<?php
										} else {
											while($FETCH_ALL_CATEGORIES=mysql_fetch_array($GET_ALL_CATEGORIES)){
												if($FETCH_ALL_CATEGORIES['id'] == $postid_category){
													?><option selected="selected" value="<?php echo $FETCH_ALL_CATEGORIES['id'];?>"><?php echo $FETCH_ALL_CATEGORIES['name'];?> [current]</option><?php
												} else {
													?><option value="<?php echo $FETCH_ALL_CATEGORIES['id'];?>"><?php echo $FETCH_ALL_CATEGORIES['name'];?></option><?php	
												}
											}
											?>
											<option value="" disabled="disabled">----------------------------------------------------------------</option>
											<option value="custom">Custom</option>
											<?php
										}
										?>
										</select>
										<br /><br />
										Custom (new) Category Name
										<input type="text" name="post_customcategory" style="width:280px;" />
									</div>
									<div class="formLayoutTableRowRightCol">
										
									</div>
								</div>
							</div>
							
							<div class="formLayoutTable">
								<div class="formLayoutTableRow">
									<div class="formLayoutTableRowLeftCol">
										<h2>Tags (comma separated)</h2>
										<input type="text" name="post_tags" value="<?php echo $postid_tags;?>" onfocus="if(this.value=='comma separated tags here'){this.value='';}" onblur="if(this.value==''){this.value='comma separated tags here';}" style="width:280px;" />
									</div>
									<div class="formLayoutTableRowRightCol">
										
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
										<input type="text" name="post_ADDONNAME" value="<?php //echo $postid_addon_ADDONNAME;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:280px;" />
									</div>
									<div class="formLayoutTableRowRightCol">
										
									</div>
								</div>
							</div>
							-->
							<?php
							/* END ADDON NAME: TEMPLATE */
							
							/* ADDON NAME: AF : A-Z LIST CUSTOMS */
							if($pop=="pages_af_atoz"){
							?>
							<h2>Custom Fields</h2>
							<div class="formLayoutTableMainAll">
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Director
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_director">
											<?php
											$GET_DIRECTORS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_directors ORDER BY name");
											if(mysql_num_rows($GET_DIRECTORS)<1){
												?>
												<option value="none">No Directors</option>
												<?php	
											} else {
												while($FETCH_DIRECTORS=mysql_fetch_array($GET_DIRECTORS)){
													if($postid_addon_director==$FETCH_DIRECTORS['id']){?><option value="<?php echo $FETCH_DIRECTORS['id'];?>" selected="selected"><?php echo $FETCH_DIRECTORS['name'];?> [current]</option><?php }else{?><option value="<?php echo $FETCH_DIRECTORS['id'];?>"><?php echo $FETCH_DIRECTORS['name'];?></option><?php }
												}
											}
											?>
											<option value="" disabled="disabled">---------------------------------------------</option>
											<option value="custom">Add New (add below)</option>
										</select>
										<input type="text" name="post_director_new" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Studio
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_studio">
											<?php
											$GET_STUDIOS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_studios ORDER BY name");
											if(mysql_num_rows($GET_STUDIOS)<1){
												?>
												<option value="none">No Studios</option>
												<?php	
											} else {
												while($FETCH_STUDIOS=mysql_fetch_array($GET_STUDIOS)){
													if($postid_addon_studio==$FETCH_STUDIOS['id']){?><option value="<?php echo $FETCH_STUDIOS['id'];?>" selected="selected"><?php echo $FETCH_STUDIOS['name'];?> [current]</option><?php }else{?><option value="<?php echo $FETCH_STUDIOS['id'];?>"><?php echo $FETCH_STUDIOS['name'];?></option><?php }
												}
											}
											?>
											 <option value="" disabled="disabled">---------------------------------------------</option>
											<option value="custom">Add New (add below)</option>
										</select>
										<input type="text" name="post_studio_new" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Network
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_network">
											<?php
											$GET_NETWORKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_networks ORDER BY name");
											if(mysql_num_rows($GET_NETWORKS)<1){
												?>
												<option value="none">No Directors</option>
												<?php	
											} else {
												while($FETCH_NETWORKS=mysql_fetch_array($GET_NETWORKS)){
													if($postid_addon_network==$FETCH_NETWORKS['id']){?><option value="<?php echo $FETCH_NETWORKS['id'];?>" selected="selected"><?php echo $FETCH_NETWORKS['name'];?> [current]</option><?php }else{?><option value="<?php echo $FETCH_NETWORKS['id'];?>"><?php echo $FETCH_NETWORKS['name'];?></option><?php }
												}
											}
											?>
											 <option value="" disabled="disabled">---------------------------------------------</option>
											<option value="custom">Add New (add below)</option>
										</select>
										<input type="text" name="post_network_new" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Airdate Start
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<script type="text/javascript">
											$(function() {
												$('#post_original_run_start').datepick({dateFormat: 'yyyy-mm-dd'});
												//$('#inlineDatepicker').datepick({onSelect: showDate});
											});
										</script>
										<input type="text" id="post_original_run_start" name="post_original_run_start" value="" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Airdate End
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<script type="text/javascript">
											$(function() {
												$('#post_original_run_end').datepick({dateFormat: 'yyyy-mm-dd'});
												//$('#inlineDatepicker').datepick({onSelect: showDate});
											});
										</script>
										<input type="text" id="post_original_run_end" name="post_original_run_end" value="" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Episodes #
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="number" name="post_episodes" step="1" min="0" value="" onchange="if(this.value<0){this.value=0;}" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Activity
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_watch_type">
											<?php if($postid_addon_watch_type=="Watched"){?><option value="Watched" selected="selected"></option><?php } else {?><option value="Watched">Watched</option><?php }?>
											<?php if($postid_addon_watch_type=="Watching Now"){?><option value="Watching Now" selected="selected">Watching Now</option><?php } else {?><option value="Watching Now">Watching Now</option><?php }?>
											<?php if($postid_addon_watch_type=="Need to Watch"){?><option value="Need to Watch" selected="selected">Need to Watch</option><?php } else {?><option value="Need to Watch">Need to Watch</option><?php }?>
										</select>
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Plot
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<textarea name="post_plot" rows="5" cols="22"></textarea>
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										ScrShots
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="text" name="post_screenshots" value="" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
										<br />
										* separated by commas
										<br />
										** only put filename.extension
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										EyeCandy
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="text" name="post_eyecandy" value="" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
										<br />
										* separated by commas
										<br />
										** only put filename.extension
									</div>
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
									<div class="formLayoutTableRowMainAllLeftCol">
										Link
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="text" name="post_link" value="" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
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
									<div class="formLayoutTableRowMainAllLeftCol">
										Filename
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="text" name="post_filename" value="" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Portfolio
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_portfolio">
											<option value="">---- select a portfolio ----</option>
											<?php
											$GET_PORTFOLIOS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_portfolios ORDER BY name");
											if(mysql_num_rows($GET_PORTFOLIOS)<1){
												?>
												<option value="none">No Portfolios :(</option>
												<?php
											} else {
												while($FETCH_PORTFOLIOS=mysql_fetch_array($GET_PORTFOLIOS)){
													if($postid_addon_portfolio==$FETCH_PORTFOLIOS['id']){?><option value="<?php echo $FETCH_PORTFOLIOS['id'];?>" selected="selected"><?php echo $FETCH_PORTFOLIOS['name'];?></option><?php } else {?><option value="<?php echo $FETCH_PORTFOLIOS['id'];?>"><?php echo $FETCH_PORTFOLIOS['name'];?></option><?php }
												}
											}
											?>
											<option value="" disabled="disabled">-------------------------------------------</option>
											<option value="custom">Add New (add below)</option>
										</select>
										<input type="text" name="post_portfolio_new" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Image
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="text" name="post_imagename" value="<?php echo $postid_addon_imagename;?>" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										SizeW
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="number" step="1" min="0" max="660" onchange="if(this.value<0){this.value=0;}if(this.value>660){this.value=660;}if(this.value==''){this.value='660'}" name="post_image_size_width" value="<?php echo $postid_addon_image_size_width;?>" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										SizeFW
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="number" step="1" min="0" max="645" onchange="if(this.value<0){this.value=0;}if(this.value>645){this.value=645;}if(this.value==''){this.value='645'}" name="post_image_size_full_width" value="<?php echo $postid_addon_image_size_full_width;?>" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										SizeH
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="number" name="post_image_size_height" step="1" min="0" max="330" onchange="if(this.value<0){this.value=0;}if(this.value>330){this.value=330;}if(this.value==''){this.value='330'}" value="<?php echo $postid_addon_image_size_height;?>" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										SizeFH
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="number" step="1" min="0" max="500" onchange="if(this.value<0){this.value=0;}if(this.value>500){this.value=500;}if(this.value==''){this.value='500'}" name="post_image_size_full_height" value="<?php echo $postid_addon_image_size_full_height;?>" style="width:200px;" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Type
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_type">
											<?php
											$GET_PROJECT_TYPES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects_types ORDER BY name");
											if(mysql_num_rows($GET_PROJECT_TYPES)<1){
												?>
												<option value="none">No Project Types :(</option>
												<?php
											} else {
												while($FETCH_PROJECT_TYPES=mysql_fetch_array($GET_PROJECT_TYPES)){
													if($postid_addon_type==$FETCH_PROJECT_TYPES['id']){?><option value="<?php echo $FETCH_PROJECT_TYPES['id'];?>" selected="selected"><?php echo $FETCH_PROJECT_TYPES['name'];?></option><?php }else{?><option value="<?php echo $FETCH_PROJECT_TYPES['id'];?>"><?php echo $FETCH_PROJECT_TYPES['name'];?></option><?php }
												}
											}
											?><option value="" disabled="disabled">-------------------------------------------</option>
											<option value="custom">Add New (add below)</option>
										</select>
										<input type="text" name="post_type_new" />
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Installable?
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<?php if($postid_is_installable == "yes"){?><input type="radio" name="post_is_installable" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="post_is_installable" value="no" class="radio" /> No<?php } else {?><input type="radio" name="post_is_installable" value="yes" class="radio" /> Yes <input type="radio" name="post_is_installable" value="no" checked="checked" class="radio" /> No<?php }?>
									</div>
								</div>
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Progress
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_progress">
											<?php if($postid_addon_progress=="not started"){?><option value="not started" selected="selected">Not Started</option><?php } else {?><option value="not started">Not Started</option><?php }?>
											<?php if($postid_addon_progress=="in progress"){?><option value="in progress" selected="selected">In Progress</option><?php } else {?><option value="in progress">In Progress</option><?php }?>
											<?php if($postid_addon_progress=="completed"){?><option value="completed" selected="selected">Completed</option><?php } else {?><option value="completed">Completed</option><?php }?>                                             
											<?php if($postid_addon_progress=="deprecated"){?><option value="deprecated" selected="selected">Deprecated</option><?php } else {?><option value="deprecated">Deprecated</option><?php }?>
										</select>
									</div>
								</div>
								
							</div>
							<?php
							}										
							/* END ADDON NAME: MYWORK CUSTOMS */
																	
							/* ADDON NAME: CHANGELOG CUSTOMS */
							if($base=="changelog"){
							?>
							<h2>Custom Fields</h2>
							<div class="formLayoutTableMainAll">
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Type
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="post_typeofupdate" value="" style="width:200px;">
											<option value="UPDATE">Update</option>
											<option value="GO MAS">Golden Master</option>
											<option value="MAJOR REL">Major Release</option>
										</select>
									</div>
								</div>													
								
							</div>
							<?php
							}										
							/* END ADDON NAME: CHANGELOG CUSTOMS */																
																	
							/* ------------ END CUSTOMIZED ADDONS ------------------------------------------------------------------------------ */
							?>
							
						</div>
					</div>
				</div>
			</form>
			<?php
		}
	} else {
		/* CHECK TO SEE IF THERE ARE MULTIPLE THINGS TO POST TO; IF ONLY ONE - DISPLAY FORM(S) */
		if(count($ITEMS_LIST_LIST)-1==1){
			/* ONLY ONE */
			$sub_item=$SUBITEMS_LIST_LIST[0];
			?>
			<input type="hidden" name="subitem_<?php echo $ITEMS_LIST_LIST[0];?>" value="<?php echo $sub_item;?>" />
			<h1 style="opacity:.5;">Posting in <?php echo $ITEMS_LIST_NAMES_LIST[0];?></h1>
			<?php
			if(isset($_POST['post_publish'])){
				/* STEP 1: GET DATA */
				$postid=$_GET['postid'];
				$what=$_GET['what'];
				$pad=$_GET['pad'];
				$pop=$_GET['pop'];
				$base=$_GET['base'];
				$subbase=$_GET['subbase'];
				
				$post_title=mysql_real_escape_string($_POST['post_title']);
				$post_content=mysql_real_escape_string($_POST['post_content']);
				$post_status=mysql_real_escape_string($_POST['post_status']);
				$post_publish=mysql_real_escape_string($_POST['post_publish']);
				$post_publicize=mysql_real_escape_string($_POST['post_publicize']);
				$post_date=mysql_real_escape_string($_POST['post_date']);
				$post_time=mysql_real_escape_string($_POST['post_time']);
				$post_dategts=mysql_real_escape_string($_POST['post_dategts']);
				$post_timegts=mysql_real_escape_string($_POST['post_timegts']);
				$post_startedit=mysql_real_escape_string($_POST['post_started']);
				$post_isfeatured=mysql_real_escape_string($_POST['post_isfeatured']);
				$post_featuredimage=mysql_real_escape_string($_POST['post_featuredimage']);
				$post_category=mysql_real_escape_string($_POST['post_category']);
				$post_customcategory=mysql_real_escape_string($_POST['post_customcategory']);
				$post_tags=mysql_real_escape_string($_POST['post_tags']);
				
				/* STEP 2: CHECK DATA FOR ACCURACY */
				if($post_category=="custom" && $post_customcategory==""){/* DID NOT ENTER CUSTOM CATEGORY NAME */$error_console="<br />Since you selected a custom category, you must name your new category. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";}
				
				if($error_console!=""){
					echo $error_console;
				} else {
					/* STEP 3: UPLOAD/SAVE */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}".$what." SET title='".$post_title."' WHERE id='".$postid."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET title='".$post_title."' WHERE id='".$postid."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content='".$post_content."' WHERE id='".$postid."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='".$post_status."' WHERE id='".$postid."'") or die(mysql_error());
					if($post_startedit=="no"){
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime_goingtostart='".$post_date." ".$post_time."' WHERE id='".$postid."'");	
					} else if($post_startedit=="yes") {
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime='".$post_date." ".$post_time."' WHERE id='".$postid."'");
					}
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET featured='".$post_isfeatured."' WHERE id='".$postid."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET featured_image='".$post_featuredimage."' WHERE id='".$postid."'");
					if($post_customcategory != ""){
						/* NEW CATEGORY */
						/* INSERT THE NEW CAT */
						mysql_query("INSERT INTO {$properties->DB_PREFIX}".$base."_categories (name,shortname,parentid,is_searchable) VALUES ('$post_customcategory','".converter($properties,$post_customcategory,"url","to")."','0','yes')");
						/* GET INSERT ID */
						$new_category_id=mysql_insert_id();
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET category='".$new_category_id."' WHERE id='".$postid."'");
					} else {
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET category='".$post_category."' WHERE id='".$postid."'");
					}
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET tags='".$post_tags."' WHERE id='".$postid."'");
					
					/* STEP 4: POST RETURN OF RECEIPT */
					echo "<br /><b>".$post_title."</b> has been successfully updated!";
				}
				
			} else {
				?>
				<form action="" method="post">
					<div class="cp-table">
						<div class="cp-row">
							<div class="cp-lcol">
								<div class="formLayoutTable">
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<input type="text" name="post_title" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $postid_name;?>" class="full-input" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<?php
											$FORMULA_CONDENSED=substr($WEBSITE_URL_ROOT.$pad,0,20)."...";
											?>
											<?php echo $FORMULA_CONDENSED."/".$pop."/"."permalink/".$postid_dateyear."/".$postid_datemonth."/".$postid_dateday."/".$postid_nameclean;?> <a href="<?php echo $WEBSITE_URL_ROOT.$pad."/".$pop."/"."permalink/".$postid_dateyear."/".$postid_datemonth."/".$postid_dateday."/".$postid_nameclean;?>" target="_blank">Preview</a>
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<br />
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<textarea name="post_content" rows="35"><?php echo $postid_content;?></textarea>
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
								</div>
							</div>
							<div class="cp-rcol">
								<div class="formLayoutTableMainAll">
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<h2>Publish</h2>
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<input type="submit" name="post_publish" value="Save" class="submit" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Status:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<select name="post_status">
												<?php if($postid_status=="Drafted"){?><option value="Drafted" selected="selected">Draft</option><?php } else {?><option value="Drafted">Draft</option><?php }?>
												<?php if($postid_status=="Published"){?><option value="Published" selected="selected">Final</option><?php } else {?><option value="Published">Final</option><?php }?>
												<?php if($postid_status=="On Hold"){?><option value="On Hold" selected="selected">Hold</option><?php } else {?><option value="On Hold">Hold</option><?php }?>
											</select>
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Publish:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											 <select name="post_publish"><option value="immediately">Immediately</option><option value="in_24_hours">In 24 hours</option></select>
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Publicize:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<select name="post_publicize"><option value="yes">Yes</option><option value="no">No</option></select> <a href="?menu=settings&page=sharing">Settings</a>
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											<script type="text/javascript">
												$(function() {
													$('#post_date').datepick({dateFormat: 'yyyy-mm-dd'});
													//$('#inlineDatepicker').datepick({onSelect: showDate});
												});
											</script>
											Date:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<input type="date" name="post_date" min="<?php echo $postid_dateyear."-".$postid_datemonth."-".$postid_dateday;?>" id="post_date" value="<?php echo $postid_dateyear."-".$postid_datemonth."-".$postid_dateday;?>" style="width:120px;" />
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Time:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<input type="time" name="post_time" step="1" value="<?php echo $postid_datehour.":".$postid_datemin.":".$postid_datesec;?>" style="width:120px;" />
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											<script type="text/javascript">
												$(function() {
													$('#post_dategts').datepick({dateFormat: 'yyyy-mm-dd'});
													//$('#inlineDatepicker').datepick({onSelect: showDate});
												});
											</script>
											GTS (<a title="I means Going to Start" style="cursor:pointer;">?</a>) Date:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<input type="date" name="post_dategts" min="<?php echo $postid_dateyeargts."-".$postid_datemonthgts."-".$postid_datedaygts;?>" id="post_dategts" value="<?php echo $postid_dateyeargts."-".$postid_datemonthgts."-".$postid_datedaygts;?>" style="width:120px;" />
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											GTS (<a title="It means Going to Start" style="cursor:pointer;">?</a>) Time:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<input type="time" name="post_timegts" step="1" value="<?php echo $postid_datehourgts.":".$postid_datemingts.":".$postid_datesecgts;?>" style="width:120px;" />
										</div>
									</div>
								</div>
								
								<div class="formLayoutTableMainAll">
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Started it? (<a title="If checked no, then will place a &quot;going to start&quot; date in the database." style="cursor:pointer;">?</a>)
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<?php if($postid_dateandtime_goingtostart == "0000-00-00 00:00:00"){?><input type="radio" name="post_startedit" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="post_startedit" value="no" class="radio" /> No<?php } else {?><input type="radio" name="post_startedit" value="yes" class="radio" /> Yes <input type="radio" name="post_startedit" value="no" checked="checked" class="radio" /> No<?php }?>
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol"> 
											Feature this?
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											 <?php if($postid_featured == "yes"){?><input type="radio" name="post_isfeatured" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="post_isfeatured" value="no" class="radio" /> No<?php } else {?><input type="radio" name="post_isfeatured" value="yes" class="radio" /> Yes <input type="radio" name="post_isfeatured" value="no" checked="checked" class="radio" /> No<?php }?>
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
											
											FImage (<a title="This is the featured image file name. This file is relative to <?php echo ucfirst($pop)."/".$postid_dateyear."/".$postid_datemonth_word."/".$postid_dateday."/".str_replace(":","",$postid_nameclean);?>/ but you only need to type the file name.extension." style="cursor:pointer;">?</a>):
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<input type="text" name="post_featuredimage" id="post_featuredimage" value="<?php echo $postid_featured_image;?>" style="width:190px;" />
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">                                            	
											OR
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<div id="upload_popup" style="display:none;" class="upload-popup">
												<!--<center><iframe src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/uploader/index.php?id=<?php echo $postid;?>&pop=<?php echo ucfirst($pop);?>&year=<?php echo $postid_dateyear;?>&month=<?php echo $postid_datemonth_word;?>&day=<?php echo $postid_dateday;?>&title=<?php echo $postid_nameclean;?>" style="position:relative; top: 5px;" width="880" height="584"></iframe></center>-->
																									
												<script type="text/javascript">
												$('#upload').ajaxupload({
													url: '<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/uploader/upload.php',
													remotePath: '../../../public/uploads/<?php echo $pop."/".$postid_dateyear."/".$postid_datemonth_word."/".$postid_dateday."/".$postid_nameclean."/";?>',
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
												
												<center><div id="drop_here" style="width:50%;height:200px;border:1px dashed black; border-radius: 5px;">or drop files here</div></center>
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
											<input type="button" name="post_upload_fimage" onclick="post_featuredimage.value='';upload()" value="Browse" class="button" /> <input type="button" name="post_clear_fimage" onclick="post_featuredimage.value=''" value="Clear" class="button" />
										</div>
									</div>
								</div>
								
								<div class="formLayoutTable">
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<h2>Category</h2>
											<select name="post_category" size="10" style="width:280px;">
											<?php
											$GET_ALL_CATEGORIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what_starter."_categories ORDER BY name");
											if(mysql_num_rows($GET_ALL_CATEGORIES)<1){
												/* NO CATEGORIES */	
												?>
												<option value="">No Categories</option>
												<?php
											} else {
												while($FETCH_ALL_CATEGORIES=mysql_fetch_array($GET_ALL_CATEGORIES)){
													if($FETCH_ALL_CATEGORIES['id'] == $postid_category){
														?><option selected="selected" value="<?php echo $FETCH_ALL_CATEGORIES['id'];?>"><?php echo $FETCH_ALL_CATEGORIES['name'];?> [current]</option><?php
													} else {
														?><option value="<?php echo $FETCH_ALL_CATEGORIES['id'];?>"><?php echo $FETCH_ALL_CATEGORIES['name'];?></option><?php	
													}
												}
												?>
												<option value="" disabled="disabled">----------------------------------------------------------------</option>
												<option value="custom">Custom</option>
												<?php
											}
											?>
											</select>
											<br /><br />
											Custom (new) Category Name
											<input type="text" name="post_customcategory" style="width:280px;" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
								</div>
								
								<div class="formLayoutTable">
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<h2>Tags</h2>
											<input type="text" name="post_tags" value="<?php echo $postid_tags;?>" onfocus="if(this.value=='comma separated tags here'){this.value='';}" onblur="if(this.value==''){this.value='comma separated tags here';}" style="width:280px;" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<?php
			}
		} else if(count($ITEMS_LIST_LIST)-1<1){
			/* NONE */
			?>
			<center><h1 style="opacity:.5;">There are no items to post to :( <a href="<?php echo $WEBSITE_URL;?>?menu=settings&page=writing#pps">Add one now</a></h1></center>
			<?php
		} else {
			/* MULTIPLE */
			?>
			<center>
			<h1>Before you begin, select what you what to post to</h1>
			<form action="" method="post">        
			<?php
			for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
				$sub_item=$SUBITEMS_LIST_LIST[$i];
				?>
				<input type="hidden" name="subitem_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $sub_item;?>" />
				<?php
			}
			?>
			<select id="_chooser" name="_chooser" onchange="this.form.submit()" style="width:250px;height:35px;vertical-align:text-top;font-size:22px;border:thin solid gray;">
				<option value="">----- select an option -----</option>
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
					<option value="<?php echo $item;?>"><?php echo $name;?></option>
					<?php
				}
				?>
			</select>
			</form>
			</center>
			<?php
		}
	}
} else {
	?>
    <center><h1>You do not have the permission to use this feature. :(</h1></center>
    <?php	
}
?>