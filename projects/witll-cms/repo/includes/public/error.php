<?php
$GET_PAGE=mysql_query("SELECT * FROM h_errorpages WHERE code='$code'");
	if(mysql_num_rows($GET_PAGE)<1){
		echo "An Error Occurred!";
	} else {
		if(mysql_num_rows($GET_PAGE)>0){
			//PAGE
			while($FETCH_PAGE=mysql_fetch_array($GET_PAGE)){
				//pull from db
				$content_main=$FETCH_PAGE['content_main'];
				$content_main_code=$FETCH_PAGE['content_main_code'];
				$content_main_after_code=$FETCH_PAGE['content_main_after_code'];
				//building the page
				?>
				<div id="content-special">
				<!-- Column one start -->
				<?php 
				echo $properties->PROPS_VAR_BODYSB_WRAP_START;
				echo converter($properties,$content_main,'basic','to');
				echo eval($content_main_code);
				echo converter($properties,$content_main_after_code,'basic','to') . "<br />";
				echo $properties->PROPS_VAR_BODYSB_WRAP_END;
				?>
				<!-- Column one end -->
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
				</div>
				<?php
			}
		}
	}
?>