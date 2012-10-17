<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/modes.css" />
<?php
/* DETECT IF LOGGED IN AND AGREED TO TOU */
$ip=$_SERVER['REMOTE_ADDR'];
$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
if(mysql_num_rows($CHECK_LOGIN)<1){
	$logged=0;
} else {
	$logged=1;
	$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
	$loggedin=$FETCH_LOGIN['loggedin'];
	$tou_s=$FETCH_LOGIN['tou_status'];
	$in_site=$FETCH_LOGIN['in_site'];
	$status=$FETCH_LOGIN['status'];
	$suspended_reason=$FETCH_LOGIN['suspended_reason'];
	if($tou_s=="agree"){$agreed=1;}else if($tou_s=="disagree"){$agreed=0;}
	$username=$FETCH_LOGIN['uname'];
	$type=$FETCH_LOGIN['type'];
	$head_admin=$FETCH_LOGIN['head_admin'];
}
if($logged==1){
	/* LOGGED IN */
	/* CHECK IF GOING TO SITE */
	if( ($in_site=="yes") ){
		//check to see the user account status
		if($status!="active"){
			if($status!="active"){
				/* SOMETHING WRONG WITH THEIR ACCOUNT STANDING */
				switch($status){				
					case 'pending':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
					
					case 'deleted':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>					
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
					
					case 'suspended':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>				
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
					
					case 'denied':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>			
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
				}
			}
		} else {
			//check for agree to tou
			if($agreed==1){
				/* AGREED */
				?>					
					<div class="wrap">
						<?php
						if($properties->TURN_ON_TOP_NAV=="yes"){
						?>
						<div id="topnavigation">
							<div id="topnav">
								<?php
								if(getGlobalVars($properties,'top_nav_use') == "toolkit"){
								
									include("includes/private/modules/toolkit.php");
									
								} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){
								
									include("includes/private/modules/topnavwithsearch.php");
								
								} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){
									
									include("includes/private/modules/topnavwithoutsearch.php");
								}
								?>
							</div>
						</div> <!-- end top navigation -->
						<?php
						} else if($properties->TURN_ON_TOP_NAV=="no") {
							/* NO TOP NAV */	
						}
						?>
					</div>
					
					<div id="container-header">
						<div id="header">
							<div id="header-row">
								<div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $properties->displayWURL();?><?php echo $launchpad;?>/home'">
									<div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
										<div class="big"><?php echo $properties->displayMainTitle();?></div>
										<?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?> 
									</div> <!-- end of #left -->
								</div> <!-- end of #header-leftcol -->
											   
								<div id="header-rightcol">
									<div id="navigation">
										<div id="nav-row">
											<?php
												/* PHP NAVIGATIN LIST MAKER FROM CLASS */
												$wurl=$properties->getWURL();
												//determine launchpad constants
												$launchpadNAME=$launchpad;
												$launchpadID=GET_LP_ID($properties,$launchpad);
												echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
											?>
										</div><!-- end of nav-row -->
									</div> <!-- end of #navigation -->      
								</div>
							</div> <!-- end of #header-row -->
						</div> <!-- end of #header -->
					</div>
					
					<div id="container">
						
						<?php
							include("includes/private/modules/featureslider.php");
						?>
						
						<!-- start of PAGE CONTENTS -->
							<?php getPageContents($launchpadID,$page,$subpage,$properties->WEBSITE_URL,$launchpadPN,$properties); ?>
						<!-- end of PAGE CONTENTS --> 
								
					</div> <!-- end of #container -->
					
					<?php
					include("includes/private/art/lower_left.php");
					?>
                    
                     
					<?php
                    include("includes/private/art/lower_right.php");
                    ?>
					
					<?php
					if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
					?>
					<div id="bottomnavigation">
						<div class="wrap-bottom">
							<div id="bottomnav">
								<div class="left">
									<ul>
									<?php
									/* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
									$wurl=$properties->getWURL();
									//determine launchpad constants
									$launchpadNAME=$launchpad;
									$launchpadID=GET_LP_ID($properties,$launchpad);
									echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
									?>
									</ul>
								</div><!-- end of #left --> 
							</div> <!-- end of #bottomnav --> 
						</div> <!-- end of .wrap -->
					</div><!-- end of #bottomnavigation -->
					<?php
					} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
						/* LEAVE BOTTOM NAV OFF */
					}
					?>
					
					<div id="footer">
						<div class="wrap">
							<div id="foot">
								<?php
								/* FUNCTIONAL TO GET THE FOOTER MODULES */
								?>
								<div class="left">
									<?php
									@$footer_section="left";
									$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE type='footer' AND footer_section='".$footer_section."' ORDER BY arr");
									if(mysql_num_rows($GET_MODULES)<1){
										echo "No modules";
									} else {
										while($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){
											$title=$FETCH_MODULES['title'];
											$toggle_title=$FETCH_MODULES['toggle_title'];
											$contents=$FETCH_MODULES['contents'];
											if($toggle_title == "off"){/* no title */}else if($toggle_title == "on"){echo "<h1>".$title."</h1>";}
											echo eval($contents);
										}
									}
									?>
								</div>
								
								<div class="mid">
								   <?php
									@$footer_section="mid";
									$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE type='footer' AND footer_section='".$footer_section."' ORDER BY arr");
									if(mysql_num_rows($GET_MODULES)<1){
										echo "No modules";
									} else {
										while($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){
											$title=$FETCH_MODULES['title'];
											$toggle_title=$FETCH_MODULES['toggle_title'];
											$contents=$FETCH_MODULES['contents'];
											if($toggle_title == "off"){/* no title */}else if($toggle_title == "on"){echo "<h1>".$title."</h1>";}
											echo eval($contents);
										}
									}
									?>
								</div>
								
								<div class="right">   
									<?php
									@$footer_section="right";
									$GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE type='footer' AND footer_section='".$footer_section."' ORDER BY arr");
									if(mysql_num_rows($GET_MODULES)<1){
										echo "No modules";
									} else {
										while($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){
											$title=$FETCH_MODULES['title'];
											$toggle_title=$FETCH_MODULES['toggle_title'];
											$contents=$FETCH_MODULES['contents'];
											$toggle_visible=$FETCH_MODULES['toggle_visible'];
											if($toggle_visible == "off"){/* MODULE TURNED OFF */}else{if($toggle_title == "off"){/* no title */}else if($toggle_title == "on"){echo "<h1>".$title."</h1>";}echo eval($contents);}}
									}
									?>
								</div>
								<?php
								/* END FUNCTIONAL TO GET THE FOOTER MODULES */
								?>
								<div id="lower">
								<a href="<?php echo $properties->WEBSITE_URL.$properties->PADMAIN;?>/privacy">Privacy</a>
								&nbsp;
								<a href="<?php echo $properties->WEBSITE_URL.$properties->PADMAIN;?>/disclaimer">Disclaimer</a>
								&nbsp;
								<a href="<?php echo $properties->WEBSITE_URL.$properties->PADMAIN;?>/affiliates">Affiliates</a>
								&nbsp;
								copyright &copy; 2012. <a href="<?php echo $properties->getFULLWURL();?>"><?php echo $properties->displayCName();?></a>
								&nbsp;
								Nathan Smyth. Freelance Web Designer. San Antonio, TX Area. (210) 863 8843
								</div> <!-- end of #lower -->
							 </div> <!-- end of #foot -->
						 </div> <!-- end of .wrap -->
					 </div> <!-- end of #footer -->
				<?php
			} else if($agreed==0){
				/* DISAGREED */
				?>
				
				<div id="splash-container3">
					<div id="splash-container2">
						<div id="splash-container1">
							<div id="splash-col1">
								
							</div>
							
							<div id="splash-col2">
								<div id="top">
										<?php echo $globalvars_passpage_title;?>
										<?php echo $globalvars_passpage_slogan;?>
										<?php echo $globalvars_passpage_closed_st;?>
								</div>
								<div id="mid">
									<?php
									//get necessary stuff
									$ip=$_SERVER['REMOTE_ADDR'];
									$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
									
									//check for logged in status
									$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
									$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
									$fname=$FETCH_LOGIN['fname'];
									$username=$FETCH_LOGIN['uname'];
									$lname=$FETCH_LOGIN['lname'];
									$type=$FETCH_LOGIN['type'];
									$tou_status=$FETCH_LOGIN['tou_status'];
									?>
									<div id="mid-table">
										<div class="mid-table-row">
											<div id="mid-table-leftcol">
											
											</div>
											<div id="mid-table-midcol">
												<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Admin Access Control Panel</h1>
											</div>
											<div id="mid-table-rightcol">
											
											</div>
										</div>
										
										<div class="mid-table-row">
											<div id="mid-table-leftcol">
											
											</div>
											<div id="mid-table-midcol">
												<?php											
												if(isset($_POST['set_tou'])){
													/* POST ACTION FOR TOU */
													//get post elements
													$agree_status="unchecked";
													$disagree_status="unchecked";
													$set_tou=$_POST['tou'];
													
													if($set_tou=="agree"){
														/* agreed to tou */
														$error_console="";
														
													} else if($set_tou=="disagree") {
														/* disagreed to tou */
														$error_console="You must agree to the Terms of Use before you go in";
													} else {
														$error_console="You must respond before you go in";
													}
													 
													if($error_console!=""){
														/* FAILED */
														echo $error_console;
														
													} else {
														/* PASSED */
														//update user
														mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
														echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
													}
													
												} else {
													/* TOU BAD */
													?>
													Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
													<br /><br />
													<form action="" method="post">
														<div id="formLayoutTable">
															<div class="formLayoutTableRow">
																<div class="formLayoutTableRowLeftCol">
																	<label>Your response</label>
																</div>
																<div class="formLayoutTableRowLeftCol">
																	<input type="hidden" name="wtd" value="enter_site" />
																	<input type="radio" name="tou" value="agree" /> I agree
																	<input type="radio" name="tou" value="disagree" /> I disagree
																	
																</div>
															</div>                   
															<br />
															<div class="formLayoutTableRow">
																<div class="formLayoutTableRowLeftCol">
																	
																</div>
																<div class="formLayoutTableRowRightCol">
																	<input type="submit" name="set_tou" value="Enter" class="submit" />
																</div>
															</div>
														</div>
													</form>
													<?php
												}
												?>
											</div>
											<div id="mid-table-rightcol">
											
											</div>
										</div>
										
										<div class="mid-table-row">
											<div id="mid-table-leftcol">
											
											</div>
											<div id="mid-table-midcol">
												<a href="javascript:history.go(-1)" class="white">Back</a>
											</div>
											<div id="mid-table-rightcol">
											
											</div>
										</div>
									</div>
								</div>
								<div id="bottom">
									<br />
									<center>
									<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>			
									</center>
								</div>
							</div>
							
							<div id="splash-col3">
								
							</div>
						</div>
					</div>
				
				</div> 
				<?php
			}
		}
	} else {
		if($status!="active"){
			if($status!="active"){
				/* SOMETHING WRONG WITH THEIR ACCOUNT STANDING */
				switch($status){				
					case 'pending':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>				
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
					
					case 'deleted':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>			
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
					
					case 'suspended':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>		
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
					
					case 'denied':
					?>
					<div id="splash-container3">
						<div id="splash-container2">
							<div id="splash-container1">
								<div id="splash-col1">
									
								</div>
								
								<div id="splash-col2">
									<div id="top">
											<?php echo $globalvars_passpage_title;?>
											<?php echo $globalvars_passpage_slogan;?>
											<h2 style="font-size:48px;text-align:center;position:relative;top:10px;">(Closed BETA)</h2>
									</div>
									<div id="mid">
										<?php
										//get necessary stuff
										$ip=$_SERVER['REMOTE_ADDR'];
										$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
										
										//check for logged in status
										$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.5em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Closed BETA Member Access Event Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php											
													if(isset($_POST['set_tou'])){
														/* POST ACTION FOR TOU */
														//get post elements
														$agree_status="unchecked";
														$disagree_status="unchecked";
														$set_tou=$_POST['tou'];
														
														if($set_tou=="agree"){
															/* agreed to tou */
															$error_console="";
															
														} else if($set_tou=="disagree") {
															/* disagreed to tou */
															$error_console="You must agree to the Terms of Use before you go in";
														} else {
															$error_console="You must respond before you go in";
														}
														 
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															
														} else {
															/* PASSED */
															//update user
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE uname='$username'");
															echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
														}
														
													} else {
														/* TOU BAD */
														?>
														Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
														<br /><br />
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Your response</label>
																	</div>
																	<div class="formLayoutTableRowLeftCol">
																		<input type="hidden" name="wtd" value="enter_site" />
																		<input type="radio" name="tou" value="agree" /> I agree
																		<input type="radio" name="tou" value="disagree" /> I disagree
																		
																	</div>
																</div>                   
																<br />
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="set_tou" value="Enter" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php
													}
													?>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
									</div>
									<div id="bottom">
										<br />
										<center>
										<?php
										/* LOAD DYNAMICALLY-UPDATED LINK FILE */
										include("includes/private/tools/spashlinks.php");
										?>		
										</center>
									</div>
								</div>
								
								<div id="splash-col3">
									
								</div>
							</div>
						</div>
					
					</div> 
					<?php
					break;
				}
			}
		} else {
			?>
			<div id="splash-container3">
				<div id="splash-container2">
					<div id="splash-container1">
						<div id="splash-col1">
							
						</div>
						
						<div id="splash-col2">
							<div id="top">
									<?php echo $globalvars_passpage_title;?>
									<?php echo $globalvars_passpage_slogan;?>
									<?php echo $globalvars_passpage_closed_st;?>
							</div>
							<div id="mid">
								
								
								<?php
								if( (isset($_POST['login'])) || ($_GET['page']=="forgotusername") || ($_GET['page']=="forgotpassword") || ($_GET['page']=="request") || ($_GET['page']=="control") || (isset($_POST['logout'])) ){
									if((isset($_POST['login'])) || (isset($_POST['logout']))){
										if(isset($_POST['login'])){
											/* LOGIN ACCESS */
											?>
											<div id="mid-table">
												<div class="mid-table-row">
													<div id="mid-table-leftcol">
													
													</div>
													<div id="mid-table-midcol">
														<h1 style="font-size:20px;line-height: 1.8em;"><br /><br /><br />Logging in to <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
													</div>
													<div id="mid-table-rightcol">
													
													</div>
												</div>
												
												<div class="mid-table-row">
													<div id="mid-table-leftcol">
													
													</div>
													<div id="mid-table-midcol">
														<?php
														//get the $_POST variables
														$username=$_POST['username'];
														$password=$_POST['password'];
														$ip=$_SERVER['REMOTE_ADDR'];
														
														//check for username in db
														$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
														if(mysql_num_rows($CHECK_USERNAME)<1){
															/* user not there */
															$error_console="<b>{$username}</b> does not exist on our server";
														} else {
															$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
															$status=$FETCH_USERNAME['status'];
															$suspended_reason=$FETCH_USERNAME['suspended_reason'];
																											
															switch($status){
																case 'active':
																	$error_console="";
																break;
																case 'pending':
																	$error_console="<b>{$username}</b> is a new user and it currently being reviewed at the moment";
																break;
																case 'deleted':
																	$error_console="<b>{$username}</b> does not exist on our server";
																break;
																case 'suspended':
																	$error_console="<b>{$username}</b> has been suspended due to <b>{$suspended_reason}</b>";
																break;
															}
														}
														
														//check the password
														$CHECK_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
														if(mysql_num_rows($CHECK_PASSWORD)<1){
															/* not a user */
														} else {
															$FETCH_PASSWORD=mysql_fetch_array($CHECK_PASSWORD);
															$db_upass=$FETCH_PASSWORD['upass'];
															if(hash('sha256',md5(sha1($password)))!=$db_upass){
																$error_console="The password you entered does not match with what is on file";
															} else {
																//logged them in
															}
														}
														
														//check if user is logged in
														$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
														$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
														if($FETCH_IP['loggedin']=="yes"){/*USER IS LOGGED IN*/$error_console="<b>{$username}</b> is already logged in. If this is your account and you do not think you are logged in: chances are you forgot to log out the last time you were on this site. To log yourself out, please <form action=\"\" method=\"post\"><input type=\"hidden\" name=\"logoutusername\" value=\"".$username."\"><input type=\"submit\" name=\"logout\" value=\"click here\"></form>NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href=\"forgotpassword\" class=\"white\">here</a>";}	
														
														//check for blanks
														if($password==""){$error_console="Password is missing";}
														if($username==""){$error_console="Username is missing";}
														
														//check the error console
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
														} else {
															/* PASSED */
															//make logged session id
															$lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));
															
															//set session cookie that will expire in 20 years (it's ok)
															setcookie($properties->_COOKIE_INIT_SESSION,$lsessionid,(time() + (20 * 365 * 24 * 60 * 60)),"/");
															
															//get dateand time
															//0000-00-00 00:00:00
															$dateandtime=date("Y-m-d H:i:s");
															
															//update the db
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$username'");
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$username'");
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$username'");
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$username'");
															
															echo "<br />You have been successfully logged in!<br />Click <a href=\"".$properties->WEBSITE_URL."\" class=\"white\">here</a> to go to your Admin Panel";
														}
														?>
													</div>
													<div id="mid-table-rightcol">
														
													</div>
												</div>
												
												<div class="mid-table-row">
													<div id="mid-table-leftcol">
													
													</div>
													<div id="mid-table-midcol">
														
													</div>
													<div id="mid-table-rightcol">
													
													</div>
												</div>
											</div>
											<?php
										} else if(isset($_POST['logout'])){
											/* LOGOUT ACCESS */
											?>
											<div id="mid-table">
												<div class="mid-table-row">
													<div id="mid-table-leftcol">
													
													</div>
													<div id="mid-table-midcol">
														<h1 style="font-size:20px;line-height: 1.8em;"><br /><br /><br /><br />Logging out of <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
													</div>
													<div id="mid-table-rightcol">
													
													</div>
												</div>
												
												<div class="mid-table-row">
													<div id="mid-table-leftcol">
													
													</div>
													<div id="mid-table-midcol">
														<?php			
														//get user
														$username=$_POST['logoutusername'];
														
														if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}
														
														//check the error console
														if($error_console!=""){
															/* FAILED */
															echo $error_console;
															echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
														} else {
															/* PASSED */
															
															//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
															setcookie($properties->_COOKIE_INIT_SESSION,$lsessionid,(time() - (20 * 365 * 24 * 60 * 60)),"/");
																				
															//update the db
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
															mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
																											
															echo "<br />You have been successfully logged out!<br /><a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Go home</a>";
														}
														?>
													</div>
													<div id="mid-table-rightcol">
														
													</div>
												</div>
												
												<div class="mid-table-row">
													<div id="mid-table-leftcol">
													
													</div>
													<div id="mid-table-midcol">
														
													</div>
													<div id="mid-table-rightcol">
			
													
													</div>
												</div>
											</div>
											<?php
										}
										
									} else {
										switch($_GET['page']){
			
											case 'control':
												//get necessary stuff
												$ip=$_SERVER['REMOTE_ADDR'];
												$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
												
												//check for logged in status
												$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
												if(mysql_num_rows($CHECK_LOGIN)<1){
													?>
														<div id="mid-table">
															<div class="mid-table-row">
																<div id="mid-table-leftcol">
																
																</div>
																<div id="mid-table-midcol">
																	<h1 style="font-size:36px;line-height: 1em;"><br />Admin Access</h1>
																	Use this form to login to the Admin Controls for this Flood Gate. Once logged in, you will be able to change everything about how this flood gate works.
																	<br /><br />
																</div>
																<div id="mid-table-rightcol">
																
																</div>
															</div>
															
															<div class="mid-table-row">
																<div id="mid-table-leftcol">
																
																</div>
																<div id="mid-table-midcol">
																	<form action="" method="post">
																		<div id="formLayoutTable">
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					<label>Username</label>
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="text" name="username" value="" />
																				</div>
																			</div>
																		   
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					<label>Password</label>
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="password" name="password" value="" />
																				</div>
																			</div>
																			
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="submit" class="submit" name="login" value="Login" />
																				</div>
																			</div>
																		</div>
																	</form>
																</div>
																<div id="mid-table-rightcol">
																	
																</div>
															</div>
															
															<div class="mid-table-row">
																<div id="mid-table-leftcol">
																
																</div>
																<div id="mid-table-midcol">
																   <?php
																	$max_positions=getGlobalVars($properties,'max_admin_positions');
																	//get the number of users
																	$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
																	$num_of_users=mysql_num_rows($GET_USERS);
																	$num_of_pos_left=$max_positions - $num_of_users;
																	if($num_of_pos_left<0){$num_of_pos_left=0;}
																	?>
																	<br />
																	<?php if($num_of_pos_left<1){?><h1 style="font-size:26px;">We have <?php echo $num_of_pos_left;?> positions open...:(</h1><?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?><h1>We have <?php echo $num_of_pos_left;?> position open!</h1><?php }else if($num_of_pos_left>1){?><h1>We have <?php echo $num_of_pos_left;?> positions open!!!</h1><?php }?>
																	<a class="white" href="forgotusername">Forget Username?</a> | <a class="white" href="forgotpassword">Forget Password?</a> | <?php if($num_of_pos_left<1){?><a class="white" style="text-decoration:line-through;cursor:help;" title="There are no positions open so this link is not accessible">Request Access</a><?php }else{?><a class="white" href="request">Request Access</a><?php }?>
																</div>
																<div id="mid-table-rightcol">
																
																</div>
															</div>
														</div>
														<?php
												} else {
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<h1 style="font-size:36px;line-height: 1em;"><br />Admin Access</h1>
																<br /><br />
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																YOU ARE CURRENTLY LOGGED IN
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
															   <br />
															   <a href="../" class="white">Go home</a>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												}
											break;
											case 'forgotusername':
											if( isset($_POST['recover']) || isset($_POST['theanswer']) ){
												if(isset($_POST['recover'])){
													/* RECOVERY GENERAL */
													/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
															<?php
															//search for email in db
															$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='".$_POST['email']."'");
															?>
															<h1 style="font-size:20px;line-height: 1.8em;">
															<?php 
															if(($_POST['email']=="") || (CHECK_EMAIL($_POST['email'])==false)){
																echo "<br /><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.";
															} else {
																if(mysql_num_rows($FIND_EMAIL)<1){
																	echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['email']}&quot;";
																} else{
																	echo "<br />Security Information<br />We found an email matching<br />&quot;".$_POST['email']."&quot;<br />Now answer your Security Question to obtain your username:";
																}
															}															
																?></h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<?php
																//get $_POST data
																$email=$_POST['email'];												
																
																//search for email in db
																$FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
																if(mysql_num_rows($FIND_EMAIL)<1){
																	/* DID NOT FIND EMAIL */
																	$error_console="<b>{$email}</b> was not found on our server";
																} else {
																	/* FOUND EMAIL */
																	$FETCH_EMAIL_STATS=mysql_fetch_array($FIND_EMAIL);
																	$sqid=$FETCH_EMAIL_STATS['security_question'];
																	if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}
																	
																	//check security
																	?>
																	<form action="" method="post">
																		<div id="formLayoutTable">
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					<label>Security Question</label>
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<?php
																					$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
																					if(mysql_num_rows($GET_SQS)<1){
																						/* something went wrong */
																					} else {
																						$FETCH_SQS=mysql_fetch_array($GET_SQS);
																						$sqvalue=$FETCH_SQS['value'];
																						$is_auto_q=$FETCH_SQS['is_auto_q'];
																						echo $sqvalue."?";
																					}
																					?>
																				</div>
																			</div>
																			
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<?php
																					if($is_auto_q == "yes"){
																						/* SQ NOT ASSIGNED; USED DEFAULT PIN */
																						?>
																						<input type="text" name="sapin_1" class="pin" maxlength=1 /> 
																						<input type="text" name="sapin_2" class="pin" maxlength=1 /> 
																						<input type="text" name="sapin_3" class="pin" maxlength=1 /> 
																						<input type="text" name="sapin_4" class="pin" maxlength=1 /> 
																						<input type="hidden" name="email" value="<?php echo $email;?>" />
																						<input type="hidden" name="is_auto_q" value="yes" />
																						<?php
																					} else {
																						?>
																						<input type="text" name="theanswervalue" value="" />
																						<input type="hidden" name="email" value="<?php echo $email;?>" />
																						<?php
																					}
																					?>
																				</div>
																			</div>
																			
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="submit" name="theanswer" value="Answer" class="submit" />
																				</div>
																			</div>
																		</div>
																	</form>
																	<?php
																}
																
																//check for valid email
																if(CHECK_EMAIL($email)==false){$error_console="Your Email doesn't look valid";}
																
																//check for blank fields
																if($email==""){$error_console="Your Email is missing";}
																
																//check to see if there are any errors
																if($error_console != ""){
																	/* FAILED */
																	echo "<br /><br />".$error_console;
																} else {
																	/* PASSED */
																}
																?>
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<br />
																<a href="javascript:history.go(-1)" class="white">Back</a>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q']))){
													/* CHECKING SECURITY */
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
															
															<h1 style="font-size:20px;line-height: 1.8em;"><br />Security Information
															<?php
															//get $_POST variables
															$is_auto_q=$_POST['is_auto_q'];
																
															//determine which method: by pin or security question												
															if($is_auto_q == "yes") {
																//get $_POST variables
																$sapin_1=$_POST['sapin_1'];
																$sapin_2=$_POST['sapin_2'];
																$sapin_3=$_POST['sapin_3'];
																$sapin_4=$_POST['sapin_4'];
																$email=$_POST['email'];
																
																//make full length pin
																$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;
																
																//check for correct pin
																$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
																if(mysql_num_rows($GET_USER_PIN)<1){
																	
																} else {
																	$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
																	$dbpin=$FETCH_USER_PIN['pin'];
																	$username=$FETCH_USER_PIN['uname'];
																	if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
																}
																
																//check to see if pin is blank
																if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
																if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
																if($full_pin==""){$error_console="PIN is missing";}
															} else {
																/* DOING IT BY SQ */
																
																//get $_POST variables
																$theanswer=$_POST['theanswervalue'];
																$email=$_POST['email'];
			
																
																//check for correct answer
																$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
																if(mysql_num_rows($GET_USER_SA)<1){
																	
																} else {
																	$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
																	$dbsa=$FETCH_USER_SA['security_answer'];
																	$username=$FETCH_USER_SA['uname'];
																	if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
																}
																
															}
															
															
															if($error_console!=""){
																?>
																<br />Bad authentication!
																<?php	
															} else {
																?>
																<br />Successfully authenticated!
																<?php
															}
															?>
															</h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<?php													
																//check error_console
																if($error_console!=""){
																	/*FAILED*/
																	echo "<br /><br /><br /><br /><br /><br /><br />";
																	echo $error_console;
																	echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
																} else {
																	/*PASSED*/
																	echo "<br /><br /><br /><br /><br /><br /><h1>Your username is: ".$username."</h1>";
																}
																?>
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<br />
																<?php if($error_console==""){?><a href="../" class="white">Go Home</a><?php }else{?><a href="javascript:history.go(-1)" class="white">Back</a><?php }?>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												}
											} else {
												?>
												<div id="mid-table">
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
															<h1 style="font-size:20px;line-height: 1.8em;"><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.</h1>
														</div>
														<div id="mid-table-rightcol">
														
														</div>
													</div>
													
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
															<form action="" method="post">
																<div id="formLayoutTable">
																	<div class="formLayoutTableRow">
																		<div class="formLayoutTableRowLeftCol">
																			<label>Email</label>
																		</div>
																		<div class="formLayoutTableRowRightCol">
																			<input type="text" name="email" />
																		</div>
																	</div>
																	
																	<div class="formLayoutTableRow">
																		<div class="formLayoutTableRowLeftCol">
																			
																		</div>
																		<div class="formLayoutTableRowRightCol">
																			<input type="submit" class="submit" name="recover" value="Recover" />
																		</div>
																	</div>
																</div>
															</form>
														</div>
														<div id="mid-table-rightcol">
															
														</div>
													</div>
													
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
														   <br />
														   <a class="white" href="javascript:history.go(-1)">Back</a>
														</div>
														<div id="mid-table-rightcol">
														
														</div>
													</div>
												</div>
												<?php
											}
											break;
											
											case 'forgotpassword':
											if( isset($_POST['recover']) || isset($_POST['theanswer']) || (isset($_POST['savenewpassword']))){
												if(isset($_POST['recover'])){
													/* RECOVERY GENERAL */
													/* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
															<?php
															//search for email in db
															$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$_POST['username']."'");
															?>
															<h1 style="font-size:20px;line-height: 1.8em;">
															<?php 
															if($_POST['username']==""){
																echo "<br /><br />Forget your password? No problem! Fill out the form with the your username and we'll look it up for you.";
															} else {
																if(mysql_num_rows($FIND_USERNAME)<1){
																	echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['username']}&quot;";
																} else{
																	echo "<br />Security Information<br />We found a username matching<br />&quot;".$_POST['username']."&quot;<br />Now answer your Security Question to reset your password:";
																}
															}															
																?></h1>
															</div>
															<div id="mid-table-rightcol">
			
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<?php
																//get $_POST data
																$username=$_POST['username'];												
																
																//search for email in db
																$FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
																if(mysql_num_rows($FIND_USERNAME)<1){
																	/* DID NOT FIND USERNAME */
																	$error_console="<b>{$username}</b> was not found on our server";
																} else {
																	/* FOUND EMAIL */
																	$FETCH_USERNAME_STATS=mysql_fetch_array($FIND_USERNAME);
																	$sqid=$FETCH_USERNAME_STATS['security_question'];
																	if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}
																	
																	//check security
																	?>
																	<form action="" method="post">
																		<div id="formLayoutTable">
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					<label>Security Question</label>
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<?php
																					$GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
																					if(mysql_num_rows($GET_SQS)<1){
																						/* something went wrong */
																					} else {
																						$FETCH_SQS=mysql_fetch_array($GET_SQS);
																						$sqvalue=$FETCH_SQS['value'];
																						$is_auto_q=$FETCH_SQS['is_auto_q'];
																						echo $sqvalue."?";
																					}
																					?>
																				</div>
																			</div>
																			
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<?php
																					if($is_auto_q == "yes"){
																						/* SQ NOT ASSIGNED; USED DEFAULT PIN */
																						?>
																						<input type="text" name="sapin_1" class="pin" maxlength=1 /> 
																						<input type="text" name="sapin_2" class="pin" maxlength=1 /> 
																						<input type="text" name="sapin_3" class="pin" maxlength=1 /> 
																						<input type="text" name="sapin_4" class="pin" maxlength=1 /> 
																						<input type="hidden" name="username" value="<?php echo $username;?>" />
																						<input type="hidden" name="is_auto_q" value="yes" />
																						<?php
																					} else {
																						?>
																						<input type="text" name="theanswervalue" value="" />
																						<input type="hidden" name="username" value="<?php echo $username;?>" />
																						<?php
																					}
																					?>
																				</div>
																			</div>
																			
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="submit" name="theanswer" value="Answer" class="submit" />
																				</div>
																			</div>
																		</div>
																	</form>
																	<?php
																}
																													
																//check for blank fields
																if($username==""){$error_console="Your Username is missing";}
																
																//check to see if there are any errors
																if($error_console != ""){
																	/* FAILED */
																	echo "<br /><br />".$error_console;
																} else {
																	/* PASSED */
																}
																?>
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<br />
																<a href="javascript:history.go(-1)" class="white">Back</a>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												} else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q'])) || (isset($_POST['savenewpassword']))){
													/* CHECKING SECURITY */
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
															
															<h1 style="font-size:20px;line-height: 1.8em;"><br />Security Information
															<?php	
															//get $_POST variables
															$is_auto_q=$_POST['is_auto_q'];
															
															//determine which method: by pin or security question												
															if($is_auto_q == "yes") {
																//get $_POST variables
																$sapin_1=$_POST['sapin_1'];
																$sapin_2=$_POST['sapin_2'];
																$sapin_3=$_POST['sapin_3'];
																$sapin_4=$_POST['sapin_4'];
																$username=$_POST['username'];
																
																//make full length pin
																$full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;
																
																//check for correct pin
																$GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
																if(mysql_num_rows($GET_USER_PIN)<1){
																	
																} else {
																	$FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
																	$dbpin=$FETCH_USER_PIN['pin'];
			
																	$username=$FETCH_USER_PIN['uname'];
																	if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
																}
																
			
																//check to see if pin is blank												
																if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
																if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
																if($full_pin==""){$error_console="PIN is missing";}
																
															} else {
																/* DOING IT BY SQ */
																
																//get $_POST variables
																$theanswer=$_POST['theanswervalue'];
																$username=$_POST['username'];
																
																//check for correct answer
																$GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
																if(mysql_num_rows($GET_USER_SA)<1){
																	
																} else {
																	$FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
																	$dbsa=$FETCH_USER_SA['security_answer'];
																	$username=$FETCH_USER_SA['uname'];
																	if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
																}
																
															}
															
															
															if($error_console!=""){
																?>
																<br />Bad authentication!
																<?php	
															} else {
																?>
																<br />Successfully authenticated!
																<?php
															}
															?>
															</h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<?php													
																//check error_console
																if($error_console!=""){
																	/*FAILED*/
																	echo "<br /><br /><br /><br /><br /><br /><br />";
																	echo $error_console;
																	echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
																} else {
																	/*PASSED*/
																	//reset password
																	if(isset($_POST['savenewpassword'])){
																		//get $_POST data
																		$username=$_POST['username'];
																		$newpassword=$_POST['newpassword'];
																		$cnewpassword=$_POST['cnewpassword'];
																		
																		//check the last password
																		$CHECK_LAST_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
																		$FETCH_LAST_PASSWORD=mysql_fetch_array($CHECK_LAST_PASSWORD);
																		$upass=$FETCH_LAST_PASSWORD['upass'];
																		$email=$FETCH_LAST_PASSWORD['email'];
																		global $fname;
																		global $lname;
																		$fname=$FETCH_LAST_PASSWORD['fname'];
																		$lname=$FETCH_LAST_PASSWORD['lname'];
																		$gender=$FETCH_LAST_PASSWORD['gender'];
																		global $typeofuser;
																		$typeofuser=$FETCH_LAST_PASSWORD['type'];
																		
																		//make sure they are not blank and other checks
																		if(sha1($newpassword) == $upass){$error_console="You cannot use the same password. :(";}
																		if(strlen($newpassword)<6){$error_console="Your password must be at least 6 characters";}
																		if($cnewpassword!=$newpassword){$error_console="You passwords don't match";}
																		if($cnewpassword==""){$error_console="You must confirm your password";}
																		if($newpassword==""){$error_console="Your New Password is missing";}
																		
																		//check the error_console
																		if($error_console!=""){
																			echo "<br /><br /><br /><br /><br />".$error_console;
																		} else {
																			//encrypt it
																			$newpassword=hash('sha256',md5(sha1($newpassword)));
																			
																			//update database
																			mysql_query("UPDATE {$properties->DB_PREFIX}users SET upass='$newpassword' WHERE uname='$username'");
																			
																			echo "<br /><br /><br /><br /><br />Thank you! Your password has successfully been changed. We have also sent you an email to <b>{$email}</b> for your reference.";
																			
																			if(($fname=="BETA Member") || ($fname=="Admin")){if($gender=="male"){$fname="Mr.";}else if($gender=="female"){$fname="Ms.";}else if($gender=="other"){$fname="whom ever";}}
		                                                                    if($lname==$username){if($gender=="male"){$lname=$uname;;}else if($gender=="female"){$lname=$upass;}else if($gender=="other"){$lname="it may concern";}}
		                                                                    
		                                                                    //convert typeofuser
		                                                                    if($typeofuser=="admin"){$typeofuser="Admin";}
		                                                                    if($typeofuser=="beta"){$typeofuser="BETA Member";}
																			
																			//send an email with login details
																			CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_reset_password',$to,$PADINFO,$pname_uri);
																		}
																	} else {
																	?>
																	Now create your new password
																	<br /><br />
																	<form action="" method="post">
																		<div id="formLayoutTable">
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					<label>New Password</label>
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="password" name="newpassword" value="" />
																					<input type="hidden" name="username" value="<?php echo $username;?>" />
																				</div>
																			</div>
																			
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					<label>Confirm Password</label>
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="password" name="cnewpassword" value="" />
																				</div>
																			</div>
																			
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="submit" class="submit" name="savenewpassword" value="Save" />
																				</div>
																			</div>
																		</div>
																	</form>
																	<?php
																	}
																}
																?>
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<br />
																<?php if($error_console==""){?><a href="../" class="white">Go home</a><?php }else{?><a href="javascript:history.go(-1)" class="white">Back</a><?php }?>
															</div> 
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												}
											} else {
												?>
												<div id="mid-table">
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
															<h1 style="font-size:20px;line-height: 1.8em;"><br />Forget your password? No problem! Fill out the form with your username and we'll look it up for you.</h1>
														</div>
														<div id="mid-table-rightcol">
														
														</div>
													</div>
													
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
															<form action="" method="post">
																<div id="formLayoutTable">
																	<div class="formLayoutTableRow">
																		<div class="formLayoutTableRowLeftCol">
																			<label>Username</label>
																		</div>
																		<div class="formLayoutTableRowRightCol">
																			<input type="text" name="username" value="" />
																		</div>
																	</div>
																	
																	<div class="formLayoutTableRow">
																		<div class="formLayoutTableRowLeftCol">
																			
																		</div>
																		<div class="formLayoutTableRowRightCol">
																			<input type="submit" class="submit" name="recover" value="Recover" />
																		</div>
																	</div>
																</div>
															</form>
														</div>
														<div id="mid-table-rightcol">
															
														</div>
													</div>
													
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
														   <br />
														   <a class="white" href="javascript:history.go(-1)">Back</a>
														</div>
														<div id="mid-table-rightcol">
														
														</div>
													</div>
												</div>
												<?php
											}
											break;
											
											case 'request':
											if(isset($_POST['request'])){
												/* DO REQUEST PROCESS */
												?>
												<div id="mid-table">
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
															<h1 style="font-size:20px;line-height: 1.8em;"></h1>
														</div>
														<div id="mid-table-rightcol">
														
														</div>
													</div>
													
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
															<?php
															/* CHECK CONTENT */
															
															//get $_POST data
															global $username;
															global $password;															
															$username=$_POST['username'];
															$password=$_POST['password'];
															$cpassword=$_POST['cpassword'];
															$email=$_POST['email'];
															$why=$_POST['why'];
															
															$pin_1=$_POST['pin_1'];
															$pin_2=$_POST['pin_2'];
															$pin_3=$_POST['pin_3'];
															$pin_4=$_POST['pin_4'];
															
															global $full_pin;
															$full_pin=$pin_1.$pin_2.$pin_3.$pin_4;
															
															//check the pin for accuracy
															if(!is_numeric($full_pin)){$error_console="PIN must be numeric (no letters)";}
															if(strlen($full_pin)<4){$error_console="PIN is not long enough; You missed a few numbers";}
															if($full_pin==""){$error_console="PIN is missing";}
															
															//check for blanks
															if($why==""){$error_console="Why is missing";}
															//check email in db
															$CHECK_EMAIL_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email' AND status!='denied'");
															if(mysql_num_rows($CHECK_EMAIL_IN_DB)<1){/* NOT FOUND; WE'RE GOOD */$email_in_db=false;} else {/* FOUND EMAIL; BAD */$email_in_db=true;}													
															if($email_in_db == true){$error_console="<b>".$email."</b> is already in use";}
															if(CHECK_EMAIL($email) == false){$error_console="Your Email doesn't look valid";}
															if($email==""){$error_console="Your Email is missing";}
															if($cpassword==""){$error_console="You must confirm your password";}
															if($password==""){$error_console="Your Password is missing";}
															if($username==""){$error_console="Your Username is missing";}
			
															//check for passwords match
															if($password != $cpassword){$error_console="Your passwords don't match";}
															
															//check password len
															if(strlen($password)<6){$error_console="Your password must be at least 6 characters long";}
															
															//check for username avail in db
															$GET_USER_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username' AND status!='denied'");
															if(mysql_num_rows($GET_USER_IN_DB)<1){
																/* username is cleared; not in db */
															} else {												
																$error_console="{$username} is already taken";
															}											
															
															//check to see if there are any errors
															if($error_console != ""){
																/* THERE ARE ERRORS */
																echo "<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />".$error_console."</center>";
																echo " <a href=\"javascript:history.go(-1)\" class=\"white\">Go back</a>";
															} else {
																/* PASSED */
																echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Thank you for your interest in wanting to join our Admin team! We will review your application and should be able to get back to you within in 24 to 72 hours. Please be patient as bugging us will prolong the application process. :) <a href=\"../\" class=\"white\">Go Home</a>";
																//encrypt the password
																$epassword=hash('sha256',md5(sha1($password)));
																
																//get the date and time
																$dateandtime_applied=date("Y-m-d H:i:s");
																
																//put user into db
																mysql_query("INSERT INTO {$properties->DB_PREFIX}users (fname,lname,uname,upass,email,type,is_searchable,staff_type,status,pin,why,dateandtime_applied) VALUES ('ADMIN','$username','$username','$epassword','$email','admin','yes','','pending','$full_pin','$why','$dateandtime_applied')");
																
																//get user data
																
																//specials for email
																global $event_name;
																$event_name="Admin Registration";
																
																//get the headwebmaster's title
																$GET_HW_TITLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$properties->WEBMASTER_UNAME."'");
																$FETCH_HW_TITLE=mysql_fetch_array($GET_HW_TITLE);
																$staff_type=$FETCH_HW_TITLE['staff_type'];
																
																//fetch the staff type name
																$GET_TITLE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='{$staff_type}'");
																$FETCH_TITLE_NAME=mysql_fetch_array($GET_TITLE_NAME);
																global $webmaster_title;
																$webmaster_title=$FETCH_TITLE_NAME['name'];
																
																//send an email with login details
																CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_admin_registration',$to,$PADINFO,$pname_uri);
															}
															?>
														</div>
														<div id="mid-table-rightcol">
															
														</div>
													</div>
													
													<div class="mid-table-row">
														<div id="mid-table-leftcol">
														
														</div>
														<div id="mid-table-midcol">
															
														</div>
														<div id="mid-table-rightcol">
														
														</div>
													</div>
												</div>
												<?php
											} else {
												$max_positions=getGlobalVars($properties,'max_admin_positions');
												//get the number of users
												$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
												$num_of_users=mysql_num_rows($GET_USERS);
												$num_of_pos_left=$max_positions - $num_of_users;
												if($num_of_pos_left<0){$num_of_pos_left=0;}
												if($num_of_pos_left<1){
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<h1 style="font-size:28px;line-height: 1em;"><br /><br /><br /><br />Well this is embarrassing...</h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																Sorry...there are no positions available and the fact that you are here let's us know you are trying to get around the system and that is not going to look good if you want to work for us since we monitor all activity on this website. :)
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
															   <br /><a href="javascript:history.go(-1)" class="white">Back</a>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												} else {
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<h1 style="font-size:20px;line-height: 1.8em;">Use this form to submit a request to us if you want to be an admin for us</h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Username</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="text" name="username" />
																			</div>
																		</div>
																												
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Password</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="password" name="password" />
																			</div>
																		</div>
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Confirm Password</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="password" name="cpassword" />
																			</div>
																		</div>
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Email</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="text" name="email" />
																			</div>
																		</div>      
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Why?</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="text" name="why" />
																			</div>
																		</div>
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Create a PIN [<a style="cursor:pointer;" class="white" title="This is for extra security; Plus it is used to recover your username or password if you have not set up a Security Question and Answer">?</a>]</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				&nbsp;&nbsp;
																				<input type="text" name="pin_1" class="pin" maxlength=1 /> 
																				<input type="text" name="pin_2" class="pin" maxlength=1 /> 
																				<input type="text" name="pin_3" class="pin" maxlength=1 /> 
																				<input type="text" name="pin_4" class="pin" maxlength=1 /> 
																			</div>
																		</div>                         
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" class="submit" name="request" value="Request" />
																			</div>
																		</div>
																	</div>
																</form>
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
															   <br /><a href="javascript:history.go(-1)" class="white">Back</a>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php	
												}
											}
											break;
											default:
												//get necessary stuff
												$ip=$_SERVER['REMOTE_ADDR'];
												$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
												
												//check for logged in status
												$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
												if(mysql_num_rows($CHECK_LOGIN)<1){
													/* USER NOT LOGGED */
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<h1 style="font-size:20px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																The Reason we have closed this website for construction is so that no one can see what we are working on until we do the necessary checks and balances that come with building a website. We also believe that this shows progress and we like progress. :)
																
																<script>
																	$(document).ready(function() {
																		$("#progress-bar").progressbar({ value: <?php echo getGlobalVars($properties,'percent_complete');?> });
																	});
																</script>
																<div id="progress-bar"></div>
																
																If you are an Admin with <?php echo $properties->COMPANY_NAME;?> then you can click on the &quot;Control&quot; link to access a special form that allows you to login to manage this flood gate.
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<h1 style="font-size:28px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_mid');?></h1>
																<?php
																//get the launchday
																$launch_day=getGlobalVars($properties,'launch_day');
																?>
																<h1 style="font-size:48px;line-height: .5em;"><?php echo $launch_day;?></h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												} else {
													/* USER LOGGED IN */
													$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
													$fname=$FETCH_LOGIN['fname'];
													$username=$FETCH_LOGIN['uname'];
													$lname=$FETCH_LOGIN['lname'];
													$type=$FETCH_LOGIN['type'];
													$tou_status=$FETCH_LOGIN['tou_status'];
													$head_admin=$FETCH_LOGIN['head_admin'];
													?>
													<div id="mid-table">
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<h1 style="font-size:25px;line-height: 1.2em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Admin Access Control Panel</h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<h1 style="font-size:18px;line-height: 1.2em;">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</h1>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<?php
																if(isset($_POST['change_']) || isset($_POST['change_mode']) || isset($_POST['adjust_mar']) || isset($_POST['adjust_mbr']) || isset($_POST['postapc']) || isset($_POST['apc']) || isset($_POST['postmessage']) || isset($_POST['postldd']) || isset($_POST['set_tou']) || isset($_POST['rapplicant'])){
																	//get the option
																	$option=$_POST['wtd'];
																	switch($option){
																		case '':
																			/* none */
																			echo "You must select an option";
																		break;
																		case 'adjust_mar':
																			if(isset($_POST['adjust_mar'])){
																				//get post
																				$newmar=$_POST['mar'];
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																					echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																				} else {
																					/*passed*/
																					//update the datbase
																					mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_admin_positions='$newmar'");
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																			?>
																			Use of this form is to allow you as an admin to change the amount of positions open for admins
																			<form action="" method="post">
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Max Admin Rate</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="hidden" name="wtd" value="adjust_mar" />
																							<input type="number" name="mar" style="width:150px;" min="0" max="1000" value="<?php echo getGlobalVars($properties,'max_admin_positions');?>" />
																						</div>
																					</div>                   
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="adjust_mar" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php	
																			}
																		break;
																		
																		case 'adjust_mbr':
																			if(isset($_POST['adjust_mbr'])){
																				//get post
																				$newmbr=$_POST['mbr'];
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																					echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																				} else {
																					/*passed*/
																					//update the datbase
																					mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_closed_beta_positions='$newmbr'");
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																			?>
																			Use of this form is to allow you as an admin to change the amount of positions open for Closed BETA Members
																			<form action="" method="post">
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Max BETA Member Rate</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="hidden" name="wtd" value="adjust_mbr" />
																							<input type="number" name="mbr" style="width:150px;" min="0" max="1000" value="<?php echo getGlobalVars($properties,'max_closed_beta_positions');?>" />
																						</div>
																					</div>                   
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="adjust_mbr" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php	
																			}
																		break;
																		
																		case 'apc':
																			if(isset($_POST['postapc'])){
																				//get post
																				$newpc=$_POST['percent'];
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																					echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																				} else {
																					/*passed*/
																					//update the datbase
																					mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET percent_complete='$newpc'");
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																			?>
																			This form will change the mode of this entire site. Be careful when doing so, as some options might unleash this site to the public prematurely and/or take you away from this place.
																			<form action="" method="post">
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Completion</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="hidden" name="wtd" value="apc" />
																							<input type="number" step=".01" min="0" max="100" name="percent" value="<?php echo getGlobalVars($properties,'percent_complete');?>" />
																						</div>
																					</div>                   
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="postapc" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php	
																			}
																		break;
																		
																		case 'change_cmm':
																			if(isset($_POST['postmessage'])){
																				//get post
																				$newmessage=$_POST['message'];
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																					echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																				} else {
																					/*passed*/
																					//update the datbase
																					mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_mid='$newmessage'");
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																			?>
																			Use this to chance the message that gets displayed on the closed sign in the middle before the date
																			<form action="" method="post">
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Message</label>
			
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="hidden" name="wtd" value="change_cmm" />
																							<input type="text" name="message" value="<?php echo getGlobalVars($properties,'closed_message_mid');?>" />
																						</div>
																					</div>                   
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="postmessage" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php	
																			}
																		break;
																		
																		case 'change_cmt':
																			if(isset($_POST['postmessage'])){
																				//get post
																				$newmessage=$_POST['message'];
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																					echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																				} else {
																					/*passed*/
																					//update the datbase
																					mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_top='$newmessage'");
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																			?>
																			Use this to chance the message that gets displayed on the closed sign in the middle before the date
																			<form action="" method="post">
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Message</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="hidden" name="wtd" value="change_cmt" />
																							<input type="text" name="message" value="<?php echo getGlobalVars($properties,'closed_message_top');?>" />
																						</div>
																					</div>                   
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="postmessage" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php	
																			}
																		break;
																		
																		case 'change_mode':
																			if(isset($_POST['change_mode'])){
																				//get post
																				$newmode=$_POST['mode'];
																				
																				if($newmode==""){$error_console="You must select a mode";}
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																					echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																				} else {
																					/*passed*/
																					//update the datbase
																					mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET mode='$newmode'");
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																			?>
																			This form will change the mode of this entire site. Be careful when doing so, as some options might unleash this site to the public prematurely and/or take you away from this place.
																			<form action="" method="post">
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Mode</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="hidden" name="wtd" value="change_mode" />
																							<select name="mode" onchange="document.getElementById('change_mode').disabled=false;">
																								<?php
																								//detect which mode it is in
																								$mode=getGlobalVars($properties,'mode');
																								$modes="closed,alpha mode,closed beta,open beta,open,maintenance,";
																								$modes_names="Closed,Alpha Mode,Closed BETA,Open BETA,Open,Maintenance";
																								$modes_list=explode(",",$modes);
																								$modes_names_list=explode(",",$modes_names);
																								for($i=0; $i<count($modes_list)-1; $i++){
																									if($mode==$modes_list[$i]){
																										?>
																										<option selected="selected" disabled="disabled" value="<?php echo $modes_list[$i];?>"><?php echo $modes_names_list[$i];?></option>
																										<?php																			
																									} else {
																										?>
																										<option value="<?php echo $modes_list[$i];?>"><?php echo $modes_names_list[$i];?></option>
																										<?php	
																									}
																								}
																								?>
																							</select>
																						</div>
																					</div>                   
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="change_mode" id="change_mode" disabled="disabled" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php	
																			}
																		break;
																		
																		case 'change_ldd':
																			if(isset($_POST['postldd'])){
																				//get post
																				$newldd=$_POST['date'];
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																					echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																				} else {
																					/*passed*/
																					//update the datbase
																					mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET launch_day='$newldd'");
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																			?>
																			This will change the Launch Day Date that displays on the closed page. The format is XX/XX/XXXX where X's can represent Question Marks (?).
																			<form action="" method="post">
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Launch Day Date</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="hidden" name="wtd" value="change_ldd" />
																							<input type="text" maxlength="10" name="date" value="<?php echo getGlobalVars($properties,'launch_day');?>" />
																						</div>
																					</div>                   
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="postldd" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php	
																			}
																		break;			
																		
																		case 'enter_site':
																			if(isset($_POST['set_tou'])){
																				/* POST ACTION FOR TOU */
																				//get post elements
																				$agree_status="unchecked";
																				$disagree_status="unchecked";
																				$set_tou=$_POST['tou'];
																				
																				if($set_tou=="agree"){
																					/* agreed to tou */
																					$error_console="";
																					
																				} else if($set_tou=="disagree") {
																					/* disagreed to tou */
																					$error_console="You must agree to the Terms of Use before you go in";
																				} else {
																					$error_console="You must respond before you go in";
																				}
																				 
																				if($error_console!=""){
																					/* FAILED */
																					echo $error_console;
																					
																				} else {
																					/* PASSED */
																					//update user
																					mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
																					mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE  uname='$username'");
					
																					echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
																				}
																				
																			} else {
																				if($tou_status=="agree"){
																					/* TOU GOOD */
																					mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
																					echo "It looks like you are ready to go. When you are ready, <h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>to enjoy the awesomeness of Nat4an!";
																					
																				} else if($tou_status=="disagree"){
																					/* TOU BAD */
																					?>
																					Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
																					<br /><br />
																					<form action="" method="post">
																						<div id="formLayoutTable">
																							<div class="formLayoutTableRow">
																								<div class="formLayoutTableRowLeftCol">
																									<label>Your response</label>
																								</div>
																								<div class="formLayoutTableRowLeftCol">
																									<input type="hidden" name="wtd" value="enter_site" />
																									<input type="radio" name="tou" value="agree" /> I agree
																									<input type="radio" name="tou" value="disagree" /> I disagree
																									
																								</div>
																							</div>                   
																							<br />
																							<div class="formLayoutTableRow">
																								<div class="formLayoutTableRowLeftCol">
																									
																								</div>
																								<div class="formLayoutTableRowRightCol">
																									<input type="submit" name="set_tou" value="Enter" class="submit" />
																								</div>
																							</div>
																						</div>
																					</form>
																					<?php
																				}	
																			}
																		break;	
																		
																		case 'review_applicants':
																			if(isset($_POST['rapplicant'])){
																				//get post
																				$applicant_id=$_POST['applicant_id'];
																				$response=$_POST['response'];
																				
																				if($response==""){$error_console="You must respond to this applicant";}
																				
																				if($error_console!=""){
																					/*failed*/
																					echo $error_console;
																				
																				} else {
																					/*passed*/
																					//update the datbase
																					if($response=="approve"){
																						mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='active' WHERE id='$applicant_id'");
																						//get user info
																						$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
																						$FETCH_USER=mysql_fetch_array($GET_USER);
																						$fname=$FETCH_USER['fname'];
																						$lname=$FETCH_USER['lname'];
																						$email=$FETCH_USER['email'];
																						
																						//send an email with login details
																						$to=$email;
																						$subject=$properties->WEBSITE_NAME.$properties->WEBSITE_EXT." Admin Account Decision";
																						$message="Hello ".$fname." ".$lname.",<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Approved</b>. You may now logged into our site. <br /><br />Take care and in His Name,<br /><br />".$properties->WEBMASTER_NAME."<br />The ".$properties->COMPANY_NAME." Staff<br />".$webmaster_title."<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.";
																						$headers="From: ". $properties->WEBMASTER_EMAIL . "\r\n" .
																								 "MIME-Version: 1.0" . "\r\n" .
																								 "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
																								 "Reply-To: ".$properties->WEBMASTER_EMAIL . "\r\n" .
																								 "X-Mailer: PHP/" . phpversion();
																																							 
																						SENDMAIL($to,$subject,$message,$headers);
																					} else if($response=="deny"){
																						mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='denied' WHERE id='$applicant_id'");
																						//get user info
																						$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
																						$FETCH_USER=mysql_fetch_array($GET_USER);
																						$fname=$FETCH_USER['fname'];
																						$lname=$FETCH_USER['lname'];
																						$email=$FETCH_USER['email'];
																						
																						//send an email with login details
																						$to=$email;
																						$subject=$properties->WEBSITE_NAME.$properties->WEBSITE_EXT." Admin Account Decision";
																						$message="Hello ".$fname." ".$lname.",<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Denied</b>. We are terribly sorry about this but you don't quite meet our qualifications yet. If you want you can always reapply for the position. <br /><br />Take care and in His Name,<br /><br />".$properties->WEBMASTER_NAME."<br />The ".$properties->COMPANY_NAME." Staff<br />".$webmaster_title."<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.";
																						$headers="From: ". $properties->WEBMASTER_EMAIL . "\r\n" .
																								 "MIME-Version: 1.0" . "\r\n" .
																								 "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
																								 "Reply-To: ".$properties->WEBMASTER_EMAIL . "\r\n" .
																								 "X-Mailer: PHP/" . phpversion();
																																							 
																						SENDMAIL($to,$subject,$message,$headers);
																					}
																					echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																				}
																			} else {
																				//get the number of applicants
																				$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending'");
																				$num_of_applicants=mysql_num_rows($GET_USERS);
																				?>
																				Use this place to review applicants for positions
																				<form action="" method="post">
																					<input type="hidden" name="wtd" value="review_applicants" />
																					<div id="formLayoutTable">
																						<?php
																						if($num_of_applicants<1){
																							/* NO APPLICANTS */
																						} else {
																						?>
																						<div class="formLayoutTableRow">
																							<div class="formLayoutTableRowLeftCol">
																								<label># Applicants</label>
																							</div>
																							<div class="formLayoutTableRowRightCol">
																								<?php echo $num_of_applicants;?>
																							</div>
																						</div>
																						<?php	
																						}
																						?>
																						<?php
																						//get all the applicants
																						if($num_of_applicants<1){
																							echo "No Applicants";	
																						} else if($num_of_applicants>0) {
																							$GET_APPLICANTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending' ORDER BY dateandtime_applied LIMIT 1");
																							while($FETCH_APPLICANTS=mysql_fetch_array($GET_APPLICANTS)){
																								$id=$FETCH_APPLICANTS['id'];
																								$fname=$FETCH_APPLICANTS['fname'];
																								$lname=$FETCH_APPLICANTS['lname'];
																								$type=$FETCH_APPLICANTS['type'];
																								$why=$FETCH_APPLICANTS['why'];
																								?>
																								<input type="hidden" name="applicant_id" value="<?php echo $id;?>" />
																								<div class="formLayoutTableRow">
																									<div class="formLayoutTableRowLeftCol">
																										<label>Name</label>
																									</div>
																									<div class="formLayoutTableRowRightCol">
																										<?php echo $fname." ".$lname;?>
																									</div>
																								</div>
																								
																								<div class="formLayoutTableRow">
																									<div class="formLayoutTableRowLeftCol">
																										<label>Type</label>
																									</div>
																									<div class="formLayoutTableRowRightCol">
																										<?php echo $type;?>
																									</div>
																								</div>
																								
																								<div class="formLayoutTableRow">
																									<div class="formLayoutTableRowLeftCol">
																										<label>Why</label>
																									</div>
																									<div class="formLayoutTableRowRightCol">
																										<?php if(strlen($why)>35){$ending="...";}else{$ending="";}?>
																										<?php echo "<a title=\"".$why."\" class=\"white\">".substr($why,0,32).$ending."</a>";?>
																									</div>
																								</div>
																								<br />
																								<div class="formLayoutTableRow">
																									<div class="formLayoutTableRowLeftCol">
																										<label>Respond</label>
																									</div>
																									<div class="formLayoutTableRowRightCol">
																										<select name="response">
																											<option value="">--------------- your response ---------------</option>
																											<option value="approve">Approve</option>
																											<option value="deny">Deny</option>
																										</select>
																									</div>
																								</div>
																								<?php
																							}
																						}
																						?>
																						
																						<?php
																						if($num_of_applicants<1){
																							/* NO APPLICANTS */
																						} else {
																						?>
																						<div class="formLayoutTableRow">
																							<div class="formLayoutTableRowLeftCol">
																								
																							</div>
																							<div class="formLayoutTableRowRightCol">
																								<input type="submit" name="rapplicant" value="Save" class="submit" />
																							</div>
																						</div>
																						<?php	
																						}
																						?>
																					</div>
																				</form>
																				<?php	
																			}
																		break;
																		
																		case 'user_cp':
																			?>
																			Welcome to your User CP! Here is where you can change all the attributes of your online profile here. 
																			<form action="" method="post">
																				<input type="hidden" name="wtd" value="user_cp" />
																				<div id="formLayoutTable">
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>First Name</label>
																							<br />
																							<label>Last Name</label>
																							<br />
																							<label>Gender</label>
																							<br />
																							<label>Password</label>
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="text" name="ucp_" value="" />
																						</div>
																					</div>
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<input type="submit" name="user_cp_save" value="Save" class="submit" />
																						</div>
																					</div>
																				</div>
																			</form>
																			<?php
																		break;								
																	}
																} else {
																?>
																<h2 style="line-height:.5em;">What do you want to do?</h2>
																<form action="" method="post">
																	<input type="hidden" name="logoutusername" value="<?php echo $username?>" />
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Choose a command</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<select name="wtd">
																					<option value="">--- choose what you want to do ---</option>
																					<?php if($head_admin=="yes"){?><option value="adjust_mar">Adjust Max Admins Rate</option><?php }?>
																					<?php if($head_admin=="yes"){?><option value="adjust_mbr">Adjust Max Closed BETA Members Rate</option><?php }?>
																					<?php if($head_admin=="yes"){?><option value="apc">Adjust Percent Complete</option><?php }?>
																					<?php if($head_admin=="yes"){?><option value="change_cmm">Change closed message middle</option><?php }?>
																					<?php if($head_admin=="yes"){?><option value="change_cmt">Change closed message top</option><?php }?>
																					<?php if($head_admin=="yes"){?><option value="change_mode">Change Mode</option><?php }?>
																					<?php if($head_admin=="yes"){?><option value="change_ldd">Change the Launch Day date</option><?php }?>
																					<option value="enter_site">Enter site</option>
																					<?php if($head_admin=="yes"){?><option value="review_applicants">Review Applicants</option><?php }?>
																					<option value="user_cp">User CP</option>
																				</select>
																			</div>
																		</div>                   
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="change_" value="Go" class="submit" /> 
																				<input type="submit" name="logout" value="Logout" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<br />
																<?php	
																}
																?>
															</div>
															<div id="mid-table-rightcol">
																
															</div>
														</div>
														
														<div class="mid-table-row">
															<div id="mid-table-leftcol">
															
															</div>
															<div id="mid-table-midcol">
																<a href="javascript:history.go(-1)" class="white">Back</a>
															</div>
															<div id="mid-table-rightcol">
															
															</div>
														</div>
													</div>
													<?php
												}
											break;
											}	
										}
									} else {
									//get necessary stuff
									$ip=$_SERVER['REMOTE_ADDR'];
									$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
									
									//check for logged in status
									$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
									if(mysql_num_rows($CHECK_LOGIN)<1){
										/* USER NOT LOGGED */
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:20px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													The Reason we have closed this website for construction is so that no one can see what we are working on until we do the necessary checks and balances that come with building a website. We also believe that this shows progress and we like progress. :)
													
													<script>
														$(document).ready(function() {
															$("#progress-bar").progressbar({ value: <?php echo getGlobalVars($properties,'percent_complete');?> });
														});
													</script>
													<div id="progress-bar"></div>
													
													If you are an Admin with <?php echo $properties->COMPANY_NAME;?> then you can click on the &quot;Control&quot; link to access a special form that allows you to login to manage this flood gate.
												</div>
												<div id="mid-table-rightcol">
													
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:28px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_mid');?></h1>
													<?php
													//get the launchday
													$launch_day=getGlobalVars($properties,'launch_day');
													?>
													<h1 style="font-size:48px;line-height: .5em;"><?php echo $launch_day;?></h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
										<?php
									} else {
										/* USER LOGGED IN */
										$FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
										$fname=$FETCH_LOGIN['fname'];
										$username=$FETCH_LOGIN['uname'];
										$lname=$FETCH_LOGIN['lname'];
										$type=$FETCH_LOGIN['type'];
										$tou_status=$FETCH_LOGIN['tou_status'];
										$head_admin=$FETCH_LOGIN['head_admin'];
										?>
										<div id="mid-table">
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:25px;line-height: 1.2em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Admin Access Control Panel</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<h1 style="font-size:18px;line-height: 1.2em;">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</h1>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<?php
													if(isset($_POST['change_']) || isset($_POST['change_mode']) || isset($_POST['adjust_mar']) || isset($_POST['adjust_mbr']) || isset($_POST['postapc']) || isset($_POST['apc']) || isset($_POST['postmessage']) || isset($_POST['postldd']) || isset($_POST['set_tou']) || isset($_POST['rapplicant'])){
														//get the option
														$option=$_POST['wtd'];
														switch($option){
															case '':
																/* none */
																echo "You must select an option";
															break;
															case 'adjust_mar':
																if(isset($_POST['adjust_mar'])){
																	//get post
																	$newmar=$_POST['mar'];
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																	} else {
																		/*passed*/
																		//update the datbase
																		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_admin_positions='$newmar'");
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																?>
																Use of this form is to allow you as an admin to change the amount of positions open for admins
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Max Admin Rate</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="hidden" name="wtd" value="adjust_mar" />
																				<input type="number" name="mar" style="width:150px;" min="0" max="1000" value="<?php echo getGlobalVars($properties,'max_admin_positions');?>" />
																			</div>
																		</div>                   
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="adjust_mar" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php	
																}
															break;
															
															case 'adjust_mbr':
																if(isset($_POST['adjust_mbr'])){
																	//get post
																	$newmbr=$_POST['mbr'];
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																	} else {
																		/*passed*/
																		//update the datbase
																		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_closed_beta_positions='$newmbr'");
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																?>
																Use of this form is to allow you as an admin to change the amount of positions open for Closed BETA Members
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Max BETA Member Rate</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="hidden" name="wtd" value="adjust_mbr" />
																				<input type="number" name="mbr" style="width:150px;" min="0" max="1000" value="<?php echo getGlobalVars($properties,'max_closed_beta_positions');?>" />
																			</div>
																		</div>                   

																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="adjust_mbr" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php	
																}
															break;
															
															case 'apc':
																if(isset($_POST['postapc'])){
																	//get post
																	$newpc=$_POST['percent'];
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																	} else {
																		/*passed*/
																		//update the datbase
																		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET percent_complete='$newpc'");
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																?>
																This form will change the mode of this entire site. Be careful when doing so, as some options might unleash this site to the public prematurely and/or take you away from this place.
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Completion</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="hidden" name="wtd" value="apc" />
																				<input type="number" step=".01" min="0" max="100" name="percent" value="<?php echo getGlobalVars($properties,'percent_complete');?>" />
																			</div>
																		</div>                   
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="postapc" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php	
																}
															break;
															
															case 'change_cmm':
																if(isset($_POST['postmessage'])){
																	//get post
																	$newmessage=$_POST['message'];
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																	} else {
																		/*passed*/
																		//update the datbase
																		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_mid='$newmessage'");
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																?>
																Use this to chance the message that gets displayed on the closed sign in the middle before the date
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Message</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="hidden" name="wtd" value="change_cmm" />
																				<input type="text" name="message" value="<?php echo getGlobalVars($properties,'closed_message_mid');?>" />
																			</div>
																		</div>                   
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="postmessage" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php	
																}
															break;
															
															case 'change_cmt':
																if(isset($_POST['postmessage'])){
																	//get post
																	$newmessage=$_POST['message'];
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																	} else {
																		/*passed*/
																		//update the datbase
																		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_top='$newmessage'");
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																?>
																Use this to chance the message that gets displayed on the closed sign in the middle before the date
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Message</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="hidden" name="wtd" value="change_cmt" />
																				<input type="text" name="message" value="<?php echo getGlobalVars($properties,'closed_message_top');?>" />
																			</div>
																		</div>                   
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="postmessage" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php	
																}
															break;
															
															case 'change_mode':
																if(isset($_POST['change_mode'])){
																	//get post
																	$newmode=$_POST['mode'];
																	
																	if($newmode==""){$error_console="You must select a mode";}
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																	} else {
																		/*passed*/
																		//update the datbase
																		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET mode='$newmode'");
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																?>
																This form will change the mode of this entire site. Be careful when doing so, as some options might unleash this site to the public prematurely and/or take you away from this place.
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Mode</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="hidden" name="wtd" value="change_mode" />
																				<select name="mode" onchange="document.getElementById('change_mode').disabled=false;">
																					<?php
																					//detect which mode it is in
																					$mode=getGlobalVars($properties,'mode');
																					$modes="closed,alpha mode,closed beta,open beta,open,maintenance,";
																					$modes_names="Closed,Alpha Mode,Closed BETA,Open BETA,Open,Maintenance";
																					$modes_list=explode(",",$modes);
																					$modes_names_list=explode(",",$modes_names);
																					for($i=0; $i<count($modes_list)-1; $i++){
																						if($mode==$modes_list[$i]){
																							?>
																							<option selected="selected" disabled="disabled" value="<?php echo $modes_list[$i];?>"><?php echo $modes_names_list[$i];?></option>
																							<?php																			
																						} else {
																							?>
																							<option value="<?php echo $modes_list[$i];?>"><?php echo $modes_names_list[$i];?></option>
																							<?php	
																						}
																					}
																					?>
																				</select>
																			</div>
																		</div>                   
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="change_mode" id="change_mode" disabled="disabled" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php	
																}
															break;
															
															case 'change_ldd':
																if(isset($_POST['postldd'])){
																	//get post
																	$newldd=$_POST['date'];
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
																	} else {
																		/*passed*/
																		//update the datbase
																		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET launch_day='$newldd'");
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																?>
																This will change the Launch Day Date that displays on the closed page. The format is XX/XX/XXXX where X's can represent Question Marks (?).
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Launch Day Date</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="hidden" name="wtd" value="change_ldd" />
																				<input type="text" maxlength="10" name="date" value="<?php echo getGlobalVars($properties,'launch_day');?>" />
																			</div>
																		</div>                   
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="postldd" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php	
																}
															break;			
															
															case 'enter_site':
																if(isset($_POST['set_tou'])){
																	/* POST ACTION FOR TOU */
																	//get post elements
																	$agree_status="unchecked";
																	$disagree_status="unchecked";
																	$set_tou=$_POST['tou'];
																	
																	if($set_tou=="agree"){
																		/* agreed to tou */
																		$error_console="";
																		
																	} else if($set_tou=="disagree") {
																		/* disagreed to tou */
																		$error_console="You must agree to the Terms of Use before you go in";
																	} else {
																		$error_console="You must respond before you go in";
																	}
																	 
																	if($error_console!=""){
																		/* FAILED */
																		echo $error_console;
																		
																	} else {
																		/* PASSED */
																		//update user
																		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
																		mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE  uname='$username'");
			
																		echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
																	}
																	
																} else {
																	if($tou_status=="agree"){
																		/* TOU GOOD */
																		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
																		echo "It looks like you are ready to go. When you are ready, <h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>to enjoy the awesomeness of Nat4an!";
																		
																	} else if($tou_status=="disagree"){
																		/* TOU BAD */
																		?>
																		Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
																		<br /><br />
																		<form action="" method="post">
																			<div id="formLayoutTable">
																				<div class="formLayoutTableRow">
																					<div class="formLayoutTableRowLeftCol">
																						<label>Your response</label>
																					</div>
																					<div class="formLayoutTableRowLeftCol">
																						<input type="hidden" name="wtd" value="enter_site" />
																						<input type="radio" name="tou" value="agree" /> I agree
																						<input type="radio" name="tou" value="disagree" /> I disagree
																						
																					</div>
																				</div>                   
																				<br />
																				<div class="formLayoutTableRow">
																					<div class="formLayoutTableRowLeftCol">
																						
																					</div>
																					<div class="formLayoutTableRowRightCol">
																						<input type="submit" name="set_tou" value="Enter" class="submit" />
																					</div>
																				</div>
																			</div>
																		</form>
																		<?php
																	}	
																}
															break;	
															
															case 'review_applicants':
																if(isset($_POST['rapplicant'])){
																	//get post
																	$applicant_id=$_POST['applicant_id'];
																	$response=$_POST['response'];
																	
																	if($response==""){$error_console="You must respond to this applicant";}
																	
																	if($error_console!=""){
																		/*failed*/
																		echo $error_console;
																	
																	} else {
																		/*passed*/
																		//update the datbase
																		if($response=="approve"){
																			mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='active' WHERE id='$applicant_id'");
																			//get user info
																			$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
																			$FETCH_USER=mysql_fetch_array($GET_USER);
																			$fname=$FETCH_USER['fname'];
																			$lname=$FETCH_USER['lname'];
																			$email=$FETCH_USER['email'];
																			
																			//send an email with login details
																			$to=$email;
																			$subject=$properties->WEBSITE_NAME.$properties->WEBSITE_EXT." Admin Account Decision";
																			$message="Hello ".$fname." ".$lname.",<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Approved</b>. You may now logged into our site. <br /><br />Take care and in His Name,<br /><br />".$properties->WEBMASTER_NAME."<br />The ".$properties->COMPANY_NAME." Staff<br />".$webmaster_title."<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.";
																			$headers="From: ". $properties->WEBMASTER_EMAIL . "\r\n" .
																					 "MIME-Version: 1.0" . "\r\n" .
																					 "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
																					 "Reply-To: ".$properties->WEBMASTER_EMAIL . "\r\n" .
																					 "X-Mailer: PHP/" . phpversion();
																																				 
																			SENDMAIL($to,$subject,$message,$headers);
																		} else if($response=="deny"){
																			mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='denied' WHERE id='$applicant_id'");
																			//get user info
																			$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
																			$FETCH_USER=mysql_fetch_array($GET_USER);
																			$fname=$FETCH_USER['fname'];
																			$lname=$FETCH_USER['lname'];
																			$email=$FETCH_USER['email'];
																			
																			//send an email with login details
																			$to=$email;
																			$subject=$properties->WEBSITE_NAME.$properties->WEBSITE_EXT." Admin Account Decision";
																			$message="Hello ".$fname." ".$lname.",<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Denied</b>. We are terribly sorry about this but you don't quite meet our qualifications yet. If you want you can always reapply for the position. <br /><br />Take care and in His Name,<br /><br />".$properties->WEBMASTER_NAME."<br />The ".$properties->COMPANY_NAME." Staff<br />".$webmaster_title."<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.";
																			$headers="From: ". $properties->WEBMASTER_EMAIL . "\r\n" .
																					 "MIME-Version: 1.0" . "\r\n" .
																					 "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
																					 "Reply-To: ".$properties->WEBMASTER_EMAIL . "\r\n" .
																					 "X-Mailer: PHP/" . phpversion();
																																				 
																			SENDMAIL($to,$subject,$message,$headers);
																		}
																		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																	}
																} else {
																	//get the number of applicants
																	$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending'");
																	$num_of_applicants=mysql_num_rows($GET_USERS);
																	?>
																	Use this place to review applicants for positions
																	<form action="" method="post">
																		<input type="hidden" name="wtd" value="review_applicants" />
																		<div id="formLayoutTable">
																			<?php
																			if($num_of_applicants<1){
																				/* NO APPLICANTS */

																			} else {
																			?>
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					<label># Applicants</label>
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<?php echo $num_of_applicants;?>
																				</div>
																			</div>
																			<?php	
																			}
																			?>
																			<?php
																			//get all the applicants
																			if($num_of_applicants<1){
																				echo "No Applicants";	
																			} else if($num_of_applicants>0) {
																				$GET_APPLICANTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending' ORDER BY dateandtime_applied LIMIT 1");
																				while($FETCH_APPLICANTS=mysql_fetch_array($GET_APPLICANTS)){
																					$id=$FETCH_APPLICANTS['id'];
																					$fname=$FETCH_APPLICANTS['fname'];
																					$lname=$FETCH_APPLICANTS['lname'];
																					$type=$FETCH_APPLICANTS['type'];
																					$why=$FETCH_APPLICANTS['why'];
																					?>
																					<input type="hidden" name="applicant_id" value="<?php echo $id;?>" />
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Name</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<?php echo $fname." ".$lname;?>
																						</div>
																					</div>
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Type</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<?php echo $type;?>
																						</div>
																					</div>
																					
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Why</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<?php if(strlen($why)>35){$ending="...";}else{$ending="";}?>
																							<?php echo "<a title=\"".$why."\" class=\"white\">".substr($why,0,32).$ending."</a>";?>
																						</div>
																					</div>
																					<br />
																					<div class="formLayoutTableRow">
																						<div class="formLayoutTableRowLeftCol">
																							<label>Respond</label>
																						</div>
																						<div class="formLayoutTableRowRightCol">
																							<select name="response">
																								<option value="">--------------- your response ---------------</option>
																								<option value="approve">Approve</option>
																								<option value="deny">Deny</option>
																							</select>
																						</div>
																					</div>
																					<?php
																				}
																			}
																			?>
																			
																			<?php
																			if($num_of_applicants<1){
																				/* NO APPLICANTS */
																			} else {
																			?>
																			<div class="formLayoutTableRow">
																				<div class="formLayoutTableRowLeftCol">
																					
																				</div>
																				<div class="formLayoutTableRowRightCol">
																					<input type="submit" name="rapplicant" value="Save" class="submit" />
																				</div>
																			</div>
																			<?php	
																			}
																			?>
																		</div>
																	</form>
																	<?php	
																}
															break;
															
															case 'user_cp':
																?>
																Welcome to your User CP! Here is where you can change all the attributes of your online profile here. 
																<form action="" method="post">
																	<input type="hidden" name="wtd" value="user_cp" />
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>First Name</label>
																				<br />
																				<label>Last Name</label>
																				<br />
																				<label>Gender</label>
																				<br />
																				<label>Password</label>
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="text" name="ucp_" value="" />
																			</div>
																		</div>
																		
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="user_cp_save" value="Save" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php
															break;								
														}
													} else {
													?>
													<h2 style="line-height:.5em;">What do you want to do?</h2>
													<form action="" method="post">
														<input type="hidden" name="logoutusername" value="<?php echo $username?>" />
														<div id="formLayoutTable">
															<div class="formLayoutTableRow">
																<div class="formLayoutTableRowLeftCol">
																	<label>Choose a command</label>
																</div>
																<div class="formLayoutTableRowRightCol">
																	<select name="wtd">
																		<option value="">--- choose what you want to do ---</option>
																		<?php if($head_admin=="yes"){?><option value="adjust_mar">Adjust Max Admins Rate</option><?php }?>
																		<?php if($head_admin=="yes"){?><option value="adjust_mbr">Adjust Max Closed BETA Members Rate</option><?php }?>
																		<?php if($head_admin=="yes"){?><option value="apc">Adjust Percent Complete</option><?php }?>
																		<?php if($head_admin=="yes"){?><option value="change_cmm">Change closed message middle</option><?php }?>
																		<?php if($head_admin=="yes"){?><option value="change_cmt">Change closed message top</option><?php }?>
																		<?php if($head_admin=="yes"){?><option value="change_mode">Change Mode</option><?php }?>
																		<?php if($head_admin=="yes"){?><option value="change_ldd">Change the Launch Day date</option><?php }?>
																		<option value="enter_site">Enter site</option>
																		<?php if($head_admin=="yes"){?><option value="review_applicants">Review Applicants</option><?php }?>
																		<option value="user_cp">User CP</option>
																	</select>
																</div>
															</div>                   
															
															<div class="formLayoutTableRow">
																<div class="formLayoutTableRowLeftCol">
																	
																</div>
																<div class="formLayoutTableRowRightCol">
																	<input type="submit" name="change_" value="Go" class="submit" /> 
																	<input type="submit" name="logout" value="Logout" class="submit" />
																</div>
															</div>
														</div>
													</form>
													<br />
													<?php	
													}
													?>
												</div>
												<div id="mid-table-rightcol">
													
												</div>
											</div>
											
											<div class="mid-table-row">
												<div id="mid-table-leftcol">
												
												</div>
												<div id="mid-table-midcol">
													<a href="javascript:history.go(-1)" class="white">Back</a>
												</div>
												<div id="mid-table-rightcol">
												
												</div>
											</div>
										</div>
										<?php
									}
									}
							?>
								
								
								
							</div>
							<div id="bottom">
								<br />
								<center>
								<?php
								if($_SERVER['HTTP_HOST']=="localhost"){
								?>
								
								<?php
								} else {
								?>
								[ <a href="/cpanel" title="To control EVERY single aspect of this server!" target="_new">Admin's CPanel</a> ]
								<?php
								}
								?>
								
								<?php
								//get necessary stuff
								$ip=$_SERVER['REMOTE_ADDR'];
								$logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
								
								//check for logged in status
								$CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
								if(mysql_num_rows($CHECK_LOGIN)<1){
								if(getGlobalVars($properties,'mode') == "closed"){/* ON A PAGE WHERE CONTROL IS NOT ACCESSIBLE */?>[ <a href="control" title="">Control</a> ]<?php }else{}
								}
								?>
								
								<?php
								if($_SERVER['HTTP_HOST']=="localhost"){
								?>
								[ <a href="/library.php" target="_new" title="A library of my works in HTML/CSS/PHP/ETC">Library</a> ]
								<?php
								}
								?>
								
								<?php
								if($_SERVER['HTTP_HOST']=="localhost"){
								?>
								[ <a href="http://www.nat4an.com" title="Goto the ONLINE version instantly!">There's no place like nat4an.com!</a> ]
								<?php	
								} else {
								?>
								[ <a href="http://localhost" title="Goto the localhost without having to type it, don't know why I did this, but you must be on my computer to access. :P">There's no place like 127.0.0.1!</a> ]
								<?php	
								}
								?>
								
								<?php
								if($_SERVER['HTTP_HOST']=="localhost"){
								?>
								
								<h2>Projects</h2>
								[ <a href="http://localhost/projects/the-wife-cms/repo" target="_blank" title="An on-going project that was created to be a Web Interface For Everyone. This is my first official attempt at creating a CMS that everyone will love!">The WIFE</a> ]
								<?php	
								} else {
								?>
								
								<?php	
								}
								?>
								
								<?php
								if($_SERVER['HTTP_HOST']=="localhost"){
								
								} else {
								?>
								<h2>Repositories</h2>
								<?php
								if($_SERVER['HTTP_HOST']=="localhost"){
								?>
								[ <a href="http://localhost/repo/thewife" target="_blank" title="An on-going project that was created to be a Web Interface For Everyone. This is my first official attempt at creating a CMS that everyone will love!">The WIFE</a> ]
								<?php	
								} else {
								?>
								[ <a href="https://github.com/nat4ancorp/thewife.git" target="_blank" title="An on-going project that was created to be a Web Interface For Everyone. This is my first official attempt at creating a CMS that everyone will love!">The WIFE</a> ]
								<?php	
								}
								?>
								<?php
								}
								?>					
								</center>
							</div>
						</div>
						
						<div id="splash-col3">
							
						</div>
					</div>
				</div>
			
			</div>    
			<?php
		}
	}
} else if($logged==0) {
	/* NOT LOGGED */
	?>
	<div id="splash-container3">
        <div id="splash-container2">
            <div id="splash-container1">
                <div id="splash-col1">
                    
                </div>
                
                <div id="splash-col2">
                    <div id="top">
                            <?php echo $globalvars_passpage_title;?>
                            <?php echo $globalvars_passpage_slogan;?>
                            <?php echo $globalvars_passpage_closed_st;?>
                    </div>
                    <div id="mid">
                        <?php
                        if( (isset($_POST['login'])) || ($_GET['page']=="forgotusername") || ($_GET['page']=="forgotpassword") || ($_GET['page']=="request") || ($_GET['page']=="control") || (isset($_POST['logout'])) ){
                            if((isset($_POST['login'])) || (isset($_POST['logout']))){
                                if(isset($_POST['login'])){
                                    /* LOGIN ACCESS */
                                    ?>
                                    <div id="mid-table">
                                        <div class="mid-table-row">
                                            <div id="mid-table-leftcol">
                                            
                                            </div>
                                            <div id="mid-table-midcol">
                                                <h1 style="font-size:20px;line-height: 1.8em;"><br /><br /><br />Logging in to <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
                                            </div>
                                            <div id="mid-table-rightcol">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="mid-table-row">
                                            <div id="mid-table-leftcol">
                                            
                                            </div>
                                            <div id="mid-table-midcol">
                                                <?php
                                                //get the $_POST variables
                                                $username=$_POST['username'];
                                                $password=$_POST['password'];
                                                $ip=$_SERVER['REMOTE_ADDR'];
                                                
                                                //check for username in db
                                                $CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
                                                if(mysql_num_rows($CHECK_USERNAME)<1){
                                                    /* user not there */
                                                    $error_console="<b>{$username}</b> does not exist on our server";
                                                } else {
                                                    $FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
                                                    $status=$FETCH_USERNAME['status'];
                                                    $suspended_reason=$FETCH_USERNAME['suspended_reason'];
                                                                                                    
                                                    switch($status){
                                                        case 'active':
                                                            $error_console="";
                                                        break;
                                                        case 'pending':
                                                            $error_console="<b>{$username}</b> is a new user and it currently being reviewed at the moment";
                                                        break;
                                                        case 'deleted':
                                                            $error_console="<b>{$username}</b> does not exist on our server";
                                                        break;
                                                        case 'suspended':
                                                            $error_console="<b>{$username}</b> has been suspended due to <b>{$suspended_reason}</b>";
                                                        break;
														case 'denied':
                                                            $error_console="<b>{$username}</b> does not exist on our server";
                                                        break;
                                                    }
                                                }
                                                
                                                //check the password
                                                $CHECK_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
                                                if(mysql_num_rows($CHECK_PASSWORD)<1){
                                                    /* not a user */
                                                } else {
                                                    $FETCH_PASSWORD=mysql_fetch_array($CHECK_PASSWORD);
                                                    $db_upass=$FETCH_PASSWORD['upass'];
                                                    if(hash('sha256',md5(sha1($password)))!=$db_upass){
                                                        $error_console="The password you entered does not match with what is on file";
                                                    } else {
                                                        //logged them in
                                                    }
                                                }
                                                
                                                //check if user is logged in
                                                $CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
                                                $FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
                                                if($FETCH_IP['loggedin']=="yes"){/*USER IS LOGGED IN*/$error_console="<b>{$username}</b> is already logged in. If this is your account and you do not think you are logged in: chances are you forgot to log out the last time you were on this site. To log yourself out, please <form action=\"\" method=\"post\"><input type=\"hidden\" name=\"logoutusername\" value=\"".$username."\"><input type=\"submit\" name=\"logout\" value=\"click here\"></form>NOTE: This will potentially log anyone out who is using this account. Hopefully that is not the case since you keep your password secret just like a good keeper-of-passwords. If this isn't the case and you believe someone has access to your account, you may request to reset your password <a href=\"forgotpassword\" class=\"white\">here</a>";}	
                                                
                                                //check for blanks
                                                if($password==""){$error_console="Password is missing";}
                                                if($username==""){$error_console="Username is missing";}
                                                
                                                //check the error console
                                                if($error_console!=""){
                                                    /* FAILED */
                                                    echo $error_console;
                                                    echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
                                                } else {
                                                    /* PASSED */
                                                    //make logged session id
                                                    $lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));
                                                    
                                                    //set session cookie that will expire in 20 years (it's ok)
                                                    setcookie($properties->_COOKIE_INIT_SESSION,$lsessionid,(time() + (20 * 365 * 24 * 60 * 60)),"/");
                                                    
													//get dateand time
													//0000-00-00 00:00:00
													$dateandtime=date("Y-m-d H:i:s");															
													
                                                    //update the db
                                                    mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$username'");
                                                    mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$username'");
                                                    mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$username'");
													mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$username'");
                                                    
                                                    echo "<br />You have been successfully logged in!<br />Click <a href=\"".$properties->WEBSITE_URL."\" class=\"white\">here</a> to go to your Admin Panel";
                                                }
                                                ?>
                                            </div>
                                            <div id="mid-table-rightcol">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="mid-table-row">
                                            <div id="mid-table-leftcol">
                                            
                                            </div>
                                            <div id="mid-table-midcol">
                                                
                                            </div>
                                            <div id="mid-table-rightcol">
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else if(isset($_POST['logout'])){
                                    /* LOGOUT ACCESS */
                                    ?>
                                    <div id="mid-table">
                                        <div class="mid-table-row">
                                            <div id="mid-table-leftcol">
                                            
                                            </div>
                                            <div id="mid-table-midcol">
                                                <h1 style="font-size:20px;line-height: 1.8em;"><br /><br /><br /><br />Logging out of <?php echo $properties->WEBSITE_NAME.$properties->WEBSITE_EXT;?> Admin Access Panel!</h1>
                                            </div>
                                            <div id="mid-table-rightcol">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="mid-table-row">
                                            <div id="mid-table-leftcol">
                                            
                                            </div>
                                            <div id="mid-table-midcol">
                                                <?php			
                                                //get user
                                                $username=$_POST['logoutusername'];
                                                
                                                if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}
                                                
                                                //check the error console
                                                if($error_console!=""){
                                                    /* FAILED */
                                                    echo $error_console;
                                                    echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
                                                } else {
                                                    /* PASSED */
													
													//FIX AS OF 3.5.1 - This clears the cookie for the new cookie in case something happens
													setcookie($properties->_COOKIE_INIT_SESSION,$lsessionid,(time() - (20 * 365 * 24 * 60 * 60)),"/");
																				
                                                    //update the db
                                                    mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
													mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
                                                    mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
                                                    mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
                                                                                                    
                                                    echo "<br />You have been successfully logged out!<br /><a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Go home</a>";
                                                }
                                                ?>
                                            </div>
                                            <div id="mid-table-rightcol">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="mid-table-row">
                                            <div id="mid-table-leftcol">
                                            
                                            </div>
                                            <div id="mid-table-midcol">
                                                
                                            </div>
                                            <div id="mid-table-rightcol">
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                
                            } else {
                                switch($_GET['page']){
                                    case 'control':
                                        //get necessary stuff
                                        $ip=$_SERVER['REMOTE_ADDR'];
                                        $logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
                                        
                                        //check for logged in status
                                        $CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
                                        if(mysql_num_rows($CHECK_LOGIN)<1){
                                            ?>
                                                <div id="mid-table">
                                                    <div class="mid-table-row">
                                                        <div id="mid-table-leftcol">
                                                        
                                                        </div>
                                                        <div id="mid-table-midcol">
                                                            <h1 style="font-size:36px;line-height: 1em;"><br />Admin Access</h1>
                                                            Use this form to login to the Admin Controls for this Flood Gate. Once logged in, you will be able to change everything about how this flood gate works.
                                                            <br /><br />
                                                        </div>
                                                        <div id="mid-table-rightcol">
                                                        
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mid-table-row">
                                                        <div id="mid-table-leftcol">
                                                        
                                                        </div>
                                                        <div id="mid-table-midcol">
                                                            <form action="" method="post">
                                                                <div id="formLayoutTable">
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            <label>Username</label>
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="text" name="username" value="" />
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            <label>Password</label>
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="password" name="password" value="" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="submit" class="submit" name="login" value="Login" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div id="mid-table-rightcol">
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mid-table-row">
                                                        <div id="mid-table-leftcol">
                                                        
                                                        </div>
                                                        <div id="mid-table-midcol">
                                                           <?php
                                                            $max_positions=getGlobalVars($properties,'max_admin_positions');
                                                            //get the number of users
                                                            $GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
                                                            $num_of_users=mysql_num_rows($GET_USERS);
                                                            $num_of_pos_left=$max_positions - $num_of_users;
                                                            if($num_of_pos_left<0){$num_of_pos_left=0;}
                                                            ?>
                                                            <br />
                                                            <?php if($num_of_pos_left<1){?><h1 style="font-size:26px;">We have <?php echo $num_of_pos_left;?> positions open...:(</h1><?php }else if(($num_of_pos_left>0) && ($num_of_pos_left<2)){?><h1>We have <?php echo $num_of_pos_left;?> position open!</h1><?php }else if($num_of_pos_left>1){?><h1>We have <?php echo $num_of_pos_left;?> positions open!!!</h1><?php }?>
                                                            <a class="white" href="forgotusername">Forget Username?</a> | <a class="white" href="forgotpassword">Forget Password?</a> | <?php if($num_of_pos_left<1){?><a class="white" style="text-decoration:line-through;cursor:help;" title="There are no positions open so this link is not accessible">Request Access</a><?php }else{?><a class="white" href="request">Request Access</a><?php }?>
                                                        </div>
                                                        <div id="mid-table-rightcol">
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                        } else {
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <h1 style="font-size:36px;line-height: 1em;"><br />Admin Access</h1>
                                                        <br /><br />
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        YOU ARE CURRENTLY LOGGED IN
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                       <br />
                                                       <a href="../" class="white">Go home</a>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    break;
                                    case 'forgotusername':
                                    if( isset($_POST['recover']) || isset($_POST['theanswer']) ){
                                        if(isset($_POST['recover'])){
                                            /* RECOVERY GENERAL */
                                            /* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                    <?php
                                                    //search for email in db
                                                    $FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='".$_POST['email']."'");
                                                    ?>
                                                    <h1 style="font-size:20px;line-height: 1.8em;">
                                                    <?php 
                                                    if(($_POST['email']=="") || (CHECK_EMAIL($_POST['email'])==false)){
                                                        echo "<br /><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.";
                                                    } else {
                                                        if(mysql_num_rows($FIND_EMAIL)<1){
                                                            echo "<br /><br /><br /><br />We could not find a match for <br />&quot;".$_POST['email']."&quot;";
                                                        } else{
                                                            echo "<br />Security Information<br />We found an email matching<br />&quot;".$_POST['email']."&quot;<br />Now answer your Security Question to obtain your username:";
                                                        }
                                                    }															
                                                        ?></h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <?php
                                                        //get $_POST data
                                                        $email=$_POST['email'];												
                                                        
                                                        //search for email in db
                                                        $FIND_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
                                                        if(mysql_num_rows($FIND_EMAIL)<1){
                                                            /* DID NOT FIND EMAIL */
                                                            $error_console="<b>{$email}</b> was not found on our server";
                                                        } else {
                                                            /* FOUND EMAIL */
                                                            $FETCH_EMAIL_STATS=mysql_fetch_array($FIND_EMAIL);
                                                            $sqid=$FETCH_EMAIL_STATS['security_question'];
                                                            if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}
                                                            
                                                            //check security
                                                            ?>
                                                            <form action="" method="post">
                                                                <div id="formLayoutTable">
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            <label>Security Question</label>
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <?php
                                                                            $GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
                                                                            if(mysql_num_rows($GET_SQS)<1){
                                                                                /* something went wrong */
                                                                            } else {
                                                                                $FETCH_SQS=mysql_fetch_array($GET_SQS);
                                                                                $sqvalue=$FETCH_SQS['value'];
                                                                                $is_auto_q=$FETCH_SQS['is_auto_q'];
                                                                                echo $sqvalue."?";
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <?php
                                                                            if($is_auto_q == "yes"){
                                                                                /* SQ NOT ASSIGNED; USED DEFAULT PIN */
                                                                                ?>
                                                                                <input type="text" name="sapin_1" class="pin" maxlength=1 /> 
                                                                                <input type="text" name="sapin_2" class="pin" maxlength=1 /> 
                                                                                <input type="text" name="sapin_3" class="pin" maxlength=1 /> 
                                                                                <input type="text" name="sapin_4" class="pin" maxlength=1 /> 
                                                                                <input type="hidden" name="email" value="<?php echo $email;?>" />
                                                                                <input type="hidden" name="is_auto_q" value="yes" />
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <input type="text" name="theanswervalue" value="" />
                                                                                <input type="hidden" name="email" value="<?php echo $email;?>" />
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="submit" name="theanswer" value="Answer" class="submit" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <?php
                                                        }
                                                        
                                                        //check for valid email
                                                        if(CHECK_EMAIL($email)==false){$error_console="Your Email doesn't look valid";}
                                                        
                                                        //check for blank fields
                                                        if($email==""){$error_console="Your Email is missing";}
                                                        
                                                        //check to see if there are any errors
                                                        if($error_console != ""){
                                                            /* FAILED */
                                                            echo "<br /><br />".$error_console;
                                                        } else {
                                                            /* PASSED */
                                                        }
                                                        ?>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <br />
                                                        <a href="javascript:history.go(-1)" class="white">Back</a>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q']))){
                                            /* CHECKING SECURITY */
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                    
                                                    <h1 style="font-size:20px;line-height: 1.8em;"><br />Security Information
                                                    <?php
                                                    //get $_POST variables
                                                    $is_auto_q=$_POST['is_auto_q'];
                                                        
                                                    //determine which method: by pin or security question												
                                                    if($is_auto_q == "yes") {
                                                        //get $_POST variables
                                                        $sapin_1=$_POST['sapin_1'];
                                                        $sapin_2=$_POST['sapin_2'];
                                                        $sapin_3=$_POST['sapin_3'];
                                                        $sapin_4=$_POST['sapin_4'];
                                                        $email=$_POST['email'];
                                                        
                                                        //make full length pin
                                                        $full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;
                                                        
                                                        //check for correct pin
                                                        $GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
                                                        if(mysql_num_rows($GET_USER_PIN)<1){
                                                            
                                                        } else {
                                                            $FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
                                                            $dbpin=$FETCH_USER_PIN['pin'];
                                                            $username=$FETCH_USER_PIN['uname'];
                                                            if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
                                                        }
                                                        
                                                        //check to see if pin is blank
                                                        if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
                                                        if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
                                                        if($full_pin==""){$error_console="PIN is missing";}
                                                    } else {
                                                        /* DOING IT BY SQ */
                                                        
                                                        //get $_POST variables
                                                        $theanswer=$_POST['theanswervalue'];
                                                        $email=$_POST['email'];
                                                        
                                                        //check for correct answer
                                                        $GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email'");
                                                        if(mysql_num_rows($GET_USER_SA)<1){
                                                            
                                                        } else {
                                                            $FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
                                                            $dbsa=$FETCH_USER_SA['security_answer'];
                                                            $username=$FETCH_USER_SA['uname'];
                                                            if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
                                                        }
                                                        
                                                    }
                                                    
                                                    
                                                    if($error_console!=""){
                                                        ?>
                                                        <br />Bad authentication!
                                                        <?php	
                                                    } else {
                                                        ?>
                                                        <br />Successfully authenticated!
                                                        <?php
                                                    }
                                                    ?>
                                                    </h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <?php													
                                                        //check error_console
                                                        if($error_console!=""){
                                                            /*FAILED*/
                                                            echo "<br /><br /><br /><br /><br /><br /><br />";
                                                            echo $error_console;
                                                            echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
                                                        } else {
                                                            /*PASSED*/
                                                            echo "<br /><br /><br /><br /><br /><br /><h1>Your username is: ".$username."</h1>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <br />
                                                        <?php if($error_console==""){?><a href="../" class="white">Go Home</a><?php }else{?><a href="javascript:history.go(-1)" class="white">Back</a><?php }?>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div id="mid-table">
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                    <h1 style="font-size:20px;line-height: 1.8em;"><br />Forget your username? No problem! Fill out the form with the email you used when you registered to become an admin and we'll look it up for you.</h1>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                
                                                </div>
                                            </div>
                                            
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                    <form action="" method="post">
                                                        <div id="formLayoutTable">
                                                            <div class="formLayoutTableRow">
                                                                <div class="formLayoutTableRowLeftCol">
                                                                    <label>Email</label>
                                                                </div>
                                                                <div class="formLayoutTableRowRightCol">
                                                                    <input type="text" name="email" />
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="formLayoutTableRow">
                                                                <div class="formLayoutTableRowLeftCol">
                                                                    
                                                                </div>
                                                                <div class="formLayoutTableRowRightCol">
                                                                    <input type="submit" class="submit" name="recover" value="Recover" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                   <br />
                                                   <a class="white" href="javascript:history.go(-1)">Back</a>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    break;
                                    
                                    case 'forgotpassword':
                                    if( isset($_POST['recover']) || isset($_POST['theanswer']) || (isset($_POST['savenewpassword']))){
                                        if(isset($_POST['recover'])){
                                            /* RECOVERY GENERAL */
                                            /* DO LOGIN RECOVERY PROCESS BY GETTING THE SECURTIY QUESTION AND TELLING USER THE USERNAME */
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                    <?php
                                                    //search for email in db
                                                    $FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$_POST['username']."'");
                                                    ?>
                                                    <h1 style="font-size:20px;line-height: 1.8em;">
                                                    <?php 
                                                    if($_POST['username']==""){
                                                        echo "<br /><br />Forget your password? No problem! Fill out the form with the your username and we'll look it up for you.";
                                                    } else {
                                                        if(mysql_num_rows($FIND_USERNAME)<1){
                                                            echo "<br /><br /><br /><br />We could not find a match for <br />&quot;{$_POST['username']}&quot;";
                                                        } else{
                                                            echo "<br />Security Information<br />We found a username matching<br />&quot;".$_POST['username']."&quot;<br />Now answer your Security Question to reset your password:";
                                                        }
                                                    }															
                                                        ?></h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <?php
                                                        //get $_POST data
                                                        $username=$_POST['username'];												
                                                        
                                                        //search for email in db
                                                        $FIND_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
                                                        if(mysql_num_rows($FIND_USERNAME)<1){
                                                            /* DID NOT FIND USERNAME */
                                                            $error_console="<b>{$username}</b> was not found on our server";
                                                        } else {
                                                            /* FOUND EMAIL */
                                                            $FETCH_USERNAME_STATS=mysql_fetch_array($FIND_USERNAME);
                                                            $sqid=$FETCH_USERNAME_STATS['security_question'];
                                                            if($sqid == 0){/* QUESTION IS NOT SET */$FIND_AQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE is_auto_q='yes'");$FETCH_AQ=mysql_fetch_array($FIND_AQ);$sqid=$FETCH_AQ['id'];}
                                                            
                                                            //check security
                                                            ?>
                                                            <form action="" method="post">
                                                                <div id="formLayoutTable">
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            <label>Security Question</label>
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <?php
                                                                            $GET_SQS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions WHERE id='$sqid'");
                                                                            if(mysql_num_rows($GET_SQS)<1){
                                                                                /* something went wrong */
                                                                            } else {
                                                                                $FETCH_SQS=mysql_fetch_array($GET_SQS);
                                                                                $sqvalue=$FETCH_SQS['value'];
                                                                                $is_auto_q=$FETCH_SQS['is_auto_q'];
                                                                                echo $sqvalue."?";
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <?php
                                                                            if($is_auto_q == "yes"){
                                                                                /* SQ NOT ASSIGNED; USED DEFAULT PIN */
                                                                                ?>
                                                                                <input type="text" name="sapin_1" class="pin" maxlength=1 /> 
                                                                                <input type="text" name="sapin_2" class="pin" maxlength=1 /> 
                                                                                <input type="text" name="sapin_3" class="pin" maxlength=1 /> 
                                                                                <input type="text" name="sapin_4" class="pin" maxlength=1 /> 
                                                                                <input type="hidden" name="username" value="<?php echo $username;?>" />
                                                                                <input type="hidden" name="is_auto_q" value="yes" />
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <input type="text" name="theanswervalue" value="" />
                                                                                <input type="hidden" name="username" value="<?php echo $username;?>" />
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="submit" name="theanswer" value="Answer" class="submit" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <?php
                                                        }
                                                                                                            
                                                        //check for blank fields
                                                        if($username==""){$error_console="Your Username is missing";}
                                                        
                                                        //check to see if there are any errors
                                                        if($error_console != ""){
                                                            /* FAILED */
                                                            echo "<br /><br />".$error_console;
                                                        } else {
                                                            /* PASSED */
                                                        }
                                                        ?>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <br />
                                                        <a href="javascript:history.go(-1)" class="white">Back</a>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else if((isset($_POST['theanswer'])) || (isset($_POST['is_auto_q'])) || (isset($_POST['savenewpassword']))){
                                            /* CHECKING SECURITY */
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                    
                                                    <h1 style="font-size:20px;line-height: 1.8em;"><br />Security Information
                                                    <?php	
                                                    //get $_POST variables
                                                    $is_auto_q=$_POST['is_auto_q'];
                                                    
                                                    //determine which method: by pin or security question												
                                                    if($is_auto_q == "yes") {
                                                        //get $_POST variables
                                                        $sapin_1=$_POST['sapin_1'];
                                                        $sapin_2=$_POST['sapin_2'];
                                                        $sapin_3=$_POST['sapin_3'];
                                                        $sapin_4=$_POST['sapin_4'];
                                                        $username=$_POST['username'];
                                                        
                                                        //make full length pin
                                                        $full_pin=$sapin_1.$sapin_2.$sapin_3.$sapin_4;
                                                        
                                                        //check for correct pin
                                                        $GET_USER_PIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
                                                        if(mysql_num_rows($GET_USER_PIN)<1){
                                                            
                                                        } else {
                                                            $FETCH_USER_PIN=mysql_fetch_array($GET_USER_PIN);
                                                            $dbpin=$FETCH_USER_PIN['pin'];
    
                                                            $username=$FETCH_USER_PIN['uname'];
                                                            if($full_pin!=$dbpin){$error_console="PIN does not match what we have on file";}
                                                        }
                                                        
                                                        //check to see if pin is blank												
                                                        if(!is_numeric($full_pin)){$error_console="PIN must contain only numbers";}
                                                        if(strlen($full_pin)<4){$error_console="PIN is too short; You have missed some numbers";}
                                                        if($full_pin==""){$error_console="PIN is missing";}
                                                        
                                                    } else {
                                                        /* DOING IT BY SQ */
                                                        
                                                        //get $_POST variables
                                                        $theanswer=$_POST['theanswervalue'];
                                                        $username=$_POST['username'];
                                                        
                                                        //check for correct answer
                                                        $GET_USER_SA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
                                                        if(mysql_num_rows($GET_USER_SA)<1){
                                                            
                                                        } else {
                                                            $FETCH_USER_SA=mysql_fetch_array($GET_USER_SA);
                                                            $dbsa=$FETCH_USER_SA['security_answer'];
                                                            $username=$FETCH_USER_SA['uname'];
                                                            if($theanswer!=$dbsa){$error_console="Your answer does not match what we have on file";}
                                                        }
                                                        
                                                    }
                                                    
                                                    
                                                    if($error_console!=""){
                                                        ?>
                                                        <br />Bad authentication!
                                                        <?php	
                                                    } else {
                                                        ?>
                                                        <br />Successfully authenticated!
                                                        <?php
                                                    }
                                                    ?>
                                                    </h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <?php													
                                                        //check error_console
                                                        if($error_console!=""){
                                                            /*FAILED*/
                                                            echo "<br /><br /><br /><br /><br /><br /><br />";
                                                            echo $error_console;
                                                            echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\"></a>";
                                                        } else {
                                                            /*PASSED*/
                                                            //reset password
                                                            if(isset($_POST['savenewpassword'])){
                                                                //get $_POST data
                                                                $username=$_POST['username'];
                                                                $newpassword=$_POST['newpassword'];
                                                                $cnewpassword=$_POST['cnewpassword'];
                                                                
                                                                //check the last password
                                                                $CHECK_LAST_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
                                                                $FETCH_LAST_PASSWORD=mysql_fetch_array($CHECK_LAST_PASSWORD);
                                                                $upass=$FETCH_LAST_PASSWORD['upass'];
                                                                $email=$FETCH_LAST_PASSWORD['email'];
                                                                global $fname;
																global $lname;
																$fname=$FETCH_LAST_PASSWORD['fname'];
                                                                $lname=$FETCH_LAST_PASSWORD['lname'];
                                                                $gender=$FETCH_LAST_PASSWORD['gender'];
                                                                $typeofuser=$FETCH_LAST_PASSWORD['type'];
                                                                
                                                                //make sure they are not blank and other checks
                                                                if(sha1($newpassword) == $upass){$error_console="You cannot use the same password. :(";}
                                                                if(strlen($newpassword)<6){$error_console="Your password must be at least 6 characters";}
                                                                if($cnewpassword!=$newpassword){$error_console="You passwords don't match";}
                                                                if($cnewpassword==""){$error_console="You must confirm your password";}
                                                                if($newpassword==""){$error_console="Your New Password is missing";}
                                                                
                                                                //check the error_console
                                                                if($error_console!=""){
                                                                    echo "<br /><br /><br /><br /><br />".$error_console;
                                                                } else {
                                                                    //encrypt it
                                                                    $newpassword=hash('sha256',md5(sha1($newpassword)));
                                                                    
                                                                    //update database
                                                                    mysql_query("UPDATE {$properties->DB_PREFIX}users SET upass='$newpassword' WHERE uname='$username'");
                                                                    
                                                                    echo "<br /><br /><br /><br /><br />Thank you! Your password has successfully been changed. We have also sent you an email to <b>{$email}</b> for your reference.";
                                                                    
                                                                    //if fname and lname are equal to BETA and BETA, then the user has not specified their fname and lname
                                                                    if(($fname=="BETA Member") || ($fname=="Admin")){if($gender=="male"){$fname="Mr.";}else if($gender=="female"){$fname="Ms.";}else if($gender=="other"){$fname="whom ever";}}
                                                                    if($lname==$username){if($gender=="male"){$lname=$uname;;}else if($gender=="female"){$lname=$upass;}else if($gender=="other"){$lname="it may concern";}}
                                                                    
                                                                    //convert typeofuser
																	global $typeofuser;
                                                                    if($typeofuser=="admin"){$typeofuser="Admin";}
                                                                    if($typeofuser=="beta"){$typeofuser="BETA Member";}
                                                                    
                                                                    //send an email with login details
                                                                    CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_reset_password',$to,$PADINFO,$pname_uri);
                                                                }
                                                            } else {
                                                            ?>
                                                            Now create your new password
                                                            <br /><br />
                                                            <form action="" method="post">
                                                                <div id="formLayoutTable">
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            <label>New Password</label>
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="password" name="newpassword" value="" />
                                                                            <input type="hidden" name="username" value="<?php echo $username;?>" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            <label>Confirm Password</label>
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="password" name="cnewpassword" value="" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="formLayoutTableRow">
                                                                        <div class="formLayoutTableRowLeftCol">
                                                                            
                                                                        </div>
                                                                        <div class="formLayoutTableRowRightCol">
                                                                            <input type="submit" class="submit" name="savenewpassword" value="Save" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <br />
                                                        <?php if($error_console==""){?><a href="../" class="white">Go home</a><?php }else{?><a href="javascript:history.go(-1)" class="white">Back</a><?php }?>
                                                    </div> 
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div id="mid-table">
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                    <h1 style="font-size:20px;line-height: 1.8em;"><br />Forget your password? No problem! Fill out the form with your username and we'll look it up for you.</h1>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                
                                                </div>
                                            </div>
                                            
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                    <form action="" method="post">
                                                        <div id="formLayoutTable">
                                                            <div class="formLayoutTableRow">
                                                                <div class="formLayoutTableRowLeftCol">
                                                                    <label>Username</label>
                                                                </div>
                                                                <div class="formLayoutTableRowRightCol">
                                                                    <input type="text" name="username" value="" />
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="formLayoutTableRow">
                                                                <div class="formLayoutTableRowLeftCol">
                                                                    
                                                                </div>
                                                                <div class="formLayoutTableRowRightCol">
                                                                    <input type="submit" class="submit" name="recover" value="Recover" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                   <br />
                                                   <a class="white" href="javascript:history.go(-1)">Back</a>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    break;
                                    
                                    case 'request':
                                    if(isset($_POST['request'])){
                                        /* DO REQUEST PROCESS */
                                        ?>
                                        <div id="mid-table">
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                    <h1 style="font-size:20px;line-height: 1.8em;"></h1>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                
                                                </div>
                                            </div>
                                            
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                    <?php
                                                    /* CHECK CONTENT */
                                                    
                                                    //get $_POST data
													global $username;
													global $password;
                                                    $username=$_POST['username'];
                                                    $password=$_POST['password'];
                                                    $cpassword=$_POST['cpassword'];
                                                    $email=$_POST['email'];
                                                    $why=$_POST['why'];
                                                    
                                                    $pin_1=$_POST['pin_1'];
                                                    $pin_2=$_POST['pin_2'];
                                                    $pin_3=$_POST['pin_3'];
                                                    $pin_4=$_POST['pin_4'];
                                                    
													global $full_pin;
                                                    $full_pin=$pin_1.$pin_2.$pin_3.$pin_4;
                                                    
                                                    //check the pin for accuracy
                                                    if(!is_numeric($full_pin)){$error_console="PIN must be numeric (no letters)";}
                                                    if(strlen($full_pin)<4){$error_console="PIN is not long enough; You missed a few numbers";}
                                                    if($full_pin==""){$error_console="PIN is missing";}
                                                    
                                                    //check for blanks
                                                    if($why==""){$error_console="Why is missing";}
                                                    //check email in db
                                                    $CHECK_EMAIL_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE email='$email' AND status!='denied'");
                                                    if(mysql_num_rows($CHECK_EMAIL_IN_DB)<1){/* NOT FOUND; WE'RE GOOD */$email_in_db=false;} else {/* FOUND EMAIL; BAD */$email_in_db=true;}													
                                                    if($email_in_db == true){$error_console="<b>".$email."</b> is already in use";}
                                                    if(CHECK_EMAIL($email) == false){$error_console="Your Email doesn't look valid";}
                                                    if($email==""){$error_console="Your Email is missing";}
                                                    if($cpassword==""){$error_console="You must confirm your password";}
                                                    if($password==""){$error_console="Your Password is missing";}
                                                    if($username==""){$error_console="Your Username is missing";}
    
                                                    //check for passwords match
                                                    if($password != $cpassword){$error_console="Your passwords don't match";}
                                                    
                                                    //check password len
                                                    if(strlen($password)<6){$error_console="Your password must be at least 6 characters long";}
                                                    
                                                    //check for username avail in db
                                                    $GET_USER_IN_DB=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username' AND status!='denied'");
                                                    if(mysql_num_rows($GET_USER_IN_DB)<1){
                                                        /* username is cleared; not in db */
                                                    } else {												
                                                        $error_console="{$username} is already taken";
                                                    }											
                                                    
                                                    //check to see if there are any errors
                                                    if($error_console != ""){
                                                        /* THERE ARE ERRORS */
                                                        echo "<center><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />".$error_console."</center>";
                                                        echo " <a href=\"javascript:history.go(-1)\" class=\"white\">Go back</a>";
                                                    } else {
                                                        /* PASSED */
                                                        echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Thank you for your interest in wanting to join our Admin team! We will review your application and should be able to get back to you within in 24 to 72 hours. Please be patient as bugging us will prolong the application process. :) <a href=\"../\" class=\"white\">Go Home</a>";
                                                        //encrypt the password
                                                        $epassword=hash('sha256',md5(sha1($password)));
														
														//get the date and time
														$dateandtime_applied=date("Y-m-d H:i:s");
                                                        
                                                        //put user into db
                                                        mysql_query("INSERT INTO {$properties->DB_PREFIX}users (fname,lname,uname,upass,email,type,is_searchable,staff_type,status,pin,why,dateandtime_applied) VALUES ('ADMIN','$username','$username','$epassword','$email','admin','yes','','pending','$full_pin','$why','$dateandtime_applied')");
                                                        
                                                        //get user data
                                                        
                                                        //specials for email
														global $event_name;
                                                        $event_name="Admin Registration";
                                                        
                                                        //get the headwebmaster's title
                                                        $GET_HW_TITLE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='".$properties->WEBMASTER_UNAME."'");
                                                        $FETCH_HW_TITLE=mysql_fetch_array($GET_HW_TITLE);
                                                        $staff_type=$FETCH_HW_TITLE['staff_type'];
                                                        
                                                        //fetch the staff type name
                                                        $GET_TITLE_NAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='{$staff_type}'");
                                                        $FETCH_TITLE_NAME=mysql_fetch_array($GET_TITLE_NAME);
                                                        $webmaster_title=$FETCH_TITLE_NAME['name'];
                                                        
                                                        //send an email with login details
														CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_admin_registration',$to,$PADINFO,$pname_uri);
                                                    }
                                                    ?>
                                                </div>
                                                <div id="mid-table-rightcol">
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="mid-table-row">
                                                <div id="mid-table-leftcol">
                                                
                                                </div>
                                                <div id="mid-table-midcol">
                                                    
                                                </div>
                                                <div id="mid-table-rightcol">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        $max_positions=getGlobalVars($properties,'max_admin_positions');
                                        //get the number of users
                                        $GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND status='active'");
                                        $num_of_users=mysql_num_rows($GET_USERS);
                                        $num_of_pos_left=$max_positions - $num_of_users;
                                        if($num_of_pos_left<0){$num_of_pos_left=0;}
                                        if($num_of_pos_left<1){
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <h1 style="font-size:28px;line-height: 1em;"><br /><br /><br /><br />Well this is embarrassing...</h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        Sorry...there are no positions available and the fact that you are here let's us know you are trying to get around the system and that is not going to look good if you want to work for us since we monitor all activity on this website. :)
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                       <br /><a href="javascript:history.go(-1)" class="white">Back</a>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <h1 style="font-size:20px;line-height: 1.8em;">Use this form to submit a request to us if you want to be an admin for us</h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <form action="" method="post">
                                                            <div id="formLayoutTable">
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        <label>Username</label>
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <input type="text" name="username" />
                                                                    </div>
                                                                </div>
                                                                                                        
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        <label>Password</label>
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <input type="password" name="password" />
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        <label>Confirm Password</label>
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <input type="password" name="cpassword" />
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        <label>Email</label>
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <input type="text" name="email" />
                                                                    </div>
                                                                </div>      
                                                                
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        <label>Why?</label>
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <input type="text" name="why" />
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        <label>Create a PIN [<a style="cursor:pointer;" class="white" title="This is for extra security; Plus it is used to recover your username or password if you have not set up a Security Question and Answer">?</a>]</label>
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        &nbsp;&nbsp;
                                                                        <input type="text" name="pin_1" class="pin" maxlength=1 /> 
                                                                        <input type="text" name="pin_2" class="pin" maxlength=1 /> 
                                                                        <input type="text" name="pin_3" class="pin" maxlength=1 /> 
                                                                        <input type="text" name="pin_4" class="pin" maxlength=1 /> 
                                                                    </div>
                                                                </div>                         
                                                                
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <input type="submit" class="submit" name="request" value="Request" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                       <br /><a href="javascript:history.go(-1)" class="white">Back</a>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php	
                                        }
                                    }
                                    break;
                                    
                                    default:
                                        //get necessary stuff
                                        $ip=$_SERVER['REMOTE_ADDR'];
                                        $logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
                                        
                                        //check for logged in status
                                        $CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
                                        if(mysql_num_rows($CHECK_LOGIN)<1){
                                            /* USER NOT LOGGED */
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <h1 style="font-size:20px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        The Reason we have closed this website for construction is so that no one can see what we are working on until we do the necessary checks and balances that come with building a website. We also believe that this shows progress and we like progress. :)
                                                        
                                                        <script>
                                                            $(document).ready(function() {
                                                                $("#progress-bar").progressbar({ value: <?php echo getGlobalVars($properties,'percent_complete');?> });
                                                            });
                                                        </script>
                                                        <div id="progress-bar"></div>
                                                        
                                                        If you are an Admin with <?php echo $properties->COMPANY_NAME;?> then you can click on the &quot;Control&quot; link to access a special form that allows you to login to manage this flood gate.
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <h1 style="font-size:28px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_mid');?></h1>
                                                        <?php
                                                        //get the launchday
                                                        $launch_day=getGlobalVars($properties,'launch_day');
                                                        ?>
                                                        <h1 style="font-size:48px;line-height: .5em;"><?php echo $launch_day;?></h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            /* USER LOGGED IN */
                                            $FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
                                            $fname=$FETCH_LOGIN['fname'];
                                            $username=$FETCH_LOGIN['uname'];
                                            $lname=$FETCH_LOGIN['lname'];
                                            ?>
                                            <div id="mid-table">
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <h1 style="font-size:25px;line-height: 1.8em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Admin Access Control Panel</h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <h1 style="font-size:18px;line-height: 1.2em;">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</h1>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        <?php
                                                        if(isset($_POST['change_']) || isset($_POST['change_mode'])){
                                                            //get the option
                                                            $option=$_POST['wtd'];
                                                            switch($option){
                                                                case '':
                                                                    /* none */
                                                                    echo "You must select an option";
                                                                break;
                                                                											
                                                            }
                                                            echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
                                                        } else {
                                                        ?>
                                                        <h2 style="line-height:.5em;">What do you want to do?</h2>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="logoutusername" value="<?php echo $username?>" />
                                                            <div id="formLayoutTable">
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        <label>Choose a command</label>
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <select name="wtd">
                                                                            <option value="">--- choose what you want to do ---</option>
                                                                            <?php if($head_admin=="yes"){?><option value="adjust_mar">Adjust Max Admins Rate</option><?php }?>
																				<?php if($head_admin=="yes"){?><option value="adjust_mbr">Adjust Max Closed BETA Members Rate</option><?php }?>
                                                                                <?php if($head_admin=="yes"){?><option value="apc">Adjust Percent Complete</option><?php }?>
                                                                                <?php if($head_admin=="yes"){?><option value="change_cmm">Change closed message middle</option><?php }?>
                                                                                <?php if($head_admin=="yes"){?><option value="change_cmt">Change closed message top</option><?php }?>
                                                                                <?php if($head_admin=="yes"){?><option value="change_mode">Change Mode</option><?php }?>
                                                                                <?php if($head_admin=="yes"){?><option value="change_ldd">Change the Launch Day date</option><?php }?>
																				<option value="enter_site">Enter site</option>
                                                                                <?php if($head_admin=="yes"){?><option value="review_applicants">Review Applicants</option><?php }?>
                                                                                <option value="user_cp">User CP</option>
                                                                        </select>
                                                                    </div>
                                                                </div>                   
                                                                
                
                                                                <div class="formLayoutTableRow">
                                                                    <div class="formLayoutTableRowLeftCol">
                                                                        
                                                                    </div>
                                                                    <div class="formLayoutTableRowRightCol">
                                                                        <input type="submit" name="change_" value="Go" class="submit" /> 
                                                                        <input type="submit" name="logout" value="Logout" class="submit" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <br />
                                                        <?php	
                                                        }
                                                        ?>
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="mid-table-row">
                                                    <div id="mid-table-leftcol">
                                                    
                                                    </div>
                                                    <div id="mid-table-midcol">
                                                        
                                                    </div>
                                                    <div id="mid-table-rightcol">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    break;
                                }
                            }
                        } else {
                            //get necessary stuff
                            $ip=$_SERVER['REMOTE_ADDR'];
                            $logged_session=$_COOKIE[$properties->_COOKIE_INIT_SESSION];
                            
                            //check for logged in status
                            $CHECK_LOGIN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE logged_ip='$ip' AND logged_session='$logged_session'");
                            if(mysql_num_rows($CHECK_LOGIN)<1){
                                /* USER NOT LOGGED */
                                ?>
                                <div id="mid-table">
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            <h1 style="font-size:20px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_top');?></h1>
                                        </div>
                                        <div id="mid-table-rightcol">
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            The Reason we have closed this website for construction is so that no one can see what we are working on until we do the necessary checks and balances that come with building a website. We also believe that this shows progress and we like progress. :)
                                            
                                            <script>
                                                $(document).ready(function() {
                                                    $("#progress-bar").progressbar({ value: <?php echo getGlobalVars($properties,'percent_complete');?> });
                                                });
                                            </script>
                                            <div id="progress-bar"></div>
                                            
                                            If you are an Admin with <?php echo $properties->COMPANY_NAME;?> then you can click on the &quot;Control&quot; link to access a special form that allows you to login to manage this flood gate.
                                        </div>
                                        <div id="mid-table-rightcol">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            <h1 style="font-size:28px;line-height: 1.8em;"><?php echo getGlobalVars($properties,'closed_message_mid');?></h1>
                                            <?php
                                            //get the launchday
                                            $launch_day=getGlobalVars($properties,'launch_day');
                                            ?>
                                            <h1 style="font-size:48px;line-height: .5em;"><?php echo $launch_day;?></h1>
                                        </div>
                                        <div id="mid-table-rightcol">
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            
                                        </div>
                                        <div id="mid-table-rightcol">
                                        
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                /* USER LOGGED IN */
                                $FETCH_LOGIN=mysql_fetch_array($CHECK_LOGIN);
                                $fname=$FETCH_LOGIN['fname'];
                                $username=$FETCH_LOGIN['uname'];
                                $lname=$FETCH_LOGIN['lname'];
                                $type=$FETCH_LOGIN['type'];
                                $tou_status=$FETCH_LOGIN['tou_status'];
                                ?>
                                <div id="mid-table">
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            <h1 style="font-size:25px;line-height: 1.2em;">Hello <?php echo $fname." ".$lname;?>!<br />Welcome to the Admin Access Control Panel</h1>
                                        </div>
                                        <div id="mid-table-rightcol">
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            <h1 style="font-size:18px;line-height: 1.2em;">Using this panel gives you full access to control this site as an admin. You may not abuse your special powers or else you will be terminated without warning.</h1>
                                        </div>
                                        <div id="mid-table-rightcol">
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            <?php
                                            if(isset($_POST['change_']) || isset($_POST['change_mode']) || isset($_POST['adjust_mar']) || isset($_POST['adjust_mbr']) || isset($_POST['postapc']) || isset($_POST['apc']) || isset($_POST['postmessage']) || isset($_POST['postldd']) || isset($_POST['set_tou'])){
                                                //get the option
                                                $option=$_POST['wtd'];
                                                switch($option){
                                                    case '':
                                                        /* none */
                                                        echo "You must select an option";
                                                    break;
                                                    case 'adjust_mar':
														if(isset($_POST['adjust_mar'])){
															//get post
															$newmar=$_POST['mar'];
															
															if($error_console!=""){
																/*failed*/
																echo $error_console;
																echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
															} else {
																/*passed*/
																//update the datbase
																mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_admin_positions='$newmar'");
																echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
															}
														} else {
														?>
														Use of this form is to allow you as an admin to change the amount of positions open for admins
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Max Admin Rate</label>
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="hidden" name="wtd" value="adjust_mar" />
																		<input type="number" name="mar" style="width:150px;" min="0" max="1000" value="<?php echo getGlobalVars($properties,'max_admin_positions');?>" />
																	</div>
																</div>                   
																
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="adjust_mar" value="Save" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php	
														}
													break;
													
													case 'adjust_mbr':
														if(isset($_POST['adjust_mbr'])){
															//get post
															$newmbr=$_POST['mbr'];
															
															if($error_console!=""){
																/*failed*/
																echo $error_console;
																echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
															} else {
																/*passed*/
																//update the datbase
																mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_closed_beta_positions='$newmbr'");
																echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
															}
														} else {
														?>
														Use of this form is to allow you as an admin to change the amount of positions open for Closed BETA Members
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Max BETA Member Rate</label>
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="hidden" name="wtd" value="adjust_mbr" />
																		<input type="number" name="mbr" style="width:150px;" min="0" max="1000" value="<?php echo getGlobalVars($properties,'max_closed_beta_positions');?>" />
																	</div>
																</div>                   
																
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="adjust_mbr" value="Save" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php	
														}
													break;
													
													case 'apc':
														if(isset($_POST['postapc'])){
															//get post
															$newpc=$_POST['percent'];
															
															if($error_console!=""){
																/*failed*/
																echo $error_console;
																echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
															} else {
																/*passed*/
																//update the datbase
																mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET percent_complete='$newpc'");
																echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
															}
														} else {
														?>
														This form will change the mode of this entire site. Be careful when doing so, as some options might unleash this site to the public prematurely and/or take you away from this place.
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Mode</label>
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="hidden" name="wtd" value="apc" />
																		<input type="number" step=".01" min="0" max="100" name="percent" value="<?php echo getGlobalVars($properties,'percent_complete');?>" />
																	</div>
																</div>                   
																
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="postapc" value="Save" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php	
														}
													break;
													
													case 'change_cmm':
														if(isset($_POST['postmessage'])){
															//get post
															$newmessage=$_POST['message'];
															
															if($error_console!=""){
																/*failed*/
																echo $error_console;
																echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
															} else {
																/*passed*/
																//update the datbase
																mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_mid='$newmessage'");
																echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
															}
														} else {
														?>
														Use this to chance the message that gets displayed on the closed sign in the middle before the date
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Message</label>
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="hidden" name="wtd" value="change_cmm" />
																		<input type="text" name="message" value="<?php echo getGlobalVars($properties,'closed_message_mid');?>" />
																	</div>
																</div>                   
																
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="postmessage" value="Save" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php	
														}
													break;
													
													case 'change_cmt':
														if(isset($_POST['postmessage'])){
															//get post
															$newmessage=$_POST['message'];
															
															if($error_console!=""){
																/*failed*/
																echo $error_console;
																echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
															} else {
																/*passed*/
																//update the datbase
																mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_top='$newmessage'");
																echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
															}
														} else {
														?>
														Use this to chance the message that gets displayed on the closed sign in the middle before the date
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Message</label>
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="hidden" name="wtd" value="change_cmt" />
																		<input type="text" name="message" value="<?php echo getGlobalVars($properties,'closed_message_top');?>" />
																	</div>
																</div>                   
																
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="postmessage" value="Save" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php	
														}
													break;
													
													case 'change_mode':
														if(isset($_POST['change_mode'])){
															//get post
															$newmode=$_POST['mode'];
															
															if($newmode==""){$error_console="You must select a mode";}
															
															if($error_console!=""){
																/*failed*/
																echo $error_console;
																echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
															} else {
																/*passed*/
																//update the datbase
																mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET mode='$newmode'");
																echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
															}
														} else {
														?>
														This form will change the mode of this entire site. Be careful when doing so, as some options might unleash this site to the public prematurely and/or take you away from this place.
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Mode</label>
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="hidden" name="wtd" value="change_mode" />
																		<select name="mode" onchange="document.getElementById('change_mode').disabled=false;">
																			<?php
																			//detect which mode it is in
																			$mode=getGlobalVars($properties,'mode');
																			$modes="closed,alpha mode,closed beta,open beta,open,maintenance,";
																			$modes_names="Closed,Alpha Mode,Closed BETA,Open BETA,Open,Maintenance";
																			$modes_list=explode(",",$modes);
																			$modes_names_list=explode(",",$modes_names);
																			for($i=0; $i<count($modes_list)-1; $i++){
																				if($mode==$modes_list[$i]){
																					?>
																					<option selected="selected" disabled="disabled" value="<?php echo $modes_list[$i];?>"><?php echo $modes_names_list[$i];?></option>
																					<?php																			
																				} else {
																					?>
																					<option value="<?php echo $modes_list[$i];?>"><?php echo $modes_names_list[$i];?></option>
																					<?php	
																				}
																			}
																			?>
																		</select>
																	</div>
																</div>                   
																
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="change_mode" id="change_mode" disabled="disabled" value="Save" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php	
														}
													break;
													
													case 'change_ldd':
														if(isset($_POST['postldd'])){
															//get post
															$newldd=$_POST['date'];
															
															if($error_console!=""){
																/*failed*/
																echo $error_console;
																echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
															} else {
																/*passed*/
																//update the datbase
																mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET launch_day='$newldd'");
																echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
															}
														} else {
														?>
														This will change the Launch Day Date that displays on the closed page. The format is XX/XX/XXXX where X's can represent Question Marks (?).
														<form action="" method="post">
															<div id="formLayoutTable">
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		<label>Launch Day Date</label>
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="hidden" name="wtd" value="change_ldd" />
																		<input type="text" maxlength="10" name="date" value="<?php echo getGlobalVars($properties,'launch_day');?>" />
																	</div>
																</div>                   
																
																<div class="formLayoutTableRow">
																	<div class="formLayoutTableRowLeftCol">
																		
																	</div>
																	<div class="formLayoutTableRowRightCol">
																		<input type="submit" name="postldd" value="Save" class="submit" />
																	</div>
																</div>
															</div>
														</form>
														<?php	
														}
													break;			
													
													case 'enter_site':
														if(isset($_POST['set_tou'])){
															/* POST ACTION FOR TOU */
															//get post elements
															$agree_status="unchecked";
															$disagree_status="unchecked";
															$set_tou=$_POST['tou'];
															
															if($set_tou=="agree"){
																/* agreed to tou */
																$error_console="";
																
															} else if($set_tou=="disagree") {
																/* disagreed to tou */
																$error_console="You must agree to the Terms of Use before you go in";
															} else {
																$error_console="You must respond before you go in";
															}
															 
															if($error_console!=""){
																/* FAILED */
																echo $error_console;
																
															} else {
																/* PASSED */
																//update user
																mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
																mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE  uname='$username'");

																echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
															}
															
														} else {
															if($tou_status=="agree"){
																/* TOU GOOD */
																mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
																echo "It looks like you are ready to go. When you are ready, <h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>to enjoy the awesomeness of Nat4an!";
																
															} else if($tou_status=="disagree"){
																/* TOU BAD */
																?>
																Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
																<br /><br />
																<form action="" method="post">
																	<div id="formLayoutTable">
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label>Your response</label>
																			</div>
																			<div class="formLayoutTableRowLeftCol">
																				<input type="hidden" name="wtd" value="enter_site" />
																				<input type="radio" name="tou" value="agree" /> I agree
																				<input type="radio" name="tou" value="disagree" /> I disagree
																				
																			</div>
																		</div>                   
																		<br />
																		<div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="set_tou" value="Enter" class="submit" />
																			</div>
																		</div>
																	</div>
																</form>
																<?php
															}	
														}
													break;	
													
													case 'review_applicants':
														if(isset($_POST['rapplicant'])){
																//get post
																$applicant_id=$_POST['applicant_id'];
																$response=$_POST['response'];
																
																if($response==""){$error_console="You must respond to this applicant";}
																
																if($error_console!=""){
																	/*failed*/
																	echo $error_console;
																
																} else {
																	/*passed*/
																	//update the datbase
																	if($response=="approve"){
																		mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='active' WHERE id='$applicant_id'");
																		//get user info
																		$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
																		$FETCH_USER=mysql_fetch_array($GET_USER);
																		$fname=$FETCH_USER['fname'];
																		$lname=$FETCH_USER['lname'];
																		$email=$FETCH_USER['email'];
																		
																		//send an email with login details
																		$to=$email;
																		$subject=$properties->WEBSITE_NAME.$properties->WEBSITE_EXT." Admin Account Decision";
																		$message="Hello ".$fname." ".$lname.",<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Approved</b>. You may now logged into our site. <br /><br />Take care and in His Name,<br /><br />".$properties->WEBMASTER_NAME."<br />The ".$properties->COMPANY_NAME." Staff<br />".$webmaster_title."<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.";
																		$headers="From: ". $properties->WEBMASTER_EMAIL . "\r\n" .
																				 "MIME-Version: 1.0" . "\r\n" .
																				 "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
																				 "Reply-To: ".$properties->WEBMASTER_EMAIL . "\r\n" .
																				 "X-Mailer: PHP/" . phpversion();
																																			 
																		SENDMAIL($to,$subject,$message,$headers);
																	} else if($response=="deny"){
																		mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='denied' WHERE id='$applicant_id'");
																		//get user info
																		$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
																		$FETCH_USER=mysql_fetch_array($GET_USER);
																		$fname=$FETCH_USER['fname'];
																		$lname=$FETCH_USER['lname'];
																		$email=$FETCH_USER['email'];
																		
																		//send an email with login details
																		$to=$email;
																		$subject=$properties->WEBSITE_NAME.$properties->WEBSITE_EXT." Admin Account Decision";
																		$message="Hello ".$fname." ".$lname.",<br /><br />We just want to write you to let you know that your application request to be an Admin has been <b>Denied</b>. We are terribly sorry about this but you don't quite meet our qualifications yet. If you want you can always reapply for the position. <br /><br />Take care and in His Name,<br /><br />".$properties->WEBMASTER_NAME."<br />The ".$properties->COMPANY_NAME." Staff<br />".$webmaster_title."<br /><br />NOTE: This message was automatically generated. Please do not reply to this message, as this mailbox is not monitored.";
																		$headers="From: ". $properties->WEBMASTER_EMAIL . "\r\n" .
																				 "MIME-Version: 1.0" . "\r\n" .
																				 "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
																				 "Reply-To: ".$properties->WEBMASTER_EMAIL . "\r\n" .
																				 "X-Mailer: PHP/" . phpversion();
																																			 
																		SENDMAIL($to,$subject,$message,$headers);
																	}
																	echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
																}
															} else {
																//get the number of applicants
																$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending'");
																$num_of_applicants=mysql_num_rows($GET_USERS);
																?>
																Use this place to review applicants for positions
																<form action="" method="post">
                                                                	<input type="hidden" name="wtd" value="review_applicants" />
																	<div id="formLayoutTable">
																		<?php
																		if($num_of_applicants<1){
																			/* NO APPLICANTS */
																		} else {
																		?>
                                                                        <div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				<label># Applicants</label>
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<?php echo $num_of_applicants;?>
																			</div>
																		</div>
                                                                        <?php	
																		}
																		?>
																		<?php
																		//get all the applicants
																		if($num_of_applicants<1){
																			echo "No Applicants";	
																		} else if($num_of_applicants>0) {
																			$GET_APPLICANTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending' ORDER BY dateandtime_applied LIMIT 1");
																			while($FETCH_APPLICANTS=mysql_fetch_array($GET_APPLICANTS)){
																				$id=$FETCH_APPLICANTS['id'];
																				$fname=$FETCH_APPLICANTS['fname'];
																				$lname=$FETCH_APPLICANTS['lname'];
																				$type=$FETCH_APPLICANTS['type'];
																				$why=$FETCH_APPLICANTS['why'];
																				?>
                                                                                <input type="hidden" name="applicant_id" value="<?php echo $id;?>" />
                                                                                <div class="formLayoutTableRow">
                                                                                    <div class="formLayoutTableRowLeftCol">
                                                                                        <label>Name</label>
                                                                                    </div>
                                                                                    <div class="formLayoutTableRowRightCol">
                                                                                        <?php echo $fname." ".$lname;?>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="formLayoutTableRow">
                                                                                    <div class="formLayoutTableRowLeftCol">
                                                                                        <label>Type</label>
                                                                                    </div>
                                                                                    <div class="formLayoutTableRowRightCol">
                                                                                        <?php echo $type;?>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="formLayoutTableRow">
                                                                                    <div class="formLayoutTableRowLeftCol">
                                                                                        <label>Why</label>
                                                                                    </div>
                                                                                    <div class="formLayoutTableRowRightCol">
                                                                                    	<?php if(strlen($why)>35){$ending="...";}else{$ending="";}?>
                                                                                        <?php echo "<a title=\"".$why."\" class=\"white\">".substr($why,0,32).$ending."</a>";?>
                                                                                    </div>
                                                                                </div>
                                                                                <br />
                                                                                <div class="formLayoutTableRow">
                                                                                    <div class="formLayoutTableRowLeftCol">
                                                                                        <label>Respond</label>
                                                                                    </div>
                                                                                    <div class="formLayoutTableRowRightCol">
                                                                                        <select name="response">
                                                                                            <option value="">--------------- your response ---------------</option>
                                                                                            <option value="approve">Approve</option>
                                                                                            <option value="deny">Deny</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
																			}
																		}
																		?>
																		
																		<?php
																		if($num_of_applicants<1){
																			/* NO APPLICANTS */
																		} else {
																		?>
                                                                        <div class="formLayoutTableRow">
																			<div class="formLayoutTableRowLeftCol">
																				
																			</div>
																			<div class="formLayoutTableRowRightCol">
																				<input type="submit" name="rapplicant" value="Save" class="submit" />
																			</div>
																		</div>
                                                                        <?php	
																		}
																		?>
																	</div>
																</form>
																<?php	
															}
													break;	
													
													case 'user_cp':
														?>
											Welcome to your User CP! Here is where you can change all the attributes of your online profile here. 
											<form action="" method="post">
												<input type="hidden" name="wtd" value="user_cp" />
												<div id="formLayoutTable">
													<div class="formLayoutTableRow">
														<div class="formLayoutTableRowLeftCol">
															<label>First Name</label>
															<br />
															<label>Last Name</label>
															<br />
															<label>Gender</label>
															<br />
															<label>Password</label>
															
														</div>
														<div class="formLayoutTableRowRightCol">
															<input type="text" name="ucp_" value="" />
														</div>
													</div>
													
													<div class="formLayoutTableRow">
														<div class="formLayoutTableRowLeftCol">
															
														</div>
														<div class="formLayoutTableRowRightCol">
															<input type="submit" name="user_cp_save" value="Save" class="submit" />
														</div>
													</div>
												</div>
											</form>
											<?php
													break;								
                                                }
                                            } else {
                                            ?>
                                            <h2 style="line-height:.5em;">What do you want to do?</h2>
                                            <form action="" method="post">
                                                <input type="hidden" name="logoutusername" value="<?php echo $username?>" />
                                                <div id="formLayoutTable">
                                                    <div class="formLayoutTableRow">
                                                        <div class="formLayoutTableRowLeftCol">
                                                            <label>Choose a command</label>
                                                        </div>
                                                        <div class="formLayoutTableRowRightCol">
                                                            <select name="wtd">
                                                                <option value="">--- choose what you want to do ---</option>
                                                                <?php if($head_admin=="yes"){?><option value="adjust_mar">Adjust Max Admins Rate</option><?php }?>
																<?php if($head_admin=="yes"){?><option value="adjust_mbr">Adjust Max Closed BETA Members Rate</option><?php }?>
                                                                <?php if($head_admin=="yes"){?><option value="apc">Adjust Percent Complete</option><?php }?>
                                                                <?php if($head_admin=="yes"){?><option value="change_cmm">Change closed message middle</option><?php }?>
                                                                <?php if($head_admin=="yes"){?><option value="change_cmt">Change closed message top</option><?php }?>
                                                                <?php if($head_admin=="yes"){?><option value="change_mode">Change Mode</option><?php }?>
                                                                <?php if($head_admin=="yes"){?><option value="change_ldd">Change the Launch Day date</option><?php }?>
                                                                <option value="enter_site">Enter site</option>
                                                                <?php if($head_admin=="yes"){?><option value="review_applicants">Review Applicants</option><?php }?>
                                                                <option value="user_cp">User CP</option>
                                                            </select>
                                                        </div>
                                                    </div>                   
                                                    
                                                    <div class="formLayoutTableRow">
                                                        <div class="formLayoutTableRowLeftCol">
                                                            
                                                        </div>
                                                        <div class="formLayoutTableRowRightCol">
                                                            <input type="submit" name="change_" value="Go" class="submit" /> 
                                                            <input type="submit" name="logout" value="Logout" class="submit" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <br />
                                            <?php	
                                            }
                                            ?>
                                        </div>
                                        <div id="mid-table-rightcol">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="mid-table-row">
                                        <div id="mid-table-leftcol">
                                        
                                        </div>
                                        <div id="mid-table-midcol">
                                            <a href="javascript:history.go(-1)" class="white">Back</a>
                                        </div>
                                        <div id="mid-table-rightcol">
                                        
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="bottom">
                        <br />
                        <center>
                        <?php
						/* LOAD DYNAMICALLY-UPDATED LINK FILE */
						include("includes/private/tools/spashlinks.php");
						?>			
                        </center>
                    </div>
                </div>
                
                <div id="splash-col3">
                    
                </div>
            </div>
        </div>
    
    </div>    
    <?php
}
?>