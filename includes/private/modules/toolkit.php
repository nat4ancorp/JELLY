
<script type="text/javascript">
function doAction(action,username,themeToID){
	/*var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}*/
	switch(action){
		case 'leavesite':
			//var to hold the request
			var request;
			
			//bind to the submit event of our form
			//abort any pending request
			/*if (request) {
				request.abort();	
			}*/
			//setup some local variables
			//var $form = $(this);
			//let's select and cache all the fields
			//var $inputs = $form.find("input, select, button, textarea");
			//serialize the data in the form
			//var serializeData = $form.serialize();
			
			//let's disable the inputs for the duration of the ajax request
			//$inputs.prop("disabled", true);
			
			//fire off the request to /form.php
			var KeyVals = { username : username };
			var request = $.ajax({
				type: "POST",
				url: "<?php echo $properties->WEBSITE_URL;?>includes/private/bin/doAction.php?action="+action+"",
				data: KeyVals,
				dataType: "text",
				success: function(data){
					//alert("Save Complete");
					if(data == 'yes'){/*$("#message").html("Okay, I won't display anymore for you on this computer. :(");*/document.location.reload();}
					//else if(data == 'no'){/*$("#message").html("Alright! I will be here for you. :)");*/}
				}
			});
		break;
		
		case 'logout':
			//var to hold the request
			var request;
			
			//bind to the submit event of our form
			//abort any pending request
			/*if (request) {
				request.abort();	
			}*/
			//setup some local variables
			//var $form = $(this);
			//let's select and cache all the fields
			//var $inputs = $form.find("input, select, button, textarea");
			//serialize the data in the form
			//var serializeData = $form.serialize();
			
			//let's disable the inputs for the duration of the ajax request
			//$inputs.prop("disabled", true);
			
			//fire off the request to /form.php
			var KeyVals = { username : username };
			var request = $.ajax({
				type: "POST",
				url: "<?php echo $properties->WEBSITE_URL;?>includes/private/bin/doAction.php?action="+action+"",
				data: KeyVals,
				dataType: "text",
				success: function(data){
					//alert("Save Complete");
					if(data == 'yes'){/*$("#message").html("Okay, I won't display anymore for you on this computer. :(");*/document.location.reload();}
					//else if(data == 'no'){/*$("#message").html("Alright! I will be here for you. :)");*/}
				}
			});
		break;
		
		case 'changeThemeTemp':
			//var to hold the request
			var request;
			
			//bind to the submit event of our form
			//abort any pending request
			/*if (request) {
				request.abort();	
			}*/
			//setup some local variables
			//var $form = $(this);
			//let's select and cache all the fields
			//var $inputs = $form.find("input, select, button, textarea");
			//serialize the data in the form
			//var serializeData = $form.serialize();
			
			//let's disable the inputs for the duration of the ajax request
			//$inputs.prop("disabled", true);
			
			//fire off the request to /form.php
			var KeyVals = { username : username };
			var request = $.ajax({
				type: "POST",
				url: "<?php echo $properties->WEBSITE_URL;?>includes/private/bin/doAction.php?action="+action+"",
				data: KeyVals,
				dataType: "text",
				success: function(data){
					//alert("Save Complete");
					if(data == 'yes'){/*$("#message").html("Okay, I won't display anymore for you on this computer. :(");*/document.location.reload();}
					//else if(data == 'no'){/*$("#message").html("Alright! I will be here for you. :)");*/}
				}
			});
		break;
		
		case 'changeThemeUser':
			//var to hold the request
			var request;
			
			//bind to the submit event of our form
			//abort any pending request
			/*if (request) {
				request.abort();	
			}*/
			//setup some local variables
			//var $form = $(this);
			//let's select and cache all the fields
			//var $inputs = $form.find("input, select, button, textarea");
			//serialize the data in the form
			//var serializeData = $form.serialize();
			
			//let's disable the inputs for the duration of the ajax request
			//$inputs.prop("disabled", true);
			
			//fire off the request to /form.php
			var KeyVals = { username : username, themeToID : themeToID };
			var request = $.ajax({
				type: "POST",
				url: "<?php echo $properties->WEBSITE_URL;?>includes/private/bin/doAction.php?action="+action+"",
				data: KeyVals,
				dataType: "text",
				success: function(data){
					//alert("Save Complete");
					if(data == 'yes'){/*$("#message").html("Okay, I won't display anymore for you on this computer. :(");*/document.location.reload();}
					//else if(data == 'no'){/*$("#message").html("Alright! I will be here for you. :)");*/}
				}
			});
		break;
	}	
}
</script>
<div class="left">
    <div id="topnav-left-table">
        <div class="tn-l-row">
            <div id="tn-l-col-left">
            	<div id="launchpad-switcher">
                <?php
				$PADAMOUNT=$properties->PAD_AMOUNT;
				$PADSOFI=$properties->PADMAIN.",".$properties->PAD1.",".$properties->PAD2.",".$properties->PAD3.",".$properties->PAD4.",";
				$PADCLASSES="first,second,third,fourth,last,";
				$PADSOFI_LIST=explode(",",$PADSOFI);
				$PADCLASSES_LIST=explode(",",$PADCLASSES);
				for($ipadamount=0; $ipadamount<$PADAMOUNT; $ipadamount++){					
					?>
					<?php if($PADSOFI_LIST[$ipadamount] == $launchpad){?><a class="<?php echo $PADCLASSES_LIST[$ipadamount];?>-a-selected" href="<?php echo $properties->getWURL();?><?php echo $PADSOFI_LIST[$ipadamount];?>/home"><?php echo $PADSOFI_LIST[$ipadamount];?></a><?php }else{?><a href="<?php echo $properties->getWURL();?><?php echo $PADSOFI_LIST[$ipadamount];?>/home" class="<?php echo $PADCLASSES_LIST[$ipadamount];?>-a"><?php echo $PADSOFI_LIST[$ipadamount];?></a><?php }
				}
				?>
	            </div>
            </div>
            <div id="tn-l-col-right">
                <?php
				switch($launchpad){
					case $properties->PADMAIN:
						echo "<form action=\"".$properties->WEBSITE_URL.$launchpad."/search\" method=\"POST\">" .
							 "<input type=\"search\" name=\"search\" class=\"searchClass\"" .
							 " value=\"".$properties->DEFAULT_SEARCH_TEXT_PADMAIN."\" " .
							 "onfocus=\"if(this.value == '".$properties->DEFAULT_SEARCH_TEXT_PADMAIN."')" .
							 "{this.value=''}\" onblur=\"if(this.value == ''){" .
							 "this.value='".$properties->DEFAULT_SEARCH_TEXT_PADMAIN."'}\" /></form>";
					break;
					case $properties->PAD1:
						echo "<form action=\"".$properties->WEBSITE_URL.$launchpad."/search\" method=\"POST\">" .
							 "<input type=\"search\" name=\"search\" class=\"searchClass\"" .
							 " value=\"".$properties->DEFAULT_SEARCH_TEXT_PAD1."\" " .
							 "onfocus=\"if(this.value == '".$properties->DEFAULT_SEARCH_TEXT_PAD1."')" .
							 "{this.value=''}\" onblur=\"if(this.value == ''){" .
							 "this.value='".$properties->DEFAULT_SEARCH_TEXT_PAD1."'}\" /></form>";
					break;
					case $properties->PAD2:
						echo "<form action=\"".$properties->WEBSITE_URL.$launchpad."/search\" method=\"POST\">" .
							 "<input type=\"search\" name=\"search\" class=\"searchClass\"" .
							 " value=\"".$properties->DEFAULT_SEARCH_TEXT_PAD2."\" " .
							 "onfocus=\"if(this.value == '".$properties->DEFAULT_SEARCH_TEXT_PAD2."')" .
							 "{this.value=''}\" onblur=\"if(this.value == ''){" .
							 "this.value='".$properties->DEFAULT_SEARCH_TEXT_PAD2."'}\" /></form>";
					break;
					case $properties->PAD3:
						echo "<form action=\"".$properties->WEBSITE_URL.$launchpad."/search\" method=\"POST\">" .
							 "<input type=\"search\" name=\"search\" class=\"searchClass\"" .
							 " value=\"".$properties->DEFAULT_SEARCH_TEXT_PAD3."\" " .
							 "onfocus=\"if(this.value == '".$properties->DEFAULT_SEARCH_TEXT_PAD3."')" .
							 "{this.value=''}\" onblur=\"if(this.value == ''){" .
							 "this.value='".$properties->DEFAULT_SEARCH_TEXT_PAD3."'}\" /></form>";
					break;
					case $properties->PAD4:
						echo "<form action=\"".$properties->WEBSITE_URL.$launchpad."/search\" method=\"POST\">" .
							 "<input type=\"search\" name=\"search\" class=\"searchClass\"" .
							 " value=\"".$properties->DEFAULT_SEARCH_TEXT_PAD4."\" " .
							 "onfocus=\"if(this.value == '".$properties->DEFAULT_SEARCH_TEXT_PAD4."')" .
							 "{this.value=''}\" onblur=\"if(this.value == ''){" .
							 "this.value='".$properties->DEFAULT_SEARCH_TEXT_PAD4."'}\" /></form>";
					break;
				}
				?>
            </div>
        </div>
    </div>
</div>
<div class="right">
	<?php
	if($logged==1){
		?>
		<div id="logmod">			
			<div class="cell">
			<ul id="ThemeMenu" class="MM">
			  <li id="paint" style="cursor:pointer;"><a class="NOLINK" style="width:10px;"><img src="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/paint.png" width="17" height="18" /></a>
                <script type="text/javascript">
					$('#paint img').hover(function(){
						$(this).attr('src','<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/paint_over.png');
					}, function(){
						$(this).attr('src','<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/paint.png');	
					});
				</script>
				<ul>
				  <li><a>--- Theme Manager ---</a></li>
                  <?php
				  /* GET THE THEMES AVAILABLE */
				  $GET_THEMES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}themes WHERE endrun='avail'");
				  if(mysql_num_rows($GET_THEMES)<1){
					  echo "<li><a>--- no themes available ---</a></li>";
				  } else {
					  while($FETCH_THEMES=mysql_fetch_array($GET_THEMES)){
						  @$themeID=$FETCH_THEMES['id'];
						  if($logged==1){$THEME_CHANGE_FUNCTION="doAction('changeThemeUser','".$username."','".$themeID."');";}else if($logged==0){$THEME_CHANGE_FUNCTION=="doAction('changeThemeTemp','".$username."','themeidto:::');";}
						  echo "<li><a onclick=\"".$THEME_CHANGE_FUNCTION."\">".$FETCH_THEMES['pretty_name']." (".$FETCH_THEMES['type'].")</a></li>";
					  }
				  }
				  ?>
				</ul>
			  </li>
			</ul>
			
			<!-- Please leave at least one new line or white space symbol after the closing </ul>
				 tag of the root ul element of the menu tree. This will allow the browsers to init
				 the menu tree as soon as it is loaded and not wait for the page load event. -->
            
			<ul id="ActionMenu" class="MM">        
			  <li id="gear" style="cursor:pointer;"><a class="NOLINK" style="width:10px;"><img src="<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/gear.png" width="17" height="18" /></a>
                <script type="text/javascript">
					$('#gear img').hover(function(){
						$(this).attr('src','<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/gear_over.png');
					}, function(){
						$(this).attr('src','<?php echo $properties->WEBSITE_URL;?><?php echo $properties->PATH_TO_THEME_ASSETS;?>images/gear.png');	
					});
				</script>
				<ul>
				  <li><a>Logged in as:</a></li>
				  <li><a><?php echo $username;?> [<?php if($head_admin=="yes"){echo "Head Admin";}else{echo $type;}?></a></li>
                  <hr />
				  <li><a href="<?php echo $properties->WEBSITE_URL;?>account">Account Settings</a></li>
				   <?php
					if($head_admin=="yes"){
					?>
						<li><a href="<?php echo $properties->WEBSITE_URL."cp";?>">cPanel</a></li>
					<?php	
					}
					?>
				  <?php if($MODE=="closed" || $MODE=="closed beta"){?><li><a onclick="doAction('leavesite','<?php echo $username;?>','')">Leave Site</a></li><?php }?>
				  <li><a onclick="doAction('logout','<?php echo $username;?>','')">Log Out</a></li>
				</ul>
			  </li>
			</ul>
			
			<!-- Please leave at least one new line or white space symbol after the closing </ul>
				 tag of the root ul element of the menu tree. This will allow the browsers to init
				 the menu tree as soon as it is loaded and not wait for the page load event. -->
			</div>
		</div>
		<?php
	} else {
		/* NOT LOGGED IN */	
		?>
		<div id="logmod">
			<?php
			if(isset($_POST['login'])){
				if(isset($_POST['login'])){
					/* function for login */
					$username=$_POST['uname'];
					$password=$_POST['upass'];
					$ip=$_SERVER['REMOTE_ADDR'];
					
					//check for username in db
					$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
					if(mysql_num_rows($CHECK_USERNAME)<1){
						/* user not there */
						$error_console="<b>{$username}</b> does not exist on our server";
					} else {
						$FETCH_USERNAME=mysql_fetch_array($CHECK_USERNAME);
						$status=$FETCH_USERNAME['status'];
						$suspended_reason=$FETCH_USERNAME['suspended_reason'];
																		
						switch($status){
							case 'active':
								$error_console="";
							break;
							case 'pending':
								$error_console="<b>{$username}</b> is a new user and it currently being reviewed at the moment";
							break;
							case 'deleted':
								$error_console="<b>{$username}</b> does not exist on our server";
							break;
							case 'suspended':
								$error_console="<b>{$username}</b> has been suspended due to <b>{$suspended_reason}</b>";
							break;
							case 'denied':
								$error_console="<b>{$username}</b> does not exist on our server";
							break;
						}
					}
					
					//check the password
					$CHECK_PASSWORD=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
					if(mysql_num_rows($CHECK_PASSWORD)<1){
						/* not a user */
					} else {
						$FETCH_PASSWORD=mysql_fetch_array($CHECK_PASSWORD);
						$db_upass=$FETCH_PASSWORD['upass'];
						if(hash('sha256',md5(sha1($password)))!=$db_upass){
							$error_console="The password you entered does not match with what is on file";
						} else {
							//logged them in
						}
					}
					
					//check if user is logged in
					$CHECK_USERNAME=mysql_query("SELECT * FROM {$properties->DB_PREFIX}users WHERE uname='$username'");
					$FETCH_IP=mysql_fetch_array($CHECK_USERNAME);
					if($FETCH_IP['loggedin']=="yes"){/*USER IS LOGGED IN*/$error_console="<b>{$username}</b> is already logged in. <a onclick=\"window.open('".$properties->WEBSITE_URL."help.php','the_why_of_not_login', 'width=500,height=500')\" style=\"cursor:pointer;\">Why?</a>";}	
					
					//check for blanks
					if($password==""){$error_console="Password is missing";}
					if($username==""){$error_console="Username is missing";}
					
					//check the error console
					if($error_console!=""){
						/* FAILED */
						echo "<span class=\"cell\">".$error_console."</span>";
					} else {
						/* PASSED */
						//make logged session id
						$lsessionid=str_shuffle($ip.rand("000000000000","999999999999"));
						
						//set session cookie that will expire in 20 years (it's ok)
						setcookie($properties->_COOKIE_INIT_SESSION,$lsessionid,(time() + (20 * 365 * 24 * 60 * 60)),"/");
						
						//get dateand time
						//0000-00-00 00:00:00
						$dateandtime=date("Y-m-d H:i:s");															
						
						//update the db
						mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='yes' WHERE uname='$username'");
						mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='$ip' WHERE uname='$username'");
						mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='$lsessionid' WHERE uname='$username'");
						mysql_query("UPDATE {$properties->DB_PREFIX}users SET dateandtime_lastlogin='$dateandtime' WHERE uname='$username'");
						
						echo "<span class=\"cell\">You have been successfully logged in! <a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Reload</a></span>";
					}								
				}
			} else {
			?>
			<div class="cell formLayoutTableRowToolkit">
			   <form action="" method="POST">
				   <input type="text" name="uname" /> <input type="password" name="upass" />
				   <input type="submit" name="login" value="LOGIN" class="submit" />
			   </form>
			</div>
			<?php
			}
			 ?>
		</div>
		<?php
	}
	?>
</div>