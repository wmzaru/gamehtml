<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>37wan</title>
<link href="http://ptres.37wan.com/css/global.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
  background: #000000;
  cursor: E-resize;
}
</style>
<script type="text/javascript" language="JavaScript">
<!--
var pic = new Image();
pic.src="http://img1.37wanimg.com/gameframe/nav_right.jpg";
function toggleMenu(){
	frmBody = parent.document.getElementById('frame-body');
	imgArrow = document.getElementById('img');

	if (frmBody.cols == "0,10,*"){
		frmBody.cols="110,10,*";
		imgArrow.src = "http://img1.37wanimg.com/gameframe/nav_left.jpg";
	}else{
		frmBody.cols="0,10,*";
		imgArrow.src = "http://img1.37wanimg.com/gameframe/nav_right.jpg";
	}
	if(crontab){
		window.clearInterval(crontab);
	}
}

var orgX = 0;
document.onmousedown = function(e){
	var evt = Utils.fixEvent(e);
	orgX = evt.clientX;
	if (Browser.isIE) document.getElementById('tbl').setCapture();
}

document.onmouseup = function(e){
	var evt = Utils.fixEvent(e);
	frmBody = parent.document.getElementById('frame-body');
	var arrayfrmBody = frmBody.cols.split(',');
	frmWidth = arrayfrmBody[0];
	frmWidth = (parseInt(frmWidth) + (evt.clientX - orgX));
	frmBody.cols = frmWidth + ","+arrayfrmBody[1]+",*";
	if (Browser.isIE) document.releaseCapture();
}

var Browser = new Object();

Browser.isMozilla = (typeof document.implementation != 'undefined') && (typeof document.implementation.createDocument != 'undefined') && (typeof HTMLDocument != 'undefined');
Browser.isIE = window.ActiveXObject ? true : false;
Browser.isFirefox = (navigator.userAgent.toLowerCase().indexOf("firefox") != - 1);
Browser.isSafari = (navigator.userAgent.toLowerCase().indexOf("safari") != - 1);
Browser.isOpera = (navigator.userAgent.toLowerCase().indexOf("opera") != - 1);

var Utils = new Object();
Utils.fixEvent = function(e){
	var evt = (typeof e == "undefined") ? window.event : e;
	return evt;
}
var crontab=window.setTimeout("toggleMenu()",0);

//-->
</script>
</head>
<body onselect="return false;">
<table height="100%" cellspacing="0" cellpadding="0" id="tbl">
	<tbody><tr><td><a href="javascript:toggleMenu();" title="打开/关闭"><img src="http://img1.37wanimg.com/gameframe/nav_left.jpg" id="img" border="0"></a></td></tr>
</tbody></table>

<div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>