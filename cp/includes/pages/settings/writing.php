<h1>Writing Settings</h1>
<?php
if(isset($_POST['save'])){
	/* SITE UPDATES */
	/* STEP 1: GET ALL DATA */
	$data_uploader_type=mysql_real_escape_string($_POST['uploader_type']);
	
	$data_pages_af_atoz_entries_in_sets_of=mysql_real_escape_string($_POST['pages_af_atoz_entries_in_sets_of']);
	$data_pages_af_atoz_entries_limit=mysql_real_escape_string($_POST['pages_af_atoz_entries_limit']);
	$data_pages_af_atoz_time_format=mysql_real_escape_string($_POST['pages_af_atoz_time_format']);
	$data_pages_af_atoz_show_seconds=mysql_real_escape_string($_POST['pages_af_atoz_show_seconds']);
	$data_pages_af_atoz_show_tod=mysql_real_escape_string($_POST['pages_af_atoz_show_tod']);
	
	$data_pages_af_watchlist_entries_in_sets_of=mysql_real_escape_string($_POST['pages_af_watchlist_entries_in_sets_of']);
	$data_pages_af_watchlist_entries_limit=mysql_real_escape_string($_POST['pages_af_watchlist_entries_limit']);
	$data_html_in_comments=mysql_real_escape_string($_POST['html_in_comments']);
	$data_N_TAGs_in_comments=mysql_real_escape_string($_POST['N_TAGs_in_comments']);
	$data_blog_entries_in_sets_of=mysql_real_escape_string($_POST['blog_entries_in_sets_of']);
	
	$data_blog_entries_limit=mysql_real_escape_string($_POST['blog_entries_limit']);
	$data_blog_time_format=mysql_real_escape_string($_POST['blog_time_format']);
	$data_post_action_for_comments=mysql_real_escape_string($_POST['post_action_for_comments']);
	$data_blog_show_seconds=mysql_real_escape_string($_POST['blog_show_seconds']);
	$data_blog_show_tod=mysql_real_escape_string($_POST['blog_show_tod']);
	
	$data_tod_case=mysql_real_escape_string($_POST['tod_case']);
	$data_work_rotator_theme=mysql_real_escape_string($_POST['work_rotator_theme']);
	$data_work_jcarousel_scrollamt=mysql_real_escape_string($_POST['work_jcarousel_scrollamt']);
	$data_work_jcarousel_auto=mysql_real_escape_string($_POST['work_jcarousel_auto']);
	$data_work_jcarousel_wrap=mysql_real_escape_string($_POST['work_jcarousel_wrap']);
	
	$data_posts_pad=mysql_real_escape_string($_POST['posts_pad']);
	$data_posts_page=mysql_real_escape_string($_POST['posts_page']);
	$data_posts_list=mysql_real_escape_string($_POST['posts_list']);
	$data_posts_defaults=mysql_real_escape_string($_POST['posts_defaults']);
	$data_posts_sublist=mysql_real_escape_string($_POST['posts_sublist']);
	$data_posts_names=mysql_real_escape_string($_POST['posts_names']);
	$data_posts_special=mysql_real_escape_string($_POST['posts_special']);
	$data_posts_special_item=mysql_real_escape_string($_POST['posts_special_item']);
	$data_posts_default_order=mysql_real_escape_string($_POST['posts_default_order']);
	
	$data_pages_pad=mysql_real_escape_string($_POST['pages_pad']);
	$data_pages_page=mysql_real_escape_string($_POST['pages_page']);
	$data_pages_list=mysql_real_escape_string($_POST['pages_list']);
	$data_pages_defaults=mysql_real_escape_string($_POST['pages_defaults']);
	$data_pages_sublist=mysql_real_escape_string($_POST['pages_sublist']);
	$data_pages_names=mysql_real_escape_string($_POST['pages_names']);
	$data_pages_special=mysql_real_escape_string($_POST['pages_special']);
	$data_pages_special_item=mysql_real_escape_string($_POST['pages_special_item']);
	$data_pages_default_order=mysql_real_escape_string($_POST['pages_default_order']);
	
	$data_pages_modules_pad=mysql_real_escape_string($_POST['pages_modules_pad']);
	$data_pages_modules_page=mysql_real_escape_string($_POST['pages_modules_page']);
	$data_pages_modules_list=mysql_real_escape_string($_POST['pages_modules_list']);
	$data_pages_modules_defaults=mysql_real_escape_string($_POST['pages_modules_defaults']);
	$data_pages_modules_sublist=mysql_real_escape_string($_POST['pages_modules_sublist']);
	$data_pages_modules_names=mysql_real_escape_string($_POST['pages_modules_names']);
	$data_pages_modules_special=mysql_real_escape_string($_POST['pages_modules_special']);
	$data_pages_modules_special_item=mysql_real_escape_string($_POST['pages_modules_special_item']);
	$data_pages_modules_default_order=mysql_real_escape_string($_POST['pages_modules_default_order']);
	
	$data_comments_pad=mysql_real_escape_string($_POST['comments_pad']);
	$data_comments_page=mysql_real_escape_string($_POST['comments_page']);
	$data_comments_list=mysql_real_escape_string($_POST['comments_list']);
	$data_comments_defaults=mysql_real_escape_string($_POST['comments_defaults']);
	$data_comments_sublist=mysql_real_escape_string($_POST['comments_sublist']);
	$data_comments_names=mysql_real_escape_string($_POST['comments_names']);
	$data_comments_special=mysql_real_escape_string($_POST['comments_special']);
	$data_comments_special_item=mysql_real_escape_string($_POST['comments_special_item']);
	$data_comments_default_order=mysql_real_escape_string($_POST['comments_default_order']);
	
	$data_queries_pad=mysql_real_escape_string($_POST['queries_pad']);
	$data_queries_page=mysql_real_escape_string($_POST['queries_page']);
	$data_queries_list=mysql_real_escape_string($_POST['queries_list']);
	$data_queries_defaults=mysql_real_escape_string($_POST['queries_defaults']);
	$data_queries_sublist=mysql_real_escape_string($_POST['queries_sublist']);
	$data_queries_names=mysql_real_escape_string($_POST['queries_names']);
	$data_queries_special=mysql_real_escape_string($_POST['queries_special']);
	$data_queries_special_item=mysql_real_escape_string($_POST['queries_special_item']);
	$data_queries_default_order=mysql_real_escape_string($_POST['queries_default_order']);
	$data_queries_poctable=mysql_real_escape_string($_POST['queries_poctable']);
	$data_queries_reasontable=mysql_real_escape_string($_POST['queries_reasontable']);
	
	/* STEP 2: CHECK DATA FOR ACCURACY */
	//if($data_ == ""){$error_console.="<br />";}
	
	if($error_console != "") {
		/* THERE IS AN ERROR */	
		echo $error_console;
	} else {
		/* STEP 3: POST TO DATABASE */
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET uploader_type = '$data_uploader_type'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_af_atoz_entries_in_sets_of = '$data_pages_af_atoz_entries_in_sets_of'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_af_atoz_entries_limit = '$data_pages_af_atoz_entries_limit'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_af_atoz_time_format = '$data_pages_af_atoz_time_format'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_af_atoz_show_seconds = '$data_pages_af_atoz_show_seconds'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_af_atoz_show_tod = '$data_pages_af_atoz_show_tod'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_af_watchlist_entries_in_sets_of = '$data_pages_af_watchlist_entries_in_sets_of'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_af_watchlist_entries_limit = '$data_pages_af_watchlist_entries_limit'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET html_in_comments = '$data_html_in_comments'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET N_TAGs_in_comments = '$data_N_TAGs_in_comments'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET blog_entries_in_sets_of = '$data_blog_entries_in_sets_of'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET changelog_entries_in_sets_of = '$data_blog_entries_in_sets_of'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET blog_entries_limit = '$data_blog_entries_limit'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET changelog_entries_limit = '$data_blog_entries_limit'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET blog_time_format = '$data_blog_time_format'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET post_action_for_comments = '$data_post_action_for_comments'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET blog_show_seconds = '$data_blog_show_seconds'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET blog_show_tod = '$data_blog_show_tod'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET tod_case = '$data_tod_case'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET work_rotator_theme = '$data_work_rotator_theme'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET work_jcarousel_scrollamt = '$data_work_jcarousel_scrollamt'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET work_jcarousel_auto = '$data_work_jcarousel_auto'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET work_jcarousel_wrap = '$data_work_jcarousel_wrap'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_pad = '$data_posts_pad'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_page = '$data_posts_page'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_list = '$data_posts_list'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_defaults = '$data_posts_defaults'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_sublist = '$data_posts_sublist'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_names = '$data_posts_names'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_special = '$data_posts_special'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_special_item = '$data_posts_special_item'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET posts_default_order = '$data_posts_default_order'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_pad = '$data_pages_pad'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_page = '$data_pages_page'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_list = '$data_pages_list'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_defaults = '$data_pages_defaults'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_sublist = '$data_pages_sublist'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_names = '$data_pages_names'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_special = '$data_pages_special'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_special_item = '$data_pages_special_item'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_default_order = '$data_pages_default_order'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_pad = '$data_pages_modules_pad'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_page = '$data_pages_modules_page'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_list = '$data_pages_modules_list'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_defaults = '$data_pages_modules_defaults'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_sublist = '$data_pages_modules_sublist'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_names = '$data_pages_modules_names'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_special = '$data_pages_modules_special'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_special_item = '$data_pages_modules_special_item'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET pages_modules_default_order = '$data_pages_modules_default_order'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_pad = '$data_comments_pad'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_page = '$data_comments_page'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_list = '$data_comments_list'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_defaults = '$data_comments_defaults'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_sublist = '$data_comments_sublist'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_names = '$data_comments_names'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_special = '$data_comments_special'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_special_item = '$data_comments_special_item'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET comments_default_order = '$data_comments_default_order'");
		
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_pad = '$data_queries_pad'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_page = '$data_queries_page'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_list = '$data_queries_list'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_defaults = '$data_queries_defaults'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_sublist = '$data_queries_sublist'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_names = '$data_queries_names'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_special = '$data_queries_special'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_special_item = '$data_queries_special_item'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_default_order = '$data_queries_default_order'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_poctable = '$data_queries_poctable'");
		mysql_query("UPDATE {$properties->DB_PREFIX}globalvars SET queries_reasontable = '$data_queries_reasontable'");
				
		/* STEP 4: RETURN SUCCESS */
		echo "Successfully saved! <a href=\"?menu=settings&page=writing\">Refresh</a>";
	}
} else {
	?>
    <form action="" method="post">
        <fieldset>
        <legend>Global Variables</legend>
       		<fieldset>
            <legend>General Properties</legend>
            <div class="formLayoutTableMainAll">                                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                       Uploader Type
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="uploader_type">
                        	<?php if(getGlobalVars($properties,'uploader_type')=="simple"){?><option value="simple" selected="selected" disabled="disabled">Simple</option><?php } else {?><option value="simple" disabled="disabled">Simple</option><?php }?>
                            <?php if(getGlobalVars($properties,'uploader_type')=="flashy"){?><option value="flashy" selected="selected">Flashy</option><?php } else {?><option value="flashy">Flashy</option><?php }?>
                            <?php if(getGlobalVars($properties,'uploader_type')=="flashy-enhanced"){?><option value="flashy-enhanced" selected="selected">Flashy Enhanced</option><?php } else {?><option value="flashy-enhanced">Flashy Enhanced</option><?php }?>
                        </select>
                        <br />
                        * This is the type of file uploader that you are going to be using, this may help you:
                        <ul>
                        	<li><b>Simple</b> - a simple HTML based uploader with no flashiness :( (un-secure).</li>
                            <li><b>Flashy</b> - a Flashy uploader that won't file scan for files, perfect for those just wanting simple upload yet don't want to keep track of files.</li>
                            <li><b>Flashy Enhanced</b> - Everything that is Flashy but with a file directory keeper or scanner that scans for files. Perfect for those wanting to keep track of files per post. At the moment there is a bug that prevents the uploader/scanner from dumping to the nested folder structure so everything will end up in one place. 2/13/13. Now, with the help of a coder friend, Thomas Ibarra, the dumping to folder structure works but there is one small bug - when you click off the modal popup and then open up the browser it doesn't display the files in the structure. 2/22/13.</li>
                        </ul>
                    </div>
                </div>                            
            </div>
            </fieldset>
            <br />
            <fieldset>
            <legend>Anime Fanatic (AF) Properties</legend>
            <div class="formLayoutTableMainAll">                                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        A to Z Entries In Sets Of
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="pages_af_atoz_entries_in_sets_of" value="<?php echo getGlobalVars($properties,'pages_af_atoz_entries_in_sets_of');?>" min="1" max="10" onchange="if(this.value>5){this.value=10;}if(this.value<1){this.value=1;}" /> * This is the how many pagination links to display before the "..." (Eg. output for 5: &lt; 1, 2, 3, 4, 5 ...)
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        A to Z Entries Limit
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="pages_af_atoz_entries_limit" value="<?php echo getGlobalVars($properties,'pages_af_atoz_entries_limit');?>" min="1" max="10" onchange="if(this.value>5){this.value=10;}if(this.value<1){this.value=1;}" /> * how many entries to display per pagination page
                    </div>
                </div>
                                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        A to Z Entry Timestamp Format
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="pages_af_atoz_time_format">
                            <?php if(getGlobalVars($properties,'pages_af_atoz_time_format')=="12h"){?><option value="12h" selected="selected">12 Hour</option><?php } else {?><option value="12h">12 Hour</option><?php }?>
                            <?php if(getGlobalVars($properties,'pages_af_atoz_time_format')=="24h"){?><option value="24h" selected="selected">24 Hour</option><?php } else {?><option value="24h">24 Hour</option><?php }?>
                        </select>
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Show seconds on Entry Timestamp?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="pages_af_atoz_show_seconds" value="Yes" <?php if(getGlobalVars($properties,'pages_af_atoz_show_seconds') == "Yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="pages_af_atoz_show_seconds" value="No" <?php if(getGlobalVars($properties,'pages_af_atoz_show_seconds') == "No"){?>checked="checked"<?php }?> class="radio" /> No
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Show Time of Day (am/pm) on Entry Timestamp?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="pages_af_atoz_show_tod" value="Yes" <?php if(getGlobalVars($properties,'pages_af_atoz_show_tod') == "Yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="pages_af_atoz_show_tod" value="No" <?php if(getGlobalVars($properties,'pages_af_atoz_show_tod') == "No"){?>checked="checked"<?php }?> class="radio" /> No
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Watchlist Entries In Sets Of
                    </div>

                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="pages_af_watchlist_entries_in_sets_of" value="<?php echo getGlobalVars($properties,'pages_af_watchlist_entries_in_sets_of');?>" min="1" max="10" onchange="if(this.value>5){this.value=10;}if(this.value<1){this.value=1;}" /> * This is the how many pagination links to display before the "..." (Eg. output for 5: &lt; 1, 2, 3, 4, 5 ...)
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Watchlist Entries Limit
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="pages_af_watchlist_entries_limit" value="<?php echo getGlobalVars($properties,'pages_af_watchlist_entries_limit');?>" min="1" max="10" onchange="if(this.value>5){this.value=10;}if(this.value<1){this.value=1;}" /> * how many entries to display per pagination page
                    </div>
                </div>                
            </div>
            </fieldset>
            <br />
        	<fieldset>
            <legend>Blog Properties</legend>
            <div class="formLayoutTableMainAll">
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Allow HTML in Comments?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="html_in_comments" value="yes" <?php if(getGlobalVars($properties,'html_in_comments') == "yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="html_in_comments" value="no" <?php if(getGlobalVars($properties,'html_in_comments') == "no"){?>checked="checked"<?php }?> class="radio" /> No
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Allow N_TAGs in Comments?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="N_TAGs_in_comments" value="yes" <?php if(getGlobalVars($properties,'N_TAGs_in_comments') == "yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="N_TAGs_in_comments" value="no" <?php if(getGlobalVars($properties,'N_TAGs_in_comments') == "no"){?>checked="checked"<?php }?> class="radio" /> No
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Blog Entries In Sets Of
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="blog_entries_in_sets_of" value="<?php echo getGlobalVars($properties,'blog_entries_in_sets_of');?>" min="1" max="10" onchange="if(this.value>5){this.value=5;}if(this.value<1){this.value=1;}" /> * This is the how many pagination links to display before the "..." (Eg. output for 5: &lt; 1, 2, 3, 4, 5 ...)
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Blog Entries Limit
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="blog_entries_limit" value="<?php echo getGlobalVars($properties,'blog_entries_limit');?>" min="1" max="10" onchange="if(this.value>5){this.value=5;}if(this.value<1){this.value=1;}" /> * how many entries to display per pagination page
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Blog Entry Timestamp Format
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="blog_time_format">
                            <?php if(getGlobalVars($properties,'blog_time_format')=="12h"){?><option value="12h" selected="selected">12 Hour</option><?php } else {?><option value="12h">12 Hour</option><?php }?>
                            <?php if(getGlobalVars($properties,'blog_time_format')=="24h"){?><option value="24h" selected="selected">24 Hour</option><?php } else {?><option value="24h">24 Hour</option><?php }?>
                        </select>
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Post Action for Comments
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="post_action_for_comments">
                            <?php if(getGlobalVars($properties,'post_action_for_comments')=="Approved Immediately"){?><option value="Approved Immediately" selected="selected">Approved Immediately</option><?php } else {?><option value="Approved Immediately">Approved Immediately</option><?php }?>
                            <?php if(getGlobalVars($properties,'post_action_for_comments')=="Subject to Approval"){?><option value="Subject to Approval" selected="selected">Subject to Approval</option><?php } else {?><option value="Subject to Approval">Subject to Approval</option><?php }?>
                            <?php if(getGlobalVars($properties,'post_action_for_comments')=="Approved after 24 hours"){?><option value="Approved after 24 hours" selected="selected">Approved after 24 hours</option><?php } else {?><option value="Approved after 24 hours">Approved after 24 hours</option><?php }?>
                        </select>
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Show seconds on Entry Timestamp?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="blog_show_seconds" value="Yes" <?php if(getGlobalVars($properties,'blog_show_seconds') == "Yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="blog_show_seconds" value="No" <?php if(getGlobalVars($properties,'blog_show_seconds') == "No"){?>checked="checked"<?php }?> class="radio" /> No
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Show Time of Day (am/pm) on Entry Timestamp?
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="radio" name="blog_show_tod" value="Yes" <?php if(getGlobalVars($properties,'blog_show_tod') == "Yes"){?>checked="checked"<?php }?> class="radio" /> Yes <input type="radio" name="blog_show_tod" value="No" <?php if(getGlobalVars($properties,'blog_show_tod') == "No"){?>checked="checked"<?php }?> class="radio" /> No
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Time of Day Case (UU/ll)
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="tod_case">
                            <?php if(getGlobalVars($properties,'tod_case') == "U"){?><option value="U" selected="selected">Uppercase</option><?php } else {?><option value="U">Uppercase</option><?php }?>
                            <?php if(getGlobalVars($properties,'tod_case') == "L"){?><option value="L" selected="selected">Lowercase</option><?php } else {?><option value="L">Lowercase</option><?php }?>
                        </select>
                    </div>
                </div>
            </div>
            </fieldset>
            <br />
            <fieldset>
            <legend>Work Properties</legend>
            <div class="formLayoutTableMainAll">
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Rotator Theme
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="work_rotator_theme">
                            <?php
                            /* GET THE JC THEMES */
                            $GET_JC_SKINS=mysql_query("SELECT * FROM {$properties->DB_PREFIX}jc_themes WHERE status='active' ORDER BY name");
                            if(mysql_num_rows($GET_JC_SKINS)<1){
                                /* NO SKINS */
                                ?>
                                <option value="">No Skins</option>
                                <?php
                            } else {
                                while($FETCH_JC_SKINS=mysql_fetch_array($GET_JC_SKINS)){
                                    if($FETCH_JC_SKINS['id'] == getGlobalVars($properties,'work_rotator_theme')){
                                        ?>
                                        <option value="<?php echo $FETCH_JC_SKINS['id'];?>" selected="selected"><?php echo $FETCH_JC_SKINS['name'];?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $FETCH_JC_SKINS['id'];?>"><?php echo $FETCH_JC_SKINS['name'];?></option>
                                        <?php	
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                    
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Rotator Scroll Amount
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="work_jcarousel_scrollamt" value="<?php echo getGlobalVars($properties,'work_jcarousel_scrollamt');?>" min="1" max="5" onchange="if(this.value>5){this.value=5;}if(this.value<1){this.value=1;}" />
                    </div>
                </div>
                    
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Rotator Wait Time (auto)
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <input type="number" name="work_jcarousel_auto" value="<?php echo getGlobalVars($properties,'work_jcarousel_auto');?>" min="1" max="10" onchange="if(this.value>5){this.value=10;}if(this.value<1){this.value=1;}" />
                    </div>
                </div>
                    
                <div class="formLayoutTableRowMainAll">
                    <div class="formLayoutTableRowMainAllLeftCol">
                        Rotator Wrap
                    </div>
                    <div class="formLayoutTableRowMainAllRightCol">
                        <select name="work_jcarousel_wrap">
                            <?php if(getGlobalVars($properties,'work_jcarousel_wrap') == "first"){?><option value="first" selected="selected">First</option><?php } else {?><option value="first">First</option><?php }?>
                            <?php if(getGlobalVars($properties,'work_jcarousel_wrap') == "last"){?><option value="last" selected="selected">Last</option><?php } else {?><option value="last">Last</option><?php }?>
                            <?php if(getGlobalVars($properties,'work_jcarousel_wrap') == "both"){?><option value="both" selected="selected">Both</option><?php } else {?><option value="both">Both</option><?php }?>
                            <?php if(getGlobalVars($properties,'work_jcarousel_wrap') == "circular"){?><option value="circular" selected="selected">Circular</option><?php } else {?><option value="circular">Circular</option><?php }?>
                        </select>
                    </div>                    
                </div>
            </div>
            </fieldset>
            <br />
            <fieldset>
            <a name="pps"></a>
            <legend>Posting Properties</legend>
            <p>These are specifically designed to moderate the Posts section on this cPanel. The content found in each of them are items that the posts section loads and allows you to edit/view/delete/whatever. Make sure to separate each item with a comma and follow the end with a trailing comma.</p>
            <div class="formLayoutTableMainAllLong">
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Pad(s) *the pad name the post is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_pad" value="<?php echo getGlobalVars($properties,'posts_pad');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Page(s) *the page name itself the post is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_page" value="<?php echo getGlobalVars($properties,'posts_page');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        List(s) *the name of the table after the prefix you set
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_list" value="<?php echo getGlobalVars($properties,'posts_list');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default(s) *no - the display of the item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_defaults" value="<?php echo getGlobalVars($properties,'posts_defaults');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Sublist(s) *this is the part after the _ in the table name
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_sublist" value="<?php echo getGlobalVars($properties,'posts_sublist');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Name(s) *name of the post item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_names" value="<?php echo getGlobalVars($properties,'posts_names');?>" />
                    </div>
                </div>
                
                 <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) *If the table has a different ORDER then set to "1"; else set it to "0"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_special" value="<?php echo getGlobalVars($properties,'posts_special');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) Item(s) *If you set the above to "1": specify the ORDER; else set it to "none"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_special_item" value="<?php echo getGlobalVars($properties,'posts_special_item');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default Order *the order of the tables
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="posts_default_order" value="<?php echo getGlobalVars($properties,'posts_default_order');?>" />
                    </div>
                </div>               
            </div>
            </fieldset>
            <br />
            <fieldset>
            <a name="pcp"></a>
            <legend>Page Creation Properties</legend>
            <p>These are specifically designed to moderate the Pages section on this cPanel. The content found in each of them are items that the pages section loads and allows you to edit/view/delete/whatever. Make sure to separate each item with a comma and follow the end with a trailing comma.</p>
            <div class="formLayoutTableMainAllLong">
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Pad(s) *the pad name the page is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_pad" value="<?php echo getGlobalVars($properties,'pages_pad');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Page(s) *the page name itself the page is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_page" value="<?php echo getGlobalVars($properties,'pages_page');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        List(s) *the name of the table after the prefix you set
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_list" value="<?php echo getGlobalVars($properties,'pages_list');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default(s) *no - the display of the item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_defaults" value="<?php echo getGlobalVars($properties,'pages_defaults');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Sublist(s) *this is the part after the _ in the table name
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_sublist" value="<?php echo getGlobalVars($properties,'pages_sublist');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Name(s) *name of the page item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_names" value="<?php echo getGlobalVars($properties,'pages_names');?>" />
                    </div>
                </div>
                
                 <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) *If the table has a different ORDER then set to "1"; else set it to "0"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_special" value="<?php echo getGlobalVars($properties,'pages_special');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) Item(s) *If you set the above to "1": specify the ORDER; else set it to "none"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_special_item" value="<?php echo getGlobalVars($properties,'pages_special_item');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default Order *the order of the tables
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_default_order" value="<?php echo getGlobalVars($properties,'pages_default_order');?>" />
                    </div>
                </div>               
            </div>
            </fieldset>
            <br />
            <fieldset>
            <a name="pmp"></a>
            <legend>Page Modules Creatin Properties</legend>
            <p>These are specifically designed to moderate the Page Modules section on this cPanel. The content found in each of them are items that the page modules section loads and allows you to edit/view/delete/whatever. Make sure to separate each item with a comma and follow the end with a trailing comma.</p>
            <div class="formLayoutTableMainAllLong">
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Pad(s) *the pad name the page is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_pad" value="<?php echo getGlobalVars($properties,'pages_modules_pad');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Page(s) *the page name itself the page is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_page" value="<?php echo getGlobalVars($properties,'pages_modules_page');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        List(s) *the name of the table after the prefix you set
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_list" value="<?php echo getGlobalVars($properties,'pages_modules_list');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default(s) *no - the display of the item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_defaults" value="<?php echo getGlobalVars($properties,'pages_modules_defaults');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Sublist(s) *this is the part after the _ in the table name
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_sublist" value="<?php echo getGlobalVars($properties,'pages_modules_sublist');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Name(s) *name of the page item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_names" value="<?php echo getGlobalVars($properties,'pages_modules_names');?>" />
                    </div>
                </div>
                
                 <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) *If the table has a different ORDER then set to "1"; else set it to "0"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_special" value="<?php echo getGlobalVars($properties,'pages_modules_special');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) Item(s) *If you set the above to "1": specify the ORDER; else set it to "none"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_special_item" value="<?php echo getGlobalVars($properties,'pages_modules_special_item');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default Order *the order of the tables
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="pages_modules_default_order" value="<?php echo getGlobalVars($properties,'pages_modules_default_order');?>" />
                    </div>
                </div>               
            </div>
            </fieldset>
            <br />
            <fieldset>
            <a name="cs"></a>
            <legend>Comments Properties</legend>
            <p>These are specifically designed to moderate the Comments section on this cPanel. The content found in each of them are items that the comments section loads and allows you to edit/view/delete/whatever. Make sure to separate each item with a comma and follow the end with a trailing comma.</p>
            <div class="formLayoutTableMainAllLong">
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Pad(s) *the pad name the comment is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_pad" value="<?php echo getGlobalVars($properties,'comments_pad');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Page(s) *the page name itself the comment is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_page" value="<?php echo getGlobalVars($properties,'comments_page');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        List(s) *the name of the table after the prefix you set
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_list" value="<?php echo getGlobalVars($properties,'comments_list');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default(s) *no - the display of the item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_defaults" value="<?php echo getGlobalVars($properties,'comments_defaults');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Sublist(s) *this is the part after the _ in the table name
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_sublist" value="<?php echo getGlobalVars($properties,'comments_sublist');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Name(s) *name of the comment item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_names" value="<?php echo getGlobalVars($properties,'comments_names');?>" />
                    </div>
                </div>
                
                 <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) *If the table has a different ORDER then set to "1"; else set it to "0"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_special" value="<?php echo getGlobalVars($properties,'comments_special');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) Item(s) *If you set the above to "1": specify the ORDER; else set it to "none"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_special_item" value="<?php echo getGlobalVars($properties,'comments_special_item');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default Order *the order of the tables
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="comments_default_order" value="<?php echo getGlobalVars($properties,'comments_default_order');?>" />
                    </div>
                </div>               
            </div>
            </fieldset>        
            <br />
            <fieldset>
            <a name="pps"></a>
            <legend>Queries Properties</legend>
            <p>These are specifically designed to moderate the Queries section on this cPanel. The content found in each of them are items that the comments section loads and allows you to edit/view/delete/whatever. Make sure to separate each item with a comma and follow the end with a trailing comma.</p>
            <div class="formLayoutTableMainAllLong">
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Pad(s) *the pad name the comment is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_pad" value="<?php echo getGlobalVars($properties,'queries_pad');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Page(s) *the page name itself the comment is on
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_page" value="<?php echo getGlobalVars($properties,'queries_page');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        List(s) *the name of the table after the prefix you set
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_list" value="<?php echo getGlobalVars($properties,'queries_list');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default(s) *no - the display of the item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_defaults" value="<?php echo getGlobalVars($properties,'queries_defaults');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Sublist(s) *this is the part after the _ in the table name
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_sublist" value="<?php echo getGlobalVars($properties,'queries_sublist');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Name(s) *name of the comment item
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_names" value="<?php echo getGlobalVars($properties,'queries_names');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) *If the table has a different ORDER then set to "1"; else set it to "0"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_special" value="<?php echo getGlobalVars($properties,'queries_special');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Special(s) Item(s) *If you set the above to "1": specify the ORDER; else set it to "none"
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_special_item" value="<?php echo getGlobalVars($properties,'queries_special_item');?>" />
                    </div>
                </div>
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Default Order *the order of the tables
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_default_order" value="<?php echo getGlobalVars($properties,'queries_default_order');?>" />
                    </div>
                </div>       
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        POC Table(s) *what table name to look for pocs
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_poctable" value="<?php echo getGlobalVars($properties,'queries_poctable');?>" />
                    </div>
                </div>       
                
                <div class="formLayoutTableRowMainAllLong">
                    <div class="formLayoutTableRowMainAllLongLeftCol">
                        Reason Table(s) *what table name to look for reasons
                    </div>
                    <div class="formLayoutTableRowMainAllLongRightCol">
                        <input type="text" name="queries_reasontable" value="<?php echo getGlobalVars($properties,'queries_reasontable');?>" />
                    </div>
                </div>               
            </div>
            </fieldset>           
		</fieldset>   
		</fieldset>
    <br />
    <center><input type="submit" name="save" value="Save" /></center>
    <br />
	</form>
	<?php
}
?>