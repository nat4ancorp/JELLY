<?php
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
	<div id="formLayoutTableConstruction">
		<div class="formLayoutTableConstructionRow">
			<div class="formLayoutTableConstructionRowLeftCol">
				<label>Message</label>
			</div>
			<div class="formLayoutTableConstructionRowRightCol">
				<input type="hidden" name="wtd" value="change_cmm" />
				<input type="text" name="message" value="<?php echo getGlobalVars($properties,'closed_message_mid');?>" />
			</div>
		</div>                   
		
		<div class="formLayoutTableConstructionRow">
			<div class="formLayoutTableConstructionRowLeftCol">
				
			</div>
			<div class="formLayoutTableConstructionRowRightCol">
				<input type="submit" name="postmessage" value="Save" class="submit" />
			</div>
		</div>
	</div>
</form>
<?php
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}
?>