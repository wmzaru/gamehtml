<?php
include '../config.php';
include '../getfunction.php';
ckdenglu();

//此文件用来领取铜钱和绑定元宝
//参数一定义 领取多少次
//参数二定义 多少级领取
//参数三定义 消耗类型  money为现金 jifen为积分 tg为推广 gold为站内元宝
//参数四定义 消耗值和参数三关联
//参数五定义 变身ID
//参数六定义 变身技能

$roleid=addslashes(trim($_GET['roleid']));
$server=addslashes(trim($_GET['s']));
$cj=addslashes(trim($_GET['cj']));
$mf_name=$cj;
$chajian_row=mysql_fetch_array(mysql_query("SELECT * FROM chajian WHERE tingyong<>1 and id = ".$cj));
if($chajian_row==false)
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script>alert('没有这插件,或者插件没有启用！');history.go(-1);</script>";
	exit;
}

$userinfo = mysql_fetch_array(mysql_query("SELECT * FROM account WHERE name='".$GLOBALS["gname"]."'"));
if($userinfo[$chajian_row['canshu3']]<$chajian_row['canshu4'])
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script>alert('你身上的".Getshoptype($chajian_row['canshu3'])."不够".$chajian_row['canshu4']."！');history.go(-1);</script>";
	exit;
}


rolejc($roleid);
$mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
$mf_num=mysql_num_rows($mf_info);

if($mf_num<$chajian_row['canshu1'])
	{
	    if(ConnectMysqlServer_NO_err($server)==0)
		{
		   exit;
		}
		
		$user_role_row = mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE user_id='".$roleid."'"));
        if($user_role_row==false)
        {
           echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		   echo "<script>alert('没有这个角色！');history.go(-1);</script>";
           exit;
        }
        if($user_role_row['online_time']>$user_role_row['offline_time'])
        {
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		    echo "<script>alert('只有角色下线才能兑换！');history.go(-1);</script>";
           exit;
        }
		if($user_role_row[level]<$chajian_row['canshu2'])
		{
		  echo "<meta http-equiv=\"Content-Type\" content=\"text ml; charset=utf-8\" />";
		  echo "<script> alert('不够".$chajian_row['canshu2']."级！');history.go(-1);</script>";
		  exit;
		}
		//上面为判断语句不用动
		
		
		$ES='{"'.$chajian_row[canshu6].'1":50,"'.$chajian_row[canshu6].'2":50,"'.$chajian_row[canshu6].'3":50,"'.$chajian_row[canshu6].'4":50,"'.$chajian_row[canshu6].'5":50}';
		$bs='{"wuhun":1}';
		$uid=md5($user_role_row[id].$chajian_row[canshu5]);
		$sql="INSERT INTO role_shenjiang VALUES ('".$uid."','".$user_role_row[id]."', '".$chajian_row[canshu5]."', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'".$ES."','".$bs."',localtime());";
		if(mysql_query($sql)==true)
		{
		
		include '../config.php';
		 mysql_query("update account set ".$chajian_row['canshu3']."=".$chajian_row['canshu3']."-".$chajian_row['canshu4']." where name='".$GLOBALS["gname"]."'");
		$sql="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
		
	}
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
	exit;

function rolejc($roleid)
{
$rolerow=mysql_fetch_array(mysql_query("SELECT * FROM roleid WHERE namemd5id='".$GLOBALS["gnamemd5id"]."' and  roleid='".$roleid."'"));
	if($rolerow==false)
    {
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<script>alert('不是你的角色！');history.go(-1);</script>";
		exit;
	 }
}

?>