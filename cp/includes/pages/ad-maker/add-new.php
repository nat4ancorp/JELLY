<?php
$ITEMS_PAD=",";
$ITEMS_PAGE=",";
$ITEMS_LIST="modules,";
$ITEMS_DEFAULT_LIST="no,"; // this is where you tell us what item is default to display
$SUBITEMS_LIST="ads,"; //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES="All Ads,";
$ITEMS_LIST_SPECIAL="0,"; //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM="none,"; //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER="id"; //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
	
/* ------------------------------------------ DO NOT EDIT BELOW THIS LINE -------------------------------------------------------------------- */
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
		<h1><span style="">Add New AD for </span>
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
			$post_name=mysql_escape_string($_POST['post_name']);
			$post_status=mysql_escape_string($_POST['post_status']);
			$post_type=mysql_escape_string($_POST['post_type']);
			$post_url=mysql_escape_string($_POST['post_url']);
			$post_date=mysql_escape_string($_POST['post_date']);
			$post_time=mysql_escape_string($_POST['post_time']);
			$post_target=mysql_escape_string($_POST['post_target']);
			$post_img_location=mysql_escape_string($_POST['post_img_location']);
			$post_img_border=mysql_escape_string($_POST['post_img_border']);
			$post_img_alt=mysql_escape_string($_POST['post_img_alt']);
			$post_img_width=mysql_escape_string($_POST['post_img_width']);
			$post_img_height=mysql_escape_string($_POST['post_img_height']);
			$post_img_align=mysql_escape_string($_POST['post_img_align']);
			
			/* STEP 2: CHECK DATA FOR ACCURACY */
			$error_console="";		
			if($post_name=="" || $post_name=="Give the post a clever title"){$error_console.="<br />You must provide a title.";}
			
			/* STEP 2: CHECK DATA FOR ACCURACY */
			
			if($error_console!=""){
				echo "<h2>Uh oh! There appear to be errors among us.</h2>";
				echo $error_console."<br /><br /><a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";
			} else {
				/* STEP 2.5: MASTER SOME STUFF */
				//0000-00-00 00:00:00
				//0123456789012345678
				$dateandtime=$post_date." ".$post_time;
				$post_dateyear=substr($dateandtime,0,4);
				$post_datemonth=substr($dateandtime,5,2);
				$post_dateday=substr($dateandtime,8,2);
				$post_datehour=substr($dateandtime,11,2);
				$post_datemin=substr($dateandtime,14,2);
				$post_datesec=substr($dateandtime,17,2);
				
				
				/* STEP 3: UPLOAD/SAVE */
															
				mysql_query("INSERT INTO {$properties->DB_PREFIX}modules_ads (status,name,type,url,target,img_location,img_border,img_alt,img_width,img_height,img_align,dateandtime,date_year,date_month,date_day,date_hour,date_min,date_sec) VALUES ('".$post_status."','".$post_name."','".$post_type."','".$post_url."','".$post_target."','".$post_img_location."','".$post_img_border."','".$post_img_alt."','".$post_img_width."','".$post_img_height."','".$post_img_align."','".$post_dateandtime."','".$post_dateyear."','".$post_datemonth."','".$post_dateday."','".$post_datehour."','".$post_datemin."','".$post_datesec."')") or die(mysql_error());
								
				/* STEP 4: POST RETURN OF RECEIPT */
				echo "<br /><b>".$post_name."</b> has been successfully posted to <b>AD Rotator</b>! <a href=\"".$WEBSITE_URL."?menu=admaker&page=manage\">Refresh</a>";
			}
			
		} else {		
			$postedto=$_POST['_chooser']."_".$_POST['subitem_'.$_POST['_chooser']]; //output example: blog_entries
			$pop=$_POST['_chooser'];
			?>
			<form action="" method="post">
                <div class="cp-table">
                <div class="cp-row">
                <div class="cp-lcol">
                <div class="formLayoutTable">
                <div class="formLayoutTableRow">
                <div class="formLayoutTableRowLeftCol">
                <label>Advertisement Name (does not display)</label>
                <br />
                <input type="text" name="post_name" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $post_name;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
                </div>
                
                <div class="formLayoutTableRow">
                <div class="formLayoutTableRowLeftCol">
                <label>Target URL</label>
                <br />
                <input type="text" name="post_url" onfocus="if(this.value=='http://www.toyouradvertisement.com'){this.value='';}" onblur="if(this.value==''){this.value='http://www.toyouradvertisement.com';}" value="<?php echo $post_url;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
                </div>
                
                <div class="formLayoutTableRow">
                <div class="formLayoutTableRowLeftCol">
                <label>Banner Graphic Location (url only)</label>
                <br />
                <input type="text" name="post_img_location" onfocus="if(this.value=='Where is your banner located?'){this.value='';}" onblur="if(this.value==''){this.value='Where is your banner located?';}" value="<?php echo $post_img_location;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
                </div>
                
                <div class="formLayoutTableRow">
                <div class="formLayoutTableRowLeftCol">
                <label>Alternative Text (for graphic)</label>
                <br />
                <input type="text" name="post_img_alt" onfocus="if(this.value=='This is my banner here, so click on it'){this.value='';}" onblur="if(this.value==''){this.value='This is my banner here, so click on it';}" value="<?php echo $post_img_alt;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
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
                <input type="submit" name="post_publish" value="Publish" class="submit" />
                <input type="submit" name="post_savedraft" disabled="disabled" value="Save Draft" class="submit" />
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
                <select name="post_status">
                <?php if($post_status=="active"){?>
                <option value="active" selected="selected">Active</option>
                <?php } else {?>
                <option value="active">Active</option>
                <?php }?>
                
                <?php if($post_status=="inactive"){?>
                <option value="inactive" selected="selected">Inactive</option>
                <?php } else {?>
                <option value="inactive">Inactive</option>
                <?php }?>
                
                <?php if($post_status=="deleted"){?>
                <option value="deleted" selected="selected">Deleted</option>
                <?php } else {?>
                <option value="deleted">Deleted</option>
                <?php }?>
            
                </select>
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Target: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <select name="post_target">
                <?php if($post_target=="_blank"){?>
                <option value="_blank" selected="selected">_blank</option>
                <?php } else {?>
                <option value="_blank">_blank</option>
                <?php }?>
                
                <?php if($post_target=="_self"){?>
                <option value="_self" selected="selected">_self</option>
                <?php } else {?>
                <option value="_self">_self</option>
                <?php }?>
                
                <?php if($post_target=="_parent"){?>
                <option value="_parent" selected="selected">_parent</option>
                <?php } else {?>
                <option value="_parent">_parent</option>
                <?php }?>
            
                </select>
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Type: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <select name="post_type">
                <?php if($post_type=="top"){?>
                <option value="top" selected="selected">Top</option>
                <?php } else {?>
                <option value="top">Top</option>
                <?php }?>
            
                </select>
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
                Date: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="date" name="post_date" id="post_date" value="<?php echo $post_dateyear."-".$post_datemonth."-".$post_dateday;?>" style="width:120px;" />
                </div>
                </div>
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Time: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="time" name="post_time" step="1" value="<?php echo $post_time;?>" style="width:120px;" />
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Image Border? </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <?php if($post_img_border == "on"){?>
                <input type="radio" name="post_img_border" value="yes" class="radio" checked="checked" />
                Yes
                <input type="radio" name="post_img_border" value="no" class="radio" />
                No
                <?php } else {?>
                <input type="radio" name="post_img_border" value="yes" class="radio" />
                Yes
                <input type="radio" name="post_img_border" value="no" checked="checked" class="radio" />
                No
                <?php }?>
                </div>
                </div>    
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Width </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="text" name="post_img_width" value="<?php echo $post_img_width;?>" style="width:150px;" />
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Height </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="text" name="post_img_height" value="<?php echo $post_img_height;?>" style="width:150px;" />
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Align: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <select name="post_img_align">
                <?php if($post_type=="center"){?>
                <option value="center" selected="selected">Center</option>
                <?php } else {?>
                <option value="center">Center</option>
                <?php }?>
            
                </select>
                </div>
                </div>    
                
                </div>
                
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
				$post_name=mysql_escape_string($_POST['post_name']);
				$post_status=mysql_escape_string($_POST['post_status']);
				$post_type=mysql_escape_string($_POST['post_type']);
				$post_url=mysql_escape_string($_POST['post_url']);
				$post_date=mysql_escape_string($_POST['post_date']);
				$post_time=mysql_escape_string($_POST['post_time']);
				$post_target=mysql_escape_string($_POST['post_target']);
				$post_img_location=mysql_escape_string($_POST['post_img_location']);
				$post_img_border=mysql_escape_string($_POST['post_img_border']);
				$post_img_alt=mysql_escape_string($_POST['post_img_alt']);
				$post_img_width=mysql_escape_string($_POST['post_img_width']);
				$post_img_height=mysql_escape_string($_POST['post_img_height']);
				$post_img_align=mysql_escape_string($_POST['post_img_align']);
				
				/* STEP 2: CHECK DATA FOR ACCURACY */
				$error_console="";		
				if($post_name=="" || $post_name=="Give the post a clever title"){$error_console.="<br />You must provide a title.";}
				
				/* STEP 2: CHECK DATA FOR ACCURACY */
				
				if($error_console!=""){
					echo "<h2>Uh oh! There appear to be errors among us.</h2>";
					echo $error_console."<br /><br /><a onclick=\"history.go(-1);\" style=\"cursor:pointer;\">Go back</a>.";
				} else {
					/* STEP 2.5: MASTER SOME STUFF */
					//0000-00-00 00:00:00
					//0123456789012345678
					$dateandtime=$post_date." ".$post_time;
					$post_dateyear=substr($dateandtime,0,4);
					$post_datemonth=substr($dateandtime,5,2);
					$post_dateday=substr($dateandtime,8,2);
					$post_datehour=substr($dateandtime,11,2);
					$post_datemin=substr($dateandtime,14,2);
					$post_datesec=substr($dateandtime,17,2);
					
					
					/* STEP 3: UPLOAD/SAVE */
																
					mysql_query("INSERT INTO {$properties->DB_PREFIX}modules_ads (status,name,type,url,target,img_location,img_border,img_alt,img_width,img_height,img_align,dateandtime,date_year,date_month,date_day,date_hour,date_min,date_sec) VALUES ('".$post_status."','".$post_name."','".$post_type."','".$post_url."','".$post_target."','".$post_img_location."','".$post_img_border."','".$post_img_alt."','".$post_img_width."','".$post_img_height."','".$post_img_align."','".$post_dateandtime."','".$post_dateyear."','".$post_datemonth."','".$post_dateday."','".$post_datehour."','".$post_datemin."','".$post_datesec."')") or die(mysql_error());
									
					/* STEP 4: POST RETURN OF RECEIPT */
					echo "<br /><b>".$post_name."</b> has been successfully posted to <b>AD Rotator</b>! <a href=\"".$WEBSITE_URL."?menu=admaker&page=manage\">Refresh</a>";
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
                <label>Advertisement Name (does not display)</label>
                <br />
                <input type="text" name="post_name" onfocus="if(this.value=='Enter title here'){this.value='';}" onblur="if(this.value==''){this.value='Enter title here';}" value="<?php echo $post_name;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
                </div>
                
                <div class="formLayoutTableRow">
                <div class="formLayoutTableRowLeftCol">
                <label>Target URL</label>
                <br />
                <input type="text" name="post_url" onfocus="if(this.value=='http://www.toyouradvertisement.com'){this.value='';}" onblur="if(this.value==''){this.value='http://www.toyouradvertisement.com';}" value="<?php echo $post_url;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
                </div>
                
                <div class="formLayoutTableRow">
                <div class="formLayoutTableRowLeftCol">
                <label>Banner Graphic Location (url only)</label>
                <br />
                <input type="text" name="post_img_location" onfocus="if(this.value=='Where is your banner located?'){this.value='';}" onblur="if(this.value==''){this.value='Where is your banner located?';}" value="<?php echo $post_img_location;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
                </div>
                
                <div class="formLayoutTableRow">
                <div class="formLayoutTableRowLeftCol">
                <label>Alternative Text (for graphic)</label>
                <br />
                <input type="text" name="post_img_alt" onfocus="if(this.value=='This is my banner here, so click on it'){this.value='';}" onblur="if(this.value==''){this.value='This is my banner here, so click on it';}" value="<?php echo $post_img_alt;?>" class="full-input" />
                </div>
                <div class="formLayoutTableRowRightCol"> </div>
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
                <input type="submit" name="post_publish" value="Publish" class="submit" />
                <input type="submit" name="post_savedraft" disabled="disabled" value="Save Draft" class="submit" />
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
                <select name="post_status">
                <?php if($post_status=="active"){?>
                <option value="active" selected="selected">Active</option>
                <?php } else {?>
                <option value="active">Active</option>
                <?php }?>
                
                <?php if($post_status=="inactive"){?>
                <option value="inactive" selected="selected">Inactive</option>
                <?php } else {?>
                <option value="inactive">Inactive</option>
                <?php }?>
                
                <?php if($post_status=="deleted"){?>
                <option value="deleted" selected="selected">Deleted</option>
                <?php } else {?>
                <option value="deleted">Deleted</option>
                <?php }?>
            
                </select>
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Target: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <select name="post_target">
                <?php if($post_target=="_blank"){?>
                <option value="_blank" selected="selected">_blank</option>
                <?php } else {?>
                <option value="_blank">_blank</option>
                <?php }?>
                
                <?php if($post_target=="_self"){?>
                <option value="_self" selected="selected">_self</option>
                <?php } else {?>
                <option value="_self">_self</option>
                <?php }?>
                
                <?php if($post_target=="_parent"){?>
                <option value="_parent" selected="selected">_parent</option>
                <?php } else {?>
                <option value="_parent">_parent</option>
                <?php }?>
            
                </select>
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Type: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <select name="post_type">
                <?php if($post_type=="top"){?>
                <option value="top" selected="selected">Top</option>
                <?php } else {?>
                <option value="top">Top</option>
                <?php }?>
            
                </select>
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
                Date: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="date" name="post_date" id="post_date" value="<?php echo $post_dateyear."-".$post_datemonth."-".$post_dateday;?>" style="width:120px;" />
                </div>
                </div>
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Time: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="time" name="post_time" step="1" value="<?php echo $post_time;?>" style="width:120px;" />
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Image Border? </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <?php if($post_img_border == "on"){?>
                <input type="radio" name="post_img_border" value="yes" class="radio" checked="checked" />
                Yes
                <input type="radio" name="post_img_border" value="no" class="radio" />
                No
                <?php } else {?>
                <input type="radio" name="post_img_border" value="yes" class="radio" />
                Yes
                <input type="radio" name="post_img_border" value="no" checked="checked" class="radio" />
                No
                <?php }?>
                </div>
                </div>    
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Width </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="text" name="post_img_width" value="<?php echo $post_img_width;?>" style="width:150px;" />
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Height </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <input type="text" name="post_img_height" value="<?php echo $post_img_height;?>" style="width:150px;" />
                </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                <div class="formLayoutTableRowMainAllLeftCol"> Align: </div>
                <div class="formLayoutTableRowMainAllRightCol">
                <select name="post_img_align">
                <?php if($post_type=="center"){?>
                <option value="center" selected="selected">Center</option>
                <?php } else {?>
                <option value="center">Center</option>
                <?php }?>
            
                </select>
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