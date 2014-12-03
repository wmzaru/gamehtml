<?php
include 'getfunction.php';
ckcookie();
$thispage=2;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>登录
</title>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000;
	font-weight: bold;
}
.STYLE2 {font-size: 14px}
.STYLE3 {color: #000000}
-->
</style>
<link href="css/BasicStyle.css" type="text/css" rel="stylesheet" />
<link href="css/Login.css" type="text/css" rel="stylesheet" />
<link href="css/jmodal.css" type="text/css" rel="stylesheet" />
<link href="css/loading.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/Ipt.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/jmodal.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/loading.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/Common.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/AjaxRequest.js" type="text/javascript" charset="UTF-8"></script></head>
<body id="loadding">
<?php	require "header.php";?>
    <div class="center clearfix mt10">
        <div class="c_main">

<div class="reg_box">
    <div class="tit gray3">
        <b class="gray1 mr15">快速登录</b><span class="STYLE3"></span></div>
    <div class="reg_form">
        <div id="reg_box">
            <dl>
                <dd class="clearfix">		 <form method="post" name="form1" action="Action.php">
                    <em class="lab">用&nbsp;户&nbsp;名:</em> <span class="at_text t_1_e">
                        <input type="text" tabindex="1" name="username" id="u_name" value="" />
                        <em class="on"><u class="at_msg m_3_o"></u></em></span>
                    <div class="clear">
                    </div>
                </dd>
                <dd class="clearfix">
                    <em class="lab">游戏密码:</em> <span class="at_text t_1_d">
                        <input type="password" tabindex="2" name="password" id="u_pas" />
                        <em></em></span>
                </dd>
                <dd class="clearfix">                     	 <input type="hidden" name="go" value="login"  />
                    <em class="lab"></em><a id="reg_sub" class="at_but b_1_y" onclick="javascript:document.form1.submit();" ><u></u>
                        登录</a> 
                        </form>
                </dd>
            </dl>
        </div>
		
        <div class="have_count">
            <h3 class="mb10">还没有帐号？</h3>
            <p>
                <a class="at_but b_1_g" href="reg.php"><u></u>立即注册 </a>
            </p>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
</div></div><?php	require "footer.php";?><script src='http://ad.74gm.com/dn/foot.php' type='text/javascript' ></script>
</body>
</html>
