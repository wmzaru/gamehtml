<?php
include 'getfunction.php';
ckcookie();

if($GLOBALS["gcook"]==0)
{
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>location.href='login.php'</script>";
	  exit;
}
$thispage=2;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>BUG提交</title>
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
        <b class="gray1 mr15">BUG提交</b>
    </div>
    <div class="reg_form">
        <div id="reg_box">
            <dl>
                <dd class="clearfix">		 <form method="post" name="form1" action="Action.php" >
                    <em class="lab">用&nbsp;户&nbsp;名:</em> <span class="at_text t_1_e">
                        <input type="text" tabindex="1" name="username" id="u_name" />
                        <em class="on"><u class="at_msg m_3_o"></u></em></span>
                    <div class="clear">
                    </div>
                </dd>
                <dd class="clearfix">
                    <em class="lab">设置密码:</em> <span class="at_text t_1_d">
                        <input type="password" tabindex="2" name="password" id="u_pas" />
                        <em></em></span>
                </dd>
                <dd class="clearfix">
                    <em class="lab">确认密码:</em> <span class="at_text t_1_d">
                        <input type="password" tabindex="3" name="repassword" id="u_pas1" />
                        <em></em></span>
                </dd>
                <dd class="clearfix">
                    <em class="lab">验&nbsp;证&nbsp;码:</em> <span class="at_text t_1_d">
                        <input type="text" tabindex="4" name="code" id="VCode" style="width: 50px;" /><img id="imgVcode" src="imageCode.php"
                            alt="点击更换" onclick="changeVcode()" style="cursor: pointer;" />
                        <em></em></span>
                </dd>
                <dd class="clearfix">	 <input type="hidden" name="go" value="register"  />
                    <em class="lab"></em>
					
					<a id="reg_sub" onclick="javascript:document.form1.submit();" class="at_but b_1_y">
					<u></u>注册</a>
                  </form>
                </dd>
            </dl>
        </div>
        <script type="text/javascript">
                            function changeVcode() {
                                $("#imgVcode").attr("src", "imageCode.php");
            }
        </script>
        <div class="have_count">
            <h3 class="mb10"></h3>
            <p>
                <a class="at_but b_1_g" href="login.php"><u></u>立即登录 </a>
            </p>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
</div></div><?php	require "footer.php";?>
</body>
</html>
