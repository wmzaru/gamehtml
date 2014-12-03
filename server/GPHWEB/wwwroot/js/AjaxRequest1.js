/// <reference path="Common.js" />
/// <reference path="jquery.min.js" />
/// <reference path="Ipt.js" />
var PayUrl = "/Pay.aspx";

function FindPwd() {
    if (ckEmail() && blurPassStyle() && blurPass1Style() && ckSafeCode && ckPasAndPas1() && ckName()) {
        var uMail = $.trim($("#u_mail").val());
        var sCode = $.trim($("#s_code").val());
        var uName = $.trim($("#u_name").val());
        var uPas = $.trim($("#u_pas").val());
        var uPas1 = $.trim($("#u_pas1").val());
        var vCode = $.trim($("#VCode").val());
        DoAjax("../AjaxHandel/AccountHandler.ashx",
        { Action: "FindPwd", uMail: uMail, uPas: uPas, sCode: sCode, uName: uName, VCode: vCode, uPas1: uPas1 },
        function (msg) {
            HideLoading(); //不管是否成功，都要Hide
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/");
            }
            else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}



function BindEmail() {
    if (ckEmail() && blurPassStyle() && ckSafeCode) {
        var uMail = $.trim($("#u_mail").val());
        var sCode = $.trim($("#s_code").val());
        var uPas = $.trim($("#u_pas").val());
        var vCode = $.trim($("#VCode").val());
        DoAjax("../AjaxHandel/AccountHandler.ashx",
        { Action: "BindEmail", uMail: uMail, uPas: uPas, sCode: sCode, VCode: vCode  },
        function (msg) {
            HideLoading(); //不管是否成功，都要Hide
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/");
            }
            else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function ChangePassword() {
    if (blurOPassStyle() && blurPassStyle() && blurPass1Style()) {
        var oPas = $.trim($("#o_pas").val());
        var uPas = $.trim($("#u_pas").val());
        var uPas1 = $.trim($("#u_pas1").val());
        var vCode = $.trim($("#VCode").val());
       if(/.*[\u4e00-\u9fa5]+.*$/.test(uPas)) 
        { 
          alert("密码不能含有汉字！"); 
          return ;
        } 
        DoAjax("../AjaxHandel/AccountHandler.ashx",
        { Action: "ChangePassword", oPas: oPas, uPas: uPas, VCode: vCode, Sid: GetParasValue("Sid") },
        function (msg) {
            HideLoading(); //不管是否成功，都要Hide
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/");
            }
            else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function Register() {
    if (blurNameStyle() && blurPassStyle() && blurPass1Style()) {
        var uName = $.trim($("#username").val());
        var uPas = $.trim($("#password").val());
        var uPas1 = $.trim($("#repassword").val());
        var vCode = $.trim($("#code").val());
       if(!(/^[0-9a-zA-Z]*$/g.test(uName))) 
        { 
          alert("帐号只能是英文和数字！"); 
          return;
        } 

        if(/.*[\u4e00-\u9fa5]+.*$/.test(uPas)) 
        { 
          alert("密码不能含有汉字！"); 
          return ;
        } 

        DoAjax("Action.php",
        { Action: "register", username: uName, password: uPas, repassword: uPas1,code: vCode, Sid: GetParasValue("Sid") },
        function (msg) {
            HideLoading(); //不管是否成功，都要Hide
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "user_index.php");
            }
            else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function Login() {
    if (blurNameStyle() && blurPassStyle()) {
        var uName = $.trim($("#u_name").val());
        var uPas = $.trim($("#u_pas").val());
        DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "Login", uName: uName, uPas: uPas }, function (msg) {
            HideLoading();
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/");
            } else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function SignOut() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "SignOut" }, function (msg) {
        HideLoading();
        if (msg == "1") {
            ShowModalAndRedirect(FormatMsg("用户推出系统成功。", "green"), "/UserCenter/Login.aspx");
        } else {
            ShowModal(FormatMsg("网络繁忙，请稍后再试。", "red"));
        }
    });
}



function SpreadTran() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "SpreadTran" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function GetYuanBaoFromUser() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "GetYuanBaoFromUser" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");
        } else if (msg.indexOf("充值") > 0) {
            ShowModalAndOpenNewWindow(FormatMsg(msg, "red"), PayUrl);
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function PayByMail() {
    $.ajax({
        url: "/AjaxHandel/AccountHandler.ashx",
        type: "POST",
        data: { Action: "PayByMail" },
        cache: false,
        error: function () {
            $("#PayMail").text("快速领取元宝(角色可不下线)");
            alert("网络繁忙，请稍后再试");
        },
        success: function (msg) {
            $("#PayMail").text("快速领取元宝(角色可不下线)");
            alert(msg);
        },
        beforeSend: function () {
            $("#PayMail").text("努力为您领取元宝中....");
        }
    });
}

function RewardPayGift(giftId) {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "RewardPayGift", GiftId: giftId }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function FreeBindGold() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "FreeBindGold" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function FreePoint() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "FreePoint" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function FreeGold() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "FreeGold" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function UpdateOnlineState() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "UpdateOnlineState" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function GetWebMallList() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "GetWebMallList" }, function (msg) {
        HideLoading();
        $("div.items").html(msg);
    });
}

function GetWebMallListByItemType(itemType) {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "GetWebMallListByItemType", ItemType: itemType }, function (msg) {
        HideLoading();
        $("div.items").html(msg);
    });
}

function DoBuyWebMall(itemUid) {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "DoBuyWebMall", ItemUid: itemUid }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function DoBuyDJ() {
    var uName = $.trim($("#dhnum").val());
    var sel1 = $.trim($("#sel").val());
    if(uName=="")
    {
ShowModal(FormatMsg("请选择要兑换的物品", "green"));
    }
    else
    {
        DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "DoBuyDJ",sel:sel1,num:uName  }, function (msg) {
              HideLoading();
           if (msg.indexOf("成功") > 0) {
              ShowModal(FormatMsg(msg, "green"));
           } else {
              ShowModal(FormatMsg(msg, "red"));
           }
       });
    }
}

function OneJMMJ() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "OneJMMJ" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function OneGGMJ() {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "OneGGMJ" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function DJLB(giftId) {
    DoAjax("/AjaxHandel/AccountHandler.ashx", { Action: "DJLB", GiftId: giftId }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}