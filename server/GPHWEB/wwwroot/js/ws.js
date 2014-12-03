var search = window.location.search;

function getValue(val) {
    var regExp = new RegExp(val + "=([^&?]*)", "ig");
    return (search.match(regExp) ? search.match(regExp)[0].substring(val.length + 1) : null);
}

function GetQueryString(name) {
    if (name == "uid") {
     //   return search.slice(1);
        return baidup;
    } else {
        return getValue(name);
    }
}

/**
 *  * 下载
 *   * @param url
 *    */
function addDesktopUrl() {
	var pf=getValue("pf");
	var url="http://res.baidu.wenxian.ate.cn/wenxian/问仙-2013暑期巨制Q版玄侠页游.url";
//	if (pf == 'qzone') {
//		url= "http://s12.app100659110.qqopenapp.com/qzone/武胜（VIP通道）.url";
//	} else if (pf == 'pengyou') {
//		url= "http://s12.app100659110.qqopenapp.com/pengyou/武胜（VIP通道）.url";
//	} 
	try {
		if (document.all) {
			var a = document.createElement("A");
			a.target = "_blank";
			a.href = url;
			document.body.appendChild(a);
			a.click();
			setTimeout(function() { a.parentNode.removeChild(a); }, 50);
		}
		else window.open(url, "_blank");
	} catch (e) {
		alert(e);
	}
	
}

function myrefresh() {
    window.location.reload();
}

function qqBuy(url_params) {
    //  alert("QQ buy panel will be pop after runing qq platform" + url_params);
    fusion2.dialog.buy({




        param: url_params,


        //disturb : true,  

        //sandbox : true,




        onSuccess: function (opt) {
            //	 document.getElementById("main").refreshYuanbao();
        },




        onCancel: function (opt) {},




        onSend: function (opt) {},




        onClose: function () {
            document.getElementById("main").refreshYuanbao();
        }


    });
}

window.onbeforeunload = function (e) {
    var str = swfobject.getObjectById("main").quitGame();
    if (str == "" || str == null) {

    } else {
        return str;
    }
};

function openLog() {
    swfobject.getObjectById("main").log();
}

function pay1() {
    alert("充值功能暂未开启，敬请期待!");
}

function pay() {

    fusion2.dialog.pay

    ({
        zoneid: GetQueryString("serverid"),
        //sandbox : true, 
        onClose: function () {
            document.getElementById("main").refreshYuanbao();
        }
    });


}

function fcm() {
    //    fusion2.control.enableAntiAddiction();
    fusion2.iface.updateExpRate(function (rate) {
        //      alert(rate);
        document.getElementById("main").fcm(rate);

    });

}

function invite() {
    //     document.getElementById("main").invite();

    fusion2.dialog.invite

    ({
        onSuccess: function (opt) {
            document.getElementById("main").invite(opt.invitees);
        }
    });
}

function share(desc, summary, title, pics) {
    fusion2.dialog.sendStory({
        msg: desc,
        title: title,
        summary: summary,
        img: pics,
        source: "ref=story&act=default",
        context: "share",
        onSuccess: function (opt) {
            document.getElementById("main").share();
        }
    });
}

function savePage() {

    if (document.all)

    {
        window.external.addFavorite('http://apps.pengyou.com/100659110', '武胜');
    } else if (window.sidebar)

    {
        window.sidebar.addPanel('武胜', 'http://apps.pengyou.com/100659110', "");
    }
}

function openVipGift(tokenid) {


    fusion2.dialog.openVipGift

    ({

        // 必须。 领取道具的token，通过调用v3/pay/get_token接口获取。

        token: tokenid,


        // 必须。开通包月送礼包的营销活动ID。

        // 在管理中心“支付结算”tab下的“营销接入”提交活动申请后，将获取该营销活动ID。

        actid: 'UM130415141819958',


        // 必须。在管理中心“支付结算”tab的“营销接入”下，在“发货配置”中配置好的分区ID。

        zoneid: GetQueryString("serverid"),


        // 必须。根据APPID以及用户QQ号码生成用户ID。

        openid: getValue("openid"),


        // 可选。表示使用的OpenAPI版本。v3:使用OpenAPI V3.0，v2或不指定:使用OpenAPI V2.0。
        // 如果您的应用中，回调的赠送道具发货URL使用的是OpenAPI V3.0协议，则这里必须传值"v3"。

        version: 'v3',


        // 可选。用付费模式。
        // month表示按月支付，year表示按年支付。
        // 传入此参数后用户将无法选择付费模式。为空或不传则允许用户选择付费模式。
        //paytime: 'month',


        // 可选。VIP的开通时长，单位为月。
        // 若上面的paytime参数值为month，则这里需传入1-24的整数；
        // 若上面的paytime参数值为year，则这里需传入12或24。
        // 传入此参数后用户将无法选择开通时长。为空或不传则允许用户选择开通时长。
        //defaultMonth: '24',


        // 可选。标识VIP开通的对象为自己还是好友。
        // self：给自己开通； send：给好友开通。不传或传入其他值，则默认为给自己开通。
        ch: 'self',


        // 可选。标识开通的黄钻类型。
        // 不传此参数或参数值为空：开通普通黄钻； XXJZGHH：开通豪华黄钻。
        //pf: ' ',


        // 可选。透传参数，用于onSuccess回调，以识别请求。
        // 透传方式：调用本接口时传入该参数，onSuccess回调时，在JS中使用opt.context即可获取该透传参数。
        // opt为本接口的回调函数形参。
        contex: 'openVipGift',


        // 可选。用户开通黄钻包月业务成功时的回调方法。
        // 如果用户开通成功，则立即回调onSuccess，当用户关闭对话框时再回调onClose。
        // 同时可用该回调方法记录通过营销活动开通包月业务的用户信息。

        onSuccess: function (opt) {
           // alert(opt.context);
        },


        // 可选。用户开通黄钻包月业务失败时的回调方法。
        // 如果用户开通失败，则立即回调onError，当用户关闭对话框时再回调onClose。

        onError: function (opt) {},


        // 可选。对话框关闭时的回调方法。
        // 主要用于对话框关闭后进行UI方面的调整，onSuccess则用于应用逻辑的处理，避免过度耦合。

        onClose: function (opt) {}

    });

}
