<?php
if(isset($_POST['set_tou'])){
	/* POST ACTION FOR TOU */
	//get post elements
	$agree_status="unchecked";
	$disagree_status="unchecked";
	$set_tou=$_POST['tou'];
	
	if($set_tou=="agree"){
		/* agreed to tou */
		$error_console="";
		
	} else if($set_tou=="disagree") {
		/* disagreed to tou */
		$error_console="You must agree to the Terms of Use before you go in";
	} else {
		$error_console="You must respond before you go in";
	}
	 
	if($error_console!=""){
		/* FAILED */
		echo $error_console;
		
	} else {
		/* PASSED */
		//update user
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET tou_status='".$set_tou."' WHERE  uname='$username'");

		echo "Thank you for agreeing with us, you may now enter this site.<br /><h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>";
	}
	
} else {
	if($tou_status=="agree"){
		/* TOU GOOD */
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='yes' WHERE uname='$username'");
		echo "It looks like you are ready to go. When you are ready, <h2>[<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Enter ".$properties->WEBSITE_NAME.$properties->WEBSITE_EXT."</a>]</h2>to enjoy the awesomeness of Nat4an!";
		
	} else if($tou_status=="disagree"){
		/* TOU BAD */
		?>
		Before entering this site, you must agree to the <a onclick="window.open('<?php echo $properties->WEBSITE_URL;?>/termsofuse.php?type=<?php echo $type;?>','','width=400','height=400')" class="white" style="cursor:pointer;">Terms of Use</a>, this includes but not limited to your acknowledge of the purpose for this website, in this event testing phase. PLEASE READ THE TERMS OF USE BEFORE AGREEING AS YOU WILL BE HELD ACCOUNTABLE
		<br /><br />
		<form action="" method="post">
			<div id="formLayoutTable">
				<div class="formLayoutTableRow">
					<div class="formLayoutTableRowLeftCol">
						<label>Your response</label>
					</div>
					<div class="formLayoutTableRowLeftCol">
						<input type="hidden" name="wtd" value="enter_site" />
						<input type="radio" name="tou" value="agree" /> I agree
						<input type="radio" name="tou" value="disagree" /> I disagree
						
					</div>
				</div>                   
				<br />
				<div class="formLayoutTableRow">
					<div class="formLayoutTableRowLeftCol">
						
					</div>
					<div class="formLayoutTableRowRightCol">
						<input type="submit" name="set_tou" value="Enter" class="submit" />
					</div>
				</div>
			</div>
		</form>
		<?php
	}	
}
?>