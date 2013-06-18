<?php
@$SESSIONID=tempSystem($properties,"getSESSION","");
if(isset($_GET['n']) && ($_GET['n']!="")){$code=$_GET['n'];}
//determine what layout it is
$GET_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}errorpages WHERE code='$code'");
if(mysql_num_rows($GET_PAGE)<1){
		echo "An Error Occurred!";
	} else {
		if(mysql_num_rows($GET_PAGE)>0){
			//PAGE
			while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
				//pull from db
				$layout=$FETCH_PAGE['layout'];
				$content_main=$FETCH_PAGE['content_main'];
				$content_main_code=$FETCH_PAGE['content_main_code'];
				$content_main_after_code=$FETCH_PAGE['content_main_after_code'];

				$content_sidebar=$FETCH_PAGE['content_sidebar'];
				$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
				$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
				
				$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
                $content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
                $content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];	

			}
		} else if(mysql_num_rows($GET_SUBPAGE)>0){
			//SUBPAGE
			while($FETCH_SUBPAGE=mysql_fetch_array($GET_SUBPAGE)){
				//pull from db
				$layout=$FETCH_PAGE['layout'];
				$content_main=$FETCH_PAGE['content_main'];
				$content_main_code=$FETCH_PAGE['content_main_code'];
				$content_main_after_code=$FETCH_PAGE['content_main_after_code'];

				$content_sidebar=$FETCH_PAGE['content_sidebar'];
				$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
				$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];	
				
				$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
                $content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
                $content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];			
			}
		}
	}
?>

<?php if($layout == "triple"){?><div id="container3"><div id="container2"><div id="container1"><?php }?>
    <?php if($layout == "double"){?><div id="container2"><div id="container1"><?php }?>
        <?php if($layout == "single"){?><div id="container1"><?php }?>
        <?php
        $GET_PAGE=mysql_query("SELECT * FROM {$properties->DB_PREFIX}errorpages WHERE code='$code'");
            if(mysql_num_rows($GET_PAGE)<1){
                echo "An Error Occurred!";
            } else {
				//PAGE
				while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
					//pull from db
					$layout=$FETCH_PAGE['layout'];
					$content_main=$FETCH_PAGE['content_main'];
					$content_main_code=$FETCH_PAGE['content_main_code'];
					$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
	
					$content_sidebar=$FETCH_PAGE['content_sidebar'];
					$content_sidebar_code=$FETCH_PAGE['content_sidebar_code'];
					$content_sidebar_after_code=$FETCH_PAGE['content_sidebar_after_code'];
					
					$content_sidebar2=$FETCH_PAGE['content_sidebar2'];
					$content_sidebar_code2=$FETCH_PAGE['content_sidebar_code2'];
					$content_sidebar_after_code2=$FETCH_PAGE['content_sidebar_after_code2'];
					//building the page
					?>
					<?php if($layout == "single"){?>
					<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $THEME_NAME;?>mode/single.css" >
					<div id="col1">
					<!-- Column one start -->
					<?php 
					echo $properties->PROPS_VAR_BODYSB_WRAP_START;
					echo converter($properties,$content_main,'basic','to');
					echo eval($content_main_code);
					echo converter($properties,$content_main_after_code,'basic','to'). "<br />";
					echo $properties->PROPS_VAR_BODYSB_WRAP_END;
					?>
					<!-- Column one end -->
					
					</div>
					<?php }?>
					
					<?php if($layout == "double"){?>
					<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $THEME_NAME;?>mode/double.css" >
					<div id="col1">
					<!-- Column one start -->
					<?php 
					echo $properties->PROPS_VAR_BODYSB_WRAP_START;
					echo converter($properties,$content_main,'basic','to');
					echo eval($content_main_code);
					echo converter($properties,$content_main_after_code,'basic','to'). "<br />";
					echo $properties->PROPS_VAR_BODYSB_WRAP_END;
					?>
					<!-- Column one end -->
					
					</div>
					<div id="col2">
					<!-- Column two start -->
					<?php 
					echo $properties->PROPS_VAR_BODYSB_WRAP_START;
					echo converter($properties,$content_sidebar,'basic','to');
					echo eval($content_sidebar_code);
					echo converter($properties,$content_sidebar_after_code,'basic','to'). "<br />";
					echo $properties->PROPS_VAR_BODYSB_WRAP_END;
					?>
					<!-- Column two end -->
					
					</div>
					<?php }?>
					
					<?php if($layout == "triple"){?>
					<link rel="stylesheet" type="text/css" href="<?php if($_SERVER['HTTP_HOST']=="localhost"){echo $properties->WEBSITE_TEST_URL;}else{echo $properties->WEBSITE_REMO_URL;};?><?php echo $THEME_NAME;?>mode/triple.css" >
					<div id="col1">
					<!-- Column one start -->
					<?php 
					echo $properties->PROPS_VAR_BODYSB_WRAP_START;
					echo converter($properties,$content_main,'basic','to');
					echo eval($content_main_code);
					echo converter($properties,$content_main_after_code,'basic','to'). "<br />";
					echo $properties->PROPS_VAR_BODYSB_WRAP_END;
					?>
					<!-- Column one end -->
					
					</div>
					<div id="col2">
					<!-- Column two start -->
					<?php 
					echo $properties->PROPS_VAR_BODYSB_WRAP_START;
					echo converter($properties,$content_sidebar,'basic','to');
					echo eval($content_sidebar_code);
					echo converter($properties,$content_sidebar_after_code,'basic','to'). "<br />";
					echo $properties->PROPS_VAR_BODYSB_WRAP_END;
					?>
					<!-- Column two end -->
					
					</div>
					<div id="col3">
					<!-- Column three start -->
					<?php 
					echo $properties->PROPS_VAR_BODYSB_WRAP_START;
					echo $content_sidebar2;
					echo eval($content_sidebar_code2);
					echo $content_sidebar_after_code2;
					echo $properties->PROPS_VAR_BODYSB_WRAP_END;
					?>
					<!-- Column three end -->
					
					</div>
					<?php }?>
					<?php
				}
            }
        ?>
        <?php if($layout == "single"){?></div><?php }?>
    <?php if($layout == "double"){?></div></div><?php }?>
<?php if($layout == "triple"){?></div></div></div><?php }?>