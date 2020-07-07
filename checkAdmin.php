<?php
header('Content-Type: text/html; charset=utf-8'); //网页编码
//权限判断
if (!isset($_SESSION['admin']) or $_SESSION['admin'] == 0) { //说明未登录或是普通用户登录
    //header("Location:login.php");
    echo "<script>alert(\"请以管理员身份登录后访问本页面\");location.href='login.php?navID=2';</script>";
    exit;
}