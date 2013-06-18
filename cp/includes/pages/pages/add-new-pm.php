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
$ITEMS_PAGE=getGlobalVars($properties,'pages_modules_page');
$ITEMS_LIST=getGlobalVars($properties,'pages_modules_list');
$ITEMS_DEFAULT_LIST=getGlobalVars($properties,'pages_modules_defaults'); // this is where you tell us what item is default to display
$SUBITEMS_LIST=getGlobalVars($properties,'pages_modules_sublist'); //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES=getGlobalVars($properties,'pages_modules_names');
$ITEMS_LIST_SPECIAL=getGlobalVars($properties,'pages_modules_special'); //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM=getGlobalVars($properties,'pages_modules_special_item'); //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER=getGlobalVars($properties,'pages_modules_default_order'); //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
	
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
		<h1><span style="">Add New Module for </span>
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
		if(isset($_POST['newmodule_publish'])){
			/* STEP 1: GET DATA */
			$pagemodule=$_GET['pagemoduleid'];
			$pagemodulename=$_GET['pagemodulename'];
			$what=$_GET['what'];
			
			$newmodule_arr=mysql_real_escape_string($_POST['newmodule_arr']);
			$newmodule_launchpad=mysql_real_escape_string($_POST['newmodule_launchpad']);
			$newmodule_title=mysql_real_escape_string($_POST['newmodule_title']);
			$newmodule_minititle=mysql_real_escape_string($_POST['newmodule_minititle']);
			$newmodule_toggle_title=mysql_real_escape_string($_POST['newmodule_toggle_title']);
			$newmodule_contents=mysql_real_escape_string($_POST['newmodule_contents']);
			$newmodule_page=mysql_real_escape_string($_POST['newmodule_page']);				
			$newmodule_type=mysql_real_escape_string($_POST['newmodule_type']);
			$newmodule_sidebar=mysql_real_escape_string($_POST['newmodule_sidebar']);				
			$newmodule_footer_section=mysql_real_escape_string($_POST['newmodule_footer_section']);				
			$newmodule_toggle_visible=mysql_real_escape_string($_POST['newmodule_toggle_visible']);
			$newmodule_is_searchable=mysql_real_escape_string($_POST['newmodule_is_searchable']);
			$newmodule_status=mysql_real_escape_string($_POST['newmodule_status']);
			
			/* STEP 2: CHECK DATA FOR ACCURACY */
			if($newmodule_title==""){$error_console.="<br />You must give the module a title. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			if($newmodule_contents==""){$error_console.="<br />A module with nothing in it? Well, ain't that the best thing ever! <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			if($newmodule_arr==""){$error_console.="<br />Tell me where to put it on the page. Any number depending on the spot you want. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			if($newmodule_type=="sidebar" && $newmodule_sidebar==""){$error_console.="<br />Since you chose to add this to the sidebar, which one? If you have only one sidebar, it will always be 1; If you have two sidebars, it will be 1 or 2. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			if($newmodule_type=="footer" && $newmodule_footer_section==""){$error_console.="<br />Since you chose to put this in the footer, tell me what section. Left, middle, or right? <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			if(strpos($newmodule_page," ")>-1){$error_console.="<br />The Page of Module cannot have spaces in it. <b>HINT:</b> Use - (hyphen) in place of spaces. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
			//if(){$error_console.="<br /><a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}		
			
			/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
			
			/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */		
			
			if($error_console!=""){
				echo "<h2>Uh oh! There appear to be errors among us.</h2>";
				echo $error_console."<br /><br /><a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";
			} else {
				/* STEP 2.5: MASTER SOME STUFF */			
				
				/* STEP 3: UPLOAD/SAVE */
				
				
				
				/* -------------------------- CUSTOM ADDONS ------------------------------------------------------------------------------------------- */
				
				/* ------------------------ END CUSTOM ADDONS ----------------------------------------------------------------------------------------- */						
												
				mysql_query("INSERT INTO {$properties->DB_PREFIX}".$item." (arr,launchpad,title,mini_title,toggle_title,contents,page,type,sidebar,footer_section,toggle_visible,is_searchable,status) VALUES ('".$newmodule_arr."','".$newmodule_launchpad."','".$newmodule_title."','".$newmodule_minititle."','".$newmodule_toggle_title."','".$newmodule_contents."','".$newmodule_page."','".$newmodule_type."','".$newmodule_sidebar."','".$newmodule_footer_section."','".$newmodule_toggle_visible."','".$newmodule_is_searchable."','".$newmodule_status."')") or die(mysql_error());
				
				/* STEP 4: POST RETURN OF RECEIPT */
				echo "<br /><b>".$newmodule_title."</b> has been successfully created! <a href=\"".$WEBSITE_URL."?menu=pages&page=page-modules\">Refresh</a>";
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
			<h1 style="opacity:.5;">Creating a Module in <?php echo $ITEMS_LIST_NAMES_LIST[0];?></h1>
			<?php
			if(isset($_POST['newmodule_publish'])){
				/* STEP 1: GET DATA */
				$pagemodule=$_GET['pagemoduleid'];
				$pagemodulename=$_GET['pagemodulename'];
				$what=$_GET['what'];
				
				$newmodule_arr=mysql_real_escape_string($_POST['newmodule_arr']);
				$newmodule_launchpad=mysql_real_escape_string($_POST['newmodule_launchpad']);
				$newmodule_title=mysql_real_escape_string($_POST['newmodule_title']);
				$newmodule_minititle=mysql_real_escape_string($_POST['newmodule_minititle']);
				$newmodule_toggle_title=mysql_real_escape_string($_POST['newmodule_toggle_title']);
				$newmodule_contents=mysql_real_escape_string($_POST['newmodule_contents']);
				$newmodule_page=mysql_real_escape_string($_POST['newmodule_page']);				
				$newmodule_type=mysql_real_escape_string($_POST['newmodule_type']);
				$newmodule_sidebar=mysql_real_escape_string($_POST['newmodule_sidebar']);				
				$newmodule_footer_section=mysql_real_escape_string($_POST['newmodule_footer_section']);				
				$newmodule_toggle_visible=mysql_real_escape_string($_POST['newmodule_toggle_visible']);
				$newmodule_is_searchable=mysql_real_escape_string($_POST['newmodule_is_searchable']);
				$newmodule_status=mysql_real_escape_string($_POST['newmodule_status']);
				
				/* STEP 2: CHECK DATA FOR ACCURACY */			
				if($newmodule_title==""){$error_console.="<br />You must give the module a title. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				if($newmodule_contents==""){$error_console.="<br />A module with nothing in it? Well, ain't that the best thing ever! <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				if($newmodule_arr==""){$error_console.="<br />Tell me where to put it on the page. Any number depending on the spot you want. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				if($newmodule_type=="sidebar" && $newmodule_sidebar==""){$error_console.="<br />Since you chose to add this to the sidebar, which one? If you have only one sidebar, it will always be 1; If you have two sidebars, it will be 1 or 2. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				if($newmodule_type=="footer" && $newmodule_footer_section==""){$error_console.="<br />Since you chose to put this in the footer, tell me what section. Left, middle, or right? <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				if(strpos($newmodule_page," ")>-1){$error_console.="<br />The Page of Module cannot have spaces in it. <b>HINT:</b> Use - (hyphen) in place of spaces. <a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}
				//if(){$error_console.="<br /><a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";}		
				
				if($error_console!=""){
					echo $error_console;
				} else {
					/* STEP 2.5: MASTER SOME STUFF */				
					
					/* STEP 3: UPLOAD/SAVE */
					mysql_query("INSERT INTO {$properties->DB_PREFIX}".$item." (arr,launchpad,title,mini_title,toggle_title,contents,page,type,sidebar,footer_section,toggle_visible,is_searchable,status) VALUES ('".$newmodule_arr."','".$newmodule_launchpad."','".$newmodule_title."','".$newmodule_minititle."','".$newmodule_toggle_title."','".$newmodule_contents."','".$newmodule_page."','".$newmodule_type."','".$newmodule_sidebar."','".$newmodule_footer_section."','".$newmodule_toggle_visible."','".$newmodule_is_searchable."','".$newmodule_status."')") or die(mysql_error());
					
					/* STEP 4: POST RETURN OF RECEIPT */
					echo "<br /><b>".$newmodule_title."</b> has been successfully created! <a href=\"".$WEBSITE_URL."?menu=pages&page=page-modules\">Refresh</a>";
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
											<label>Module Title</label>
											<input type="text" name="newmodule_title" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="" class="full-input" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<label>Module Mini Title // a short little tagline for the module</label>
											<input type="text" name="newmodule_minititle" value="" class="full-input" />                                                   
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRow">
										<div class="formLayoutTableRowLeftCol">
											<label>Page of Module (already existing; leaving blank will not associated one; this is the safe url)</label>
											<input type="text" name="newmodule_page" onfocus="if(this.value==''){this.value='';}" onblur="if(this.value==''){this.value='';}" value="" class="full-input" />                                                    <h2>Rules for Page of Module:</h2>
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
											<label for="newmodule_contents">Code</label> (CODE ONLY) (DO NOT INCLUDE &lt;?php or ?&gt; Tags or <b>you will break it</b>)<br />
											<textarea name="newmodule_contents" rows="15"><?php echo htmlspecialchars($contents);?></textarea><br />                                                                                                
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
											<input type="submit" name="newmodule_publish" value="Save" class="submit" />
										</div>
										<div class="formLayoutTableRowRightCol">
											
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Status:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<select name="newmodule_status">
												<option value="Drafted" >Draft</option>
												<option value="Published" >Final</option>
												<option value="On Hold" >Hold</option>
											</select>
										</div>
									</div>
									
									<div class="formLayoutTableRowMainAll">
										<div class="formLayoutTableRowMainAllLeftCol">
											Visibility:
										</div>
										<div class="formLayoutTableRowMainAllRightCol">
											<select name="newmodule_toggle_visible">
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
											<select name="newmodule_toggle_title">
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
											 <select name="newmodule_type">
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
											<select name="newmodule_launchpad">                                                                                                                                                            
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
											 <?php if($page_is_searchable == "yes"){?><input type="radio" name="newmodule_is_searchable" value="yes" class="radio" checked="checked" /> Yes <input type="radio" name="newmodule_is_searchable" value="no" class="radio" /> No<?php } else {?><input type="radio" name="newmodule_is_searchable" value="yes" class="radio" /> Yes <input type="radio" name="newmodule_is_searchable" value="no" checked="checked" class="radio" /> No<?php }?>
										</div>
									</div>
								</div>			
								
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Footer Section:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<select name="newmodule_footer_section">      
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
										<input type="text" name="newmodule_sidebar" value="" style="width:60px;text-align:center;" />
									</div>
								</div>                                        	
								<div class="formLayoutTableRowMainAll">
									<div class="formLayoutTableRowMainAllLeftCol">
										Arrange #:
									</div>
									<div class="formLayoutTableRowMainAllRightCol">
										<input type="text" name="newmodule_arr" value="" style="width:60px;text-align:center;" />
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
			<center><h1 style="opacity:.5;">There are no items to create a pagemodule module to :( <a href="<?php echo $WEBSITE_URL;?>?menu=settings&pagemodule=writing#pmp">Add one now</a></h1></center>
			<?php
		} else {
			/* MULTIPLE */
			?>
			<center>
			<h1>Before you begin, select what you what to make a pagemodule for</h1>
			<form action="" method="post">        
			<?php
			for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
				$sub_item=$SUBITEMS_LIST_LIST[$i];
				?>
				<input type="hidden" name="subitem_<?php echo $ITEMS_LIST_LIST[$i];?>" value="" />
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