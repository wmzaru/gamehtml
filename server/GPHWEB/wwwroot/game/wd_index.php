
<html>
<head>
<title>js定时跳转页面的方法</title>
<script> 
var t=0 //设定跳转的时间
setInterval("testTime()",15); //启动1秒定时 
function testTime() 
    { 
        if(t == 96) location = "../wd_index.php"; //#设定跳转的链接地址
        view.innerHTML = "读取中:"+t+"%　　　loading......"; // 显示倒计时 
         t++; // 计数器递减 
    } 
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body {
	background-color: #000;
}
</style>
</head>
<body>
<div style="line-height:800px;height:800px; width:100%" align="center">

<span id="view" style="color:#FFF; font-size: 12px;"></span>
 </div>
</body>
</html>