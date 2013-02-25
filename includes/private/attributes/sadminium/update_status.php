<?php
if(isset($_POST['poststatus'])){
	//get post
	$newstatus=$_POST['status'];
	
	if($error_console!=""){
		/*failed*/
		echo $error_console;
		echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
	} else {
		/*passed*/
		//update the datbase
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET status_update='$newstatus'");
		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
	}
} else {
?>
How are you coming along with the website?
<form action="" method="post">
	<div id="formLayoutTable">
		<div class="formLayoutTableRow">
			<div class="formLayoutTableRowLeftCol">																																														</div>
			<div class="formLayoutTableRowRightCol">
				<input type="hidden" name="wtd" value="update_status" />
				<input type="text" maxlength="300" name="status" value="<?php echo getGlobalVars($properties,'status_update');?>" />
			</div>
		</div>                   
		
		<div class="formLayoutTableRow">
			<div class="formLayoutTableRowLeftCol">
				
			</div>
			<div class="formLayoutTableRowRightCol">
				<input type="submit" name="poststatus" value="Save" class="submit" />
			</div>
		</div>
	</div>
</form>
<?php
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}	
?>