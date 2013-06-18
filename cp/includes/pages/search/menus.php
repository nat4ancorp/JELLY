<?php
/* --------------------------------------------- DO NOT EDIT BELOW THIS LINE -------------------------------------------------------------------- */
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
.selected {
	background: #09F;
	color: white;
}
.mid-input {
	width: 100%;
	position: relative;
	left: -20px;
}
.formLayoutTri {
	display: table;
	width: 104%;
	margin: 15px auto;
}
.formLayoutTri-row {
	display: table-row;
}
.formLayoutTri-row-col1 {
	display: table-cell;
	width: 30%;
	border: thin solid #666;
	padding: 10px;
}
.formLayoutTri-row-col2 {
	display: table-cell;
	width: 30%;
	border: thin solid #666;
	padding: 10px;
}
.formLayoutTri-row-col3 {
	display: table-cell;
	width: 30%;
	border: thin solid #666;
	padding: 10px;
}
.formLayoutTri-row-col-title {
	padding: 0px 10px 20px 0px;
	font-size: 2em;
	text-align: center;
}
.formLayoutTri-row-col-item {
	border: thin dashed #666;
	padding: 10px;
	cursor: pointer;
	font-size: 1.5em;
}
.formLayoutTri-row-col-item:hover {
	background: #09F;
	color: white;
}
.formLayoutTri-row-col-item a {
	cursor: pointer;
	font-size: 1em;
	color: white;
	text-decoration: none;
}
.formLayoutTri-row-col-item a:hover {
	cursor: pointer;
	font-size: 1em;
	color: white;
}
.formLayoutTri-row-col-edit {
	border: thin dashed #666;
	padding: 10px;
	cursor: pointer;
	font-size: 1.5em;
}
.formLayoutTri-row-col-edit input {
	padding: 10px;
	font-size: .8em;
}
.formLayoutTri-row-col-edit select {
	padding: 10px;
	font-size: .8em;
}
.formLayoutTri-row-col-edit option {
	padding: 10px;
	font-size: .8em;
}
.formLayoutTri-row-col-container label {
	font-size: 1.25em;
}
.formLayoutTri-row-col-container textarea {
	resize: none;
	width: 97.9%;
}

.formLayoutTri-row-col-edit-table {
	display: table;
}
.formLayoutTri-row-col-edit-table-row {
	display: table-row;	
}
.formLayoutTri-row-col-edit-table-row-lcol {
	display: table-cell;
	width: 60%;
}
.formLayoutTri-row-col-edit-table-row-rcol {
	display: table-cell;
	text-align: right;
}
.radio-casing {
	padding: 10px;
	position: relative;
	left: 40px;
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

<?php
/* MASTER PARSER */
/* GET ALL CHAPTERS */
$CHAPTERS="";
$GET_CHAPTERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}search_chapters ORDER BY name");
if(mysql_num_rows($GET_CHAPTERS)<1){
	$CHAPTERS="";
} else {
	$CHAPTERS=mysql_num_rows($GET_CHAPTERS);
	while($FETCH_CHAPTERS=mysql_fetch_array($GET_CHAPTERS)){
		$CHAPTERS_ID.=$FETCH_CHAPTERS['id'].",";
		$CHAPTERS_LAUNCHPADID.=$FETCH_CHAPTERS['launchpad_id'].",";
		$CHAPTERS_NAME.=$FETCH_CHAPTERS['name'].",";
		$CHAPTERS_SHOWNAME.=$FETCH_CHAPTERS['show_name'].",";
		$CHAPTERS_PAGE.=$FETCH_CHAPTERS['page'].",";
		
		/* CONVERT ITEM IDS COMMAS TO ":::" */
		$CHAPTER_ITEMIDS=$FETCH_CHAPTERS['item_id'];
		$CHAPTER_ITEMIDS=str_replace(",",":::",$CHAPTER_ITEMIDS);
		$CHAPTERS_ITEMIDS.=$CHAPTER_ITEMIDS.",";
		
		/* CONVERT CHAPTER IDS COMMAS TO ":::" */
		$CHAPTER_CHAPTERIDS=$FETCH_CHAPTERS['chapter_id'];
		$CHAPTER_CHAPTERIDS=str_replace(",",":::",$CHAPTER_CHAPTERIDS);
		$CHAPTERS_CHAPTERIDS.=$CHAPTER_CHAPTERIDS.",";
		
		/* CONVERT SEARCH_THIS COMMAS TO ":::" */
		$CHAPTER_SEARCHTHIS=$FETCH_CHAPTERS['search_this'];
		$CHAPTER_SEARCHTHIS=str_replace(",",":::",$CHAPTER_SEARCHTHIS);
		$CHAPTERS_SEARCHTHIS.=$CHAPTER_SEARCHTHIS.",";
		
		/* CONVERT ITEM_SINGLE COMMAS TO ":::" */
		$CHAPTER_ITEMSINGLE=$FETCH_CHAPTERS['item_single'];
		$CHAPTER_ITEMSINGLE=str_replace(",",":::",$CHAPTER_ITEMSINGLE);
		$CHAPTERS_ITEMSINGLE.=$CHAPTER_ITEMSINGLE.",";
		
		/* CONVERT ITEM_PLURAL COMMAS TO ":::" */
		$CHAPTER_ITEMPLURAL=$FETCH_CHAPTERS['item_plural'];
		$CHAPTER_ITEMPLURAL=str_replace(",",":::",$CHAPTER_ITEMPLURAL);
		$CHAPTERS_ITEMPLURAL.=$CHAPTER_ITEMPLURAL.",";
		
		/* CONVERT CONNECTOR_SINGLE COMMAS TO ":::" */
		$CHAPTER_CONNECTORSINGLE=$FETCH_CHAPTERS['connector_single'];
		$CHAPTER_CONNECTORSINGLE=str_replace(",",":::",$CHAPTER_CONNECTORSINGLE);
		$CHAPTERS_CONNECTORSINGLE.=$CHAPTER_CONNECTORSINGLE.",";
		
		/* CONVERT CONNECTOR_PLURAL COMMAS TO ":::" */
		$CHAPTER_CONNECTORPLURAL=$FETCH_CHAPTERS['connector_plural'];
		$CHAPTER_CONNECTORPLURAL=str_replace(",",":::",$CHAPTER_CONNECTORPLURAL);
		$CHAPTERS_CONNECTORPLURAL.=$CHAPTER_CONNECTORPLURAL.",";
		
		/* CONVERT ENDING_SINGLE COMMAS TO ":::" */
		$CHAPTER_ENDINGSINGLE=$FETCH_CHAPTERS['ending_single'];
		$CHAPTER_ENDINGSINGLE=str_replace(",",":::",$CHAPTER_ENDINGSINGLE);
		$CHAPTERS_ENDINGSINGLE.=$CHAPTER_ENDINGSINGLE.",";
		
		/* CONVERT ENDING_PLURAL COMMAS TO ":::" */
		$CHAPTER_ENDINGPLURAL=$FETCH_CHAPTERS['ending_plural'];
		$CHAPTER_ENDINGPLURAL=str_replace(",",":::",$CHAPTER_ENDINGPLURAL);
		$CHAPTERS_ENDINGPLURAL.=$CHAPTER_ENDINGPLURAL.",";
		
		/* CONVERT WHERE_CLAUSE COMMAS TO ":::" */
		$CHAPTER_WHERECLAUSE=$FETCH_CHAPTERS['where_clause'];
		$CHAPTER_WHERECLAUSE=str_replace(",",":::",$CHAPTER_WHERECLAUSE);
		$CHAPTERS_WHERECLAUSE.=$CHAPTER_WHERECLAUSE.",";
		
		/* CONVERT ORDER_BY COMMAS TO ":::" */
		$CHAPTER_ORDERBY=$FETCH_CHAPTERS['order_by'];
		$CHAPTER_ORDERBY=str_replace(",",":::",$CHAPTER_ORDERBY);
		$CHAPTERS_ORDERBY.=$CHAPTER_ORDERBY.",";
		
		$CHAPTERS_ISSEARCHABLE.=$FETCH_CHAPTERS['is_searchable'].",";
		$CHAPTERS_FORLP.=$FETCH_CHAPTERS['for_lp'].",";
	}
}
/* END MASTER PARSER */
?>

<script type="text/javascript">
function edit(action,what,id){
	switch(action){
		case 'expand':
			switch(what){
				case 'chapter':
					document.getElementById("chapter_"+id).style.display = 'inline-block';
					document.getElementById("chapter_editlink_"+id).setAttribute('onclick','edit(\'collapse\',\'chapter\','+id+');');					
					document.getElementById("chapter_editlink_"+id).innerHTML = 'Close';
					document.getElementById("chapter_editlink_"+id).style.opacity = '1';
					if(id==0){document.getElementById("chapter_tab_"+id).setAttribute('class','formLayoutTri-row-col-item selected');}
					
					//close all other panels
					for(var i=1; i<=<?php echo mysql_num_rows($GET_CHAPTERS);?>; i++){
						if(i==id){/* SELECTING PANEL; DONT DO ANYTHING */}else{document.getElementById("chapter_"+i).style.display = 'none';document.getElementById("chapter_editlink_"+i).setAttribute('onclick','edit(\'expand\',\'chapter\','+i+');');document.getElementById("chapter_editlink_"+i).innerHTML = 'Edit';document.getElementById("chapter_tab_"+i).setAttribute('class','formLayoutTri-row-col-item');document.getElementById("chapter_editlink_"+i).style.opacity = '0';}
					}
					
				break;
			}
		break;
		
		case 'collapse':
			switch(what){
				case 'chapter':
					document.getElementById("chapter_"+id).style.display = 'none';
					document.getElementById("chapter_editlink_"+id).setAttribute('onclick','edit(\'expand\',\'chapter\','+id+');');
					if(id==0){document.getElementById("chapter_editlink_"+id).innerHTML = 'Open';}else{document.getElementById("chapter_editlink_"+id).innerHTML = 'Edit';}
					document.getElementById("chapter_tab_"+id).setAttribute('class','formLayoutTri-row-col-item');
					document.getElementById("chapter_editlink_"+id).style.opacity = '0';
				break;
			}
		break;
		
		case 'mouseover':
			switch(what){
				case 'chapter':
					document.getElementById("chapter_editlink_"+id).style.opacity = '1';
				break;
			}
		break;
		
		case 'mouseout':
			switch(what){
				case 'chapter':
					if(document.getElementById("chapter_editlink_"+id).innerHTML=='Close'){/* PANEL SELECTED */}else{document.getElementById("chapter_editlink_"+id).style.opacity = '0';}
				break;
			}
		break;
	}	
}
</script>

<div class="formLayoutTri">
	<div class="formLayoutTri-row">
    	<div class="formLayoutTri-row-col1">
	        <div class="formLayoutTri-row-col-title">Edit a Chapter</div>
        	<?php
				/* CHECK FOR BLANK */
				if($CHAPTERS==""){
					/* NO CHAPTERS */
					?><div class="formLayoutTri-row-col-item">No Chapters Found</div><?php
				} else {
					/* EXPLODE CHAPTERS */
					$CHAPTERS_LAUNCHPADID_LIST=explode(",",$CHAPTERS_LAUNCHPADID);
					$CHAPTERS_ID_LIST=explode(",",$CHAPTERS_ID);
					$CHAPTERS_NAME_LIST=explode(",",$CHAPTERS_NAME);
					$CHAPTERS_SHOWNAME_LIST=explode(",",$CHAPTERS_SHOWNAME);
					$CHAPTERS_PAGE_LIST=explode(",",$CHAPTERS_PAGE);
					$CHAPTERS_FORLP_LIST=explode(",",$CHAPTERS_FORLP);
					
					$CHAPTERS_ISSEARCHABLE_LIST=explode(",",$CHAPTERS_ISSEARCHABLE);
					for($i=0; $i<count($CHAPTERS_NAME_LIST)-1; $i++){
						?><div class="formLayoutTri-row-col-item" id="chapter_tab_<?php echo $CHAPTERS_ID_LIST[$i];?>"><span id="chapter_tab_text_<?php echo $CHAPTERS_ID_LIST[$i];?>"><?php echo $CHAPTERS_NAME_LIST[$i];?></span> <a id="chapter_editlink_<?php echo $CHAPTERS_ID_LIST[$i];?>" style="float:right;opacity:0;" onclick="edit('expand','chapter',<?php echo $CHAPTERS_ID_LIST[$i];?>);" onmouseover="edit('mouseover','chapter',<?php echo $CHAPTERS_ID_LIST[$i];?>);" onmouseout="edit('mouseout','chapter',<?php echo $CHAPTERS_ID_LIST[$i];?>);">Edit</a></div><?php
						?>
                        <div class="formLayoutTri-row-col-edit" id="chapter_<?php echo $CHAPTERS_ID_LIST[$i];?>" style="display:none;">
                        	<form id="doChapterEdit_<?php echo $CHAPTERS_ID_LIST[$i];?>" method="post">
                            	<input type="hidden" name="chapter_edit_id" value="<?php echo $CHAPTERS_ID_LIST[$i];?>" />
	                            <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	<label>Name</label>
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<input type="text" name="chapter_edit_name" id="chapter_edit_name_<?php echo $CHAPTERS_ID_LIST[$i];?>" class="mid-input" value="<?php echo $CHAPTERS_NAME_LIST[$i];?>" />
                                        </div>
                                    </div>
                                </div>  
                                <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	<label>Show Name?</label>
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<div class="radio-casing">
                                            <?php
											if($CHAPTERS_SHOWNAME_LIST[$i]=="yes"){
												?>										
	                                            <input type="radio" name="chapter_edit_show_name" value="yes" checked="checked" class="radio" /> Yes <input type="radio" name="chapter_edit_show_name" value="no" class="radio" /> No
                                                <?php 
											} else if($CHAPTERS_SHOWNAME_LIST[$i]=="no"){
												?>
                                                <input type="radio" name="chapter_edit_show_name" value="yes" class="radio" /> Yes <input type="radio" name="chapter_edit_show_name" checked="checked" value="no" class="radio" /> No
                                                <?php	
											}
											?>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	<label>Launchpad</label>
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<select name="chapter_edit_launchpad" class="mid-input" style="position: relative; left: 5px;">
                                            	<?php 
												if($CHAPTERS_LAUNCHPADID_LIST[$i]=="1"){
													?><option value="1" selected="selected"><?php echo $properties->SPADMAIN;?></option><?php
												} else {
													?><option value="1"><?php echo $properties->SPADMAIN;?></option><?php	
												}
												?>
                                                <?php 
												if($CHAPTERS_LAUNCHPADID_LIST[$i]=="2"){
													?><option value="2" selected="selected"><?php echo $properties->SPAD1;?></option><?php
												} else {
													?><option value="2"><?php echo $properties->SPAD1;?></option><?php	
												}
												?>
                                                <?php 
												if($CHAPTERS_LAUNCHPADID_LIST[$i]=="3"){
													?><option value="3" selected="selected"><?php echo $properties->SPAD2;?></option><?php
												} else {
													?><option value="3"><?php echo $properties->SPAD2;?></option><?php	
												}
												?>
                                                <?php 
												if($CHAPTERS_LAUNCHPADID_LIST[$i]=="4"){
													?><option value="4" selected="selected"><?php echo $properties->SPAD3;?></option><?php
												} else {
													?><option value="4"><?php echo $properties->SPAD3;?></option><?php	
												}
												?>
                                                <?php 
												if($CHAPTERS_LAUNCHPADID_LIST[$i]=="5"){
													?><option value="5" selected="selected"><?php echo $properties->SPAD4;?></option><?php
												} else {
													?><option value="5"><?php echo $properties->SPAD4;?></option><?php	
												}
												?>
                                            </select>
                                        </div>
                                    </div>
                                </div>         
                                <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	<label>Page</label>
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<input type="text" name="chapter_edit_page" class="mid-input" value="<?php echo $CHAPTERS_PAGE_LIST[$i];?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	<label>Searchable? (<a title="Toggles this chapter on the Search page" style="cursor:help;">?</a>)</label>
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<div class="radio-casing">
                                            <?php
											if($CHAPTERS_ISSEARCHABLE_LIST[$i]=="yes"){
												?>										
	                                            <input type="radio" name="chapter_edit_issearchable" value="yes" checked="checked" class="radio" /> Yes <input type="radio" name="chapter_edit_issearchable" value="no" class="radio" /> No
                                                <?php 
											} else if($CHAPTERS_ISSEARCHABLE_LIST[$i]=="no"){
												?>
                                                <input type="radio" name="chapter_edit_issearchable" value="yes" class="radio" /> Yes <input type="radio" name="chapter_edit_issearchable" checked="checked" value="no" class="radio" /> No
                                                <?php	
											}
											?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	<label>For What Launchpad</label>
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<select name="chapter_edit_for_lp" class="mid-input" style="position: relative; left: 5px;">
                                            	<option value="all">All of them</option>												
                                                <?php 
												if($CHAPTERS_FORLP_LIST[$i]=="pad1"){
													?><option value="pad1" selected="selected"><?php echo $properties->SPAD1;?></option><?php
												} else {
													?><option value="pad1"><?php echo $properties->SPAD1;?></option><?php	
												}
												?>
                                                <?php 
												if($CHAPTERS_FORLP_LIST[$i]=="pad2"){
													?><option value="pad2" selected="selected"><?php echo $properties->SPAD2;?></option><?php
												} else {
													?><option value="pad2"><?php echo $properties->SPAD2;?></option><?php	
												}
												?>
                                                <?php 
												if($CHAPTERS_FORLP_LIST[$i]=="pad3"){
													?><option value="pad3" selected="selected"><?php echo $properties->SPAD3;?></option><?php
												} else {
													?><option value="pad3"><?php echo $properties->SPAD3;?></option><?php	
												}
												?>
                                                <?php 
												if($CHAPTERS_FORLP_LIST[$i]=="pad4"){
													?><option value="pad4" selected="selected"><?php echo $properties->SPAD4;?></option><?php
												} else {
													?><option value="pad4"><?php echo $properties->SPAD4;?></option><?php	
												}
												?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<span style="padding-top: 20px;padding-bottom: 20px;">Delete? <input type="checkbox" name="chapter_edit_delete" value="yes" /></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formLayoutTri-row-col-edit-table">
                                	<div class="formLayoutTri-row-col-edit-table-row">
                                    	<div class="formLayoutTri-row-col-edit-table-row-lcol">
                                        	
                                        </div>
                                        <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                        	<input type="submit" name="save" value="Update" style="position:relative;left:50px;" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="editChapterMessage_<?php echo $CHAPTERS_ID_LIST[$i];?>" style="text-align:center;padding: 5px;width: 94%;"></div>
            
							<script type="text/javascript">
                            //var to hold the request
                            var request;
                            
                            //bind to the submit event of our form
                            $("#doChapterEdit_<?php echo $CHAPTERS_ID_LIST[$i];?>").submit(function(event){
                                //abort any pending request
                                if (request) {
                                    request.abort();	
                                }
                                //setup some local variables
                                var $form = $(this);
                                //let's select and cache all the fields
                                var $inputs = $form.find("input, select, button, textarea, radio");
                                //serialize the data in the form
                                var serializeData = $form.serialize();
                                
                                //let's disable the inputs for the duration of the ajax request
                                $inputs.prop("disabled", true);
                                
                                //fire off the request to /form.php
                                var request = $.ajax({
                                    url: "<?php echo $WEBSITE_URL_ROOT;?>includes/private/attributes/doSearchChapterEdit.php",
                                    type: "POST",
                                    data: serializeData,
                                    success: function(data){
										setTimeout(function(){$('#editChapterMessage_<?php echo $CHAPTERS_ID_LIST[$i];?>').fadeIn('slow');}, 1000);																											document.getElementById("editChapterMessage_<?php echo $CHAPTERS_ID_LIST[$i];?>").innerHTML = data;
										document.getElementById("chapter_tab_text_<?php echo $CHAPTERS_ID_LIST[$i];?>").innerHTML = document.getElementById("chapter_edit_name_<?php echo $CHAPTERS_ID_LIST[$i];?>").value;
										setTimeout(function(){$('#editChapterMessage_<?php echo $CHAPTERS_ID_LIST[$i];?>').fadeOut('slow');}, 5000);							
                                    }
                                });
                                
                                //callback handler that will be called on success
                                request.done(function (response, textStatus, jqXHR){
                                    //log a message to the console
                                    console.log("Hooray, it worked!");	
                                });
                                
                                //callback handler that will be called on failure
                                request.fail(function(jqXHR, textStatus, errorThrown){
                                    //log the error to the console
                                    console.error(
                                        "The following error occurred: "+
                                        textStatus, errorThrown
                                    );
                                });
                                
                                //callback handler that will be called regardless
                                // if the request failed or succeeded
                                request.always(function() {
                                    //reenable the inputs
                                    $inputs.prop("disabled",false);
                                });
                                
                                //prevent default posting of form
                                event.preventDefault();
                            });
                            </script>
                        </div>
						<?php                        
					}
				}
			?><div class="formLayoutTri-row-col-item" id="chapter_tab_0"><span id="chapter_tab_text_0">Add a Chapter</span> <a id="chapter_editlink_0" style="float:right;opacity:0;" onclick="edit('expand','chapter',0);" onmouseover="edit('mouseover','chapter',0);" onmouseout="edit('mouseout','chapter',0);">Open</a></div>
            
            <div class="formLayoutTri-row-col-edit" id="chapter_0" style="display:none;">
                <form id="doChapterAdd" method="post">                    
                    <div class="formLayoutTri-row-col-edit-table">
                        <div class="formLayoutTri-row-col-edit-table-row">
                            <div class="formLayoutTri-row-col-edit-table-row-lcol">
                                <label>Name</label>
                            </div>
                            <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                <input type="text" name="chapter_add_name" id="chapter_add_name_0" class="mid-input" value="<?php echo $CHAPTERS_NAME_LIST[$i];?>" />
                            </div>
                        </div>
                    </div>  
                    <div class="formLayoutTri-row-col-edit-table">
                        <div class="formLayoutTri-row-col-edit-table-row">
                            <div class="formLayoutTri-row-col-edit-table-row-lcol">
                                <label>Show Name?</label>
                            </div>
                            <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                <div class="radio-casing">                              								
                                    <input type="radio" name="chapter_add_show_name" value="yes" class="radio" /> Yes <input type="radio" name="chapter_add_show_name" value="no" class="radio" /> No
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="formLayoutTri-row-col-edit-table">
                        <div class="formLayoutTri-row-col-edit-table-row">
                            <div class="formLayoutTri-row-col-edit-table-row-lcol">
                                <label>Launchpad</label>
                            </div>
                            <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                <select name="chapter_add_launchpad" class="mid-input" style="position: relative; left: 5px;">
                                    <?php 
                                    if($CHAPTERS_LAUNCHPADID_LIST[$i]=="1"){
                                        ?><option value="1" selected="selected"><?php echo $properties->SPADMAIN;?></option><?php
                                    } else {
                                        ?><option value="1"><?php echo $properties->SPADMAIN;?></option><?php	
                                    }
                                    ?>
                                    <?php 
                                    if($CHAPTERS_LAUNCHPADID_LIST[$i]=="2"){
                                        ?><option value="2" selected="selected"><?php echo $properties->SPAD1;?></option><?php
                                    } else {
                                        ?><option value="2"><?php echo $properties->SPAD1;?></option><?php	
                                    }
                                    ?>
                                    <?php 
                                    if($CHAPTERS_LAUNCHPADID_LIST[$i]=="3"){
                                        ?><option value="3" selected="selected"><?php echo $properties->SPAD2;?></option><?php
                                    } else {
                                        ?><option value="3"><?php echo $properties->SPAD2;?></option><?php	
                                    }
                                    ?>
                                    <?php 
                                    if($CHAPTERS_LAUNCHPADID_LIST[$i]=="4"){
                                        ?><option value="4" selected="selected"><?php echo $properties->SPAD3;?></option><?php
                                    } else {
                                        ?><option value="4"><?php echo $properties->SPAD3;?></option><?php	
                                    }
                                    ?>
                                    <?php 
                                    if($CHAPTERS_LAUNCHPADID_LIST[$i]=="5"){
                                        ?><option value="5" selected="selected"><?php echo $properties->SPAD4;?></option><?php
                                    } else {
                                        ?><option value="5"><?php echo $properties->SPAD4;?></option><?php	
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>         
                    <div class="formLayoutTri-row-col-edit-table">
                        <div class="formLayoutTri-row-col-edit-table-row">
                            <div class="formLayoutTri-row-col-edit-table-row-lcol">
                                <label>Page</label>
                            </div>
                            <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                <input type="text" name="chapter_add_page" class="mid-input" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="formLayoutTri-row-col-edit-table">
                        <div class="formLayoutTri-row-col-edit-table-row">
                            <div class="formLayoutTri-row-col-edit-table-row-lcol">
                                <label>Searchable? (<a title="Toggles this chapter on the Search page" style="cursor:help;">?</a>)</label>
                            </div>
                            <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                <div class="radio-casing">                               								
                                    <input type="radio" name="chapter_add_issearchable" value="yes" class="radio" /> Yes <input type="radio" name="chapter_add_issearchable" value="no" class="radio" /> No                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="formLayoutTri-row-col-edit-table">
                        <div class="formLayoutTri-row-col-edit-table-row">
                            <div class="formLayoutTri-row-col-edit-table-row-lcol">
                                <label>For What Launchpad</label>
                            </div>
                            <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                <select name="chapter_add_for_lp" class="mid-input" style="position: relative; left: 5px;">
                                    <option value="all">All of them</option>												
                                    <option value="pad1"><?php echo $properties->SPAD1;?></option>
                                    <option value="pad2"><?php echo $properties->SPAD2;?></option>
                                    <option value="pad3"><?php echo $properties->SPAD3;?></option>
                                    <option value="pad4"><?php echo $properties->SPAD4;?></option>                                    
                                </select>
                            </div>
                        </div>
                    </div>  
                    <div class="formLayoutTri-row-col-edit-table">
                        <div class="formLayoutTri-row-col-edit-table-row">
                            <div class="formLayoutTri-row-col-edit-table-row-lcol">
                                
                            </div>
                            <div class="formLayoutTri-row-col-edit-table-row-rcol">
                                <input type="submit" name="save" value="Save" style="position:relative;left:60px;" />
                            </div>
                        </div>
                    </div>                        
                </form>
                <div id="addChapterMessage" style="text-align:center;color: green; padding: 5px; width: 94%;"></div>

                <script type="text/javascript">
                //var to hold the request
                var request;
                
                //bind to the submit event of our form
                $("#doChapterAdd").submit(function(event){
                    //abort any pending request
                    if (request) {
                        request.abort();	
                    }
                    //setup some local variables
                    var $form = $(this);
                    //let's select and cache all the fields
                    var $inputs = $form.find("input, select, button, textarea, radio");
                    //serialize the data in the form
                    var serializeData = $form.serialize();
                    
                    //let's disable the inputs for the duration of the ajax request
                    $inputs.prop("disabled", true);
                    
                    //fire off the request to /form.php
                    var request = $.ajax({
                        url: "<?php echo $WEBSITE_URL_ROOT;?>includes/private/attributes/doSearchChapterAdd.php",
                        type: "POST",
                        data: serializeData,
                        success: function(data){
                            document.getElementById("addChapterMessage").innerHTML = data;                            
                        }
                    });
                    
                    //callback handler that will be called on success
                    request.done(function (response, textStatus, jqXHR){
                        //log a message to the console
                        console.log("Hooray, it worked!");	
                    });
                    
                    //callback handler that will be called on failure
                    request.fail(function(jqXHR, textStatus, errorThrown){
                        //log the error to the console
                        console.error(
                            "The following error occurred: "+
                            textStatus, errorThrown
                        );
                    });
                    
                    //callback handler that will be called regardless
                    // if the request failed or succeeded
                    request.always(function() {
                        //reenable the inputs
                        $inputs.prop("disabled",false);
                    });
                    
                    //prevent default posting of form
                    event.preventDefault();
                });
                </script>
            </div>
            
        </div>        
        <div class="formLayoutTri-row-col2">
        	<div class="formLayoutTri-row-col-title">Edit an Item</div>
        	<div class="formLayoutTri-row-col-item">No Items Found</div>
        </div>
        <div class="formLayoutTri-row-col3">
        	<div class="formLayoutTri-row-col-title">Edit Settings</div>
        	<div class="formLayoutTri-row-col-container">
            	<label>Content</label>
            	<textarea cols="40" rows="5" name="data_content">Content goes here</textarea>
            </div>
        </div>
    </div>
</div>