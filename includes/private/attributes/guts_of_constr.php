<?php
switch($MODE){
    case 'closed':
	
	//get the launchday
	$launch_day=getGlobalVars($properties,'launch_day');
	?>
	Our estimated launch date is <strong><?php echo $launch_day;?></strong> so we should be online in:
	
	<!-- [CODE-HELPER: GUTS_OF_CONSTR] -->        
    <script type="text/javascript">
	/*$(function () {
		$("#progress-bar").progressbar({ value:  });
	});*/
	$(function() {		
		$('.progressbar').each(function(){
			var t = $(this),
				dataperc = t.attr('data-perc'),
				barperc = Math.round(dataperc*5.56);
			t.find('.bar').animate({width:barperc}, dataperc*25);
			t.find('.label').append('<div class="perc"></div>');
			
			function perc() {
				var length = t.find('.bar').css('width'),
					perc = Math.round(parseInt(length)/5.56),
					labelpos = (parseInt(length)-2);
				t.find('.label').css('left', labelpos);
				t.find('.perc').text(perc+'%');
			}
			perc();
			setInterval(perc, 0); 
		});
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
    <br /><br />
	<p>
		We are already <?php echo round(getGlobalVars($properties,'percent_complete'));?>% finished!
        <br />		
		<span id="status-update"><?php echo getGlobalVars($properties,'status_update')?></span>
	</p>
	<div class="progressbar" data-perc="<?php echo getGlobalVars($properties,'percent_complete');?>">
    	<div class="bar color2"><span></span></div>
        <div class="label"><span></span></div>
    </div>   		
	If you are an Admin with <?php echo $properties->COMPANY_NAME;?> then you can click on the &quot;Control&quot; link to access a special form that allows you to login to manage this flood gate.
	<?php
	
	break;
	
	case 'alpha mode':
	
	
	
	break;
	
	case 'closed beta':
	
	
	//get the launchday
	$launch_day=getGlobalVars($properties,'launch_day');
	?>
	Our estimated launch date is <strong><?php echo $launch_day;?></strong> so we should be online in:
	
	<!-- [CODE-HELPER: GUTS_OF_CONSTR] -->        
    <script type="text/javascript">
	/*$(function () {
		$("#progress-bar").progressbar({ value:  });
	});*/
	$(function() {		
		$('.progressbar').each(function(){
			var t = $(this),
				dataperc = t.attr('data-perc'),
				barperc = Math.round(dataperc*5.56);
			t.find('.bar').animate({width:barperc}, dataperc*25);
			t.find('.label').append('<div class="perc"></div>');
			
			function perc() {
				var length = t.find('.bar').css('width'),
					perc = Math.round(parseInt(length)/5.56),
					labelpos = (parseInt(length)-2);
				t.find('.label').css('left', labelpos);
				t.find('.perc').text(perc+'%');
			}
			perc();
			setInterval(perc, 0); 
		});
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
    <br /><br />
	<p>
		We are already <?php echo round(getGlobalVars($properties,'percent_complete'));?>% finished!
        <br />		
		<span id="status-update"><?php echo getGlobalVars($properties,'status_update')?></span>
	</p>
	<div class="progressbar" data-perc="<?php echo getGlobalVars($properties,'percent_complete');?>">
    	<div class="bar color2"><span></span></div>
        <div class="label"><span></span></div>
    </div>   		
	If you are an Admin with <?php echo $properties->COMPANY_NAME;?> then you can click on the &quot;Control&quot; link to access a special form that allows you to login to manage this flood gate.
	<?php
	
	break;
	
	case 'open beta':
	
	
	
	break;
	
	case 'open':
	
	
	
	break;
	
	case 'maintenance':
	
	
	
	break;
}
?>