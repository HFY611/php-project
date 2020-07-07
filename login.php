<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员登录</title>
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
        #x0,#x1{width: 30px;height: 30px;display: none}
        #code{cursor: pointer;}
    </style>
</head>
<body>
<h1>会员登录</h1>
<?php
include_once "nav.php";
?>
<div class="main">
    <form action="postLogin.php" method="post" onSubmit="return Validator.Validate(this,3)">
        <table style="border-collapse:collapse " border="1" cellpadding="10" bordercolor="gray" cellspacing="0">
            <tr>
                <td align="center">用户名</td>
                <td align="left">
                    <input name="username" dataType="Username" msg="用户名不符合规定" id="username">
                    <img id="x1" src="img/x1.jpg"><img id="x0" src="img/x0.jpg" >
                </td>
            </tr>
            <tr>
                <td align="center">密码</td>
                <td align="left"><input type="password" name="password" dataType="SafeString"   msg="密码不符合安全规则"></td>
            </tr>
            <tr>
                <td align="center">验证码</td>
                <td align="left">
                    <input name="code" >
                    <img src="code.php" id="code" title="点击刷新" alt="点击刷新">
                </td>
            </tr>
            <tr>
                <td align="center"><input type="submit" value="提交"></td>
                <td align="left"><input type="reset" value="重置"></td>
            </tr>
        </table>
    </form>
</div>
</body>
<script src="js.js"></script>
<script src="jquery.js"></script>
<script>
    $(function () {
        $("#code").click(function () {
            $(this).attr("src","code.php?id=" + Math.ceil(Math.random()*1000))
        })
        $("#username").blur(function () {
            $.ajax({
                url:"ajaxCheckUserName.php",
                data:{
                    username : $("#username").val()
                },
                type:"POST",
                dataType:"JSON",
                success:function (d) {
                    console.log(d);

                    if(d.error == 1){ //用户名找到了
                        $("#x1").show();
                        $("#x0").hide();
                    }
                    else { //用户名未找到
                        $("#x0").show();
                        $("#x1").hide();
                        $("#username").focus().select();
                    }
                },
                error:function () {
                    alert("网络超时");
                }
            })
        })
    })
</script>
</html>