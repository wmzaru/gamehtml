<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
购物中心
</title>

    <style type="text/css">

        .def_main { background: #fff; padding: 15px; height: auto; overflow: hidden; }

        .items .item { width: 172px; border: 1px #ccc solid; height: 380px; padding: 5px; float: left; margin: 0 5px 10px 5px; }

            .items .item:hover { border: 1px #ff8c00 solid; }

        .item a.imga { display: inline-block; width: 100%; text-align: center; }

            .item a.imga img { margin-top: 6px; margin-bottom: 10px; }

        b.mark { color: #999999; text-decoration-line: none; display: inline-block; font-weight: 600; }

            b.mark:hover { text-decoration: none; }

            b.mark span.m_con { color: #ee82ee; }

            b.mark span.m_pri { color: #FF4400; }



        div.act_btn { text-align: right; margin-top: 5px; border-top: 1px #ccc solid; *padding-top: 8px; height: 30px; line-height: 30px; }

        div.category_btn { margin-bottom: 10px; }

    </style>

    <link href="css/lightbox.css" rel="stylesheet" /><link href="css/screen.css" rel="stylesheet" />
<link href="css/BasicStyle.css" type="text/css" rel="stylesheet" />
<link href="css/jmodal.css" type="text/css" rel="stylesheet" />
<link href="css/loading.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/jmodal.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/loading.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/Common.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/AjaxRequest.js" type="text/javascript" charset="UTF-8"></script></head>

<body id="loadding">

 
<?php
	require "header.php";
?>


    <div class="center clearfix mt10">

        <div class="c_main">


<div class="def_main" style="text-align:center;">
<a  href="shop.php"  class="bt_but c_1_g mr10 tips"><u></u>显示全部</a>
</div>
<div class="def_main">
<?php
  for($i=1;$i<4;$i++)
  {
    $taginfo=mysql_query("SELECT * FROM shop_tag WHERE shop_showline=".$i." order by shop_show asc");
	$num=mysql_num_rows($taginfo);
	?>
    <div class="category_btn">
	<?php
	
	if($num!=0)
	{
	for($ii=0;$ii<$num;$ii++)
	{
	$row=mysql_fetch_array($taginfo);
?>


        <a  href="?id=<?=$row[id];?>"  class="bt_but c_1_g mr10 tips"><u></u><?=$row[shop_tag];?></a>
  
<?php
}
}
?>
</div>
<?php
}
?>
    <div class="items">
<?php
$buybutton=buy_shop_show();
$id=addslashes(trim($_GET['id']));
if(isset($_GET[id])==false)
{
    $shopinfo=mysql_query("SELECT * FROM shop_list order by shop_show asc");
	$num=mysql_num_rows($shopinfo);
}else
{
    $shopinfo=mysql_fetch_array(mysql_query("SELECT * FROM shop_tag WHERE id=".$id));
	if($shopinfo)
	{
    $shopinfo=mysql_query("SELECT * FROM shop_list WHERE shop_tag like '%".$shopinfo[shop_tag]."%' order by shop_show asc");
	$num=mysql_num_rows($shopinfo);
	}else
	{
	$num=0;
	}
}
	for($ii=0;$ii<$num;$ii++)
	{
	$row=mysql_fetch_array($shopinfo);

?>
	<div class="item">
	
	<a class="imga" title="<?=$row[shop_name];?>" href="<?=$row[shop_pic];?>" rel="lightbox[plants]"><img width="100" height="150" alt="<?=$row[shop_name];?>" src="<?=$row[shop_pic];?>"></a><b class="mark">装备类型：<span class="m_con"><?=$row[shop_tag];?></span></b><b class="mark">装备名称：<span class="m_con"><?=$row[shop_name];?></span></b><b class="mark">购买数量：<span class="m_con"><?=$row[shop_num];?> 件</span></b><b class="mark">装备价格：<span class="m_con m_pri"><?=$row[shop_prick];?> <?php echo Getshoptype($row[shop_prick_type]);?></span></b><b class="mark">装备简介：<span class="m_con"><?=$row[shop_content];?></span></b>
	<form method="post" action="Action.php">
	<input type="hidden" name="shop_id" value="<?=$row[id];?>"  />
     
	<input type="hidden" name="go" value="buy_shop"  />
	<?=$buybutton;?>
	</form>

	
	</div>

	
	
<?php
    }

?>	

    </div>

    <script src="js/jquery-ui.min.js"></script>

    <script src="js/jquery.smooth-scroll.min.js"></script>

    <script src="js/lightbox.js"></script>

</div>

</div></div>

<?php
	require "footer.php";
?>

</body>

</html>

