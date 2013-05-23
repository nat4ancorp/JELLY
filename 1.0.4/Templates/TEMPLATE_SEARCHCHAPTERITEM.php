<?php
/* (Chapter Title) (Chapter Item Title) */
/* YOU MIGHT HAVE TO SEARCH FOR THE PAD NAME AND CHANGE IT TO MATCH WHAT IS NEEDED */
$pname="";
$pname_special="";
$pname_uri="";
$display_user=false;
$PADINFO=$properties->PAD;
$search_type=""; /* entry, comment, single, double */
/* ---------- DO NOT EDIT BELOW THIS LINE OR ELSE YOU WILL BREAK IT --------- */
//put all your variables here with a @ in front of them to suppress any and all errors
@$id=$FETCH_ITEM['id'];
@$title=$FETCH_ITEM['title'];
@$content=$FETCH_ITEM['content'];
@$author=$FETCH_ITEM['author'];
@$director=$FETCH_ITEM['director'];
@$studio=$FETCH_ITEM['studio'];
@$network=$FETCH_ITEM['network'];
@$category=$FETCH_ITEM['category'];
@$tags=$FETCH_ITEM['tags'];
@$dateandtime=$FETCH_ITEM['dateandtime'];
@$dateandtime_gts=$FETCH_ITEM['dateandtime_goingtostart'];
@$fname=$FETCH_ITEM['fname'];
@$lname=$FETCH_ITEM['lname'];
@$uname=$FETCH_ITEM['uname'];
@$staff_type=$FETCH_ITEM['staff_type'];
@$name=$FETCH_ITEM['name'];
@$shortname=$FETCH_ITEM['shortname'];
@$yname=$FETCH_ITEM['yname'];
@$yweb=$FETCH_ITEM['yweb'];
@$entry_id=$FETCH_ITEM['entry_id'];
@$status=$FETCH_ITEM['status'];
@$name=$FETCH_ITEM['name'];
@$description=$FETCH_ITEM['description'];
@$portfolio_id=$FETCH_ITEM['portfolio_id'];
@$type=$FETCH_ITEM['type'];
@$projectname=$FETCH_ITEM['name'];
@$description=$FETCH_ITEM['description'];
@$page=$FETCH_ITEM['page'];
@$lpm=$FETCH_ITEM['lpm'];
@$pageNAME=$FETCH_ITEM['pageNAME'];

/* CUSTOM EXCHANGES */
if($description!=""){$content=$description;}
/* END CUSTOM EXCHANGES */

//determine type of search
switch($search_type){
	case 'entry':
		/* FOR ENTRIES */
		//set up an indicator variable
		$dateandtime_indicator=$dateandtime;
		
		//make dateandtime
		//0000-00-00
		//0123456789
		
		if($dateandtime=="0000-00-00 00:00:00"){
		$pname_entry_year  = substr($dateandtime_gts,0,4);
		$pname_entry_month = substr($dateandtime_gts,5,2);
		$pname_entry_day   = substr($dateandtime_gts,8,2);
		} else{
		$pname_entry_year  = substr($dateandtime,0,4);
		$pname_entry_month = substr($dateandtime,5,2);
		$pname_entry_day   = substr($dateandtime,8,2);
		}
		
		if($pname_entry_month=="01"){$pname_entry_month_full="Jan";}
		if($pname_entry_month=="02"){$pname_entry_month_full="Feb";}
		if($pname_entry_month=="03"){$pname_entry_month_full="Mar";}
		if($pname_entry_month=="04"){$pname_entry_month_full="Apr";}
		if($pname_entry_month=="05"){$pname_entry_month_full="May";}
		
		if($pname_entry_month=="06"){$pname_entry_month_full="Jun";}
		if($pname_entry_month=="07"){$pname_entry_month_full="Jul";}
		if($pname_entry_month=="08"){$pname_entry_month_full="Aug";}
		if($pname_entry_month=="09"){$pname_entry_month_full="Sep";}
		if($pname_entry_month=="10"){$pname_entry_month_full="Oct";}
		if($pname_entry_month=="11"){$pname_entry_month_full="Nov";}
		if($pname_entry_month=="12"){$pname_entry_month_full="Dec";}
		
		//convert dateandtime into a better looking string
		$dateandtime = $pname_entry_month . " " . $pname_entry_day . ", " . $pname_entry_year;
		$dateandtime_m = $pname_entry_month;
		$dateandtime_m_full = $pname_entry_month_full;
		$dateandtime_d = $pname_entry_day;
		$dateandtime_y = $pname_entry_year;
		
		//convert and get the director or author
		if($display_user===false){
			$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_directors WHERE id='{$director}'") or die('uh oh! '.mysql_error());
			while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){
			 $director_name=$FETCH_PNAME_AUTHOR_INFO['name'];
			 $director_shortname=$FETCH_PNAME_AUTHOR_INFO['shortname'];
			}	
		} else {				
			$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='{$author}'") or die('uh oh! '.mysql_error());
			while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){
			 $uname=$FETCH_PNAME_AUTHOR_INFO['uname'];
			}
		}
		
		//convert and get the studio
		if($display_user===false){
			$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_studios WHERE id='{$studio}'") or die('uh oh! '.mysql_error());
			while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){
			 $studio_name=$FETCH_PNAME_AUTHOR_INFO['name'];
			 $studio_shortname=$FETCH_PNAME_AUTHOR_INFO['shortname'];
			}	
		} else {				
			/* NONE */
		}
		
		//convert and get the network
		if($display_user===false){
			$GET_PNAME_AUTHOR_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_networks WHERE id='{$network}'") or die('uh oh! '.mysql_error());
			while($FETCH_PNAME_AUTHOR_INFO=mysql_fetch_array($GET_PNAME_AUTHOR_INFO)){
			 $network_name=$FETCH_PNAME_AUTHOR_INFO['name'];
			 $network_shortname=$FETCH_PNAME_AUTHOR_INFO['shortname'];
			}	
		} else {				
			/* NONE */
		}
		
		if($display_user===true){
			/* ITS A USER BASED ITEM */
			if($pname=="work_projects"){
				//convert and get the TYPE
				$GET_PROJECT_TYPE_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects_types WHERE id='{$type}'") or die('uh oh! '.mysql_error());
				while($FETCH_PROJECT_TYPE_INFO=mysql_fetch_array($GET_PROJECT_TYPE_INFO)){
				 $TYPE=$FETCH_PROJECT_TYPE_INFO['name'];
				}
		
				//convert and get the portfolio
				$GET_PROJECT_PORT_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_portfolios WHERE id='$portfolio_id}'") or die('uh oh! '.mysql_error());
				while($FETCH_PROJECT_PORT_INFO=mysql_fetch_array($GET_PROJECT_PORT_INFO)){
				 $PORT=$FETCH_PROJECT_PORT_INFO['name'];
				}
			} else {
				//convert and get the category
				//#,#,
				if(strpos($category,",")!="-1"){
					/* MULTIPLE CATEGORIES */
					$category_list=explode(",",$category);
					$category="";
					for($icl=0; $icl<=count($category_list)-1; $icl++){
						$GET_PNAME_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_categories WHERE id='{$category_list[$icl]}'") or die('uh oh! '.mysql_error());
						while($FETCH_PNAME_CATEGORY_INFO=mysql_fetch_array($GET_PNAME_CATEGORY_INFO)){
						 if($i==count($category_list)-1){$category.="<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO['name'],'url','to')."\">" . $FETCH_PNAME_CATEGORY_INFO['name'] . "</a>";}else{$category.="<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO['name'],'url','to')."\">" . $FETCH_PNAME_CATEGORY_INFO['name'] . "</a>, ";}
						}
					}
				} else {
					$GET_PNAME_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_categories WHERE id='{$category}'") or die('uh oh! '.mysql_error());
					while($FETCH_PNAME_CATEGORY_INFO=mysql_fetch_array($GET_PNAME_CATEGORY_INFO)){
					 $category=$FETCH_PNAME_CATEGORY_INFO['name'];
					 $category="<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO['name'],'url','to')."\">" . $FETCH_PNAME_CATEGORY_INFO['name'] . "</a>";
					}	
				}
			}
		} else {
			//convert and get the category
			//#,#,
			if(strpos($category,",")!="-1"){
				/* MULTIPLE CATEGORIES */
				$category_list=explode(",",$category);
				$category="";
				for($icl=0; $icl<=count($category_list)-1; $icl++){
					$GET_PNAME_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_categories WHERE id='{$category_list[$icl]}'") or die('uh oh! '.mysql_error());
					while($FETCH_PNAME_CATEGORY_INFO=mysql_fetch_array($GET_PNAME_CATEGORY_INFO)){
					 if($i==count($category_list)-1){$category.="<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO['name'],'url','to')."\">" . $FETCH_PNAME_CATEGORY_INFO['name'] . "</a>";}else{$category.="<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO['name'],'url','to')."\">" . $FETCH_PNAME_CATEGORY_INFO['name'] . "</a>, ";}
					}
				}
			} else {
				$GET_PNAME_CATEGORY_INFO=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_categories WHERE id='{$category}'") or die('uh oh! '.mysql_error());
				while($FETCH_PNAME_CATEGORY_INFO=mysql_fetch_array($GET_PNAME_CATEGORY_INFO)){
				 $category=$FETCH_PNAME_CATEGORY_INFO['name'];
				 $category="<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".converter($properties,$FETCH_PNAME_CATEGORY_INFO['name'],'url','to')."\">" . $FETCH_PNAME_CATEGORY_INFO['name'] . "</a>";
				}	
			}
		}
		
		//get comment for posts
		$GET_COMMENTS_C=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_comments WHERE entry_id='$id' AND status='Approved'");
		if(mysql_num_rows($GET_COMMENTS_C)<1){
			$comments_count="0 comments";
		} else {
			if((mysql_num_rows($GET_COMMENTS_C)>0) && (mysql_num_rows($GET_COMMENTS_C)<2)){
				$comments_count=mysql_num_rows($GET_COMMENTS_C)." comment";
			} else {
				$comments_count=mysql_num_rows($GET_COMMENTS_C)." comments";
			}
		}
		
		if($display_user===true){$author_name=$uname;}else{$author_name=$director_name;}
		
		/* START BUILDING THE PNAME LIST */
		echo "<div id=\"module-container\">";
			
			echo "<div id=\"module-container-crow\">";
										
				echo "<div id=\"module-container-lcol\">";
					
					//the dateandtime
					if($dateandtime_indicator=="0000-00-00 00:00:00"){
						//get todays date in pieces
						$today_y=date("Y");
						$today_m=date("n");
						$today_d=date("j");
						
						//establish vars
						$font_size="100%";
						
						//compare								
						$num_of_years=$pname_entry_year - $today_y;
						$num_of_months=$pname_entry_month - $today_m;
						$num_of_days=$pname_entry_day - $today_d;
						if($num_of_years<1){
							$ending_y="s";
						} else if(($num_of_years>0) && ($num_of_years<2)){
							$ending_y="";
						} else if($num_of_years>1){
							$ending_y="s";
						}
						
						if($num_of_months<1){
							$ending_m="s";
						} else if(($num_of_months>0) && ($num_of_months<2)){
							$ending_m="";
						} else if($num_of_months>1){
							$ending_m="s";
						}
						
						if($num_of_days<1){
							$ending_d="s";
						} else if(($num_of_days>0) && ($num_of_days<2)){
							$ending_d="";
						} else if($num_of_days>1){
							$ending_d="s";
						}
						
						//make in...
						if($num_of_years < 1){
							$display_inyear="";
						} else {
							//check to see if month and day are there
							if($num_of_months > 0 && $num_of_days > 0){
								$display_inyear="{$num_of_years} year{$ending_y}, ";
								$font_size="80%";
							} else if($num_of_months > 0 || $num_of_days > 0){
								$display_inyear="{$num_of_years} year{$ending_y}, ";
								$font_size="100%";
							} else {
								$display_inyear="{$num_of_years} year{$ending_y}";	
							}
						}
						if($num_of_months < 1){
							$display_inmonth="";
						} else {
							//check to see if year and day are there
							if($num_of_years > 0 && $num_of_days > 0){
								$display_inmonth="{$num_of_months} month{$ending_m}, ";
								$font_size="80%";
							} else if($num_of_years > 0 || $num_of_days > 0){
								$display_inmonth="{$num_of_months} month{$ending_m}, ";
								$font_size="100%";
							} else {
								$display_inmonth="{$num_of_months} month{$ending_m}";
							}
						}
						if($num_of_days < 1){
							$display_inday="";
						} else {
							//check to see if year and month are there
							if($num_of_years > 0 && $num_of_months > 0){
								$display_intie=" &amp; ";
								$display_inday="{$display_intie}{$num_of_days} day{$ending_d}";
							} else {
								$display_inday="{$num_of_days} day{$ending_d}";
							}
						}
						echo "<div id=\"module-full-a-container-date-goingtostart\" style=\"font-size: {$font_size};\">";
						echo "in {$display_inyear}{$display_inmonth}{$display_inday}";
						echo "</div>";
					} else {
						echo "<div id=\"module-full-a-container-date\">";
						echo $dateandtime_d." ".$dateandtime_m_full.", ".$dateandtime_y;
						echo "</div>";
					}
					
					//the author or director
					echo "<div id=\"module-full-a-container-author\">";
						if($display_user===false){/*CUSTOM DISPLAY*/echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/directors/".$director_shortname."\" title=\"the director\">" . $director_name . "</a>";}else{echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/user/".$uname."\">" . $author_name . "</a>";}
					echo "</div>";
					
					if($display_user===false){
						//the studio
						echo "<div id=\"module-full-a-container-studio\">";
							echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/studios/".$studio_shortname."\" title=\"the studio\">" . $studio_name . "</a>";
						echo "</div>";
						
						//the network
						echo "<div id=\"module-full-a-container-network\">";
							echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/networks/".$network_shortname."\" title=\"the network\">" . $network_name . "</a>";
						echo "</div>";
					} else if($display_user===true) {
						/* NONE */	
					}
					
					if($display_user===true){
						/* USER BASED ITEM */
						if($pname=="work_projects"){
							//the TYPE
							echo "<div id=\"module-a-container-comments\">";
								echo "Type: " . "<a href=\"".$WEBSITE_URL.$properties->PADMAIN."/work/".converter($properties,$TYPE,'url','to')."\">" . $TYPE . "</a>";
							echo "</div>";
							
							//the PORT
							echo "<div id=\"module-a-container-category\">";
								echo "Work / " . "<a href=\"".$WEBSITE_URL.$properties->PADMAIN."/work/folio/".converter($properties,$PORT,'url','to')."\">" . $PORT . "</a>";
							echo "</div>";
						} else {
							//the comments
							echo "<div id=\"module-full-a-container-comments\">";
								echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,'url','to')."#comments"."\">".$comments_count."</a>";
							echo "</div>";
							
							//the category
							echo "<div id=\"module-full-a-container-category\">";
								echo $pname_special." / " . $category;
							echo "</div>";	
						}
					} else {
						//the comments
						echo "<div id=\"module-full-a-container-comments\">";
							echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,'url','to')."#comments"."\">".$comments_count."</a>";
						echo "</div>";
						
						//the category
						echo "<div id=\"module-full-a-container-category\">";
							echo $pname_special." / " . $category;
						echo "</div>";	
					}
					
				echo "</div>";
				
				echo "<div id=\"module-container-rcol\">";
					
					//the title
					echo "<div id=\"module-full-a-container-title\">";
						if($display_user===true){
							if($pname=="work_projects"){
								echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".converter($properties,$projectname,'url','to')."\">".$projectname."</a>";
							} else {
								echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,'url','to')."\">".$title."</a>";	
							}
						} else {
							echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title,'url','to')."\">".$title."</a>";	
						}
					echo "</div>";
					
					//the content
					echo "<div id=\"module-full-a-container-content\">";
						$content=converter($properties,$content,'article','to');
						$content=converter($properties,$content,'basic','to');
						$content=converter($properties,$content,'ncode','to');
						echo $content;
					echo "</div>";
					
					//the tags
					echo "<div id=\"module-full-a-container-tags\">";
						//convert the tags into urls
						$tagslist=explode(",",$tags);
						$tags="";
						$itl=0;
						for($itl=0; $itl<count($tagslist); $itl++){
							$tags.="<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/tag/".converter($properties,$tagslist[$itl],'url','to')."\">".$tagslist[$itl]."</a> ";
						}
				
						echo "Tags: " . $tags;
					echo "</div>";
					
				echo "</div>";
				
			echo "</div>";
			
		echo "</div>";
		echo "<br />";
		/* END BUILDING PNAME LIST */
	break;
	
	case 'comment':
		/* FOR COMMENTS */		
		//make dateandtime
		//0000-00-00
		//0123456789
		
		$pname_comment_year  = substr($dateandtime,0,4);
		$pname_comment_month = substr($dateandtime,5,2);
		$pname_comment_day   = substr($dateandtime,8,2);
		
		if($pname_comment_month=="01"){$pname_comment_month_full="Jan";}
		if($pname_comment_month=="02"){$pname_comment_month_full="Feb";}
		if($pname_comment_month=="03"){$pname_comment_month_full="Mar";}
		if($pname_comment_month=="04"){$pname_comment_month_full="Apr";}
		if($pname_comment_month=="05"){$pname_comment_month_full="May";}
		
		if($pname_comment_month=="06"){$pname_comment_month_full="Jun";}
		if($pname_comment_month=="07"){$pname_comment_month_full="Jul";}
		if($pname_comment_month=="08"){$pname_comment_month_full="Aug";}
		if($pname_comment_month=="09"){$pname_comment_month_full="Sep";}
		if($pname_comment_month=="10"){$pname_comment_month_full="Oct";}
		if($pname_comment_month=="11"){$pname_comment_month_full="Nov";}
		if($pname_comment_month=="12"){$pname_comment_month_full="Dec";}
		
		//convert dateandtime into a better looking string
		$dateandtime = $pname_comment_month . " " . $pname_comment_day . ", " . $pname_comment_year;
		$dateandtime_m = $pname_comment_month;
		$dateandtime_m_full = $pname_comment_month_full;
		$dateandtime_d = $pname_comment_day;
		$dateandtime_y = $pname_comment_year;
				
		/* START BUILDING THE PNAME LIST */
		echo "<div id=\"module-container\">";
			
			echo "<div id=\"module-container-crow\">";
										
				echo "<div id=\"module-container-lcol\">";					
					
						echo "<div id=\"module-full-a-container-date\">";
						echo $dateandtime_d." ".$dateandtime_m_full.", ".$dateandtime_y;
						echo "</div>";
					
					//the commenter
					echo "<div id=\"module-full-a-container-author\">";
						echo $yname;
					echo "</div>";
										
				echo "</div>";
				
				echo "<div id=\"module-container-rcol\">";
					
					//the title
					$GET_TITLE_OF_ENTRY=mysql_query("SELECT * FROM {$properties->DB_PREFIX}".$pname."_entries WHERE id='$entry_id'");
					$FETCH_TITLE_OF_ENTRY=mysql_fetch_array($GET_TITLE_OF_ENTRY);
					$title_of_entry=$FETCH_TITLE_OF_ENTRY['title'];
					$dateandtime_entry=$FETCH_TITLE_OF_ENTRY['dateandtime'];
					$dateandtime_entry_gts=$FETCH_TITLE_OF_ENTRY['dateandtime_goingtostart'];
					
					if($dateandtime_entry=="0000-00-00 00:00:00"){
						$pname_entry_year  = substr($dateandtime_entry_gts,0,4);
						$pname_entry_month = substr($dateandtime_entry_gts,5,2);
						$pname_entry_day   = substr($dateandtime_entry_gts,8,2);
					} else {
						$pname_entry_year  = substr($dateandtime_entry,0,4);
						$pname_entry_month = substr($dateandtime_entry,5,2);
						$pname_entry_day   = substr($dateandtime_entry,8,2);
					}
					
					echo "<div id=\"module-full-a-container-title\">";
						echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/permalink/".$pname_entry_year."/".$pname_entry_month."/".$pname_entry_day."/".converter($properties,$title_of_entry,'url','to')."#{$id}\">".$title."</a>";
					echo "</div>";
					
					//the content
					echo "<div id=\"module-full-a-container-content\">";
						$content=converter($properties,$content,'article','to');
						$content=converter($properties,$content,'basic','to');
						$content=converter($properties,$content,'ncode','to');
						echo $content;
					echo "</div>";
					
				echo "</div>";
				
			echo "</div>";
			
		echo "</div>";
		echo "<br />";
		/* END BUILDING PNAME LIST */
	break;
	
	case 'single':
		/* FOR SINGLE ROW ITEMS (EG. PORTFOLIO OR CATEGORY) */
		echo "<div id=\"module-full-container\">";
			echo "<div id=\"module-full-crow\">";										
				
				echo "<div id=\"module-full-container-lcol\">";
					echo "<h2>Name</h2>";
				echo "</div>";
								
				echo "<div id=\"module-full-container-rcol\">";					
					//the title
					echo "<div id=\"module-full-a-container-title\">";
						if($pname=="pages"){
							/* SPECIAL INSTRUCTIONS : PAGES */
							//get the lpm
							$GET_LPM=mysql_query("SELECT * FROM {$properties->DB_PREFIX}launchpads WHERE id='$lpm'");
							$FETCH_LPM=mysql_fetch_array($GET_LPM);
							$lpm=$FETCH_LPM['short'];
							echo "<a href=\"".$WEBSITE_URL.$lpm."/".$page."\">" . $pageNAME . "</a>";
						} else {
							if($display_user===true){
								echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/folio/".converter($properties,$name,'url','to')."\">" . $name . "</a>";
							} else {
								echo "<a href=\"".$WEBSITE_URL.$PADINFO."/".$pname_uri."/category/".$shortname."\">" . $name . "</a>";	
							}	
						}
					echo "</div>";																	
				echo "</div>";				
			echo "</div>";			
		echo "</div>";
		echo "<br />";
	break;
	
	case 'double':
		/* FOR MORE COMPLEX DOUBLE ROW ITEMS (EG. USERS) */
		/* START BUILDING LIST */
		echo "<div id=\"module-full-container\">";
			echo "<div id=\"module-full-crow\">";
				echo "<div id=\"module-full-container-lcol\">";
					echo "<h2>".$uname."</h2>";
				echo "</div>";
				
				echo "<div id=\"module-full-container-rcol\">";
					
					//the title
					echo "<div id=\"module-full-a-container-title\">";
						echo $fname." ".$lname;
						$GET_STAFF_TYPE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='$staff_type'") or die(''.mysql_error());
						$FETCH_STAFF_TYPE_NAME=mysql_fetch_array($GET_STAFF_TYPE_NAME);
						$staff_type=$FETCH_STAFF_TYPE_NAME['name'];
						echo "<br /><i>".$staff_type."</i>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
		echo "<br />";
		/* END BUILDING LIST */
	break;
}
?>