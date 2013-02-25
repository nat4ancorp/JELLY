<?php
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
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}
?>