<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>XXX网页导航</title>
</head>
<style>
body,div,dl,dt,dd,ul,ol,li,form,input,p,th,td{margin:0;padding:0;}
img{border:0;}
address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}
ol,ul{list-style:none;}
caption,th{text-align:left;}
q:before,q:after{content:'';}
.f_l{ display:inline;}
.f_l{ float:left;}
.clear {clear:both;}

html{height: 100%;}
body{background:#000;font-size:12px; font-family: arial,雅黑;text-align:center; height:100%}
#leftbar,#leftbar a{color:#C2B3B0;}
#leftbar{width:110px;height:100%; position:absolute;left:0;top:0;min-height:700px;_height:expression((documentElement.clientHeight > 700) ? "100%" : "auto" );}
#leftbar a{ color:#C2B3B0; text-decoration:none;blr:expression(this.onFocus=this.blur());outline:none;}
#game_list{ float:left; height:100%;}
#game_list{width:110px; margin:0px auto; overflow:hidden;padding:0;}
#game_list .game_list_bg{height:100%;min-height:600px;}
#game_list .logo{height:98px;background:url(/images/left/logo.jpg) no-repeat center; display:block; overflow:hidden; text-indent:-9999em;}
#game_list .flash{height:64px;padding:0 8px;}
#game_list .xl_btn{overflow:hidden;}
#game_list .xl_btn a{width:110px;height:30px;margin:1px auto 0;overflow:hidden;display:block;text-indent:-2000px;}
#game_list .xl_btn a.website{background:url(/images/left/9.jpg) no-repeat center;}
#game_list .xl_btn a.t1{background:url(/images/left/1.jpg) no-repeat center;margin:auto;}

/*Game NavList*/
#game_list dl{margin:0; overflow:hidden;*zoom:1;clear:both;}
#game_list dt{height:25px;line-height:25px;margin:1px auto 0;text-align:center;color:#000;cursor:pointer;background:url(/images/left/list_bg.jpg) no-repeat center;}
#game_list dt a{color:#CFB84E;}
#game_list dt#type_4 a{color:#F63D07;}
#game_list dd ul{display:none;}
#game_list li{overflow:hidden;height:23px;line-height:23px;white-space:nowrap;text-align:center;}
#game_list li a{color:#F0F616;line-height:20px;}

#game_list .xl_btn_other a.bbs{background:url(/images/left/10.jpg) no-repeat center;}
</style>
<body>

<script type="text/javascript" src="/images/left/jquery.js"></script>
<script>
$(document).ready(function(){
	$("#all_silde dt").click(function(){
		var dtid = $(this).attr("id").substring(5);
		$("#groupid_"+dtid+" ul").slideToggle("slow");
    });
});
</script>
<div id="leftbar" class="f_l">
        <div id="game_list">
            <div class="game_list_bg">
                <a href="http://www.XXXgame.cn/" target="_blank" class="logo" title="XXX官方网站"></a>
                <div class="xl_btn">
				<a class="website" target="_blank" href="/" title="公益1区">公益1区</a>
				<a class="t1" target="_blank" href="/pay.php" title="充值中心">充值中心</a>
                </div>
                <dl id="all_silde">
					<dt id="type_1">
                        <a href="javascript:void(0)">【游戏攻略】</a>
                    </dt>
                    <dd id="groupid_1">
                        <ul style="display:block">
<li><a target="_blank" href="/">新手指南</a></li>
<li><a target="_blank" href="/user_index.php">无限铜币</a></li>
<li><a target="_blank" href="/user_index.php">无限礼金</a></li>
<li><a target="_blank" href="/user_index.php">光翼赠送</a></li>
<li><a target="_blank" href="/user_index.php">元神赠送</a></li>
<li><a target="_blank" href="/user_index.php">VIP10领取</a></li>
<li><a target="_blank" href="/shop.php">免费套装</a></li>
						</ul>
                    </dd>
					
					<dt id="type_2">
                        <a href="javascript:void(0)">【游戏公告】</a>
                    </dt>
                    <dd id="groupid_2">
                        <ul style="display:block">
<li><a target="_blank" href="/tuiguang.php">游戏推广</a></li>
						</ul>
                    </dd>
					
					<dt id="type_3">
                        <a href="javascript:void(0)">【游戏活动】</a>
                    </dt>
                    <dd id="groupid_3">
                        <ul style="display:block">
						</ul>
                    </dd>
                    <dt id="type_4">
                        <a href="javascript:void(0)">【游戏新区】</a>
                    </dt>
                    <dd id="groupid_4">
                        <ul style="display:block">
<li>今日中午14点开启</li>
<li><a target="_blank" href="/">公益三区</a></li>
						</ul>
                    </dd>
					<dt id="type_5">
                        <a href="javascript:void(0)">【客服中心】</a>
                    </dt>
                    <dd id="groupid_5">
                        <ul style="display:block">
							<li><a title="客服热线" target="_blank">客服QQ</a></li>
							<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1587322475&site=qq&menu=yes"><img border="0" src="/images/left/wp.gif" alt="XXX客服" title="XXX客服"/></a></li>
							<li><a title="技术热线" target="_blank">技术QQ</a></li>
							<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1587322475&site=qq&menu=yes"><img border="0" src="/images/left/wp.gif" alt="XXX技术" title="XXX技术"/></a></li>
							<li><a title="官方QQ群" target="_blank">官方QQ群</a></li>
							<li><a title="官方QQ群" target="_blank">XXXX</a></li>
					   </ul>
                    </dd>
					<dt id="type_6">
                        <a href="javascript:void(0)">【其他页游】</a>
                    </dt>
                    <dd id="groupid_6">
                        <ul style="display:none;">
<li><a target="_blank" href=" ">搜神online</a></li>
					   </ul>
                    </dd>
                </dl>

                <div class="xl_btn xl_btn_other clearfix">
					<a class="bbs" target="_blank" href="http://127.0.0.1 " title="XXX论坛">XXX论坛</a>
                </div>
            </div>	    
        </div>
</div>

</body>
</html>