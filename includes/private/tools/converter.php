<?php
function converter($properties,$content,$type,$operand){
	@$ip=$_SERVER['REMOTE_ADDR'];
	@$SESSIONID=tempSystem($properties,"getSESSION","");
	if($_SERVER['HTTP_HOST']=="localhost"){$WEBSITE_URL=$properties->WEBSITE_TEST_URL;}else{$WEBSITE_URL=$properties->WEBSITE_REMO_URL;};
	switch($operand){
		case 'to':
			switch($type){
				case 'url':
					/* before spaces */
					$content=str_replace("-","[hy]",$content);
					
					/* spaces */
					$content=str_replace(" ","-",$content);
			
					/* special characters */
					$content=str_replace("!","@",$content);
					$content=str_replace(".","~",$content);
					$content=str_replace("#","+",$content);
					$content=str_replace("+","[PLUS]",$content);
					$content=str_replace(":","[colon]",$content);
					$content=str_replace("'","[sq]",$content);
				break;
				case 'article';
					/* INSERT NOTION HERE */
					$content=str_replace(" "," ",$content);
					
					/* READ MORE FUNCTIONAL */
					if(strstr($content,"[!--more--]")!=""){
						$MOREPOS=strpos($content,"[!--more--]");
						$content=substr($content,0,$MOREPOS);
					}
					
				break;
				case 'previewarticle';
					/* INSERT NOTION HERE */
					$content=str_replace(" "," ",$content);
					
					/* PREVIEW */					
					$content=substr($content,0,200);
					$content=str_replace("<h1>","<strong>",$content);
					$content=str_replace("</h1>","</strong><br />",$content);
					$content=str_replace("<h2>","",$content);
					$content=str_replace("</h2>","",$content);
					$content=str_replace("<h3>","",$content);
					$content=str_replace("</h3>","",$content);
					$content=str_replace("<h4>","",$content);
					$content=str_replace("</h4>","",$content);
					$content=str_replace("<h5>","",$content);
					$content=str_replace("</h5>","",$content);
					$content=str_replace("<p>","",$content);
					$content=str_replace("</p>","",$content);
					$content=str_replace("[!--more--]","",$content);
				break;
				case 'fullarticle':
					/* FULL ARTICLE FUNCTIONAL */
					$content=str_replace("[!--more--]"," ",$content);
					$content=str_replace("[leftarrow]","&lt;",$content);
					$content=str_replace("[rightarrow]","&gt;",$content);
					
				break;
				case 'basic';
					/* INSERT NOTION HERE */			
					@$launchpad=$_GET['launchpad'];
					$content=str_replace("(baseurl)",$WEBSITE_URL,$content);
					$content=str_replace("(homelp)",$properties->PADMAIN,$content);
					$content=str_replace("(currentlp)",$launchpad,$content);
					$content=str_replace("(stylesheet)",Theme($properties,"getCurrThemeName",$ip,$SESSIONID),$content);
					$content=str_replace("(entry_name)",@$title,$content);
					$content=str_replace("(signature)",getGlobalVars($properties,"autoresponder_closing_line"),$content);
					
					/* READ MORE FUNCTIONAL */
					if(strstr($content,"[!--more--]")!=""){
						$MOREPOS=strpos($content,"[!--more--]");
						$content=substr($content,0,$MOREPOS);
					}
				break;
				case 'ncode':
					/* INSERT NOTION HERE */
					$content=str_replace("[code]","<?php",$content);
					$content=str_replace("[/code]","?> ",$content);
					
					/* READ MORE FUNCTIONAL */
					if(strstr($content,"[!--more--]")!=""){
						$MOREPOS=strpos($content,"[!--more--]");
						$content=substr($content,0,$MOREPOS);
					}
					
					/* YOUTUBE FUNCTIONAL */
					//<iframe width="560" height="315" src="http://www.youtube.com/embed/hDlif8Km4S4" frameborder="0" allowfullscreen></iframe>
					//get the y_id
					//[youtube]fdsafdasf[/youtube]
					//0123456789012345678901234567
					
					//count how many appearances of [youtube] in content
					$num_of_a_youtube=substr_count($content,"[youtube id=");
					if($num_of_a_youtube > 1){
						/* multiple youtubes */
						for($i=1; $i<=$num_of_a_youtube; $i++){
							$y_id=substr($content,(strpos($content,"[youtube id={$i}")+14),11);
							$content=str_replace("[youtube id=".$i."]".$y_id."[/youtube]","<br /><br /><center><iframe width=\"100%\" height=\"175%\" src=\"http://www.youtube.com/embed/".$y_id."\" frameborder=\"0\" allowfullscreen></iframe></center><br /><br />",$content);
						}
					} else {
						/* one youtube */
						//$y_id="UYrkQL1bX4A";
						$id_of_youtube=substr($content,(strpos($content,"[youtube id=")+12),1);
						$y_id=substr($content,(strpos($content,"[youtube id=")+14),11);
						$content=str_replace("[youtube id=".$id_of_youtube."]".$y_id."[/youtube]","<br /><br /><center><iframe width=\"100%\" height=\"175%\" src=\"http://www.youtube.com/embed/".$y_id."\" frameborder=\"0\" allowfullscreen></iframe></center><br /><br />",$content);
					}
				break;
			}
		break;
		
		case 'from':
			switch($type){
				case 'url':								
					/* spaces */
					$content=str_replace("-"," ",$content);
					
					/* not replace spaces */
					$content=str_replace("[hy]","-",$content);
			
					/* special characters */
					$content=str_replace("@","!",$content);
					$content=str_replace("~",".",$content);
					$content=str_replace("+","#",$content);
					$content=str_replace("[PLUS]","+",$content);
					$content=str_replace("[colon]",":",$content);
					$content=str_replace("[sq]","\'",$content);
				break;
				case 'tag':
					/* spaces */
					$content=str_replace("-"," ",$content);
			
					/* special characters */
					$content=str_replace("@","!",$content);
					$content=str_replace("~",".",$content);
				break;
				case 'article';
					/* INSERT NOTION HERE */
					$content=str_replace(" "," ",$content);
					
				break;
				case 'basic';
					/* INSERT NOTION HERE */					
				break;
				case 'ncode':
					/* INSERT NOTION HERE */					
				break;
			}
		break;
	}
	return $content;
}
?>