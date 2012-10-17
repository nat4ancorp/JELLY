<div class="wrap">
    <?php
    if($properties->TURN_ON_TOP_NAV=="yes"){
    ?>
    <div id="topnavigation">
        <div id="topnav">
            <?php
			if(getGlobalVars($properties,'top_nav_use') == "toolkit"){
			
				include("includes/private/modules/toolkit.php");
				
			} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/ search"){
			
				include("includes/private/modules/topnavwithsearch.php");
			
			} else if(getGlobalVars($properties,'top_nav_use') == "top navigation w/o search"){
				
				include("includes/private/modules/topnavwithoutsearch.php");
			}
			?>
        </div>
    </div> <!-- end top navigation -->
    <?php
    } else if($properties->TURN_ON_TOP_NAV=="no") {
        /* NO TOP NAV */	
    }
    ?>
</div>

<div id="container-header">
<div id="header">
        <div id="header-row">
            <div id="header-leftcol-<?php echo $launchpadID;?><?php if($page=="home"){?>-selected<?php }?>" onclick="window.location.href='<?php echo $properties->displayWURL();?><?php echo $launchpad;?>/home'">
                <div id="<?php if($properties->MAIN_TITLE_ALIGN == "l"){?>left<?php }else if($properties->MAIN_TITLE_ALIGN == "c"){?>center<?php }else if($properties->MAIN_TITLE_ALIGN == "r"){?>right<?php } ?>">
                    <div class="big"><?php echo $properties->displayMainTitle();?></div>
                    <?php if($launchpad == $properties->PADMAIN){echo $properties->displayMainSlogan($properties,$launchpad,'main');}else{echo $properties->displayMainSlogan($properties,$launchpad,'extra');}?> 
                </div> <!-- end of #left -->
            </div> <!-- end of #header-leftcol -->
                           
            <div id="header-rightcol">
                <div id="navigation">
                    <div id="nav-row">
                        <?php
                            /* PHP NAVIGATIN LIST MAKER FROM CLASS */
                            $wurl=$properties->getWURL();
                            //determine launchpad constants
                            $launchpadNAME=$launchpad;
                            $launchpadID=GET_LP_ID($properties,$launchpad);
                            echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
                        ?>
                    </div><!-- end of nav-row -->
                </div> <!-- end of #navigation -->      
            </div>
        </div> <!-- end of #header-row -->
    </div> <!-- end of #header -->
</div>

<div id="container">
    
    <?php 
    //check to see if feature is toggled
    $CHECK_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
    $FETCH_FEAT=mysql_fetch_array($CHECK_FEAT);
    @$toggle=$FETCH_FEAT['toggle_feat'];
    if($toggle == "on"){
    ?>
        <div id="featured-works">
            <div id="inner">            	
                Coming soon! A jQuery-Animated Slider to Showcase new and popular additions to this website!
            </div>
        </div>
    <?php
    }
    ?>
    
    <?php
    //check to see if mini feature is toggled
    $CHECK_MINI_FEAT=mysql_query("SELECT * FROM {$properties->DB_PREFIX}pages WHERE lp='$launchpadPN' AND page='$page'"); 
    $FETCH_MINI_FEAT=mysql_fetch_array($CHECK_MINI_FEAT);
    @$toggle=$FETCH_MINI_FEAT['toggle_minifeat'];
    if($toggle == "on"){
        ?>			
        <div id="mini-featured-works">
            <div id="inner">            	
            This is to create perspective to the pages by adding a neat little animation jQuery thingy...
            </div>
        </div>
        <?php
    }
    ?>
    
    <!--<form action="search" method="POST"><input type="search" value="Search" onfocus="if(this.value==\'Search\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\'Search\';}" class="searchClass" /></form>--> 
    <!-- start of PAGE CONTENTS -->
        <?php getPageContents($launchpadID,$page,$subpage,$properties->WEBSITE_URL,$launchpadPN,$properties); ?>
    <!-- end of PAGE CONTENTS --> 
            
</div> <!-- end of #container -->

<?php
include("includes/private/art/lower_left.php");
?>
 
<?php
include("includes/private/art/lower_right.php");
?>

<?php
if(($properties->TURN_ON_BOTTOM_NAV=="yes") && ($launchpad == $properties->PAD3)){
?>
<div id="bottomnavigation">
    <div class="wrap-bottom">
        <div id="bottomnav">
            <div class="left">
                <ul>
                <?php
                /* PHP BOTTOM NAVIGATIN LIST MAKER FROM CLASS */
                $wurl=$properties->getWURL();
                //determine launchpad constants
                $launchpadNAME=$launchpad;
                $launchpadID=GET_LP_ID($properties,$launchpad);
                echo bottomnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
                ?>
                </ul>
            </div><!-- end of #left --> 
        </div> <!-- end of #bottomnav --> 
    </div> <!-- end of .wrap -->
</div><!-- end of #bottomnavigation -->
<?php
} else if($properties->TURN_ON_BOTTOM_NAV == "no") {
    /* LEAVE BOTTOM NAV OFF */
}
?>

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
            copyright &copy; 2012. <a href="<?php echo $properties->getFULLWURL();?>"><?php echo $properties->displayCName();?></a>
            &nbsp;
            Nathan Smyth. Freelance Web Designer. San Antonio, TX Area. (210) 863 8843
            </div> <!-- end of #lower -->
         </div> <!-- end of #foot -->
     </div> <!-- end of .wrap -->
 </div> <!-- end of #footer -->