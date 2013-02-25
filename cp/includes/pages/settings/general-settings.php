<h1>General Settings</h1>
<?php
if(isset($_POST['save'])){
	/* SITE UPDATES */
	/* STEP 1: GET ALL DATA */
	$data_autoresponder_closing_line=mysql_real_escape_string($_POST['autoresponder_closing_line']);
	$data_is_searchable=mysql_real_escape_string($_POST['is_searchable']);
	$data_mode=mysql_real_escape_string($_POST['mode']);
	$data_top_nav_use=mysql_real_escape_string($_POST['top_nav_use']);
	$data_webmaster_email=mysql_real_escape_string($_POST['webmaster_email']);
	
	$data_main_twitter_avatar_size=mysql_real_escape_string($_POST['main_twitter_avatar_size']);
	$data_main_twitter_loading_text=mysql_real_escape_string($_POST['main_twitter_loading_text']);
	$data_main_twitter=mysql_real_escape_string($_POST['main_twitter']);
	$data_main_twitter_count=mysql_real_escape_string($_POST['main_twitter_count']);
	$data_main_twitter_auto_join_text_default=mysql_real_escape_string($_POST['main_twitter_auto_join_text_default']);
	
	$data_main_twitter_auto_join_text_ed=mysql_real_escape_string($_POST['main_twitter_auto_join_text_ed']);
	$data_main_twitter_auto_join_text_ing=mysql_real_escape_string($_POST['main_twitter_auto_join_text_ing']);
	$data_main_twitter_auto_join_text_reply=mysql_real_escape_string($_POST['main_twitter_auto_join_text_reply']);
	$data_main_twitter_auto_join_text_url=mysql_real_escape_string($_POST['main_twitter_auto_join_text_url']);
	$data_sociallinks_jcarousel_auto=mysql_real_escape_string($_POST['sociallinks_jcarousel_auto']);
	
	$data_sociallinks_jcarousel_wrap=mysql_real_escape_string($_POST['sociallinks_jcarousel_wrap']);
	$data_sociallinks_jcarousel_scrollamt=mysql_real_escape_string($_POST['sociallinks_jcarousel_scrollamt']);
	$data_sociallinks_theme=mysql_real_escape_string($_POST['sociallinks_theme']);
	$data_sociallinks_type=mysql_real_escape_string($_POST['sociallinks_type']);
	$data_tagcloud_count=mysql_real_escape_string($_POST['tagcloud_count']);
	
	$data_closed_message_top=mysql_real_escape_string($_POST['closed_message_top']);
	$data_closed_message_mid=mysql_real_escape_string($_POST['closed_message_mid']);
	$data_launch_day=mysql_real_escape_string($_POST['launch_day']);
	$data_max_admin_positions=mysql_real_escape_string($_POST['max_admin_positions']);
	$data_max_closed_beta_positions=mysql_real_escape_string($_POST['max_closed_beta_positions']);
	
	$data_percent_complete=mysql_real_escape_string($_POST['percent_complete']);
	$data_status_update=mysql_real_escape_string($_POST['status_update']);
	
	/* STEP 2: CHECK DATA FOR ACCURACY */
	if($data_autoresponder_closing_line == ""){$error_console.="Autoresponder Closing Line is blank; cannot be blank.<br />";}
	if($data_webmaster_email == ""){$error_console="You must provide a Webmaster Email; this is what is used for the system to send messages.<br />";}
	if($data_main_twitter_loading_text == ""){$error_console="Twitter Feed Loading Text is missing; cannot be blank.<br />";}
	if($data_main_twitter_auto_join_text_default == ""){$error_console="Missing the auto join text default for main twitter; cannot be blank.<br />";}
	if($data_main_twitter_auto_join_text_ed == ""){$error_console="Missing the auto join text ed for main twitter; cannot be blank.<br />";}
	if($data_main_twitter_auto_join_text_ing == ""){$error_console="Missing the auto join text ing for main twitter; cannot be blank.<br />";}
	if($data_main_twitter_auto_join_text_reply == ""){$error_console="Missing the auto join text reply for main twitter; cannot be blank.<br />";}
	if($data_main_twitter_auto_join_text_url == ""){$error_console="Missing the auto join text url for main twitter; cannot be blank.<br />";}	
	
	if($error_console != "") {
		/* THERE IS AN ERROR */	
		echo $error_console;
	} else {
		/* STEP 3: POST TO DATABASE */
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET autoresponder_closing_line = '$data_autoresponder_closing_line'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET is_searchable = '$data_is_searchable'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET mode = '$data_mode'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET top_nav_use = '$data_top_nav_use'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET webmaster_email = '$data_webmaster_email'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_avatar_size = '$data_main_twitter_avatar_size'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_loading_text = '$data_main_twitter_loading_text'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter = '$data_main_twitter'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_count = '$data_main_twitter_count'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_auto_join_text_default = '$data_main_twitter_auto_join_text_default'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_auto_join_text_ed = '$data_main_twitter_auto_join_text_ed'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_auto_join_text_ing = '$data_main_twitter_auto_join_text_ing'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_auto_join_text_reply = '$data_main_twitter_auto_join_text_reply'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET main_twitter_auto_join_text_url = '$data_main_twitter_auto_join_text_url'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET sociallinks_jcarousel_auto = '$data_sociallinks_jcarousel_auto'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET sociallinks_jcarousel_scrollamt = '$data_sociallinks_jcarousel_scrollamt'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET sociallinks_jcarousel_wrap = '$data_sociallinks_jcarousel_wrap'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET sociallinks_theme = '$data_sociallinks_theme'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET sociallinks_type = '$data_sociallinks_type'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET tagcloud_count = '$data_tagcloud_count'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_top = '$data_closed_message_top'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET closed_message_mid = '$data_closed_message_mid'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET launch_day = '$data_launch_day'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_admin_positions = '$data_max_admin_positions'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET max_closed_beta_positions = '$data_max_closed_beta_positions'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET percent_complete = '$data_percent_complete'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET status_update = '$data_status_update'");
				
		/* STEP 4: RETURN SUCCESS */
		echo "Successfully saved! <a href=\"?menu=settings\">Refresh</a>";
	}
} else {
	?>
	<form action="" method="post">
		<fieldset>
		<legend>Global Variables</legend>
			<fieldset>
			<legend>Basic Properties</legend>
				<fieldset>
					<legend>Main</legend>
					<div class="formLayoutTableMainAll">                    
						<div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Autoresponder Closing Line
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<input type="text" name="autoresponder_closing_line" value="<?php echo getGlobalVars($properties,'autoresponder_closing_line');?>" />
							</div>
						</div>
						
						<div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Is Searchable
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<input type="radio" name="is_searchable" value="yes" <?php if(getGlobalVars($properties,'is_searchable') == "yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="is_searchable" value="no" <?php if(getGlobalVars($properties,'is_searchable') == "no"){?>checked="checked"<?php }?> class="radio" /> No *this will toggle the searchability function of the _globalvars table. For security reasons, this should <u>not</u> be set to <b>yes</b>.
							</div>
						</div>
						
						<div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Mode
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<select name="mode">
									<?php if(getGlobalVars($properties,'mode')=="closed"){?><option value="closed" selected="selected">Closed</option><?php } else {?><option value="closed">Closed</option><?php }?>
									<?php if(getGlobalVars($properties,'mode')=="alpha mode"){?><option value="alpha mode" selected="selected">Alpha Mode</option><?php } else {?><option value="alpha mode">Alpha Mode</option><?php }?>
									<?php if(getGlobalVars($properties,'mode')=="closed beta"){?><option value="closed beta" selected="selected">Closed BETA</option><?php } else {?><option value="closed beta">Closed BETA</option><?php }?>
									<?php if(getGlobalVars($properties,'mode')=="open beta"){?><option value="open beta" selected="selected">Open BETA</option><?php } else {?><option value="open beta">Open BETA</option><?php }?>
									<?php if(getGlobalVars($properties,'mode')=="open"){?><option value="open" selected="selected">Open</option><?php } else {?><option value="open">Open</option><?php }?>
									<?php if(getGlobalVars($properties,'mode')=="maintenance"){?><option value="maintenance" selected="selected">Maintenance</option><?php } else {?><option value="maintenance">Maintenance</option><?php }?>
								</select>
							</div>
						</div>
						
						<div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Top Navigation Use
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<select name="top_nav_use">
									<?php if(getGlobalVars($properties,'top_nav_use')=="top navigation w/ search"){?><option value="top navigation w/ search" selected="selected">Top Navigation w/ Search</option><?php } else {?><option value="top navigation w/ search">Top Navigation w/ Search</option><?php }?>
									<?php if(getGlobalVars($properties,'top_nav_use')=="top navigation w/o search"){?><option value="top navigation w/o search" selected="selected">Top Navigation without Search</option><?php } else {?><option value="top navigation w/o search">Top Navigation without Search</option><?php }?>
									<?php if(getGlobalVars($properties,'top_nav_use')=="toolkit"){?><option value="toolkit" selected="selected">Toolkit</option><?php } else {?><option value="toolkit">Toolkit</option><?php }?>
								</select>
							</div>
						</div>
						
						<div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Webmaster Email
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<input type="text" name="webmaster_email" value="<?php echo getGlobalVars($properties,'webmaster_email');?>" />
							</div>
						</div>
					</div>
				</fieldset>
				<br />
				<fieldset>
					<legend>Social Feeds</legend>
						<fieldset>
						<legend>Twitter Integration</legend>
							<div class="formLayoutTableMainAll">
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Main Twitter Avatar Size
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									<input type="number" name="main_twitter_avatar_size" value="<?php echo getGlobalVars($properties,'main_twitter_avatar_size');?>" min="1" max="50" onchange="if(this.value>50){this.value=50;}if(this.value<1){this.value=1;}" />
								</div>
							</div>
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Main Twitter Loading Text
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									<input type="text" name="main_twitter_loading_text" value="<?php echo getGlobalVars($properties,'main_twitter_loading_text');?>" maxlength="100" />
								</div>
							</div>
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Main Twitter Username
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									<input type="text" name="main_twitter" value="<?php echo getGlobalVars($properties,'main_twitter');?>" />
								</div>
							</div>                        
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									How many tweets should be displayed?
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									<input type="number" name="main_twitter_count" value="<?php echo getGlobalVars($properties,'main_twitter_count');?>" min="1" max="5" onchange="if(this.value>5){this.value=5;}if(this.value<1){this.value=1;}" />
								</div>
							</div>
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Auto join text default
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									<input type="text" name="main_twitter_auto_join_text_default" value="<?php echo getGlobalVars($properties,'main_twitter_auto_join_text_default');?>" />
								</div>
							</div>
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Auto join text ed
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									 <input type="text" name="main_twitter_auto_join_text_ed" value="<?php echo getGlobalVars($properties,'main_twitter_auto_join_text_ed');?>" />
								</div>
							</div>
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Auto join text ing
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									 <input type="text" name="main_twitter_auto_join_text_ing" value="<?php echo getGlobalVars($properties,'main_twitter_auto_join_text_ing');?>" />
								</div>
							</div>
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Auto join text reply
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									 <input type="text" name="main_twitter_auto_join_text_reply" value="<?php echo getGlobalVars($properties,'main_twitter_auto_join_text_reply');?>" />
								</div>
							</div>
							
							<div class="formLayoutTableRowMainAll">
								<div class="formLayoutTableRowMainAllLeftCol">
									Auto join text url
								</div>
								<div class="formLayoutTableRowMainAllRightCol">
									 <input type="text" name="main_twitter_auto_join_text_url" value="<?php echo getGlobalVars($properties,'main_twitter_auto_join_text_url');?>" />
								</div>
							</div>
						</div>
					</fieldset>
				</fieldset>
				<br />
				<fieldset>
					<legend>Social Links</legend>
                        <div class="formLayoutTableMainAll">
                            <div class="formLayoutTableRowMainAll">
                            <div class="formLayoutTableRowMainAllLeftCol">
                                Social Links Rotator Wait Time (auto)
                            </div>
                            <div class="formLayoutTableRowMainAllRightCol">
                                <input type="number" name="sociallinks_jcarousel_auto" value="<?php echo getGlobalVars($properties,'sociallinks_jcarousel_auto');?>" min="1" max="10" onchange="if(this.value>5){this.value=10;}if(this.value<1){this.value=1;}" />
                            </div>
                        </div>
                        
                        <div class="formLayoutTableRowMainAll">
                            <div class="formLayoutTableRowMainAllLeftCol">
                                Social Links Rotator Wrap
                            </div>
                            <div class="formLayoutTableRowMainAllRightCol">
                                <select name="sociallinks_jcarousel_wrap">
                                    <?php if(getGlobalVars($properties,'sociallinks_jcarousel_wrap') == "first"){?><option value="first" selected="selected">First</option><?php } else {?><option value="first">First</option><?php }?>
                                    <?php if(getGlobalVars($properties,'sociallinks_jcarousel_wrap') == "last"){?><option value="last" selected="selected">Last</option><?php } else {?><option value="last">Last</option><?php }?>
                                    <?php if(getGlobalVars($properties,'sociallinks_jcarousel_wrap') == "both"){?><option value="both" selected="selected">Both</option><?php } else {?><option value="both">Both</option><?php }?>
                                    <?php if(getGlobalVars($properties,'sociallinks_jcarousel_wrap') == "circular"){?><option value="circular" selected="selected">Circular</option><?php } else {?><option value="circular">Circular</option><?php }?>
                                </select>
                            </div>
                        </div>
						<div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Social Links Theme
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<select name="sociallinks_theme">
									<?php
									/* GET THE JC THEMES */
									$GET_JC_SKINS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}jc_themes WHERE status='active' ORDER BY name");
									if(mysql_num_rows($GET_JC_SKINS)<1){
										/* NO SKINS */
										?>
										<option value="">No Skins</option>
										<?php
									} else {
										while($FETCH_JC_SKINS=mysql_fetch_array($GET_JC_SKINS)){
											if($FETCH_JC_SKINS['id'] == getGlobalVars($properties,'sociallinks_theme')){
												?>
												<option value="<?php echo $FETCH_JC_SKINS['id'];?>" selected="selected"><?php echo $FETCH_JC_SKINS['name'];?></option>
												<?php
											} else {
												?>
												<option value="<?php echo $FETCH_JC_SKINS['id'];?>"><?php echo $FETCH_JC_SKINS['name'];?></option>
												<?php
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Social Links Rotator Scroll Amount
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<input type="number" name="sociallinks_jcarousel_scrollamt" value="<?php echo getGlobalVars($properties,'sociallinks_jcarousel_scrollamt');?>" min="1" max="5" onchange="if(this.value>5){this.value=5;}if(this.value<1){this.value=1;}" />
							</div>
						</div>
                        
                        <div class="formLayoutTableRowMainAll">
							<div class="formLayoutTableRowMainAllLeftCol">
								Social Links Type
							</div>
							<div class="formLayoutTableRowMainAllRightCol">
								<select name="sociallinks_type" value="<?php echo getGlobalVars($properties,'sociallinks_type');?>">
                                	<?php if(getGlobalVars($properties,'sociallinks_type')=="carousel"){?><option value="carousel" selected="selected">Carousel</option><option value="grfx">Graphical</option><?php }if(getGlobalVars($properties,'sociallinks_type')=="grfx"){?><option value="carousel">Carousel</option><option value="grfx" selected="selected">Graphical</option><?php }?></select><br />*This is what type of social links rotator you want to display.<ul><li><b>Carousel</b>: is a jQuery-animated text slider of all the links</li><li><b>Graphical</b>: is a nice-looking icon-type with no sliding but animation</li></ul>
							</div>
						</div>
					</div>
				</fieldset>
			</fieldset>
			<br />
			<fieldset>
			<legend>Tag Cloud (footer) Properties</legend>
				<div class="formLayoutTable">
					<div class="formLayoutTableRow">
						<div class="formLayoutTableRowMainAllLeftCol">
							Tag Cloud Count
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<input type="number" name="tagcloud_count" value="<?php echo getGlobalVars($properties,'tagcloud_count');?>" min="1" max="30" onchange="if(this.value>30){this.value=30;}if(this.value<1){this.value=1;}" />
						</div>
					</div>
				</div>
			</fieldset>
			<br />
			<fieldset>
				<legend>Under Construction Properties</legend>
				<div class="formLayoutTableMainAll">            
					<div class="formLayoutTableRowMainAll">
						<div class="formLayoutTableRowMainAllLeftCol">
							Closed Message Top
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<input type="text" name="closed_message_top" value="<?php echo getGlobalVars($properties,'closed_message_top');?>" />
						</div>
					</div>
					
					<div class="formLayoutTableRowMainAll">
						<div class="formLayoutTableRowMainAllLeftCol">
							Closed Message Mid
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<input type="text" name="closed_message_mid" value="<?php echo getGlobalVars($properties,'closed_message_mid');?>" />
						</div>
					</div>
					
					<div class="formLayoutTableRowMainAll">
						<div class="formLayoutTableRowMainAllLeftCol">
							Launch Day
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<script type="text/javascript">
								$(function() {
									$('#launch_day').datepick();
									//$('#inlineDatepicker').datepick({onSelect: showDate});
								});
							</script>            
							<input type="text" maxlength="10" name="launch_day" id="launch_day" value="<?php echo getGlobalVars($properties,'launch_day');?>" />
						</div>
					</div>
					
					<div class="formLayoutTableRowMainAll">
						<div class="formLayoutTableRowMainAllLeftCol">
							Max Admin Positions
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<input type="number" name="max_admin_positions" value="<?php echo getGlobalVars($properties,'max_admin_positions');?>" min="0" onchange="if(this.value<0){this.value=0;}" />
						</div>
					</div>
					
					<div class="formLayoutTableRowMainAll">
						<div class="formLayoutTableRowMainAllLeftCol">
							Max Closed BETA Positions
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<input type="number" name="max_closed_beta_positions" value="<?php echo getGlobalVars($properties,'max_closed_beta_positions');?>" min="0" onchange="if(this.value<0){this.value=0;}" />
						</div>
					</div>
					
					<div class="formLayoutTableRowMainAll">
						<div class="formLayoutTableRowMainAllLeftCol">
							Percent Complete
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<input type="number" step=".01" name="percent_complete" value="<?php echo getGlobalVars($properties,'percent_complete');?>" min="0" max="100" onchange="if(this.value>100){this.value=100;}if(this.value<0){this.value=0;}" />
						</div>
					</div>
					
					<div class="formLayoutTableRowMainAll">
						<div class="formLayoutTableRowMainAllLeftCol">
							Status Update
						</div>
						<div class="formLayoutTableRowMainAllRightCol">
							<input type="text" name="status_update" value="<?php echo getGlobalVars($properties,'status_update');?>" maxlength="300" />
						</div>
					</div>                
				</div>
			</fieldset>
		</fieldset>
		<br />
		<center><input type="submit" name="save" value="Save" /></center>
		<br />
	</form>
	<?php
	}
?>