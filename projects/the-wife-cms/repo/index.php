<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
//load global vars from another php file (props.php)
include 'conf/props.php';
require 'includes/private/tools/converter.php';
$properties=new properties();
//include "styles/".$properties->STYLESHEET."/c-css.php"; /*SEEMS TO CAUSE HAVOC ON LOCAL SERVER; UNCOMMENT ON UPLOAD*/
@$page="";
@$page=$_GET['page'];
@$subpage=$_GET['subpage'];
@$launchpad=$_GET['launchpad'];
@$launchpadPN="";
if($launchpad==$properties->PADMAIN){$launchpadPN="padmain";}
if($launchpad==$properties->PAD1){$launchpadPN="pad1";}
if($launchpad==$properties->PAD2){$launchpadPN="pad2";}
if($launchpad==$properties->PAD3){$launchpadPN="pad3";}
if($launchpad==$properties->PAD4){$launchpadPN="pad4";}
include 'conf/connect.php';
$GETFULLWURL=$properties->getFULLWURL();
tempSystem($properties,'_INIT','');
$lpToggle=tempSystem($properties,'lpToggle','');
?>
<title><?php echo $properties->displayWName();?> - <?php echo $properties->WEBSITE_SLOGAN;?><?php echo getPageName($launchpadPN,$page,$properties);?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main.css" />
<?php if(@$launchpadPN=="pad1"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad1.css" />
<?php }if(@$launchpadPN=="pad2"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad2.css" />
<?php }if(@$launchpadPN=="pad3"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad3.css" />
<?php }if(@$launchpadPN=="pad4"){?>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main-pad4.css" />
<?php }if (!isset($_GET['launchpad'])){printf("<script type=\"text/javascript\">location.href='".$properties->WEBSITE_URL."".$properties->PADMAIN."/home'</script>");}?>

<meta name="description" content="<?php echo $properties->SITE_DESCRIPTION;?>" />
<meta name="keywords" content="<?php echo getPageKeywords($launchpadPN,$page,$properties);?>" />
<meta name="author" content="<?php echo $properties->SITE_AUTHOR;?>" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main_ie6.css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo $properties->WEBSITE_URL;?>styles/<?php echo $properties->STYLESHEET;?>/main_ie7.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/tools/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo $properties->WEBSITE_URL;?>includes/private/ajax/all.js"></script>
</head>

<body>
	<div id="art">
        <div class="wrap">
            <!-- PUT YOUR ART HERE IN THE FORM OF DIVS -->
        </div>
    </div> <!-- end of #art -->
    
    <div class="wrap">
		<?php
        if($properties->TURN_ON_TOP_NAV=="yes"){
        ?>
        <div id="topnavigation">
            <div id="topnav">
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
                    <?php echo $properties->displayTopNavRightSideContent();?>
                </div>
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
                <div id="header-leftcol">
                    <div id="title">
                        <div id="innerheader-row">
                            <div id="left" onclick="window.location.href='<?php echo $properties->displayWURL();?>'">
                                <div class="big"><?php echo $properties->displayMainTitle();?></div>
                                <?php echo $properties->displayMainSlogan($properties,$launchpad,'main');?> 
                            </div> <!-- end of #left -->
                            <div id="right<?php echo "-".$launchpadPN;?>">
                                 <?php echo $properties->displayMainSlogan($properties,$launchpad,'extra');?> 
                            </div> <!-- end of #left -->
                        </div> <!-- end of #innerheader-row -->
                    </div> <!-- end of #title -->
                </div> <!-- end of #header-leftcol -->
                               
                <div id="header-rightcol">
                    <?php echo $properties->displayHeaderRightSideContent();?>
                </div>
            </div> <!-- end of #header-row -->
        </div> <!-- end of #header -->
    </div>
    
	<div id="container" class="rounded-corners">
        
        <!--<form action="search" method="POST"><input type="search" value="Search" onfocus="if(this.value==\'Search\'){this.value=\'\';}" onblur="if(this.value==\'\'){this.value=\'Search\';}" class="searchClass" /></form>-->
        
        <div id="navigation">
        	<div id="nav-left">
            	<ul>
                	<?php
                        /* PHP NAVIGATIN LIST MAKER FROM CLASS */
                        $wurl=$properties->getWURL();
                        //determine launchpad constants
                        $launchpadNAME=$launchpad;
                        $launchpadID=GET_LP_ID($properties,$launchpad);
                        echo navigation($wurl,$launchpadNAME,$launchpadID,$page,$properties,$subpage);
                    ?>
                </ul>
        	</div> <!-- end of nav-left -->
            <div id="nav-right">
            	    <?php
                    function setLPtoggleCookie($value,$properties){
                        if($value){
                            /* if the mustash key was click then set the new cookie var */
                            tempSystem($properties,'lpToggle',$value);
                        } else {
                            /* if it wasnt clicked, dont do anything */
                        }
                    }
                    if($lpToggle==1){
                        ?>
                        <div id="lpToggle" onclick="<?php setLPToggleCookie(0,$properties);?>">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <?php
                    } else if($lpToggle==0) {
                        ?>
                        <div id="lpToggle" onclick="<?php setLPToggleCookie(1,$properties);?>">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <?php
                    } else {
                        ?>
                        <div id="lpToggle" onclick="<?php setLPToggleCookie(1,$properties);?>">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <?php
                    }
                    ?>
            </div> <!-- end of nav-right -->
        </div> <!-- end of #navigation -->
        
        <div id="launchPad">
			<div id="lP_row">
				<div id="pad1" onclick="window.location.href='<?php echo $properties->displayWURL();?><?php echo $properties->PAD1;?>/home'">&nbsp;</div>
                
				<div id="pad2" onclick="window.location.href='<?php echo $properties->displayWURL();?><?php echo $properties->PAD2;?>/home'">&nbsp;</div>
                
				<div id="pad3" onclick="window.location.href='<?php echo $properties->displayWURL();?><?php echo $properties->PAD3;?>/home'">&nbsp;</div>
                
				<div id="pad4" onclick="window.location.href='<?php echo $properties->displayWURL();?><?php echo $properties->PAD4;?>/home'">&nbsp;</div>
			</div>
		</div>
        
        <script src="<?php echo $properties->WEBSITE_URL;?>includes/private/js/lpanim.js" type="text/javascript"></script>
        
        <!-- start of PAGE CONTENTS -->
			<?php getPageContents($launchpadID,$page,$subpage,$properties->WEBSITE_URL,$launchpadPN,$properties); ?>
		<!-- end of PAGE CONTENTS --> 
                
                
    	</div> <!-- end of #inner-container -->
	</div> <!-- end of #container -->
    
    <div id="art">
    	<div class="wrap">
    		<!-- PUT YOUR ART HERE IN THE FORM OF DIVS -->
        </div>
    </div> <!-- end of #art -->
    
    <?php
    if($properties->TURN_ON_BOTTOM_NAV=="yes"){
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
                <div class="left">
                    
                </div>
                
                <div class="mid">
                    
                </div>
                
                <div class="right">
                   
                </div>
                
                <div id="lower"> <a href="<?php echo $properties->getFULLWURL();?>"><?php echo $properties->displayWName();?></a> &lt; &middot; &gt; <a href="../<?php echo $properties->PADMAIN;?>/validation">validation</a> &lt; &middot; &gt; copyright &copy; 2012. <a href="<?php echo $properties->getFULLWURL();?>"><?php echo $properties->displayCName();?></a>. not to be copied.
                </div> <!-- end of #lower -->
             </div> <!-- end of #foot -->
         </div> <!-- end of .wrap -->
     </div> <!-- end of #footer -->
</body>
</html>