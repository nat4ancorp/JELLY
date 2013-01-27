<div id="footer">
    <div class="wrap">
        <div id="foot">
            <?php
            /* FUNCTIONAL TO GET THE FOOTER MODULES */
            ?>
            <div class="left">
                <?php
                @$footer_section="left";
                $GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE type='footer' AND footer_section='".$footer_section."' ORDER BY arr");
                if(mysql_num_rows($GET_MODULES)<1){
                    echo "No modules";
                } else {
                    while($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){
                        $title=$FETCH_MODULES['title'];
                        $toggle_title=$FETCH_MODULES['toggle_title'];
                        $contents=$FETCH_MODULES['contents'];
                        if($toggle_title == "off"){/* no title */}else if($toggle_title == "on"){echo "<h1>".$title."</h1>";}
                        echo eval($contents);
                    }
                }
                ?>
            </div>
            
            <div class="mid">
               <?php
                @$footer_section="mid";
                $GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE type='footer' AND footer_section='".$footer_section."' ORDER BY arr");
                if(mysql_num_rows($GET_MODULES)<1){
                    echo "No modules";
                } else {
                    while($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){
                        $title=$FETCH_MODULES['title'];
                        $toggle_title=$FETCH_MODULES['toggle_title'];
                        $contents=$FETCH_MODULES['contents'];
                        if($toggle_title == "off"){/* no title */}else if($toggle_title == "on"){echo "<h1>".$title."</h1>";}
                        echo eval($contents);
                    }
                }
                ?>
            </div>
            
            <div class="right">   
                <?php
                @$footer_section="right";
                $GET_MODULES=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages_modules WHERE type='footer' AND footer_section='".$footer_section."' ORDER BY arr");
                if(mysql_num_rows($GET_MODULES)<1){
                    echo "No modules";
                } else {
                    while($FETCH_MODULES=mysql_fetch_array($GET_MODULES)){
                        $title=$FETCH_MODULES['title'];
                        $toggle_title=$FETCH_MODULES['toggle_title'];
                        $contents=$FETCH_MODULES['contents'];
                        $toggle_visible=$FETCH_MODULES['toggle_visible'];
                        if($toggle_visible == "off"){/* MODULE TURNED OFF */}else{if($toggle_title == "off"){/* no title */}else if($toggle_title == "on"){echo "<h1>".$title."</h1>";}echo eval($contents);}}
                }
                ?>
            </div>
            <?php
            /* END FUNCTIONAL TO GET THE FOOTER MODULES */
            ?>
            <div id="lower">
            <a href="<?php echo $properties->WEBSITE_URL.$properties->PADMAIN;?>/privacy">Privacy</a>
            &nbsp;
            <a href="<?php echo $properties->WEBSITE_URL.$properties->PADMAIN;?>/disclaimer">Disclaimer</a>
            &nbsp;
            <a href="<?php echo $properties->WEBSITE_URL.$properties->PADMAIN;?>/affiliates">Affiliates</a>
            &nbsp;
            &copy; 2012. <a href="<?php echo $properties->getFULLWURL();?>"><?php echo $properties->displayCName();?></a>
            &nbsp;
            Nathan Smyth. Freelance Web Designer. San Antonio, TX Area. (210) 863 8843
            Powered by <a href="http://www.witll.net" target="_blank">WITLL</a> Ver. <?php echo $properties->VERSION_CTRL;?>
            </div> <!-- end of #lower -->
         </div> <!-- end of #foot -->
     </div> <!-- end of .wrap -->
</div> <!-- end of #footer -->