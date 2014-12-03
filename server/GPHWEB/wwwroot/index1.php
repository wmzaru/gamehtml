<?php
include 'getfunction.php';
include 'sysconfig.php';
GetTG();
ckcookie();
$thispage=1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1"><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>
<?=$webname;?>-主页-<?=$webdomain;?>/
</title>

    <style type="text/css">

        .def_main { background: #fff; padding: 15px; }

    .STYLE3 {	font-size: 14px;

	color: #000000;

}

    .STYLE4 {

	font-size: 18px;

	color: #0000CC;

}

    </style>

<link href="css/BasicStyle.css" type="text/css" rel="stylesheet" />

<script src="js/jquery.min.js" type="text/javascript" charset="UTF-8"></script></head>

<body id="loadding">

<?php
	require "header.php";
?>

    <div class="center clearfix mt10">

        <div class="c_main">



<div class="def_main">


骑士GM基地出品，接受各种功能站定制合作等。www.74gm.com
QQ89900060
	

</div>


<?php
	require "footer.php";
?>
</body>
</html>

