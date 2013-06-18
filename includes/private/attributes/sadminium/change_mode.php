<?php
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
	<div id="formLayoutTableConstruction">
		<div class="formLayoutTableConstructionRow">
			<div class="formLayoutTableConstructionRowLeftCol">
				<label>Mode</label>
			</div>
			<div class="formLayoutTableConstructionRowRightCol">
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
		
		<div class="formLayoutTableConstructionRow">
			<div class="formLayoutTableConstructionRowLeftCol">
				
			</div>
			<div class="formLayoutTableConstructionRowRightCol">
				<input type="submit" name="change_mode" id="change_mode" disabled="disabled" value="Save" class="submit" />
			</div>
		</div>
	</div>
</form>
<?php
echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}	
?>