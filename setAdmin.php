<?php
session_start();
include_once "checkAdmin.php";
$id = $_GET['id'];
$action = $_GET['action'];
$text = $action ? "设置" : "取消";
include_once "conn.php";
$sql = "update userinfo set admin = $action where id = $id";
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('".$text."成功');location.href='admin.php';</script>";
}
else{
    echo "<script>alert(\"$text 失败\");history.back();</script>";
}
