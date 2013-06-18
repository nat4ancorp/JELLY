<div id="toTop" style="font-size: <?php echo getGlobalVars($properties,'toTopMessageFontSize');?>px !important; width: <?php echo getGlobalVars($properties,'toTopMessageWidth');?>px !important; height: <?php echo getGlobalVars($properties,'toTopMessageHeight');?>px !important; line-height: <?php echo getGlobalVars($properties,'toTopMessageLineHeight');?>em !important;"><?php echo getGlobalVars($properties,'toTopMessage');?></div>
<div id="art">
    <div class="wrap">
        <div style="position:absolute;left:561px;z-index:1;top:-199px;">
           <div>
                <img src="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $THEME_NAME;?>/images/nat4an_box.png" width="auto" height="500px" />
           </div>
        </div>
    </div>
</div> <!-- end of #art -->