<?php
include '../config.php';
include '../getfunction.php';
include '../sysconfig.php';
ckdenglu();
//ini_set("error_reporting","E_ALL & ~E_NOTICE");
$roleid=addslashes(trim($_GET['roleid']));

 $sqlr="DELETE FROM `dntg`.`user_role` WHERE `user_id` ='".$roleid."' ";
mysql_query($sqlr);
mysql_query($sqlz);
echo "<script> alert('删除角色成功！');location.href=$webdomain/user_index.php;</script>";
	header("refresh:0;url=$weburl/user_index.php");
	echo "<br><br><input type=button onclick=location.href='$webdomain/user_index.php' value='返回会员中心' />";
mysql_close($conn);

?>
