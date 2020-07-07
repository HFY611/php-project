<?php
session_start();
include_once "checkAdmin.php";
//读取要删除哪个用户
$id = $_GET['id'];
//删除用户
include_once "conn.php";
$sql = "delete from userinfo where id = $id";
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('删除成功');location.href='admin.php';</script>";
}
else{
    echo "<script>alert('删除失败');history.back();</script>";
}