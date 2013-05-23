<?php
function featured($properties,$type,$launchpad,$page){
	if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;}
	switch($type){
		case 'full':
			?>
            <script type="text/javascript">
				$(window).load(function(){
					$('#featured').orbit({
						 animation: '<?php echo getGlobalVars($properties,"oani");?>', 		// fade, horizontal-slide, vertical-slide, horizontal-push
						 animationSpeed: 900,    											// how fast animations are
						 timer: true, 			 											// true or false to have the timer
						 advanceSpeed: 7000, 		 										// if timer is enabled, time between transitions 
						 pauseOnHover: true, 		 										// if you hover pauses the slider
						 startClockOnMouseOut: true, 	 									// if clock should start on MouseOut
						 startClockOnMouseOutAfter: 1000, 									// how long after MouseOut should the timer start again
						 directionalNav: true, 		 										// manual advancing directional navs
						 captions: true, 			 										// do you want captions?
						 captionAnimation: 'fade', 		 									// fade, slideOpen, none
						 captionAnimationSpeed: 800, 	 									// if so how quickly should they animate in
						 bullets: true,			 											// true or false to activate the bullet navigation
						 bulletThumbs: false,		 										// thumbnails for the bullets
						 bulletThumbLocation: 'orbit/', 									// location from this file where thumbs will be
						 afterSlideChange: function(){} 									// empty function 								
					});
				});
			</script>
            <?php
			
			/* DISPLAY BASED ON WHAT LAUNCHPAD */
			switch($launchpad){
				case $properties->PADMAIN:				
				echo "<div id=\"featured\">";             	
					/* CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
					if($page=="home"){
						/* CHECK FOR ALL */
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$date_month=$FETCH_FEATURED['date_month'];
								$id=$FETCH_FEATURED['id'];
								if($date_month=="01"){$date_month_word="Jan";}
								if($date_month=="02"){$date_month_word="Feb";}
								if($date_month=="03"){$date_month_word="Mar";}
								if($date_month=="04"){$date_month_word="Apr";}
								if($date_month=="05"){$date_month_word="May";}
								if($date_month=="06"){$date_month_word="Jun";}
								if($date_month=="07"){$date_month_word="Jul";}
								if($date_month=="08"){$date_month_word="Aug";}
								if($date_month=="09"){$date_month_word="Sep";}
								if($date_month=="10"){$date_month_word="Oct";}
								if($date_month=="11"){$date_month_word="Nov";}
								if($date_month=="12"){$date_month_word="Dec";}
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check blog */
						
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$dateandtime=$FETCH_FEATURED['dateandtime'];
								$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
								$id=$FETCH_FEATURED['id'];
								//break apart date
								//0000-00-00 00:00:00
								//0123456789012345678
								if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
									$dateyear	= substr($dateandtime_goingtostart,0,4);
									$datemonth	= substr($dateandtime_goingtostart,5,2);
									$dateday	= substr($dateandtime_goingtostart,8,2);
									$datehour	= substr($dateandtime_goingtostart,11,2);
									$datemin	= substr($dateandtime_goingtostart,14,2);
									$datesec	= substr($dateandtime_goingtostart,17,2);
								} else {
									$dateyear	= substr($dateandtime,0,4);
									$datemonth	= substr($dateandtime,5,2);
									$dateday	= substr($dateandtime,8,2);
									$datehour	= substr($dateandtime,11,2);
									$datemin	= substr($dateandtime,14,2);
									$datesec	= substr($dateandtime,17,2);	
								}
								
								if($datemonth=="01"){$datemonth_word="Jan";}
								if($datemonth=="02"){$datemonth_word="Feb";}
								if($datemonth=="03"){$datemonth_word="Mar";}
								if($datemonth=="04"){$datemonth_word="Apr";}
								if($datemonth=="05"){$datemonth_word="May";}
								if($datemonth=="06"){$datemonth_word="Jun";}
								if($datemonth=="07"){$datemonth_word="Jul";}
								if($datemonth=="08"){$datemonth_word="Aug";}
								if($datemonth=="09"){$datemonth_word="Sep";}
								if($datemonth=="10"){$datemonth_word="Oct";}
								if($datemonth=="11"){$datemonth_word="Nov";}
								if($datemonth=="12"){$datemonth_word="Dec";}
								
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check work */
					} else {
						/* CHECK FOR SPECIFIC PAGE */
						switch($page){
							case 'blog':
							/* check blog */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$date_month=$FETCH_FEATURED['date_month'];
									$id=$FETCH_FEATURED['id'];
									if($date_month=="01"){$date_month_word="Jan";}
									if($date_month=="02"){$date_month_word="Feb";}
									if($date_month=="03"){$date_month_word="Mar";}
									if($date_month=="04"){$date_month_word="Apr";}
									if($date_month=="05"){$date_month_word="May";}
									if($date_month=="06"){$date_month_word="Jun";}
									if($date_month=="07"){$date_month_word="Jul";}
									if($date_month=="08"){$date_month_word="Aug";}
									if($date_month=="09"){$date_month_word="Sep";}
									if($date_month=="10"){$date_month_word="Oct";}
									if($date_month=="11"){$date_month_word="Nov";}
									if($date_month=="12"){$date_month_word="Dec";}
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check blog */
							break;
							
							case 'work':
							/* check work */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$dateandtime=$FETCH_FEATURED['dateandtime'];
									$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
									$id=$FETCH_FEATURED['id'];
									//break apart date
									//0000-00-00 00:00:00
									//0123456789012345678
									if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
										$dateyear	= substr($dateandtime_goingtostart,0,4);
										$datemonth	= substr($dateandtime_goingtostart,5,2);
										$dateday	= substr($dateandtime_goingtostart,8,2);
										$datehour	= substr($dateandtime_goingtostart,11,2);
										$datemin	= substr($dateandtime_goingtostart,14,2);
										$datesec	= substr($dateandtime_goingtostart,17,2);
									} else {
										$dateyear	= substr($dateandtime,0,4);
										$datemonth	= substr($dateandtime,5,2);
										$dateday	= substr($dateandtime,8,2);
										$datehour	= substr($dateandtime,11,2);
										$datemin	= substr($dateandtime,14,2);
										$datesec	= substr($dateandtime,17,2);	
									}
									
									if($datemonth=="01"){$datemonth_word="Jan";}
									if($datemonth=="02"){$datemonth_word="Feb";}
									if($datemonth=="03"){$datemonth_word="Mar";}
									if($datemonth=="04"){$datemonth_word="Apr";}
									if($datemonth=="05"){$datemonth_word="May";}
									if($datemonth=="06"){$datemonth_word="Jun";}
									if($datemonth=="07"){$datemonth_word="Jul";}
									if($datemonth=="08"){$datemonth_word="Aug";}
									if($datemonth=="09"){$datemonth_word="Sep";}
									if($datemonth=="10"){$datemonth_word="Oct";}
									if($datemonth=="11"){$datemonth_word="Nov";}
									if($datemonth=="12"){$datemonth_word="Dec";}
									
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check work */
							break;
						}
					}
					/* END CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
				echo "</div>";
				/* Captions for Orbit */
				/* CAPTION CONTENT */
				if($page=="home"){
					/* CHECK ALL */
					/* check blog */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
						{
							@$id=$FETCH_FEATURED['id'];
							@$name=$FETCH_FEATURED['name'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check blog */
					
					/* check work */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['title'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check work */
				} else {
					/* CHECK SPECIFIC */
					switch($page){
						case 'blog':
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
							{
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['name'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check blog */				
						break;
						
						case 'work':					
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['title'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check work */
						break;
					}
				}
				/* END CAPTION CONTENT */
				break;
				
				case $properties->PAD1:
				echo "<div id=\"featured\">";             	
					/* CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
					if($page=="home"){
						/* CHECK FOR ALL */					
						/* check a-z-list */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$dateandtime=$FETCH_FEATURED['dateandtime'];
									$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
									$id=$FETCH_FEATURED['id'];
									//break apart date
									//0000-00-00 00:00:00
									//0123456789012345678
									if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
										$dateyear	= substr($dateandtime_goingtostart,0,4);
										$datemonth	= substr($dateandtime_goingtostart,5,2);
										$dateday	= substr($dateandtime_goingtostart,8,2);
										$datehour	= substr($dateandtime_goingtostart,11,2);
										$datemin	= substr($dateandtime_goingtostart,14,2);
										$datesec	= substr($dateandtime_goingtostart,17,2);
									} else {
										$dateyear	= substr($dateandtime,0,4);
										$datemonth	= substr($dateandtime,5,2);
										$dateday	= substr($dateandtime,8,2);
										$datehour	= substr($dateandtime,11,2);
										$datemin	= substr($dateandtime,14,2);
										$datesec	= substr($dateandtime,17,2);	
									}
									
									if($datemonth=="01"){$datemonth_word="Jan";}
									if($datemonth=="02"){$datemonth_word="Feb";}
									if($datemonth=="03"){$datemonth_word="Mar";}
									if($datemonth=="04"){$datemonth_word="Apr";}
									if($datemonth=="05"){$datemonth_word="May";}
									if($datemonth=="06"){$datemonth_word="Jun";}
									if($datemonth=="07"){$datemonth_word="Jul";}
									if($datemonth=="08"){$datemonth_word="Aug";}
									if($datemonth=="09"){$datemonth_word="Sep";}
									if($datemonth=="10"){$datemonth_word="Oct";}
									if($datemonth=="11"){$datemonth_word="Nov";}
									if($datemonth=="12"){$datemonth_word="Dec";}
									
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/a-z-list/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/A-z-list/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
						/* end check a-z-list */
					} else {
						/* CHECK FOR SPECIFIC PAGE */
						switch($page){							
							case 'a-z-list':
							/* check a-z-list */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_af_atoz_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$dateandtime=$FETCH_FEATURED['dateandtime'];
									$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
									$id=$FETCH_FEATURED['id'];
									//break apart date
									//0000-00-00 00:00:00
									//0123456789012345678
									if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
										$dateyear	= substr($dateandtime_goingtostart,0,4);
										$datemonth	= substr($dateandtime_goingtostart,5,2);
										$dateday	= substr($dateandtime_goingtostart,8,2);
										$datehour	= substr($dateandtime_goingtostart,11,2);
										$datemin	= substr($dateandtime_goingtostart,14,2);
										$datesec	= substr($dateandtime_goingtostart,17,2);
									} else {
										$dateyear	= substr($dateandtime,0,4);
										$datemonth	= substr($dateandtime,5,2);
										$dateday	= substr($dateandtime,8,2);
										$datehour	= substr($dateandtime,11,2);
										$datemin	= substr($dateandtime,14,2);
										$datesec	= substr($dateandtime,17,2);	
									}
									
									if($datemonth=="01"){$datemonth_word="Jan";}
									if($datemonth=="02"){$datemonth_word="Feb";}
									if($datemonth=="03"){$datemonth_word="Mar";}
									if($datemonth=="04"){$datemonth_word="Apr";}
									if($datemonth=="05"){$datemonth_word="May";}
									if($datemonth=="06"){$datemonth_word="Jun";}
									if($datemonth=="07"){$datemonth_word="Jul";}
									if($datemonth=="08"){$datemonth_word="Aug";}
									if($datemonth=="09"){$datemonth_word="Sep";}
									if($datemonth=="10"){$datemonth_word="Oct";}
									if($datemonth=="11"){$datemonth_word="Nov";}
									if($datemonth=="12"){$datemonth_word="Dec";}
									
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/a-z-list/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/A-z-list/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check a-z-list */
							break;
						}
					}
					/* END CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
				echo "</div>";
				/* Captions for Orbit */
				/* CAPTION CONTENT */
				if($page=="home"){
					/* CHECK ALL */
					/* check blog */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
						{
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['name'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check blog */
					
					/* check work */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['title'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check work */
				} else {
					/* CHECK SPECIFIC */
					switch($page){
						case 'blog':
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
							{
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['name'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check blog */				
						break;
						
						case 'work':					
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['title'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check work */
						break;
					}
				}
				/* END CAPTION CONTENT */
				break;
				
				case $properties->PAD2:
				echo "<div id=\"featured\">";             	
					/* CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
					if($page=="home"){
						/* CHECK FOR ALL */
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$date_month=$FETCH_FEATURED['date_month'];
								$id=$FETCH_FEATURED['id'];
								if($date_month=="01"){$date_month_word="Jan";}
								if($date_month=="02"){$date_month_word="Feb";}
								if($date_month=="03"){$date_month_word="Mar";}
								if($date_month=="04"){$date_month_word="Apr";}
								if($date_month=="05"){$date_month_word="May";}
								if($date_month=="06"){$date_month_word="Jun";}
								if($date_month=="07"){$date_month_word="Jul";}
								if($date_month=="08"){$date_month_word="Aug";}
								if($date_month=="09"){$date_month_word="Sep";}
								if($date_month=="10"){$date_month_word="Oct";}
								if($date_month=="11"){$date_month_word="Nov";}
								if($date_month=="12"){$date_month_word="Dec";}
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check blog */
						
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$dateandtime=$FETCH_FEATURED['dateandtime'];
								$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
								$id=$FETCH_FEATURED['id'];
								//break apart date
								//0000-00-00 00:00:00
								//0123456789012345678
								if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
									$dateyear	= substr($dateandtime_goingtostart,0,4);
									$datemonth	= substr($dateandtime_goingtostart,5,2);
									$dateday	= substr($dateandtime_goingtostart,8,2);
									$datehour	= substr($dateandtime_goingtostart,11,2);
									$datemin	= substr($dateandtime_goingtostart,14,2);
									$datesec	= substr($dateandtime_goingtostart,17,2);
								} else {
									$dateyear	= substr($dateandtime,0,4);
									$datemonth	= substr($dateandtime,5,2);
									$dateday	= substr($dateandtime,8,2);
									$datehour	= substr($dateandtime,11,2);
									$datemin	= substr($dateandtime,14,2);
									$datesec	= substr($dateandtime,17,2);	
								}
								
								if($datemonth=="01"){$datemonth_word="Jan";}
								if($datemonth=="02"){$datemonth_word="Feb";}
								if($datemonth=="03"){$datemonth_word="Mar";}
								if($datemonth=="04"){$datemonth_word="Apr";}
								if($datemonth=="05"){$datemonth_word="May";}
								if($datemonth=="06"){$datemonth_word="Jun";}
								if($datemonth=="07"){$datemonth_word="Jul";}
								if($datemonth=="08"){$datemonth_word="Aug";}
								if($datemonth=="09"){$datemonth_word="Sep";}
								if($datemonth=="10"){$datemonth_word="Oct";}
								if($datemonth=="11"){$datemonth_word="Nov";}
								if($datemonth=="12"){$datemonth_word="Dec";}
								
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check work */
					} else {
						/* CHECK FOR SPECIFIC PAGE */
						switch($page){
							case 'blog':
							/* check blog */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$date_month=$FETCH_FEATURED['date_month'];
									$id=$FETCH_FEATURED['id'];
									if($date_month=="01"){$date_month_word="Jan";}
									if($date_month=="02"){$date_month_word="Feb";}
									if($date_month=="03"){$date_month_word="Mar";}
									if($date_month=="04"){$date_month_word="Apr";}
									if($date_month=="05"){$date_month_word="May";}
									if($date_month=="06"){$date_month_word="Jun";}
									if($date_month=="07"){$date_month_word="Jul";}
									if($date_month=="08"){$date_month_word="Aug";}
									if($date_month=="09"){$date_month_word="Sep";}
									if($date_month=="10"){$date_month_word="Oct";}
									if($date_month=="11"){$date_month_word="Nov";}
									if($date_month=="12"){$date_month_word="Dec";}
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check blog */
							break;
							
							case 'work':
							/* check work */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$dateandtime=$FETCH_FEATURED['dateandtime'];
									$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
									$id=$FETCH_FEATURED['id'];
									//break apart date
									//0000-00-00 00:00:00
									//0123456789012345678
									if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
										$dateyear	= substr($dateandtime_goingtostart,0,4);
										$datemonth	= substr($dateandtime_goingtostart,5,2);
										$dateday	= substr($dateandtime_goingtostart,8,2);
										$datehour	= substr($dateandtime_goingtostart,11,2);
										$datemin	= substr($dateandtime_goingtostart,14,2);
										$datesec	= substr($dateandtime_goingtostart,17,2);
									} else {
										$dateyear	= substr($dateandtime,0,4);
										$datemonth	= substr($dateandtime,5,2);
										$dateday	= substr($dateandtime,8,2);
										$datehour	= substr($dateandtime,11,2);
										$datemin	= substr($dateandtime,14,2);
										$datesec	= substr($dateandtime,17,2);	
									}
									
									if($datemonth=="01"){$datemonth_word="Jan";}
									if($datemonth=="02"){$datemonth_word="Feb";}
									if($datemonth=="03"){$datemonth_word="Mar";}
									if($datemonth=="04"){$datemonth_word="Apr";}
									if($datemonth=="05"){$datemonth_word="May";}
									if($datemonth=="06"){$datemonth_word="Jun";}
									if($datemonth=="07"){$datemonth_word="Jul";}
									if($datemonth=="08"){$datemonth_word="Aug";}
									if($datemonth=="09"){$datemonth_word="Sep";}
									if($datemonth=="10"){$datemonth_word="Oct";}
									if($datemonth=="11"){$datemonth_word="Nov";}
									if($datemonth=="12"){$datemonth_word="Dec";}
									
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check work */
							break;
						}
					}
					/* END CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
				echo "</div>";
				/* Captions for Orbit */
				/* CAPTION CONTENT */
				if($page=="home"){
					/* CHECK ALL */
					/* check blog */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
						{
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['name'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check blog */
					
					/* check work */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['title'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check work */
				} else {
					/* CHECK SPECIFIC */
					switch($page){
						case 'blog':
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
							{
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['name'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check blog */				
						break;
						
						case 'work':					
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['title'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check work */
						break;
					}
				}
				/* END CAPTION CONTENT */
				break;
				
				case $properties->PAD3:
				echo "<div id=\"featured\">";             	
					/* CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
					if($page=="home"){
						/* CHECK FOR ALL */
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$date_month=$FETCH_FEATURED['date_month'];
								$id=$FETCH_FEATURED['id'];
								if($date_month=="01"){$date_month_word="Jan";}
								if($date_month=="02"){$date_month_word="Feb";}
								if($date_month=="03"){$date_month_word="Mar";}
								if($date_month=="04"){$date_month_word="Apr";}
								if($date_month=="05"){$date_month_word="May";}
								if($date_month=="06"){$date_month_word="Jun";}
								if($date_month=="07"){$date_month_word="Jul";}
								if($date_month=="08"){$date_month_word="Aug";}
								if($date_month=="09"){$date_month_word="Sep";}
								if($date_month=="10"){$date_month_word="Oct";}
								if($date_month=="11"){$date_month_word="Nov";}
								if($date_month=="12"){$date_month_word="Dec";}
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check blog */
						
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$dateandtime=$FETCH_FEATURED['dateandtime'];
								$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
								$id=$FETCH_FEATURED['id'];
								//break apart date
								//0000-00-00 00:00:00
								//0123456789012345678
								if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
									$dateyear	= substr($dateandtime_goingtostart,0,4);
									$datemonth	= substr($dateandtime_goingtostart,5,2);
									$dateday	= substr($dateandtime_goingtostart,8,2);
									$datehour	= substr($dateandtime_goingtostart,11,2);
									$datemin	= substr($dateandtime_goingtostart,14,2);
									$datesec	= substr($dateandtime_goingtostart,17,2);
								} else {
									$dateyear	= substr($dateandtime,0,4);
									$datemonth	= substr($dateandtime,5,2);
									$dateday	= substr($dateandtime,8,2);
									$datehour	= substr($dateandtime,11,2);
									$datemin	= substr($dateandtime,14,2);
									$datesec	= substr($dateandtime,17,2);	
								}
								
								if($datemonth=="01"){$datemonth_word="Jan";}
								if($datemonth=="02"){$datemonth_word="Feb";}
								if($datemonth=="03"){$datemonth_word="Mar";}
								if($datemonth=="04"){$datemonth_word="Apr";}
								if($datemonth=="05"){$datemonth_word="May";}
								if($datemonth=="06"){$datemonth_word="Jun";}
								if($datemonth=="07"){$datemonth_word="Jul";}
								if($datemonth=="08"){$datemonth_word="Aug";}
								if($datemonth=="09"){$datemonth_word="Sep";}
								if($datemonth=="10"){$datemonth_word="Oct";}
								if($datemonth=="11"){$datemonth_word="Nov";}
								if($datemonth=="12"){$datemonth_word="Dec";}
								
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check work */
					} else {
						/* CHECK FOR SPECIFIC PAGE */
						switch($page){
							case 'blog':
							/* check blog */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$date_month=$FETCH_FEATURED['date_month'];
									$id=$FETCH_FEATURED['id'];
									if($date_month=="01"){$date_month_word="Jan";}
									if($date_month=="02"){$date_month_word="Feb";}
									if($date_month=="03"){$date_month_word="Mar";}
									if($date_month=="04"){$date_month_word="Apr";}
									if($date_month=="05"){$date_month_word="May";}
									if($date_month=="06"){$date_month_word="Jun";}
									if($date_month=="07"){$date_month_word="Jul";}
									if($date_month=="08"){$date_month_word="Aug";}
									if($date_month=="09"){$date_month_word="Sep";}
									if($date_month=="10"){$date_month_word="Oct";}
									if($date_month=="11"){$date_month_word="Nov";}
									if($date_month=="12"){$date_month_word="Dec";}
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check blog */
							break;
							
							case 'work':
							/* check work */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$dateandtime=$FETCH_FEATURED['dateandtime'];
									$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
									$id=$FETCH_FEATURED['id'];
									//break apart date
									//0000-00-00 00:00:00
									//0123456789012345678
									if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
										$dateyear	= substr($dateandtime_goingtostart,0,4);
										$datemonth	= substr($dateandtime_goingtostart,5,2);
										$dateday	= substr($dateandtime_goingtostart,8,2);
										$datehour	= substr($dateandtime_goingtostart,11,2);
										$datemin	= substr($dateandtime_goingtostart,14,2);
										$datesec	= substr($dateandtime_goingtostart,17,2);
									} else {
										$dateyear	= substr($dateandtime,0,4);
										$datemonth	= substr($dateandtime,5,2);
										$dateday	= substr($dateandtime,8,2);
										$datehour	= substr($dateandtime,11,2);
										$datemin	= substr($dateandtime,14,2);
										$datesec	= substr($dateandtime,17,2);	
									}
									
									if($datemonth=="01"){$datemonth_word="Jan";}
									if($datemonth=="02"){$datemonth_word="Feb";}
									if($datemonth=="03"){$datemonth_word="Mar";}
									if($datemonth=="04"){$datemonth_word="Apr";}
									if($datemonth=="05"){$datemonth_word="May";}
									if($datemonth=="06"){$datemonth_word="Jun";}
									if($datemonth=="07"){$datemonth_word="Jul";}
									if($datemonth=="08"){$datemonth_word="Aug";}
									if($datemonth=="09"){$datemonth_word="Sep";}
									if($datemonth=="10"){$datemonth_word="Oct";}
									if($datemonth=="11"){$datemonth_word="Nov";}
									if($datemonth=="12"){$datemonth_word="Dec";}
									
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check work */
							break;
						}
					}
					/* END CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
				echo "</div>";
				/* Captions for Orbit */
				/* CAPTION CONTENT */
				if($page=="home"){
					/* CHECK ALL */
					/* check blog */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
						{
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['name'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check blog */
					
					/* check work */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['title'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check work */
				} else {
					/* CHECK SPECIFIC */
					switch($page){
						case 'blog':
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
							{
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['name'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check blog */				
						break;
						
						case 'work':					
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['title'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check work */
						break;
					}
				}
				/* END CAPTION CONTENT */
				break;
				
				case $properties->PAD4:
				echo "<div id=\"featured\">";             	
					/* CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
					if($page=="home"){
						/* CHECK FOR ALL */
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$date_month=$FETCH_FEATURED['date_month'];
								$id=$FETCH_FEATURED['id'];
								if($date_month=="01"){$date_month_word="Jan";}
								if($date_month=="02"){$date_month_word="Feb";}
								if($date_month=="03"){$date_month_word="Mar";}
								if($date_month=="04"){$date_month_word="Apr";}
								if($date_month=="05"){$date_month_word="May";}
								if($date_month=="06"){$date_month_word="Jun";}
								if($date_month=="07"){$date_month_word="Jul";}
								if($date_month=="08"){$date_month_word="Aug";}
								if($date_month=="09"){$date_month_word="Sep";}
								if($date_month=="10"){$date_month_word="Oct";}
								if($date_month=="11"){$date_month_word="Nov";}
								if($date_month=="12"){$date_month_word="Dec";}
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check blog */
						
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO BLOG FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$dateandtime=$FETCH_FEATURED['dateandtime'];
								$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
								$id=$FETCH_FEATURED['id'];
								//break apart date
								//0000-00-00 00:00:00
								//0123456789012345678
								if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
									$dateyear	= substr($dateandtime_goingtostart,0,4);
									$datemonth	= substr($dateandtime_goingtostart,5,2);
									$dateday	= substr($dateandtime_goingtostart,8,2);
									$datehour	= substr($dateandtime_goingtostart,11,2);
									$datemin	= substr($dateandtime_goingtostart,14,2);
									$datesec	= substr($dateandtime_goingtostart,17,2);
								} else {
									$dateyear	= substr($dateandtime,0,4);
									$datemonth	= substr($dateandtime,5,2);
									$dateday	= substr($dateandtime,8,2);
									$datehour	= substr($dateandtime,11,2);
									$datemin	= substr($dateandtime,14,2);
									$datesec	= substr($dateandtime,17,2);	
								}
								
								if($datemonth=="01"){$datemonth_word="Jan";}
								if($datemonth=="02"){$datemonth_word="Feb";}
								if($datemonth=="03"){$datemonth_word="Mar";}
								if($datemonth=="04"){$datemonth_word="Apr";}
								if($datemonth=="05"){$datemonth_word="May";}
								if($datemonth=="06"){$datemonth_word="Jun";}
								if($datemonth=="07"){$datemonth_word="Jul";}
								if($datemonth=="08"){$datemonth_word="Aug";}
								if($datemonth=="09"){$datemonth_word="Sep";}
								if($datemonth=="10"){$datemonth_word="Oct";}
								if($datemonth=="11"){$datemonth_word="Nov";}
								if($datemonth=="12"){$datemonth_word="Dec";}
								
								echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
							}
						}
						/* end check work */
					} else {
						/* CHECK FOR SPECIFIC PAGE */
						switch($page){
							case 'blog':
							/* check blog */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$date_month=$FETCH_FEATURED['date_month'];
									$id=$FETCH_FEATURED['id'];
									if($date_month=="01"){$date_month_word="Jan";}
									if($date_month=="02"){$date_month_word="Feb";}
									if($date_month=="03"){$date_month_word="Mar";}
									if($date_month=="04"){$date_month_word="Apr";}
									if($date_month=="05"){$date_month_word="May";}
									if($date_month=="06"){$date_month_word="Jun";}
									if($date_month=="07"){$date_month_word="Jul";}
									if($date_month=="08"){$date_month_word="Aug";}
									if($date_month=="09"){$date_month_word="Sep";}
									if($date_month=="10"){$date_month_word="Oct";}
									if($date_month=="11"){$date_month_word="Nov";}
									if($date_month=="12"){$date_month_word="Dec";}
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Blog/".$FETCH_FEATURED['date_year']."/".$date_month_word."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check blog */
							break;
							
							case 'work':
							/* check work */
							$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
							if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
								/* NO BLOG FEATURED CONTENTS */	
							} else {
								while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
									$dateandtime=$FETCH_FEATURED['dateandtime'];
									$dateandtime_goingtostart=$FETCH_FEATURED['dateandtime_goingtostart'];
									$id=$FETCH_FEATURED['id'];
									//break apart date
									//0000-00-00 00:00:00
									//0123456789012345678
									if($dateandtime_goingtostart!="0000-00-00 00:00:00"){
										$dateyear	= substr($dateandtime_goingtostart,0,4);
										$datemonth	= substr($dateandtime_goingtostart,5,2);
										$dateday	= substr($dateandtime_goingtostart,8,2);
										$datehour	= substr($dateandtime_goingtostart,11,2);
										$datemin	= substr($dateandtime_goingtostart,14,2);
										$datesec	= substr($dateandtime_goingtostart,17,2);
									} else {
										$dateyear	= substr($dateandtime,0,4);
										$datemonth	= substr($dateandtime,5,2);
										$dateday	= substr($dateandtime,8,2);
										$datehour	= substr($dateandtime,11,2);
										$datemin	= substr($dateandtime,14,2);
										$datesec	= substr($dateandtime,17,2);	
									}
									
									if($datemonth=="01"){$datemonth_word="Jan";}
									if($datemonth=="02"){$datemonth_word="Feb";}
									if($datemonth=="03"){$datemonth_word="Mar";}
									if($datemonth=="04"){$datemonth_word="Apr";}
									if($datemonth=="05"){$datemonth_word="May";}
									if($datemonth=="06"){$datemonth_word="Jun";}
									if($datemonth=="07"){$datemonth_word="Jul";}
									if($datemonth=="08"){$datemonth_word="Aug";}
									if($datemonth=="09"){$datemonth_word="Sep";}
									if($datemonth=="10"){$datemonth_word="Oct";}
									if($datemonth=="11"){$datemonth_word="Nov";}
									if($datemonth=="12"){$datemonth_word="Dec";}
									
									echo "<a href=\"".$WEBSITE_URL.$launchpad."/work/permalink/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$WEBSITE_URL."includes/public/uploads/Work/".$dateyear."/".$datemonth_word."/".$dateday."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption_{$id}\" width=\"950\" height=\"200\" alt=\"\" /></a>";
								}
							}
							/* end check work */
							break;
						}
					}
					/* END CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
				echo "</div>";
				/* Captions for Orbit */
				/* CAPTION CONTENT */
				if($page=="home"){
					/* CHECK ALL */
					/* check blog */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
						{
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['name'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check blog */
					
					/* check work */
					$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
					if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
						/* NO FEATURED CONTENTS */	
					} else {
						while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
							$id=$FETCH_FEATURED['id'];
							$name=$FETCH_FEATURED['title'];
							?>
							<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
							<?php	
						}
					}
					return;
					/* end check work */
				} else {
					/* CHECK SPECIFIC */
					switch($page){
						case 'blog':
						/* check blog */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS))
							{
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['name'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check blog */				
						break;
						
						case 'work':					
						/* check work */
						$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}work_projects WHERE featured='yes' AND status='Published' ORDER BY dateandtime DESC");
						if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
							/* NO FEATURED CONTENTS */	
						} else {
							while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
								$id=$FETCH_FEATURED['id'];
								$name=$FETCH_FEATURED['title'];
								?>
								<span class="orbit-caption" id="htmlCaption_<?php echo $id;?>"><?php echo $name;?></span>
								<?php	
							}
						}
						return;
						/* end check work */
						break;
					}
				}
				/* END CAPTION CONTENT */
				break;
			}
		break;
	}
}
?>