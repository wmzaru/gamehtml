<?php
session_start();//开启session;
include 'config.php';
include 'mianfei.php';

function ckcookie()
{
   $GLOBALS["gcook"]=0;
   if (isset($_COOKIE["user"]))
   {   
       $m=explode(":",$_COOKIE["user"]);
       $userinfo = mysql_fetch_array(mysql_query("SELECT * FROM account WHERE name='".addslashes($m[0])."'"));
       if ($userinfo)
       {
	      $pass=strtolower($userinfo[password]);
	      if(md5($m[0].$pass)==$m[1])
		  {
		  $GLOBALS["gcook"]=1;
		  $GLOBALS["gname"]=$userinfo[name];
		  $GLOBALS["gnamemd5id"]=$userinfo[namemd5id];
		  $GLOBALS["gcreatetime"]=$userinfo[createtime];
		  $GLOBALS["gmoney"]=$userinfo[money];
		  $GLOBALS["gmoney2"]=$userinfo[money2];
		  $GLOBALS["gjifen"]=$userinfo[jifen];
		  $GLOBALS["ggold"]=$userinfo[gold];
		  $GLOBALS["gtg"]=$userinfo[tg];
		  $GLOBALS["gtg2"]=$userinfo[tg2];
		  $GLOBALS["ggold"]=$userinfo[gold];
		  $GLOBALS["gid"]=$userinfo[id];
		  $GLOBALS["ggoldconut"]=$userinfo[goldconut];
		  $GLOBALS["gregip"]=$userinfo[regip];
		  
		  }

		}
	}

}
function GetServer()
{
$GLOBALS["gservernameconut"]=1;
 if($GLOBALS["gcook"]==0)
 return;
$info = mysql_query("SELECT * FROM server");
$num=mysql_num_rows($info);
if($num==0)
return ;
$GLOBALS["gservernameconut"]=$num;
for($i=0;$i<$num;$i++)
{
  $row=mysql_fetch_array($info);
  $GLOBALS["gservername"][i]=$row[servername];
  $GLOBALS["gserverid"][i]=$row[id];
  $mysqlip[i]=$row[mysqlip];
  $mysqlname[i]=$row[mysqlname];
  $mysqlpass[i]=$row[mysqlpass];
  $mysqlroledb[i]=$row[mysqlroledb];
  $mysqlconfigdb[i]=$row[mysqlconfigdb];
  
  $roleinfo=mysql_query("SELECT * FROM roleid WHERE serverid=".$row[id]." and name='".$GLOBALS["gname"]."'");
  $num1=mysql_num_rows($roleinfo);
  if ($num1)
  {
    $roleinfo=mysql_fetch_array($roleinfo);
    $rolemd5id[i]=$roleinfo[namemd5id];
  }else
  {
    $rolemd5id[i]=0;
  }
}
for($i=0;$i<$GLOBALS["gservernameconut"];$i++)
{
$GLOBALS["grolecunzai"]=0;
if($rolemd5id[i]!=0)
{
$conn=mysql_connect($mysqlip[i],$mysqlname[i],$mysqlpass[i]);
mysql_select_db($mysqlroledb[i],$conn);
mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
$playerinfo=mysql_fetch_array(mysql_query("SELECT * FROM t_player WHERE username='". $rolemd5id[i]."'"));
if($playerinfo)
{
$GLOBALS["grolecunzai"]=1;
$GLOBALS["grolename"][i]=$playerinfo[name];
$GLOBALS["groleid"][i]=$playerinfo[player_id];
$GLOBALS["grolelevel"][i]=$playerinfo[level];
$playerinfo=mysql_fetch_array(mysql_query("SELECT * FROM t_player_role WHERE player_id=".$GLOBALS["groleid"][i]));
$GLOBALS["groleexperience"][i]=$playerinfo[experience ];
$GLOBALS["grolelife "][i]=$playerinfo[life ];
$GLOBALS["grolemana"][i]=$playerinfo[mana];
$playerinfo=mysql_fetch_array(mysql_query("SELECT * FROM t_player_extend_2 WHERE player_id=".$GLOBALS["groleid"][i]));
$GLOBALS["groleonline"][i]=$playerinfo[online];
$GLOBALS["grolelast_offline_dt"][i]=$playerinfo[last_offline_dt];
$playerinfo=mysql_fetch_array(mysql_query("SELECT * FROM t_player_money  WHERE player_id=".$GLOBALS["groleid"][i]));
$GLOBALS["grolegold_bind"][i]=$playerinfo[gold_bind];
$GLOBALS["grolecoin_bind"][i]=$playerinfo[coin_bind];
$GLOBALS["grolegold"][i]=$playerinfo[gold];
$GLOBALS["grolecoin"][i]=$playerinfo[coin];
$GLOBALS["grolepoint"][i]=$playerinfo[point];
$GLOBALS["grolehonour"][i]=$playerinfo[honour];
$GLOBALS["grolearena"][i]=$playerinfo[arena];
$GLOBALS["groleinter_honour"][i]=$playerinfo[inter_honour];
$GLOBALS["grolemagic_stone"][i]=$playerinfo[magic_stone];
$GLOBALS["grolemerit"][i]=$playerinfo[merit];
}
}
}
}

function buy_shop_show()
{
    if($GLOBALS["gcook"]==0)
	{
	    return "<div class=\"act_btn\"><a href=\"login.php\" class=\"bt_but c_1_g mr10 tips\"><u></u>请登录...</a></div>";
		exit;
	}else
	{
	$str1= "<div class=\"act_btn\"><div> 角色：<select name=\"serverandrole\" id=\"role3\" style=\"width:115px;\">";
	$str3="</select><input type=\"checkbox\" name=\"roleChk\" value=\"1\"></div>
	<INPUT type=\"submit\"  value=\"购买选中物品\" />
		</div>";
	    
	    $serverinfo =mysql_query("SELECT * FROM server");
	    $servernum=mysql_num_rows($serverinfo);
	    for($i=0;$i<$servernum;$i++)
	    {
		include 'config.php';
	    $serverrow=mysql_fetch_array($serverinfo);
		
		$playerinfo=mysql_query("SELECT * FROM roleid WHERE namemd5id='". $GLOBALS["gnamemd5id"]."' and serverid='".$serverrow[id]."'");
		$num1=mysql_num_rows($playerinfo);
		
        $conn=mysql_connect($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass]);
	    if($conn==false)
        {
		    //include 'config.php';
            //return "连接数据库失败！请检查”".$serverrow[servername]."“的数据库配置信息!";
            continue;
        }
        if(mysql_select_db($serverrow[mysqlroledb],$conn)==false)
         {
               //          include 'config.php';
            // return "选择角色数据库失败!请检查”".$serverrow[servername]."“的数据库配置信息!";
            continue;
		}
         mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
		 for($ii=0;$ii<$num1;$ii++)
		 {
		$playerrow=mysql_fetch_array($playerinfo);
	   $roleinfo=mysql_query("SELECT * FROM user_role WHERE user_id='". $playerrow["roleid"]."'");
		$numrole=mysql_num_rows($roleinfo);
		if($numrole==0)
		{
		continue;
		}else
		{
		
		$rolerow=mysql_fetch_array($roleinfo);
		   $str1=$str1."<option value=\"".$serverrow[id].":".$playerrow["roleid"]."\">".$serverrow[servername].":".$rolerow[name]."</option>";
		}

		 }
		 }
		include 'config.php';
		return $str1= $str1.$str3;
		exit;
	}
}
		 

function ckdenglu()
{
  if(isset($GLOBALS["gcook"])==false)
  {
  ckcookie();
  }
  if($GLOBALS["gcook"]==0)
  {
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
     echo "没有登陆！";
     exit;
  }
}



function ConnectMysql($mysqlip,$mysqlname,$mysqlpass,$mysqlroledb,$servername)
{
  $conn=mysql_connect($mysqlip,$mysqlname,$mysqlpass);
    if($conn==false)
    {
		//include 'config.php';
       // return "连接数据库失败！请检查”".$serverrow[servername]."“的数据库配置信息!";
       // exit;
	  
	   $str=$str."连接数据库失败！请检查”".$servername."“的数据库配置信息!";
	    continue;
	   
    }
    if(mysql_select_db($mysqlroledb,$conn)==false)
    {
        //include 'config.php';
        //return "选择角色数据库失败!请检查”".$serverrow[servername]."“的数据库配置信息!";
        //exit;
		$str=$str."选择角色数据库失败!请检查”".$servername."“的数据库配置信息!";
		continue;
	}
    mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
}
function GetlibaoList()
{
$libaoinfo = mysql_query("SELECT * FROM libao_list");
$num=mysql_num_rows($libaoinfo);
$str="<p>领取礼包：";

for($i=0;$i<$num;$i++)
{
    $libaorow=mysql_fetch_array($libaoinfo);
	$str=$str."<a href=\"wdAction.php?go=libao&s=[server]&roleid=[roleid]&lb=".$libaorow[id]."\" title=\"".$libaorow[libao_content]."\" class=\"bt_but c_1_g mr10 tips\"><u></u>".$libaorow[libao_name]."</a>";
}
return $str."</p>";
}


function GetRoleList()
{
ckdenglu();




$libaostr=GetlibaoList();
$mianfeistr=GetmianfeiList();
$libaostrA=$libaostr;
$mianfeistrA=$mianfeistr;

	    $baserow=mysql_fetch_array(mysql_query("SELECT * FROM base where name='rolenum'"));
		$rolenum=$baserow[text];

$serverinfo = mysql_query("SELECT * FROM server");
$num=mysql_num_rows($serverinfo);
$str="";
if($num==0)
{
return "<div id=\"tabs\" class=\"ui_tabs\"> 还没有建立新区！请进入后台添加</div>";
}

for($i=0;$i<$num;$i++)
{
    include 'config.php';
    $serverrow=mysql_fetch_array($serverinfo);
  
    $playerinfo=mysql_query("SELECT * FROM roleid WHERE namemd5id='". $GLOBALS["gnamemd5id"]."' and serverid='".$serverrow[id]."'");
    $num1=mysql_num_rows($playerinfo);

    if($num1==0)
    {
	$str=$str."            <div id=\"tabs".$i."\" class=\"ui_tabs\">
                <ul>
                    <li><a href=\"#tabs-".$i.($ii+1)."\">".$serverrow[servername]."</a></li>
                </ul>
                <div id=\"tabs-".$i.($ii+1)."\">
                    <p>还没有创建角色.</p><p><p>便捷操作：<a  href=\"togame.php?s=".$serverrow[id]."&xl=dx\" togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>创建角色(电信)</a><a  href=\"togame.php?s=".$serverrow[id]."&xl=wt\" togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>创建角色(网通)</a></p>
                </div>
            </div><script type=\"text/javascript\">
            $(function () {
                $.ajaxSetup({ cache: false });
                $(\"#tabs".$i."\").tabs();
            })</script>";
    }else
	{
	    ConnectMysql($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass],$serverrow[mysqlroledb],$serverrow[servername]);
	    $str=$str."<div id=\"tabs".$i."\" class=\"ui_tabs\">
                <ul>";
	    for($ii=0;$ii<$num1;$ii++)
       {
	   
            $playerrow=mysql_fetch_array($playerinfo);
			$roleinfo=mysql_query("SELECT * FROM user_account WHERE user_guid='". $playerrow["roleid"]."'");//查询是否在服务端输入了账号
			$numrole=mysql_num_rows($roleinfo);
			if($numrole==0)
			{
			$str=$str."<li><a href=\"#tabs-".$i.($ii+1)."\">".$serverrow[servername].":无角色</a></li>";
			}else
			{
			$rolerow=mysql_fetch_array($roleinfo);
			$role1info=mysql_query("SELECT * FROM user_role WHERE user_id='". $playerrow["roleid"]."'");
			$role1row=mysql_fetch_array($role1info);
			$str=$str."<li><a href=\"#tabs-".$i.($ii+1)."\">".$serverrow[servername].":".$role1row[name]."</a></li>";
			}
       }
	   if($num1<$rolenum)
	   {
	   	$str=$str."<li><a href=\"#tabs-".$i.$rolenum."\">".$serverrow[servername].":新角色</a></li>";
		}
		
  	    $str=$str."</ul>";
		include 'config.php';
		$playerinfo=mysql_query("SELECT * FROM roleid WHERE namemd5id='". $GLOBALS["gnamemd5id"]."' and serverid='".$serverrow[id]."'");
		$num1=mysql_num_rows($playerinfo);
		ConnectMysql($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass],$serverrow[mysqlroledb],$serverrow[servername]);
		for($ii=0;$ii<$num1;$ii++)
       {
            $playerrow=mysql_fetch_array($playerinfo);
			
			$roleinfo=mysql_query("SELECT * FROM user_account WHERE user_guid='". $playerrow["roleid"]."'");
			$numrole=mysql_num_rows($roleinfo);
			if($numrole==0)
			{
			$str=$str."<div id=\"tabs-".$i.($ii+1)."\">
                    <p>还没有创建角色.</p><p><p>便捷操作：<a  href=\"togame.php?s=".$serverrow[id]."&roleid=".$playerrow["roleid"]."&xl=dx\" togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>创建角色(电信)</a><a  href=\"togame.php?s=".$serverrow[id]."&roleid=".$playerrow["roleid"]."&xl=wt\" togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>创建角色(网通)</a></p>
                </div>";
			
			}else
			{
			$rolerow=mysql_fetch_array($roleinfo);
			$role1info=mysql_query("SELECT * FROM user_role WHERE user_id='". $playerrow["roleid"]."'");
			$role1row=mysql_fetch_array($role1info);
			$role2info=mysql_query("SELECT * FROM role_account WHERE user_role_id='". $role1row["id"]."'");
			$role2row=mysql_fetch_array($role2info);
			
			
			
			$jinding=$role1row[paymoney]+$role1row[outlineCharge];
			$tem2=(int)($role1row[onlineTime]/60)."分钟";
			$libaostr=$libaostrA;
			$libaostr=str_replace("[server]",$serverrow[id],$libaostr);
			$libaostr=str_replace("[roleid]",$playerrow["roleid"],$libaostr);
			$mianfeistr=$mianfeistrA;
			$mianfeistr=str_replace("[server]",$serverrow[id],$mianfeistr);
			$mianfeistr=str_replace("[roleid]",$playerrow["roleid"],$mianfeistr);
			
			
			if($role1row[job]=="A")
			{
			 $zhiye="灵猴";
			}else if($role1row[job]=="B")
			{
			 $zhiye="九尾";
			}else if($role1row[job]=="C")
			{
			 $zhiye="牛魔";
			}else if($role1row[job]=="D")
			{
			 $zhiye="罗刹";
			}
			
			
			
			$str=$str."<div id=\"tabs-".$i.($ii+1)."\">
                    <p>角色名：<b class=\"orange\">".$role1row[name]."</b><b class=\"segmentation\"></b>职业：<b class=\"orange\">".$zhiye."</b><b class=\"segmentation\"></b>角色等级：<b class=\"orange\">".$role1row[level]."</b><b class=\"segmentation\"></b>角色经验：<b class=\"orange\">".$role1row[exp]."</b></p><p>元宝：<b class=\"orange\">".$rolerow[lingshi]."</b><b class=\"segmentation\"></b>铜钱：<b class=\"orange\">".$role2row[tongqian]."</b><b class=\"segmentation\"></b>绑定元宝：<b class=\"orange\">".$role2row[bind_lingshi]."</b></p><p>真气：<b class=\"orange\">".$role1row[zhenqi]."</b></p><p>便捷操作：<a  href=\"togame.php?s=".$serverrow[id]."&roleid=".$playerrow["roleid"]."&xl=dx\"  togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>进入游戏(电信)</a><a  href=\"togame.php?s=".$serverrow[id]."&roleid=".$playerrow["roleid"]."&xl=wt\"  togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>进入游戏(网通)</a></p>".$libaostr.$mianfeistr."
                </div>";
			}
       }
	   if($num1<$rolenum)
	   {
	   	$str=$str."<div id=\"tabs-".$i.$rolenum."\">
                    <p>还没有创建角色.</p><p><p>便捷操作：<a  href=\"togame.php?s=".$serverrow[id]."&xl=dx\" togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>创建角色(电信)</a><a  href=\"togame.php?s=".$serverrow[id]."&xl=wt\" togame.php class=\"bt_but c_1_g mr10 tips\"><u></u>创建角色(网通)</a></p>
                </div>";
		}
	   
	   $str=$str."</div><script type=\"text/javascript\">
            $(function () {
                $.ajaxSetup({ cache: false });
                $(\"#tabs".$i."\").tabs();
            })</script>";
	   
    }

}
return $str;
}

function GetTG()
{
if(isset($_GET["sid"]))
{
 $_SESSION[tg]=addslashes(trim($_GET["sid"]));
}
if(isset($_GET["Sid"]))
{
 $_SESSION[tg]=addslashes(trim($_GET["Sid"]));
}
if(isset($_GET["SID"]))
{
 $_SESSION[tg]=addslashes(trim($_GET["SID"]));
}
}

function Getshoptype($str)
{

  if($str=="money")
  {
    return "现金";
  }else if($str=="jifen")
  {
    return "积分";
  }else if($str=="gold")
  {
    return "元宝";
  }else if($str=="tg")
  {
    return "推广";
  }else if($str=="ggold")
  {
    return "元宝";
  }

  //$row=mysql_fetch_array(mysql_query("SELECT * FROM money_name where  money_type='".$str."'"));
}

function GetIP()
{
if(!empty($_SERVER["HTTP_CLIENT_IP"]))
   $cip = $_SERVER["HTTP_CLIENT_IP"];
else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
   $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
else if(!empty($_SERVER["REMOTE_ADDR"]))
   $cip = $_SERVER["REMOTE_ADDR"];
else
   $cip = "";
return $cip;
}
?>