function edit(placeholder_id,what,state){
	switch(what){
		case "name":
			if(state=="focus"){
				var currentName = document.getElementById("placeholder-currentName-"+placeholder_id).value;
				document.getElementById("placeholder-name-"+placeholder_id).innerHTML = "<input type=\"text\" name=\"new_name\" size=\"30\" value=\""+currentName+"\" /><a onclick=\"edit("+placeholder_id+",'name','blur')\" style=\"cursor:pointer;\">[X]</a>";
			} else if(state=="blur"){
				var currentName = document.getElementById("placeholder-currentName-"+placeholder_id).value;
				if(currentName.length>29){currentName=currentName.substr(0,25)+"...";}
				document.getElementById("placeholder-name-"+placeholder_id).innerHTML = "<a onclick=\"edit("+placeholder_id+",'name','focus');\" title="+currentName+"\">"+currentName+"</a>";
			}
		break;

		case "source":
			if(state=="focus"){
				var currentSource = document.getElementById("placeholder-currentSource-"+placeholder_id).value;
				document.getElementById("placeholder-source-"+placeholder_id).innerHTML = "<input type=\"text\" name=\"new_type\" size=\"10\" value=\""+currentSource+"\" /><a onclick=\"edit("+placeholder_id+",'source','blur')\" style=\"cursor:pointer;\">[X]</a>";
			} else if(state=="blur"){
				var currentSource = document.getElementById("placeholder-currentSource-"+placeholder_id).value;
				if(currentSource.length>29){currentSource=currentSource.substr(0,25)+"...";}
				document.getElementById("placeholder-source-"+placeholder_id).innerHTML = "<a onclick=\"edit("+placeholder_id+",'source','focus');\" title="+currentSource+"\">"+currentSource+"</a>";
			}
		break;

		case "type":
			if(state=="focus"){
				var currentType = document.getElementById("placeholder-currentType-"+placeholder_id).value;
				document.getElementById("placeholder-type-"+placeholder_id).innerHTML = "<select name=\"new_type\" id=\"new_type\" size=\"1\"><option value=\"youtube\">Youtube</option><option value=\"vimeo\">Vimeo</option></select><a onclick=\"edit("+placeholder_id+",'type','blur')\" style=\"cursor:pointer;\">[X]</a>";
			} else if(state=="blur"){
				var currentType = document.getElementById("placeholder-currentType-"+placeholder_id).value;
				if(currentType.length>29){currentType=currentType.substr(0,25)+"...";}
				document.getElementById("placeholder-type-"+placeholder_id).innerHTML = "<a onclick=\"edit("+placeholder_id+",'type','focus');\" title="+currentType+"\">"+currentType+"</a>";
			}
		break;
	}
}

function save(entry_id,value){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			//var ajaxDisplay = document.getElementById('ajaxDiv');
			//alert("Entry #"+entry_id+" has been saved with value: "+value);	
			//alert(ajaxRequest.responseText);	
			window.location.reload();
			//ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	var queryString = "?entry_id=" + entry_id + "&value=" + value;
	ajaxRequest.open("GET", "update.php" + queryString, true);
	ajaxRequest.send(null); 
}