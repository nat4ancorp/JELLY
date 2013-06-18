<h1>Background</h1>
<?php
if(isset($_POST['save'])){
	/* SITE UPDATES */
	/* STEP 1: GET ALL DATA */
	$data_walls_pack_name=mysql_real_escape_string($_POST['walls_pack_name']);
	$data_duration_list=mysql_real_escape_string($_POST['walls_duration']);
	$data_fade_list=mysql_real_escape_string($_POST['walls_fade']);
	$data_randomize=mysql_real_escape_string($_POST['walls_randomize']);
	$data_walls_toggle=mysql_real_escape_string($_POST['walls_toggle']);
	
	/* STEP 2: CHECK DATA FOR ACCURACY */
	//if($data_ == ""){$error_console.="<br />";}
	
	if($error_console != "") {
		/* THERE IS AN ERROR */	
		echo $error_console;
	} else {
		/* STEP 3: POST TO DATABASE */
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET walls_pack_name = '$data_walls_pack_name'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET walls_duration = '$data_duration_list'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET walls_fade = '$data_fade_list'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET walls_randomize = '$data_randomize'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET walls_toggle = '$data_walls_toggle'");
				
		/* STEP 4: RETURN SUCCESS */
		echo "Successfully saved! <a href=\"?menu=appearance&page=background\">Refresh</a>";
	}
} else {
	?>
	<form action="" method="post">
		<fieldset>
			<legend>Walls Options</legend>
			<div class="formLayoutTableMainAll">
				<div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Walls Pack Name
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="walls_pack_name">								                                    
                            <?php
                            //get the default themeid and work with that
                            $GET_THEME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE id='".getGlobalVars($properties,'defaultThemeID')."'");
                            while($FETCH_THEME=mysql_fetch_array($GET_THEME)){
                                $CURRTHEME=$FETCH_THEME['name'];
                            }									
                            $directories=array_diff(scandir("../themes/".$CURRTHEME."/exempt/images/walls/"),array('.', '..','.DS_STORE')); // this specifies what to get and what not to get
                            foreach($directories as $directory){
                                ?><?php if(getGlobalVars($properties,'walls_pack_name')=="".$directory.""){?><option value="<?php echo $directory?>" selected="selected"><?php echo $directory?></option><?php } else {?><option value="<?php echo $directory?>"><?php echo $directory?></option><?php }?><?php
                            }
                            ?>
                        </select>
                    </div>
                </div>                                              
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Walls Duration
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="text" name="walls_duration" value="<?php echo getGlobalVars($properties,'walls_duration');?>" /> * The time it waits before changing
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Walls Fade
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="text" name="walls_fade" value="<?php echo getGlobalVars($properties,'walls_fade');?>" /> * How long the fade animation is
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Randomize Walls?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="walls_randomize" value="yes" <?php if(getGlobalVars($properties,'walls_randomize') == "yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="walls_randomize" value="no" <?php if(getGlobalVars($properties,'walls_randomize') == "no"){?>checked="checked"<?php }?> class="radio" /> No *Will toggle the randomization of the walls
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Turn on Walls?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="walls_toggle" value="on" <?php if(getGlobalVars($properties,'walls_toggle') == "on"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="walls_toggle" value="off" <?php if(getGlobalVars($properties,'walls_toggle') == "off"){?>checked="checked"<?php }?> class="radio" /> No *Will toggle the function of the walls
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