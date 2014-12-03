<?php
include 'getfunction.php';
include 'sysconfig.php';
ckcookie();
$thispage=2;
if($GLOBALS["gcook"]==0)
{
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>location.href='login.php'</script>";
	  exit;
}


if(isset($_GET["s"]))
{
     $s=addslashes(trim($_GET["s"]));
	 $serverrow=mysql_fetch_array(mysql_query("SELECT * FROM server where id=".$s." and tingyong<>1"));
	 if($serverrow==false)
	 {
	       echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	       echo "没有这个区！";
	       exit;
	 }
	 
	 if(!isset($_GET["roleid"]))
	 {
	    $baserow=mysql_fetch_array(mysql_query("SELECT * FROM base where name='rolenum'"));
		$rolenum=$baserow[text];
	    $roleidinfo=mysql_query("SELECT * FROM roleid where serverid=".$s." and namemd5id='".$GLOBALS["gnamemd5id"]."'");
	    $rolenum1=mysql_num_rows($roleidinfo);
		
	    if($rolenum1>=$rolenum)
	    {
	        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	    	 echo "最多只能创建".$rolenum."个角色.";
	    	 exit;
	    }else
		{
		$roleid=md5($GLOBALS["gnamemd5id"]."74gm".rand());
		$roleid=substr($roleid,8,16);
		$getinfo=mysql_query("SELECT * FROM roleid WHERE roleid='".$roleid."'");
		while($num>=1)
		{
		   $roleid=md5($GLOBALS["gnamemd5id"]."74gm".rand());
		   $roleid=substr($roleid,8,16);
	       $getinfo=mysql_query("SELECT * FROM roleid WHERE roleid='".$roleid."'");
	       $num=mysql_num_rows($getinfo);
		}
		 mysql_query("INSERT INTO roleid (roleid,serverid,namemd5id) VALUES ('".$roleid."','".$s."','".$GLOBALS["gnamemd5id"]."')");
		}
	  }else
	  {
	  $roleid=$_GET["roleid"];
	  }
	  
	  if($_GET["xl"]=="wt")
	  {
	  $res=$serverrow['reswt'];
	  $ip=$serverrow['gameipwt'];
	  }else
	  {
	  $res=$serverrow['resdx'];
	  $ip=$serverrow['gameipdx'];
	  }
	  
}else
{
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "没有这区.";
exit;
}
$time = time();
$sign = md5($roleid.'xianlingkey'.$time);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-Control" content="no-cache" />
<link rel="shortcut icon" href="" type="image/x-icon" />
<title><?=$serverrow[servername];?></title>
<style type="text/css">
html,body{ 
	margin:0; 
	height:100%; 
	padding:0;
	overflow:hidden;
	background-color: #000;
}


#container {
	position:relative;
	margin:auto;
	color:#3f3;
	text-align:center;
	font-size:30px;
	height:100%;
}
#MPlayer{
	width:10px;
	height:1px;
	margin:0 auto;
	margin-left:150px;
	position:absolute;
	z-index: 10;
	background-color:#000;
}
</style>
<script type="text/javascript" src="xjs/swfobject.js"></script>


<script type="text/javascript">
	function $g(id)
	{
		return document.getElementById(id);
	}
	
	var unloadFlag = true;
	var unloadStr = "是否要退出大闹天宫";
	function setUnloadString(str)
	{
		unloadStr = str;
	}
	
	function setUnloadFlag()
	{
		unloadFlag = false;
	}
	
  	window.onbeforeunload = function(event){
		if(unloadFlag)
		{
			if(addfavorite('大闹天宫','<?=$webdomain;?>')==false){
				return unloadStr;
			}
		}
	}
	function addfavorite(title,url){
		if (document.all){
		//	window.external.addFavorite(url,title);
		}else if (window.sidebar){
			window.sidebar.addPanel(title, url, "");
		}else{
			return false;
		}
		return true;
	}
	
    var swfVersionStr = "10.0.0";
    var xiSwfUrlStr = "";
    var params = {
				menu: "false",
				scale: "noScale",
				allowFullscreen: "true",
				allowScriptAccess: "always",
				wmode:"direct"
			};
    var attributes = {
				id:"Main"
			};
			
			
    var flashvars =
	{
		lcid:(new Date()).valueOf().toString(16) + (Math.random() * 1000 >>0).toString(16),
		pay:escape('<?=$serverrow[czurl];?>'),
		cm:escape('<?=$webdomain;?>'),
		uid:'<?=$roleid;?>',
		pid:'gmthai',
		t:'<?=$time;?>',
		seid:'fu0',
		sport:'<?=$serverrow[loginport];?>',
		ip:'<?=$ip;?>',
		who:'',
		sign:'<?=$sign;?>',
		cminfo:'null',
		bbsurl:escape('<?=$webdomain;?>'),
		homeurl:escape('<?=$webdomain;?>'),
		infourl:escape('<?=$webdomain;?>'),
		shownav:escape('0'),
		bugurl:escape('<?=$webdomain;?>'),
		suggesturl:escape('<?=$webdomain;?>'),
		saveUrl:escape('<?=$webdomain;?>'),
		pl:'null',
		client:'null',
		microClientURL:escape('<?=$webdomain;?>'),
		gmpanel:'0',
		server: '1',
		gameid: '1'
		
	};
			
	var domain = "<?=$res;?>";
	if(domain)
	{
		var base = document.createElement("base");
		var head = document.getElementsByTagName("head")[0];
		base.href = domain;
		head.appendChild(base);
	}
	
	var swf = domain + "Main.swf?" + (new Date()).valueOf().toString(16);
	function load()
	{
		swfobject.embedSWF(
	    swf, "Main",
	    "100%", "100%",
	    swfVersionStr, xiSwfUrlStr,
	    flashvars, params, attributes);
			
		swfobject.embedSWF( domain + "MPlayer.swf","MPlayer","10","2", swfVersionStr,xiSwfUrlStr,flashvars);
	}
	

    
</script>

</head>
<body onload="load()">
	<div id="container">
    	<div id="MPlayer"></div>
		<!-- 当得到足够的 JavaScript 和 Flash 插件支持时，SWFObject 的动态嵌入方法将此可替代 HTML 内容替换为 Flash 内容。 -->
		<div id="Main"> <a href="http://www.adobe.com/go/getflash"> 点此下载最新版Flash Player </a>
          <p>此页要求 Flash Player 版本 10.0.0 或更高版本。</p>
        </div>
	</div>
</body>
</html>