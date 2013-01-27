<?php
function featured($properties,$type,$launchpad){
	switch($type){
		case 'full':
			?>
            <script type="text/javascript">
				$(window).load(function(){
					$('#featured').orbit({
						 animation: 'horizontal-push',		// fade, horizontal-slide, vertical-slide, horizontal-push
						 animationSpeed: 800,    			// how fast animtions are
						 timer: true, 			 			// true or false to have the timer
						 advanceSpeed: 6000, 		 		// if timer is enabled, time between transitions 
						 pauseOnHover: true, 		 		// if you hover pauses the slider
						 startClockOnMouseOut: true, 	 	// if clock should start on MouseOut
						 startClockOnMouseOutAfter: 1000, 	// how long after MouseOut should the timer start again
						 directionalNav: true, 		 		// manual advancing directional navs
						 captions: false, 			 		// do you want captions?
						 captionAnimation: 'fade', 		 	// fade, slideOpen, none
						 captionAnimationSpeed: 800, 	 	// if so how quickly should they animate in
						 bullets: true,			 			// true or false to activate the bullet navigation
						 bulletThumbs: false,		 		// thumbnails for the bullets
						 bulletThumbLocation: 'orbit/', 	// location from this file where thumbs will be
						 afterSlideChange: function(){} 	// empty function 								
					});
				});
			</script>
            <div id="featured"> 
            	<?php
				/* CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
				/* check blog */
				$CHECK_FOR_FEATURED_TICKS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}blog_entries WHERE featured='yes' ORDER BY dateandtime DESC");
				if(mysql_num_rows($CHECK_FOR_FEATURED_TICKS)<1){
					/* NO BLOG FEATURED CONTENTS */	
				} else {
					while($FETCH_FEATURED=mysql_fetch_array($CHECK_FOR_FEATURED_TICKS)){
						echo "<a href=\"".$properties->WEBSITE_URL.$launchpad."/blog/permalink/".$FETCH_FEATURED['date_year']."/".$FETCH_FEATURED['date_month']."/".$FETCH_FEATURED['date_day']."/".converter($properties,$FETCH_FEATURED['title'],"url","to")."\"><img src=\"".$properties->WEBSITE_URL."includes/private/bin/uploads/".$FETCH_FEATURED['featured_image']."\" data-caption=\"#htmlCaption\" width=\"912\" height=\"200\" alt=\"Overflow: Hidden No More\" /></a>";
					}
				}
				/* end check blog */
				
				/* END CHECK ALL THE VARIOUS PLACES FOR FEATURED CONTENT */
				?>
			</div>
            <!-- Captions for Orbit -->
			<span class="orbit-caption" id="htmlCaption"></span>
            <?php
			return;
		break;
		
		case 'mini':
			?>
            This is to create perspective to the pages by adding a neat little animation jQuery thingy...
            <?php
			return;
		break;
	}
}
?>