var unifyLog;
var default_game_key = "http://wukong.37.com/";
var default_game_id = "203";
var default_game_name = "大闹天宫";
var nologinhtml = '<ul class="log"><li class="user">帐号&nbsp;&nbsp;<input type="text"  name="login_account" id="login_account" class="ipt1" /></li><li class="psw">密码&nbsp;&nbsp;<input type="password" name="password" id="password" class="ipt1" /></li><li class="remember"><input type="checkbox" id="remember_me" />&nbsp;<label for="remember_me">记住账号</label></li><li class="get-psw"><a target="_blank" title="找回密码" href="http://www.37.com/forgetpwd/" rel="nofollow">忘记密码</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.37.com/users/register.php?gameid=203" target="_blank" rel="nofollow" id="q_b1">帐号注册</a></li><li class="log-btn"><a class="block-a" href="javascript:;" title="登录" id="login_button" onclick="tologin();" rel="nofollow"></a></li></ul>';

$(document).ready(function() {
    var $lf = $( "#loginframe" );
    unifyLog = new SQ.UnifyLog({
        logTpl: $lf.find( "http://www.pz1g.com/js/ul.log" ).eq( 0 ),
        logFrame: $lf,
        gameId: default_game_id,
        gameName: default_game_name,
        regBtn: "#q_b1"
    });
    unifyLog.bind( "parsed", function( isLogin, userInfo ) {
        if ( isLogin ) {
            $('.username').html( userInfo.LOGIN_ACCOUNT );
            $('#reg-frame').hide();
            $('#reged').show();
        }
        SQ.Top && SQ.Top.loginSuccess( userInfo );
    });
    unifyLog.userInfo();

    var loginAccount = getcookie("37wan_account");
    if (loginAccount){
        $("#login_account").val(loginAccount);
    }
    $(".ipt1").live("keypress", function(e){
        if(e.keyCode == 13){
            tologin();
        }
    });

    $(".quick-enter-click").live('click', function(){
        var s_last = parseInt($(".server-last").val());
        var s_num = parseInt($(".quick-enter-input").val());
        if(s_num>0 && s_num <= s_last){
            location.href = 'http://www.pz1g.com/game_login.php?server=S'+s_num;
        }else{
            alert("此服暂未开通，敬请期待！");
            $(".quick-enter-input").val(s_last);
        }
    });

    SQ.UnifyLog.getStaticServer( default_game_id, function(res){
        var json = res.data;
        var serverCode='';
        var quickEnterCode="";
        var j=1;
        for (var i in json){
            if (json == "-1" ){
                break;
            }
            if($.trim(json[i].SERVER_NAME)=="" || json[i].SID == ""){
                continue;
            }
            if(j==1){
                quickEnterCode='<input type="hidden" value="'+json[i].SID+'" class="server-last">快速进入<input type="text" class="quick-enter-input" value="'+json[i].SID+'">&nbsp;服&nbsp;<a  class="quick-enter-click">进入游戏</a>';
            }
            if(json[i].STATE <= 1){
                serverCode+='<li class="server-'+j+'"><a href="javascript:alert(\'37《'+default_game_name+'》'+json[i].SERVER_NAME+'将于'+json[i].START_TIME+'火爆开启，敬请期待！\')">'+json[i].SERVER_NAME+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="server-tip-1">即将开启</span></li>';
            }else{
                serverCode+='<li class="server-'+j+'"><a target="_blank" href="http://www.pz1g.com/js/'+default_game_key+'game_login.php?server=S'+json[i].SID+'">'+json[i].SERVER_NAME+'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="server-tip-2">火爆开启</span></li>';
            }
            j++;
        }
        if ( serverCode !== '' ){
            $(".quick-ingame").html(quickEnterCode);
            $(".server-list").html(serverCode);
        }
    }, 4 );


    //资料
    tab ( '.ziliao-nav li', '.ziliao-wrap' );

    //切换职业人物
    tab ( '.jobs-nav li', '.jobs-wrap' );

    //新闻
    tab( '.news-nav li', '.news-list', function( nav, con, index ){
        var news_id = nav.eq( index ).attr( 'id' );
        $( '.news-more' ).attr( 'href', 'http://wukong.37.com/' + news_id + '/' );
    });

    //截图
    tab( '.jietu-nav li', '.jietu-wrap' );
});

//新闻选项卡
function tab( nav, con, callback ) {
    var tabNav = $( nav ),
        tabCon = $( con ),
        index = 0;

    tabNav.mouseover( function( e ) {
        index = tabNav.index( this );
        tabNav.removeClass( 'on' ).eq( index ).addClass( 'on' );
        tabCon.hide().eq( index ).show();

        if( typeof callback === 'function' ) {
            callback( tabNav, tabCon, index );
        }

    } );
}

function addcookie(name,value,expireHours,domain){
    var cookieString=name+"="+escape(value);
    //判断是否设置过期时间
    if(expireHours>0){
        var date=new Date();
        date.setTime(date.getTime+expireHours*3600*1000);
        cookieString=cookieString+"; expire="+date.toGMTString();
    }
    if(domain!=""){
        cookieString=cookieString+";path=/; domain="+domain;
    }
    document.cookie=cookieString;
}
function getcookie(name){
    var strcookie=document.cookie;
    var arrcookie=strcookie.split("; ");
    for(var i=0;i<arrcookie.length;i++){
        var arr=arrcookie[i].split("=");
        if(arr[0]==name)return arr[1];
    }
    return "";
}

function tologin(){
    var loginAccount = $("#login_account").val();
    var password = $("#password").val();
    var rememberMe = $("#remember_me").prop("checked") ? 1 : 0;

    if(!/^[A-Za-z0-9_@\.]{1,30}$/.test(loginAccount)){
        alert("请输入正确的用户名！用户名为4~20位字母、数字或下划线！");
        return;
    }

    if(!/^.{1,30}$/.test(password)){
        alert("请输入正确的密码！密码长度为6~20位字母、数字或下划线！");
        return;
    }
    unifyLog.toLog( loginAccount, password, rememberMe );
}

function toreg(){
    var login_account = $("#reg-user").val();
    var password = $("#reg-psw").val();
    var password1 = $("#re-reg-psw").val();

    if (!/^.{4,20}$/.test(login_account)) {
        //alert("请输入长度为4~20位的帐号");
        $('.error').hide();
        $('.error-1').show();
        return;
    }
    if (!/^.{6,20}$/.test(password)) {
        //alert("密码有误,长度为6~20位的密码");
        $('.error').hide();
        $('.error-2').show();
        return;
    }
    if (!/^.{6,20}$/.test(password1)) {
        //alert("密码有误,长度为6~20位的密码");
        $('.error').hide();
        $('.error-2').show();
        return;
    }
    if (password != password1) {
        //alert("两次输入的密码不一致");
        $('.error').hide();
        $('.error-3').show();
        return;
    }

    SQ.Login.toReg({
        adrefer: "http://www.pz1g.com/js/wukong.37.com",
        login_account: login_account,
        password: password,
        gameid: default_game_id,
        success: function( res ) {
            $('.username').html( res.LOGIN_ACCOUNT );
            $('#reg-frame').hide();
            $('#reged').show();
            unifyLog._parse( res );
        },
        fail: function( res ) {
            if ( res && res.code && res.code === -1 ) {
                $('.error').hide();
                $('.error-4').show();
                return;
            }
            res && res.msg && alert( res.msg );
        }
    });
}

function userloginout(){
    SQ.Top && SQ.Top.tLog.show().prev().hide();
    unifyLog.toOut();
    var $regFrame = $('#reg-frame');
    if ( $regFrame.length ) {
        $('.username').html( "" );
        $regFrame.show();
        $('#reged').hide();
    }
}
function addFavor(title,url,flag){
    if (document.all){
        window.external.addFavorite(url,title);
    }else if (window.sidebar){
        window.sidebar.addPanel(title, url, "");
    }else{
        alert('请您使用"Ctrl+D"快捷键添加到收藏夹');
    }
}
function setHome(obj,seturl){
    try{
        obj.style.behavior='url(#default#homepage)';
        obj.setHomePage(seturl);
    }catch(e){
        if(window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            }catch (e) {
                alert("此操作被浏览器拒绝！\n请您手动设置主页");
            }
            var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
            prefs.setCharPref('browser.startup.homepage',seturl);
        }
    }
}
function reloadpass(){
    $("#passshow").hide();
    $("#password").show();
    $("#password").focus();
}
function loadpass(){
    if($("#password").val() ==""){
        $("#passshow").show();
        $("#password").hide();
    }
}
