<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
$FULL_PAD=",";
$ITEMS_PAGE=",";
$ITEMS_LIST="pages_modules,";
$ITEMS_DEFAULT_LIST="no,"; // this is where you tell us what item is default to display
$SUBITEMS_LIST=","; //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES="Page Modules,";
$ITEMS_LIST_SPECIAL="0,"; //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM="none,"; //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER="title"; //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
	
/* -------------------------------------------------------- DO NOT EDIT BELOW THIS LINE -------------------------------------------------------------------- */
require("../includes/private/tools/converter.php");
?>

<style type="text/css">
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
	width: 480px;
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
<h1>Page Modules <a href="?menu=pages&page=add-new-pm" class="small">Add New</a></h1>
Filter by
<select id="_chooser" onchange="_chooser();">
	<option value="all">All Page Modules</option>
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
	?><input type="hidden" id="element_count" value="<?php echo count($ITEMS_LIST_LIST)-1;?>" />
<?php
/* CATCH IF */
if(isset($_GET['action'])){
	
	/* SWITCH THE CATCH */
	switch($_GET['action']){
		case 'edit':
			if($type == "admin"){
				if(isset($_POST['editmodule_publish'])){
					/* STEP 1: GET DATA */
					$module=$_GET['moduleid'];
					$what=$_GET['what'];
					
					$editmodule_arr=mysql_real_escape_string($_POST['editmodule_arr']);
					$editmodule_launchpad=mysql_real_escape_string($_POST['editmodule_launchpad']);
					$editmodule_title=mysql_real_escape_string($_POST['editmodule_title']);
					$editmodule_minititle=mysql_real_escape_string($_POST['editmodule_minititle']);
					$editmodule_toggle_title=mysql_real_escape_string($_POST['editmodule_toggle_title']);
					$editmodule_contents=mysql_real_escape_string($_POST['editmodule_contents']);
					$editmodule_page=mysql_real_escape_string($_POST['editmodule_page']);				
					$editmodule_type=mysql_real_escape_string($_POST['editmodule_type']);
					$editmodule_sidebar=mysql_real_escape_string($_POST['editmodule_sidebar']);				
					$editmodule_footer_section=mysql_real_escape_string($_POST['editmodule_footer_section']);				
					$editmodule_toggle_visible=mysql_real_escape_string($_POST['editmodule_toggle_visible']);
					$editmodule_is_searchable=mysql_real_escape_string($_POST['editmodule_is_searchable']);
					$editmodule_status=mysql_real_escape_string($_POST['editmodule_status']);
					
					if($editmodule_title==""){$error_console.="<br />You must give the module a title. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
					if($editmodule_contents==""){$error_console.="<br />A module with nothing in it? Well, ain't that the best thing ever! <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
					if($editmodule_arr==""){$error_console.="<br />Tell me where to put it on the page. Any number depending on the spot you want. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
					if($editmodule_type=="sidebar" && $editmodule_sidebar==""){$error_console.="<br />Since you chose to add this to the sidebar, which one? If you have only one sidebar, it will always be 1; If you have two sidebars, it will be 1 or 2. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
					if($editmodule_type=="footer" && $editmodule_footer_section==""){$error_console.="<br />Since you chose to put this in the footer, tell me what section. Left, middle, or right? <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
					if(strpos($editmodule_page," ")>-1){$error_console.="<br />The Page of Module cannot have spaces in it. <b>HINT:</b> Use - (hyphen) in place of spaces. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
					
					if($error_console!=""){
						echo $error_console;
					} else {
						/* STEP 3: UPLOAD/SAVE */					
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET arr='".$editmodule_arr."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET launchpad='".$editmodule_launchpad."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET title='".$editmodule_title."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET mini_title='".$editmodule_minititle."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET toggle_title='".$editmodule_toggle_title."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET contents='".$editmodule_contents."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET page='".$editmodule_page."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET type='".$editmodule_type."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET sidebar='".$editmodule_sidebar."' WHERE id='".$module."'");
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET footer_section='".$editmodule_footer_section."' WHERE id='".$module."'");															
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET toggle_visible='".$editmodule_toggle_visible."' WHERE id='".$module."'");										
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET is_searchable='".$editmodule_is_searchable."' WHERE id='".$module."'");														
						
						/* STEP 4: POST RETURN OF RECEIPT */
						echo "<br /><b>".$editmodule_title."</b> has been successfully updated! <a href=\"".$WEBSITE_URL."?menu=pages&page=page-modules\">Refresh</a>";
					}
					
				} else {
					$moduleid=$_GET['moduleid'];
					$what=$_GET['what'];
					
					$GET_ENTRY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");
					if(mysql_num_rows($GET_ENTRY_INFO)<1){
						echo "<br />Cannot find a module with the info you provided (truth is you probably changed the URL). <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";	
					} else {
						while($FETCH_ITEMS=mysql_fetch_array($GET_ENTRY_INFO)){
							@$module_id=$FETCH_ITEMS['id'];
							@$arr=$FETCH_ITEMS['arr'];
							@$launchpad=$FETCH_ITEMS['launchpad'];
							@$title=$FETCH_ITEMS['title'];
							@$mini_title=$FETCH_ITEMS['mini_title'];
							@$toggle_title=$FETCH_ITEMS['toggle_title'];
							@$contents=$FETCH_ITEMS['contents'];
							@$page=$FETCH_ITEMS['page'];
							@$type=$FETCH_ITEMS['type'];
							@$sidebar=$FETCH_ITEMS['sidebar'];
							@$footer_section=$FETCH_ITEMS['footer_section'];
							@$toggle_visible=$FETCH_ITEMS['toggle_visible'];
							@$is_seachable=$FETCH_ITEMS['is_searchable'];
							
							echo "<h3>Editing the module of &quot;".$title."&quot; apart of the pad of: <b>".ucfirst($launchpad)."</b></h3>";
							?>
							<form action="" method="post">
								<div class="cp-table">
									<div class="cp-row">
										<div class="cp-lcol">
											<div class="formLayoutTable">
												<div class="formLayoutTableRow">
													<div class="formLayoutTableRowLeftCol">
														<label>Module Title</label>
														<input type="text" name="editmodule_title" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $title;?>" class="full-input" />                                                   
													</div>
													<div class="formLayoutTableRowRightCol">
														
													</div>
												</div>
												
												<div class="formLayoutTableRow">
													<div class="formLayoutTableRowLeftCol">
														<label>Module Mini Title // a short little tagline for the module</label>
														<input type="text" name="editmodule_minititle" value="<?php echo $mini_title;?>" class="full-input" />                                                   
													</div>
													<div class="formLayoutTableRowRightCol">
														
													</div>
												</div>
												
												<div class="formLayoutTableRow">
													<div class="formLayoutTableRowLeftCol">
														<label>Page of Module (already existing; leaving blank will not associated one; this is the safe url)</label>
														<input type="text" name="editmodule_page" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" value="<?php echo $page;?>" class="full-input" />                                                    <h2>Rules for Page of Module:</h2>
														<p>
															<ul>
																<li>You may <b>only</b> use page safe URL's</li>
																<li>If you label it &quot;home&quot; you <b>must</b> place the padname (IE. <?php echo $properties->PADMAIN.", ".$properties->PAD1.", ".$properties->PAD2.", ".$properties->PAD3.", or ".$properties->PAD4;?>) <b>before</b> &quot;home&quot;</li>
																<li>There is no need for this if the module type is <b>Footer</b></li>
															</ul>
														</p>
													</div>
													<div class="formLayoutTableRowRightCol">
														
													</div>
												</div>
												
												<div class="formLayoutTableRow">
													<div class="formLayoutTableRowLeftCol">
														<h1>Content</h1>                                                    
														<label for="editmodule_contents">Code</label> (CODE ONLY) (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
														<textarea name="editmodule_contents" rows="15"><?php echo htmlspecialchars($contents);?></textarea><br />                                                                                                
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
														<input type="submit" name="editmodule_publish" value="Save" class="submit" />
													</div>
													<div class="formLayoutTableRowRightCol">
														
													</div>
												</div>
												
												<div class="formLayoutTableRowMainAll">
													<div class="formLayoutTableRowMainAllLeftCol">
														Visibility:
													</div>
													<div class="formLayoutTableRowMainAllRightCol">
														<select name="editmodule_toggle_visible">
															<?php if($toggle_visible=="on"){?><option value="on" selected="selected">On</option><?php } else {?><option value="on">On</option><?php }?>
															<?php if($toggle_visible=="off"){?><option value="off" selected="selected">Off</option><?php } else {?><option value="off">Off</option><?php }?>
														</select>
													</div>
												</div>
												
												<div class="formLayoutTableRowMainAll">
													<div class="formLayoutTableRowMainAllLeftCol">
														Title?
													</div>
													<div class="formLayoutTableRowMainAllRightCol">
														<select name="editmodule_toggle_title">
															<?php if($toggle_title=="on"){?><option value="on" selected="selected">Yes</option><?php } else {?><option value="on">Yes</option><?php }?>
															<?php if($toggle_title=="off"){?><option value="off" selected="selected">No</option><?php } else {?><option value="off">No</option><?php }?>
														</select>
													</div>
												</div>
												
												<div class="formLayoutTableRowMainAll">
													<div class="formLayoutTableRowMainAllLeftCol">
														Type:
													</div>
													<div class="formLayoutTableRowMainAllRightCol">
														 <select name="editmodule_type">
															<?php if($type=="maincontent"){?><option value="maincontent" selected="selected">Main Content</option><?php } else {?><option value="maincontent">Main Content</option><?php }?>
															<?php if($type=="sidebar"){?><option value="sidebar" selected="selected">Sidebar</option><?php } else {?><option value="sidebar">Sidebar</option><?php }?>
															<?php if($type=="footer"){?><option value="footer" selected="selected">Footer</option><?php } else {?><option value="footer">Footer</option><?php }?>
														 </select>
													</div>
												</div>
												
												<div class="formLayoutTableRowMainAll">
													<div class="formLayoutTableRowMainAllLeftCol">
														Launchpad:
													</div>
													<div class="formLayoutTableRowMainAllRightCol">
														<select name="editmodule_launchpad">                                                                                                                                                            
														<?php if($launchpad=="padmain"){?><option value="padmain" selected="selected"><?php echo $properties->PADMAIN;?></option><?php } else {?><option value="padmain"><?php echo $properties->PADMAIN;?></option><?php }?>
														<?php if($launchpad=="pad1"){?><option value="pad1" selected="selected"><?php echo $properties->PAD1;?></option><?php } else {?><option value="pad1"><?php echo $properties->PAD1;?></option><?php }?>
														<?php if($launchpad=="pad2"){?><option value="pad2" selected="selected"><?php echo $properties->PAD2;?></option><?php } else {?><option value="pad2"><?php echo $properties->PAD2;?></option><?php }?>
														<?php if($launchpad=="pad3"){?><option value="pad3" selected="selected"><?php echo $properties->PAD3;?></option><?php } else {?><option value="pad3"><?php echo $properties->PAD3;?></option><?php }?>
														<?php if($launchpad=="pad4"){?><option value="pad4" selected="selected"><?php echo $properties->PAD4;?></option><?php } else {?><option value="pad4"><?php echo $properties->PAD4;?></option><?php }?>
														
														</select>
													</div>
												</div>
											</div>
											
											<div class="formLayoutTableMainAll">																					
												<div class="formLayoutTableRowMainAll">
													<div class="formLayoutTableRowMainAllLeftCol"> 
														Searchable?
													</div>
													<div class="formLayoutTableRowMainAllRightCol">
														 <?php if($page_is_searchable == "yes"){?><input type="radio" name="editmodule_is_searchable" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="editmodule_is_searchable" value="no" class="radio" /> No<?php } else {?><input type="radio" name="editmodule_is_searchable" value="yes" class="radio" /> Yes <input type="radio" name="editmodule_is_searchable" value="no" checked="checked" class="radio" /> No<?php }?>
													</div>
												</div>
											</div>			
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Footer Section:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<select name="editmodule_footer_section">      
													<?php if($footer_section==""){?><option value="" selected="selected">None</option><?php } else {?><option value="">None</option><?php }?>
													<?php if($footer_section=="left"){?><option value="left" selected="selected">Left</option><?php } else {?><option value="left">Left</option><?php }?>
													<?php if($footer_section=="mid"){?><option value="mid" selected="selected">Middle</option><?php } else {?><option value="mid">Middle</option><?php }?>
													<?php if($footer_section=="right"){?><option value="right" selected="selected">Right</option><?php } else {?><option value="right">Right</option><?php }?>                                                
													</select>
												</div>
											</div>		
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Sidebar #:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<input type="text" name="editmodule_sidebar" value="<?php echo $sidebar;?>" style="width:60px;text-align:center;" />
												</div>
											</div>                                        	
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Arrange #:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<input type="text" name="editmodule_arr" value="<?php echo $arr;?>" style="width:60px;text-align:center;" />
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
		if($type == "admin"){
			if(isset($_POST['undo_delete'])){
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$moduleid."'");
			echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=pages&page=page-modules\" style=\"cursor:pointer;\">Refresh</a>";
			} else {
			if(isset($_POST['ays_answer'])){
			/* STEP 1: GET DATA */
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			
			/* STEP 2: CHECK FOR ANSWER (blank) */
			if($_POST['ays_answer']==""){
			echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");
			if(mysql_num_rows($GET_POST)<1){
			echo "No Page Modules, with the ID: <b>".$moduleid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}
			if($_POST['ays_answer']=="yes"){
			/* STEP 4: "DELETE" (really set the status to Deleted) */
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$moduleid."'");
			?>
			<form method="post">
			<br />Okay I have deleted <?php echo $title;?> (<input type="submit" name="undo_delete" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=pages&page=page-modules" style="cursor:pointer;">Refresh</a>
			</form>
			<?php
			} else if($_POST['ays_answer']=="no"){
			echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> alone. <a href=\"".$WEBSITE_URL."?menu=pages&page=page-modules\" style=\"cursor:pointer;\">Refresh</a>";
			}
			}										
			}
			} else {
			/* STEP 1: GET DATA */
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			
			/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");			
			if(mysql_num_rows($GET_POST)<1){
			echo "No Page Modules, with the ID: <b>".$moduleid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: CONFIRM DELETE */
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}				
			?>
			<form method="post">
			<br />Are you sure you want to delete <b><?php echo $title;?></b>? 
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
			if(isset($_POST['forsure_ays_answer'])){
			/* STEP 1: GET DATA */
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			
			/* STEP 2: DELETE THE ENTRY */
			mysql_query("DELETE FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");
			?>
			<br />Okay I have permanently deleted <b><?php echo ucfirst($pop);?></b> from the Trash (cannot undo). <a href="<?php echo $WEBSITE_URL;?>?menu=pages&page=page-modules" style="cursor:pointer;">Refresh</a>
			<?php
			} else {
			if(isset($_POST['ays_answer'])){
			/* STEP 1: GET DATA */
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			
			/* STEP 2: CHECK FOR ANSWER (blank) */
			if($_POST['ays_answer']==""){
			echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");
			if(mysql_num_rows($GET_POST)<1){
			echo "No Entries, with the ID: <b>".$moduleid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			if($_POST['ays_answer']=="no"){
			?>
			"<br />Okay I have left <b><?php echo ucfirst($pop);?></b> in the Trash. <a href="<?php echo $WEBSITE_URL;?>?menu=pages&page=page-modules" style="cursor:pointer;">Refresh</a>
			<?php
			} else {
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}									
			?>
			<form method="post">
			<br />Are you really sure you want to permanently delete <b><?php echo ucfirst($pop);?></b> which is currently in the trash? (you will lose all data on this module; just making sure you understand)
			<input type="radio" name="forsure_ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="forsure_ays_answer" value="no" onclick="this.form.submit();" /> No
			</form>
			<?php	
			}
			}										
			}
			} else {
			/* STEP 1: GET DATA */
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			
			/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");			
			if(mysql_num_rows($GET_POST)<1){
			echo "No Page Modules, with the ID: <b>".$moduleid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: CONFIRM DELETE */
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}				
			?>
			<form method="post">
			<br />Are you sure you want to permanently delete <b><?php echo ucfirst($pop);?></b> which is currently in the trash</b>? (this action cannot be undone)
			<input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
			</form>
			<?php
			}	
			}	
			}
			break;
			case 'recover':
			if(isset($_POST['undo_recover'])){
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$moduleid."'") or die(mysql_error());
			echo "<br />I just deleted it again, you sure are having a hard time making up your mind. :) <a href=\"".$WEBSITE_URL."?menu=pages&page=page-modules\" style=\"cursor:pointer;\">Refresh</a>";
			} else {
			if(isset($_POST['ays_answer'])){
			/* STEP 1: GET DATA */
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			
			/* STEP 2: CHECK FOR ANSWER (blank) */
			if($_POST['ays_answer']==""){
			echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");
			if(mysql_num_rows($GET_POST)<1){
			echo "No Page Modules, with the ID: <b>".$moduleid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}
			if($_POST['ays_answer']=="yes"){
			/* STEP 4: "DELETE" (really set the status to Deleted) */
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$moduleid."'");
			?>
			<form method="post">
			<br />Okay I have recovered <b><?php echo ucfirst($pop);?></b> from the Trash and placed it back where it belongs. (<input type="submit" name="undo_recover" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=pages&page=page-modules" style="cursor:pointer;">Refresh</a>
			</form>
			<?php
			} else if($_POST['ays_answer']=="no"){
			echo "<br />Alright sounds fair to me, I will leave <b>".ucfirst($pop)."</b> in the Trash. <a href=\"".$WEBSITE_URL."?menu=pages&page=page-modules\" style=\"cursor:pointer;\">Refresh</a>";
			}
			}										
			}
			} else {
			/* STEP 1: GET DATA */
			$moduleid=$_GET['moduleid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$moduleid=$_GET['moduleid'];
			
			/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$moduleid."'");			
			if(mysql_num_rows($GET_POST)<1){
			echo "No Entries, with the ID: <b>".$moduleid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: CONFIRM DELETE */
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}				
			?>
			<form method="post">
			<br />Are you sure you want to recover <b><?php echo ucfirst($pop);?></b> from the Trash? It will be returned to where it belongs. <input type="radio" name="ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="ays_answer" value="no" onclick="this.form.submit();" /> No
			</form>
			<?php
			}	
			}	
			}
			break;
		
		default:
			echo "Um...that was wrong. <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";
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
			<div id="<?php echo $item;?>_container" style="display:inline;">
			<?php
			//check for ordering
			if(isset($_GET['order']) && $_GET['order']!=""){
				/* ORDER IS SET */
				if($ITEMS_LIST_SPECIAL_LIST[$i]==1){$order=$ITEMS_LIST_SPECIAl_ITEM_LIST[$i];}else{$order=$_GET['order'];}
				if($_GET['order']=="date"){$order=$DEFAULT_ORDER;}
				if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="ASC";}
				$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item." ORDER BY ".$order." ".$direction."") or die('here @ order set '.mysql_error());
			} else {
				/* NO ORDER SET */
				if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="DESC";}
				$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item." ORDER BY ".$DEFAULT_ORDER." ".$direction."") or die('here @ no order set '.mysql_error());
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
						<div class="formLayoutFullCol InBetween valignMiddle">
							No Page Modules were found or even exist in the database. :( <a href="?menu=pages&page=add-new-pm">Start one right now!</a>
						</div>
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
					<div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom">
						<a href="?menu=pages&page=page-modules&order=title">Module Name</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
					<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
						<a href="?menu=pages&page=page-modules&order=launchpad">Pad</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
					<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
						<a href="?menu=pages&page=page-modules&order=type">Type</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
					<div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom BorderRight">
						<a href="?menu=pages&page=page-modules&order=arr">Arrangement</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=page-modules&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
				</div>
				<?php
				while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
					@$module_id=$FETCH_ITEMS['id'];
					@$arr=$FETCH_ITEMS['arr'];
					@$launchpad=$FETCH_ITEMS['launchpad'];
					@$title=$FETCH_ITEMS['title'];
					@$contents=$FETCH_ITEMS['contents'];
					@$page=$FETCH_ITEMS['page'];
					@$type=$FETCH_ITEMS['type'];
					@$footer_section=$FETCH_ITEMS['footer_section'];
					@$toggle_visible=$FETCH_ITEMS['toggle_visible'];
					@$is_seachable=$FETCH_ITEMS['is_searchable'];
					@$status=$FETCH_ITEMS['status'];
					
					/* GET LPM NAME */
					$launchpad_remove=str_replace("pad","",$launchpad);
					$GET_LPM_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}launchpads WHERE padname='".$launchpad_remove."'");
					if(mysql_num_rows($GET_LPM_NAME)<1){/* SOMETHING WENT WRONG */}else{while($FETCH_LPM_NAME=mysql_fetch_array($GET_LPM_NAME)){$LPM_NAME=$FETCH_LPM_NAME['short'];$LPM_NAME_FULL=$FETCH_LPM_NAME['name'];}}
					?>
					<div class="formLayoutFullRow">
						<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom BorderTop">
							<input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $module_id;?>" />
						</div>
						<div class="formLayoutFullCol title alignLeft width-large valignTop BorderBottom BorderTop">
							<h2 style="opacity:.5;line-height:.1em;"><?php if($page!=""){echo "<a href=\"\">".$title."</a>";}else{echo "<a href=\"\">".$title."</a>";}?></h2>
							<em style="font-style:normal; color:gray;"><?php echo "Visiblity: ".$toggle_visible;?></em>
							<br />
                            <em style="font-style: normal; color:gray;"><?php echo $status;?></em>
                            <br />
							<?php if($status=="Deleted"){?><a href="?menu=pages&page=page-modules&action=recover&what=<?php echo $item;;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&moduleid=<?php echo $module_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Recover</a> | <a href="?menu=pages&page=page-modules&action=deleteperm&what=<?php echo $item;;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&moduleid=<?php echo $module_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete Permanently</a><?php }else{?><a href="?menu=pages&page=page-modules&action=edit&what=<?php echo $item;?>&moduleid=<?php echo $module_id;?>&pad=<?php echo $LPM_NAME;?>">Edit</a> | <a href="?menu=pages&page=page-modules&action=delete&what=<?php echo $item;;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&moduleid=<?php echo $module_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete</a><?php }?>
						</div>
						<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop">
							<?php echo $LPM_NAME_FULL;?>
						</div>
						<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop">
							<?php echo $type;?>
						</div>						
						<div class="formLayoutFullCol alignLeft width-medium valignMiddle BorderRight BorderBottom BorderTop">
							<?php echo $arr;?>
						</div>
					</div>
					
					<br />
					<?php
				}
			}
			?>
            </div> <!-- end _container -->
            <?php
		}
		/* END BEGIN GETTING THE ENTERIES OR WHAT EVER YOU GUYS DO :P */
		?>
	</div>
	<br /><br />
	<?php
}

?>