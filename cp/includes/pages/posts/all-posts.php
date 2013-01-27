<?php
//tell us entries you want to get (the table names without the "_entries" part that is)
$ITEMS_LIST="pages_af_atoz,blog,otherwork,work,";
$SUBITEMS_LIST="entries,entries,entries,projects,"; //these are what follow after the "_" on a table name (Eg. "entries")
$ITEMS_LIST_NAMES="AF : The A-Z List,The Blog,Other Work,My Work,";
$ITEMS_LIST_SPECIAL="1,0,0,0,"; //SPECIAL LIST is for the use of determining what info to get from database (Eg. If you dont have an author item in db use "1")
$ITEMS_LIST_SPECIAL_ITEM="reviewedby,none,none,none,"; //if you specified "1" above then put the name of the special item else put "none"
$DEFAULT_ORDER="dateandtime OR dateandtime_goingtostart"; //if order is not set in the url, it will order by this (You can add boolean values with " OR ")
	
/* ------------------------------------------------------------ DO NOT EDIT BELOW THIS LINE ----------------------------------------------------------------------- */
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
<h1>Posts <a href="?menu=posts&page=add-new" class="small">Add New</a></h1>
<div id="formLayoutFull">
    <?php	
	$ITEMS_LIST_LIST=explode(",",$ITEMS_LIST);
	$SUBITEMS_LIST_LIST=explode(",",$SUBITEMS_LIST);
	$ITEMS_LIST_NAMES_LIST=explode(",",$ITEMS_LIST_NAMES);
	$ITEMS_LIST_SPECIAL_LIST=explode(",",$ITEMS_LIST_SPECIAL);
	$ITEMS_LIST_SPECIAL_ITEM_LIST=explode(",",$ITEMS_LIST_SPECIAL_ITEM);
	
	/* BEGIN GETTING THE ITEMS OR WHAT EVER YOU GUYS DO :P */
	for($i=0; $i<count($ITEMS_LIST_LIST)-1; $i++){
		$item=$ITEMS_LIST_LIST[$i];
		$sub_item=$SUBITEMS_LIST_LIST[$i];
		//check for ordering
		if(isset($_GET['order']) && $_GET['order']!=""){
			/* ORDER IS SET */
			if($ITEMS_LIST_SPECIAL_LIST[$i]==1){$order=$ITEMS_LIST_SPECIAl_ITEM_LIST[$i];}else{$order=$_GET['order'];}
			if($_GET['order']=="date"){$order="dateandtime OR dateandtime_goingtostart";}
			if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="ASC";}
			$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item." ORDER BY ".$order." ".$direction."");
		} else {
			/* NO ORDER SET */
			if(isset($_GET['direction']) && $_GET['direction']!=""){$direction=$_GET['direction'];}else{$direction="DESC";}
			$GET_ITEMS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item." ORDER BY ".$DEFAULT_ORDER." ".$direction."");
		}
		if(mysql_num_rows($GET_ITEMS)<1){
			?>
            </div>
            <div id="formLayoutFull" class="InBetween alignCenter">
	            <div class="formLayoutFullRow InBetween">
    	            <div class="formLayoutFullCol InBetween">
        	        	<?php						
							echo "<h2>".$ITEMS_LIST_NAMES_LIST[$i]."</h2>";
						?>
            		</div>
	            </div>
            </div>
            <div id="formLayoutFull">
            </div>
            <div id="formLayoutFull" class="InBetween alignCenter BorderLeftRight BorderTop BorderBottom">
	            <div class="formLayoutFullRow InBetween">
    	            <div class="formLayoutFullCol InBetween valignMiddle">
        	        	No Entries were found or even exist in the database. :( <a href="?menu=posts&page=add-new">Start one right now!</a>
            		</div>
	            </div>
            </div>
            <div id="formLayoutFull">
            <?php
		} else {
			?>
            </div>
            <div id="formLayoutFull" class="InBetween alignCenter">
	            <div class="formLayoutFullRow InBetween">
    	            <div class="formLayoutFullCol InBetween">
        	        	<?php						
							echo "<h2>".$ITEMS_LIST_NAMES_LIST[$i]."</h2>";
						?>
            		</div>
	            </div>
            </div>
            <div id="formLayoutFull">
            <div class="formLayoutFullRow">
                <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderTop BorderLeft BorderBottom">
                    <input type="checkbox" onclick="checkAll(this,'<?php echo $ITEMS_LIST_LIST[$i];?>')" />
                </div>
                <div class="formLayoutFullCol alignLeft width-medium valignMiddle fontBig BorderTop BorderBottom">
                    <a href="?menu=posts&page=all-posts&order=title">Title</a> <?php if(isset($_GET['direction']) && $_GET['direction']!=""){if($_GET['direction']=="ASC"){?>[<a href="?menu=posts&page=all-posts&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=DESC">ASC</a>]<?php }else if($_GET['direction']=="DESC"){?>[<a href="?menu=posts&page=all-posts&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{echo $DEFAULT_ORDER;}?>&direction=ASC">DESC</a>]<?php }}else{?>[<a href="?menu=posts&page=all-posts&order=<?php if(isset($_GET['order']) && $_GET['order']!=""){echo $_GET['order'];}else{if($DEFAULT_ORDER=="dateandtime OR dateandtime_goingtostart"){echo "date";}else{echo $DEFAULT_ORDER;}}?>&direction=ASC">DESC</a>]<?php }?>
                </div>
                <div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
                    <a href="?menu=posts&page=all-posts&order=author">Author</a>
                </div>
                <div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
                    <a href="?menu=posts&page=all-posts&order=category">Categories</a>
                </div>
                <div class="formLayoutFullCol alignLeft width-semimedium valignMiddle fontBig BorderTop BorderBottom">
                    Tags
                </div>
                <div class="formLayoutFullCol alignCenter width-small valignMiddle fontBig BorderTop BorderBottom">
                    Stats
                </div>
                <div class="formLayoutFullCol alignCenter width-small valignMiddle fontBig BorderTop BorderBottom">
                    C
                </div>
                <div class="formLayoutFullCol alignCenter width-small valignMiddle fontBig BorderTop BorderBottom">
                    L
                </div>
                <div class="formLayoutFullCol alignLeft width-xsmall valignMiddle fontBig BorderTop BorderBottom BorderRight">
                    <a href="?menu=posts&page=all-posts&order=date">Date</a>
                </div>
            </div>
            <?php
			while($FETCH_ITEMS=mysql_fetch_array($GET_ITEMS)){
				@$entry_id=$FETCH_ITEMS['id'];
				@$title=$FETCH_ITEMS['title'];
				@$author=$FETCH_ITEMS['author'];
				@$reviewedby=$FETCH_ITEMS['reviewedby'];
				@$category=$FETCH_ITEMS['category'];
				@$tags=$FETCH_ITEMS['tags'];
				@$dateandtime=$FETCH_ITEMS['dateandtime'];
				@$dateandtime_goingtostart=$FETCH_ITEMS['dateandtime_goingtostart'];
				@$status=$FETCH_ITEMS['status'];
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
						 if($icat==count($category_list)-1){$category.="<a href=\"\">" . $FETCH_CATEGORY_INFO['name'] . "</a>";}else{$category.="<a href=\"\">" . $FETCH_CATEGORY_INFO['name'] . "</a>, ";}
						}
					}
				} else {
					if($type!=""){$GET_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_".$sub_item."_types WHERE id='{$category}'") or die('uh oh! '.mysql_error());}else{$GET_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$item."_categories WHERE id='{$category}'") or die('uh oh! '.mysql_error());}
					while($FETCH_CATEGORY_INFO=mysql_fetch_array($GET_CATEGORY_INFO)){
						$category_shortname=$FETCH_CATEGORY_INFO['shortname'];
						$category="<a href=\"\">".$FETCH_CATEGORY_INFO['name']."</a>";
					}	
				}
				
				//put spaces in between tags
				$tags_list=$tags;
				$tags="";
				$tags_list_list=explode(",",$tags_list);
				
				for($itag=0; $itag<count($tags_list_list)-1; $itag++){
					if($itag==count($tags_list_list)-2){
						/* END OF FILE */
						$tags.="<a href=\"\">".$tags_list_list[$itag]."</a>";
					} else {
						$tags.="<a href=\"\">".$tags_list_list[$itag]."</a>, ";	
					}
				}
				
				?>
                <div class="formLayoutFullRow">
                    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderLeft BorderBottom">
                        <input type="checkbox" name="check_<?php echo $ITEMS_LIST_LIST[$i];?>" value="<?php echo $id;?>" />
                    </div>
                    <div class="formLayoutFullCol title alignLeft width-medium valignTop BorderBottom">
                        <?php if($name!=""){echo "<a href=\"\">".$name."</a>";}else{echo "<a href=\"\">".$title."</a>";}?>
                    </div>
                    <div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom">
                        <?php echo "<a href=\"\">".$author_name."</a>";?>
                    </div>
                    <div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom">
                        <?php echo $category;?>
                    </div>
                    <div class="formLayoutFullCol alignLeft width-semimedium valignTop BorderBottom">
                        <?php echo $tags;?>
                    </div>
                    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom">
                        Stats
                    </div>
                    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom">
                        <?php echo $COUNT_ITEMS_COMMENTS;?>
                    </div>
                    <div class="formLayoutFullCol alignCenter width-small valignMiddle BorderBottom">
                        0
                    </div>
                    <div class="formLayoutFullCol alignLeft width-xsmall valignMiddle BorderRight BorderBottom">
                        <?php if($dateandtime=="0000-00-00 00:00:00"){echo $dateandtime_goingtostart;}else{echo $dateandtime;}?>
                        <?php echo $status;?>
                    </div>
                </div>
                <?php
			}
		}
	}
	/* END BEGIN GETTING THE ENTERIES OR WHAT EVER YOU GUYS DO :P */
	?>
</div>
<br /><br />