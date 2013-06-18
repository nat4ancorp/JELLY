<!--
Modular Ticketing System (MTS) Core
Copyright © 2012 Nat4ancorp
Original coding work done by: Nathan Smyth
A project written and coded by Nathan Smyth and available as a free software to be used 
by anyone who needs it and can be modified to your liking. I just created the base, you
can now make it how you want but please retain this copyright and original coding info
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php
//load global vars from another php file (props.php)
include 'conf/props.php';
$properties=new properties();
include 'conf/connect.php';
?>
<meta name="description" content="<?php echo $properties->SITE_DESCRIPTION;?>" />
<meta name="author" content="<?php echo $properties->SITE_AUTHOR;?>" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Modular Ticketing System v. 1.0</title>
<link rel="stylesheet" type="text/css" href="styles/default/main.css" />
</head>
<body>
<?php
if(isset($_GET['meta'])){
	switch($_GET['meta']){
		case 'checkstatus':
			@$ticket_id="";
			@$launchpad=$_GET['launchpad'];
			echo "<h2 class=\"pages-maincontent-title\">".$properties->FORM_TITLE."</h2>";
			echo "<div class=\"back-button\" onclick=\"window.location.href='".$properties->WURL."'\">&lt;</div>";
			if($ticket_id == ""){echo " <div class=\"wyo-button\">Check Status of a Ticket</div>";}else{$ticket_id=$_GET['ticketid'];echo " <div class=\"wyo-button\">Check Status of Ticket ID: <b>".substr($ticket_id,0,40)."<a title=\"{$ticketid}\" class=\"white-url\">...</a></b></div>";}
			echo "<br />";
			echo "<br />";
			if((isset($_GET['ticketid'])) || (@$_POST['ticket_id_check'])){
				if(isset($_GET['ticketid'])){$ticket_id=$_GET['ticketid'];}else if(isset($_POST['ticket_id_check'])) {if($_POST['contact_yemail'] != "Enter Your Email"){/* LOOKUP BY EMAIL */$GET_TICKET_BY_EMAIL=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries WHERE contact_email='".$_POST['contact_yemail']."' ORDER BY dateandtime DESC") or die('uh oh! '.mysql_error());if(mysql_num_rows($GET_TICKET_BY_EMAIL)<1){echo "<div id=\"formLayoutTable\"><div class=\"formLayoutTableRow\"><div class=\"formLayoutTableRowLeftCol\">Response</div><div class=\"formLayoutTableRowRightCol\">Sorry I could not find a Ticket ID under that email!<br /><a onclick=\"history.go(-1)\" class=\"white-url\">Go Back</a></div></div></div><br />";} else {while($FETCH_TICKET_BY_EMAIL=mysql_fetch_array($GET_TICKET_BY_EMAIL)){$ticket_id.=$FETCH_TICKET_BY_EMAIL['ticket_id']."::::::";}}} else {$ticket_id=$_POST['ticket_id'];}}
				
				if((isset($_POST['contact_yemail'])) && ($_POST['contact_yemail'] != "Enter Your Email")){
					/* check by email */
					//explode the ticket_id
					@$ticket_id_list="";
					$ticket_id_list=explode("::::::",$ticket_id);
					for($i=0; $i<count($ticket_id_list)-1; $i++){
						$GET_TICKET=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries WHERE ticket_id='$ticket_id_list[$i]' ORDER BY dateandtime DESC") or die('uh oh! '.mysql_error());
						if(mysql_num_rows($GET_TICKET)<1){
						echo "<div id=\"formLayoutTable\">
							<div class=\"formLayoutTableRow\">
								<div class=\"formLayoutTableRowLeftCol\">
									Response
								</div>
								<div class=\"formLayoutTableRowRightCol\">
									Sorry I could not find your Ticket ID! <a onclick=\"history.go(-1)\" class=\"white-url\">Go Back</a>
								</div>
							</div>
						</div>";
						} else {
							$FETCH_TICKET=mysql_fetch_array($GET_TICKET);
							@$contact_name		= $FETCH_TICKET['contact_name'];
							@$contact_email		= $FETCH_TICKET['contact_email'];
							@$poc				= $FETCH_TICKET['poc'];
							@$reason			= $FETCH_TICKET['reason'];
							@$contact_message	= $FETCH_TICKET['contact_message'];
							@$extra_notes		= $FETCH_TICKET['extra_notes'];
							@$status			= $FETCH_TICKET['status'];
							
							echo "<div id=\"formLayoutTable\">
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Ticket ID
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										<b>{$ticket_id_list[$i]}</b>
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Contact Name
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$contact_name}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Contact Email
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$contact_email}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Point of Contact
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										";
										$GET_POC=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type='admin' AND isIncludedInMTS='yes' AND poc_code='$poc'") or die('uh oh! '.mysql_error());
										$FETCH_POC=mysql_fetch_array($GET_POC);
										//get the staff title
										@$staff_type=$FETCH_POC['staff_type'];
										@$GET_STAFF_CODE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='$staff_type'");
										$FETCH_STAFF_TYPE=mysql_fetch_array($GET_STAFF_CODE);
										$staff_title=$FETCH_STAFF_TYPE['name'];
										echo $FETCH_POC['fname']." ".$FETCH_POC['lname'] . " (".$staff_title.")";
										echo "
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Reason
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										";
										$GET_REASON=mysql_query("SELECT * FROM {$properties->DB_PREFIX}reasons WHERE rcode='$reason'") or die('uh oh! '.mysql_error());
										$FETCH_REASON=mysql_fetch_array($GET_REASON);
										echo $FETCH_REASON['reason'];
										echo "
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Message
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$contact_message}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Extra Notes
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$extra_notes}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Status
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$status}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Directions
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										<div style=\"color: blue;font-weight: bold;\">Please exit <a href=\"".$properties->WURL."\">here</a></div>
									</div>
								</div>
								
							</div>";
						}	
						echo "<br />";
					}
				} else {
					$GET_TICKET=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries WHERE ticket_id='$ticket_id'") or die('uh oh! '.mysql_error());
						if(mysql_num_rows($GET_TICKET)<1){
						echo "<div id=\"formLayoutTable\">
							<div class=\"formLayoutTableRow\">
								<div class=\"formLayoutTableRowLeftCol\">
									Response
								</div>
								<div class=\"formLayoutTableRowRightCol\">
									Sorry I could not find your Ticket ID! <a onclick=\"history.go(-1)\" class=\"white-url\">Go Back</a>
								</div>
							</div>
						</div>";
						} else {
							$FETCH_TICKET=mysql_fetch_array($GET_TICKET);
							@$contact_name		= $FETCH_TICKET['contact_name'];
							@$contact_email		= $FETCH_TICKET['contact_email'];
							@$poc				= $FETCH_TICKET['poc'];
							@$reason			= $FETCH_TICKET['reason'];
							@$contact_message	= $FETCH_TICKET['contact_message'];
							@$extra_notes		= $FETCH_TICKET['extra_notes'];
							@$status			= $FETCH_TICKET['status'];
							
							echo "<div id=\"formLayoutTable\">
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Ticket ID
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										<b>{$ticket_id}</b>
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Contact Name
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$contact_name}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Contact Email
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$contact_email}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Point of Contact
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										";
										$GET_POC=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type='admin' AND isIncludedInMTS='yes' AND poc_code='$poc'") or die('uh oh! '.mysql_error());
										$FETCH_POC=mysql_fetch_array($GET_POC);
										//get the staff title
										@$staff_type=$FETCH_POC['staff_type'];
										@$GET_STAFF_CODE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='$staff_type'");
										$FETCH_STAFF_TYPE=mysql_fetch_array($GET_STAFF_CODE);
										$staff_title=$FETCH_STAFF_TYPE['name'];
										echo $FETCH_POC['fname']." ".$FETCH_POC['lname'] . " (".$staff_title.")";
										echo "
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Reason
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										";
										$GET_REASON=mysql_query("SELECT * FROM {$properties->DB_PREFIX}reasons WHERE rcode='$reason'") or die('uh oh! '.mysql_error());
										$FETCH_REASON=mysql_fetch_array($GET_REASON);
										echo $FETCH_REASON['reason'];
										echo "
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Message
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$contact_message}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Extra Notes
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$extra_notes}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Status
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										{$status}
									</div>
								</div>
								
								<div class=\"formLayoutTableRow\">
									<div class=\"formLayoutTableRowLeftCol\">
										Directions
									</div>
									<div class=\"formLayoutTableRowRightCol\">
										<div style=\"color: blue;font-weight: bold;\">Please exit <a href=\"".$properties->WURL."\">here</a> or check the status of another one: <a href=\"".$properties->WURL."checkstatus\">here</a></div>
									</div>
								</div>
								
						</div>";
					}
				}
				
			} else {
				echo "<form action=\"\" method=\"post\" name=\"ticket_id_form\">
				<div id=\"formLayoutTable\">
					<div class=\"formLayoutTableRow\">
						<div class=\"formLayoutTableRowLeftCol\">
							Ticket ID
						</div>
						<div class=\"formLayoutTableRowRightCol\">
							<input type=\"text\" name=\"ticket_id\" id=\"ticket_id\" onfocus=\"if(this.value=='Enter your ID number'){this.value='';}\" onblur=\"if(this.value==''){this.value='Enter your ID number';}\" value=\"Enter your ID number\" />
						</div>
					</div>
					
					<div class=\"formLayoutTableRow\">
						<div class=\"formLayoutTableRowLeftCol\">
							
						</div>
						<div class=\"formLayoutTableRowRightCol\">
							<b>OR</b>
						</div>
					</div>
					
					<div class=\"formLayoutTableRow\">
						<div class=\"formLayoutTableRowLeftCol\">
							Your Email
						</div>
						<div class=\"formLayoutTableRowRightCol\">
							<input type=\"text\" name=\"contact_yemail\" id=\"contact_yemail\" onfocus=\"if(this.value=='Enter Your Email'){this.value='';}\" onblur=\"if(this.value==''){this.value='Enter Your Email';}\" value=\"Enter Your Email\" />
						</div>
					</div>
					
					<div class=\"formLayoutTableRow\">
						<div class=\"formLayoutTableRowLeftCol\">
							
						</div>
						<div class=\"formLayoutTableRowRightCol\">
							<input type=\"submit\" name=\"ticket_id_check\" id=\"ticket_id_check\" value=\"Check\" class=\"submit\" />
						</div>
					</div>
				</div>";
				echo "</form>";
			}
		break;
	}
	} else {
	if((isset($_POST['contact_send'])) || (isset($_POST['contact_retry']))){
		//get the post content
		$yname		= $_POST['contact_yname'];
		$yemail		= $_POST['contact_yemail'];
		$poc		= $_POST['contact_poc'];
		$reason		= $_POST['contact_reason'];
		$ymessage	= $_POST['contact_message'];
		
		//globals
		@$error_console="";
		
		//run an error check
		if($ymessage == ""){$error_console="ymessage missing";}
		if($reason == "na"){$error_console="reason missing";}
		if($poc == "na"){$error_console="poc missing";}
		if($yemail == "Tell us your email"){$error_console="yemail missing";}
		if($yname == "Tell us your name"){$error_console="yname missing";}
				
		if($error_console != ""){
			//FAILED
			echo "<h2 class=\"pages-maincontent-title\">".$properties->FORM_TITLE."</h2>
			<div id=\"formLayoutTable\">
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Your Name</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						";
						if($error_console == "yname missing"){
							echo "<input type=\"text\" name=\"contact_yname\" id=\"contact_yname\" onfocus=\"if(this.value=='Tell us your name'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your name';}\" value=\"Tell us your name\" disabled=\"disabled\" /> <span style=\"color: red; font-weight: bold;\">Missing</span>";
						} else {
							echo "<input type=\"text\" name=\"contact_yname\" id=\"contact_yname\" onfocus=\"if(this.value=='Tell us your name'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your name';}\" value=\"{$yname}\" disabled=\"disabled\" />";
						}
						echo "
					</div>
				</div>
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Your Email</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						";
						if($error_console == "yemail missing"){
							echo "<input type=\"text\" name=\"contact_yemail\" id=\"contact_yemail\" onfocus=\"if(this.value=='Tell us your email'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your email';}\" value=\"Tell us your email\" disabled=\"disabled\" /> <span style=\"color: red; font-weight: bold;\">Missing</span>";
						} else {
							echo "<input type=\"text\" name=\"contact_yemail\" id=\"contact_yemail\" onfocus=\"if(this.value=='Tell us your email'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your email';}\" value=\"{$yemail}\" disabled=\"disabled\" />";
						}
						echo "
					</div>
				</div>";
					echo "<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Point of Contact?</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						";
						if($error_console == "poc missing"){
							echo "<select name=\"contact_poc\" id=\"contact_poc\" disabled=\"disabled\">";
							$GET_STAFF=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND isIncludedInMTS='yes' ORDER BY uname") or die('uh oh! '.mysql_error());
							if(mysql_num_rows($GET_STAFF)<1){
								echo "<option value=\"na\">---- no staff members avail ----</option>";
							} else {
								echo "<option value=\"na\">---- choose a staff member ----</option>";
								while($FETCH_STAFF=mysql_fetch_array($GET_STAFF)){
									if($poc === $FETCH_STAFF['poc_code']){
										echo "<option value=\"".$FETCH_STAFF['poc_code']."\" selected=\"selected\">".$FETCH_STAFF['fname']." ".$FETCH_STAFF['lname']." (".$FETCH_STAFF['title'].")"."</option>";
									} else {
										echo "<option value=\"".$FETCH_STAFF['poc_code']."\">".$FETCH_STAFF['fname']." ".$FETCH_STAFF['lname']." (".$FETCH_STAFF['title'].")"."</option>";	
									}
								}
							}				
							echo "</select> <span style=\"color: red; font-weight: bold;\">Missing</span>";
						} else {
							echo "<select name=\"contact_poc\" id=\"contact_poc\" disabled=\"disabled\">";
							$GET_STAFF=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type = 'admin' AND isIncludedInMTS='yes' ORDER BY uname") or die('uh oh! '.mysql_error());
							if(mysql_num_rows($GET_STAFF)<1){
								echo "<option value=\"na\">---- no staff members avail ----</option>";
							} else {
								echo "<option value=\"na\">---- choose a staff member ----</option>";
								while($FETCH_STAFF=mysql_fetch_array($GET_STAFF)){
									if($poc === $FETCH_STAFF['poc_code']){
										echo "<option value=\"".$FETCH_STAFF['poc_code']."\" selected=\"selected\">".$FETCH_STAFF['fname']." ".$FETCH_STAFF['lname']." (".$FETCH_STAFF['title'].")"."</option>";
									} else {
										echo "<option value=\"".$FETCH_STAFF['poc_code']."\">".$FETCH_STAFF['fname']." ".$FETCH_STAFF['lname']." (".$FETCH_STAFF['title'].")"."</option>";	
									}
								}
							}				
							echo "</select>";
						}
					echo "</div>
				</div>
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Reason</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">";
						if($error_console == "reason missing"){
							echo "<select name=\"contact_reason\" id=\"contact_reason\" disabled=\"disabled\">";
							$GET_REASONS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}reasons ORDER BY reason") or die('uh oh! '.mysql_error());
							if(mysql_num_rows($GET_REASONS)<1){
								echo "<option value=\"na\">---- no reasons avail ----</option>";
							} else {
								echo "<option value=\"na\">---- choose a reason ----</option>";	
								while($FETCH_REASONS=mysql_fetch_array($GET_REASONS)){
									if($reason === $FETCH_REASONS['rcode']){
										echo "<option value=\"".$FETCH_REASONS['rcode']."\" selected=\"selected\">".$FETCH_REASONS['reason']."</option>";
									} else {
										echo "<option value=\"".$FETCH_REASONS['rcode']."\">".$FETCH_REASONS['reason']."</option>";
									}
								}
							}
							echo "</select> <span style=\"color: red; font-weight: bold;\">Missing</span>";
						} else{
							echo "<select name=\"contact_reason\" id=\"contact_reason\" disabled=\"disabled\">";
							$GET_REASONS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}reasons ORDER BY reason") or die('uh oh! '.mysql_error());
							if(mysql_num_rows($GET_REASONS)<1){
								echo "<option value=\"na\">---- no reasons avail ----</option>";
							} else {
								echo "<option value=\"na\">---- choose a reason ----</option>";	
								while($FETCH_REASONS=mysql_fetch_array($GET_REASONS)){
									if($reason === $FETCH_REASONS['rcode']){
										echo "<option value=\"".$FETCH_REASONS['rcode']."\" selected=\"selected\">".$FETCH_REASONS['reason']."</option>";
									} else {
										echo "<option value=\"".$FETCH_REASONS['rcode']."\">".$FETCH_REASONS['reason']."</option>";
									}
								}
							}
							echo "</select>";
						}
					echo "</div>
				</div>";
				
				echo "<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Your Message</label>
					</div>";
					if($error_console == "ymessage missing"){
						echo "<div class=\"formLayoutTableRowRightCol\">
						<textarea cols=\"50\" rows=\"10\" id=\"contact_message\" name=\"contact_message\" disabled=\"disabled\">{$ymessage}</textarea> <span style=\"color: red; font-weight: bold;\">Missing</span></div>";
					} else {
						echo "<div class=\"formLayoutTableRowRightCol\">
						<textarea cols=\"50\" rows=\"10\" id=\"contact_message\" name=\"contact_message\" disabled=\"disabled\">{$ymessage}</textarea></div>";
					}
					echo "
				</div>
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<input type=\"button\" name=\"contact_back\" id=\"contact_back\" value=\"Try Again\" class=\"submit\" onclick=\"history.go(-1)\" />
					</div>
				</div>
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						Response
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<div style=\"color: red;font-weight: bold;\">Woops! This is embarrassing. I think you forgot something. :(</div>
					</div>
				</div>
			</div>";
			
		} else {
			//PASSED
			
			//send info to database along
			//check for dup
			$CHECK_FOR_QUERY_OPEN=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries WHERE contact_email='$yemail' AND status='Open'");
			$CHECK_FOR_QUERY_ESCALATED=mysql_query("SELECT * FROM {$properties->DB_PREFIX}queries WHERE contact_email='$yemail' AND status='Escalated'");
			@$query_error="";
			if((mysql_num_rows($CHECK_FOR_QUERY_OPEN)>0) || (mysql_num_rows($CHECK_FOR_QUERY_ESCALATED)>0)){
				//which one?
				if(mysql_num_rows($CHECK_FOR_QUERY_OPEN)>0){
					$FETCH_TICKET=mysql_fetch_array($CHECK_FOR_QUERY_OPEN);
					$query_error="You already have a query in the queue and therefore you cannot contact us again as that would be spamming and we do not like spam (and eggs). :( Try again later or wait for us to respond to your issue. To check the status of this ticket <a href=\"".$properties->WURL."checkstatus/{$FETCH_TICKET['ticket_id']}\" class=\"white-url\">click here</a>.";
				} else if(mysql_num_rows($CHECK_FOR_QUERY_ESCALATED)>0){
					$FETCH_TICKET=mysql_fetch_array($CHECK_FOR_QUERY_ESCALATED);
					$query_error="You already have an issue in the queue and it looks like it has been escalated to a higher level for a more in-depth look. We are working as hard as we can on this and it may take another 24 hours to resolve. To check the status of this ticket <a href=\"".$properties->WURL."checkstatus/{$FETCH_TICKET['ticket_id']}\" class=\"white-url\">click here</a>.";
				}
			} else {
				//generate ticket id
				@$rand_number=rand("000000000000","999999999999");
				@$unscrambled_string=$yname.$yemail.$rand_number;
				@$ticket_id=str_shuffle($unscrambled_string);
				
				//put together date and time string
				//0000-00-00 00:00:00
				
				//get the date
				$datenow=date("Y-m-d");
				$timenow=date("H:i:s");
				
				//put it togethet
				$dateandtime=$datenow." ".$timenow;
				
				mysql_query("INSERT INTO {$properties->DB_PREFIX}queries (ticket_id,contact_name,contact_email,poc,reason,contact_message,extra_notes,status,dateandtime) VALUES ('$ticket_id','$yname','$yemail','$poc','$reason','$ymessage','','Open','$dateandtime')");	
			}
			
			echo "<h2 class=\"pages-maincontent-title\">".$properties->FORM_TITLE."</h2>
			<div id=\"formLayoutTable\">
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Your Name</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<input type=\"text\" name=\"contact_yname\" id=\"contact_yname\" onfocus=\"if(this.value=='Tell us your name'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your name';}\" value=\"{$yname}\" disabled=\"disabled\" />
					</div>
				</div>
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Your Email</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<input type=\"text\" name=\"contact_yemail\" id=\"contact_yemail\" onfocus=\"if(this.value=='Tell us your email'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your email';}\" value=\"{$yemail}\" disabled=\"disabled\" />
					</div>
				</div>";
					echo "<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Point of Contact?</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<select name=\"contact_poc\" id=\"contact_poc\" disabled=\"disabled\">";
							$GET_STAFF=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type='admin' AND isIncludedInMTS='yes' ORDER BY uname") or die('uh oh! '.mysql_error());
							if(mysql_num_rows($GET_STAFF)<1){
								echo "<option value=\"na\">---- no staff members avail ----</option>";
							} else {
								echo "<option value=\"na\">---- choose a staff member ----</option>";
								while($FETCH_STAFF=mysql_fetch_array($GET_STAFF)){
									if($FETCH_STAFF['poc_code'] == $poc){
										echo "<option value=\"".$FETCH_STAFF['poc_code']."\" selected=\"selected\">".$FETCH_STAFF['fname']." ".$FETCH_STAFF['lname']." (".$FETCH_STAFF['title'].")"."</option>";
									} else {
										echo "<option value=\"".$FETCH_STAFF['poc_code']."\">".$FETCH_STAFF['fname']." ".$FETCH_STAFF['lname']." (".$FETCH_STAFF['title'].")"."</option>";	
									}
								}
							}				
						echo "</select>
					</div>
				</div>
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Reason</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<select name=\"contact_reason\" id=\"contact_reason\" disabled=\"disabled\">";
							$GET_REASONS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}reasons ORDER BY reason") or die('uh oh! '.mysql_error());
							if(mysql_num_rows($GET_REASONS)<1){
								echo "<option value=\"na\">---- no reasons avail ----</option>";
							} else {
								echo "<option value=\"na\">---- choose a reason ----</option>";	
								while($FETCH_REASONS=mysql_fetch_array($GET_REASONS)){
									if($FETCH_REASONS['rcode'] == $reason){
										echo "<option value=\"".$FETCH_REASONS['rcode']."\" selected=\"selected\">".$FETCH_REASONS['reason']."</option>";
									} else {
										echo "<option value=\"".$FETCH_REASONS['rcode']."\">".$FETCH_REASONS['reason']."</option>";
									}
								}
							}
						echo "</select>
					</div>
				</div>";
				
				echo "<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						<label>Your Message</label>
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<textarea cols=\"50\" rows=\"10\" id=\"contact_message\" name=\"contact_message\" disabled=\"disabled\">{$ymessage}</textarea>
					</div>
				</div>
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<input type=\"submit\" name=\"contact_send\" id=\"contact_send\" value=\"Send\" class=\"submit\" disabled=\"disabled\" />
					</div>
				</div>
				
				";
				if($query_error != ""){
					//there was an error with the query
					echo "
					<div class=\"formLayoutTableRow\">
						<div class=\"formLayoutTableRowLeftCol\">
							Response
						</div>
						<div class=\"formLayoutTableRowRightCol\">
							<div style=\"color: red;font-weight: bold;\">".$query_error."</div>
						</div>
					</div>
					";
				} else {
					echo "
					<div class=\"formLayoutTableRow\">
						<div class=\"formLayoutTableRowLeftCol\">
							Response
						</div>";
						@$launchpad=$_GET['launchpad'];
						@$page=$_GET['page'];
						echo "
						<div class=\"formLayoutTableRowRightCol\">
							<div style=\"color: red;font-weight: bold;\">Thank you! Your message has been sent and you should hear from us within 24 to 72 hours depending on your issue. :) For your reference, we have generated a ticket number of: <b>{$ticket_id}</b> - Use it to check the status @ <a href=\"".$properties->WURL."checkstatus\" class=\"white-url\">checkstatus</a>.</div>
						</div>
					</div>
					";
				}
				echo "
				
				<div class=\"formLayoutTableRow\">
					<div class=\"formLayoutTableRowLeftCol\">
						Directions
					</div>
					<div class=\"formLayoutTableRowRightCol\">
						<div style=\"color: blue;font-weight: bold;\">Please exit <a href=\"../\">here</a></div>
					</div>
				</div>
			</div>";
		}
	} else {
		echo "<h2 class=\"pages-maincontent-title\">".$properties->FORM_TITLE."</h2>
		<form action=\"\" method=\"post\" name=\"contact_form\">
		<div id=\"formLayoutTable\">
			<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					<label>Your Name</label>
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					<input type=\"text\" name=\"contact_yname\" id=\"contact_yname\" onfocus=\"if(this.value=='Tell us your name'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your name';}\" value=\"Tell us your name\" />
				</div>
			</div>
			
			<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					<label>Your Email</label>
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					<input type=\"text\" name=\"contact_yemail\" id=\"contact_yemail\" onfocus=\"if(this.value=='Tell us your email'){this.value='';}\" onblur=\"if(this.value==''){this.value='Tell us your email';}\" value=\"Tell us your email\" />
				</div>
			</div>";
				echo "<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					<label>Point of Contact?</label>
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					<select name=\"contact_poc\" id=\"contact_poc\">";
						$GET_STAFF=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE type='admin' AND isIncludedInMTS='yes' ORDER BY uname") or die('uh oh! '.mysql_error());
						if(mysql_num_rows($GET_STAFF)<1){
							echo "<option value=\"na\">---- no staff members avail ----</option>";
						} else {
							echo "<option value=\"na\">---- choose a staff member ----</option>";	
							while($FETCH_STAFF=mysql_fetch_array($GET_STAFF)){
								//get the staff title
								@$staff_type=$FETCH_STAFF['staff_type'];
								@$GET_STAFF_CODE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types WHERE id='$staff_type'");
								$FETCH_STAFF_TYPE=mysql_fetch_array($GET_STAFF_CODE);
								$staff_title=$FETCH_STAFF_TYPE['name'];
								echo "<option value=\"".$FETCH_STAFF['id']."\">".$FETCH_STAFF['fname']." ".$FETCH_STAFF['lname']." (".$staff_title.")"."</option>";	
							}
						}				
					echo "</select>
				</div>
			</div>
			
			<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					<label>Reason</label>
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					<select name=\"contact_reason\" id=\"contact_reason\">";
						$GET_REASONS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}reasons ORDER BY reason") or die('uh oh! '.mysql_error());
						if(mysql_num_rows($GET_REASONS)<1){
							echo "<option value=\"na\">---- no reasons avail ----</option>";
						} else {
							echo "<option value=\"na\">---- choose a reason ----</option>";	
							while($FETCH_REASONS=mysql_fetch_array($GET_REASONS)){
								echo "<option value=\"".$FETCH_REASONS['rcode']."\">".$FETCH_REASONS['reason']."</option>";	
							}
						}
					echo "</select>
				</div>
			</div>";
			
			echo "<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					<label>Your Message</label>
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					<textarea cols=\"50\" rows=\"10\" id=\"contact_message\" name=\"contact_message\"></textarea>
				</div>
			</div>
			
			<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					<input type=\"submit\" name=\"contact_send\" id=\"contact_send\" value=\"Send\" class=\"submit\" /> <input type=\"reset\" name=\"contact_reset\" id=\"contact_reset\" value=\"Start Over\" class=\"submit\" />
				</div>
			</div>
			
			<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					
				</div>
			</div>
			
			<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					Options
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					";
					echo "
					Already have an open ticket/issue?
				</div>
			</div>
			
			<div class=\"formLayoutTableRow\">
				<div class=\"formLayoutTableRowLeftCol\">
					
				</div>
				<div class=\"formLayoutTableRowRightCol\">
					Check the status of it @ <a href=\"".$properties->WURL."checkstatus\" target=\"n-view\" class=\"white-url\">checkstatus</a>
	
				</div>
			</div>
		</div>
		</form>";
	}
}
?>
</body>
</html>
