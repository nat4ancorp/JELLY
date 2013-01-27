<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nat4an.com > Projects > jQuery > Animate()</title>
<style>
	#launchpad #pad1 {
		background-color: #0072ff;
		width: 250px;
		height: 20px;
	}
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<body>
<h1>This is a test page where i can test out things i learn using the jquery (animate()) command</h1>
<h2>Basic Usage Button Click and DIV Grow</h2>
<div id="launchpad">
	<div id="pad1">AF</div>
</div>
<script>
$("#pad1").mouseover(function(){
  $("#pad1").animate({
	  height: "200px"/*,
	  width: "100%"*/
  }, 500 );
});

$("#pad1").mouseout(function(){
  $("#pad1").animate({
	  height: "20px"/*,
	  //width: "250px"*/
  }, 500 );
});
</script>
</body>
</html>