<?php
//session_start();
//首先读取前端用户提交的数据
$username = trim($_POST['username']);
$sex = $_POST['sex'];
$email = $_POST['email'];
$fav = implode(",",$_POST['fav']);  //explode
$modifyPW = $_POST['modifyPW'];
$source = $_POST['source'];
include_once "conn.php";
//修改数据库记录
if($modifyPW){  //说明勾选了修改密码选项
    $pw = md5($_POST['password']);
    $sql = "update userinfo set email = '$email',sex='$sex',fav='$fav',pw = '$pw' where username = '$username'";
}
else{  // 说明不需要修改密码
    $sql = "update userinfo set email = '$email',sex='$sex',fav='$fav' where username = '$username'";
}
$result = mysqli_query($conn,$sql);
if($source == 'admin'){
    $url = "admin.php?navID=3&page=" . $_POST['page'] ;
}
else{
    $url = "index.php";
}
if($result){
    echo "<script>alert('资料更新成功');location.href='$url';</script>";
}
else{
    echo "<script>alert('资料更新失败');location.href='$url';</script>";
}
