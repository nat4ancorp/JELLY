<div id="container2">
    <div id="container1">
    <?php
    $GET_PAGE=mysql_query("SELECT * FROM h_pages WHERE lp='$launchpadPN' AND page='$page'");
    $GET_SUBPAGE=mysql_query("SELECT * FROM h_pages WHERE lp='$launchpadPN' AND subpage='$subpage'");
        if((mysql_num_rows($GET_PAGE)<1) || (mysql_num_rows($GET_SUBPAGE)<1)){
            echo "An Error Occurred!";
        } else {
            if(mysql_num_rows($GET_PAGE)>0){
                //PAGE
                while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
                    //pull from db
                    $created=$FETCH_PAGE['created'];
                    $content_main=$FETCH_PAGE['content_main'];
                    $content_main_code=$FETCH_PAGE['content_main_code'];
                    $content_main_after_code=$FETCH_PAGE['content_main_after_code'];
    
                    $content_sidebar=$FETCH_PAGE['content_sidebar'];
                    $content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
                    $content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
                    //building the page
                    ?>
                    <div id="col1">
                    <!-- Column one start -->
                    <?php 
                    echo $properties->PROPS_VAR_BODYSB_WRAP_START;
                    echo $content_main;
                    echo eval($content_main_code);
                    echo $content_main_after_code . "<br />";
                    echo $properties->PROPS_VAR_BODYSB_WRAP_END;
                    ?>
                    <!-- Column one end -->
                    <br />
                    <br />
                    <br />
                    <br />
                    </div>
                    <div id="col2">
                    <!-- Column two start -->
                    <?php 
                    echo $properties->PROPS_VAR_BODYSB_WRAP_START;
                    echo $content_sidebar;
                    echo eval($content_sidebar_code);
                    echo $content_sidebar_after_code . "<br />";
                    echo $properties->PROPS_VAR_BODYSB_WRAP_END;
                    ?>
                    <!-- Column two end -->
                    </div>
                    <?php
                }
            } else if(mysql_num_rows($GET_SUBPAGE)>0){
                //SUBPAGE
                while($FETCH_SUBPAGE=mysql_fetch_array($GET_SUBPAGE)){
                    //pull from db
                    $created=$FETCH_PAGE['created'];
                    $content_main=$FETCH_PAGE['content_main'];
                    $content_main_code=$FETCH_PAGE['content_main_code'];
                    $content_main_after_code=$FETCH_PAGE['content_main_after_code'];
    
                    $content_sidebar=$FETCH_PAGE['content_sidebar'];
                    $content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
                    $content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
                    //building the page
                    ?>
                    <div id="col1">
                    <!-- Column one start -->
                    <?php 
                    echo $properties->PROPS_VAR_BODYSB_WRAP_START;
                    echo $content_main;
                    echo eval($content_main_code);
                    echo $content_main_after_code . "<br />";
                    echo $properties->PROPS_VAR_BODYSB_WRAP_END;
                    ?>
                    <br />
                    <br />
                    <br />
                    <br />
                    <!-- Column one end -->
                    </div>
                    <div id="col2">
                    <!-- Column two start -->
                    <?php 
                    echo $properties->PROPS_VAR_BODYSB_WRAP_START;
                    echo $content_main;
                    echo eval($content_sidebar_code);
                    echo $content_sidebar_after_code . "<br />";
                    echo $properties->PROPS_VAR_BODYSB_WRAP_END;
                    ?>
                    <!-- Column two end -->
                    </div>
                    <?php
                }
            }
        }
    ?>
    </div>
</div>