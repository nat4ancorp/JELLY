<?php
function converter($properties,$content,$title,$type,$operand){
	switch($operand){
		case 'to':
			switch($type){
				case 'url':
					/* spaces */
					$content=str_replace(" ","-",$content);
			
					/* special characters */
					$content=str_replace("!","@",$content);
					$content=str_replace(".","~",$content);
					$content=str_replace("#","+",$content);
				break;
				case 'article';
					/* INSERT NOTION HERE */
					$content=str_replace(" "," ",$content);
					
					/* READ MORE FUNCTIONAL */
					if(strstr($content,"[!--more--]")!=""){
						$MOREPOS=strpos($content,"[!--more--]");
						$content=substr($content,0,$MOREPOS);
					}
					
					$content=str_replace(""," ",$content);
				break;
				case 'previewarticle';
					/* INSERT NOTION HERE */
					$content=str_replace(" "," ",$content);
					
					/* PREVIEW */					
					$content=substr($content,0,200);
					$content=str_replace("<h2>","",$content);
					$content=str_replace("</h2>","",$content);
					$content=str_replace("<p>","",$content);
					$content=str_replace("</p>","",$content);
					$content=str_replace("[!--more--]","",$content);
				break;
				case 'fullarticle':
					/* FULL ARTICLE FUNCTIONAL */
					$content=str_replace("[!--more--]"," ",$content);
					
				break;
				case 'basic';
					/* INSERT NOTION HERE */					
					$content=str_replace("(baseurl)",$properties->WEBSITE_URL,$content);
					$content=str_replace("(lp)",$properties->PADMAIN,$content);
					
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
				break;
			}
		break;
		
		case 'from':
			switch($type){
				case 'url':
					/* spaces */
					$content=str_replace("-"," ",$content);
			
					/* special characters */
					$content=str_replace("@","!",$content);
					$content=str_replace("~",".",$content);
					$content=str_replace("+","#",$content);
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