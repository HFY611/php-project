<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员注册</title>
    <style>
        h1 {
            text-align: center;
        }

        .main {
            width: 50%;
            margin: 0 auto
        }

        .main table {
            width: 100%
        }
        #usernameErrorMsg{color: red}
        #x0,#x1{width: 30px;height: 30px;display: none}
        #loading{width: 30px;height: 30px;display: none}
    </style>
</head>
<body>
<h1>会员注册</h1>
<?php
include_once "nav.php";
?><!--onSubmit="return Validator.Validate(this,3)"-->
<div class="main">
    <form action="postReg.php" method="post" >
        <table style="border-collapse:collapse " border="1" cellpadding="10" bordercolor="gray" cellspacing="0">
            <tr>
                <td align="center">用户名</td>
                <td align="left">
                    <input name="username" id="username" dataType="Username" msg="用户名不符合规定">
                    <img src="img/x0.jpg" id="x0"><img src="img/x1.jpg" id="x1"> <img src="img/loading.gif" id="loading"></span>
                </td>
            </tr>
            <tr>
                <td align="center">密码</td>
                <td align="left"><input type="password" name="password" dataType="SafeString"   msg="密码不符合安全规则"></td>
            </tr>
            <tr>
                <td align="center">重复密码</td>
                <td align="left"><input type="password" name="rpw" dataType="Repeat" to="password"   msg="两次密码不相同"></td>
            </tr>
            <tr>
                <td align="center">信箱</td>
                <td align="left"><input name="email" dataType="Email" msg="信箱格式不正确" require="false"></td>
            </tr>
            <tr>
                <td align="center">性别</td>
                <td align="left">
                    <input type="radio" name="sex" value="1" checked>男
                    <input type="radio" name="sex" value="2">女
                </td>
            </tr>
            <tr>
                <td align="center">爱好</td>
                <td align="left">
                    <input type="checkbox" name="fav[]" value="听音乐">听音乐
                    <input type="checkbox" name="fav[]" value="玩游戏">玩游戏
                    <input type="checkbox" name="fav[]" value="踢足球">踢足球
                </td>
            </tr>
            <tr>
                <td align="center"><input type="submit" value="提交" onclick="return checkInput();"></td>
                <td align="left"><input type="reset" value="重置"></td>
            </tr>
        </table>
    </form>
</div>
</body>
<script src="js.js"></script>
<script src="jquery.js"></script>
<script>
    let isOK = 0;
    function checkInput(){
        if(isOK == 0){
            return false;
        }
        else{
            return true;
        }
    }
    $(function () {
        $("#username").focus(function () {
            $("#x0").hide();
            $("#x1").hide();
            $("#username").select();
        })
        $("#username").blur(function () {
            //异步验证用户名是否有效
            $.ajax({
                url:"ajaxCheckUserName.php", //数据发送目的地
                data:{  //要发送的数据
                    username : $("#username").val()
                },
                type:"POST",
                dataType:"json",
                success:function (data) {
                    //业务处理
                    //console.log(data.error);
                    //console.log(data['error']);
                    $("#loading").hide();
                    if(data.error == 1){
                        //说明用户名被占用
                        isOK = 0;
                        $("#x0").show();
                        $("#x1").hide();
                        //console.log($("#username"))
                        $("#username").val('');

                    }
                    else{
                        //说明用户名有效
                        isOK = 1;
                        $("#x0").hide();
                        $("#x1").show();
                    }
                },
                //timeout:1000,
                error:function (d1,d2,d3) {
                    //错误处理
                    $("#loading").hide();
                    alert("网络超时或者其他错误");
                    console.log(d1)
                    console.log(d2)
                    console.log(d3)
                },
                beforeSend:function () {
                    $("#loading").show();
                    $("#x0").hide();
                    $("#x1").hide();
                }
            })

        })
    })
</script>
</html>