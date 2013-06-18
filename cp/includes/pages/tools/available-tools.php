<h1>Tools</h1>
<?php
if(isset($_POST['save'])){
	/* SITE UPDATES */
	/* STEP 1: GET ALL DATA */
	$data_clean_sessions_toggle=$_POST['clean_sessions_toggle'];
	$data_clean_pagevisits_toggle=$_POST['clean_pagevisits_toggle'];
	
	$error_console="";
	/* STEP 2: CHECK DATA FOR ACCURACY */
	//if($data_ == ""){$error_console.="<br />";}
	
	if($error_console != "") {
		/* THERE IS AN ERROR */	
		echo $error_console;
	} else {
		/* STEP 3: POST TO DATABASE */
		if($data_clean_sessions_toggle == "yes"){
			/* RESET's Session DATA */
			mysql_query("DELETE FROM {$properties->DB_PREFIX}tempsystem") or die(mysql_error());
		}
		
		if($data_clean_pagevisits_toggle == "yes"){
			/* RESET's Session DATA */
			mysql_query("UPDATE {$properties->DB_PREFIX}pages SET visits=0") or die(mysql_error());
			mysql_query("UPDATE {$properties->DB_PREFIX}pages SET last_known_ip=''") or die(mysql_error());
		}
				
		/* STEP 4: RETURN SUCCESS */
		echo "Successfully saved! <a href=\"?menu=tools\">Refresh</a>";
	}
} else {
	?>
	<form action="" method="post">
		<fieldset>
			<legend>Page Tools</legend>
			<div class="formLayoutTableMainAll">
				<div class="formLayoutTableRowMainAll">
					<div class="formLayoutTableRowMainAllLeftCol">
						RESET Visit Counter
					</div>
					<div class="formLayoutTableRowMainAllRightCol">
						<input type="radio" name="clean_pagevisits_toggle" value="yes" class="radio" /> Yes <input type="radio" name="clean_pagevisits_toggle" value="no" checked="checked" class="radio" /> No<br />*this will reset all the page visits on each page back to 0. Only use this for the sake of starting over. You cannot undo this action.
					</div>
				</div>
			</div>
		</fieldset>
        <fieldset>
			<legend>TempSystem Tools</legend>
			<div class="formLayoutTableMainAll">
				<div class="formLayoutTableRowMainAll">
					<div class="formLayoutTableRowMainAllLeftCol">
						RESET All Sessions
					</div>
					<div class="formLayoutTableRowMainAllRightCol">
						<input type="radio" name="clean_sessions_toggle" value="yes" class="radio" /> Yes <input type="radio" name="clean_sessions_toggle" value="no" checked="checked" class="radio" /> No<br />*this will clear all the session data in the tempsystem table. NOTE: To avoid problems, it is highly advised not to check yes on this one due to the fact that online users will see a bit of a "glitch" where they don't see anything but white with text until they refresh, at that time a new session will be established with them. Unless you are debugging, don't check yes and save. :)
					</div>
				</div>
			</div>
		</fieldset>
        
        <fieldset>
			<legend>Files</legend>
			<div class="formLayoutTableMainAll">
				<div class="formLayoutTableRowMainAll">
					<div class="formLayoutTableRowMainAllLeftCol">
						Edit the .htaccess
					</div>
					<div class="formLayoutTableRowMainAllRightCol">
                    	<?php
						/* LOAD THE HTACCESS FILE */
						$file=$WEBSITE_URL_ROOT.".htaccess";
						if(file_exists($file)){
							/* READ IT */
							$open=fopen($file, 'r');
							$contents=fread($open, filesize($file));
							fclose($open);
						} else {
							/* UMM...MISSING HTACCESS */
							$contents="Um...I cannot find an .htaccess file. This is odd since you are able to get to this page. The file should located: {$file}";
						}
						?>
						<textarea cols="30" rows="7" name="htaccess_edit"><?php echo $contents;?></textarea>
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