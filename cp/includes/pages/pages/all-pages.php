<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
$FULL_PAD=",";
$ITEMS_PAGE=",";
$ITEMS_LIST="pages,";
$ITEMS_DEFAULT_LIST="no,"; // this is where you tell us what item is default to display
$SUBITEMS_LIST=","; //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES="Pages,";
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
			if(isset($_POST['editpage_publish'])){
				/* STEP 1: GET DATA */
				$pagename=$_GET['pagename'];
				$what=$_GET['what'];
				
				$editpage_title=mysql_real_escape_string($_POST['editpage_title']);
				$editpage_content=mysql_real_escape_string($_POST['editpage_content']);
				$editpage_status=mysql_real_escape_string($_POST['editpage_status']);
				$editpage_publish=mysql_real_escape_string($_POST['editpage_publish']);
				$editpage_publicize=mysql_real_escape_string($_POST['editpage_publicize']);
				$editpage_date=mysql_real_escape_string($_POST['editpage_date']);
				$editpage_time=mysql_real_escape_string($_POST['editpage_time']);
				$editpage_dategts=mysql_real_escape_string($_POST['editpage_dategts']);
				$editpage_timegts=mysql_real_escape_string($_POST['editpage_timegts']);
				$editpage_startedit=mysql_real_escape_string($_POST['editpage_started']);
				$editpage_isfeatured=mysql_real_escape_string($_POST['editpage_isfeatured']);
				$editpage_featuredimage=mysql_real_escape_string($_POST['editpage_featuredimage']);
				$editpage_category=mysql_real_escape_string($_POST['editpage_category']);
				$editpage_customcategory=mysql_real_escape_string($_POST['editpage_customcategory']);
				$editpage_tags=mysql_real_escape_string($_POST['editpage_tags']);
				
				/* STEP 2: CHECK DATA FOR ACCURACY */
				if($editpage_category=="custom" && $editpage_customcategory==""){/* DID NOT ENTER CUSTOM CATEGORY NAME */$error_console="<br />Since you selected a custom category, you must name your new category. <a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";}
				
				if($error_console!=""){
					echo $error_console;
				} else {
					/* STEP 3: UPLOAD/SAVE */
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET title='".$editpage_title."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET content='".$editpage_content."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET status='".$editpage_status."' WHERE id='".$page."'") or die(mysql_error());
					if($editpage_startedit=="no"){
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime_goingtostart='".$editpage_date." ".$editpage_time."' WHERE id='".$page."'");	
					} else if($editpage_startedit=="yes") {
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET dateandtime='".$editpage_date." ".$editpage_time."' WHERE id='".$page."'");
					}
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET featured='".$editpage_isfeatured."' WHERE id='".$page."'");
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET featured_image='".$editpage_featuredimage."' WHERE id='".$page."'");
					if($editpage_customcategory != ""){
						/* NEW CATEGORY */
						/* INSERT THE NEW CAT */
						mysql_query("INSERT INTO {$properties->DB_PREFIX}".$base."_categories (name,shortname,parentid,is_searchable) VALUES ('$editpage_customcategory','".converter($properties,$editpage_customcategory,"url","to")."','0','yes')");
						/* GET INSERT ID */
						$new_category_id=mysql_insert_id();
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET category='".$new_category_id."' WHERE id='".$page."'");
					} else {
						mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET category='".$editpage_category."' WHERE id='".$page."'");
					}
					mysql_query("UPDATE {$properties->DB_PREFIX}".$what." SET tags='".$editpage_tags."' WHERE id='".$page."'");
					
					/* STEP 4: POST RETURN OF RECEIPT */
					echo "<br /><b>".$editpage_title."</b> has been successfully updated! <a href=\"".$WEBSITE_URL."?menu=pages\">Refresh</a>";
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
						@$page_name=$FETCH_ITEMS['page'];
						@$page_layout=$FETCH_ITEMS['layout'];
						@$page_pageNAME=$FETCH_ITEMS['pageNAME'];
						@$page_pageKEYWORDS=$FETCH_ITEMS['pageKEYWORDS'];
						@$page_lp=$FETCH_ITEMS['lp'];
						@$page_lpm=$FETCH_ITEMS['lpm'];
						@$page_subpage=$FETCH_ITEMS['subpage'];
						@$page_created=$FETCH_ITEMS['created'];
						@$page_content_main=$FETCH_ITEMS['content_main'];
						@$page_content_main_code=$FETCH_ITEMS['content_main_code'];
						@$page_content_main_after_code=$FETCH_ITEMS['content_main_after_code'];
						@$page_content_sidebar=$FETCH_ITEMS['content_sidebar'];
						@$page_content_sidebar_code=$FETCH_ITEMS['content_sidebar_code'];
						@$page_content_sidebar_after_code=$FETCH_ITEMS['content_sidebar_after_code'];
						@$page_content_sidebar2=$FETCH_ITEMS['content_sidebar2'];
						@$page_content_sidebar2_code=$FETCH_ITEMS['content_sidebar2_code'];
						@$page_content_sidebar2_after_code=$FETCH_ITEMS['content_sidebar2_after_code'];
						@$page_is_searchable=$FETCH_ITEMS['is_searchable'];
						@$page_toggle_feat=$FETCH_ITEMS['toggle_feat'];
						@$page_toggle_minifeat=$FETCH_ITEMS['toggle_minifeat'];
						echo "<h3>Editing the page of &quot;".$page_pageNAME."&quot; apart of the pad of: <b>".ucfirst($pad)."</b></h3>";
						//0000-00-00
						//0123456789
						$page_dateyear=substr($created,0,4);
						$page_datemonth=substr($created,5,2);
						$page_dateday=substr($created,8,2);
						?>
						<form action="" method="post">
							<div class="cp-table">
								<div class="cp-row">
									<div class="cp-lcol">
										<div class="formLayoutTable">
											<div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
													<input type="text" name="editpage_title" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $page_name;?>" class="full-input" />
												</div>
												<div class="formLayoutTableRowRightCol">
													
												</div>
											</div>
											
											<div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
													<?php
													$FORMULA_CONDENSED=substr($WEBSITE_URL_ROOT.$pad,0,20)."...";
													?>
													<?php echo $FORMULA_CONDENSED."/".$page_pagename."/";?> <a href="<?php echo $WEBSITE_URL_ROOT.$pad."/".$page_pagename."/";?>" target="_blank">Preview</a>
												</div>
												<div class="formLayoutTableRowRightCol">
													
												</div>
											</div>
											
											<br />
											
											<div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
                                                	<label for="editpage_content_main">Before Main Code</label><br />
													<textarea name="editpage_content_main" rows="15"><?php echo $page_content_main;?></textarea><br />
                                                    
                                                    <label for="editpage_content_main_code">Main Code</label><br />
													<textarea name="editpage_content_main_code" rows="15"><?php highlight_string($page_content_main_code);?></textarea><br />
                                                    
                                                    <label for="editpage_content_main_after_code">After Main Code</label><br />
													<textarea name="editpage_content_main_after_code" rows="15"><?php echo $page_content_main_after_code;?></textarea><br />
                                                    
                                                    
                                                    <label for="editpage_content_sidebar">Before Sidebar Code</label><br />
													<textarea name="editpage_content_sidebar" rows="15"><?php echo $page_content_sidebar;?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar_code">Sidebar Code</label><br />
													<textarea name="editpage_content_sidebar_code" rows="15"><?php highlight_string($page_content_sidebar_code);?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar_after_code">After Sidebar Code</label><br />
													<textarea name="editpage_content_sidebar_after_code" rows="15"><?php echo $page_content_sidebar_after_code;?></textarea><br />
                                                    
                                                    
                                                    <label for="editpage_content_sidebar2">Before Sidebar 2 Code</label><br />
													<textarea name="editpage_content_sidebar2" rows="15"><?php echo $page_content_sidebar2;?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar2_code">Sidebar 2 Code</label><br />
													<textarea name="editpage_content_sidebar2_code" rows="15"><?php highlight_string($page_content_sidebar2_code);?></textarea><br />
                                                    
                                                    <label for="editpage_content_sidebar2_after_code">After Sidebar 2 Code</label><br />
													<textarea name="editpage_content_sidebar2_after_code" rows="15"><?php echo $page_content_sidebar2_after_code;?></textarea><br />
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
												<div class="formLayoutTableRowMainAllLeftCol">
													Status:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<select name="editpage_status">
														<?php if($page_status=="Drafted"){?><option value="Drafted" selected="selected">Draft</option><?php } else {?><option value="Drafted">Draft</option><?php }?>
														<?php if($page_status=="Published"){?><option value="Published" selected="selected">Final</option><?php } else {?><option value="Published">Final</option><?php }?>
														<?php if($page_status=="On Hold"){?><option value="On Hold" selected="selected">Hold</option><?php } else {?><option value="On Hold">Hold</option><?php }?>
													</select>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Publish:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													 <select name="editpage_publish"><option value="immediately">Immediately</option><option value="in_24_hours">In 24 hours</option></select>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Publicize:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<select name="editpage_publicize"><option value="yes">Yes</option><option value="no">No</option></select> <a href="?menu=settings&page=sharing">Settings</a>
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
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Time:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<input type="time" name="editpage_time" step="1" value="<?php echo $page_datehour.":".$page_datemin.":".$page_datesec;?>" style="width:120px;" />
												</div>
											</div>
                                            
                                            <div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													<script type="text/javascript">
														$(function() {
															$('#editpage_dategts').datepick({dateFormat: 'yyyy-mm-dd'});
															//$('#inlineDatepicker').datepick({onSelect: showDate});
														});
													</script>
													GTS (<a title="I means Going to Start" style="cursor:pointer;">?</a>) Date:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<input type="date" name="editpage_dategts" min="<?php echo $page_dateyeargts."-".$page_datemonthgts."-".$page_datedaygts;?>" id="editpage_dategts" value="<?php echo $page_dateyeargts."-".$page_datemonthgts."-".$page_datedaygts;?>" style="width:120px;" />
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													GTS (<a title="It means Going to Start" style="cursor:pointer;">?</a>) Time:
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<input type="time" name="editpage_timegts" step="1" value="<?php echo $page_datehourgts.":".$page_datemingts.":".$page_datesecgts;?>" style="width:120px;" />
												</div>
											</div>
										</div>
										
										<div class="formLayoutTableMainAll">
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													Started it? (<a title="If checked no, then will place a &quot;going to start&quot; date in the database." style="cursor:pointer;">?</a>)
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<?php if($page_dateandtime_goingtostart == "0000-00-00 00:00:00"){?><input type="radio" name="editpage_startedit" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="editpage_startedit" value="no" class="radio" /> No<?php } else {?><input type="radio" name="editpage_startedit" value="yes" class="radio" /> Yes <input type="radio" name="editpage_startedit" value="no" checked="checked" class="radio" /> No<?php }?>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol"> 
													Feature this?
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													 <?php if($page_featured == "yes"){?><input type="radio" name="editpage_isfeatured" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="editpage_isfeatured" value="no" class="radio" /> No<?php } else {?><input type="radio" name="editpage_isfeatured" value="yes" class="radio" /> Yes <input type="radio" name="editpage_isfeatured" value="no" checked="checked" class="radio" /> No<?php }?>
												</div>
											</div>
											
											<div class="formLayoutTableRowMainAll">
												<div class="formLayoutTableRowMainAllLeftCol">
													<?php
													if($page_datemonth=="01"){$page_datemonth_word="Jan";}
													if($page_datemonth=="02"){$page_datemonth_word="Feb";}
													if($page_datemonth=="03"){$page_datemonth_word="Mar";}
													if($page_datemonth=="04"){$page_datemonth_word="Apr";}
													if($page_datemonth=="05"){$page_datemonth_word="May";}
													if($page_datemonth=="06"){$page_datemonth_word="Jun";}
													if($page_datemonth=="07"){$page_datemonth_word="Jul";}
													if($page_datemonth=="08"){$page_datemonth_word="Aug";}
													if($page_datemonth=="09"){$page_datemonth_word="Sep";}
													if($page_datemonth=="10"){$page_datemonth_word="Oct";}
													if($page_datemonth=="11"){$page_datemonth_word="Nov";}
													if($page_datemonth=="12"){$page_datemonth_word="Dec";}
													?>
													
													FImage (<a title="This is the featured image file name. This file is relative to <?php echo ucfirst($pop)."/".$page_dateyear."/".$page_datemonth_word."/".$page_dateday."/".str_replace(":","",$page_nameclean);?>/ but you only need to type the file name.extension." style="cursor:pointer;">?</a>):
												</div>
												<div class="formLayoutTableRowMainAllRightCol">
													<input type="text" name="editpage_featuredimage" id="editpage_featuredimage" value="<?php echo $page_featured_image;?>" style="width:190px;" />
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
														<center><iframe src="<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/modules/native/uploader-flashy/index.php?id=<?php echo $page;?>&pop=<?php echo ucfirst($pop);?>&year=<?php echo $page_dateyear;?>&month=<?php echo $page_datemonth_word;?>&day=<?php echo $page_dateday;?>&title=<?php echo $page_nameclean;?>" style="position:relative; top: 5px;" width="880" height="584"></iframe></center>																				
														<?php
														/* FLASHY WITHOUT FILE WITH FILE SCANNING */
														} else if(getGlobalVars($properties,"uploader_type")=="flashy"){
														?>			
														<script type="text/javascript">
														$('#upload').ajaxupload({
															url: '<?php echo $WEBSITE_URL_ROOT;?>includes/private/bin/modules/native/uploader-flashy/upload.php',
															remotePath: '../../../public/uploads/<?php echo ucfirst($pop)."/".$page_dateyear."/".$page_datemonth_word."/".$page_dateday."/".$page_nameclean."/";?>',
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
													<input type="button" name="editpage_upload_fimage" onclick="editpage_featuredimage.value='';upload()" value="Browse" class="button" /> <input type="button" name="editpage_clear_fimage" onclick="editpage_featuredimage.value=''" value="Clear" class="button" />
												</div>
											</div>
										</div>
										
										<div class="formLayoutTable">
											<div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
													<h2>Category</h2>
													<select name="editpage_category" size="10" style="width:280px;">
													<?php
													$GET_ALL_CATEGORIES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$what_starter."_categories ORDER BY name");
													if(mysql_num_rows($GET_ALL_CATEGORIES)<1){
														/* NO CATEGORIES */	
														?>
														<option value="">No Categories</option>
														<?php
													} else {
														while($FETCH_ALL_CATEGORIES=mysql_fetch_array($GET_ALL_CATEGORIES)){
															if($FETCH_ALL_CATEGORIES['id'] == $page_category){
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
													<input type="text" name="editpage_customcategory" style="width:280px;" />
												</div>
												<div class="formLayoutTableRowRightCol">
													
												</div>
											</div>
										</div>
										
										<div class="formLayoutTable">
											<div class="formLayoutTableRow">
												<div class="formLayoutTableRowLeftCol">
													<h2>Tags</h2>
													<input type="text" name="editpage_tags" value="<?php echo $page_tags;?>" onfocus="if(this.value=='comma separated tags here'){this.value='';}" onblur="if(this.value==''){this.value='comma separated tags here';}" style="width:280px;" />
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
						<a href="?menu=pages&page=all-pages&order=page">Page Name</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=pages&page=all-pages&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=pages&page=all-pages&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=pages&page=all-pages&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
					</div>
					<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
						<a href="?menu=pages&page=all-pages&order=lp">Pad</a>
					</div>
					<div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
						<a href="?menu=pages&page=all-pages&order=layout">Layout</a>
					</div>
					<div class="formLayoutFullCol alignCenter width-small valignMiddle fontBig BorderTop BorderBottom">
						Stats
					</div>
					<div class="formLayoutFullCol alignLeft width-xsmall valignMiddle fontBig BorderTop BorderBottom BorderRight">
						<a href="?menu=pages&page=all-pages&order=date">Date</a>
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
							<a href="?menu=pages&page=all-pages&action=edit&what=<?php echo $item;?>&pageid=<?php echo $page_id;?>&pad=<?php echo $LPM_NAME;?>">Edit</a>
						</div>
						<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop">
							<?php echo $LPM_NAME_FULL;?>
						</div>
						<div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom BorderTop">
							<?php echo $layout;?>
						</div>
						<div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom BorderTop">
							Stats
						</div>
						<div class="formLayoutFullCol alignLeft width-xsmall valignMiddle BorderRight BorderBottom BorderTop">
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