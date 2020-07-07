<?php
session_start(); //开户会话,且必须置于任何HTML输出之前
//验证用户输入的用户名和密码是否正确
include_once ("conn.php");//引入数据库连接
//第三步，读取用户填写的用户名和密码
$username = trim($_POST['username']);
$pw = md5(trim($_POST['password']));
$code = trim($_POST['code']);

if($_SESSION['authcode'] != $code){
    echo "<script>alert('验证码错误');history.back();</script>";
    exit;
}
//第四步，判断用户名和密码是否正确
$sql = "select * from userinfo where username = '$username' and pw = '$pw'";
//echo $sql;
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
    //找到了用户各和对应的密码，则登录成功
    //接下来判断是普通用户还是管理员
    //判断的依据就是看admin这一列的值是0还是1
    $info = mysqli_fetch_array($result);
    //登录成功后，跳转到会员中心
    //保存登录标志  SESSION
    $_SESSION['admin'] = $info['admin'];
    $_SESSION['logged'] = $username;
    if($info['admin']){ //说明是管理员登录，则跳转至管理员界面
        echo "<script>alert('登录成功');location.href='admin.php?navID=3';</script>";
    }
    else{ //说明是普通用户登录，则跳转至会员资料修改界面
        echo "<script>alert('登录成功');location.href='member.php?navID=4';</script>";
    }
}
else{
    echo "<script>alert('用户名或（和）密码错误！');history.back();</script>";
}
