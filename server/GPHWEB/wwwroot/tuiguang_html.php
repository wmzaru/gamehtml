<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
我要推广-<?=$webname;?>
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
?>

<div class="center_right ml10">

    <div class="mybox">

        <div class="mytit">

            我要推广

        </div>

        <div class="con clearfix">

            <p style="margin-bottom: 10px;">

                账号：<b class="orange"><?=$GLOBALS["gname"];?></b>

                <b class="segmentation"></b>

                拥有推广个数：<b class="orange"><?=$GLOBALS["gtg2"];?></b>

                <b class="segmentation"></b>

                可兑换元宝和积分：<b class="orange"><?=$GLOBALS["gtg"];?></b>

                <b class="segmentation"></b>

                <a href="user_index.php"    class="bt_but c_1_g mr10 tips"><u></u>返回会员中心兑换</a>

            </p>
            <textarea id="tgTxt" rows="6" cols="148" style="font-weight: bold; background-color: #FFFAE5; color: #FF5A00; border: 1px #CCB59F solid; width: 778px; height: 500px; font-size: 12px;">
注意： 这里是您推荐的下级会员,您可以推荐别人来注册会员,别人通过您的推荐链接来注册,充值成功后您得到提成！每月1号结算，只要是您推荐的会员，永久是您的下级，他每个月的充值您都有分成！分成比例 : 10% (您拿十分之一股份) 
（例如 您的一个下级充值了200元,您得20元; 您有100下级？100个下级平均每人充200元=20000元，您得2000元） 
您的推荐链接地址是： （把这个网址发给别人，别人注册后就是您的下级了） 

以下是广告词，您可以拿去发广告用：
 
★888-大闹天宫-独家仿官版-小怪爆元宝-天天新区★
★上线送VIP11，5000万铜钱，1000W绑定礼金,领取七大圣
★上线送光翼，元神，礼金购买升级材料，加群送10W元宝★
★新区送黄帝，礼金，元宝，圣王装备，龙灵，兵灵，翼灵★
★长久版本，持续更新，不变态,PK爽,升级快,活动多，耐玩★
★开放天宫合成，神器，魔神蚩尤，炎龙装备，结婚，宠物★
★推广送大量元宝，打怪爆大量元宝,材料,礼金, 越玩越好玩★
★长期开放，稳定不卡, 管理到位,游戏设置合理,欢迎提建议★
★官方网站：http://www.13yyw.com★
★人气暴满 不花钱也能当爷。激情无限★
			  
 
★推广地址：<?=$webdomain;?>reg.php?Sid=<?=$GLOBALS["gid"];?></textarea>

            <p style="margin-top: 5px; font-size: 15px; font-weight: bold; text-align: center;">

                <a style="position: relative;" class="bt_but c_1_g mr10 tips"><u></u>

                    复制推广

                    <embed name="clipboardswf" style="position: absolute; z-index: 9999; left: 0px; top: 0px;" class="clipboardswf" id="clipboardswf" onmouseover="setcopy_gettext()" devicefont="false" src="swf/clipboard.swf" menu="false" allowscriptaccess="sameDomain" swliveconnect="true" wmode="transparent" type="application/x-shockwave-flash" height="22" width="92">

                </a>

            </p>

        </div>

    </div>
<br/>

	
<?php
$tg1_row=mysql_fetch_array(mysql_query("SELECT * FROM base where name='tg_1'"));

$tg21_row=mysql_fetch_array(mysql_query("SELECT * FROM base where name='tg_2_1_level'"));
$tg22_row=mysql_fetch_array(mysql_query("SELECT * FROM base where name='tg_2_2_level'"));
$tg23_row=mysql_fetch_array(mysql_query("SELECT * FROM base where name='tg_2_3_level'"));
$tg21v_row=mysql_fetch_array(mysql_query("SELECT * FROM base where name='tg_2_1_value'"));
$tg22v_row=mysql_fetch_array(mysql_query("SELECT * FROM base where name='tg_2_2_value'"));
$tg23v_row=mysql_fetch_array(mysql_query("SELECT * FROM base where name='tg_2_3_value'"));

$xfinfo=mysql_query("SELECT * FROM tuiguang where tgr='".$GLOBALS["gname"]."' order by id desc");
$num=mysql_num_rows($xfinfo);
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">推广记录</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td width="6%" align="center" valign="middle">被推广人</td>
    <td width="6%" align="center" valign="middle">IP</td>
	<td width="6%" align="center" valign="middle">时间</td>
	<td width="6%" align="center" valign="middle">注册即送<?php if($tg1_row["text"]==0){ echo "(未开启)"; } ?></td>
	<td width="6%" align="center" valign="middle">达到<?=$tg21_row["text"];?>级获取<?=$tg21v_row["text"];?>推广</td>
	<td width="6%" align="center" valign="middle">达到<?=$tg22_row["text"];?>级获取<?=$tg22v_row["text"];?>推广</td>
	<td width="6%" align="center" valign="middle">达到<?=$tg23_row["text"];?>级获取<?=$tg23v_row["text"];?>推广</td>
  </tr>
<?php
for($i=0;$i<$num;$i++)
{
$xfrow=mysql_fetch_array($xfinfo);
if($xfrow[num]==1)
{
if($tg1_row["text"]==0)
{ 
  $tem="无";
}else
{
$tem="已获得";
}
}else
{
if($tg1_row["text"]==0)
{ 
  $tem="无";
}else
{
$tem="无效";
}
}

?>
 <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="tabletr">
    <td align="center" valign="middle"><?=$xfrow[btg];?></td>
    <td align="center" valign="middle"><?=$xfrow[ip];?></td>
    <td align="center" valign="middle"><?=$xfrow[time];?></td>
	<td align="center" valign="middle"><?=$tem;?></td>
	<td align="center" valign="middle"><?=strvalue($xfrow["tg2_1_value"]);?></td>
	<td align="center" valign="middle"><?=strvalue($xfrow["tg2_2_value"]);?></td>
	<td align="center" valign="middle"><?=strvalue($xfrow["tg2_3_value"]);?></td>
  </tr>
<?php
}
?>
</table>
<br/>
<br/>
<br/>
      
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