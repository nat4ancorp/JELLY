<h1>Manage Themes</h1>
<?php
if(isset($_POST['save'])){
	/* SITE UPDATES */
	/* STEP 1: GET ALL DATA */
	$data_tm_toggle=$_POST['tm_toggle'];
	$data_tm_cbc=$_POST['tm_cbc'];
	$data_defaultThemeID=$_POST['defaultThemeID'];	
	
	/* STEP 2: CHECK DATA FOR ACCURACY */
	//if($data_ == ""){$error_console.="<br />";}
	
	if($error_console != "") {
		/* THERE IS AN ERROR */	
		echo $error_console;
	} else {
		/* STEP 3: POST TO DATABASE */
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET tm_toggle = '$data_tm_toggle'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET tm_cbc = '$data_tm_cbc'");
		
		/* SPECIAL FOR INPUT */
		if($data_tm_toggle == "off"){/* SET ALL USERS AND TEMP TO DEFAULTED THEME */mysql_query("UPDATE {$properties->DB_PREFIX}users SET themeID='".$data_defaultThemeID."'");mysql_query("UPDATE {$properties->DB_PREFIX}tempsystem SET themeID='".$data_defaultThemeID."'");}
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET defaultThemeID = '$data_defaultThemeID'");		
				
		/* STEP 4: RETURN SUCCESS */
		echo "Successfully saved! <a href=\"?menu=appearance\">Refresh</a>";
	}
} else {
	?>
	<form action="" method="post">
		<fieldset>
			<legend>Themes General</legend>
			<div class="formLayoutTableMainAll">
				<div class="formLayoutTableRowMainAll">
					<div class="formLayoutTableRowMainAllLeftCol">
						Add Theme Manager Dropdown?
					</div>
					<div class="formLayoutTableRowMainAllRightCol">
						<input type="radio" name="tm_toggle" value="on" <?php if(getGlobalVars($properties,'tm_toggle') == "on"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="tm_toggle" value="off" <?php if(getGlobalVars($properties,'tm_toggle') == "off"){?>checked="checked"<?php }?> class="radio" /> No
					</div>
				</div>
                
                <div class="formLayoutTableRowMainAll">
					<div class="formLayoutTableRowMainAllLeftCol">
						Allow Theme to be Changed?
					</div>
					<div class="formLayoutTableRowMainAllRightCol">
						<input type="radio" name="tm_cbc" value="on" <?php if(getGlobalVars($properties,'tm_cbc') == "on"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="tm_cbc" value="off" <?php if(getGlobalVars($properties,'tm_cbc') == "off"){?>checked="checked"<?php }?> class="radio" /> No
					</div>
				</div>
				
				<div class="formLayoutTableRowMainAll">
					<div class="formLayoutTableRowMainAllLeftCol">
						Default Theme
					</div>
					<div class="formLayoutTableRowMainAllRightCol">
						<select name="defaultThemeID">
							<?php
							/* GET THEMES */
							$GET_THEMES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes ORDER BY name");
							if(mysql_num_rows($GET_THEMES)<1){
								/* NO THEMES */
								?>
								<option value="">No Themes</option>
								<?php
							} else {
								while($FETCH_THEMES=mysql_fetch_array($GET_THEMES)){
									if($FETCH_THEMES['id'] == getGlobalVars($properties,'tm_toggle')){
										?>
										<option value="<?php echo $FETCH_THEMES['id'];?>" selected="selected"><?php echo $FETCH_THEMES['pretty_name'];?></option>
										<?php
									} else {
										?>
										<option value="<?php echo $FETCH_THEMES['id'];?>"><?php echo $FETCH_THEMES['pretty_name'];?></option>
										<?php	
									}
								}
							}
							?>
						</select>
					</div>
				</div>
			</div>
		</fieldset>
		<br />
		<center><input type="submit" name="save" value="Save" /></center>
		<br />
	</form>
 <?php
 }
 ?>