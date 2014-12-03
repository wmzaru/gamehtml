function login()
{
	if (document.myform.login_account.value=="")
    {
      document.myform.login_account.focus();
      window.alert("请输入用户名");
      return false;  
    }
	if (document.myform.password.value=="")
    {
      document.myform.password.focus();
      window.alert("请输入密码");
      return false;  
    }else
	{
	  document.myform.submit();
	}
}
function reg()
{
	if (document.myform.reg_account.value=="")
    {
      document.myform.reg_account.focus();
      window.alert("请输入用户名");
      return false;  
    }
	if (document.myform.reg_password.value=="")
    {
      document.myform.reg_password.focus();
      window.alert("请输入密码");
      return false;  
    }
	if (document.myform.reg_rpassword.value=="")
    {
      document.myform.reg_rpassword.focus();
      window.alert("请输入确认密码");
      return false;  
    }
	if (document.myform.reg_password.value!=document.myform.reg_rpassword.value)
    {
      document.myform.reg_rpassword.focus();
      window.alert("密码与确认密码不一致");
      return false;  
    }
	else
	{
	  document.myform.submit();
	}
}
function pay(s) {
if (s.change_yb.value == "")
{
alert('请输入要兑换的钻石数量！');
return false;
}
}

function pay_jifen(s) {
if (s.change_jifen.value == "")
{
alert('请输入要兑换的积分数量！');
return false;
}
}

function checkRate(input)
{
     var re = /^\d+$/;
    var nubmer = document.getElementById(input).value;
    
     if (!re.test(nubmer))
    {
        alert("请输入正确的兑换数量,只允许输入大于0的整数!");
        document.getElementById(input).value = "";
        return false;
     }
} 

function checkjifen(input)
{
     var re = /^\d+$/;
    var nubmer = document.getElementById(input).value;
    
     if (!re.test(nubmer))
    {
        alert("请输入正确的兑换数量,只允许输入大于0的整数!");
        document.getElementById(input).value = "";
        return false;
     }
} 

function aa(s_id){
for(i=1;i<5;i++){
   if(i==s_id){
    document.getElementById("s"+i).className="block"; //内容的样式
    document.getElementById("m"+i).className="c_"+i+" c_1"; //头部的样式
    //document.getElementById("uid_"+i).focus();
   }
   else
   {
    document.getElementById("s"+i).className="none"; //内容不显示
    document.getElementById("m"+i).className="c_0"; //
   }
}
}


function bb(q_id){
for(i=1;i<5;i++){
   if(i==q_id){
    document.getElementById("q"+i).className="block"; //内容的样式
    document.getElementById("w"+i).className="c_"+i+" c_1"; //头部的样式
    //document.getElementById("uid_"+i).focus();
   }
   else
   {
    document.getElementById("q"+i).className="none"; //内容不显示
    document.getElementById("w"+i).className="c_0"; //
   }
}
}


$(document).ready(function() {
	$('.right-btn').click(function(){
		$(this).animate({'left':'-71px'},300);
		$('.right-open').delay(300).animate({'left':'0'},500);
	});
	$('.right-close').click(function(){
		$('.right-open').animate({'left':'-223px'},500);
		$('.right-btn').delay(500).animate({'left':'0'},300);
	});
});

$(document).ready(function() {
	$('#login-btn').click(function(){
		$('.right-btn').animate({'left':'-71px'},300);
		$('.right-open').delay(300).animate({'left':'0'},500);
	});
	$('.right-close').click(function(){
		$('.right-open').animate({'left':'-223px'},500);
		$('.right-btn').delay(500).animate({'left':'0'},300);
	});
});
