<?php
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
	<div id="formLayoutTableConstruction">
		<div class="formLayoutTableConstructionRow">
			<div class="formLayoutTableConstructionRowLeftCol">
				<label>Completion</label>
			</div>
			<div class="formLayoutTableConstructionRowRightCol">
				<input type="hidden" name="wtd" value="apc" />
				<input type="number" step=".01" min="0" max="100" name="percent" value="<?php echo getGlobalVars($properties,'percent_complete');?>" />
			</div>
		</div>                   
		
		<div class="formLayoutTableConstructionRow">
			<div class="formLayoutTableConstructionRowLeftCol">
				
			</div>
			<div class="formLayoutTableConstructionRowRightCol">
				<input type="submit" name="postapc" value="Save" class="submit" />
			</div>
		</div>
	</div>
</form>
<?php
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}
?>