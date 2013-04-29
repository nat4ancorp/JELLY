<?php
//establish global vars
@$PREFIX=$properties->DB_PREFIX;
@$SESSIONID=tempSystem($properties,"getSESSION","");
$ip=$_SERVER['REMOTE_ADDR'];


/* THEME CHANGING IN ASSETS SETUP */
$THEME_ASSETS_STRING=$properties->PATH_TO_THEME_ASSETS;
if($logged==1){$REPLACEMENT_THE_ACTION="getCurrThemeNameUser";}else if($logged==0){$REPLACEMENT_THE_ACTION="getCurrThemeNameTemp";}
$NEW_PATH_TO_THEME_ASSETS=str_replace("(THEME_NAME)",Theme($properties,$REPLACEMENT_THE_ACTION,$ip,$SESSIONID),$THEME_ASSETS_STRING);

/* DETECT IF LOGGED IN AND AGREED TO TOU */
$ip=$_SERVER['REMOTE_ADDR'];
include("includes/private/attributes/logged_session.php");
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");if(mysql_num_rows($CHECK_LOGIN)<1){$logged=0;}else{$logged=1;while($FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN)){$type=$FETCH_LOGIN['type'];$head_admin=$FETCH_LOGIN['head_admin'];}}

//determine what layout it is
$GET_PAGE=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'");
$GET_SUBPAGE=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND subpage='$subpage'");
if(mysql_num_rows($GET_PAGE)<1){
		echo "An Error Occurred!";
	} else {
		if(mysql_num_rows($GET_PAGE)>0){
			//PAGE
			while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
				//pull from db
				$layout=$FETCH_PAGE['layout'];

			}
		} else if(mysql_num_rows($GET_SUBPAGE)>0){
			//SUBPAGE
			while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
				//pull from db
				$layout=$FETCH_PAGE['layout'];
			}
		}
	}
?>

<?php if($layout == "triple"){?><div id="container3"><div id="container2"><div id="container1"><?php }?>
    <?php if($layout == "double"){?><div id="container2"><div id="container1"><?php }?>
        <?php if($layout == "single"){?><div id="container1"><?php }?>
        <?php
        $GET_PAGE_LOCK=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'") or die(mysql_error());
        $GET_SUBPAGE_LOCK=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND subpage='$subpage'");
		
		$GET_PAGE=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'") or die(mysql_error());
        $GET_SUBPAGE=mysql_query("SELECT * FROM {$PREFIX}pages WHERE lp='$launchpadPN' AND subpage='$subpage'");
            if(mysql_num_rows($GET_PAGE)<1){
				/* SUBPAGE ROUTINE */
                //check for page lock
				$FETCH_PAGE_LOCK=mysql_fetch_array($GET_SUBPAGE_LOCK);
				$PAGE_LOCK=$FETCH_PAGE_LOCK['page_lock'];
				
				switch($PAGE_LOCK){
					case 'restrict all':
						
						
						if(mysql_num_rows($GET_SUBPAGE)>0){
							?>
							
							<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
							<div id="col1">
							<!-- Column one start -->
							<br />
							<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_all.png" width="100%" title="Page Locked to all" /></center>
							<!-- Column one end -->
							
							</div>
							<?php
						}
					break;

					case 'restrict non head admins':
						
						
						if(($type == "admin") && ($head_admin == "yes")){
							if(mysql_num_rows($GET_SUBPAGE)>0){
								//PAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];									
									//building the page
									?>
									<?php if($layout == "single"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />                                    
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
                                    
									</div>
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									<?php
								}
							} else if(mysql_num_rows($GET_SUBPAGE)>0){
								//SUBPAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
                                    
                                    
									</div>
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									<?php
								}
							}
						} else {
							if(mysql_num_rows($GET_SUBPAGE)>0){
								?>
								
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<br />
								<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_non_head_admins.png" width="100%" title="Page Locked to non head admins" /></center>
								<!-- Column one end -->
								
								</div>
								<?php
							}
						}
					break;

					case 'restrict non admins':
						
						
						if($type == "admin"){
							if(mysql_num_rows($GET_SUBPAGE)>0){
								//PAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									<?php
								}
							} else if(mysql_num_rows($GET_SUBPAGE)>0){
								//SUBPAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									<?php
								}
							}
						} else {
							if(mysql_num_rows($GET_SUBPAGE)>0){
								?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<br />
								<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_non_admins.png" width="100%" title="Page Locked to non admins" /></center>
								<!-- Column one end -->
								
								</div>
								<?php
							}
						}
					break;
					
					case 'restrict non amb':
						
						
						if(($type == "admin") || ($type == "beta")){
							if(mysql_num_rows($GET_SUBPAGE)>0){
								//PAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									<?php
								}
							} else if(mysql_num_rows($GET_SUBPAGE)>0){
								//SUBPAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									<?php
								}
							}
						} else {
							if(mysql_num_rows($GET_SUBPAGE)>0){
								?>
								
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<br />
								<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_non_amb.png" width="100%" title="Page Locked to non amb" /></center>
								<!-- Column one end -->
								
								</div>
								<?php
							}
						}	
					break;
					
					case 'off':
						
						
						if(mysql_num_rows($GET_SUBPAGE)>0){
							//PAGE
							while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
								//pull from db
								$created=$FETCH_PAGE['created'];
								$layout=$FETCH_PAGE['layout'];
								$content_main=$FETCH_PAGE['content_main'];
								$content_main_code=$FETCH_PAGE['content_main_code'];
								$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
				
								$content_sidebar=$FETCH_PAGE['content_sidebar'];
								$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
								$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
								
								$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
								$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
								$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
								//building the page
								?>
								<?php if($layout == "single"){?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<?php }?>
								
								<?php if($layout == "double"){?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>

                                
								<?php }?>
								
								<?php if($layout == "triple"){?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>
								<div id="col3">
								<!-- Column three start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar2;
								echo eval($content_sidebar_code2);
								echo $content_sidebar_after_code2;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column three end -->
								
								</div>                                
								<?php }?>
								<?php
							}
						} else if(mysql_num_rows($GET_SUBPAGE)>0){
							//SUBPAGE
							while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
								//pull from db
								$created=$FETCH_PAGE['created'];
								$layout=$FETCH_PAGE['layout'];
								$content_main=$FETCH_PAGE['content_main'];
								$content_main_code=$FETCH_PAGE['content_main_code'];
								$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
				
								$content_sidebar=$FETCH_PAGE['content_sidebar'];
								$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
								$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
								
								$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
								$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
								$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
								//building the page
								?>
								<?php if($layout == "single"){?>
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<?php }?>
								
								<?php if($layout == "double"){?>
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>                               
                                
								<?php }?>
								
								<?php if($layout == "triple"){?>
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>
								<div id="col3">
								<!-- Column three start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar2;
								echo eval($content_sidebar_code2);
								echo $content_sidebar_after_code2;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column three end -->
								
								</div>
                                
                                
                                
								<?php }?>
								<?php
							}
						}
					break;
				}
            } else {
				/* PAGE ROUTINE */
				//check for page lock
				$FETCH_PAGE_LOCK=mysql_fetch_array($GET_PAGE_LOCK);
				$PAGE_LOCK=$FETCH_PAGE_LOCK['page_lock'];
				
				switch($PAGE_LOCK){
					case 'restrict all':
						if(mysql_num_rows($GET_PAGE)>0){
							?>
							
							<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
							<div id="col1">
							<!-- Column one start -->
							<br />
							<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_all.png" width="100%" title="Page Locked to all" /></center>
							<!-- Column one end -->
							
							</div>
							<?php
						}
					break;

					case 'restrict non head admins':
						
						
						if(($type == "admin") && ($head_admin == "yes")){
							if(mysql_num_rows($GET_PAGE)>0){
								//PAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
                                    
                                    
                                    
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
									<?php }?>
									<?php
								}
							} else if(mysql_num_rows($GET_SUBPAGE)>0){
								//SUBPAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
									<?php }?>
									<?php
								}
							}
						} else {
							if(mysql_num_rows($GET_PAGE)>0){
								?>
								
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<br />
								<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_non_head_admins.png" width="100%" title="Page Locked to non head admins" /></center>
								<!-- Column one end -->
								
								</div>
								<?php
							}
						}
					break;

					case 'restrict non admins':
						
						
						if($type == "admin"){
							if(mysql_num_rows($GET_PAGE)>0){
								//PAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
									<?php }?>
									<?php
								}
							} else if(mysql_num_rows($GET_SUBPAGE)>0){
								//SUBPAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
									<?php }?>
									<?php
								}
							}
						} else {
							if(mysql_num_rows($GET_PAGE)>0){
								?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<br />
								<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_non_admins.png" width="100%" title="Page Locked to non admins" /></center>
								<!-- Column one end -->
								
								</div>
								<?php
							}
						}
					break;
					
					case 'restrict non amb':
						
						
						if(($type == "admin") || ($type == "mod") || ($type == "beta")){
							if(mysql_num_rows($GET_PAGE)>0){
								//PAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
									<?php }?>
									<?php
								}
							} else if(mysql_num_rows($GET_SUBPAGE)>0){
								//SUBPAGE
								while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
									//pull from db
									$created=$FETCH_PAGE['created'];
									$layout=$FETCH_PAGE['layout'];
									$content_main=$FETCH_PAGE['content_main'];
									$content_main_code=$FETCH_PAGE['content_main_code'];
									$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
					
									$content_sidebar=$FETCH_PAGE['content_sidebar'];
									$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
									$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
									
									$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
									$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
									$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
									//building the page
									?>
									<?php if($layout == "single"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "double"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<?php }?>
									
									<?php if($layout == "triple"){?>
									<div id="col1">
									<!-- Column one start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_main;
									echo eval($content_main_code);
									echo $content_main_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column one end -->
									
									</div>
									<div id="col2">
									<!-- Column two start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar;
									echo eval($content_sidebar_code);
									echo $content_sidebar_after_code;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column two end -->
									
									</div>
									<div id="col3">
									<!-- Column three start -->
									<?php 
									echo $properties->PROPS_VAR_BODYSB_WRAP_START;
									echo $content_sidebar2;
									echo eval($content_sidebar_code2);
									echo $content_sidebar_after_code2;
									echo $properties->PROPS_VAR_BODYSB_WRAP_END;
									?>
									<!-- Column three end -->
									
									</div>
									<?php }?>
									<?php
								}
							}
						} else {
							if(mysql_num_rows($GET_PAGE)>0){
								?>
								
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<br />
								<center><img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $NEW_PATH_TO_THEME_ASSETS;?>images/page_lock/locked_to_non_amb.png" width="100%" title="Page Locked to non amb" /></center>
								<!-- Column one end -->
								
								</div>
								<?php
							}
						}	
					break;
					
					case 'off':											
						if(mysql_num_rows($GET_PAGE)>0){
							//PAGE
							while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
								//pull from db
								$created=$FETCH_PAGE['created'];
								$layout=$FETCH_PAGE['layout'];
								$content_main=$FETCH_PAGE['content_main'];
								$content_main_code=$FETCH_PAGE['content_main_code'];
								$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
				
								$content_sidebar=$FETCH_PAGE['content_sidebar'];
								$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
								$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
								
								$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
								$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
								$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
								//building the page
								?>
								<?php if($layout == "single"){?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/single.css" />
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<?php }?>
								
								<?php if($layout == "double"){?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/double.css" />
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>
								<?php }?>
								
								<?php if($layout == "triple"){?>
								<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?>themes/<?php if($logged==1){/* LOGGED IN */echo Theme($properties,"getCurrThemeNameUser",$ip,$SESSIONID);}else if($logged==0){/* NOT LOGGED IN */echo Theme($properties,"getCurrThemeNameTemp",$ip,$SESSIONID);}?>/exempt/mode/triple.css" />
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>
								<div id="col3">
								<!-- Column three start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar2;
								echo eval($content_sidebar_code2);
								echo $content_sidebar_after_code2;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column three end -->
								
								</div>
								<?php }?>
								<?php
							}
						} else if(mysql_num_rows($GET_SUBPAGE)>0){
							//SUBPAGE
							while($FETCH_PAGE=mysql_fetch_array($GET_SUBPAGE)){
								//pull from db
								$created=$FETCH_PAGE['created'];
								$layout=$FETCH_PAGE['layout'];
								$content_main=$FETCH_PAGE['content_main'];
								$content_main_code=$FETCH_PAGE['content_main_code'];
								$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
				
								$content_sidebar=$FETCH_PAGE['content_sidebar'];
								$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
								$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
								
								$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
								$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
								$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
								//building the page
								?>
								<?php if($layout == "single"){?>
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<?php }?>
								
								<?php if($layout == "double"){?>
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>
								<?php }?>
								
								<?php if($layout == "triple"){?>
								<div id="col1">
								<!-- Column one start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_main;
								echo eval($content_main_code);
								echo $content_main_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column one end -->
								
								</div>
								<div id="col2">
								<!-- Column two start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar;
								echo eval($content_sidebar_code);
								echo $content_sidebar_after_code;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column two end -->
								
								</div>
								<div id="col3">
								<!-- Column three start -->
								<?php 
								echo $properties->PROPS_VAR_BODYSB_WRAP_START;
								echo $content_sidebar2;
								echo eval($content_sidebar_code2);
								echo $content_sidebar_after_code2;
								echo $properties->PROPS_VAR_BODYSB_WRAP_END;
								?>
								<!-- Column three end -->
								
								</div>
								<?php }?>
								<?php
							}
						}
					break;
				}
            }
        ?>
        <?php if($layout == "single"){?></div><?php }?>
    <?php if($layout == "double"){?></div></div><?php }?>
<?php if($layout == "triple"){?></div></div></div><?php }?>
<?php
/* UPDATE PAGE VISITS COUNTER */
mysql_query("UPDATE {$properties->DB_PREFIX}pages SET visits = visits+1 WHERE page='$page' AND lp='$launchpadPN'");

/* UPDATE LAST KNOWN IP */
mysql_query("UPDATE {$properties->DB_PREFIX}pages SET last_known_ip = '$ip' WHERE page='$page' AND lp='$launchpadPN'");
?>