<?php
include 'wdgetfunction.php';
ckcookie();
$thispage=2;
if($GLOBALS["gcook"]==0)
{
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>location.href='login.php'</script>";
	  exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员中心-</title>
<link href="css/BasicStyle.css" type="text/css" rel="stylesheet" />
<link href="css/jquery-ui.min.css" type="text/css" rel="stylesheet" />
<link href="css/jmodal.css" type="text/css" rel="stylesheet" />
<link href="css/loading.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/jmodal.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/loading.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/Common.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/Extends.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/AjaxRequest.js" type="text/javascript" charset="UTF-8"></script>

   

</head>

<body id="loadding">

    <div class="center clearfix mt10" align="center">

        

    <div class="basicInfor-content-shadow">

    </div>

    <div class="mybox">


        <div class="mytit">

            角色信息[<b class="orange">角色数据均为缓存数据，具体以游戏中数据为准。</b>]

        </div>
        <div class="myinfo_con clearfix">
		
			<p><?php echo GetRoleList();?></p>
			<p>&nbsp;    </p>
        </div>

    </div>


</div>

</div></div>

</body>


</html>

