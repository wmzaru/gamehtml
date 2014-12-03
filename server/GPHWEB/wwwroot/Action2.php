<?php
session_start();
include 'config.php';
include 'getfunction.php';




function getSign($user_id,$amount,$timestamp,$order_id)
{                
	$api_key="S1";
	$back_send="y";
	$currency="rmb";                
	$result=1;
	$server_id=999;                        
	$wanba_oid=$order_id;

	$sign="1"."amount".$amount."api_key".$api_key."back_send".$back_send."currency".$currency."order_id".$order_id."result".$result."server_id".$server_id."timestamp".$timestamp."user_id".$user_id."wanba_oid".$wanba_oid;
	$sign=strtoupper(MD5($sign));
	return $sign;
}


if ($_GET[go]=="logout") 
{
   setcookie("user", "", time()-36000);
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('您已经安全退出!');location.href='./';</script>";
   exit;
}

if ($_POST[go]=="login")
{
   $user=addslashes(trim($_POST['username']));
   $password=addslashes(trim($_POST['password']));
   if (strlen($user)<3)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('用户名不能少于3位，请重新输入!');history.go(-1);</script>";
      exit;
   }
   if (strlen($password)<3)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('请输入密码！密码太短了少于3位！');history.go(-1);</script>";
      exit;
   }
   $userinfo = mysql_query("SELECT * FROM account WHERE name='".$user."' AND password='".md5($password)."'");
   $num=mysql_num_rows($userinfo);
   if ($num==0)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('用户名或密码错误，请重新输入');history.go(-1);</script>";
      exit;
   } else 
   {
      $userinfo =mysql_fetch_array($userinfo);
      $user=strtolower($user);
	  $password=strtolower(md5($password));
      setcookie("user",$user.':'.md5($user.$password),time()+36000);
	  $ip=GetIP();
	  mysql_query("update account set logintime=now(),lastip='".$ip."' WHERE name='".$user."'");
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>location.href='user_index.php'</script>";
	  exit;
   }
}

if ($_POST[go]=="repass")
{
   ckdenglu();
   $password=addslashes(trim($_POST['password']));
   $newpassword=addslashes(trim($_POST['newpassword']));
    $newpassword2=addslashes(trim($_POST['newpassword2']));
   if (strlen($newpassword)<6)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('请输入密码！密码太短了少于6位！');history.go(-1);</script>";
      exit;
   }
   if($newpassword!=$newpassword2)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('两次输入密码不一样，请重新输入');history.go(-1);</script>";
      exit;
   }
   $userinfo = mysql_query("SELECT * FROM account WHERE name='".$GLOBALS["gname"]."' AND password='".md5($password)."'");
   $num=mysql_num_rows($userinfo);
   if ($num==0)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('原来的密码错误，请重新输入');history.go(-1);</script>";
      exit;
   } else 
   {
      $userinfo = mysql_fetch_array($userinfo);
	  if(mysql_query("update account set password='".md5($newpassword)."' WHERE name='".$GLOBALS["gname"]."'"))
	  {
	        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	        echo "<script>alert('修改密码成功！，请重新登陆！');location.href='login.php'</script>";
			exit;
	  }
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>alert('修改密码失败！');history.go(-1);</script>";
	  exit;
   }
}




if($_POST['go']=="register")
{
   $name=addslashes(trim($_POST['username']));
   $password=addslashes(trim($_POST['password']));
   $repassword=addslashes(trim($_POST['repassword']));
                          

   if($_SESSION[imageCode]!=$_POST['code'])
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('验证码错误，请重新输入');history.go(-1);</script>";
      exit;
	}
   if (strlen($name)<4)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('用户名不能少于3位，请重新输入');history.go(-1);</script>";
      exit;
	}
   if (strlen($password)<6)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('密码不能少于6位，请重新输入');history.go(-1);</script>";
      exit;
	}
   if ($password!=$repassword)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('两次输入密码不一样，请重新输入');history.go(-1);</script>";
      exit;
   }
 
   $getinfo=mysql_query("SELECT * FROM account WHERE name='".$name."'");
   $num=mysql_num_rows($getinfo);
   if ($num>=1)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('该用户名已经被注册，请用其他用户名注册。如果您忘记了密码，请通过安全码来重新设置密码。');history.go(-1);</script>";
	  exit;
   }

   $MD5id=md5($name.md5($password)."74gm");
   $getinfo=mysql_query("SELECT * FROM account WHERE namemd5id='".$MD5id."'");
   $num=mysql_num_rows($getinfo);
   while($num>=1)
   {
     $MD5id=md5($name.md5($password)."74gm".rand());
	 $getinfo=mysql_query("SELECT * FROM account WHERE namemd5id='".$MD5id."'");
	 $num=mysql_num_rows($getinfo);
   }
   $ip=GetIP();
   $zhucerow=mysql_fetch_array(mysql_query("SELECT * FROM zhuce"));
  if( mysql_query("INSERT INTO account (password,name,createtime,money,money2,jifen,gold,tg,tg2,namemd5id,regip,lastip) VALUES ('".md5($password)."','".$name."',NOW(),".$zhucerow[money].",".$zhucerow[money2].",".$zhucerow[jifen].",".$zhucerow[gold].",".$zhucerow[tg].",".$zhucerow[tg2].",'".$MD5id."','".$ip."','".$ip."')")==true)
  {
   $name=strtolower($name);
   $password=strtolower(md5($password));
   setcookie("user",$name.':'.md5($name.$password),time()+36000);
   if(isset($_SESSION[tg]))
   {
      $acrow=mysql_fetch_array(mysql_query("SELECT * FROM account where id=".$_SESSION[tg]));
	  $tginfo=mysql_query("SELECT * FROM tuiguang where ip='".$ip."' and time=DATE(now()) and tgr='".$acrow[name]."'");
	  $tgnum=mysql_num_rows($tginfo);
	  if($tgnum>=1)
	  {
	    mysql_query("INSERT INTO tuiguang (tgr,btg,ip,time,num) VALUES ('".$acrow[name]."','".$name."','".$ip."',DATE(now()),0)");
	  }else
	  {
	 // echo "INSERT INTO tuiguang (tgr,btg,ip,time,num) VALUES ('".$acrow[name]."','".$name."','".$ip."',DATE(),1)";
	   mysql_query("INSERT INTO tuiguang (tgr,btg,ip,time,num) VALUES ('".$acrow[name]."','".$name."','".$ip."',DATE(now()),1)");
	   mysql_query("update account set tg=tg+1,tg2=tg2+1 where id=".$_SESSION[tg]);
	  }
	  
      
	}
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('已经成功注册成为会员！');location.href='user_index.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('注册失败！SQL没有成功执行！');location.href='user_index.php'</script>";
   exit;
  }
}


if($_GET['go']=="libao")
{
   ckdenglu();
   $s=addslashes(trim($_GET['s']));
   $roleid=addslashes(trim($_GET['roleid']));
   $lb=addslashes(trim($_GET['lb']));
   
    $libaorow=mysql_fetch_array(mysql_query("SELECT * FROM libao_jilu WHERE roleid='".$roleid."' and libaoid='".$lb."'"));
	if($libaorow ==true)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('已经领取该礼包了！".$sid."');history.go(-1)</script>";
      exit;
   }
   
   $libaorow=mysql_fetch_array(mysql_query("SELECT * FROM libao_list WHERE id='".$lb."'"));
   
   $rolerow=mysql_fetch_array(mysql_query("SELECT * FROM roleid WHERE namemd5id='".$GLOBALS["gnamemd5id"]."' and  roleid='".$roleid."'"));
	if($rolerow==false)
    {
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<script>alert('不是你的角色！');history.go(-1)</script>";
		exit;
	 }
    $serverrow =mysql_fetch_array(mysql_query("SELECT * FROM server where id=".$s));
   if($serverrow ==false)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('选区错误！".$sid."');history.go(-1)</script>";
      exit;
   }
   $conn=mysql_connect($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass]);
	if($conn==false)
    {
	        include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库连接！');history.go(-1)</script>";
      exit;
    }
    if(mysql_select_db($serverrow[mysqlroledb],$conn)==false)
     {
             include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库选择！');history.go(-1)</script>";
      exit;
	  }
	 mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8"); 
	 $playerinfo=mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE user_id='".$roleid."'"));

	 if($playerinfo[level]<$libaorow[libao_level])
	 {
	  include 'config.php';
       echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
       echo "<script>alert('等级不够！');history.go(-1)</script>";
       exit;
	 }
	 //-----执行
	 
	 $b_time=time()."000";
	 $cheshi=0;
	 if($libaorow[libao_coin]!=0 || $libaorow[libao_gold]!=0)
	 {
	    mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8"); 
	   	$sqltem=mysql_fetch_array(mysql_query("SELECT count(*) FROM system_email"));
		$b_id=$sqltem[0]+1;
		mysql_query("SET NAMES 'gbk'");

		$sql="INSERT INTO system_email  (id,title,content,receiver_ids,jb,yb,create_time,valid_time) VALUES ('".$b_id."', '".$libaorow['libao_name']."', '".$libaorow[libao_content]."','".$playerinfo[id]."', ".$libaorow[libao_coin].", ".$libaorow[libao_gold].", ".$b_time.",".$b_time.")";
		
		$sql=iconv("UTF-8","gb2312",$sql);
		$myserr=mysql_query($sql);
		$ceshi=1;
		if($myserr==false)
		{
		    include 'config.php';
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	    	echo "<script>alert(''购买装备失败!');history.go(-1)</script>";
            exit;
		}
	 }
	 	
	
	 $libao_codearr=explode("|",$libaorow[libao_code]);
	 $arrcount=count($libao_codearr);
	 for($i=0;$i<$arrcount;$i++)
	 {
	    if($libao_codearr[$i]=="")
		{
		  continue;
		}
		for($ii=0;$ii<5;$ii++)
		{
		mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8"); 
		$sqltem=mysql_fetch_array(mysql_query("SELECT count(*) FROM system_email"));
		$b_id=$sqltem[0]+1;
        mysql_query("SET NAMES 'gbk'");
		$sql="INSERT INTO system_email  (id,title,content,receiver_ids,jb,yb,create_time,valid_time,attachments) VALUES ('".$b_id."', '".$libaorow['libao_name']."', '".$libaorow[libao_content]."','".$playerinfo[id]."', 0, 0, ".$b_time.",".$b_time.",'".$libao_codearr[$i]."')";
        //echo $sql;
		$sql=iconv("UTF-8","gb2312",$sql);
		$myserr=mysql_query($sql);
		if($ceshi==0)
	    {
		 $ceshi=1;
		 if($myserr==false)
		 {
	       include 'config.php';
   	       echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
           echo "<script>alert('领取失败！');history.go(-1)</script>";
          exit;
		 }
		}
		if($myserr==true)
		{
		 break;
		}
		}
	 }
	 
	 include 'config.php';
	  mysql_query("INSERT INTO libao_jilu (server,roleid,libaoid) VALUES ('".$s."','".$roleid."','".$lb."')");
	mysql_query("INSERT INTO xiaofei (name,roleid,rolename,lx,H_lxnum,H_lx,D_lxnum,D_lx,time) VALUES ('".$GLOBALS["gname"]."','".$roleid."','".$playerinfo[name]."','礼包','".$playerinfo[level]."','等级',1,'".$libaorow[libao_name]."',NOW())");
	  echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('领取完成！');history.go(-1)</script>";
      exit;
   

   
}

if($_POST[go]=="buy_shop")
{
   ckdenglu();
   $shop_id=addslashes(trim($_POST['shop_id']));
   $serverandrole=addslashes(trim($_POST['serverandrole']));
   $roleChk=addslashes(trim($_POST['roleChk']));
   $tem=explode(":",$serverandrole);
   $sid=$tem[0];
   $player_id=$tem[1];
   
   	$rolerow=mysql_fetch_array(mysql_query("SELECT * FROM roleid WHERE namemd5id='".$GLOBALS["gnamemd5id"]."' and  roleid='".$player_id."'"));
	if($rolerow==false)
    {
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<script>alert('不是你的角色！');history.go(-1)</script>";
		exit;
	 }
   
   if($roleChk!=1)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('请先勾选！');history.go(-1)</script>";
      exit;
   }
   
   if($sid=="" || $player_id=="")
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('你还没有角色呢！');history.go(-1)</script>";
      exit;
   }
   
   $shoprow =mysql_fetch_array(mysql_query("SELECT * FROM shop_list where id=".$shop_id));
   if($shoprow==false)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('没有这个商品！');history.go(-1)</script>";
      exit;
   }
   $accountrow =mysql_fetch_array(mysql_query("SELECT * FROM account where name='".$GLOBALS["gname"]."' and ".$shoprow[shop_prick_type].">=".$shoprow[shop_prick]));
   if($accountrow==false)
     {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<script>alert('你的钱不够啊！');history.go(-1)</script>";
        exit;
     }
 
   $serverrow =mysql_fetch_array(mysql_query("SELECT * FROM server where id=".$sid));
   if($serverrow ==false)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('选区错误！".$sid."');history.go(-1)</script>";
      exit;
   }
    $conn=mysql_connect($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass]);
	if($conn==false)
    {
	        include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库连接！');history.go(-1)</script>";
      exit;
    }
    if(mysql_select_db($serverrow[mysqlroledb],$conn)==false)
     {
             include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库选择！');history.go(-1)</script>";
      exit;
	  }
	 mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8"); 
	// echo $player_id;
     $playerinfo=mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE user_id='".$player_id."'"));
	 

	
	
	$b_time=time()."000";
	$ceshi=0;
	$shop__codearr=explode("|",$shoprow[shop_code]);
	$arrcount=count($shop__codearr);
	 for($i=0;$i<$arrcount;$i++)
	 {
	     if($shop__codearr[$i]=="")
		{
		  continue;
		}
	    for($ii=0;$ii<5;$ii++)
		{
		mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8"); 
		$sqltem=mysql_fetch_array(mysql_query("SELECT count(*) FROM system_email"));
		$b_id=$sqltem[0]+1;
        mysql_query("SET NAMES 'gbk'");
		$sql="INSERT INTO system_email  (id,title,content,receiver_ids,jb,yb,create_time,valid_time,attachments) VALUES ('".$b_id."', '".$shoprow['shop_name']."', '".$shoprow[shop_content]."','".$playerinfo[id]."', 0, 0, ".$b_time.",".$b_time.",'".$shop__codearr[$i]."')";
        //echo $sql;
		$sql=iconv("UTF-8","gb2312",$sql);
		$myserr=mysql_query($sql);
		if($ceshi==0)
	    {
		 $ceshi=1;
		 if($myserr==false)
		 {
		    include 'config.php';
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	    	echo "<script>alert(''购买装备失败!');history.go(-1)</script>";
            exit;
		 }
		}
		if($myserr==true)
		{
		 break;
		}
		}
	}
	include 'config.php';
	mysql_query("update account set ".$shoprow[shop_prick_type]."=".$shoprow[shop_prick_type]."-".$shoprow[shop_prick]." where name='".$GLOBALS["gname"]."'");
	mysql_query("INSERT INTO xiaofei (name,roleid,rolename,lx,H_lxnum,H_lx,D_lxnum,D_lx,time) VALUES ('".$GLOBALS["gname"]."','".$player_id."','".$playerinfo[name]."','商城','".$shoprow[shop_prick]."','".Getshoptype($shoprow[shop_prick_type])."',1,'".$shoprow[shop_name]."',NOW())");
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    echo "<script>alert('购买装备成功！');history.go(-1)</script>";
    exit;
}


if($_POST[go]=="duihuan_gold")
{
   ckdenglu();
   $dhid=addslashes(trim($_POST['dhid']));
   $dhs=(int)addslashes(trim($_POST['dhs']));
   $serverandrole=addslashes(trim($_POST['serverandrole']));
   $tem=explode(":",$serverandrole);
   $sid=$tem[0];
   $roleid=$tem[1];

   
   if($dhid<10)
   {
   exit;
   }
  $duihuanrow=mysql_fetch_array(mysql_query("SELECT * FROM duihuan WHERE kaifang=1 and id=".$dhid));
   if($duihuanrow==false)
   {
   exit;
   }
   $bilitem=explode(":",$duihuanrow[bili]);
   $duihuantem=explode("to",$duihuanrow[duihuan]);
   if($duihuantem[1]!="ggold")
   {
    exit;
   }
   if($dhs<$bilitem[0])
   {
   
   
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('最少输入".$bilitem[0]."！');location.href='duihuan.php'</script>";
	  exit;
   }
   if($dhs%$bilitem[0])
   {
       	 echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		 echo "<script>alert('请按倍数输入！');location.href='duihuan.php'</script>";
         exit;
   }
   
    $userinfo = mysql_fetch_array(mysql_query("SELECT * FROM account WHERE name='".$GLOBALS["gname"]."'"));
    if($userinfo[$duihuantem[0]]<$dhs)
	{
		 echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
         echo "<script>alert('你身上的".Getshoptype($duihuantem[0])."不够！');location.href='duihuan.php'</script>";
	      exit;
	}
	$addnum=($dhs/$bilitem[0])*$bilitem[1];
	
	$serverinfo =mysql_fetch_array(mysql_query("SELECT * FROM server WHERE id=".$sid));
    if($serverinfo==false)
    {
           echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
            echo "<script>alert('没有找到这个区！');location.href='duihuan.php'</script>";
            exit;
    }
	$rolerow=mysql_fetch_array(mysql_query("SELECT * FROM roleid WHERE namemd5id='".$GLOBALS["gnamemd5id"]."' and  roleid='".$roleid."'"));
	if($rolerow==false)
    {
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<script>alert('不是你的角色！');location.href='duihuan.php'</script>";
		exit;
	 }
	 
	$serverrow =mysql_fetch_array(mysql_query("SELECT * FROM server where id=".$sid));
   if($serverrow ==false)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('选区错误！".$sid."');history.go(-1)</script>";
      exit;
   }
    $conn=mysql_connect($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass]);
	if($conn==false)
    {
	        include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库连接！');history.go(-1)</script>";
      exit;
    }
    if(mysql_select_db($serverrow[mysqlroledb],$conn)==false)
     {
             include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库选择！');history.go(-1)</script>";
      exit;
	 }
	 mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8"); 
	// echo $player_id;
	 
     $playerinfo=mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE user_id='".$roleid."'"));
	 $sqltem=mysql_fetch_array(mysql_query("SELECT count(*) FROM system_email"));
	 $b_id=$sqltem[0]+1;
	 //$b_id="fu0EM1-1-1-".$b_id;
	 $b_time=time()."000";
	 mysql_query("SET NAMES 'gbk'");
	 
	 $sql="INSERT INTO system_email  (id,title,content,receiver_ids,jb,yb,create_time,valid_time) VALUES ('".$b_id."', '充值领取', '充值领取','".$playerinfo[id]."', 0, ".$addnum.", ".$b_time.",".$b_time.")";
	 $sql=iconv("UTF-8","gb2312",$sql);
	 //echo $sql;
	 if(mysql_query($sql)==true)
        {
               include 'config.php';
	           mysql_query("INSERT INTO xiaofei (name,roleid,rolename,lx,H_lxnum,H_lx,D_lxnum,D_lx,time) VALUES ('".$GLOBALS["gname"]."','".$roleid."','".$playerinfo[name]."','角色充值','".$dhs."','".Getshoptype($duihuantem[0])."','".$addnum."','游戏元宝',NOW())");
	           mysql_query("update account set ".$duihuantem[0]."=".$duihuantem[0]."-".$dhs." where name='".$GLOBALS["gname"]."'");
			   
		        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
                echo "<script>alert('充值成功！');location.href='duihuan.php'</script>";
               exit;
        }else
	{
	  include 'config.php';
   	   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        //echo "<script>alert('充值失败！');location.href='duihuan.php'</script>";
       exit;
	}

}

if($_POST[go]=="duihuan_hu")
{
   ckdenglu();
   $dhid=addslashes(trim($_POST['dhid']));
   $dhs=(int)addslashes(trim($_POST['dhs']));

   if($dhid>9)
   {
   exit;
   }
  $duihuanrow=mysql_fetch_array(mysql_query("SELECT * FROM duihuan WHERE kaifang=1 and id=".$dhid));
   if($duihuanrow==false)
   {
   exit;
   }
   $bilitem=explode(":",$duihuanrow[bili]);
   $duihuantem=explode("to",$duihuanrow[duihuan]);
   if($dhs<$bilitem[0])
   {
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('最少输入".$bilitem[0]."！');location.href='duihuan.php'</script>";
	  exit;
   }
   if($dhs%$bilitem[0])
   {
       	 echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		 echo "<script>alert('请按倍数输入！');location.href='duihuan.php'</script>";
         exit;
   }
   
    $userinfo = mysql_fetch_array(mysql_query("SELECT * FROM account WHERE name='".$GLOBALS["gname"]."'"));
    if($userinfo[$duihuantem[0]]<$dhs)
	{
		 echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
         echo "<script>alert('你身上的".Getshoptype($duihuantem[0])."不够！');location.href='duihuan.php'</script>";
	      exit;
	}
	$addnum=($dhs/$bilitem[0])*$bilitem[1];
	if(mysql_query("update account set ".$duihuantem[0]."=".$duihuantem[0]."-".$dhs.",".$duihuantem[1]."=".$duihuantem[1]."+".$addnum." where name='".$GLOBALS["gname"]."'"))
	{
	
		mysql_query("INSERT INTO xiaofei (name,roleid,rolename,lx,H_lxnum,H_lx,D_lxnum,D_lx,time) VALUES ('".$GLOBALS["gname"]."','','','站内兑换','".$dhs."','".Getshoptype($duihuantem[0])."','".$addnum."','".Getshoptype($duihuantem[1])."',NOW())");
	
	
     	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
         echo "<script>alert('充值成功！');location.href='duihuan.php'</script>";
    exit;
	}
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    echo "<script>alert('充值失败！');location.href='duihuan.php'</script>";
    exit;
}
?>