<div class="left">
    <?php
    /* PHP TOP NAVIGATIN LIST MAKER FROM CLASS */
    $wurl=$properties->getWURL();
    //determine launchpad constants
    $launchpadNAME=$launchpad;
    $launchpadID=GET_LP_ID($properties,$launchpad);
    echo topnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
    ?>
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