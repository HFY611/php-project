<?php
header('Content-Type: text/html; charset=utf-8'); //网页编码
//权限判断
if(!isset($_SESSION['logged'])){ //说明未登录
    echo "<script>alert(\"请登录后访问本页面\");location.href='login.php?navID=2';</script>";
    exit;
}