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

<SCRIPT language=JavaScript> 
document.oncontextmenu=new Function("event.returnValue=false;"); 
document.onselectstart=new Function("event.returnValue=false;"); 
</SCRIPT>

<frameset rows="30,*" frameborder="0" border="0" framespacing="0">
  <frame src="/dn/top.php" name="mainFrame" scrolling="NO" noresize="noresize">
<frameset id="frame-body" name="f3" rows="*" cols="0,10,*" frameborder="no" border="0" framespacing="0">
  <frame src="left_nav.php" name="leftFrame" scrolling="no" noresize="noresize">
  <frame src="scroller.php" name="leftFrame" scrolling="no" noresize="noresize">
<frame src=start.php?s=<?php echo $s;?>&roleid=<?php echo $roleid;?>&xl=<?php echo $_GET["xl"];?> name="topFrame"  noresize >

//<?php echo $name_str ;?>


</head>

</html>