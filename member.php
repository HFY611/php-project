<?php
session_start();
include_once "checkLogin.php";
$source = isset($_GET['source'])?$_GET['source']:'';
$page = isset($_GET['page'])?$_GET['page']:'';
if(!$source){ //说明是非法访问
    echo "<script>alert('非法访问');history.back();</script>";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员资料修改</title>
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
    </style>
</head>
<body>
<?php
//从数据库中查询当前用户的资料
include_once("conn.php");
if(isset($_GET['id'])){  //说明是管理员修改资料
    include_once "checkAdmin.php";
    $sql = "select * from userinfo where username = '" . $_GET['id'] . "'";
}
else{ //说明是会员自己修改资料
    $sql = "select * from userinfo where username = '" . $_SESSION['logged'] . "'";
}
/*echo $sql;
exit;*/
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
   //接下来，将读到的各项数据写入表单
    $info = mysqli_fetch_array($result,MYSQLI_ASSOC); //返回一个数组
    //print_r($info);
    //echo $info['username'];
    $fav = explode(",",$info['fav']);
}
else{ //说明当前用户不存在
    echo "<script>alert('当前用户不存在');history.back();</script>";
    exit;
}


?>
<h1>会员资料修改</h1>
<?php
include_once "nav.php";
?>
<div class="main">
    <form action="postModify.php" method="post" onSubmit="return Validator.Validate(this,3)">
        <table style="border-collapse:collapse " border="1" cellpadding="10" bordercolor="gray" cellspacing="0">
            <tr>
                <td align="center">用户名</td>
                <td align="left">
                    <input name="username" dataType="Username" readonly msg="用户名不符合规定" value="<?php echo $info['username']?>"></td>
            </tr>
            <tr>
                <td align="center">密码</td>
                <td align="left">
                    <input type="password" name="password" id="password" dataType="SafeString" value="<?php echo $info['pw']?>"   msg="密码不符合安全规则">
                    <input type="checkbox" name="modifyPW" value="1" id="modifyPW" >我要修改密码
                </td>
            </tr>
            <tr>
                <td align="center">重复密码</td>
                <td align="left"><input type="password" name="rpw" id="rpw" dataType="Repeat" to="password" value="<?php echo $info['pw']?>"   msg="两次密码不相同"></td>
            </tr>
            <tr>
                <td align="center">信箱</td>
                <td align="left"><input name="email" dataType="Email" msg="信箱格式不正确" value="<?php echo $info['email']?>" require="false"></td>
            </tr>
            <tr>
                <td align="center">性别</td>
                <td align="left">
                    <input type="radio" name="sex" value="1" <?php if($info['sex'] == 1){ echo "checked"; } ?>>男
                    <input type="radio" name="sex" value="2" <?php if($info['sex'] == 2){ ?> checked <?php } ?>>女
                </td>
            </tr>
            <tr>
                <td align="center">爱好</td>
                <td align="left">
                    <input type="checkbox" name="fav[]" value="听音乐" <?php if(in_array("听音乐",$fav)){?>checked<?php }?>>听音乐
                    <input type="checkbox" name="fav[]" value="玩游戏" <?php if(in_array("玩游戏",$fav)){?>checked<?php }?>>玩游戏
                    <input type="checkbox" name="fav[]" value="踢足球" <?php if(in_array("踢足球",$fav)){?>checked<?php }?>>踢足球
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" value="提交">
                    <input type="hidden" name="source" value="<?php echo $source?>">
                    <input type="hidden" name="page" value="<?php echo $page?>">
                </td>
                <td align="left"><input type="reset" value="重置"></td>
            </tr>
        </table>
    </form>
</div>
<script src="js.js"></script>
<script src="jquery.js"></script>
<script>
    $(function () {
        //选择器
        $("#modifyPW").click(function () {
            //将密码清空
            //console.log($("#password").val());
            $("#password,#rpw").val("");
            //$("#rpw").val("");
            $("#password").focus();
        })
    })
    $.ajax({  //异步请求

    })
</script>
</body>
</html>

