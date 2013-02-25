<?php
if(isset($_POST['rapplicant'])){
	//get post
	$applicant_id=$_POST['applicant_id'];
	$response=$_POST['response'];
	
	if($response==""){$error_console="You must respond to this applicant";}
	
	if($error_console!=""){
		/*failed*/
		echo $error_console;
	
	} else {
		/*passed*/
		//update the datbase
		if($response=="approve"){
			mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='active' WHERE id='$applicant_id'");
			//get user info
			$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
			$FETCH_USER=mysql_fetch_array($GET_USER);
			$fname=$FETCH_USER['fname'];
			$lname=$FETCH_USER['lname'];
			$email=$FETCH_USER['email'];
			
			//send an email with login details
			$to=$email;
			CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_admin_account_decision_registration_approve',$to,$PADINFO,$pname_uri);
		} else if($response=="deny"){
			mysql_query("UPDATE {$properties->DB_PREFIX}users SET status='denied' WHERE id='$applicant_id'");
			//get user info
			$GET_USER=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='$applicant_id'");
			$FETCH_USER=mysql_fetch_array($GET_USER);
			$fname=$FETCH_USER['fname'];
			$lname=$FETCH_USER['lname'];
			$email=$FETCH_USER['email'];
			
			//send an email with login details
			$to=$email;
			CENTRALIZED_EMAIL_RESPONSE_SYSTEM($properties,'beta_admin_account_decision_registration_deny',$to,$PADINFO,$pname_uri);
		}
		echo "Successfully saved!<br /><a href=\"../\" class=\"white\">Go home</a>";
	}
} else {
	//get the number of applicants
	$GET_USERS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending'");
	$num_of_applicants=mysql_num_rows($GET_USERS);
	?>
	Use this place to review applicants for positions
	<form action="" method="post">
		<input type="hidden" name="wtd" value="review_applicants" />
		<div id="formLayoutTableSpecialBig">
			<?php
			if($num_of_applicants<1){
				/* NO APPLICANTS */
			} else {
			?>
			<div class="formLayoutTableRow">
				<div class="formLayoutTableRowLeftCol">
					<label># Applicants</label>
				</div>
				<div class="formLayoutTableRowRightCol">
					<?php echo $num_of_applicants;?>
				</div>
			</div>
			<?php	
			}
			?>
			<?php
			//get all the applicants
			if($num_of_applicants<1){
				?>
				<div class="formLayoutTableRow">
					<div class="formLayoutTableRowLeftCol">
											
					</div>
					<div class="formLayoutTableRowRightCol">
						No Applicants
					</div>
				</div>
				<?php		
			} else if($num_of_applicants>0) {
				$GET_APPLICANTS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE status='pending' ORDER BY dateandtime_applied LIMIT 1");
				while($FETCH_APPLICANTS=mysql_fetch_array($GET_APPLICANTS)){
					$id=$FETCH_APPLICANTS['id'];
					$fname=$FETCH_APPLICANTS['fname'];
					$lname=$FETCH_APPLICANTS['lname'];
					$type=$FETCH_APPLICANTS['type'];
					$why=$FETCH_APPLICANTS['why'];
					?>
					<input type="hidden" name="applicant_id" value="<?php echo $id;?>" />
					<div class="formLayoutTableRow">
						<div class="formLayoutTableRowLeftCol">
							<label>Name</label>
						</div>
						<div class="formLayoutTableRowRightCol">
							<?php echo $fname." ".$lname;?>
						</div>
					</div>
					
					<div class="formLayoutTableRow">
						<div class="formLayoutTableRowLeftCol">
							<label>Type</label>
						</div>
						<div class="formLayoutTableRowRightCol">
							<?php echo $type;?>
						</div>
					</div>
					
					<div class="formLayoutTableRow">
						<div class="formLayoutTableRowLeftCol">
							<label>Why</label>
						</div>
						<div class="formLayoutTableRowRightCol">
							<?php if(strlen($why)>35){$ending="...";}else{$ending="";}?>
							<?php echo substr($why,0,32).$ending;?>
						</div>
					</div>
					<br />
					<div class="formLayoutTableRow">
						<div class="formLayoutTableRowLeftCol">
							<label>Respond</label>
						</div>
						<div class="formLayoutTableRowRightCol">
							<select name="response">
								<option value="">--------------- your response ---------------</option>
								<option value="approve">Approve</option>
								<option value="deny">Deny</option>
							</select>
						</div>
					</div>
					<?php
				}
			}
			?>
			
			<?php
			if($num_of_applicants<1){
				/* NO APPLICANTS */
			} else {
			?>
			<div class="formLayoutTableRow">
				<div class="formLayoutTableRowLeftCol">
					
				</div>
				<div class="formLayoutTableRowRightCol">
					<input type="submit" name="rapplicant" value="Save" class="submit" />
				</div>
			</div>
			<?php	
			}
			?>
		</div>
	</form>
	<?php
	echo "<br /><a href=\"javascript:history.go(-1)\" class=\"white\">Back</a>";
}
?>