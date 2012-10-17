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
                <div id="logmod">
                	<?php
					if(isset($_POST['logoutusername'])){
						//get user
						$username=$_POST['logoutusername'];
						
						if($username==""){$error_console="something went wrong. Username is missing. You must be hacking!";}
						
						//check the error console
						if($error_console!=""){
							/* FAILED */
							echo $error_console;
						} else {
							/* PASSED */												
							//update the db
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET loggedin='no' WHERE uname='$username'");
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET in_site='no' WHERE uname='$username'");
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_ip='' WHERE uname='$username'");
							mysql_query("UPDATE {$properties->DB_PREFIX}users SET logged_session='' WHERE uname='$username'");
																			
							echo "<div class=\"cell\">You have been successfully logged out!&nbsp;&nbsp;&nbsp;<a href=\"".$properties->WEBSITE_URL."\" class=\"white\">Go home</a></div>";
						}
	 			    } else {
					?>
                    <div class="cell">Logged in as <?php echo $username;?> [<?php if($head_admin=="yes"){echo "Head Admin";}else{echo $type;}?>]</div>
                    <?php
					if($head_admin=="yes"){
					?>
                    <div class="cell">
					   <a href="<?php echo $properties->WEBSITE_URL."cp";?>" class="submit">cPanel</a>
                    </div>
                    <?php	
					}
					?>
                    <div class="cell">
					   <form action="" method="POST">
							<input type="hidden" name="logoutusername" value="<?php echo $username;?>" />
							<input type="submit" name="logout" value="LOGOUT" class="submit" />
					   </form>
                    </div>
                    <?php
					}
					 ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="right">
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