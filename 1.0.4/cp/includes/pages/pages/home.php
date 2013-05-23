<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
$FULL_PAD=",";
$ITEMS_PAGE=",";
$ITEMS_LIST="pages,";
$ITEMS_DEFAULT_LIST="no,"; // this is where you tell us what item is default to display
$SUBITEMS_LIST=","; //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES="General Pages,";
$ITEMS_LIST_SPECIAL="0,"; //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM="none,"; //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER="created"; //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
	
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
<h1>Pages <a href="?menu=pages&page=add-new" class="small">Add New</a></h1>
Filter by
<select id="_chooser" onchange="_chooser();">
	<option value="all">All Pages</option>
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
			if($type == "admin" || $type == "writer"){
				if(isset($_POST['editpage_publish'])){
				/* STEP 1: GET DATA */
				$page=$_GET['pageid'];
				$pagename=$_GET['pagename'];
				$what=$_GET['what'];
				
				$editpage_lock=mysql_real_escape_string($_POST['editpage_who']);
				$editpage_layout=mysql_real_escape_string($_POST['editpage_layout']);
				$editpage_page=mysql_real_escape_string($_POST['editpage_safename']);
				$editpage_name=mysql_real_escape_string($_POST['editpage_name']);
				$editpage_keywords=mysql_real_escape_string($_POST['editpage_keywords']);
				$editpage_lp=mysql_real_escape_string($_POST['editpage_lp']);				
				if($editpage_lp=="all"){$editpage_lpm="0";}
				if($editpage_lp=="padmain"){$editpage_lpm="1";}
				if($editpage_lp=="pad1"){$editpage_lpm="2";}
				if($editpage_lp=="pad2"){$editpage_lpm="3";}
				if($editpage_lp=="pad3"){$editpage_lpm="4";}
				if($editpage_lp=="pad4"){$editpage_lpm="5";}
				//$editpage_subpage=mysql_real_escape_string($_POST['subpage']); not used
				$editpage_created=mysql_real_escape_string($_POST['editpage_date']);	
				$editpage_is_searchable=mysql_real_escape_string($_POST['editpage_is_searchable']);
				$editpage_toggle_feat=mysql_real_escape_string($_POST['editpage_toggle_feat']);
				$editpage_status=mysql_real_escape_string($_POST['editpage_status']);
				//$editpage_toggle_minifeat=mysql_real_escape_string($_POST['toggle_minifeat']); not used
				
				$editpage_content_main=mysql_real_escape_string($_POST['editpage_content_main']);
				$editpage_content_main_code=mysql_real_escape_string($_POST['editpage_content_main_code']);
				$editpage_content_main_after_code=mysql_real_escape_string($_POST['editpage_content_main_after_code']);
				
				$editpage_content_sidebar=mysql_real_escape_string($_POST['editpage_content_sidebar']);
				$editpage_content_sidebar_code=mysql_real_escape_string($_POST['editpage_content_sidebar_code']);		
				$editpage_content_sidebar_after_code=mysql_real_escape_string($_POST['editpage_content_sidebar_after_code']);
				
				$editpage_content_sidebar2=mysql_real_escape_string($_POST['editpage_content_sidebar2']);
				$editpage_content_sidebar2_code=mysql_real_escape_string($_POST['editpage_content_sidebar2_code']);				
				$editpage_content_sidebar2_after_code=mysql_real_escape_string($_POST['editpage_content_sidebar2_after_code']);
				
				if($error_console!=""){
					echo $error_console;
				} else {
					/* STEP 3: UPLOAD/SAVE */
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET page_lock='".$editpage_lock."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET layout='".$editpage_layout."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET page='".$editpage_page."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET pageNAME='".$editpage_name."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET pageKEYWORDS='".$editpage_keywords."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET lp='".$editpage_lp."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET lpm='".$editpage_lpm."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET created='".$editpage_created."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET is_searchable='".$editpage_is_searchable."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET toggle_feat='".$editpage_toggle_feat."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='".$editpage_status."' WHERE id='".$page."'");
					
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_main='".$editpage_content_main."' WHERE id='".$page."'");										
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_main_code='".$editpage_content_main_code."' WHERE id='".$page."'");										
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_main_after_code='".$editpage_content_main_after_code."' WHERE id='".$page."'");										
					
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_sidebar='".$editpage_content_sidebar."' WHERE id='".$page."'");										
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_sidebar_code='".$editpage_content_sidebar_code."' WHERE id='".$page."'");										
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_sidebar_after_code='".$editpage_content_sidebar_after_code."' WHERE id='".$page."'");										
					
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_sidebar2='".$editpage_content_sidebar2."' WHERE id='".$page."'");										
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_sidebar2_code='".$editpage_content_sidebar2_code."' WHERE id='".$page."'");										
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content_sidebar2_after_code='".$editpage_content_sidebar2_after_code."' WHERE id='".$page."'");										
					
					/* STEP 4: POST RETURN OF RECEIPT */
					echo "<br /><b>".$editpage_name."</b> has been successfully updated! <a href=\"".$WEBSITE_URL."?menu=pages\">Refresh</a>";
				}
				
			} else {
				$pageid=$_GET['pageid'];
				$what=$_GET['what'];
				$pad=$_GET['pad'];
				
				$GET_ENTRY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");
				if(mysql_num_rows($GET_ENTRY_INFO)<1){
					echo "<br />Cannot find a page with the info you provided (truth is you probably changed the URL). <a onclick=\"history.go(-1)\" style=\"cursor:pointer;\">Go Back</a>";	
				} else {
					while($FETCH_ITEMS=mysql_fetch_array($GET_ENTRY_INFO)){
						@$page_lock=$FETCH_ITEMS['page_lock'];
						@$page_layout=$FETCH_ITEMS['layout'];
						@$page_page=$FETCH_ITEMS['page'];
						@$page_name=$FETCH_ITEMS['pageNAME'];
						@$page_keywords=$FETCH_ITEMS['pageKEYWORDS'];
						@$page_lp=$FETCH_ITEMS['lp'];
						@$page_lpm=$FETCH_ITEMS['lpm'];
						@$page_subpage=$FETCH_ITEMS['subpage'];
						@$page_created=$FETCH_ITEMS['created'];	
						@$page_is_searchable=$FETCH_ITEMS['is_searchable'];
						@$page_toggle_feat=$FETCH_ITEMS['toggle_feat'];
						@$page_toggle_minifeat=$FETCH_ITEMS['toggle_minifeat'];
						@$page_status=$FETCH_ITEMS['status'];
						
						@$page_content_main=$FETCH_ITEMS['content_main'];
						@$page_content_main_code=$FETCH_ITEMS['content_main_code'];
						@$page_content_main_after_code=$FETCH_ITEMS['content_main_after_code'];
						
						@$page_content_sidebar=$FETCH_ITEMS['content_sidebar'];
						@$page_content_sidebar_code=$FETCH_ITEMS['content_sidebar_code'];
						@$page_content_sidebar_after_code=$FETCH_ITEMS['content_sidebar_after_code'];
						
						@$page_content_sidebar2=$FETCH_ITEMS['content_sidebar2'];
						@$page_content_sidebar2_code=$FETCH_ITEMS['content_sidebar2_code'];
						@$page_content_sidebar2_after_code=$FETCH_ITEMS['content_sidebar2_after_code'];
						
						echo "<h3>Editing the page of &quot;".$page_name."&quot; apart of the pad of: <b>".ucfirst($pad)."</b></h3>";
						//0000-00-00
						//0123456789
						$page_dateyear=substr($page_created,0,4);
						$page_datemonth=substr($page_created,5,2);
						$page_dateday=substr($page_created,8,2);
						?>
						<form action="" method="post">
							<div class="cp-table">
								<div class="cp-row">
									<div class="cp-lcol">
										<div class="formLayoutTable">
											<div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
                                                	<label>Page Title</label>
													<input type="text" name="editpage_name" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $page_name;?>" class="full-input" />
												</div>
												<div class="formLayoutTableRowRightCol">
													
												</div>
											</div>
                                            
                                            <div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
                                                	<label>URL Safe Title</label>
													<input type="text" name="editpage_safename" onfocus="if(this.value=='Enter URL-Safe Title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter URL-Safe Title here';}" value="<?php echo $page_page;?>" class="full-input" />
												</div>
												<div class="formLayoutTableRowRightCol">
													
												</div>
											</div>																						
											
											<div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
                                                	<h1>Main Content</h1>
                                                	<label>Before Main Code</label> (Standard HTML Only)<br />
													<textarea name="editpage_content_main" rows="15"><?php echo htmlspecialchars($page_content_main);?></textarea><br />
                                                    
                                                    <label for="editpage_content_main_code">Main Code</label> (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
													<textarea name="editpage_content_main_code" rows="15"><?php echo htmlspecialchars($page_content_main_code);?></textarea><br />
                                                    
                                                    <label for="editpage_content_main_after_code">After Main Code</label> (Standard HTML Only)<br />
													<textarea name="editpage_content_main_after_code" rows="15"><?php echo htmlspecialchars($page_content_main_after_code);?></textarea><br />
                                                    <h1>Sidebar 1</h1>
                                                    
                                                    <label for="editpage_content_sidebar">Before Sidebar Code</label> (Standard HTML Only)<br />
													<textarea name="editpage_content_sidebar" rows="15"><?php echo htmlspecialchars($page_content_sidebar);?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar_code">Sidebar Code</label> (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
													<textarea name="editpage_content_sidebar_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar_code);?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar_after_code">After Sidebar Code</label> (Standard HTML Only)<br />
													<textarea name="editpage_content_sidebar_after_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar_after_code);?></textarea><br />
                                                    
                                                    <h1>Sidebar 2</h1>
                                                    
                                                    <label for="editpage_content_sidebar2">Before Sidebar 2 Code</label> (Standard HTML Only)<br />
													<textarea name="editpage_content_sidebar2" rows="15"><?php echo htmlspecialchars($page_content_sidebar2);?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar2_code">Sidebar 2 Code</label> (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
													<textarea name="editpage_content_sidebar2_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar2_code);?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar2_after_code">After Sidebar 2 Code</label> (Standard HTML Only)<br />
													<textarea name="editpage_content_sidebar2_after_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar2_after_code);?></textarea><br />
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
													<input type="submit" name="editpage_publish" value="Save" class="submit" />
												</div>
												<div class="formLayoutTableRowRightCol">
													
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
                                            	<div class="formLayoutTableRowMainAllLeftCol"> Status: </div>
                                                <div class="formLayoutTableRowMainAllRightCol">
                                                <select name="editpage_status">
                                                <?php if($page_status=="Drafted"){?>
                                                <option value="Drafted" selected="selected">Draft</option>
                                                <?php } else {?>
                                                <option value="Drafted">Draft</option>
                                                <?php }?>
                                                
                                                <?php if($page_status=="Published"){?>
                                                <option value="Published" selected="selected">Final</option>
                                                <?php } else {?>
                                                <option value="Published">Final</option>
                                                <?php }?>
                                                
                                                <?php if($page_status=="On Hold"){?>
                                                <option value="On Hold" selected="selected">Hold</option>
                                                <?php } else {?>
                                                <option value="On Hold">Hold</option>
                                                <?php }?>
                                                
                                                <?php if($page_status=="Deleted"){?>
                                                <option value="Deleted" selected="selected" disabled="disabled">Deleted</option>
                                                <?php } else {?>
                                                <option value="Deleted" disabled="disabled">Deleted</option>
                                                <?php }?>
                                                
                                                <?php if($page_status=="Recovered"){?>
                                                <option value="Recovered" selected="selected" disabled="disabled">Recovered</option>
                                                <?php } else {?>
                                                <option value="Recovered" disabled="disabled">Recovered</option>
                                                <?php }?>
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													For Who?
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<select name="editpage_who">
														<?php if($page_lock=="restrict all"){?><option value="restrict all" selected="selected">No one</option><?php } else {?><option value="restrict all">No one</option><?php }?>
														<?php if($page_lock=="restrict non head admins"){?><option value="restrict non head admins" selected="selected">Only Head Admins</option><?php } else {?><option value="restrict non head admins">Only Head Admins</option><?php }?>
														<?php if($page_lock=="restrict non admins"){?><option value="restrict non admins" selected="selected">Admins &amp; HAdmins</option><?php } else {?><option value="restrict non admins">Admins &amp; HAdmins</option><?php }?>
														<?php if($page_lock=="restrict non amb"){?><option value="restrict non amb" selected="selected">HAdmins/Admins/BETAs</option><?php } else {?><option value="restrict non amb">HAdmins/Admins/BETAs</option><?php }?>
														<?php if($page_lock=="off"){?><option value="off" selected="selected">Everyone</option><?php } else {?><option value="off">Everyone</option><?php }?>
													</select>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Layout:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													 <select name="editpage_layout">
                                                     	<?php if($page_layout=="single"){?><option value="single" selected="selected">Single</option><?php } else {?><option value="single">Single</option><?php }?>
                                                        <?php if($page_layout=="double"){?><option value="double" selected="selected">Double</option><?php } else {?><option value="double">Double</option><?php }?>
                                                        <?php if($page_layout=="triple"){?><option value="triple" selected="selected">Triple</option><?php } else {?><option value="triple">Triple</option><?php }?>
                                                     </select>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Launchpad:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<select name="editpage_lp">                                                    
                                                    <?php if($page_lp=="all"){?><option value="all" selected="selected">All</option><?php } else {?><option value="all">All</option><?php }?>
                                                    <?php if($page_lp=="padmain"){?><option value="padmain" selected="selected">Pad Main</option><?php } else {?><option value="padmain">Pad Main</option><?php }?>
                                                    <?php if($page_lp=="pad1"){?><option value="pad1" selected="selected">Pad 1</option><?php } else {?><option value="pad1">Pad 1</option><?php }?>
                                                    <?php if($page_lp=="pad2"){?><option value="pad2" selected="selected">Pad 2</option><?php } else {?><option value="pad2">Pad 2</option><?php }?>
                                                    <?php if($page_lp=="pad3"){?><option value="pad3" selected="selected">Pad 3</option><?php } else {?><option value="pad3">Pad 3</option><?php }?>
                                                    <?php if($page_lp=="pad4"){?><option value="pad4" selected="selected">Pad 4</option><?php } else {?><option value="pad4">Pad 4</option><?php }?>
                                                    
                                                    </select>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													<script type="text/javascript">
														$(function() {
															$('#editpage_date').datepick({dateFormat: 'yyyy-mm-dd'});
															//$('#inlineDatepicker').datepick({onSelect: showDate});
														});
													</script>
													Date:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<input type="date" name="editpage_date" min="<?php echo $page_dateyear."-".$page_datemonth."-".$page_dateday;?>" id="editpage_date" value="<?php echo $page_dateyear."-".$page_datemonth."-".$page_dateday;?>" style="width:120px;" />
												</div>
											</div>											
										</div>
										
										<div class="formLayoutTableMainAll">
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													FSlider? (<a title="This will place a featured slider on the page for that page." style="cursor:pointer;">?</a>)
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<?php if($page_toggle_feat == "on"){?><input type="radio" name="editpage_toggle_feat" value="on" class="radio" checked="checked" /> Yes <input type="radio" name="editpage_toggle_feat" value="off" class="radio" /> No<?php } else {?><input type="radio" name="editpage_toggle_feat" value="on" class="radio" /> Yes <input type="radio" name="editpage_toggle_feat" value="off" checked="checked" class="radio" /> No<?php }?>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol"> 
													Searchable?
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													 <?php if($page_is_searchable == "yes"){?><input type="radio" name="editpage_is_searchable" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="editpage_is_searchable" value="no" class="radio" /> No<?php } else {?><input type="radio" name="editpage_is_searchable" value="yes" class="radio" /> Yes <input type="radio" name="editpage_is_searchable" value="no" checked="checked" class="radio" /> No<?php }?>
												</div>
											</div>
                                            
                                            <div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
													Keywords
												</div>
												<div class="formLayoutTableRowRightCol">
													<input type="text" name="editpage_keywords" value="<?php echo $page_keywords;?>" style="width:200px;" />
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
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$pageid."'");
			echo "<br />I just un-did your last request. :) <a href=\"".$WEBSITE_URL."?menu=pages\" style=\"cursor:pointer;\">Refresh</a>";
			} else {
			if(isset($_POST['ays_answer'])){
			/* STEP 1: GET DATA */
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			
			/* STEP 2: CHECK FOR ANSWER (blank) */
			if($_POST['ays_answer']==""){
			echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");
			if(mysql_num_rows($GET_POST)<1){
			echo "No Pages, with the ID: <b>".$pageid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}
			if($_POST['ays_answer']=="yes"){
			/* STEP 4: "DELETE" (really set the status to Deleted) */
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$pageid."'");
			?>
			<form method="post">
			<br />Okay I have deleted <?php echo ucfirst($pop);?> (<input type="submit" name="undo_delete" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=pages" style="cursor:pointer;">Refresh</a>
			</form>
			<?php
			} else if($_POST['ays_answer']=="no"){
			echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> from <b>".ucfirst($pop)."</b> alone. <a href=\"".$WEBSITE_URL."?menu=pages\" style=\"cursor:pointer;\">Refresh</a>";
			}
			}										
			}
			} else {
			/* STEP 1: GET DATA */
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			
			/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");			
			if(mysql_num_rows($GET_POST)<1){
			echo "No Pages, with the ID: <b>".$pageid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
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
		} else {
			?>
			<center><h1>You do not have the permission to use this feature. :(</h1></center>
			<?php	
		}
		
		break;
			
		case 'deleteperm':
			if(isset($_POST['forsure_ays_answer'])){
			/* STEP 1: GET DATA */
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			
			/* STEP 2: DELETE THE ENTRY */
			mysql_query("DELETE FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");
			?>
			<br />Okay I have permanently deleted <b><?php echo $title;?></b> from the Trash which was apart of <b><?php echo ucfirst($pop);?></b> (cannot undo) <a href="<?php echo $WEBSITE_URL;?>?menu=pages" style="cursor:pointer;">Refresh</a>
			<?php
			} else {
			if(isset($_POST['ays_answer'])){
			/* STEP 1: GET DATA */
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			
			/* STEP 2: CHECK FOR ANSWER (blank) */
			if($_POST['ays_answer']==""){
			echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");
			if(mysql_num_rows($GET_POST)<1){
			echo "No Entries, with the ID: <b>".$pageid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			if($_POST['ays_answer']=="no"){
			?>
			"<br />Okay I have left <b><?php echo $title;?></b> in the Trash which was apart of <b><?php echo ucfirst($pop);?></b>. <a href="<?php echo $WEBSITE_URL;?>?menu=pages" style="cursor:pointer;">Refresh</a>
			<?php
			} else {
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}									
			?>
			<form method="post">
			<br />Are you really sure you want to permanently delete <b><?php echo $title;?></b> from the <b><?php echo ucfirst($pop);?></b> which is currently in the trash? (you will lose all data on this page; just making sure you understand)
			<input type="radio" name="forsure_ays_answer" value="yes" onclick="this.form.submit();" /> Yes <input type="radio" name="forsure_ays_answer" value="no" onclick="this.form.submit();" /> No
			</form>
			<?php	
			}
			}										
			}
			} else {
			/* STEP 1: GET DATA */
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			
			/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");			
			if(mysql_num_rows($GET_POST)<1){
			echo "No Entries, with the ID: <b>".$pageid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
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
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Deleted' WHERE id='".$pageid."'") or die(mysql_error());
			echo "<br />I just deleted it again, you sure are having a hard time making up your mind. :) <a href=\"".$WEBSITE_URL."?menu=pages\" style=\"cursor:pointer;\">Refresh</a>";
			} else {
			if(isset($_POST['ays_answer'])){
			/* STEP 1: GET DATA */
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			
			/* STEP 2: CHECK FOR ANSWER (blank) */
			if($_POST['ays_answer']==""){
			echo "How did you get here without choosing an answer? You must be hacking. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			/* STEP 3: DO ACCORDING TO WHAT THEY ANSWERED */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");
			if(mysql_num_rows($GET_POST)<1){
			echo "No Entries, with the ID: <b>".$pageid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
			} else {
			while($FETCH_POST=mysql_fetch_array($GET_POST)){
			$title=$FETCH_POST['title'];
			}
			if($_POST['ays_answer']=="yes"){
			/* STEP 4: "DELETE" (really set the status to Deleted) */
			mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='Recovered' WHERE id='".$pageid."'");
			?>
			<form method="post">
			<br />Okay I have recovered <b><?php echo ucfirst($pop);?></b> from the Trash and placed it back where it belongs. (<input type="submit" name="undo_recover" value="undo" />) <a href="<?php echo $WEBSITE_URL;?>?menu=pages" style="cursor:pointer;">Refresh</a>
			</form>
			<?php
			} else if($_POST['ays_answer']=="no"){
			echo "<br />Alright sounds fair to me, I will leave <b>".$title."</b> in the Trash. <a href=\"".$WEBSITE_URL."?menu=pages\" style=\"cursor:pointer;\">Refresh</a>";
			}
			}										
			}
			} else {
			/* STEP 1: GET DATA */
			$pageid=$_GET['pageid'];
			$what=$_GET['what'];
			$pad=$_GET['pad'];
			$pop=$_GET['pop'];
			$base=$_GET['base'];
			$subbase=$_GET['subbase'];
			$pageid=$_GET['pageid'];
			
			/* STEP 2: CHECK FOR POSTID IN DB TO AVOID SQL INJECTION */
			$GET_POST=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what." WHERE id='".$pageid."'");			
			if(mysql_num_rows($GET_POST)<1){
			echo "No Entries, with the ID: <b>".$pageid."</b>, were found in the database. We suspect you might be hacking via injection. Please do not do that. :) <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>";
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
							No Pages were found or even exist in the database. :( <a href="?menu=pages&page=add-new">Start one right now!</a>
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
						<a href="?menu=pages&page=home&order=page">Page Name</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
					<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
						<a href="?menu=pages&page=home&order=lp">Pad</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
					<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
						<a href="?menu=pages&page=home&order=layout">Layout</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
					<div class="formLayoutFullCol alignCenter width-medium valignMiddle fontBig BorderTop BorderBottom">
						Stats
					</div>
					<div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom BorderRight">
						<a href="?menu=pages&page=home&order=date">Date Created</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=home&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
				</div>
				<?php
				while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
					@$page_id=$FETCH_ITEMS['id'];
					@$page_lock=$FETCH_ITEMS['page_lock'];
					@$page=$FETCH_ITEMS['page'];
					@$layout=$FETCH_ITEMS['layout'];
					@$pageNAME=$FETCH_ITEMS['pageNAME'];
					@$pageKEYWORDS=$FETCH_ITEMS['pageKEYWORDS'];
					@$lp=$FETCH_ITEMS['lp'];
					@$lpm=$FETCH_ITEMS['lpm'];
					@$subpage=$FETCH_ITEMS['subpage'];
					@$created=$FETCH_ITEMS['created'];
					@$content_main=$FETCH_ITEMS['content_main'];
					@$content_main_code=$FETCH_ITEMS['content_main_code'];
					@$content_main_after_code=$FETCH_ITEMS['content_main_after_code'];
					@$content_sidebar=$FETCH_ITEMS['content_sidebar'];
					@$content_sidebar_code=$FETCH_ITEMS['content_sidebar_code'];
					@$content_sidebar_after_code=$FETCH_ITEMS['content_sidebar_after_code'];
					@$content_sidebar2=$FETCH_ITEMS['content_sidebar2'];
					@$content_sidebar2_code=$FETCH_ITEMS['content_sidebar2_code'];
					@$content_sidebar2_after_code=$FETCH_ITEMS['content_sidebar2_after_code'];
					@$is_searchable=$FETCH_ITEMS['is_searchable'];
					@$toggle_feat=$FETCH_ITEMS['toggle_feat'];
					@$toggle_minifeat=$FETCH_ITEMS['toggle_minifeat'];
					@$status=$FETCH_ITEMS['status'];
					
					/* GET LPM NAME */
					$GET_LPM_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}launchpads WHERE id='".$lpm."'");
					if(mysql_num_rows($GET_LPM_NAME)<1){/* SOMETHING WENT WRONG */}else{while($FETCH_LPM_NAME=mysql_fetch_array($GET_LPM_NAME)){$LPM_NAME=$FETCH_LPM_NAME['short'];$LPM_NAME_FULL=$FETCH_LPM_NAME['name'];}}
					?>
					<div class="formLayoutFullRow">
						<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom BorderTop">
							<input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $page;?>" />
						</div>
						<div class="formLayoutFullCol title alignLeft width-medium valignTop BorderBottom BorderTop">
							<h2 style="opacity:.5;line-height:.1em;"><?php if($page!=""){echo "<a href=\"\">".$page."</a>";}else{echo "<a href=\"\">".$page."</a>";}?></h2>
							<em style="font-style:normal; color:gray;"><?php echo "Restiction: ".$page_lock;?></em>
                            <br />
                            <em style="font-style:normal; color:gray;"><?php echo $status;?></em>
							<br />				                            			
                            <?php if($status=="Deleted"){?><a href="?menu=pages&page=home&action=recover&what=<?php echo $item;;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&pageid=<?php echo $page_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Recover</a> | <a href="?menu=pages&page=home&action=deleteperm&what=<?php echo $item;;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&pageid=<?php echo $page_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete Permanently</a><?php }else{?><a href="?menu=pages&page=home&action=edit&what=<?php echo $item;?>&pageid=<?php echo $page_id;?>&pad=<?php echo $LPM_NAME;?>">Edit</a> | <a href="?menu=pages&page=home&action=delete&what=<?php echo $item;;?>&pad=<?php echo $pad;?>&pop=<?php echo $page;?>&pageid=<?php echo $page_id;?>&base=<?php echo $item;?>&subbase=<?php if($sub_item==""){$sub_item="null";}echo $sub_item;?>">Delete</a><?php }?>
						</div>
						<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop">
							<?php echo $LPM_NAME_FULL;?>
						</div>
						<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop">
							<?php echo $layout;?>
						</div>
						<div class="formLayoutFullCol alignCenter width-medium valignMiddle BorderBottom BorderTop">
							Stats
						</div>
						<div class="formLayoutFullCol alignLeft width-medium valignMiddle BorderRight BorderBottom BorderTop">
							<?php echo $created;?>
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