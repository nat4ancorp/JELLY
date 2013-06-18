<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
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
$ITEMS_PAGE=getGlobalVars($properties,'pages_page');
$ITEMS_LIST=getGlobalVars($properties,'pages_list');
$ITEMS_DEFAULT_LIST=getGlobalVars($properties,'pages_defaults'); // this is where you tell us what item is default to display
$SUBITEMS_LIST=getGlobalVars($properties,'pages_sublist'); //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES=getGlobalVars($properties,'pages_names');
$ITEMS_LIST_SPECIAL=getGlobalVars($properties,'pages_special'); //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM=getGlobalVars($properties,'pages_special_item'); //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER=getGlobalVars($properties,'pages_default_order'); //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
	
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
if($type == "admin"){
	if((isset($_POST['_chooser'])) && ($_POST['_chooser']!="") || isset($_POST['page_publish'])){
		?>
		<h1><span style="">Add New Page for </span>
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
		if(isset($_POST['newpage_publish'])){
			/* STEP 1: GET DATA */
			$page=$_GET['pageid'];
			$pagename=$_GET['pagename'];
			$what=$_GET['what'];
			
			$newpage_lock=mysql_real_escape_string($_POST['newpage_who']);
			$newpage_layout=mysql_real_escape_string($_POST['newpage_layout']);
			$newpage_page=mysql_real_escape_string($_POST['newpage_safename']);
			$newpage_name=mysql_real_escape_string($_POST['newpage_name']);
			$newpage_keywords=mysql_real_escape_string($_POST['newpage_keywords']);
			$newpage_lp=mysql_real_escape_string($_POST['newpage_lp']);	
			$newpage_status=mysql_real_escape_string($_POST['newpage_status']);	
			
			//$newpage_subpage=mysql_real_escape_string($_POST['subpage']); not used
			$newpage_created=mysql_real_escape_string($_POST['newpage_date']);	
			$newpage_is_searchable=mysql_real_escape_string($_POST['newpage_is_searchable']);
			$newpage_toggle_feat=mysql_real_escape_string($_POST['newpage_toggle_feat']);
			//$newpage_toggle_minifeat=mysql_real_escape_string($_POST['toggle_minifeat']); not used
			
			$newpage_content_main=mysql_real_escape_string($_POST['newpage_content_main']);
			$newpage_content_main_code=mysql_real_escape_string($_POST['newpage_content_main_code']);
			$newpage_content_main_after_code=mysql_real_escape_string($_POST['newpage_content_main_after_code']);
			
			$newpage_content_sidebar=mysql_real_escape_string($_POST['newpage_content_sidebar']);
			$newpage_content_sidebar_code=mysql_real_escape_string($_POST['newpage_content_sidebar_code']);		
			$newpage_content_sidebar_after_code=mysql_real_escape_string($_POST['newpage_content_sidebar_after_code']);
			
			$newpage_content_sidebar2=mysql_real_escape_string($_POST['newpage_content_sidebar2']);
			$newpage_content_sidebar2_code=mysql_real_escape_string($_POST['newpage_content_sidebar2_code']);				
			$newpage_content_sidebar2_after_code=mysql_real_escape_string($_POST['newpage_content_sidebar2_after_code']);
			
			/* STEP 2: CHECK DATA FOR ACCURACY */
			if($newpage_name==""){$error_console.="<br />You must give the page a name. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			if($newpage_name!=""){if(strpos($newpage_name," ") != -1 && $newpage_safename==""){$error_console.="<br />Since the name of the page has a space in it, you must use a safe name with hyphen-separated spaces. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}}else{/* NOT MENTIONABLE */}
			if($newpage_keywords==""){$error_console.="<br />If you want the SEO Abilities of your page you must provide keywords. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			//if(){$error_console.="<br /><a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}		
			
			/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
			
			/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */		
			
			if($error_console!=""){
				echo "<h2>Uh oh! There appear to be errors among us.</h2>";
				echo $error_console."<br /><br /><a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";
			} else {
				/* STEP 2.5: MASTER SOME STUFF */
				if($newpage_lp=="all"){$newpage_lpm="0";}
				if($newpage_lp=="padmain"){$newpage_lpm="1";}
				if($newpage_lp=="pad1"){$newpage_lpm="2";}
				if($newpage_lp=="pad2"){$newpage_lpm="3";}
				if($newpage_lp=="pad3"){$newpage_lpm="4";}
				if($newpage_lp=="pad4"){$newpage_lpm="5";}
				
				/* STEP 3: UPLOAD/SAVE */
				
				
				
				/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
				
				/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */						
												
				mysql_query("INSERT INTO {$properties->DB_PREFIX}".$item." (page_lock,layout,page,pageNAME,pageKEYWORDS,lp,lpm,created,is_searchable,toggle_feat,content_main,content_main_code,content_main_after_code,content_sidebar,content_sidebar_code,content_sidebar_after_code,content_sidebar2,content_sidebar2_code,content_sidebar2_after_code,status) VALUES ('".$newpage_lock."','".$newpage_layout."','".$newpage_safename."','".$newpage_name."','".$newpage_keywords."','".$newpage_lp."','".$newpage_lpm."','".$newpage_created."','".$newpage_is_searchable."','".$newpage_toggle_feat."','".$newpage_content_main."','".$newpage_content_main_code."','".$newpage_content_main_after_code."','".$newpage_content_sidebar."','".$newpage_content_sidebar_code."','".$newpage_content_sidebar_after_code."','".$newpage_content_sidebar2."','".$newpage_content_sidebar2_code."','".$newpage_content_sidebar2_after_code."','".$newpage_status."')") or die(mysql_error());
				
				/* STEP 4: POST RETURN OF RECEIPT */
				echo "<br /><b>".$newpage_name."</b> has been successfully created! <a href=\"".$WEBSITE_URL."?menu=pages\">Refresh</a>";
			}
			
		} else {
			
		}
	} else {
		/* CHECK TO SEE IF THERE ARE MULTIPLE THINGS TO POST TO; IF ONLY ONE - DISPLAY FORM(S) */
		if(count($ITEMS_LIST_LIST)-1==1){
			/* ONLY ONE */
			$item=$ITEMS_LIST_LIST[0];
			$sub_item=$SUBITEMS_LIST_LIST[0];
			?>
			<input type="hidden" name="subitem_<?php echo $ITEMS_LIST_LIST[0];?>" value="<?php echo $sub_item;?>" />
			<h1 style="opacity:.5;">Creating a page in <?php echo $ITEMS_LIST_NAMES_LIST[0];?></h1>
			<?php
			if(isset($_POST['newpage_publish'])){
				/* STEP 1: GET DATA */
				$page=$_GET['pageid'];
				$pagename=$_GET['pagename'];
				$what=$_GET['what'];
				
				$newpage_lock=mysql_real_escape_string($_POST['newpage_who']);
				$newpage_layout=mysql_real_escape_string($_POST['newpage_layout']);
				$newpage_safename=mysql_real_escape_string($_POST['newpage_safename']);
				$newpage_name=mysql_real_escape_string($_POST['newpage_name']);
				$newpage_keywords=mysql_real_escape_string($_POST['newpage_keywords']);
				$newpage_lp=mysql_real_escape_string($_POST['newpage_lp']);
				$newpage_status=mysql_real_escape_string($_POST['newpage_status']);		
				
				//$newpage_subpage=mysql_real_escape_string($_POST['subpage']); not used
				$newpage_created=mysql_real_escape_string($_POST['newpage_date']);	
				$newpage_is_searchable=mysql_real_escape_string($_POST['newpage_is_searchable']);
				$newpage_toggle_feat=mysql_real_escape_string($_POST['newpage_toggle_feat']);
				//$newpage_toggle_minifeat=mysql_real_escape_string($_POST['toggle_minifeat']); not used
				
				$newpage_content_main=mysql_real_escape_string($_POST['newpage_content_main']);
				$newpage_content_main_code=mysql_real_escape_string($_POST['newpage_content_main_code']);
				$newpage_content_main_after_code=mysql_real_escape_string($_POST['newpage_content_main_after_code']);
				
				$newpage_content_sidebar=mysql_real_escape_string($_POST['newpage_content_sidebar']);
				$newpage_content_sidebar_code=mysql_real_escape_string($_POST['newpage_content_sidebar_code']);		
				$newpage_content_sidebar_after_code=mysql_real_escape_string($_POST['newpage_content_sidebar_after_code']);
				
				$newpage_content_sidebar2=mysql_real_escape_string($_POST['newpage_content_sidebar2']);
				$newpage_content_sidebar2_code=mysql_real_escape_string($_POST['newpage_content_sidebar2_code']);				
				$newpage_content_sidebar2_after_code=mysql_real_escape_string($_POST['newpage_content_sidebar2_after_code']);
				
				/* STEP 2: CHECK DATA FOR ACCURACY */
				if($newpage_name==""){$error_console.="<br />You must give the page a name. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				if($newpage_name!=""){if(strpos($newpage_name," ") != -1 && $newpage_safename==""){$error_console.="<br />Since the name of the page has a space in it, you must use a safe name with hyphen-separated spaces. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}}else{/* NOT MENTIONABLE */}
				if($newpage_keywords==""){$error_console.="<br />If you want the SEO Abilities of your page you must provide keywords. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				//if(){$error_console.="<br /><a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				
				if($error_console!=""){
					echo $error_console;
				} else {
					/* STEP 2.5: MASTER SOME STUFF */
					if($newpage_lp=="all"){$newpage_lpm="0";}
					if($newpage_lp=="padmain"){$newpage_lpm="1";}
					if($newpage_lp=="pad1"){$newpage_lpm="2";}
					if($newpage_lp=="pad2"){$newpage_lpm="3";}
					if($newpage_lp=="pad3"){$newpage_lpm="4";}
					if($newpage_lp=="pad4"){$newpage_lpm="5";}
					
					/* STEP 3: UPLOAD/SAVE */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}".$item." (page_lock,layout,page,pageNAME,pageKEYWORDS,lp,lpm,created,is_searchable,toggle_feat,content_main,content_main_code,content_main_after_code,content_sidebar,content_sidebar_code,content_sidebar_after_code,content_sidebar2,content_sidebar_code2,content_sidebar_after_code2,status) VALUES ('".$newpage_lock."','".$newpage_layout."','".$newpage_safename."','".$newpage_name."','".$newpage_keywords."','".$newpage_lp."','".$newpage_lpm."','".$newpage_created."','".$newpage_is_searchable."','".$newpage_toggle_feat."','".$newpage_content_main."','".$newpage_content_main_code."','".$newpage_content_main_after_code."','".$newpage_content_sidebar."','".$newpage_content_sidebar_code."','".$newpage_content_sidebar_after_code."','".$newpage_content_sidebar2."','".$newpage_content_sidebar2_code."','".$newpage_content_sidebar2_after_code."','".$newpage_status."')") or die(mysql_error());
					
					/* STEP 4: POST RETURN OF RECEIPT */
					echo "<br /><b>".$newpage_name."</b> has been successfully created! <a href=\"".$WEBSITE_URL."?menu=pages\">Refresh</a>";
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
											<label>Page Title</label>
											<input type="text" name="newpage_name" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $page_name;?>" class="full-input" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<label>URL Safe Title</label>
											<input type="text" name="newpage_safename" onfocus="if(this.value=='Enter URL-Safe Title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter URL-Safe Title here';}" value="<?php echo $page_page;?>" class="full-input" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>																						
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<h1>Main Content</h1>
											<label>Before Main Code</label> (Standard HTML Only)<br />
											<textarea name="newpage_content_main" rows="15"><?php echo htmlspecialchars($page_content_main);?></textarea><br />
											
											<label for="newpage_content_main_code">Main Code</label> (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
											<textarea name="newpage_content_main_code" rows="15"><?php echo htmlspecialchars($page_content_main_code);?></textarea><br />
											
											<label for="newpage_content_main_after_code">After Main Code</label> (Standard HTML Only)<br />
											<textarea name="newpage_content_main_after_code" rows="15"><?php echo htmlspecialchars($page_content_main_after_code);?></textarea><br />
											<h1>Sidebar 1</h1>
											
											<label for="newpage_content_sidebar">Before Sidebar Code</label> (Standard HTML Only)<br />
											<textarea name="newpage_content_sidebar" rows="15"><?php echo htmlspecialchars($page_content_sidebar);?></textarea><br />
											
											<label for="newpage_content_sidebar_code">Sidebar Code</label> (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
											<textarea name="newpage_content_sidebar_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar_code);?></textarea><br />
											
											<label for="newpage_content_sidebar_after_code">After Sidebar Code</label> (Standard HTML Only)<br />
											<textarea name="newpage_content_sidebar_after_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar_after_code);?></textarea><br />
											
											<h1>Sidebar 2</h1>
											
											<label for="newpage_content_sidebar2">Before Sidebar 2 Code</label> (Standard HTML Only)<br />
											<textarea name="newpage_content_sidebar2" rows="15"><?php echo htmlspecialchars($page_content_sidebar2);?></textarea><br />
											
											<label for="newpage_content_sidebar2_code">Sidebar 2 Code</label> (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
											<textarea name="newpage_content_sidebar2_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar2_code);?></textarea><br />
											
											<label for="newpage_content_sidebar2_after_code">After Sidebar 2 Code</label> (Standard HTML Only)<br />
											<textarea name="newpage_content_sidebar2_after_code" rows="15"><?php echo htmlspecialchars($page_content_sidebar2_after_code);?></textarea><br />
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
											<input type="submit" name="newpage_publish" value="Save" class="submit" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Status:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<select name="newpage_status">
												<option value="Drafted" >Draft</option>
												<option value="Published" >Final</option>
												<option value="On Hold" >Hold</option>
											</select>
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											For Who?
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<select name="newpage_who">
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
											 <select name="newpage_layout">
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
											<select name="newpage_lp">                                                    
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
													$('#newpage_date').datepick({dateFormat: 'yyyy-mm-dd'});
													//$('#inlineDatepicker').datepick({onSelect: showDate});
												});
											</script>
											Date:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<input type="date" name="newpage_date" min="<?php echo $page_dateyear."-".$page_datemonth."-".$page_dateday;?>" id="newpage_date" value="<?php echo $page_dateyear."-".$page_datemonth."-".$page_dateday;?>" style="width:120px;" />
										</div>
									</div>											
								</div>
								
								<div class="formLayoutTableMainAll">
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											FSlider? (<a title="This will place a featured slider on the page for that page." style="cursor:pointer;">?</a>)
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<?php if($page_toggle_feat == "on"){?><input type="radio" name="newpage_toggle_feat" value="on" class="radio" checked="checked" /> Yes <input type="radio" name="newpage_toggle_feat" value="off" class="radio" /> No<?php } else {?><input type="radio" name="newpage_toggle_feat" value="on" class="radio" /> Yes <input type="radio" name="newpage_toggle_feat" value="off" checked="checked" class="radio" /> No<?php }?>
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol"> 
											Searchable?
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											 <?php if($page_is_searchable == "yes"){?><input type="radio" name="newpage_is_searchable" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="newpage_is_searchable" value="no" class="radio" /> No<?php } else {?><input type="radio" name="newpage_is_searchable" value="yes" class="radio" /> Yes <input type="radio" name="newpage_is_searchable" value="no" checked="checked" class="radio" /> No<?php }?>
										</div>
									</div>
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											Keywords
										</div>
										<div class="formLayoutTableRowRightCol">
											<input type="text" name="newpage_keywords" value="<?php echo $page_keywords;?>" style="width:200px;" />
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
			<center><h1 style="opacity:.5;">There are no items to create a page to :( <a href="<?php echo $WEBSITE_URL;?>?menu=settings&page=writing#pcp">Add one now</a></h1></center>
			<?php
		} else {
			/* MULTIPLE */
			?>
			<center>
			<h1>Before you begin, select what you what to make a page for</h1>
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