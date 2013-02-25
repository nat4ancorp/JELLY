<?php
if(isset($_POST['change_']) || isset($_POST['change_mode']) || isset($_POST['adjust_mar']) || isset($_POST['adjust_mbr']) || isset($_POST['postapc']) || isset($_POST['apc']) || isset($_POST['postmessage']) || isset($_POST['postldd']) || isset($_POST['set_tou']) || isset($_POST['poststatus']) || isset($_POST['update_status']) || isset($_POST['change_ldd'])){
	//get the option
	$option=$_POST['wtd'];
	switch($option){
		case '':
			/* none */
			echo "You must select an option";
			echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
		break;
		
		case 'adjust_mar':
			include("includes/private/attributes/sadminium/adjust_mar.php");
		break;
		
		case 'adjust_mbr':
			include("includes/private/attributes/sadminium/adjust_mbr.php");
		break;
		
		case 'apc':
			include("includes/private/attributes/sadminium/apc.php");
		break;
		
		case 'change_cmm':
			include("includes/private/attributes/sadminium/change_cmm.php");
		break;
		
		case 'change_cmt':
			include("includes/private/attributes/sadminium/change_cmt.php");
		break;
		
		case 'change_mode':
			include("includes/private/attributes/sadminium/change_mode.php");
		break;
		
		case 'change_ldd':
			include("includes/private/attributes/sadminium/change_ldd.php");
		break;	
		
		case 'enter_site':
			include("includes/private/attributes/sadminium/enter_site.php");
		break;
		
		case 'review_applicants':
			include("includes/private/attributes/sadminium/review_applicants.php");
		break;
		
		case 'update_status':
			include("includes/private/attributes/sadminium/update_status.php");
		break;
		
		case 'user_cp':
			include("includes/private/attributes/sadminium/user_cp.php");
		break;
	}
} else {
?>
<h2 style="line-height:.5em;">What do you want to do?</h2>
<form action="" method="post">
	<input type="hidden" name="logoutusername" value="<?php echo $username?>" />
	<div id="formLayoutTable">
		<div class="formLayoutTableRow">
			<div class="formLayoutTableRowLeftCol">
				<label>Choose a command</label>
			</div>
			<div class="formLayoutTableRowRightCol">
				<select name="wtd">
					<option value="">--- choose what you want to do ---</option>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="adjust_mar">Adjust Max Admins Rate</option><?php }?>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="adjust_mbr">Adjust Max Closed BETA Members Rate</option><?php }?>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="apc">Adjust Percent Complete</option><?php }?>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="change_cmm">Change closed message middle</option><?php }?>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="change_cmt">Change closed message top</option><?php }?>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="change_mode">Change Mode</option><?php }?>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="change_ldd">Change the Launch Day date</option><?php }?>
					<option value="enter_site">Enter the site</option>
					<?php if($type=="admin" && $head_admin=="yes"){?><option value="update_status">Update status</option><?php }?>
					<option value="user_cp">User CP</option>
				</select>
			</div>
		</div>                   
		
		<div class="formLayoutTableRow">
			<div class="formLayoutTableRowLeftCol">
				
			</div>
			<div class="formLayoutTableRowRightCol">
				<input type="submit" name="change_" value="Go" class="submit" /> 
				<input type="submit" name="logout" value="Logout" class="submit" />
			</div>
		</div>
	</div>
</form>
<br />
<?php	
}
?>