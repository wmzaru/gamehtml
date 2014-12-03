<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
我要兑换-<?=$webname;?>
</title>
<link href="css/BasicStyle.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js" type="text/javascript" charset="UTF-8"></script></head>

<body id="loadding">

<?php
	require "header.php";
?>

    <div class="center clearfix mt10">

        <div class="c_main">

<?php
	require "user_left.php";
	//         .basicInfo_currency { border-left: 1px solid #E5E5E5; float: left; height: 145px; width: 262px; margin: 22px 0 0 10px; }
?>



        <div class="basicInfo_currency" style="width: 800px;height: 70px;">
		<table border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center">
   <tbody><tr style="color:#CC3300;" onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="">    
    <td height="25" align="center" valign="middle" colspan="10">推广记录</td>
  </tr><tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td width="6%" align="center" valign="middle"><?=Getshoptype("money");?></td>
    <td width="6%" align="center" valign="middle"><?=Getshoptype("jifen");?></td>
	<td width="6%" align="center" valign="middle"><?=Getshoptype("gold");?></td>
	<td width="6%" align="center" valign="middle"><?=Getshoptype("tg");?></td>

  </tr>
 <tr onmouseover="this.className='mouseon'" style="color:#CC3300;" onmouseout="this.className='';" class="">
    <td align="center" valign="middle"><?=$GLOBALS["gmoney"];?></td>
    <td align="center" valign="middle"><?=$GLOBALS["gjifen"];?></td>
    <td align="center" valign="middle"><?=$GLOBALS["ggold"];?></td>
	<td align="center" valign="middle"><?=$GLOBALS["gtg"];?></td>
  </tr>

</tbody></table>
            
        </div>
<div class="center_right ml10">

<?php
$duihuaninfo=mysql_query("SELECT * FROM duihuan WHERE kaifang=1 and id>9 and id<14");
$num=mysql_num_rows($duihuaninfo);
$str="";
if($num>0)
{
$str="<div class=\"mybox\">
        <div class=\"mytit\">
            <span style=\"color:red\">给游戏内角色充值元宝[在邮箱里收取]</span>
        </div>
		   ";
$str1="";
for($i=0;$i<$num;$i++)
{
   $row=mysql_fetch_array($duihuaninfo);
   $tem1=explode("to",$row[duihuan]);
   $tem3=$tem1;
   $tem2=explode(":",$row[bili]);
   
   $tem1[0]=Getshoptype($tem1[0]);
   $tem1[1]=Getshoptype($tem1[1]);
   $str=$str."<div class=\"con clearfix\"><form action=\"Action.php\" method=\"post\" ><p style=\"margin-bottom:10px;\">".$tem1[0]."换".$tem1[1]."的比例是:".$tem2[0].":".(int)($tem2[1]*1)."(".$tem2[0].$tem1[0]."换".(int)($tem2[1]*1)."个".$tem1[1].")"."</p>使用<input type=\"text\" name=\"dhs\" id=\"dhnum\" width=\"100px\">".$tem1[0]."给角色".$userlist."充值元宝.<INPUT type=\"hidden\" value=\"".$row[id]."\" name=\"dhid\"><INPUT type=\"hidden\" value=\"duihuan_gold\" name=\"go\"><input type=\"submit\" class=\"btn80_1\" name=\"Submit\" id=\"submit\" value=\"充值\"><font color=\"#FF0000\">(您拥有".$moneyinfo[$tem3[0]].$tem1[0].")</font></form></div>";

}
echo $str."</div>";
}
?>


<?php
$duihuaninfo=mysql_query("SELECT * FROM duihuan WHERE kaifang=1 and id>13");
$num=mysql_num_rows($duihuaninfo);
$str="";
if($num>0)
{
$str="<div class=\"mybox\">
        <div class=\"mytit\">
            <span style=\"color:red\">角色元宝兑换网站货币[角色请先下线]</span>
        </div>
		   ";
$str1="";
for($i=0;$i<$num;$i++)
{
   $row=mysql_fetch_array($duihuaninfo);
   $tem1=explode("to",$row[duihuan]);
   $tem3=$tem1;
   $tem2=explode(":",$row[bili]);
   
   $tem1[0]=Getshoptype($tem1[0]);
   $tem1[1]=Getshoptype($tem1[1]);
   $str=$str."<div class=\"con clearfix\"><form action=\"Action.php\" method=\"post\" ><p style=\"margin-bottom:10px;\">".$tem1[0]."换".$tem1[1]."的比例是:".$tem2[0].":".(int)($tem2[1]*1)."(".$tem2[0].$tem1[0]."换".(int)($tem2[1]*1)."个".$tem1[1].")"."</p>使用".$userlist."多少元宝给账号<input type=\"text\" name=\"dhs\" id=\"dhnum\" width=\"100px\">充值".$tem1[1]."<INPUT type=\"hidden\" value=\"".$row[id]."\" name=\"dhid\"><INPUT type=\"hidden\" value=\"duihuan_ggold\" name=\"go\"><input type=\"submit\" class=\"btn80_1\" name=\"Submit\" id=\"submit\" value=\"充值\"><font color=\"#FF0000\"></font></form></div>";

}
echo $str."</div>";
}
?>


<?php
$duihuaninfo=mysql_query("SELECT * FROM duihuan WHERE kaifang='1' and id<10");
$num=mysql_num_rows($duihuaninfo);
$str="";
if($num>0)
{
$str="<div class=\"mybox\">
        <div class=\"mytit\">
             <span style=\"color:red\">站内兑换</span>
        </div>
		   ";

$str1="";
for($i=0;$i<$num;$i++)
{
   $row=mysql_fetch_array($duihuaninfo);
   $tem1=explode("to",$row[duihuan]);
   $tem3=$tem1;
   $tem2=explode(":",$row[bili]);
   $tem1[0]=Getshoptype($tem1[0]);
   $tem1[1]=Getshoptype($tem1[1]);
   $str=$str."<div class=\"con clearfix\"><form action=\"Action.php\" method=\"post\" ><p style=\"margin-bottom:10px;\">".$tem1[0]."换".$tem1[1]."的比例是".$row[bili]."(".$tem2[0].$tem1[0]."换".$tem2[1]."个".$tem1[1].")"."</p>使用<input type=\"text\" name=\"dhs\" id=\"dhnum\" width=\"100px\">".$tem1[0]."兑换".$tem1[1].".<INPUT type=\"hidden\" value=\"".$row[id]."\" name=\"dhid\"><INPUT type=\"hidden\" value=\"duihuan_hu\" name=\"go\"><input type=\"submit\" class=\"btn80_1\" name=\"Submit\" id=\"submit\" value=\"兑换\"><font color=\"#FF0000\">(您拥有".$moneyinfo[$tem3[0]].$tem1[0].")</font></form></div>";

}
echo $str."</div>";
}
?>


</div>

<script type="text/javascript">

    var clipboardswfdata;

    var setcopy_gettext = function () {

        clipboardswfdata = document.getElementById('tgTxt').value;

        window.document.clipboardswf.SetVariable('str', clipboardswfdata);

    };

    var floatwin = function () {

        alert("复制成功，你可以使用Ctrl+V 贴到需要的地方去了哦！  ");

    };

</script>

</div></div>
<?php
	require "footer.php";
?>

</body></html>