<h1>Personal Settings</h1>
<?php
if(isset($_POST['save'])){
	/* SITE UPDATES */
	/* STEP 1: GET ALL DATA */
	$data_fname=mysql_real_escape_string($_POST['data_fname']);
	$data_lname=mysql_real_escape_string($_POST['data_lname']);
	$data_gender=mysql_real_escape_string($_POST['data_gender']);
	
	//$data_uname=mysql_real_escape_string($_POST['data_uname']);
	
	$data_oldpass=mysql_real_escape_string($_POST['data_oldpass']);
	
	$data_newpass=mysql_real_escape_string($_POST['data_newpass']);
	$data_confirmpass=mysql_real_escape_string($_POST['data_confirmpass']);
	$data_email=mysql_real_escape_string($_POST['data_email']);
	$data_type=mysql_real_escape_string($_POST['data_type']);
	$data_headadmin=mysql_real_escape_string($_POST['data_headadmin']);
	
	$data_issearchable=mysql_real_escape_string($_POST['data_issearchable']);
	$data_stafftype=mysql_real_escape_string($_POST['data_stafftype']);
	$data_securityquestion=mysql_real_escape_string($_POST['data_securityquestion']);
	$data_securityanswer=mysql_real_escape_string($_POST['data_securityanswer']);
	
	$data_opin1=mysql_real_escape_string($_POST['data_opin1']);	
	$data_opin2=mysql_real_escape_string($_POST['data_opin2']);
	$data_opin3=mysql_real_escape_string($_POST['data_opin3']);
	$data_opin4=mysql_real_escape_string($_POST['data_opin4']);
	
	$data_pin1=mysql_real_escape_string($_POST['data_pin1']);	
	$data_pin2=mysql_real_escape_string($_POST['data_pin2']);
	$data_pin3=mysql_real_escape_string($_POST['data_pin3']);
	$data_pin4=mysql_real_escape_string($_POST['data_pin4']);
	
	$data_cpin1=mysql_real_escape_string($_POST['data_cpin1']);
	$data_cpin2=mysql_real_escape_string($_POST['data_cpin2']);		
	$data_cpin3=mysql_real_escape_string($_POST['data_cpin3']);
	$data_cpin4=mysql_real_escape_string($_POST['data_cpin4']);
	
	$data_notifications=mysql_real_escape_string($_POST['data_notifications']);
	$data_howtodisplayname=mysql_real_escape_string($_POST['data_howtodisplayname']);
	$data_iswebmaster=mysql_real_escape_string($_POST['data_iswebmaster']);
	$data_themeid=mysql_real_escape_string($_POST['data_themeid']);
	
	$data_isincludedinmts=mysql_real_escape_string($_POST['data_isincludedinmts']);
	
	/* STEP 2: CHECK DATA FOR ACCURACY */
	if($data_fname == ""){$error_console.="You must provide a First Name.<br />";}
	if($data_lname == ""){$error_console.="You must provide a Last Name.<br />";}
	if($data_newpass != ""){if($data_confirmpass == ""){$error_console.="Since you are changing the password, you must confirm your new password.<br />";}}
	if(($data_newpass != "" && $data_confirmpass !="") && $data_oldpass == ""){$error_console.="You must tell me what your old password is.<br />";}
	if(($data_oldpass != "") && ($data_newpass=="" || $data_confirmpass=="")){$error_console.="If you aren't changing your password, there is no need to enter anything into the Old Password field.<br />";}
	
	//08647ba01c76cab1e39f1a6a30feb8c720fa09a289ec54b55a1a4ee26b58c610

	if($data_newpass!=""){if(hash('sha256',md5(sha1($data_oldpass)))!=$currp){$error_console.="Since you are changing the password, you must enter the correct current password.<br />";}}
	
	if($data_email == ""){$error_console.="You must provide an Email.<br />";}
	if($data_securityquestion != "0"){if($data_securityanswer==""){$error_console.="You must provide an answer to your security question.<br />";}}
	
	if(($data_pin1 != "" && $data_pin2 != "" && $data_pin3 != "" && $data_pin4 != "") && ($data_opin1 == "" && $data_opin2 == "" && $data_opin3 == "" && $data_opin4 == "")){$error_console.="Since you are changing your PIN, you must provide the Old Pin.<br />";}
	
	if(($data_pin1 != "" && $data_pin2 != "" && $data_pin3 != "" && $data_pin4 != "") && ($data_opin1 != "" && $data_opin2 != "" && $data_opin3 != "" && $data_opin4 != "") && ($data_cpin1 == "" || $data_cpin2 == "" || $data_cpin3 == "" || $data_cpin4 == "")){$error_console.="Since you are changing your PIN, you must confirm your new PIN.<br />";}
	
	if(($data_pin1 != $data_cpin1) || ($data_pin2 != $data_cpin2) || ($data_pin3 != $data_cpin3) || ($data_pin4 != $data_cpin4)){$error_console.="Uh oh! Your New Pin and your confirmation of Your New Pin do not match.<br />";}
	
	/* THIS ONE REQUIRES TO GET THE USER'S CURRENT PIN */
	$current_pin=$pin;
	$curr_pin1=substr($current_pin,0,1);
	$curr_pin2=substr($current_pin,1,1);
	$curr_pin3=substr($current_pin,2,1);
	$curr_pin4=substr($current_pin,3,1);
	
	if($data_opin1!="" && $data_opin2!="" && $data_opin3!="" && $data_opin4!=""){if(($data_opin1 != $curr_pin1) || ($data_opin2 != $curr_pin2) || ($data_opin3 != $curr_pin3) || ($data_opin4 != $curr_pin4)){$error_console.="You must enter the correct Old Pin.<br />";}}
	
	if($error_console != "") {
		/* THERE IS AN ERROR */	
		echo $error_console."<a onclick=\"history.go(-1)\" style=\"cursor: pointer;\">Go back</a>";
	} else {
		/* STEP 3.5: DO SOME MASTERY */
		$data_newupass=hash('sha256',md5(sha1($data_newpass)));
		
		$data_pin=$data_pin1.$data_pin2.$data_pin3.$data_pin4;
		
		/* STEP 3: POST TO DATABASE */
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET fname = '$data_fname' WHERE id='".$user_id."'") or die(mysql_error());
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET lname = '$data_lname' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET gender = '$data_gender' WHERE id='".$user_id."'");
		
		//mysql_query("UPDATE {$properties->DB_PREFIX}users SET uname = '$data_uname' WHERE id='".$user_id."'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET upass = '$data_newupass' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET email = '$data_email' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET type = '$data_type' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET head_admin = '$data_headadmin' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET is_searchable = '$data_issearchable' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET staff_type = '$data_stafftype' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET security_question = '$data_securityquestion' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET security_answer = '$data_securityanswer' WHERE id='".$user_id."'");
		if($data_pin1!="" && $data_pin2!="" && $data_pin3!="" && $data_pin4!=""){mysql_query("UPDATE {$properties->DB_PREFIX}users SET pin = '$data_pin' WHERE id='".$user_id."'");}
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET notifications = '$data_notifications' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET is_webmaster = '$data_iswebmaster' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET how_to_display_name = '$data_howtodisplayname' WHERE id='".$user_id."'");
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET themeID = '$data_themeid' WHERE id='".$user_id."'") or die(mysql_error());
		mysql_query("UPDATE {$properties->DB_PREFIX}users SET IsIncludedInMTS = '$data_isincludedinmts' WHERE id='".$user_id."'");
				
		/* STEP 4: RETURN SUCCESS */
		if($data_gender=="other"){
			echo "Successfully saved your profile to Earth's Database. Welcome to the Planet Earth! <a href=\"?menu=users&page=personal-settings\" style=\"cursor: pointer;\">Refresh</a>";
		} else {
			echo "Successfully saved! <a href=\"?menu=users&page=personal-settings\" style=\"cursor: pointer;\">Refresh</a>";	
		}
	}
} else {
	$GET_DATA=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE id='".$user_id."'");
	if(mysql_num_rows($GET_DATA)<1){
		?>
        Um...something seems wrong here. We cannot find you account which is strange. You may be hacking or something. Please do not do that!
        <?php
	} else {
		while($FETCH_USER_DATA=mysql_fetch_array($GET_DATA)){
			$data_id=$FETCH_USER_DATA['id'];
			$data_fname=$FETCH_USER_DATA['fname'];
			$data_lname=$FETCH_USER_DATA['lname'];
			$data_gender=$FETCH_USER_DATA['gender'];
			$data_uname=$FETCH_USER_DATA['uname'];
			$data_upass=$FETCH_USER_DATA['upass'];
			$data_email=$FETCH_USER_DATA['email'];
			$data_type=$FETCH_USER_DATA['type'];
			$data_headadmin=$FETCH_USER_DATA['head_admin'];
			$data_issearchable=$FETCH_USER_DATA['is_searchable'];
			$data_stafftype=$FETCH_USER_DATA['staff_type'];
			$data_status=$FETCH_USER_DATA['status'];
			$data_securityquestion=$FETCH_USER_DATA['security_question'];
			$data_securityanswer=$FETCH_USER_DATA['security_answer'];
			$data_pin=$FETCH_USER_DATA['pin'];
			$data_pin1=substr($data_pin,0,1);
			$data_pin2=substr($data_pin,1,1);
			$data_pin3=substr($data_pin,2,1);
			$data_pin4=substr($data_pin,3,1);
			$data_why=$FETCH_USER_DATA['why'];
			$data_loggedin=$FETCH_USER_DATA['loggedin'];
			$data_loggedsession=$FETCH_USER_DATA['logged_session'];
			$data_agreetotos=$FETCH_USER_DATA['agree_to_tos'];
			$data_suspendedreason=$FETCH_USER_DATA['suspended_reason'];
			$data_toustatus=$FETCH_USER_DATA['tou_status'];
			$data_insite=$FETCH_USER_DATA['in_site'];
			$data_dateandtimeapplied=$FETCH_USER_DATA['dateandtime_applied'];
			$data_dateandtimelastlogin=$FETCH_USER_DATA['dateandtime_lastlogin'];
			$data_notifications=$FETCH_USER_DATA['notifications'];
			$data_iswebmaster=$FETCH_USER_DATA['is_webmaster'];
			$data_howtodisplayname=$FETCH_USER_DATA['how_to_display_name'];
			$data_themeid=$FETCH_USER_DATA['themeID'];
			$data_isincludedinmts=$FETCH_USER_DATA['isIncludedInMTS'];
			$data_fblike=$FETCH_USER_DATA['fb_like'];
			$data_level=$FETCH_USER_DATA['level'];
		}
		?>
        <form action="" method="post">
            <fieldset>
                <legend>Your Settings</legend>
                <div class="formLayoutTableMainAll">
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            First Name
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="text" name="data_fname" value="<?php echo $data_fname;?>" />
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Last Name
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="text" name="data_lname" value="<?php echo $data_lname;?>" />
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Gender
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <select name="data_gender">
                                <?php if($data_gender=="male"){?><option value="male" selected="selected">Male</option><?php } else {?><option value="male">Male</option><?php }?>
                                <?php if($data_gender=="female"){?><option value="female" selected="selected">Female</option><?php } else {?><option value="female">Female</option><?php }?>
                                <?php if($data_gender=="other"){?><option value="other" selected="selected">Other</option><?php } else {?><option value="other">Other</option><?php }?>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Username
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="text" name="data_uname" value="<?php echo $data_uname;?>" disabled="disabled" />
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Old Password
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="password" name="data_oldpass" value="" /> * If you are changing your password, you must tell me your old password
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            New Password
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="password" name="data_newpass" value="" />
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Confirm Password
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="password" name="data_confirmpass" value="" /> * If you change the password, you must provide this
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Email
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="text" name="data_email" value="<?php echo $data_email;?>" />
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            User Role
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <select name="data_type"  <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?>>
                                <?php if($data_type=="user"){?><option value="user" selected="selected">User</option><?php } else {?><option value="user">User</option><?php }?>
                                <?php if($data_type=="writer"){?><option value="writer" selected="selected">Writer</option><?php } else {?><option value="writer">Writer</option><?php }?>
                                <?php if($data_type=="mod"){?><option value="mod" selected="selected">Moderator</option><?php } else {?><option value="mod">Moderator</option><?php }?>
                                <?php if($data_type=="admin"){?><option value="admin" selected="selected">Admin</option><?php } else {?><option value="admin">Admin</option><?php }?>
                                <?php if($data_type=="beta"){?><option value="beta" selected="selected">BETA Tester</option><?php } else {?><option value="beta">BETA Tester</option><?php }?>
                                
                            </select>
                        </div>
                    </div>
                    
                     <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Head Admin Role?
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <?php
                            if($data_headadmin=="yes"){
                                ?>
                                <input type="radio" name="data_headadmin" value="yes" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> Yes <input type="radio" name="data_headadmin" value="no" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> No
                                <?php
                            } else {
                                ?>
                                <input type="radio" name="data_headadmin" value="yes" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> Yes <input type="radio" name="data_headadmin" value="no" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> No
                                <?php
                            }
                            ?> * <b>NOTE: </b> If you are currently Head Admin and change this to "no", you will <b>not</b> be able to change it back
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Do you want to appear on searches?
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <?php
                            if($data_issearchable=="yes"){
                                ?>
                                <input type="radio" name="data_issearchable" value="yes" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> Yes <input type="radio" name="data_issearchable" value="no" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> No
                                <?php
                            } else {
                                ?>
                                <input type="radio" name="data_issearchable" value="yes" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> Yes <input type="radio" name="data_issearchable" value="no" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> No
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Staff Type
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">                            
                            <select name="data_stafftype" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?>>
                            	<?php
                                /* GET THE STAFF TYPE THINGS */
								$GET_STAFFTYPE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}staff_types ORDER BY name");
								if(mysql_num_rows($GET_STAFFTYPE)<1){
									echo "<option value=\"\">No Staff Types</option>";
								} else {
									while($FETCH_STAFFTYPE=mysql_fetch_array($GET_STAFFTYPE)){
										if($data_stafftype == $FETCH_STAFFTYPE['id']){
											?><option value="<?php echo $FETCH_STAFFTYPE['id'];?>" selected="selected"><?php echo $FETCH_STAFFTYPE['name'];?></option><?php
										} else {
											?><option value="<?php echo $FETCH_STAFFTYPE['id'];?>"><?php echo $FETCH_STAFFTYPE['name'];?></option><?php
										}
									}
								}
								?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Security Question
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">                            
                            <select name="data_securityquestion">
                            	<?php
                                /* GET THE SECURITY QUESTION THINGS */
								$GET_SQ=mysql_query("SELECT * FROM {$properties->DB_PREFIX}security_questions ORDER BY value");
								if(mysql_num_rows($GET_SQ)<1){
									echo "<option value=\"\">No Security Questions</option>";
								} else {
									while($FETCH_SQ=mysql_fetch_array($GET_SQ)){
										if($data_securityquestion == $FETCH_SQ['id']){
											?><option value="<?php echo $FETCH_SQ['id'];?>" selected="selected"><?php echo $FETCH_SQ['value'];?></option><?php
										} else {
											?><option value="<?php echo $FETCH_SQ['id'];?>"><?php echo $FETCH_SQ['value'];?></option><?php
										}
									}
									?>
                                    <option value="null" disabled="disabled">-----------------------------------------------------</option>
                                    <?php
									if($data_securityquestion == "0"){
										?><option value="0" selected="selected">I have not set one up</option><?php
									} else {
										?><option value="0">I have not set one up</option><?php
									}
								}
								?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Security Answer
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="text" name="data_securityanswer" value="<?php echo $data_securityanswer;?>" />
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Old PIN (Personal Identification Number)
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="password" name="data_opin1" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_opin2" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_opin3" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_opin4" maxlength="1" class="pin" />&nbsp;
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            New PIN (Personal Identification Number)
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="password" name="data_pin1" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_pin2" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_pin3" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_pin4" maxlength="1" class="pin" />&nbsp; * You do <b>not</b> have to provide this if you want to leave it alone
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Confirm PIN (Personal Identification Number)
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <input type="password" name="data_cpin1" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_cpin2" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_cpin3" maxlength="1" class="pin" />&nbsp;
                            <input type="password" name="data_cpin4" maxlength="1" class="pin" />&nbsp; * If you provided a new PIN, you must confirm it
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Do you want to receive notifications via email?
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <?php
                            if($data_notifications=="on"){
                                ?>
                                <input type="radio" name="data_notifications" value="on" checked="checked" class="radio" /> Yes <input type="radio" name="data_notifications" value="off" class="radio" /> No
                                <?php
                            } else {
                                ?>
                                <input type="radio" name="data_notifications" value="on" class="radio" /> Yes <input type="radio" name="data_notifications" value="off" checked="checked" class="radio" /> No
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Webmaster Role?
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
	                        
     	                   <?php                            
						   
						   if($data_iswebmaster=="yes"){
							   ?>
								<input type="radio" name="data_iswebmaster" value="yes" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> Yes <input type="radio" name="data_iswebmaster" value="no" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> No
								<?php   
						   } else {
								?>
								<input type="radio" name="data_iswebmaster" value="yes" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> Yes <input type="radio" name="data_iswebmaster" value="no" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?>  /> No
								<?php   
						   }
						   
                           ?> * <b>NOTE: </b> If you are currently the Webmaster and change this to "no", you will <b>not</b> be able to change it back which means you will have to go and manually fix this in the database
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            How do you want your name displayed?
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <select name="data_howtodisplayname">
                                <?php if($data_howtodisplayname=="full"){?><option value="full" selected="selected">Full Name</option><?php } else {?><option value="full">Full Name</option><?php }?>
                                <?php if($data_howtodisplayname=="only username"){?><option value="only username" selected="selected">Only Username</option><?php } else {?><option value="only username">Only Username</option><?php }?>
                                <?php if($data_howtodisplayname=="only first name"){?><option value="only first name" selected="selected">Only First Name</option><?php } else {?><option value="only first name">Only First Name</option><?php }?>                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Theme?
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                        	<?php if(getGlobalVars($properties,'tm_cbc') == "off"){?><input type="hidden" name="data_themeid" value="1" /><?php }?>
                            <select name="data_themeid" <?php if(getGlobalVars($properties,'tm_cbc') == "off"){?>disabled="disabled"<?php }else{?><?php }?>>
                            	<?php
                                /* GET THE THEMES THINGS */
								$GET_THEMES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE endrun='avail' AND type='free' ORDER BY pretty_name ");
								if(mysql_num_rows($GET_THEMES)<1){
									echo "<option value=\"\">No Themes</option>";
								} else {
									while($FETCH_THEMES=mysql_fetch_array($GET_THEMES)){
										if($data_themeid == $FETCH_THEMES['id']){
											?><option value="<?php echo $FETCH_THEMES['id'];?>" selected="selected"><?php echo $FETCH_THEMES['pretty_name'];?></option><?php
										} else {
											?><option value="<?php echo $FETCH_THEMES['id'];?>"><?php echo $FETCH_THEMES['pretty_name'];?></option><?php
										}
									}									
								}
								?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="formLayoutTableRowMainAll">
                        <div class="formLayoutTableRowMainAllLeftCol">
                            Include as a Contact?
                        </div>
                        <div class="formLayoutTableRowMainAllRightCol">
                            <?php
                            if($data_isincludedinmts=="yes"){
                                ?>
                                <input type="radio" name="data_isincludedinmts" value="yes" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> Yes <input type="radio" name="data_isincludedinmts" value="no" class="radio" /> No
                                <?php
                            } else {
                                ?>
                                <input type="radio" name="data_isincludedinmts" value="yes" class="radio" /> Yes <input type="radio" name="data_isincludedinmts" value="no" checked="checked" class="radio" <?php if(($type=="admin" && $head_admin=="yes") || ($data_iswebmaster=="yes" || $data_iswebmasterbydefault=="yes")){?><?php }else{?>disabled="disabled"<?php }?> /> No
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                </div>
                
            </fieldset>
            <br />
            <center><input type="submit" name="save" value="Save" /></center>
            <br />
        </form>
        <?php
	}
}
?>