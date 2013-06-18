var xmlHttpRequest;

function lp(BASEURL,TO) {
	document.location.href = BASEURL+TO+"/home";
}

function searchToggle(operand,id,iitem){
	switch(operand){
		case 'Expand':
			document.getElementById("search_container_contents_"+id+"_"+iitem).style.display = 'inline';
			document.getElementById("search_container_link_"+id+"_"+iitem).setAttribute("onclick","searchToggle('Collapse',"+id+",'"+iitem+"')");
			$('a#search_container_link_'+id+'_'+iitem).text('[-]');
		break;
		
		case 'Collapse':
			document.getElementById("search_container_contents_"+id+"_"+iitem).style.display = 'none';
			document.getElementById("search_container_link_"+id+"_"+iitem).setAttribute("onclick","searchToggle('Expand',"+id+",'"+iitem+"')");
			$('a#search_container_link_'+id+'_'+iitem).text('[+]');
		break;
	}
}

function pagination(operand,changeTo,wurl,lp,pname_uri,pname_suburi,cpp,cpps){
	cpp = parseInt(cpp,10); /* current pagination page */
	
	//get first part of cpps
	//XXX-YYY
	//0123456
	//cppslen=cpps.substr(cpps,0,cpps.indexOf("-"));
	cpps = parseInt(cpps,10); /* current pagination last */
	//cpps = parseInt(cpps,10); /* current pagination start */
	switch(operand){
		case 'first':
			document.location.href = wurl+lp+pname_uri+pname_suburi+cpps+"#top";
		break;
		case 'back':			
			document.location.href = wurl+lp+pname_uri+pname_suburi+(cpp - 1)+"#top";
		break;
		case 'changeTo':
			document.location.href = wurl+lp+pname_uri+pname_suburi+changeTo+"#top";
		break;
		case 'forward':
			document.location.href = wurl+lp+pname_uri+pname_suburi+(cpp + 1)+"#top";
		break;
		case 'last':
			document.location.href = wurl+lp+pname_uri+pname_suburi+cpps+"#top";
		break;
	}
}
function IsNumeric(input)
{
    return (input - 0) == input && input.length > 0;
}

/* -------------------------------------------------------------------- PLUGIN JS -------------------------------------------------------------------------------
   --------------------------------------------------------------------------------------------------------------------------------------------------------------
   THE FOLLOWING SPACE IS FOR PLUGIN JS FILES AND FUNCTIONS TO BE CREATED. ANYTHING BELOW THIS IS ONLY FOR CUSTOM JS FUNCTIONS.
   -------------------------------------------------------------------------------------------------------------------------------------------------------------- */
   
function ANIME_FAQS_CONTROL(operand,id){
	switch(operand){
		case 'Expand':
			document.getElementById("p_a_"+id+"_a").style.display = 'inline-block';
			document.getElementById("p_a_"+id+"_q").setAttribute("onclick","ANIME_FAQS_CONTROL('Collapse',"+id+")");
		break;
		
		case 'Collapse':
			document.getElementById("p_a_"+id+"_a").style.display = 'none';
			document.getElementById("p_a_"+id+"_q").setAttribute("onclick","ANIME_FAQS_CONTROL('Expand',"+id+")");
		break;
	}
}

/*
========================================
 Popup Menus v1.0.2
 Add-on for SmartMenus v6.0.4+
========================================
 (c)2011 Vadikom Web Ltd.
========================================
*/


// ===
function c_show(m,e){if(typeof c_dl=="undefined"||!c_dl)return;u=c_gO(m);if(!u||u.IN!=2)return;if(!u.PP){alert('ERROR\n\nSmartMenus 6 Popup Menus Add-on:\n\nYou are calling the "'+m+'" menu, which is not set as a popup menu in the config file.\nThe c_show() function can only be used to show menus that have "Position" set to \'popup\'.');return}c_mV();if(u.style.display=="block")return;c_hD();c_S[1]=u;var S,w,h,x,y,mouseX,mouseY,t,targetX,targetY,targetW,targetH,menuW,menuH,C,c,D;S=u.style;if(!u.FM){S.visibility="hidden";u.FM=1}S.display="block";w=c_gD(u);h=c_gD(u,1);c=c_gW();if(e){D=c_qM?c_dB:c_dE;mouseX=e.pageX||e.clientX+c.x-(c_rL()?D.offsetWidth-c.w:0);mouseY=e.pageY||e.clientY+c.y;t=e.target||e.srcElement;while(t.nodeType!=1)t=t.parentNode;C=c_cA(t);targetX=C.x;targetY=C.y;targetW=c_gD(t);targetH=c_gD(t,1)}menuW=w;menuH=h;x=!arguments[2]?mouseX:eval(arguments[2]);y=!arguments[3]?mouseY:eval(arguments[3]);if(c_r&&x<c.x)x=c.x;else if(x+w>c.x+c.w)x=c.x+c.w-w;if(h<c.h&&y+h>c.y+c.h)y=c.y+c.h-h;else if(h>=c.h||y<c.y)y=c.y;S.right="auto";S.left=x+"px";S.top=y+"px";if(c_F[0])c_iF(u,w,h,x,y);if(c_F[1])c_hS();c_sH(u)};function c_hide(){if(typeof c_dl=="undefined"||!c_dl)return;c_mU()};function c_oF(){c_mV();c_c=this;if(!c_gL(c_c).parentNode.PP)c_sM(1)}

function _chooser(){
	var _chooser_value=document.getElementById("_chooser").value;
	
	var element_count=document.getElementById("_chooser").length -1;
		//for(var i=0; i<=element_count; i++){
//			var the_element=document.getElementById("element_"+i).value;

/*			if(_chooser_value==the_element){
				document.getElementById(the_element+"_container").style.display = 'inline';
			} else if(_chooser_value=="all"){document.getElementById(the_element+"_container").style.display = 'inline';
			} else{document.getElementById(the_element+"_container").style.display = 'none';}*/
		
		for(var index=0; index<element_count; index++){
			var the_element=document.getElementById("element_"+index);
			if(_chooser_value=="all") { document.getElementById(the_element.value+"_container").style.display = "inline"; }
			else if (the_element.value === _chooser_value) { document.getElementById(_chooser_value + "_container").style.display = "inline"; }
			else if(the_element.value != _chooser_value){ document.getElementById(the_element.value+"_container").style.display = "none";}
			else { /*fuck it failed somehow*/ }
			
		}
}

function str_replace(search, replace, subject, count) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Gabriel Paderni
  // +   improved by: Philip Peterson
  // +   improved by: Simon Willison (http://simonwillison.net)
  // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // +   bugfixed by: Anton Ongson
  // +      input by: Onno Marsman
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +    tweaked by: Onno Marsman
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   input by: Oleg Eremeev
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Oleg Eremeev
  // %          note 1: The count parameter must be passed as a string in order
  // %          note 1:  to find a global variable in which the result will be given
  // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
  // *     returns 1: 'Kevin.van.Zonneveld'
  // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
  // *     returns 2: 'hemmo, mars'
  var i = 0,
    j = 0,
    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
  s = [].concat(s);
  if (count) {
    this.window[count] = 0;
  }

  for (i = 0, sl = s.length; i < sl; i++) {
    if (s[i] === '') {
      continue;
    }
    for (j = 0, fl = f.length; j < fl; j++) {
      temp = s[i] + '';
      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
      s[i] = (temp).split(f[j]).join(repl);
      if (count && s[i] !== temp) {
        this.window[count] += (temp.length - s[i].length) / f[j].length;
      }
    }
  }
  return sa ? s : s[0];
}
function getWidth()
  {
    xWidth = null;
    if(window.screen != null)
      xWidth = window.screen.availWidth;

    if(window.innerWidth != null)
      xWidth = window.innerWidth;

    if(document.body != null)
      xWidth = document.body.clientWidth;

    return xWidth;
  }
function getHeight() {
  xHeight = null;
  if(window.screen != null)
    xHeight = window.screen.availHeight;

  if(window.innerHeight != null)
    xHeight =   window.innerHeight;

  if(document.body != null)
    xHeight = document.body.clientHeight;

  return xHeight;
}

function thumbs(entryid,type,weburl,uid,uip,page,themename,foruid){
	//var to hold the request
	var request;
	
	//bind to the submit event of our form
	//abort any pending request
	/*if (request) {
		request.abort();	
	}*/
	//setup some local variables
	//var $form = $(this);
	//let's select and cache all the fields
	//var $inputs = $form.find("input, select, button, textarea");
	//serialize the data in the form
	//var serializeData = $form.serialize();
	
	//let's disable the inputs for the duration of the ajax request
	//$inputs.prop("disabled", true);
	//fire off the request to /form.php
	var KeyVals = { entryid : entryid };
	var request = $.ajax({
		type: "POST",
		url: weburl+"includes/private/attributes/doThumb.php?entryid="+entryid+"&type="+type+"&weburl="+weburl+"&uid="+uid+"&uip="+uip+"&page="+page+"&foruid="+foruid,
		data: KeyVals,
		dataType: "text",
		success: function(data){
			//alert(data);
			/* TAKE data (type:numberToIncr.) AND EXPLODE IT */
			var data_arr = data.split(':');
			
			var data_type	 		 = data_arr[0];
			var numberOfLikes 		 = data_arr[1];
			var numberOfDisLikes	 = data_arr[2];
			
			if(entryid.indexOf("=")>-1){
				/* FOUND BADGEID */
				/* DECIDE IF IT IS A REGULAR ONE FOR BADGE OR A COMMENT ON FOR BADGE*/
				if(entryid.indexOf(":")>-1){
					/* ITS A COMMENT ONE */
					// ex. bid=#:#
					var ec_farr 		= entryid.split(':'); 					
					var ec_bidpart		= ec_farr[0];
					// ex. bid=#
					//     01234
					var ec_bid			= ec_bidpart.substr(4,1);					
					var ec_commentid	= ec_farr[1];			
					
					switch(data_type){
						case 'like':					
							document.getElementById("like-comment-holder-"+ec_commentid).innerHTML = numberOfLikes;
							document.getElementById("dislike-comment-holder-"+ec_commentid).innerHTML = numberOfDisLikes;
							
							//switch the buttons
							document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_up_hover.png');
							document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_down.png');						
							
							//switch the mouseouts
							document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up_hover.png\'');
							document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down.png\'');
						break;
						case 'dislike':
							document.getElementById("like-comment-holder-"+ec_commentid).innerHTML = numberOfLikes;
							document.getElementById("dislike-comment-holder-"+ec_commentid).innerHTML = numberOfDisLikes;
							
							//switch the buttons
							document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_up.png');
							document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_down_hover.png');						
							
							//switch the mouseouts
							document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up.png\'');
							document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down_hover.png\'');
					}
				} else {
					/* ITS A REGULAR ONE */
					/* FOUND COMMENTID/ENTRYID SPLIT */
					var ec_arr 		= entryid.split('=');
					var ec_bid 		= ec_arr[1];
					
					switch(data_type){
						case 'like':					
							document.getElementById("like-badge-holder").innerHTML = numberOfLikes;
							document.getElementById("dislike-badge-holder").innerHTML = numberOfDisLikes;
							
							//switch the buttons
							document.getElementById("thumbs-up-badge").setAttribute('src',''+weburl+themename+'images/thumbs_up_hover.png');
							document.getElementById("thumbs-down-badge").setAttribute('src',''+weburl+themename+'images/thumbs_down.png');						
							
							//switch the mouseouts
							document.getElementById("thumbs-up-badge").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up_hover.png\'');
							document.getElementById("thumbs-down-badge").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down.png\'');
						break;
						case 'dislike':
							document.getElementById("like-badge-holder").innerHTML = numberOfLikes;
							document.getElementById("dislike-badge-holder").innerHTML = numberOfDisLikes;
							
							//switch the buttons
							document.getElementById("thumbs-up-badge").setAttribute('src',''+weburl+themename+'images/thumbs_up.png');
							document.getElementById("thumbs-down-badge").setAttribute('src',''+weburl+themename+'images/thumbs_down_hover.png');						
							
							//switch the mouseouts
							document.getElementById("thumbs-up-badge").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up.png\'');
							document.getElementById("thumbs-down-badge").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down_hover.png\'');
					}
				}
			} else if(entryid.indexOf(":")>-1){
				/* FOUND COMMENTID/ENTRYID SPLIT */
				var ec_arr = entryid.split(':');
				var ec_entryid 		= ec_arr[0];
				var ec_commentid	= ec_arr[1];												
				
				switch(data_type){
					case 'like':					
						document.getElementById("like-comment-holder-"+ec_commentid).innerHTML = numberOfLikes;
						document.getElementById("dislike-comment-holder-"+ec_commentid).innerHTML = numberOfDisLikes;
						
						//switch the buttons
						document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_up_hover.png');
						document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_down.png');						
						
						//switch the mouseouts
						document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up_hover.png\'');
						document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down.png\'');
					break;
					case 'dislike':
						document.getElementById("like-comment-holder-"+ec_commentid).innerHTML = numberOfLikes;
						document.getElementById("dislike-comment-holder-"+ec_commentid).innerHTML = numberOfDisLikes;
						
						//switch the buttons
						document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_up.png');
						document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('src',''+weburl+themename+'images/thumbs_down_hover.png');						
						
						//switch the mouseouts
						document.getElementById("thumbs-up-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up.png\'');
						document.getElementById("thumbs-down-comment-"+ec_commentid).setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down_hover.png\'');
				}
			} else {
				/* JUST ENTRY */
				switch(data_type){
					case 'like':					
						document.getElementById("like-holder").innerHTML = numberOfLikes;
						document.getElementById("dislike-holder").innerHTML = numberOfDisLikes;
						
						//switch the buttons
						document.getElementById("thumbs-up-entry").setAttribute('src',''+weburl+themename+'images/thumbs_up_hover.png');
						document.getElementById("thumbs-down-entry").setAttribute('src',''+weburl+themename+'images/thumbs_down.png');						
						
						//switch the mouseouts
						document.getElementById("thumbs-up-entry").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up_hover.png\'');
						document.getElementById("thumbs-down-entry").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down.png\'');
					break;
					case 'dislike':
						document.getElementById("like-holder").innerHTML = numberOfLikes;
						document.getElementById("dislike-holder").innerHTML = numberOfDisLikes;
						
						//switch the buttons
						document.getElementById("thumbs-up-entry").setAttribute('src',''+weburl+themename+'images/thumbs_up.png');
						document.getElementById("thumbs-down-entry").setAttribute('src',''+weburl+themename+'images/thumbs_down_hover.png');						
						
						//switch the mouseouts
						document.getElementById("thumbs-up-entry").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_up.png\'');
						document.getElementById("thumbs-down-entry").setAttribute('onmouseout','this.src=\''+weburl+themename+'images/thumbs_down_hover.png\'');
					break;
				}	
			}
		}
	});
}

function actioncenter(directive,uid,bid,setto,weburl){
	/* THE MANAGING OF NOTIFICATION FROM ACTIONCENTER ABOUT YOUR ACCOUNT */
	//var to hold the request
	var request;
	
	//bind to the submit event of our form
	//abort any pending request
	/*if (request) {
		request.abort();	
	}*/
	//setup some local variables
	//var $form = $(this);
	//let's select and cache all the fields
	//var $inputs = $form.find("input, select, button, textarea");
	//serialize the data in the form
	//var serializeData = $form.serialize();
	
	//let's disable the inputs for the duration of the ajax request
	//$inputs.prop("disabled", true);
	//fire off the request to /form.php
	var KeyVals = { directive : directive };
	var request = $.ajax({
		type: "POST",
		url: weburl+"includes/private/attributes/doAC.php?directive="+directive+"&uid="+uid+"&bid="+bid+"&setto="+setto+"&weburl="+weburl,
		data: KeyVals,
		dataType: "text",
		success: function(data){
			if(data=="no more messages"){
				/* FADE AC OUT AND UP */
				$('#ta-inner').fadeOut('slow', function() {					
					$('#topmessage-actioncenter').slideUp('fast', function() {
						//done	
					});
				});		
			} else {
				/* FADE AND LOAD NEW MESSAFE */
				var message=data;
				$('#ta-inner').fadeOut('slow', function() {
					document.getElementById("ta-inner").innerHTML = data;
					$('#ta-inner').fadeIn('slow', function() {
						//done	
					});
				});				
			}
		}
	});
}