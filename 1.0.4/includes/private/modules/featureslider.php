<?php
$PREFIX=$properties->DB_PREFIX;
$GET_PAGE_LOCK=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'") or die(mysql_error());
$GET_SUBPAGE_LOCK=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND subpage='$subpage'");
//check for page lock
$FETCH_PAGE_LOCK=mysql_fetch_array($GET_SUBPAGE_LOCK);
$PAGE_LOCK=$FETCH_PAGE_LOCK['page_lock'];
switch($PAGE_LOCK){
	case 'restrict all':
		/* PAGE LOCK ACTIVATED */
	break;

	case 'restrict non head admins':
		if(($type == "admin") && ($head_admin == "yes")){
			//check to see if feature is toggled
			$CHECK_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
			$FETCH_FEAT=mysql_fetch_array($CHECK_FEAT);
			@$toggle=$FETCH_FEAT['toggle_feat'];
			if($toggle == "on"){
			?>
				<div id="featured-works">
					<div id="inner">            	
						<?php require("includes/private/attributes/featured.php");?>
                        <?php featured($properties,"full",$launchpad);?>
					</div>
				</div>
			<?php
			}
			
			//check to see if mini feature is toggled
			$CHECK_MINI_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
			$FETCH_MINI_FEAT=mysql_fetch_array($CHECK_MINI_FEAT);
			@$toggle=$FETCH_MINI_FEAT['toggle_minifeat'];
			if($toggle == "on"){
				?>			
				<div id="mini-featured-works">
					<div id="inner">            	
						<?php require("includes/private/attributes/featured.php");?>
                        <?php featured($properties,"mini",$launchpad);?>
					</div>
				</div>
				<?php
			}
		} else {
			/* PAGE LOCK ACTIVATED */
		}
	break;

	case 'restrict non admins':
		if($type == "admin"){
			//check to see if feature is toggled
			$CHECK_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
			$FETCH_FEAT=mysql_fetch_array($CHECK_FEAT);
			@$toggle=$FETCH_FEAT['toggle_feat'];
			if($toggle == "on"){
			?>
				<div id="featured-works">
					<div id="inner">            	
						<?php require("includes/private/attributes/featured.php");?>
                        <?php featured($properties,"full",$launchpad);?>
					</div>
				</div>
			<?php
			}
			
			//check to see if mini feature is toggled
			$CHECK_MINI_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
			$FETCH_MINI_FEAT=mysql_fetch_array($CHECK_MINI_FEAT);
			@$toggle=$FETCH_MINI_FEAT['toggle_minifeat'];
			if($toggle == "on"){
				?>			
				<div id="mini-featured-works">
					<div id="inner">            	
						<?php require("includes/private/attributes/featured.php");?>
                        <?php featured($properties,"mini",$launchpad);?>
					</div>
				</div>
				<?php
			}
		} else {
			/* PAGE LOCK ACTIVATED */
		}
	break;
	
	case 'restrict non amb':
		if(($type == "admin") || ($type == "mod") || ($type == "beta")){
			//check to see if feature is toggled
			$CHECK_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
			$FETCH_FEAT=mysql_fetch_array($CHECK_FEAT);
			@$toggle=$FETCH_FEAT['toggle_feat'];
			if($toggle == "on"){
			?>
				<div id="featured-works">
					<div id="inner">            	
						<?php require("includes/private/attributes/featured.php");?>
                        <?php featured($properties,"full",$launchpad);?>
					</div>
				</div>
			<?php
			}
			
			//check to see if mini feature is toggled
			$CHECK_MINI_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
			$FETCH_MINI_FEAT=mysql_fetch_array($CHECK_MINI_FEAT);
			@$toggle=$FETCH_MINI_FEAT['toggle_minifeat'];
			if($toggle == "on"){
				?>			
				<div id="mini-featured-works">
					<div id="inner">            	
						<?php require("includes/private/attributes/featured.php");?>
	                    <?php featured($properties,"mini",$launchpad);?>
					</div>
				</div>
				<?php
			}
		} else {
			/* PAGE LOCK ACTIVATED */
		}
	break;
	
	case 'off':
		//check to see if feature is toggled
		$CHECK_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
		$FETCH_FEAT=mysql_fetch_array($CHECK_FEAT);
		@$toggle=$FETCH_FEAT['toggle_feat'];
		if($toggle == "on"){
		?>
			<div id="featured-works">
				<div id="inner">            	
					<?php require("includes/private/attributes/featured.php");?>
                    <?php featured($properties,"full",$launchpad);?>
				</div>
			</div>
		<?php
		}
		
		//check to see if mini feature is toggled
		$CHECK_MINI_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
		$FETCH_MINI_FEAT=mysql_fetch_array($CHECK_MINI_FEAT);
		@$toggle=$FETCH_MINI_FEAT['toggle_minifeat'];
		if($toggle == "on"){
			?>			
			<div id="mini-featured-works">
				<div id="inner">            	
					<?php require("includes/private/attributes/featured.php");?>
	                <?php featured($properties,"mini",$launchpad);?>
				</div>
			</div>
			<?php
		}
	break;
}
?>