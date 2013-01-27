<?php
switch($MODE){
    case 'closed':
	
	//get the launchday
	$launch_day=getGlobalVars($properties,'launch_day');
	?>
	Our estimated launch date is <strong><?php echo $launch_day;?></strong> so we should be online in:
	
	<!-- [CODE-HELPER: GUTS_OF_CONSTR] -->
    <script type="text/javascript">
	$(function () {
		$("#progress-bar").progressbar({ value: <?php echo getGlobalVars($properties,'percent_complete');?> });
	});
	
	$(function () {
		var launchDay = new Date();
		launchDay = new Date("<?php echo $launch_day;?>");
		//where the timer goes
		$('#openingCountdown').countdown({until: launchDay});
		$('#year').text(austDay.getFullYear());
	});
	</script>
	<div id="openingCountdown"></div>
	<p>
		We are already <?php echo round(getGlobalVars($properties,'percent_complete'));?>% finished!
        <br />		
		<span id="status-update"><?php echo getGlobalVars($properties,'status_update')?></span>
	</p>
	<div id="progress-bar"></div>
	
	If you are an Admin with <?php echo $properties->COMPANY_NAME;?> then you can click on the &quot;Control&quot; link to access a special form that allows you to login to manage this flood gate.
	<?php
	
	break;
	
	case 'alpha mode':
	
	
	
	break;
	
	case 'closed beta':
	
	
	
	break;
	
	case 'open beta':
	
	
	
	break;
	
	case 'open':
	
	
	
	break;
	
	case 'maintenance':
	
	
	
	break;
}
?>