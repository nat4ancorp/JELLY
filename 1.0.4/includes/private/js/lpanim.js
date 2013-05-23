$("#lpToggle").click(function(){
	$("#launchPad").animate({
		height: 'toggle'
	}, 400, function(){
		//animation complete
	});
});

//pad 1
$("#pad1").mouseover(function(){
	/* make all other launchpads dissolve */
	$("#pad2").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad3").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad4").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	/*$("#pad1").animate({
		width: "100%"
	}, 400 );
	$("#pad1").animate({
		height: "300%",
	}, 400 );*/
});

$("#pad1").mouseout(function(){
	/*$("#pad1").animate({
		width: "25%"
	}, 400 );*/
	$("#pad1").animate({
		height: "100%"
	}, 400 );
	/* make all other launchpads dissolve */
	$("#pad2").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad3").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad4").animate({
		opacity: 1
	}, { duration: 500, queue: false });
});

//pad 2
$("#pad2").mouseover(function(){
	/*$("#pad2").animate({
		width: "100%"
	}, 400 );
	$("#pad2").animate({
		height: "300%",
	}, 400 );*/
	/* make all other launchpads dissolve */
	$("#pad1").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad3").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad4").animate({
		opacity: .1
	}, { duration: 500, queue: false });
});

$("#pad2").mouseout(function(){
	/*$("#pad2").animate({
		width: "25%"
	}, 400 );
	$("#pad2").animate({
		height: "100%"
	}, 400 );*/
	/* make all other launchpads dissolve */
	$("#pad1").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad3").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad4").animate({
		opacity: 1
	}, { duration: 500, queue: false });
});

//pad 3
$("#pad3").mouseover(function(){
	/*$("#pad3").animate({
		width: "100%"
	}, 400 );
	$("#pad3").animate({
		height: "300%",
	}, 400 );*/
	/* make all other launchpads dissolve */
	$("#pad1").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad2").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad4").animate({
		opacity: .1
	}, { duration: 500, queue: false });
});

$("#pad3").mouseout(function(){
	/*$("#pad3").animate({
		width: "25%"
	}, 400 );
	$("#pad3").animate({
		height: "100%"
	}, 400 );*/
	/* make all other launchpads dissolve */
	$("#pad1").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad2").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad4").animate({
		opacity: 1
	}, { duration: 500, queue: false });
});

//pad 4
$("#pad4").mouseover(function(){
	/*$("#pad4").animate({
		width: "100%"
	}, 400 );
	$("#pad4").animate({
		height: "300%",
	}, 400 );*/
	/* make all other launchpads dissolve */
	$("#pad1").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad2").animate({
		opacity: .1
	}, { duration: 500, queue: false });
	$("#pad3").animate({
		opacity: .1
	}, { duration: 500, queue: false });
});

$("#pad4").mouseout(function(){
	/*$("#pad4").animate({
		width: "25%"
	}, 400 );
	$("#pad4").animate({
		height: "100%"
	}, 400 );*/
	/* make all other launchpads dissolve */
	$("#pad1").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad2").animate({
		opacity: 1
	}, { duration: 500, queue: false });
	$("#pad3").animate({
		opacity: 1
	}, { duration: 500, queue: false });
});