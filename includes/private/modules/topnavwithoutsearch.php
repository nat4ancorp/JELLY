<div class="left">
    <?php
    /* PHP TOP NAVIGATIN LIST MAKER FROM CLASS */
    $wurl=$WEBSITE_URL;
    //determine launchpad constants
    $launchpadNAME=$launchpad;
    $launchpadID=GET_LP_ID($properties,$launchpad);
    echo topnavigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
    ?>
</div>
<div class="right">
    
</div>