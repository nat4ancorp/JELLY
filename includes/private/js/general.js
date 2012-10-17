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
			document.location.href = wurl+lp+pname_uri+pname_suburi+cpps;
		break;
		case 'back':			
			document.location.href = wurl+lp+pname_uri+pname_suburi+(cpp - 1);
		break;
		case 'changeTo':
			document.location.href = wurl+lp+pname_uri+pname_suburi+changeTo;
		break;
		case 'forward':
			document.location.href = wurl+lp+pname_uri+pname_suburi+(cpp + 1);
		break;
		case 'last':
			document.location.href = wurl+lp+pname_uri+pname_suburi+cpps;
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

